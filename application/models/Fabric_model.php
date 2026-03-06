<?php
class Fabric_model extends CI_Model
{



    public function saveFabricDAO($data)
    {
        return $this->db->insert("fabrics", $data);
    }


    public function getFabricsDAO()
    {
        $business_id = $_SESSION['business_id'];

        $this->db->select('*');
        $this->db->from('fabrics');
        $this->db->where('business_id', $business_id);
        $this->db->where('is_deleted', 0);
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }




    // Model: Customer_model.php (or $this->m)
    public function getFabricsByIdDAO($id)
    {
        return $this->db->get_where('fabrics', ['id' => $id])->row_array();
    }

    public function updateFabricDAO($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('fabrics', $data);
    }


    public function deleteFabricDAO($id)
    {
        $this->db->where('id', $id);
        return $this->db->update('fabrics', ['is_deleted' => 1]);
    }
}
