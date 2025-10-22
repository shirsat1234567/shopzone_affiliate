
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }


    public function authenticate($username, $password) {
    $this->db->where('username', $username);
    $user = $this->db->get('admin_users')->row();
    
    if ($user) {
        // For testing, use simple password check first
        if ($password == 'admin123' && $username == 'admin') {
            return $user;
        }
        // Later use proper password_verify
        // if (password_verify($password, $user->password)) {
        //     return $user;
        // }
    }
    return false;
}


    // public function authenticate($username, $password) {
    //     $this->db->where('username', $username);
    //     $user = $this->db->get('admin_users')->row();
        
    //     if ($user && password_verify($password, $user->password)) {
    //         return $user;
    //     }
    //     return false;
    // }

    public function get_dashboard_stats() {
        $stats = array();
        
        $stats['total_products'] = $this->db->count_all('products');
        
        $this->db->where('status', 'active');
        $stats['active_products'] = $this->db->count_all_results('products');
        
        $this->db->where('featured', 1);
        $stats['featured_products'] = $this->db->count_all_results('products');
        
        $stats['total_categories'] = $this->db->count_all('categories');
        
        return $stats;
    }

    public function get_recent_products($limit = 5) {
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($limit);
        return $this->db->get('products')->result();
    }
}
?>