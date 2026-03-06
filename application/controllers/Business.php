<?php
class Business extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('Business_model', 'm');
    }

    public function index()
    {
        $data['page_title'] = 'Add Business';
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('businessView');
        $this->load->view('layout/footer');
      
    }
    public function show_business()
    {
        $data['page_title'] = 'Business List';
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
         $this->load->view('businessList');
        $this->load->view('layout/footer');
    }

    public function save()
    {
        $this->form_validation->set_rules('business_name', 'Business Name', 'required');
        $this->form_validation->set_rules('business_phone', 'Business Phone', 'required');
        $this->form_validation->set_rules('user_name', 'User Name', 'required');
        $this->form_validation->set_rules('user_email', 'User Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('business_status', 'Status', 'required');

        if ($this->form_validation->run() == FALSE) {

            echo json_encode([
                "status" => "error",
                "errors" => [
                    "business_name"  => form_error("business_name"),
                    "business_phone" => form_error("business_phone"),
                    "user_name"      => form_error("user_name"),
                    "user_email"     => form_error("user_email"),
                    "password"       => form_error("password"),
                    "status"         => form_error("business_status"),
                ]
            ]);
            return;
        }

        $businessData = [
            "name"       => $this->input->post("business_name"),
            "phone"      => $this->input->post("business_phone"),
            "email"      => $this->input->post("business_email"),
            "address"    => $this->input->post("address"),
            "status"     => $this->input->post("business_status"),
            "is_deleted" => 0,
            "created_at" => date("Y-m-d H:i:s")
        ];

        $business_id = $this->m->insert_business($businessData);

        $userData = [
            "business_id" => $business_id,
            "name"        => $this->input->post("user_name"),
            "phone"       => $this->input->post("user_phone"),
            "email"       => $this->input->post("user_email"),
            "password"    => password_hash($this->input->post("password"), PASSWORD_BCRYPT),
            "role"        => $this->input->post("role"),
            "status"      => "active",
            "created_at"  => date("Y-m-d H:i:s")
        ];

        $this->m->insert_user($userData);

        echo json_encode([
            "status" => "success",
            "message" => "Tailor Business Created Successfully"
        ]);
    }




    // Get Category 
    public function getBusiness()
    {
        $data = $this->m->getBusinessDAO();
        echo json_encode($data);
    }

    public function getUserList($id)
    {
        $data = $this->m->getUserListDAO($id);
        echo json_encode($data);
    }



    public function delete_item()
    {
        $id = $this->input->post('id');
        if ($id) {
            $result = $this->m->soft_delete($id);

            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Item deleted successfully']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to delete item']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid ID']);
        }
    }
}
