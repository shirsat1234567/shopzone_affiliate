<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_categories() {
        $this->db->order_by('name');
        return $this->db->get('categories')->result();
    }

    public function insert_category($data) {
        return $this->db->insert('categories', $data);
    }

    public function delete_category($id) {
        $this->db->where('id', $id);
        return $this->db->delete('categories');
    }
}
?>