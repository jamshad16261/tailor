<?php
class Payment_model extends CI_Model
{



    public function saveCustomerDAO($data)
    {
        return $this->db->insert("customers", $data);
    }


    public function getPaymentsDAO()
    {
        $business_id = $_SESSION['business_id'];

        $this->db->select('o.*, c.name as customer_name');
        $this->db->from('orders as o');
        $this->db->join('customers as c', 'c.id = o.customer_id AND c.business_id = o.business_id', 'left');

        $this->db->where('o.business_id', $business_id);
        $this->db->where('o.is_deleted', 0);
        $this->db->order_by('o.id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }





    // Model: Customer_model.php (or $this->m)
    public function getPaymentListDAO($id)
    {
        return $this->db->get_where('payments', ['order_id' => $id])->result_array();
    }


    public function updateCustomerDAO($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('customers', $data);
    }


    public function deleteCustomer($id)
    {
        $this->db->where('id', $id);
        return $this->db->update('customers', ['is_deleted' => 1]);
    }
}
