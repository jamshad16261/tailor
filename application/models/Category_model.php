<?php
class Category_model extends CI_Model
{

    public function insert($data)
    {
        return $this->db->insert("categories", $data);
    }

    public function getCategoryDAO()
    {
        $user_id = $_SESSION['user_id'];
        $business_id = $_SESSION['business_id'];

        $qry = $this->db->query("SELECT * FROM categories WHERE is_deleted = 0 and business_id = $business_id");
        return $qry->result();
    }

    public function getCategoryByIdDAO($id)
    {
        return $this->db->get_where('categories', ['id' => $id])->row_array();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('categories', $data);
    }

    public function soft_delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->update('categories', ['is_deleted' => 1]);
    }
}
