<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Account extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Account_model');
        $this->load->library(['form_validation', 'session']);
        $this->load->helper(['url', 'security']);
        // Ensure user is logged in
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
    }

    public function index()
    {
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->Account_model->get_user($user_id);
        $this->load->view('account_settings', $data);
    }
    public function profile()
    {
        $user_id = $this->session->userdata('user_id');
        $data['page_title'] = 'My Profile';
        $data['user'] = $this->Account_model->get_user($user_id);

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('profileView', $data);
        $this->load->view('layout/footer');
    }
 // PROFILE UPDATE FUNCTION
public function update_profile()
{
    $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');

    if ($this->form_validation->run() == FALSE) {
        $errors = validation_errors();
        $this->session->set_flashdata('error', $errors);
    } else {
        $user_id = $this->session->userdata('user_id');

        $data = [
            'name' => $this->input->post('name', true),
            'email' => $this->input->post('email', true),
            'phone' => $this->input->post('phone', true),
        ];

        // IMAGE UPLOAD
        if (!empty($_FILES['logo']['name'])) {
            $config['upload_path'] = './assets/images/logo/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 2048;
            $config['file_name'] = time();

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('logo')) {
                $uploadData = $this->upload->data();
                $data['logo'] = $uploadData['file_name'];
                // SESSION UPDATE
                $this->session->set_userdata('logo', $uploadData['file_name']);
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('account');
                return;
            }
        }

        // DB UPDATE
        $this->Account_model->update_profile($user_id, $data);

        // UPDATE SESSION FIRST NAME / LAST NAME
        $this->session->set_userdata([
            'first_name' => $data['name'], // ya agar alag first/last field ho to split karo
            'last_name' => '',             // agar separate last_name field ho to yahan use karo
        ]);

        $this->session->set_flashdata('success', 'Profile updated successfully.');
    }

    redirect('account');
}

    public function change_password()
    {
        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[6]|trim');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]|trim');

        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            $this->session->set_flashdata('error', $errors);
        } else {
            $user_id = $this->session->userdata('user_id');
            $current = $this->input->post('current_password', true);
            $new = $this->input->post('new_password', true);

            if ($this->Account_model->check_password($user_id, $current)) {
                $this->Account_model->update_password($user_id, $new);
                $this->session->set_flashdata('success', 'Password changed successfully.');
            } else {
                $this->session->set_flashdata('error', 'Current password is incorrect.');
            }
        }
        redirect('account');
    }
    public function privacy()
    {
        $this->load->view('privacy'); // loads privacy.php
    }
}
