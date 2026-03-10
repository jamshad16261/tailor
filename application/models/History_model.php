<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Get user activity by user ID
     */
    public function get_user_activity($user_id) {
        $this->db->select('activity_log.*, users.name as user_name');
        $this->db->from('activity_log');
        $this->db->join('users', 'users.id = activity_log.user_id', 'left');
        $this->db->where('activity_log.user_id', $user_id);
        $this->db->order_by('activity_log.created_at', 'DESC');
        return $this->db->get()->result();
    }
    
    /**
     * Get module activity with role-based access
     */
    public function get_module_activity($module, $user_role = null, $user_id = null) {
        $this->db->select('activity_log.*, users.name as user_name');
        $this->db->from('activity_log');
        $this->db->join('users', 'users.id = activity_log.user_id', 'left');
        $this->db->where('activity_log.table_name', $module);
        
        // Role-based access
        if($user_role != 'admin' && $user_role != 'super_admin' && $user_id) {
            $this->db->where('activity_log.user_id', $user_id);
        }
        
        $this->db->order_by('activity_log.created_at', 'DESC');
        return $this->db->get()->result();
    }
    
    /**
     * Get today's activity with role-based access
     */
    public function get_today_activity($user_role = null, $user_id = null) {
        $today = date('Y-m-d');
        
        $this->db->select('activity_log.*, users.name as user_name');
        $this->db->from('activity_log');
        $this->db->join('users', 'users.id = activity_log.user_id', 'left');
        $this->db->where('DATE(activity_log.created_at)', $today);
        
        // Role-based access
        if($user_role != 'admin' && $user_role != 'super_admin' && $user_id) {
            $this->db->where('activity_log.user_id', $user_id);
        }
        
        $this->db->order_by('activity_log.created_at', 'DESC');
        return $this->db->get()->result();
    }
    
    /**
     * Get activity by date range with role-based access
     */
    public function get_activity_by_date_range($from_date, $to_date, $user_role = null, $user_id = null) {
        $this->db->select('activity_log.*, users.name as user_name');
        $this->db->from('activity_log');
        $this->db->join('users', 'users.id = activity_log.user_id', 'left');
        $this->db->where('DATE(activity_log.created_at) >=', $from_date);
        $this->db->where('DATE(activity_log.created_at) <=', $to_date);
        
        // Role-based access
        if($user_role != 'admin' && $user_role != 'super_admin' && $user_id) {
            $this->db->where('activity_log.user_id', $user_id);
        }
        
        $this->db->order_by('activity_log.created_at', 'DESC');
        return $this->db->get()->result();
    }
}
?>