<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_products($limit = null, $offset = 0, $filters = array()) {
        $this->db->select('p.*, c.name as category_name, s.name as subcategory_name');
        $this->db->from('products p');
        $this->db->join('categories c', 'c.name = p.category');
        $this->db->join('subcategories s', 's.name = p.subcategory');
        $this->db->where('p.status', 'active');

        // Apply filters
        if (!empty($filters['category'])) {
            $this->db->where('p.category', $filters['category']);
        }
        if (!empty($filters['subcategory'])) {
            $this->db->where('p.subcategory', $filters['subcategory']);
        }
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $this->db->group_start();
            $this->db->like('p.name', $search);
            $this->db->or_like('p.description', $search);
            $this->db->or_like('p.category', $search);
            $this->db->or_like('p.subcategory', $search);
            $this->db->group_end();
        }
        if (!empty($filters['min_price']) && !empty($filters['max_price'])) {
            $this->db->where('p.discounted_price >=', $filters['min_price']);
            $this->db->where('p.discounted_price <=', $filters['max_price']);
        }
        if (!empty($filters['min_rating'])) {
            $this->db->where('p.rating >=', $filters['min_rating']);
        }
        if (!empty($filters['min_discount'])) {
            $this->db->where('p.discount_percentage >=', $filters['min_discount']);
        }

        $this->db->order_by('p.created_at', 'DESC');
        
        if ($limit) {
            $this->db->limit($limit, $offset);
        }

        return $this->db->get()->result();
    }

    public function get_product($id) {
        $this->db->select('p.*, c.name as category_name, s.name as subcategory_name');
        $this->db->from('products p');
        $this->db->join('categories c', 'c.name = p.category');
        $this->db->join('subcategories s', 's.name = p.subcategory');
        $this->db->where('p.id', $id);
        $this->db->where('p.status', 'active');
        return $this->db->get()->row();
    }

    public function get_featured_products($limit = 8) {
        $this->db->select('p.*, c.name as category_name, s.name as subcategory_name');
        $this->db->from('products p');
        $this->db->join('categories c', 'c.name = p.category');
        $this->db->join('subcategories s', 's.name = p.subcategory');
        $this->db->where('p.status', 'active');
        $this->db->where('p.featured', 1);
        $this->db->order_by('p.rating', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }

    public function get_categories() {
        $this->db->select('c.*, COUNT(p.id) as product_count');
        $this->db->from('categories c');
        $this->db->join('products p', 'p.category = c.name AND p.status = "active"', 'left');
        $this->db->where('c.status', 'active');
        $this->db->group_by('c.id');
        $this->db->order_by('c.name');
        return $this->db->get()->result();
    }

    public function get_subcategories($category = null) {
        $this->db->select('s.*, c.name as category_name');
        $this->db->from('subcategories s');
        $this->db->join('categories c', 'c.id = s.category_id');
        if ($category) {
            $this->db->where('c.name', $category);
        }
        $this->db->order_by('s.name');
        return $this->db->get()->result();
    }

    public function insert_product($data) {
        // Calculate discount percentage
        if ($data['original_price'] > 0) {
            $data['discount_percentage'] = round((($data['original_price'] - $data['discounted_price']) / $data['original_price']) * 100);
        }
        return $this->db->insert('products', $data);
    }

    public function update_product($id, $data) {
        // Calculate discount percentage
        if (isset($data['original_price']) && isset($data['discounted_price']) && $data['original_price'] > 0) {
            $data['discount_percentage'] = round((($data['original_price'] - $data['discounted_price']) / $data['original_price']) * 100);
        }
        $this->db->where('id', $id);
        return $this->db->update('products', $data);
    }

    public function delete_product($id) {
        $this->db->where('id', $id);
        return $this->db->delete('products');
    }

    public function count_products($filters = array()) {
        $this->db->from('products p');
        $this->db->where('p.status', 'active');

        // Apply same filters as get_all_products
        if (!empty($filters['category'])) {
            $this->db->where('p.category', $filters['category']);
        }
        if (!empty($filters['subcategory'])) {
            $this->db->where('p.subcategory', $filters['subcategory']);
        }
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $this->db->group_start();
            $this->db->like('p.name', $search);
            $this->db->or_like('p.description', $search);
            $this->db->or_like('p.category', $search);
            $this->db->or_like('p.subcategory', $search);
            $this->db->group_end();
        }

        return $this->db->count_all_results();
    }
}
?>