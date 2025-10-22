<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->_check_auth();
        $this->load->model('Category_model');
    }

    public function index() {
        $data['title'] = 'Manage Categories - ShopZone Admin';
        $data['categories'] = $this->Category_model->get_all_categories();
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/categories/index', $data);
        $this->load->view('admin/templates/footer');
    }

    public function add() {
        if ($this->input->post()) {
            $data = array(
                'name' => $this->input->post('name'),
                'icon' => $this->input->post('icon'),
                'status' => 'active'
            );
            
            if ($this->Category_model->insert_category($data)) {
                $this->session->set_flashdata('success', 'Category added successfully!');
                redirect('admin/categories');
            }
        }
        
        $data['title'] = 'Add Category - ShopZone Admin';
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/categories/add', $data);
        $this->load->view('admin/templates/footer');
    }

    public function delete($id) {
        if ($this->Category_model->delete_category($id)) {
            $this->session->set_flashdata('success', 'Category deleted successfully!');
        } else {
            $this->session->set_flashdata('error', 'Error deleting category.');
        }
        redirect('admin/categories');
    }

    private function _check_auth() {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/auth/login');
        }
    }
}
?>