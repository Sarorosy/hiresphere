<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jobs extends CI_Controller
{

    public $razorpay, $session, $JobModel;

    public function __construct()
    {
        parent::__construct();

        // Check if the user is logged in
        if (!$this->session->userdata('org_id')) {
            // Redirect to login page if not logged in
            redirect('org/login');
        }

        $this->load->model('JobModel');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('razorpay');
        $this->load->database();
    }

    public function index()
    {
        // Load the job posting form view
        $data['main'] = 'post_job';  // Set the main content view to 'post_job'
        $this->load->view('template', $data);  // Load the template view with header/footer
    }


    public function update($encoded_job_id)
    {
        // Decode the job ID
        $job_id = base64_decode($encoded_job_id);

        // Get data from the POST request
        $data = [
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'location' => $this->input->post('location'),
        ];


        // Update the job in the database
        if ($this->JobModel->update_job($job_id, $data)) {
            // Redirect to the jobs list with a success message
            $this->session->set_flashdata('success', 'Job updated successfully.');
            redirect(base_url('created-jobs'));
        } else {
            // If failed, show an error message
            $this->session->set_flashdata('error', 'Failed to update the job.');
            redirect(base_url('jobs/edit/' . base64_encode($job_id)));
        }
    }

    public function edit($encoded_job_id)
    {
        // Decode the job ID
        $job_id = base64_decode($encoded_job_id);

        $job = $this->JobModel->get_job_by_id($job_id);

        // If job does not exist, redirect to jobs list or error page
        if (!$job) {
            redirect(base_url('created-jobs'));
        }

        $user_org_id = $this->session->userdata('org_id');  // Assuming 'org_id' is stored in session data

        if ($job->company_id != $user_org_id) {
            // If they don't match, set an error message and redirect
            $this->session->set_flashdata('error', 'You do not have access to edit this job.');
            redirect(base_url('created-jobs'));  // Redirect to jobs listing page or an appropriate page
        }

        // Prepare data to pass to the view
        $data['main'] = 'edit_job';  // View for editing the job
        $data['job'] = $job;         // Pass job data

        // Load the template view
        $this->load->view('template', $data);
    }



    public function post_job()
    {
        // Check if the form is submitted
        if ($this->input->post()) {
            // Form validation
            $this->form_validation->set_rules('title', 'Job Title', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
            $this->form_validation->set_rules('location', 'Location', 'required');
            $this->form_validation->set_rules('experience', 'Experience', 'required');
            $this->form_validation->set_rules('salary', 'Salary', 'required');
            $this->form_validation->set_rules('skills', 'Skills', 'required');
            $this->form_validation->set_rules('job_type', 'Job Type', 'required');

            // If form validation passes
            if ($this->form_validation->run() == TRUE) {
                $job_data = [
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'location' => $this->input->post('location'),
                    'experience' => $this->input->post('experience'),
                    'salary' => $this->input->post('salary'),
                    'skills' => $this->input->post('skills'),
                    'job_type' => $this->input->post('job_type'),
                    'company_id' => $this->session->userdata('org_id'),  // Save the company ID from session
                    'created_at' => date('Y-m-d H:i:s')
                ];

                $job_id = $this->JobModel->insert_temp_job($job_data);

                // If the job was saved, proceed with payment
                if ($job_id) {
                    $order_id = $this->razorpay->createOrder(99); // 99 INR

                    // Redirect to Razorpay checkout page
                    redirect('jobs/razorpay_checkout/' . $job_id . '/' . $order_id);
                }
            }
        }
    }

    // Razorpay checkout page
    public function razorpay_checkout($job_id, $order_id)
    {
        $data['job_id'] = $job_id;
        $data['order_id'] = $order_id;
        $data['main'] = 'razorpay_checkout'; // Razorpay checkout view

        $this->load->view('template', $data);
    }

    // Verify Razorpay payment and post job
    public function verify_payment()
    {
        $payment_id = $this->input->post('razorpay_payment_id');
        $order_id = $this->input->post('razorpay_order_id');
        $signature = $this->input->post('razorpay_signature');
        $job_id = $this->input->post('job_id');

        // Verify payment
        $is_verified = $this->razorpay->verifyPayment($payment_id, $order_id, $signature);

        if ($is_verified) {
            // Payment successful, post the job
            $this->JobModel->post_job($job_id);

            // Insert into tbl_order_history
            $order_data = [
                'org_id' => $this->session->userdata('org_id'), // Get organization ID from session
                'payment_id' => $payment_id,
                'order_id' => $order_id,
                'amount' => 99, // Payment amount in INR
                'status' => 'Success',
                'created_at' => date('Y-m-d H:i:s')
            ];
            $this->db->insert('tbl_order_history', $order_data);

            // Redirect to success page
            $this->session->set_flashdata('success', 'Job posted successfully!');
            redirect('jobs');
        } else {
            // Payment verification failed
            $this->session->set_flashdata('error', 'Payment verification failed!');
            redirect('jobs');
        }
    }

    
}
