<?php
class Fabrics extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Session check to ensure the user is logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('Fabric_model', 'm');
    }


    public function index()
    {
        $data['page_title'] = 'Fabric';
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('fabricsView');
        $this->load->view('layout/footer');
}

    public function saveFabric()
    {
        // Validation
        $this->form_validation->set_rules('name', 'Fabric Name', 'required|trim');
        $this->form_validation->set_rules('color', 'Color', 'required|trim');
        $this->form_validation->set_rules('type', 'Fabric Type', 'required|trim');
        $this->form_validation->set_rules('meter', 'Meters', 'required|trim|numeric');
        $this->form_validation->set_rules('unit_price', 'Unit Price', 'required|trim|numeric');

        $user_id = $_SESSION['user_id'];
        $business_id = $_SESSION['business_id'];

        if ($this->form_validation->run() == FALSE) {

            echo json_encode([
                "status" => "error",
                "errors" => [
                    "name"       => form_error("name"),
                    "color"      => form_error("color"),
                    "type"       => form_error("type"),
                    "meter"      => form_error("meter"),
                    "unit_price" => form_error("unit_price"),
                ]
            ]);
        } else {

            $data = [
                "business_id" => $business_id,
                "user_id"     => $user_id,
                "name"        => $this->input->post("name"),
                "color"       => $this->input->post("color"),
                "type"        => $this->input->post("type"),
                "meter"       => $this->input->post("meter"),
                "unit_price"  => $this->input->post("unit_price"),
                "description" => $this->input->post("description"),
                "created_at"  => date("Y-m-d H:i:s")
            ];

            $this->m->saveFabricDAO($data);

            echo json_encode(["status" => "success"]);
        }
    }



    // Get Category 
    public function getFabrics()
    {
        $result = $this->m->getFabricsDAO();
        echo json_encode($result);
    }


    // Controller: Customer.php
    public function getFabricsById($id)
    {
        $data = $this->m->getFabricsByIdDAO($id);
        echo json_encode($data);
    }

    public function updateFabrics()
    {
        $user_id = $_SESSION['user_id'];
        $business_id = $_SESSION['business_id'];

        // Validation
        $this->form_validation->set_rules('edit_name', 'Fabric Name', 'required|trim');
        $this->form_validation->set_rules('edit_color', 'Color', 'required|trim');
        $this->form_validation->set_rules('edit_type', 'Fabric Type', 'required|trim');
        $this->form_validation->set_rules('edit_meter', 'Meters', 'required|numeric');
        $this->form_validation->set_rules('edit_unit_price', 'Unit Price', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {

            echo json_encode([
                'status' => false,
                'errors' => [
                    'edit_name'       => form_error('edit_name'),
                    'edit_color'      => form_error('edit_color'),
                    'edit_type'       => form_error('edit_type'),
                    'edit_meter'      => form_error('edit_meter'),
                    'edit_unit_price' => form_error('edit_unit_price'),
                ]
            ]);
        } else {

            $id = $this->input->post('id');

            $data = [
                "name"        => $this->input->post("edit_name"),
                "color"       => $this->input->post("edit_color"),
                "type"        => $this->input->post("edit_type"),
                "meter"       => $this->input->post("edit_meter"),
                "unit_price"  => $this->input->post("edit_unit_price"),
                "description" => $this->input->post("edit_description"),
                "updated_at"  => date("Y-m-d H:i:s"),
            ];

            // Update fabrics DB
            $this->m->updateFabricDAO($id, $data);

            echo json_encode(['status' => true]);
        }
    }



    public function deleteFabric()
    {
        $id = $this->input->post('id');
        if ($id) {
            $result = $this->m->deleteFabricDAO($id);

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
