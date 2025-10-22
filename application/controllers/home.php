<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->library('pagination');
    }
    

      public function index() {
        $data['title'] = 'ShopZone - Your Ultimate Shopping Destination';
        $data['categories'] = $this->Product_model->get_categories();
        $data['featured_products'] = $this->Product_model->get_featured_products(8);
        
        $filters = array();
        $data['products'] = $this->Product_model->get_all_products(12, 0, $filters);
        $data['total_products'] = $this->Product_model->count_products($filters);
        
        $this->load->view('templates/header', $data);
        $this->load->view('home/index', $data);
        $this->load->view('templates/footer');
    }

  public function category($category) {
        $filters = array('category' => $category);
        
        $data['title'] = ucfirst($category) . ' Collection - ShopZone';
        $data['categories'] = $this->Product_model->get_categories();
        $data['products'] = $this->Product_model->get_all_products(12, 0, $filters);
        $data['current_category'] = $category;
        
        $this->load->view('templates/header', $data);
        $this->load->view('home/products', $data);
        $this->load->view('templates/footer');
    }

    public function subcategory($category, $subcategory) {
        $filters = array('category' => $category, 'subcategory' => $subcategory);
        
        $data['title'] = ucfirst($category) . ' ' . ucfirst($subcategory) . ' - ShopZone';
        $data['categories'] = $this->Product_model->get_categories();
        $data['products'] = $this->Product_model->get_all_products(12, 0, $filters);
        $data['current_category'] = $category;
        $data['current_subcategory'] = $subcategory;
        
        $this->load->view('templates/header', $data);
        $this->load->view('home/products', $data);
        $this->load->view('templates/footer');
    }


     public function search() {
        $search_term = $this->input->get('q');
        $filters = array('search' => $search_term);
        
        $data['title'] = 'Search Results - ShopZone';
        $data['categories'] = $this->Product_model->get_categories();
        $data['products'] = $this->Product_model->get_all_products(12, 0, $filters);
        $data['search_term'] = $search_term;
        
        $this->load->view('templates/header', $data);
        $this->load->view('home/search_results', $data);
        $this->load->view('templates/footer');
    }

public function product_details($id) {
        $product = $this->Product_model->get_product($id);
        
        if (!$product) {
            show_404();
        }
        
        $data['title'] = $product->name . ' - ShopZone';
        $data['product'] = $product;
        $data['categories'] = $this->Product_model->get_categories();
        $data['related_products'] = $this->Product_model->get_all_products(4, 0, array('category' => $product->category));
        
        $this->load->view('templates/header', $data);
        $this->load->view('home/product_details', $data);
        $this->load->view('templates/footer');
    }


    public function ajax_load_products() {
        $page = $this->input->post('page', TRUE);
        $filters = $this->_get_filters();
        
        $products_per_page = 8;
        $offset = ($page - 1) * $products_per_page;
        
        $products = $this->Product_model->get_all_products($products_per_page, $offset, $filters);
        
        $html = '';
        foreach ($products as $product) {
            $html .= $this->load->view('home/product_card', array('product' => $product), TRUE);
        }
        
        echo json_encode(array('html' => $html));
    }

    private function _get_filters() {
        $filters = array();
        
        $price_range = $this->input->get('price');
        if ($price_range) {
            if (strpos($price_range, '-') !== false) {
                list($min, $max) = explode('-', $price_range);
                $filters['min_price'] = (int)$min;
                $filters['max_price'] = (int)$max;
            } elseif (strpos($price_range, '+') !== false) {
                $filters['min_price'] = (int)str_replace('+', '', $price_range);
            }
        }
        
        $rating = $this->input->get('rating');
        if ($rating) {
            $filters['min_rating'] = (float)str_replace('+', '', $rating);
        }
        
        $discount = $this->input->get('discount');
        if ($discount) {
            $filters['min_discount'] = (int)str_replace('+', '', $discount);
        }
        
        return $filters;
    }
}
?>


