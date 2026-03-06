<?php
class Measurement_model extends CI_Model
{



    public function saveMeasurementDAO($data)
    {
        return $this->db->insert("measurements", $data);
    }


    public function getMeasurementDAO()
    {
        $business_id = $_SESSION['business_id'];

        // Select all columns from measurement and only the name from the customer table
        $this->db->select('m.*, customers.name as customer_name');
        $this->db->from('measurements AS m');
        $this->db->join('customers', 'm.customer_id = customers.id', 'left');

        // Add conditions
        $this->db->where('m.business_id', $business_id);
        $this->db->where('m.is_deleted', 0);

        // Order by id in descending order
        $this->db->order_by('m.id', 'DESC');

        // Execute the query
        $query = $this->db->get();

        // Return the result
        return $query->result();
    }



    public function getMeasurementById($id)
    {
        return $this->db->select('m.*, c.name as customer_name')
            ->from('measurements m')
            ->join('customers c', 'c.id = m.customer_id', 'left')
            ->where('m.id', $id)
            ->get()
            ->row();
    }


    public function updateMeasurementDAO($id, $data)
    {
        // Update the measurements record in the database by ID
        $this->db->where('id', $id);
        return $this->db->update('measurements', $data);
    }


    public function deleteMeasurementDAO($id)
    {
        $this->db->where('id', $id);
        return $this->db->update('measurements', ['is_deleted' => 1]);
    }
}
