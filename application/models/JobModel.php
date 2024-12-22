<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JobModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Load database library
    }

    public function insert_temp_job($data) {
        $this->db->insert('tbl_temp_jobs', $data);
        return $this->db->insert_id();
    }

    public function post_job($job_id) {
        // Get job data from temp table
        $this->db->where('id', $job_id);
        $job = $this->db->get('tbl_temp_jobs')->row_array();

        // Insert into permanent jobs table
        $this->db->insert('tbl_jobs', $job);

        // Delete from temp_jobs
        $this->db->delete('tbl_temp_jobs', ['id' => $job_id]);
    }

    public function get_job_count($org_id) {
        $this->db->where('company_id', $org_id);
        $this->db->from('tbl_jobs');
        return $this->db->count_all_results(); // Return the count of jobs
    }

    // Get the recent jobs posted by the organization
    public function get_recent_jobs($org_id) {
        $this->db->where('company_id', $org_id);
        $this->db->order_by('created_at', 'DESC');  // Order by created_at in descending order
        $this->db->limit(5);  // Get the most recent 5 jobs
        return $this->db->get('tbl_jobs')->result(); // Return the result
    }
    public function get_jobs_by_company($company_id) {
        $this->db->where('company_id', $company_id);
        return $this->db->get('tbl_jobs')->result(); // Fetch and return all jobs
    }
    public function get_job_by_id($job_id) {
        // Perform a JOIN query to get job details along with organization name and profile_pic
        $this->db->select('tbl_jobs.*, tbl_organizations.name AS company_name, tbl_organizations.profile_pic');
        $this->db->from('tbl_jobs');
        $this->db->join('tbl_organizations', 'tbl_organizations.id = tbl_jobs.company_id', 'left');  // Left join to include jobs without matching organization
        $this->db->where('tbl_jobs.id', $job_id);
        
        $query = $this->db->get();
        
        return $query->row();  // Return the job record with organization details
    }
    

    // Update job details
    public function update_job($job_id, $data) {
        $this->db->where('id', $job_id);
        return $this->db->update('tbl_jobs', $data);  // Update job record
    }
    public function get_all_recent_jobs($limit = 10)
    {
        $this->db->select('tbl_jobs.*, tbl_organizations.name as company_name, tbl_organizations.profile_pic');
        $this->db->from('tbl_jobs');
        $this->db->join('tbl_organizations', 'tbl_jobs.company_id = tbl_organizations.id', 'left');
        $this->db->order_by('tbl_jobs.created_at', 'DESC');
        $query = $this->db->get('', $limit);
        return $query->result();  // Return the result as an array of job objects
    }
    public function applyJob($formData)
    {
        // Insert the application data into the tbl_job_applications table
        return $this->db->insert('tbl_job_applications', $formData);
    }
}
