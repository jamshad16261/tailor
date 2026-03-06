<?php
class User_model extends CI_Model
{

    public function insert_user($userData)
    {
        $this->db->insert('users', $userData);
        return $this->db->insert_id(); // return last inserted business ID
    }


    public function getUserDAO()
    {
        $business_id = $_SESSION['business_id'];
        $qry = $this->db->query("SELECT * FROM users where is_deleted = 0 and business_id = $business_id");

        return $qry->result();
    }


    public function getUserByIdDAO($id)
    {
        return $this->db
            ->where('id', $id)
            ->get('users')
            ->row();
    }


    public function updateUserDAO($id, $userData)
    {
        $this->db->where('id', $id);
        return $this->db->update('users', $userData);
    }
    public function soft_delete($id)
    {
        // Business soft delete
        $this->db->where('id', $id);
        $this->db->update('users', ['is_deleted' => 1]);

        return true;
    }
}
