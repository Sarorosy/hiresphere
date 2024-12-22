<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrgLogin extends CI_Controller {

    public $form_validation, $OrgLoginModel, $session;

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('OrgLoginModel'); // Create this model for database operations
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function login() {
        if ($this->input->post()) {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');
    
            if ($this->form_validation->run() == TRUE) {
                $email = $this->input->post('email');
                $password = $this->input->post('password');
    
                $result = $this->OrgLoginModel->login($email, $password);
    
                switch ($result['status']) {
                    case 'success':
                        $org = $result['data'];
                        $this->session->set_userdata('org_id', $org['id']);
                        $this->session->set_userdata('org_name', $org['name']);
                        $this->session->set_userdata('org_image', $org['profile_pic']);
                        redirect(base_url('dashboard'));
                        break;
    
                    case 'not_verified':
                        $this->session->set_flashdata('error', 'Your account is not verified yet.');
                        break;
    
                    case 'invalid_password':
                        $this->session->set_flashdata('error', 'Invalid email or password.');
                        break;
    
                    case 'no_account':
                        $this->session->set_flashdata('error', 'No account found with this email.');
                        break;
    
                    default:
                        $this->session->set_flashdata('error', 'An unknown error occurred. Please try again.');
                }
            }
        }
    
        $this->load->view('org_login');
    }
    

    public function register() {
        if ($this->input->post()) {
            $this->form_validation->set_rules('org_name', 'Organization Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('address', 'Address', 'required');
            $this->form_validation->set_rules('contact_number', 'Contact Number', 'required|numeric');

            if ($this->form_validation->run() == TRUE) {
                $data = [
                    'name' => $this->input->post('org_name'),
                    'email' => $this->input->post('email'),
                    'password' => md5($this->input->post('password')),
                    'decrypt_password' => $this->input->post('password'),
                    'address' => $this->input->post('address'),
                    'contact_number' => $this->input->post('contact_number'),
                ];

                $this->OrgLoginModel->register($data);
                $this->session->set_flashdata('success', 'Registration successful. Please login.');
                redirect(base_url('OrgLogin/login'));
            }
        }
        $this->load->view('org_register');
    }
    public function logout() {
        $this->session->unset_userdata('org_id');
        $this->session->unset_userdata('name');
        $this->session->sess_destroy();
        redirect(base_url('org/login'));
    }
    
}
