<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Subcategories extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->_check_auth();
        $this->load->model('Subcategory_model');
        $this->load->model('Category_model');
    }

    public function index() {
        $data['title'] = 'Manage Subcategories - ShopZone Admin';
        $data['subcategories'] = $this->Subcategory_model->get_all_subcategories();
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/subcategories/index', $data);
        $this->load->view('admin/templates/footer');
    }

    public function add() {
        if ($this->input->post()) {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('name', 'Subcategory Name', 'required');
            $this->form_validation->set_rules('category_id', 'Category', 'required');
            
            if ($this->form_validation->run()) {
                $data = array(
                    'name' => strtolower($this->input->post('name')),
                    'category_id' => $this->input->post('category_id')
                );
                
                if ($this->Subcategory_model->insert_subcategory($data)) {
                    $this->session->set_flashdata('success', 'Subcategory added successfully!');
                    redirect('admin/subcategories');
                } else {
                    $data['error'] = 'Error adding subcategory. Please try again.';
                }
            }
        }
        
        $data['title'] = 'Add Subcategory - ShopZone Admin';
        $data['categories'] = $this->Category_model->get_all_categories();
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/subcategories/add', $data);
        $this->load->view('admin/templates/footer');
    }

    public function edit($id) {
        $subcategory = $this->Subcategory_model->get_subcategory($id);
        if (!$subcategory) {
            show_404();
        }

        if ($this->input->post()) {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('name', 'Subcategory Name', 'required');
            $this->form_validation->set_rules('category_id', 'Category', 'required');
            
            if ($this->form_validation->run()) {
                $data = array(
                    'name' => strtolower($this->input->post('name')),
                    'category_id' => $this->input->post('category_id')
                );
                
                if ($this->Subcategory_model->update_subcategory($id, $data)) {
                    $this->session->set_flashdata('success', 'Subcategory updated successfully!');
                    redirect('admin/subcategories');
                } else {
                    $data['error'] = 'Error updating subcategory. Please try again.';
                }
            }
        }
        
        $data['title'] = 'Edit Subcategory - ShopZone Admin';
        $data['subcategory'] = $subcategory;
        $data['categories'] = $this->Category_model->get_all_categories();
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/subcategories/edit', $data);
        $this->load->view('admin/templates/footer');
    }

    public function delete($id) {
        if ($this->Subcategory_model->delete_subcategory($id)) {
            $this->session->set_flashdata('success', 'Subcategory deleted successfully!');
        } else {
            $this->session->set_flashdata('error', 'Error deleting subcategory.');
        }
        redirect('admin/subcategories');
    }

    private function _check_auth() {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/auth/login');
        }
    }
}
?>