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

    // History Page
    public function index() {
        $data['page_title'] = 'History';
        // Load views
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('historyView', $data);
        $this->load->view('layout/footer');
    }
}