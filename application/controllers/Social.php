<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Social extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Social_model');
    }

    public function index() {
        $this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('social/social_form');
        $this->load->view('layout/footer');
    }

    public function save() {

        $this->form_validation->set_rules('tiktok', 'TikTok', 'trim|valid_url');
        $this->form_validation->set_rules('instagram', 'Instagram', 'trim|valid_url');
        $this->form_validation->set_rules('facebook', 'Facebook', 'trim|valid_url');

        if ($this->form_validation->run() == FALSE) {

            $errors = [
                'tiktok' => form_error('tiktok'),
                'instagram' => form_error('instagram'),
                'facebook' => form_error('facebook'),
            ];

            echo json_encode([
                'status' => 'error',
                'errors' => $errors
            ]);
        } else {

            $data = [
                'tiktok' => $this->input->post('tiktok'),
                'instagram' => $this->input->post('instagram'),
                'facebook' => $this->input->post('facebook'),
                'user_id' => 1 // session se dynamic kar lena
            ];

            $this->Social_model->save($data);

            echo json_encode([
                'status' => 'success'
            ]);
        }
    }
}