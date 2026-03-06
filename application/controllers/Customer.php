<?php
class Customer extends CI_Controller
{

        public function __construct()
        {
                parent::__construct();

                if (!$this->session->userdata('logged_in')) {
                        redirect('auth');
                }

                $this->load->model('Customer_model', 'm');
        }



        public function index()
        {
            $data['page_title'] = 'Customer';
            $this->load->view('layout/header', $data);
            $this->load->view('layout/sidebar');
            $this->load->view('customerView');
            $this->load->view('layout/footer');
                
        }
   

        public function saveCustomer()
        {
                // Validation
                $this->form_validation->set_rules('name', 'Customer Name', 'required|trim');
                $this->form_validation->set_rules('phone', 'Phone', 'required|trim');
                $this->form_validation->set_rules('gender', 'Gender', 'required|trim');
                $user_id = $_SESSION['user_id'];
                $business_id = $_SESSION['business_id'];
                if ($this->form_validation->run() == FALSE) {

                        echo json_encode([
                                "status" => "error",
                                "errors" => [
                                        "name"   => form_error("name"),
                                        "phone"  => form_error("phone"),
                                        "gender" => form_error("gender"),
                                ]
                        ]);
                } else {

                        $data = [
                                "business_id" => $business_id,
                                "user_id" => $user_id,
                                "name"        => $this->input->post("name"),
                                "phone"       => $this->input->post("phone"),
                                "address"     => $this->input->post("address"),
                                "gender"      => $this->input->post("gender"),
                                "notes"       => $this->input->post("notes"),
                                "created_at"  => date("Y-m-d H:i:s")
                        ];

                        $this->m->saveCustomerDAO($data);

                        echo json_encode(["status" => "success"]);
                }
        }



        // Get Category 
        public function getCustomers()
        {
                $result = $this->m->getCustomersDAO();
                echo json_encode($result);
        }


        // Controller: Customer.php
        public function getCustomerById($id)
        {
                $data = $this->m->getCustomerByIdDAO($id);
                echo json_encode($data);
        }

        public function updateCustomer()
        {
                $user_id = $_SESSION['user_id'];
                $business_id = $_SESSION['business_id'];

                $this->form_validation->set_rules('edit_name', 'Customer Name', 'required|trim');
                $this->form_validation->set_rules('edit_phone', 'Phone', 'required|regex_match[/^[0-9+\- ]*$/]');
                $this->form_validation->set_rules('edit_address', 'Address', 'required|trim');
                $this->form_validation->set_rules('edit_gender', 'Gender', 'required|trim');

                if ($this->form_validation->run() == FALSE) {
                        echo json_encode([
                                'status' => false,
                                'errors' => [
                                        'edit_name'    => form_error('edit_name'),
                                        'edit_phone'   => form_error('edit_phone'),
                                        'edit_address' => form_error('edit_address'),
                                        'edit_gender'  => form_error('edit_gender'),
                                ]
                        ]);
                } else {
                        $id = $this->input->post('id');

                        $data = [
                                'name'       => $this->input->post('edit_name'),
                                'phone'      => $this->input->post('edit_phone'),
                                'address'    => $this->input->post('edit_address'),
                                'gender'     => $this->input->post('edit_gender'),
                                'notes'      => $this->input->post('edit_notes'),
                                'updated_at' => date("Y-m-d H:i:s")
                        ];

                        // Update customer in DB
                        $this->m->updateCustomerDAO($id, $data);

                        echo json_encode(['status' => true]);
                }
        }


        public function delete_item()
        {
                $id = $this->input->post('id');
                if ($id) {
                        $result = $this->m->deleteCustomer($id);

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
