<?php
class Order extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Session check to ensure the user is logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('Order_model', 'm');
    }


    public function index()
    {
        $data['page_title'] = 'Add Order';
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('orderView');
        $this->load->view('layout/footer');
       
    }
    public function orderList()
    {
        $data['page_title'] = 'Order List';
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('orderList');
        $this->load->view('layout/footer');
        
      
    }


    public function order_status()
    {
        $data['page_title'] = 'Order Status';
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('orderStatusView');
        $this->load->view('layout/footer');
        
    }


    public function getNextOrderNo()
    {
        $business_id = $this->session->userdata('business_id');
    
        $lastOrder = $this->m->getLastOrder($business_id);
    
        if ($lastOrder) {
            $next_order_no = $lastOrder->order_no + 1;
        } else {
            $next_order_no = 1;
        }
    
        echo json_encode([
            'status' => true,
            'order_no' => $next_order_no
        ]);
    }

    public function saveCurrentOrder()
    {
        $this->load->library('form_validation');
    
        $this->form_validation->set_rules('customer_id', 'Customer', 'required');
        $this->form_validation->set_rules('order_date', 'Order Date', 'required');
        $this->form_validation->set_rules('delivery_date', 'Delivery Date', 'required');
        $this->form_validation->set_rules('measurement_id', 'Measurement', 'required');
        $this->form_validation->set_rules('quantity', 'Quantity', 'required|numeric');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');
    
        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'status' => 'error',
                'errors' => $this->form_validation->error_array()
            ]);
            return;
        }
    
        $business_id = $_SESSION['business_id'];
        $user_id     = $_SESSION['user_id'];
    
        $measurement_id = $this->input->post('measurement_id');
        $measurement = $this->db
            ->where('id', $measurement_id)
            ->get('measurements')
            ->row();
    
        if (!$measurement) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid Measurement'
            ]);
            return;
        }
    
        $quantity = $this->input->post('quantity');
        $price    = $this->input->post('price');
    
        $total_amount = $quantity * $price;
        $disc_percent = (float)$this->input->post('disc_percent');
        $disc_amount  = ($total_amount * $disc_percent) / 100;
        $net_amount   = $total_amount - $disc_amount;
    
        // Generate Order No if not exists
        $order_no = $this->input->post('order_no');
    
        if (empty($order_no)) {
            $this->db->select_max('order_no');
            $this->db->where('business_id', $business_id);
            $last = $this->db->get('current_order_items')->row();
    
            $order_no = $last && $last->order_no
                ? $last->order_no + 1
                : 1;
        }
    
        $data = [
            'business_id' => $business_id,
            'user_id' => $user_id,
            'order_no' => $order_no,
            'customer_id' => $this->input->post('customer_id'),
            'order_date' => $this->input->post('order_date'),
            'delivery_date' => $this->input->post('delivery_date'), // item level
            'measurement_id' => $measurement_id,
            'item_type' => $measurement->type,
            'quantity' => $quantity,
            'price' => $price,
            'total_amount' => $total_amount,
            'disc_percent' => $disc_percent,
            'disc_amount' => $disc_amount,
            'net_amount' => $net_amount,
            'special_instructions' => $this->input->post('special_instructions'),
            'created_at' => date('Y-m-d H:i:s'),
            'is_deleted' => 0
        ];
    
        $this->db->insert('current_order_items', $data);
    
        echo json_encode([
            'status' => 'success',
            'message' => 'Item Added Successfully',
            'order_no' => $order_no
        ]);
    }


    public function getCurrentOrderItems()
    {
        $result = $this->m->getCurrentOrderItemsDAO();
        echo json_encode($result);
    }


    public function saveOrder()
    {
        try {
    
            $business_id = $this->session->userdata('business_id');
            $user_id     = $this->session->userdata('user_id');
    
            $items = $this->m->getCurrentItems($business_id, $user_id);
    
            if (empty($items)) {
                echo json_encode(['status' => false, 'msg' => 'No items found!']);
                return;
            }
    
            $this->db->trans_start();
    
            // Insert Order Header
            $orderData = [
                'business_id' => $business_id,
                'user_id'     => $user_id,
                'order_no'    => $items[0]->order_no,
                'customer_id' => $items[0]->customer_id,
                'order_date'  => $items[0]->order_date,
                'total_amount'=> $this->input->post('modal_total'),
                'disc_percent'=> $this->input->post('modal_disc_percent'),
                'disc_amount' => $this->input->post('modal_disc_amount'),
                'net_total'   => $this->input->post('modal_net_total'),
                'advance'     => $this->input->post('modal_paid_amount'),
                'balance'     => $this->input->post('modal_balance'),
                'payment_mode'=> $this->input->post('payment_mode'),
                'status'      => 1,
                'notes'       => $this->input->post('remarks'),
                'created_at'  => date('Y-m-d H:i:s')
            ];
    
            $this->db->insert('orders', $orderData);
            $order_id = $this->db->insert_id();
    
            // Insert Order Items
            foreach ($items as $item) {
    
                $measurement = $this->db
                    ->where('id', $item->measurement_id)
                    ->get('measurements')
                    ->row_array();
    
                unset($measurement['created_at']);
                unset($measurement['updated_at']);
    
                $orderItemData = [
                    'business_id' => $business_id,
                    'user_id' => $user_id,
                    'order_id' => $order_id,
                    'measurement_id' => $item->measurement_id,
                    'measurement_snapshot' => json_encode($measurement),
                    'item_type' => $item->item_type,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'total' => $item->total_amount,
                    'disc_percent' => $item->disc_percent,
                    'disc_amount' => $item->disc_amount,
                    'net_amount' => $item->net_amount,
                    'delivery_date' => $item->delivery_date,
                    'special_instructions' => $item->special_instructions,
                    'status' => 1
                ];
    
                $this->db->insert('order_items', $orderItemData);
            }
    
            // Soft delete current items
            $this->db->where('business_id', $business_id)
                     ->where('user_id', $user_id)
                     ->update('current_order_items', ['is_deleted' => 1]);
    
            $this->db->trans_complete();
    
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(['status' => false, 'msg' => 'Transaction Failed']);
            } else {
                echo json_encode([
                    'status' => true,
                    'msg' => 'Order Confirmed Successfully!',
                    'order_id' => $order_id
                ]);
            }
    
        } catch (Exception $e) {
            echo json_encode(['status' => false, 'msg' => $e->getMessage()]);
        }
    }



    public function deleteCurrentItem()
    {
        $id = $this->input->post('id');
        if ($id) {
            $result = $this->m->deleteCurrentItemDAO($id);

            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Item deleted successfully']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to delete item']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid ID']);
        }
    }


    public function getOrderData()
    {
        $result = $this->m->getOrderDataDAO();
        echo json_encode($result);
    }


    public function getOrderItems()
    {
        $result = $this->m->getOrderItemsDAO();
        echo json_encode($result);
    }


    // *********** Order Status Management ********
    public function searchCustomerOrders()
    {
        $customer_id = $this->input->post('customer_id');

        $this->db->select('o.id as order_id, o.order_no, o.status, c.name as customer_name');
        $this->db->from('orders o');
        $this->db->join('customers c', 'c.id = o.customer_id');
        $this->db->where('o.customer_id', $customer_id);
        $query = $this->db->get();

        echo json_encode($query->result());
    }


    public function updateOrderStatus()
    {
        $order_no = $this->input->post('order_no');
        $new_status = $this->input->post('new_status');
        $remarks = $this->input->post('remarks');


        $order = $this->db->get_where('orders', ['order_no' => $order_no])->row();

        if (!$order) {
            echo json_encode(['status' => 'error', 'msg' => 'Order not found']);
            return;
        }

        $order_id = $order->id;


        $this->db->where('id', $order_id);
        $this->db->update('orders', ['status' => $new_status]);

        // ----------------------------
        // Insert into history
        // ----------------------------
        $history = [
            'order_id'   => $order_id,
            'status'     => $new_status,
            'remarks'    => $remarks,
            'updated_by' => $_SESSION['user_id'],
            'user_role'       => $_SESSION['role'],
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->db->insert('order_status_history', $history);

        echo json_encode(['status' => 'success']);
    }


    public function getOrderHistory()
    {
        $order_id = $this->input->post('order_id');

        $this->db->select('
        o.id,
        o.order_id,
        o.updated_by,
        o.user_role,
        o.status,
        o.remarks,
        o.created_at,
        u.name as updated_by_name,
        u.email as updated_by_email,
        u.phone as updated_by_phone,
        u.role as user_actual_role
    ');
        $this->db->from('order_status_history o');
        $this->db->join('users u', 'u.id = o.updated_by', 'left');
        $this->db->where('o.order_id', $order_id);
        $this->db->order_by('o.id', 'DESC');

        $query = $this->db->get();
        echo json_encode($query->result());
    }


    public function search_advanced()
    {
        $mobile = $this->input->post('mobile');
        $customer_id = $this->input->post('customer_id');

        $this->db->select('orders.*, customers.name, customers.phone');
        $this->db->from('orders');
        $this->db->join('customers', 'customers.id = orders.customer_id');

        if (!empty($mobile)) {
            $this->db->where('customers.phone', $mobile);
        }

        if (!empty($customer_id)) {
            $this->db->where('orders.customer_id', $customer_id);
        }

        $query = $this->db->get();
        echo json_encode($query->result());
    }
}
