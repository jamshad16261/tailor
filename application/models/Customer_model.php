<?php
class Customer_model extends CI_Model
{



    public function saveCustomerDAO($data)
    {
        return $this->db->insert("customers", $data);
    }


    public function getCustomersDAO()
    {
        $business_id = $_SESSION['business_id'];

        $this->db->select('*');
        $this->db->from('customers');
        $this->db->where('business_id', $business_id);
        $this->db->where('is_deleted', 0);
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }




    // Model: Customer_model.php (or $this->m)
    public function getCustomerByIdDAO($id)
    {
        return $this->db->get_where('customers', ['id' => $id])->row_array();
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
