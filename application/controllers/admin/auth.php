<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Admin_model');
    }

  
    public function login() {
        if ($this->session->userdata('admin_logged_in')) {
            redirect('admin/dashboard');
        }

        if ($this->input->post()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            
            // Simple check for testing - use MD5 hash
            if ($username === 'admin' && $password === 'admin123') {
                $this->session->set_userdata(array(
                    'admin_id' => 1,
                    'admin_username' => $username,
                    'admin_logged_in' => TRUE
                ));
                redirect('admin/dashboard');
            } else {
                $data['error'] = 'Invalid username or password';
            }
        }
        
        $data['title'] = 'Admin Login - ShopZone';
        $this->load->view('admin/auth/login', $data);
    }

    public function logout() {
        $this->session->unset_userdata(array(
            'admin_id',
            'admin_username',
            'admin_logged_in'
        ));
        redirect('admin/login');
    }
}
?>