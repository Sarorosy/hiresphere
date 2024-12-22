<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrgLoginModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Load database library
    }

    public function login($email, $password) {
        // Check if account exists with the given email
        $this->db->where('email', $email);
        $query = $this->db->get('tbl_organizations');
    
        if ($query->num_rows() == 1) {
            $org = $query->row_array();
    
            // Check if the account is verified
            if ($org['isverified'] == 0) {
                return ['status' => 'not_verified'];
            }
    
            // Validate the password
            if (md5($password) == $org['password']) {
                return ['status' => 'success', 'data' => $org];
            } else {
                return ['status' => 'invalid_password'];
            }
        }
    
        return ['status' => 'no_account'];
    }
    

    public function register($data) {
        return $this->db->insert('tbl_organizations', $data);
    }
}
