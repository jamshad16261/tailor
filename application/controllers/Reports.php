<?php
class Reports extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('Reports_model', 'm');
    }


    public function index()
    {
        $data['page_title'] = 'Reports';
        $this->load->view('layout/header', $data);
        $this->load->view('reports/reportView');
    }


    public function ordersReport()
    {
        $data['page_title'] = 'Orders Report';
        $this->load->view('layout/header', $data);
        $this->load->view('reports/order_report');
        $this->load->view('layout/footer');
        
    }

    public function getOrdersReport()
    {
        $from_date   = $this->input->post('from_date');
        $to_date     = $this->input->post('to_date');
        $customer_id = $this->input->post('customer_id');
    
        $data = $this->m->getOrdersReportDataDAO($from_date,$to_date,$customer_id);
    
        echo json_encode([
            'status' => true,
            'data' => $data
        ]);
    }



    public function workAssigReport()
    {
        $data['page_title'] = 'Work Assign Report';
        $this->load->view('layout/header', $data);
        $this->load->view('reports/workAssigReport');
        $this->load->view('layout/footer');
        
    }
    
    
    public function getTailorWorkReport()
    {
        $tailor_id = $this->input->post('tailor_id');
        $from_date   = $this->input->post('from_date');
        $to_date     = $this->input->post('to_date');
    
        $data = $this->m->getTailorWorkReportDAO($tailor_id,$from_date,$to_date);
    
        echo json_encode([
            'status' => true,
            'data' => $data
        ]);
    }
    

    
        public function sale_report()
    {
        $data['page_title'] = 'Sales Report';
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('reports/sale_report');
        $this->load->view('layout/footer');
        
    }
    
    public function getSalesReport()
    {
        $from_date   = $this->input->post('from_date');
        $to_date     = $this->input->post('to_date');
    
        $data = $this->m->getSalesReportDAO($from_date,$to_date);
    
        echo json_encode([
            'status' => true,
            'data' => $data
        ]);
    }
    

    public function pendingPaymentReport()
    {
        $data['page_title'] = 'Pending Payment Report';
        $this->load->view('layout/header', $data);
        $this->load->view('reports/pening_payment_report');
        $this->load->view('layout/footer');
        
    }
    
    public function getPendingPaymentReport()
    {
        $customer_id = $this->input->post('customer_id');
        $from_date   = $this->input->post('from_date');
        $to_date     = $this->input->post('to_date');
    
        $data = $this->m->getPendingPaymentReportDAO($customer_id,$from_date,$to_date);
    
        echo json_encode([
            'status' => true,
            'data' => $data
        ]);
    }

    public function tailorPerformanceReport()
    {
        $data['page_title'] = 'Tailor Performance Report Report';
        $this->load->view('layout/header', $data);
        $this->load->view('reports/tailor_performance_report');
        $this->load->view('layout/footer');
        
    }
    
    public function getTailorPerformance()
    {
        $tailor_id = $this->input->post('tailor_id');
        $from_date   = $this->input->post('from_date');
        $to_date     = $this->input->post('to_date');
    
        $data = $this->m->getTailorPerformanceDAO($tailor_id,$from_date,$to_date);
    
        echo json_encode([
            'status' => true,
            'data' => $data
        ]);
    }
}
