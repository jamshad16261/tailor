<?php
class Reports_model extends CI_Model
{
    public function getOrdersReportData($from_date, $to_date, $customer_id, $status)
    {
        $this->db->select("
        o.id,
        o.order_no,
        o.order_date,
        o.delivery_date,
        o.net_total,
        o.advance,
        o.balance,
        o.status,
        c.name AS customer_name
    ");

        $this->db->from('orders o');
        $this->db->join('customers c', 'c.id = o.customer_id', 'left');
        $this->db->where('o.is_deleted', 0);

        // --------------------
        // Customer Filter
        // --------------------
        if (!empty($customer_id)) {
            $this->db->where('o.customer_id', $customer_id);
        }

        // --------------------
        // Date Filters
        // --------------------
        if (!empty($from_date)) {
            $this->db->where('DATE(o.order_date) >=', $from_date);
        }

        if (!empty($to_date)) {
            $this->db->where('DATE(o.order_date) <=', $to_date);
        }

        // --------------------
        // Status Filter ⭐ (NEW)
        // --------------------
        if (!empty($status)) {
            $this->db->where('o.status', $status);
        }

        $this->db->order_by('o.order_date', 'DESC');

        $result = $this->db->get()->result_array();

        // --------------------
        // Status Badge Colors
        // --------------------
        foreach ($result as &$row) {
            switch ($row['status']) {
                case 'Pending':
                    $row['status_class'] = 'warning';
                    break;

                case 'Completed':
                    $row['status_class'] = 'success';
                    break;

                case 'Delivered':
                    $row['status_class'] = 'primary';
                    break;

                case 'Cancelled':
                    $row['status_class'] = 'danger';
                    break;

                default:
                    $row['status_class'] = 'secondary';
            }
        }

        return $result;
    }


    public function getTailorWorkReportDAO($tailor_id,$from_date,$to_date)
    {
        $business_id = $_SESSION['business_id'];
        $tailor_id = $this->input->post('tailor_id');
        $from_date = $this->input->post('from_date');
        $to_date   = $this->input->post('to_date');
        if($tailor_id > 0){
            $qry = "SELECT wa.*,t.name as tailor_name FROM tailor_work_assign AS wa,tailors AS t  WHERE wa.business_id = $business_id AND wa.business_id = t.business_id AND 
            wa.tailor_id = t.id AND wa.is_deleted = 0 AND wa.assign_date >= '$from_date' AND wa.assign_date <='$to_date' AND wa.tailor_id = $tailor_id ";
            
        }else{
            $qry = "SELECT wa.*,t.name as tailor_name FROM tailor_work_assign AS wa,tailors AS t  WHERE wa.business_id = $business_id AND wa.business_id = t.business_id AND wa.tailor_id = t.id AND wa.is_deleted = 0 
            AND wa.assign_date >= '$from_date' AND wa.assign_date <='$to_date' ";

        }
        
        return $this->db->query($qry)->result();
    }



    public function getSalesReportDAO($from_date, $to_date)
    {
        $business_id = $_SESSION['business_id'];
    
        $qry = "SELECT p.entry_date AS sale_date,COUNT(DISTINCT o.id) AS total_orders,SUM(p.amount) AS total_sales,
        FROM payments p, orders o WHERE p.order_id = o.id AND o.business_id = $business_id AND p.entry_date >= '$from_date' AND p.entry_date <= '$to_date'
        GROUP BY p.entry_date ORDER BY p.entry_date ASC";
        return $this->db->query($qry)->result();
    }


    public function getPendingPaymentReportDAO($customer_id,$from_date,$to_date)
    {
         $business_id = $_SESSION['business_id'];
        if($customer_id > 0){
        $qry = "SELECT c.name AS customer_name,o.id AS order_id, o.total_amount, IFNULL(SUM(p.amount),0) AS paid_amount, (o.total_amount - IFNULL(SUM(p.amount),0)) AS balance
        FROM orders o, customers c, payments p WHERE c.id = o.customer_id AND p.order_id = o.id AND o.business_id = $business_id GROUP BY o.id HAVING balance > 0;";
        }else{
        $qry = "SELECT c.name AS customer_name, o.id AS order_id, o.total_amount, IFNULL(SUM(p.amount),0) AS paid_amount, (o.total_amount - IFNULL(SUM(p.amount),0)) AS balance
        FROM orders o, customers c, payments p WHERE c.id = o.customer_id AND p.order_id = o.id AND o.business_id = $business_id GROUP BY o.id HAVING balance > 0;";
        }
        return $this->db->query($qry)->result();
    }


    public function getTailorPerformanceDAO($tailor_id,$from_date, $to_date)
    {
        $business_id = $_SESSION['business_id'];
        if($tailor_id > 0){
        $qry = "SELECT u.name AS tailor_name,
        (SELECT COUNT(DISTINCT ta1.order_id) FROM tailor_work_assign ta1 WHERE ta1.tailor_id = u.id AND ta1.assign_date BETWEEN '$from_date' AND '$to_date') AS total_orders,
        (SELECT COUNT(DISTINCT ta2.order_id) FROM tailor_work_assign ta2 WHERE ta2.tailor_id = u.id AND ta2.status = 'completed' AND ta2.assign_date BETWEEN '$from_date' AND '$to_date') AS delivered_orders,
        (SELECT COUNT(DISTINCT ta3.order_id) FROM tailor_work_assign ta3 WHERE ta3.tailor_id = u.id AND ta3.status != 'completed' AND ta3.assign_date BETWEEN '$from_date' AND '$to_date') AS pending_orders
        FROM users u WHERE u.business_id = $business_id AND u.role = 'tailor' AND u.id = $tailor_id";
        return $this->db->query($qry)->result();
        }else{
        $qry = "SELECT u.name AS tailor_name,
        (SELECT COUNT(DISTINCT ta1.order_id) FROM tailor_work_assign ta1 WHERE ta1.tailor_id = u.id AND ta1.assign_date BETWEEN '$from_date' AND '$to_date') AS total_orders,
        (SELECT COUNT(DISTINCT ta2.order_id) FROM tailor_work_assign ta2 WHERE ta2.tailor_id = u.id AND ta2.status = 'completed' AND ta2.assign_date BETWEEN '$from_date' AND '$to_date') AS delivered_orders,
        (SELECT COUNT(DISTINCT ta3.order_id) FROM tailor_work_assign ta3 WHERE ta3.tailor_id = u.id AND ta3.status != 'completed' AND ta3.assign_date BETWEEN '$from_date' AND '$to_date') AS pending_orders
        FROM users u WHERE u.business_id = $business_id AND u.role = 'tailor' ";
        return $this->db->query($qry)->result();            
        }
    }




}
