<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        // Load the model
        $this->load->model('JobModel');
        $this->load->library('upload');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if (!$this->session->userdata('org_id')) {
            redirect('org/login');
        }
        // Get the count of jobs posted and recent jobs
        $org_id = $this->session->userdata('org_id');
        $data['jobs_count'] = $this->JobModel->get_job_count($org_id);
        $data['recent_jobs'] = $this->JobModel->get_recent_jobs($org_id);

        // Prepare data to pass to the template
        $data['main'] = 'dashboard';  // Set the main content view to 'dashboard'

        // Load the template view which includes header, main content, and footer
        $this->load->view('template', $data);
    }

    public function myJobs()
    {
        if (!$this->session->userdata('org_id')) {
            redirect('org/login');
        }
        // Fetch the jobs for the logged-in user based on org_id
        $org_id = $this->session->userdata('org_id');
        $data['jobs'] = $this->JobModel->get_jobs_by_company($org_id);

        // Load the view with job data
        $data['main'] = 'my_jobs';
        $this->load->view('template', $data);
    }

    public function profile()
    {
        if (!$this->session->userdata('org_id')) {
            redirect('org/login');
        }
        // Get the organization ID from session
        $org_id = $this->session->userdata('org_id');

        // Fetch organization details
        $data['organization'] = $this->db->get_where('tbl_organizations', ['id' => $org_id])->row();

        // Load the profile view
        $data['main'] = 'profile';
        $this->load->view('template', $data);
    }

    public function update_profile()
    {
        if (!$this->session->userdata('org_id')) {
            redirect('org/login');
        }
        // Get the organization ID from session
        $org_id = $this->session->userdata('org_id');

        $config['upload_path'] = FCPATH . 'public/resumes/';
        $config['allowed_types'] = 'doc|pdf|docx';
        $config['max_size'] = 20480;
        $config['file_name'] = 'resume_' . time();

       

        $this->upload->initialize($config);

        // Upload profile picture
        if (!empty($_FILES['profile_pic']['name'])) {
            if ($this->upload->do_upload('profile_pic')) {
                $upload_data = $this->upload->data();
                $profile_pic_path = 'public/companyprofiles/' . $upload_data['file_name'];

                // Update organization profile with the new picture
                $this->db->update('tbl_organizations', ['profile_pic' => $profile_pic_path], ['id' => $org_id]);

                $this->session->set_flashdata('success', 'Profile updated successfully.');
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
            }
        }

        // Redirect back to profile page
        redirect(base_url('profile'));
    }

    public function job_detail($encoded_job_id)
    {
        // Decode the job ID
        $job_id = base64_decode($encoded_job_id);

        // Get job details from the database using the decoded job ID
        $job = $this->JobModel->get_job_by_id($job_id);

        // Check if job exists, if not redirect
        if (!$job) {
            $this->session->set_flashdata('error', 'Job not found.');
            redirect('jobs'); // Redirect to jobs list or an appropriate page
        }

        // Pass job data to the view
        $data['job'] = $job;
        $data['main'] = 'job_detail';  // Set the main content view to 'job_detail'

        // Load the template view
        $this->load->view('home_template', $data);
    }

    public function apply($encoded_job_id)
    {
        // Decode the job ID
        $jobId = base64_decode($encoded_job_id);

        // Check if the job exists
        $job = $this->JobModel->get_job_by_id($jobId);
        if (!$job) {
            $this->session->set_flashdata('error', 'Job not found.');
            redirect('jobs'); // Redirect if job is not found
        }
        

        // Set form validation rules
        $this->form_validation->set_rules('name', 'Full Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required');
        $this->form_validation->set_rules('education', 'Education', 'trim');
        $this->form_validation->set_rules('cover-letter', 'Cover Letter', 'required');

        if ($this->form_validation->run() == FALSE) {
            // If validation fails, reload the form with error messages
            $data['job'] = $job;
            $data['main'] = 'job_detail';
            $this->load->view('home_template', $data);
        } else {
            // Prepare data to insert into tbl_job_applications
            $formData = [
                'job_id'        => $jobId,
                'name'          => $this->input->post('name'),
                'email'         => $this->input->post('email'),
                'phone'         => $this->input->post('phone'),
                'education'     => $this->input->post('education'),
                'cover_letter'  => $this->input->post('cover-letter'),
                'created_at'    => date('Y-m-d H:i:s'),
            ];

           // Load the upload library
            $config['upload_path'] = FCPATH . 'public/resumes/'; // Correct path using FCPATH
            $config['allowed_types'] = 'doc|pdf|docx';
            $config['max_size'] = 20480; 
            $config['file_name'] = 'resume_' . time(); // Unique filename based on current timestamp

            $this->upload->initialize($config);

            if (!is_dir(FCPATH . 'public/resumes/')) {
                mkdir(FCPATH . 'public/resumes/', 0777, true); // Create the directory with permissions
            }
            

            // Upload the resume
            if (!empty($_FILES['resume']['name'])) {
                if ($this->upload->do_upload('resume')) {
                    $upload_data = $this->upload->data();
                    $resume_path = 'public/resumes/' . $upload_data['file_name'];

                    // Add resume path to the formData array
                    $formData['resume'] = $resume_path;
                } else {
                    // Set error message if file upload fails
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect(base_url('job-detail/' . $encoded_job_id)); // Redirect back if upload fails
                }
            }

            // Insert the application data into the database
            if ($this->JobModel->applyJob($formData)) {
                $this->session->set_flashdata('success', 'Application submitted successfully.');
                redirect(base_url('job-detail/' . $encoded_job_id)); // Redirect to page
            } else {
                $this->session->set_flashdata('error', 'There was an issue with your application.');
                redirect(base_url('job-detail/' . $encoded_job_id)); // Redirect back if application fails
            }
        }
    }


    // Handle file upload for the resume


}
