<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Check if user is logged in
        if(!$this->session->userdata('user_id')) {
            redirect('auth');
        }
        
        // Load model and helpers
        $this->load->model('history_model');
    }
    
    /**
     * Main History Page
     */
    public function index() {
        $data['page_title'] = 'Activity History';
        
        // Get current user role and id
        $user_role = $this->session->userdata('role');
        $user_id = $this->session->userdata('user_id');
        
        // Get history with filters and role-based access
        $data['history'] = $this->get_filtered_history($user_role, $user_id);
        
        // Get unique actions for filter dropdown (based on user's accessible history)
        $data['actions'] = $this->get_unique_actions($user_role, $user_id);
        
        // Get unique modules for filter dropdown (based on user's accessible history)
        $data['modules'] = $this->get_unique_modules($user_role, $user_id);
        
        // Get statistics for dashboard cards
        $data['stats'] = $this->get_statistics($user_role, $user_id);
        
        // Load views
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('historyView', $data);
        $this->load->view('layout/footer');
    }
    
    /**
     * Get Filtered History with Role-Based Access
     */
    public function get_filtered_history($user_role = null, $user_id = null) {
        
        // If called directly, get from session
        if($user_role == null) {
            $user_role = $this->session->userdata('role');
            $user_id = $this->session->userdata('user_id');
        }
        
        $this->db->select('activity_log.*, users.name as user_name, users.email as user_email, users.role as user_role');
        $this->db->from('activity_log');
        $this->db->join('users', 'users.id = activity_log.user_id', 'left');
        
        // 🔴 FIXED: ROLE-BASED ACCESS CONTROL
        if($user_role == 'admin' || $user_role == 'super_admin') {
            // Admin/Super Admin: Saari history dekhenge (no filter)
            // No additional where condition
        } else {
            // Normal user: Sirf apni history dekhega
            $this->db->where('activity_log.user_id', $user_id);
        }
        
        // Apply filters if any
        if($this->input->get('action') && $this->input->get('action') != '') {
            $this->db->where('activity_log.action', $this->input->get('action'));
        }
        
        if($this->input->get('module') && $this->input->get('module') != '') {
            $this->db->where('activity_log.table_name', $this->input->get('module'));
        }
        
        if($this->input->get('date_from') && $this->input->get('date_from') != '') {
            $this->db->where('DATE(activity_log.created_at) >=', $this->input->get('date_from'));
        }
        
        if($this->input->get('date_to') && $this->input->get('date_to') != '') {
            $this->db->where('DATE(activity_log.created_at) <=', $this->input->get('date_to'));
        }
        
        // Search in description
        if($this->input->get('search') && $this->input->get('search') != '') {
            $this->db->like('activity_log.description', $this->input->get('search'));
        }
        
        $this->db->order_by('activity_log.created_at', 'DESC');
        
        return $this->db->get()->result();
    }
    
    /**
     * Get Unique Actions for Filter Dropdown
     */
    public function get_unique_actions($user_role = null, $user_id = null) {
        $this->db->distinct()->select('action');
        
        if($user_role != 'admin' && $user_role != 'super_admin') {
            $this->db->where('user_id', $user_id);
        }
        
        $this->db->order_by('action', 'ASC');
        return $this->db->get('activity_log')->result();
    }
    
    /**
     * Get Unique Modules for Filter Dropdown
     */
    public function get_unique_modules($user_role = null, $user_id = null) {
        $this->db->distinct()->select('table_name');
        
        if($user_role != 'admin' && $user_role != 'super_admin') {
            $this->db->where('user_id', $user_id);
        }
        
        $this->db->order_by('table_name', 'ASC');
        return $this->db->get('activity_log')->result();
    }
    
    /**
     * Get Statistics for Dashboard Cards
     */
    public function get_statistics($user_role = null, $user_id = null) {
        if($user_role == 'admin' || $user_role == 'super_admin') {
            // Admin statistics (all users)
            $stats = [
                'total' => $this->db->count_all('activity_log'),
                'today' => $this->db->where('DATE(created_at)', date('Y-m-d'))->count_all_results('activity_log'),
                'week' => $this->db->where('created_at >=', date('Y-m-d', strtotime('-7 days')))->count_all_results('activity_log'),
                'month' => $this->db->where('created_at >=', date('Y-m-d', strtotime('-30 days')))->count_all_results('activity_log')
            ];
            
            // Get unique users count
            $stats['unique_users'] = $this->db->distinct()
                                             ->select('user_id')
                                             ->where('user_id IS NOT NULL')
                                             ->count_all_results('activity_log');
            
            // Action-wise counts
            $stats['inserts'] = $this->db->where('action', 'insert')->count_all_results('activity_log');
            $stats['updates'] = $this->db->where('action', 'update')->count_all_results('activity_log');
            $stats['deletes'] = $this->db->where('action', 'delete')->count_all_results('activity_log');
            
            // Old logs count
            $old_date = date('Y-m-d', strtotime('-30 days'));
            $stats['old_logs'] = $this->db->where('DATE(created_at) <', $old_date)->count_all_results('activity_log');
            
        } else {
            // Normal user statistics (only their own)
            $stats = [
                'total' => $this->db->where('user_id', $user_id)->count_all_results('activity_log'),
                'today' => $this->db->where('user_id', $user_id)->where('DATE(created_at)', date('Y-m-d'))->count_all_results('activity_log'),
                'week' => $this->db->where('user_id', $user_id)->where('created_at >=', date('Y-m-d', strtotime('-7 days')))->count_all_results('activity_log'),
                'month' => $this->db->where('user_id', $user_id)->where('created_at >=', date('Y-m-d', strtotime('-30 days')))->count_all_results('activity_log')
            ];
            $stats['unique_users'] = 1; // Only themselves
        }
        
        return $stats;
    }
    
    /**
     * AJAX function for filtered history
     */
    public function ajax_get_history() {
        if(!$this->input->is_ajax_request()) {
            show_404();
        }
        
        $user_role = $this->session->userdata('role');
        $user_id = $this->session->userdata('user_id');
        
        $history = $this->get_filtered_history($user_role, $user_id);
        echo json_encode(['success' => true, 'data' => $history]);
    }
    
    /**
     * Get current user's activity only
     */
    public function my_activity() {
        $data['page_title'] = 'My Activity';
        
        $user_id = $this->session->userdata('user_id');
        $data['history'] = $this->history_model->get_user_activity($user_id);
        $data['stats'] = $this->get_statistics($this->session->userdata('role'), $user_id);
        
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('historyView', $data);
        $this->load->view('layout/footer');
    }
    
    /**
     * Export history to CSV
     */
    public function export() {
        // Only admin can export
        if($this->session->userdata('role') != 'admin' && $this->session->userdata('role') != 'super_admin') {
            $this->session->set_flashdata('error', 'Unauthorized access!');
            redirect('history');
        }
        
        $history = $this->get_filtered_history();
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="activity_history_' . date('Y-m-d') . '.csv"');
        
        $output = fopen('php://output', 'w');
        fputcsv($output, ['Date', 'User', 'Action', 'Module', 'Description', 'IP Address']);
        
        foreach($history as $row) {
            fputcsv($output, [
                date('Y-m-d H:i:s', strtotime($row->created_at)),
                $row->user_name ?? 'System',
                $row->action,
                $row->table_name,
                $row->description,
                $row->ip_address
            ]);
        }
        
        fclose($output);
        exit;
    }
    
    /**
     * Clear old logs (Super Admin only)
     */
    public function clear_old_logs($days = 30) {
        if($this->session->userdata('role') != 'super_admin') {
            $this->session->set_flashdata('error', 'Unauthorized access!');
            redirect('history');
        }
        
        if(!is_numeric($days) || $days < 1) {
            $days = 30;
        }
        
        $date = date('Y-m-d', strtotime("-{$days} days"));
        $count = $this->db->where('DATE(created_at) <', $date)->count_all_results('activity_log');
        
        $this->db->where('DATE(created_at) <', $date);
        $this->db->delete('activity_log');
        
        log_activity(
            'delete',
            'activity_log',
            null,
            "Cleared {$count} logs older than {$days} days",
            null,
            ['days' => $days, 'count' => $count]
        );
        
        $this->session->set_flashdata('success', "{$count} logs older than {$days} days cleared successfully!");
        redirect('history');
    }
    
    /**
     * Get activity details by ID
     */
    public function get_details($id) {
        if(!$this->input->is_ajax_request()) {
            show_404();
        }
        
        $activity = $this->db->where('id', $id)->get('activity_log')->row();
        
        if($activity) {
            $activity->old_data = $activity->old_data ? json_decode($activity->old_data) : null;
            $activity->new_data = $activity->new_data ? json_decode($activity->new_data) : null;
            
            echo json_encode(['success' => true, 'data' => $activity]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Activity not found']);
        }
    }
}
?>