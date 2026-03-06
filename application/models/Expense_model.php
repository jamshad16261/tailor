<?php
class Expense_model extends CI_Model
{


    public function getExpenseListDAO()
    {

        $business_id = $_SESSION['business_id'];

        $this->db->select('*');
        $this->db->from('expenses');
        $this->db->where('business_id', $business_id);
        $this->db->where('is_deleted', 0);
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getExpenseByIdDAO($id)
    {
        return $this->db->get_where('expenses', ['id' => $id])->row_array();
    }

    public function deleteExpenseDAO($id)
    {
        $this->db->where('id', $id);
        return $this->db->update('expenses', [
            'is_deleted' => 1,
            'deleted_at' => date('Y-m-d H:i:s')
        ]);
    }
}
