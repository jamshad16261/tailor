<?php
class Feedback_model extends CI_Model {

    public function get_all($business_id)
    {
        $this->db->where('business_id', $business_id);
        $this->db->where('is_deleted', 0);
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('feedback')->result();
    }

    public function get_by_id($id)
    {
        return $this->db->where('id', $id)
                        ->where('is_deleted', 0)
                        ->get('feedback')
                        ->row();
    }

    public function insert($data)
    {
        return $this->db->insert('feedback', $data);
    }

    public function update($id, $data)
    {
        return $this->db->where('id', $id)
                        ->update('feedback', $data);
    }

    public function soft_delete($id)
    {
        return $this->db->where('id', $id)
                        ->update('feedback', [
                            'is_deleted' => 1,
                            'deleted_at' => date('Y-m-d H:i:s')
                        ]);
    }
}