<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public $JobModel;
    public function __construct()
    {
        parent::__construct();
        // Load the JobModel
        $this->load->model('JobModel');
    }

    public function index()
    {
        // Fetch recent jobs (limit 10)
        $data['recent_jobs'] = $this->JobModel->get_all_recent_jobs(10);

        // Pass the jobs data to the view
		$data['main'] = 'landing';
        $this->load->view('home_template', $data);
    }
}
