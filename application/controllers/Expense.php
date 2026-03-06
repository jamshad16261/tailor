<?php
class Expense extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Session check to ensure the user is logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('Expense_model', 'm');
    }


    public function index()
    {
        $data['page_title'] = 'Add Expense';
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('Expense/addExpenseView');
        $this->load->view('layout/footer');
    }
    public function showExpense()
    {
        $data['page_title'] = 'Show Expense';
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('Expense/showExpenseView');
        $this->load->view('layout/footer');
    }


    public function getOrderBalance()
    {
        $order_id = $this->input->post('order_id');
        $bId = $_SESSION['business_id'];
        $order = $this->db->query("SELECT balance FROM orders WHERE id = $order_id AND business_id = $bId AND is_deleted = 0")->row();

        echo json_encode($order);
    }

    public function saveExpense()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('amount', 'Amount', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_rules('expense_date', 'Date', 'required');
        $this->form_validation->set_rules('method', 'Method', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'status' => 'error',
                'errors' => [
                    'title' => form_error('title'),
                    'amount' => form_error('amount'),
                    'category' => form_error('category'),
                    'expense_date' => form_error('expense_date'),
                    'method' => form_error('method'),
                ]
            ]);
            return;
        }

        $this->db->insert('expenses', [
            'business_id' => $_SESSION['business_id'],
            'title' => $this->input->post('title'),
            'amount' => $this->input->post('amount'),
            'category' => $this->input->post('category'),
            'expense_date' => $this->input->post('expense_date'),
            'method' => $this->input->post('method'),
            'remarks' => $this->input->post('remarks'),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        echo json_encode(['status' => 'success']);
    }


    public function updateExpense()
    {
        $this->load->library('form_validation');

        // -----------------------------
        // Validation Rules
        // -----------------------------
        $this->form_validation->set_rules('expense_id', 'Expense', 'required|numeric');
        $this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_rules('amount', 'Amount', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('expense_date', 'Expense Date', 'required');
        $this->form_validation->set_rules('method', 'Payment Method', 'required');

        if ($this->form_validation->run() == FALSE) {

            echo json_encode([
                'status' => false,
                'errors' => [
                    'expense_id'   => form_error('expense_id'),
                    'title'        => form_error('title'),
                    'category'     => form_error('category'),
                    'amount'       => form_error('amount'),
                    'expense_date' => form_error('expense_date'),
                    'method'       => form_error('method')
                ]
            ]);
            return;
        }

        // -----------------------------
        // Get POST Data
        // -----------------------------
        $expense_id   = $this->input->post('expense_id');
        $title        = $this->input->post('title');
        $category     = $this->input->post('category');
        $amount       = $this->input->post('amount');
        $expense_date = $this->input->post('expense_date');
        $method       = $this->input->post('method');
        $remarks      = $this->input->post('remarks');
        $bId          = $_SESSION['business_id'];

        // -----------------------------
        // Check Expense Exists
        // -----------------------------
        $expense = $this->db->get_where('expenses', [
            'id'          => $expense_id,
            'business_id' => $bId,
            'is_deleted'  => 0
        ])->row();

        if (!$expense) {
            echo json_encode([
                'status' => false,
                'errors' => ['expense_id' => 'Invalid expense selected']
            ]);
            return;
        }

        // -----------------------------
        // Update Expense
        // -----------------------------
        $this->db->where('id', $expense_id)
            ->where('business_id', $bId)
            ->update('expenses', [
                'title'        => $title,
                'category'     => $category,
                'amount'       => $amount,
                'expense_date' => $expense_date,
                'method'       => $method,
                'remarks'      => $remarks
            ]);

        // -----------------------------
        // Response
        // -----------------------------
        echo json_encode([
            'status' => true
        ]);
    }





    // Get getPayments 
    public function getExpenseList()
    {
        $result = $this->m->getExpenseListDAO();
        echo json_encode($result);
    }


    // Controller: Customer.php
    public function getExpenseById($id)
    {
        $data = $this->m->getExpenseByIdDAO($id);
        echo json_encode($data);
    }

    
        public function deleteExpense()
        {
                $id = $this->input->post('id');
                if ($id) {
                        $result = $this->m->deleteExpenseDAO($id);

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
