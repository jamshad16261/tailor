<?php
class Payment extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Session check to ensure the user is logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('Payment_model', 'm');
    }


    public function index()
    {
        $data['page_title'] = 'Add Payment';
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('payments/addPaymentView');
        $this->load->view('layout/footer');
        
        
    }
    public function showPaymets()
    {
        $data['page_title'] = 'Show Payment';
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('payments/showPaymentView');
        $this->load->view('layout/footer');
    }


    public function getOrderBalance()
    {
        $order_id = $this->input->post('order_id');
        $bId = $_SESSION['business_id'];
        $order = $this->db->query("SELECT balance FROM orders WHERE id = $order_id AND business_id = $bId AND is_deleted = 0")->row();

        echo json_encode($order);
    }


    public function savePayment()
    {
        $this->load->library('form_validation');

        // -----------------------------
        // Validation Rules
        // -----------------------------
        $this->form_validation->set_rules('order_id', 'Order', 'required');
        $this->form_validation->set_rules('payment_amount', 'Amount', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('method', 'Payment Method', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'status' => 'error',
                'errors' => [
                    'order_id' => form_error('order_id'),
                    'payment_amount' => form_error('payment_amount'),
                    'method' => form_error('method')
                ]
            ]);
            return;
        }

        // -----------------------------
        // Get POST Data
        // -----------------------------
        $order_id = $this->input->post('order_id');
        $payment_amount = $this->input->post('payment_amount');
        $method = $this->input->post('method');
        $entry_date = $this->input->post('entry_date');
        $remarks = $this->input->post('remarks');
        $bId = $_SESSION['business_id'];

        // -----------------------------
        // Get Order Info
        // -----------------------------
        $order = $this->db->get_where('orders', [
            'id' => $order_id,
            'business_id' => $bId,
            'is_deleted' => 0
        ])->row();

        if (!$order) {
            echo json_encode([
                'status' => 'error',
                'errors' => ['order_id' => 'Invalid order selected']
            ]);
            return;
        }

        if ($payment_amount > $order->balance) {
            echo json_encode([
                'status' => 'error',
                'errors' => ['payment_amount' => 'Payment amount cannot exceed balance']
            ]);
            return;
        }

        // -----------------------------
        // Insert Payment
        // -----------------------------
        $this->db->insert('payments', [
            'business_id' => $bId,
            'order_id' => $order_id,
            'amount' => $payment_amount,
            'method' => $method,
            'entry_date' => $entry_date,
            'remarks' => $remarks,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        $payment_id = $this->db->insert_id(); // last inserted payment id

        // -----------------------------
        // Update Order Balance & Status
        // -----------------------------
        $newBalance = $order->balance - $payment_amount;
        $updateData = ['balance' => $newBalance];

        $previous_status = $order->status;
        $new_status = $previous_status;

        if ($newBalance <= 0) {
            $updateData['status'] = 'paid';
            $new_status = 'paid';
        }

        $this->db->where('id', $order_id)
            ->where('business_id', $bId)
            ->update('orders', $updateData);

        // -----------------------------
        // Insert into Order History
        // -----------------------------
        $this->db->insert('order_history', [
            'order_id' => $order_id,
            'action' => 'payment',
            'payment_id' => $payment_id,
            'previous_balance' => $order->balance,
            'new_balance' => $newBalance,
            'previous_status' => $previous_status,
            'new_status' => $new_status,
            'remarks' => 'Payment of ' . $payment_amount . ' received. ' . $remarks,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        // -----------------------------
        // Return Success
        // -----------------------------
        echo json_encode(['status' => 'success']);
    }





    // Get getPayments 
    public function getPayments()
    {
        $result = $this->m->getPaymentsDAO();
        echo json_encode($result);
    }


    // Controller: Customer.php
    public function getPaymentList($id)
    {
        $data = $this->m->getPaymentListDAO($id);
        echo json_encode($data);
    }

}
