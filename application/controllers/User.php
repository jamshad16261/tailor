<?php
class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('User_model', 'm');
    }


    public function index()
    {
        $this->load->view('user/userView');
    }
    public function showUsers()
    {
        $this->load->view('user/userList');
    }

    public function saveUser()
    {
        // ================= VALIDATION RULES =================
        $this->form_validation->set_rules('user_name', 'User Name', 'required|trim');
        $this->form_validation->set_rules('user_phone', 'User Phone', 'required|trim');
        $this->form_validation->set_rules('user_email', 'User Email', 'required|valid_email|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('role', 'Role', 'required');
        $this->form_validation->set_rules('User_status', 'Status', 'required');

        // ================= VALIDATION FAIL =================
        if ($this->form_validation->run() == FALSE) {

            echo json_encode([
                "status" => "error",
                "errors" => [
                    "user_name"   => form_error("user_name"),
                    "user_phone"  => form_error("user_phone"),
                    "user_email"  => form_error("user_email"),
                    "password"   => form_error("password"),
                    "role"       => form_error("role"),
                    "status"     => form_error("User_status"),
                ]
            ]);
            return;
        }

        // ================= SESSION BUSINESS ID =================
        $business_id = $this->session->userdata('business_id');

        // ================= USER DATA =================
        $userData = [
            "business_id" => $business_id,
            "name"        => $this->input->post("user_name"),
            "phone"       => $this->input->post("user_phone"),
            "email"       => $this->input->post("user_email"),
            "password"    => password_hash($this->input->post("password"), PASSWORD_BCRYPT),
            "role"        => $this->input->post("role"),
            "status"      => $this->input->post("User_status"),
            "created_at"  => date("Y-m-d H:i:s")
        ];

        // ================= INSERT USER =================
        $this->m->insert_user($userData);

        echo json_encode([
            "status"  => "success",
            "message" => "User added successfully"
        ]);
    }



public function updateUser() {
    // ================= SESSION USER ID AND BUSINESS ID =================
    $user_id = $this->session->userdata('user_id');
    $business_id = $this->session->userdata('business_id');

    // ================= VALIDATION RULES =================
    $this->form_validation->set_rules('edit_name', 'User Name', 'required|trim');
    $this->form_validation->set_rules('edit_phone', 'User Phone', 'required|regex_match[/^[0-9+\- ]*$/]');
    $this->form_validation->set_rules('edit_email', 'User Email', 'required|valid_email|trim');
    $this->form_validation->set_rules('edit_role', 'Role', 'required');
    $this->form_validation->set_rules('edit_status', 'Status', 'required');

    // ================= VALIDATION FAIL =================
    if ($this->form_validation->run() == FALSE) {
        echo json_encode([
            'status' => 'error',
            'errors' => [
                'edit_name'    => form_error('edit_name'),
                'edit_phone'   => form_error('edit_phone'),
                'edit_email'   => form_error('edit_email'),
                'edit_role'    => form_error('edit_role'),
                'edit_status'  => form_error('edit_status'),
            ]
        ]);
        return;
    }

    // ================= USER DATA =================
    $userData = [
        'name'       => $this->input->post('edit_name'),
        'phone'      => $this->input->post('edit_phone'),
        'email'      => $this->input->post('edit_email'),
        'role'       => $this->input->post('edit_role'),
        'status'     => $this->input->post('edit_status'),
        'updated_at' => date("Y-m-d H:i:s")
    ];

    // ================= UPDATE USER IN DB =================
    $id = $this->input->post('hidden_user_id');
    $updateSuccess = $this->m->updateUserDAO($id, $userData);

    // ================= RESPONSE =================
    if ($updateSuccess) {
        echo json_encode([
            'status'  => 'success',
            'message' => 'User updated successfully'
        ]);
    } else {
        echo json_encode([
            'status'  => 'error',
            'message' => 'Failed to update user'
        ]);
    }
}


    // Get Category 
    public function getUser()
    {
        $data = $this->m->getUserDAO();
        echo json_encode($data);
    }

    public function getUserById($id)
    {
        $data = $this->m->getUserByIdDAO($id);
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
