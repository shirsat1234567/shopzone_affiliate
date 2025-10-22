<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->_check_auth();
        $this->load->model('Admin_model');
    }

   public function index() {
        $data['title'] = 'Dashboard - ShopZone Admin';
        $data['stats'] = $this->Admin_model->get_dashboard_stats();
        $data['recent_products'] = $this->Admin_model->get_recent_products();
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/templates/footer');
    }

    private function _check_auth() {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
    }
}
?>