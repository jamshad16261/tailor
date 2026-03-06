<?php
class Measurement extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Session check to ensure the user is logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('Measurement_model', 'm');
    }


    public function index()
    {
        $id = $this->input->get('id');

        if ($id) {
            $data['editMeasurement'] = $this->m->getMeasurementById($id);
            
        } else {
            $data['editMeasurement'] = null;
        }
        $data['page_title'] = 'Meashrement';
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('measurementView', $data);
         $this->load->view('layout/footer');
    }

    public function measurementList()
    {
        $data['page_title'] = 'Measurement List';
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('measurementListView');
        $this->load->view('layout/footer');
        
    }

    public function saveMeasurement()
    {
        $measurement_type = trim($this->input->post('type'));

        // ----------------------------
        // VALIDATION RULES
        // ----------------------------
        $this->form_validation->set_rules('customer_id', 'Customer', 'required|numeric');
        $this->form_validation->set_rules('type', 'Measurement Type', 'required');

        // Upper Body Validation
        if ($measurement_type == 'shirt' || $measurement_type == 'kurta' || $measurement_type == 'coat' || $measurement_type == 'suit') {

            $this->form_validation->set_rules('length', 'Length', 'required|numeric');
            $this->form_validation->set_rules('shoulder', 'Shoulder', 'required|numeric');
            $this->form_validation->set_rules('chest', 'Chest', 'required|numeric');
            $this->form_validation->set_rules('belly', 'Belly', 'required|numeric');
            $this->form_validation->set_rules('hip', 'Hip', 'required|numeric');
            $this->form_validation->set_rules('sleeve_length', 'Sleeve Length', 'required|numeric');
            $this->form_validation->set_rules('cuff', 'Cuff', 'required|numeric');
            $this->form_validation->set_rules('neck', 'Neck', 'required|numeric');
            $this->form_validation->set_rules('armhole', 'Armhole', 'required|numeric');
        }

        // Lower Body Validation
        if ($measurement_type == 'pant' || $measurement_type == 'shalwar' || $measurement_type == 'suit') {

            $this->form_validation->set_rules('pant_length', 'Pant Length', 'required|numeric');
            $this->form_validation->set_rules('inseam_length', 'Inseam', 'required|numeric');
            $this->form_validation->set_rules('trouser_waist', 'Waist', 'required|numeric');
            $this->form_validation->set_rules('thigh', 'Thigh', 'required|numeric');
            $this->form_validation->set_rules('knee', 'Knee', 'required|numeric');
            $this->form_validation->set_rules('bottom', 'Bottom', 'required|numeric');
            $this->form_validation->set_rules('shalwar_length', 'Shalwar Length', 'required|numeric');
            $this->form_validation->set_rules('paicha', 'Paicha', 'required|numeric');
        }

        // If validation fails
        if ($this->form_validation->run() == FALSE) {

            echo json_encode([
                "status" => "error",
                "errors" => $this->form_validation->error_array()
            ]);
            return;
        }

        // ----------------------------
        // SAVE DATA
        // ----------------------------
        $user_id = $_SESSION['user_id'];
        $business_id = $_SESSION['business_id'];

        $data = [
            "business_id"      => $business_id,
            "user_id"          => $user_id,
            "customer_id"      => $this->input->post("customer_id"),
            "type" => $measurement_type,

            // Upper measurements
            "length"         => $this->input->post("length"),
            "shoulder"       => $this->input->post("shoulder"),
            "chest"          => $this->input->post("chest"),
            "belly"          => $this->input->post("belly"),
            "hip"            => $this->input->post("hip"),
            "sleeve_length"  => $this->input->post("sleeve_length"),
            "cuff"           => $this->input->post("cuff"),
            "neck"           => $this->input->post("neck"),
            "armhole"        => $this->input->post("armhole"),

            // Lower measurements
            "pant_length"    => $this->input->post("pant_length"),
            "inseam_length"  => $this->input->post("inseam_length"),
            "trouser_waist"  => $this->input->post("trouser_waist"),
            "thigh"          => $this->input->post("thigh"),
            "knee"           => $this->input->post("knee"),
            "bottom"         => $this->input->post("bottom"),
            "shalwar_length" => $this->input->post("shalwar_length"),
            "paicha"         => $this->input->post("paicha"),

            "created_at"     => date("Y-m-d H:i:s")
        ];

        $this->m->saveMeasurementDAO($data);

        echo json_encode(["status" => "success"]);
    }




    // Get Category 
    public function getMeasurement()
    {
        $result = $this->m->getMeasurementDAO();
        echo json_encode($result);
    }


public function updateMeasurement()
{
    // Fetch the ID of the measurement to be updated
    $id = $this->input->post('id');
    $measurement_type = trim($this->input->post('type'));

    // ----------------------------
    // VALIDATION RULES
    // ----------------------------
    $this->form_validation->set_rules('customer_id', 'Customer', 'required|numeric');
    $this->form_validation->set_rules('type', 'Measurement Type', 'required');

    // Upper Body Validation
    if ($measurement_type == 'shirt' || $measurement_type == 'kurta' || $measurement_type == 'coat' || $measurement_type == 'suit') {
        $this->form_validation->set_rules('length', 'Length', 'required|numeric');
        $this->form_validation->set_rules('shoulder', 'Shoulder', 'required|numeric');
        $this->form_validation->set_rules('chest', 'Chest', 'required|numeric');
        $this->form_validation->set_rules('belly', 'Belly', 'required|numeric');
        $this->form_validation->set_rules('hip', 'Hip', 'required|numeric');
        $this->form_validation->set_rules('sleeve_length', 'Sleeve Length', 'required|numeric');
        $this->form_validation->set_rules('cuff', 'Cuff', 'required|numeric');
        $this->form_validation->set_rules('neck', 'Neck', 'required|numeric');
        $this->form_validation->set_rules('armhole', 'Armhole', 'required|numeric');
    }

    // Lower Body Validation
    if ($measurement_type == 'pant' || $measurement_type == 'shalwar' || $measurement_type == 'suit') {
        $this->form_validation->set_rules('pant_length', 'Pant Length', 'required|numeric');
        $this->form_validation->set_rules('inseam_length', 'Inseam', 'required|numeric');
        $this->form_validation->set_rules('trouser_waist', 'Waist', 'required|numeric');
        $this->form_validation->set_rules('thigh', 'Thigh', 'required|numeric');
        $this->form_validation->set_rules('knee', 'Knee', 'required|numeric');
        $this->form_validation->set_rules('bottom', 'Bottom', 'required|numeric');
        $this->form_validation->set_rules('shalwar_length', 'Shalwar Length', 'required|numeric');
        $this->form_validation->set_rules('paicha', 'Paicha', 'required|numeric');
    }

    // If validation fails
    if ($this->form_validation->run() == FALSE) {
        echo json_encode([
            "status" => "error",
            "errors" => $this->form_validation->error_array()
        ]);
        return;
    }

    // ----------------------------
    // UPDATE DATA
    // ----------------------------
    $user_id = $_SESSION['user_id'];
    $business_id = $_SESSION['business_id'];

    $data = [
        "business_id"      => $business_id,
        "user_id"          => $user_id,
        "customer_id"      => $this->input->post("customer_id"),
        "type"             => $measurement_type,

        // Upper measurements
        "length"           => $this->input->post("length"),
        "shoulder"         => $this->input->post("shoulder"),
        "chest"            => $this->input->post("chest"),
        "belly"            => $this->input->post("belly"),
        "hip"              => $this->input->post("hip"),
        "sleeve_length"    => $this->input->post("sleeve_length"),
        "cuff"             => $this->input->post("cuff"),
        "neck"             => $this->input->post("neck"),
        "armhole"          => $this->input->post("armhole"),

        // Lower measurements
        "pant_length"      => $this->input->post("pant_length"),
        "inseam_length"    => $this->input->post("inseam_length"),
        "trouser_waist"    => $this->input->post("trouser_waist"),
        "thigh"            => $this->input->post("thigh"),
        "knee"             => $this->input->post("knee"),
        "bottom"           => $this->input->post("bottom"),
        "shalwar_length"   => $this->input->post("shalwar_length"),
        "paicha"           => $this->input->post("paicha"),

        "updated_at"       => date("Y-m-d H:i:s")
    ];

    // Update measurement in the database
    $this->m->updateMeasurementDAO($id, $data);

    echo json_encode(["status" => "success"]);
}

    public function deleteMeasurement()
    {
        $id = $this->input->post('id');
        if ($id) {
            $result = $this->m->deleteMeasurementDAO($id);

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
