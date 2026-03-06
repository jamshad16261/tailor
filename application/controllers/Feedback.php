<?php
class Feedback extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        $this->load->model('Feedback_model', 'm');
        $this->load->library('form_validation');
    }

    // LOAD VIEW
    public function index()
    {
        $data['page_title'] = 'Feedback';
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('feedbackView');
        $this->load->view('layout/footer');
    }

    // INSERT FEEDBACK
    public function saveFeedback()
    {
        $this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_rules('message', 'Message', 'required|trim');
        $this->form_validation->set_rules('rating', 'Rating', 'required|integer|greater_than[0]|less_than[6]');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                "status" => "error",
                "errors" => [
                    "title"   => form_error("title"),
                    "message" => form_error("message"),
                    "rating"  => form_error("rating"),
                ]
            ]);
        } else {

            $data = [
                "user_id"     => $this->session->userdata('user_id'),
                "business_id" => $this->session->userdata('business_id'),
                "title"       => $this->input->post("title"),
                "message"     => $this->input->post("message"),
                "rating"      => $this->input->post("rating"),
                "status"      => $this->input->post("status") ?? 1,
                "created_at"  => date("Y-m-d H:i:s"),
                "is_deleted"  => 0
            ];

            $this->m->insert($data);

            echo json_encode(["status" => "success"]);
        }
    }

    // GET ALL FEEDBACK
    public function getFeedback()
    {
        $business_id = $this->session->userdata('business_id'); 
        $data = $this->m->get_all($business_id);
        echo json_encode($data);
    }

    // GET FEEDBACK BY ID
    public function getById($id)
    {
        $data = $this->m->get_by_id($id);
        echo json_encode($data);
    }

    // UPDATE FEEDBACK
    public function updateFeedback()
    {
        $id = $this->input->post('id');

        $data = [
            'title'      => $this->input->post('edit_title'),
            'message'    => $this->input->post('edit_message'),
            'rating'     => $this->input->post('edit_rating'),
            'status'     => $this->input->post('edit_status'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->m->update($id, $data);

        echo json_encode(['status'=>true]);
    }

    // SOFT DELETE
    public function delete_item()
    {
        $id = $this->input->post('id');
        $this->m->soft_delete($id);
        echo json_encode(['status'=>true]);
    }
}