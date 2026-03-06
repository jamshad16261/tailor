<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Support extends CI_Controller {

    public function index() {
        $this->load->view('support'); // Support page view
    }

    public function submit() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $name = $this->input->post('name', true);
            $email = $this->input->post('email', true);
            $message = $this->input->post('message', true);

            // Email send
            $this->load->library('email');
            $this->email->from($email, $name);
            $this->email->to('youremail@example.com'); // replace with your email
            $this->email->subject('Support Form Message');
            $this->email->message($message);

            if ($this->email->send()) {
                $this->session->set_flashdata('success', 'Message sent successfully!');
            } else {
                $this->session->set_flashdata('error', 'Failed to send message.');
            }

            redirect('support');
        }
    }
}