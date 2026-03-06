<?php
class Tailor_model extends CI_Model
{



    public function saveTailorDAO($data)
    {
        return $this->db->insert("tailors", $data);
    }


    public function getTailorsDAO()
    {
        $business_id = $_SESSION['business_id'];

        $this->db->select('*');
        $this->db->from('tailors');
        $this->db->where('business_id', $business_id);
        $this->db->where('is_deleted', 0);
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }




    // Model: Customer_model.php (or $this->m)
    public function getTailorByIdDAO($id)
    {
        return $this->db->get_where('tailors', ['id' => $id])->row_array();
    }

    public function updateTailorDAO($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tailors', $data);
    }


    public function deleteTailorDAO($id)
    {
        $this->db->where('id', $id);
        return $this->db->update('tailors', ['is_deleted' => 1, 'deleted_at'  => date("Y-m-d H:i:s")]);
    }

    public function getAssignTaskData($business_id)
    {
        $this->db->select("twa.id,o.order_no, o.order_date, o.total_amount,o.net_total,o.advance, o.balance, o.status AS order_status,
        t.name AS tailor_name, twa.work_type,twa.qty, twa.price, twa.total, twa.status AS tailor_status, twa.remarks,twa.created_at");
        $this->db->from('tailor_work_assign twa');
        $this->db->join('orders o', 'o.id = twa.order_id', 'left');
        $this->db->join('tailors t', 't.id = twa.tailor_id', 'left');
        $this->db->where('twa.business_id', $business_id);
        $this->db->order_by('twa.created_at', 'DESC');
        return $this->db->get()->result_array();
    }

    /* GET OLD DATA */
    public function getAssignTaskById($id)
    {
        return $this->db
            ->where('id', $id)
            ->get('tailor_work_assign')
            ->row();
    }

    /* UPDATE MAIN TABLE */
    public function updateAssignTaskDAO($id, $data)
    {
        return $this->db
            ->where('id', $id)
            ->update('tailor_work_assign', $data);
    }

    /* INSERT HISTORY */
    public function insertAssignTaskHistoryDAO($data)
    {
        return $this->db->insert('tailor_work_history', $data);
    }
}
