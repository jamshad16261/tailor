<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Check if user is logged in
        if(!$this->session->userdata('user_id')) {
            redirect('login');
        }
    }
     public function get_history(){

    $this->db->select('activity_log.*, users.name');
    $this->db->from('activity_log');
    $this->db->join('users','users.id = activity_log.user_id','left');
    $this->db->order_by('activity_log.created_at','DESC');

    return $this->db->get()->result();
}
    // History Page
    public function index() {
        $data['page_title'] = 'History';
            $data['history'] = $this->get_history();
        // Load views
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('historyView', $data);
        $this->load->view('layout/footer');
    }
}