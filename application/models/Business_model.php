<?php
class Business_model extends CI_Model
{

    public function insert_business($data)
    {
        $this->db->insert('businesses', $data);
        return $this->db->insert_id(); // return last inserted business ID
    }

    // Insert User linked to Business
    public function insert_user($data)
    {
        $this->db->insert('users', $data);
        return $this->db->insert_id(); // optional, if you need user ID
    }


    public function getBusinessDAO()
    {
        $qry = $this->db->query("SELECT b.*, COUNT(u.id) AS total_users FROM businesses b
        LEFT JOIN users u ON u.business_id = b.id AND u.status = 'active'
        WHERE b.is_deleted = 0 GROUP BY b.id ORDER BY b.id DESC");

        return $qry->result();
    }


    public function getUserListDAO($business_id)
    {
        return $this->db
            ->where('business_id', $business_id)
            ->get('users')
            ->result_array();
    }


    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('businesses', $data);
    }
    public function soft_delete($id)
    {
        // Business soft delete
        $this->db->where('id', $id);
        $this->db->update('businesses', ['is_deleted' => 1]);

        return true;
    }
}
