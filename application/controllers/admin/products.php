<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->_check_auth();
        $this->load->model('Product_model');
    }

    public function index() {
        $this->load->library('pagination');
        
        $config['base_url'] = base_url('admin/products');
        $config['total_rows'] = $this->db->count_all('products');
        $config['per_page'] = 20;
        $config['uri_segment'] = 3;
        
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        $data['title'] = 'Manage Products - ShopZone Admin';
        $data['products'] = $this->Product_model->get_all_products($config['per_page'], $page);
        $data['pagination'] = $this->pagination->create_links();
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/products/index', $data);
        $this->load->view('admin/templates/footer');
    }

    public function add() {
        if ($this->input->post()) {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('name', 'Product Name', 'required');
            $this->form_validation->set_rules('category', 'Category', 'required');
            $this->form_validation->set_rules('subcategory', 'Subcategory', 'required');
            $this->form_validation->set_rules('original_price', 'Original Price', 'required|numeric');
            $this->form_validation->set_rules('discounted_price', 'Discounted Price', 'required|numeric');
            $this->form_validation->set_rules('affiliate_url', 'Affiliate URL', 'required|valid_url');
            
            if ($this->form_validation->run()) {
                $data = array(
                    'name' => $this->input->post('name'),
                    'category' => $this->input->post('category'),
                    'subcategory' => $this->input->post('subcategory'),
                    'description' => $this->input->post('description'),
                    'original_price' => $this->input->post('original_price'),
                    'discounted_price' => $this->input->post('discounted_price'),
                    'rating' => $this->input->post('rating'),
                    'reviews_count' => $this->input->post('reviews_count'),
                    'image_url' => $this->input->post('image_url'),
                    'affiliate_url' => $this->input->post('affiliate_url'),
                    'featured' => $this->input->post('featured') ? 1 : 0,
                    'status' => 'active'
                );
                
                if ($this->Product_model->insert_product($data)) {
                    $this->session->set_flashdata('success', 'Product added successfully!');
                    redirect('admin/products');
                } else {
                    $data['error'] = 'Error adding product. Please try again.';
                }
            }
        }
        
        $data['title'] = 'Add Product - ShopZone Admin';
        $data['categories'] = $this->Product_model->get_categories();
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/products/add', $data);
        $this->load->view('admin/templates/footer');
    }

    public function edit($id) {
        $product = $this->Product_model->get_product($id);
        if (!$product) {
            show_404();
        }
        
        if ($this->input->post()) {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('name', 'Product Name', 'required');
            $this->form_validation->set_rules('category', 'Category', 'required');
            $this->form_validation->set_rules('subcategory', 'Subcategory', 'required');
            $this->form_validation->set_rules('original_price', 'Original Price', 'required|numeric');
            $this->form_validation->set_rules('discounted_price', 'Discounted Price', 'required|numeric');
            $this->form_validation->set_rules('affiliate_url', 'Affiliate URL', 'required|valid_url');
            
            if ($this->form_validation->run()) {
                $data = array(
                    'name' => $this->input->post('name'),
                    'category' => $this->input->post('category'),
                    'subcategory' => $this->input->post('subcategory'),
                    'description' => $this->input->post('description'),
                    'original_price' => $this->input->post('original_price'),
                    'discounted_price' => $this->input->post('discounted_price'),
                    'rating' => $this->input->post('rating'),
                    'reviews_count' => $this->input->post('reviews_count'),
                    'image_url' => $this->input->post('image_url'),
                    'affiliate_url' => $this->input->post('affiliate_url'),
                    'featured' => $this->input->post('featured') ? 1 : 0
                );
                
                if ($this->Product_model->update_product($id, $data)) {
                    $this->session->set_flashdata('success', 'Product updated successfully!');
                    redirect('admin/products');
                } else {
                    $data['error'] = 'Error updating product. Please try again.';
                }
            }
        }
        
        $data['title'] = 'Edit Product - ShopZone Admin';
        $data['product'] = $product;
        $data['categories'] = $this->Product_model->get_categories();
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/products/edit', $data);
        $this->load->view('admin/templates/footer');
    }

    public function delete($id) {
        if ($this->Product_model->delete_product($id)) {
            $this->session->set_flashdata('success', 'Product deleted successfully!');
        } else {
            $this->session->set_flashdata('error', 'Error deleting product.');
        }
        redirect('admin/products');
    }

    public function get_subcategories() {
        $category = $this->input->post('category');
        $subcategories = $this->Product_model->get_subcategories($category);
        
        echo json_encode($subcategories);
    }

    private function _check_auth() {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/auth/login');
        }
    }
}

?>