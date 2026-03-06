<?php
class Tailor extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Session check to ensure the user is logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('Tailor_model', 'm');
    }


    public function index()
    {
        $data['page_title'] = 'Assign Task';
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('tailorView');
        $this->load->view('layout/footer');
    
    }
    public function tailorAssignTask()
    {
        $data['page_title'] = 'Assign Task';
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('tailorAssignTaskView');
        $this->load->view('layout/footer');
        
    }
    public function tailorAssignTaskList()
    {
        $data['page_title'] = 'Assign Task List';
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('tailorAssignTaskList');
        $this->load->view('layout/footer');
        
    }

    public function saveTailor()
    {
        // Validation
        $this->form_validation->set_rules('tailor_name', 'Tailor Name', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required|regex_match[/^[0-9+\- ]*$/]|trim');
        $this->form_validation->set_rules('skill', 'Skill', 'required');
        $user_id = $_SESSION['user_id'];
        $business_id = $_SESSION['business_id'];
        if ($this->form_validation->run() == FALSE) {

            echo json_encode([
                "status" => "error",
                "errors" => [
                    "tailor_name"   => form_error("tailor_name"),
                    "phone"   => form_error("phone"),
                    "skill"  => form_error("skill"),
                ]
            ]);
        } else {

            $data = [
                "business_id" => $business_id,
                "user_id" => $user_id,
                "name"        => $this->input->post("tailor_name"),
                "phone"       => $this->input->post("phone"),
                "skill"     => $this->input->post("skill"),
                "remarks"      => $this->input->post("remarks"),
                "created_at"  => date("Y-m-d H:i:s")
            ];

            $this->m->saveTailorDAO($data);

            echo json_encode(["status" => "success"]);
        }
    }



    // Get Category 
    public function getTailors()
    {
        $result = $this->m->getTailorsDAO();
        echo json_encode($result);
    }


    // Controller: Customer.php
    public function getTailorById($id)
    {
        $data = $this->m->getTailorByIdDAO($id);
        echo json_encode($data);
    }

    public function updateTailor()
    {
        $user_id = $_SESSION['user_id'];
        $business_id = $_SESSION['business_id'];

        // ---- FORM VALIDATION ----
        $this->form_validation->set_rules('edit_name', 'Tailor Name', 'required|trim');
        $this->form_validation->set_rules('edit_phone', 'Phone', 'required|regex_match[/^[0-9+\- ]*$/]|trim');
        $this->form_validation->set_rules('edit_skill', 'Skill', 'required');
        $this->form_validation->set_rules('edit_remarks', 'Remarks', 'trim');

        if ($this->form_validation->run() == FALSE) {

            echo json_encode([
                'status' => false,
                'errors' => [
                    'edit_name'   => form_error('edit_name'),
                    'edit_phone'  => form_error('edit_phone'),
                    'edit_skill'  => form_error('edit_skill'),
                    'edit_remarks' => form_error('edit_remarks'),
                ]
            ]);
        } else {

            $id = $this->input->post('tailor_id');

            // ---- DATA TO UPDATE ----
            $data = [
                'user_id'     => $user_id,
                'business_id' => $business_id,
                'name'        => $this->input->post('edit_name'),
                'phone'       => $this->input->post('edit_phone'),
                'skill'       => $this->input->post('edit_skill'),
                'remarks'     => $this->input->post('edit_remarks'),
                'updated_at'  => date("Y-m-d H:i:s")
            ];

            // ---- UPDATE QUERY ----
            $this->m->updateTailorDAO($id, $data);

            echo json_encode(['status' => true]);
        }
    }



    public function deleteTailor()
    {
        $id = $this->input->post('id');
        if ($id) {
            $result = $this->m->deleteTailorDAO($id);

            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Item deleted successfully']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to delete item']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid ID']);
        }
    }



    public function getOrderItemsByOrder()
    {
        $order_id = $this->input->post('order_id');
        $business_id = $_SESSION['business_id'];

        $items = $this->db->where('order_id', $order_id)
            ->where('is_deleted', 0)
            ->where('business_id', $business_id)
            ->get('order_items')
            ->result();

        if (!empty($items)) {
            echo json_encode([
                'status' => 'success',
                'data' => $items
            ]);
        } else {
            echo json_encode([
                'status' => 'success',
                'data' => []
            ]);
        }
    }

    public function getOrderItemDetails()
    {
        $order_item_id = $this->input->post('order_item_id');
        $business_id = $_SESSION['business_id'];

        $item = $this->db->where('id', $order_item_id)
            ->where('is_deleted', 0)
            ->where('business_id', $business_id)
            ->get('order_items')
            ->row();

        if ($item) {
            echo json_encode([
                'status' => 'success',
                'data' => [
                    'quantity' => $item->quantity,
                    'price' => $item->price
                ]
            ]);
        } else {
            echo json_encode([
                'status' => 'error'
            ]);
        }
    }





    public function saveAssignWork()
    {
        $this->form_validation->set_rules('order_id', 'Order', 'required');
        $this->form_validation->set_rules('order_item_id', 'Order Item', 'required');
        $this->form_validation->set_rules('tailor_id', 'Tailor', 'required');
        $this->form_validation->set_rules('work_type', 'Work Type', 'required');
        $this->form_validation->set_rules('qty', 'Quantity', 'required|numeric');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');
        $this->form_validation->set_rules('assign_date', 'Assign Date', 'required');
        $this->form_validation->set_rules('expected_date', 'Expected Date', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                "status" => "error",
                "errors" => $this->form_validation->error_array()
            ]);
            return;
        }

        $qty   = (float) $this->input->post('qty');
        $price = (float) $this->input->post('price');

        // Negative block
        if ($qty <= 0 || $price <= 0) {
            echo json_encode([
                "status" => "error",
                "errors" => [
                    "qty" => "Qty must be greater than 0",
                    "price" => "Price must be greater than 0"
                ]
            ]);
            return;
        }

        // Fetch order item
        $orderItem = $this->db->where('id', $this->input->post('order_item_id'))->get('order_items')->row();

        // Remaining qty
        $assignedQty = $this->db->select_sum('qty')
            ->where('order_item_id', $orderItem->id)
            ->get('tailor_work_assign')
            ->row()->qty ?? 0;

        if ($qty > ($orderItem->quantity - $assignedQty)) {
            echo json_encode([
                "status" => "error",
                "errors" => [
                    "qty" => "Remaining qty: " . ($orderItem->quantity - $assignedQty)
                ]
            ]);
            return;
        }

        // Duplicate check
        $duplicate = $this->db->where([
            'order_item_id' => $orderItem->id,
            'tailor_id' => $this->input->post('tailor_id'),
            'work_type' => $this->input->post('work_type'),
            'assign_date' => $this->input->post('assign_date')
        ])->get('tailor_work_assign')->row();

        if ($duplicate) {
            echo json_encode([
                "status" => "error",
                "errors" => [
                    "tailor_id" => "Duplicate assignment not allowed"
                ]
            ]);
            return;
        }

        // Completed date logic
        $status = $this->input->post('status');
        $completed_date = ($status === 'Completed') ? date('Y-m-d') : null;

        $data = [
            'business_id' => $_SESSION['business_id'],
            'order_id' => $this->input->post('order_id'),
            'order_item_id' => $orderItem->id,
            'tailor_id' => $this->input->post('tailor_id'),
            'work_type' => $this->input->post('work_type'),
            'qty' => $qty,
            'price' => $price,
            'total' => $qty * $price,
            'assign_date' => $this->input->post('assign_date'),
            'expected_date' => $this->input->post('expected_date'),
            'completed_date' => $completed_date,
            'status' => $status,
            'remarks' => $this->input->post('remarks'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->db->insert('tailor_work_assign', $data);

        echo json_encode([
            "status" => "success",
            "message" => "Work assigned successfully"
        ]);
    }

    public function getAssignTask()
    {
        $business_id = $_SESSION['business_id'];

        $data = $this->m->getAssignTaskData($business_id);

        echo json_encode($data);
    }

    public function updateAssignTaskStatus()
    {
        $user_id     = $_SESSION['user_id'];
        $business_id = $_SESSION['business_id'];

        /* VALIDATION */
        $this->form_validation->set_rules('edit_status', 'Status', 'required|trim');
        $this->form_validation->set_rules('edit_remarks', 'Remarks', 'trim');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'status' => false,
                'errors' => [
                    'edit_status'  => form_error('edit_status'),
                    'edit_remarks' => form_error('edit_remarks'),
                ]
            ]);
            return;
        }

        $id         = $this->input->post('tailor_work_id');
        $newStatus  = $this->input->post('edit_status');
        $remarks    = $this->input->post('edit_remarks');

        /* GET OLD STATUS */
        $oldData = $this->m->getAssignTaskById($id);
        $oldStatus = $oldData->status ?? null;

        /* START TRANSACTION */
        $this->db->trans_begin();

        /* UPDATE MAIN TABLE */
        $updateData = [
            'status'     => $newStatus,
            'remarks'    => $remarks,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if ($newStatus == 'Completed') {
            $updateData['completed_date'] = date('Y-m-d H:i:s');
        }

        $this->m->updateAssignTaskDAO($id, $updateData);

        /* 🕘 INSERT HISTORY */
        $historyData = [
            'tailor_work_id' => $id,
            'user_id'     => $user_id,
            'business_id'     => $business_id,
            'old_status'     => $oldStatus,
            'new_status'     => $newStatus,
            'remarks'        => $remarks,
            'changed_by'     => $user_id,
            'changed_at'     => date('Y-m-d H:i:s')
        ];

        // compare before inserting history
        if ($oldStatus !== $newStatus) {
            $this->m->insertAssignTaskHistoryDAO($historyData);
        }


        /* COMMIT / ROLLBACK */
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            echo json_encode(['status' => false, 'msg' => 'Something went wrong']);
        } else {
            $this->db->trans_commit();
            echo json_encode(['status' => true]);
        }
    }
}
