<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subcategory_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_subcategories() {
        $this->db->select('s.*, c.name as category_name, c.icon as category_icon');
        $this->db->from('subcategories s');
        $this->db->join('categories c', 'c.id = s.category_id');
        $this->db->order_by('c.name, s.name');
        return $this->db->get()->result();
    }

    public function get_subcategory($id) {
        $this->db->select('s.*, c.name as category_name');
        $this->db->from('subcategories s');
        $this->db->join('categories c', 'c.id = s.category_id');
        $this->db->where('s.id', $id);
        return $this->db->get()->row();
    }

    public function insert_subcategory($data) {
        return $this->db->insert('subcategories', $data);
    }

    public function update_subcategory($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('subcategories', $data);
    }

    public function delete_subcategory($id) {
        $this->db->where('id', $id);
        return $this->db->delete('subcategories');
    }

    public function get_subcategories_by_category($category_id) {
        $this->db->where('category_id', $category_id);
        $this->db->order_by('name');
        return $this->db->get('subcategories')->result();
    }
}

?>