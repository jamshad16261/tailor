<?php
class Order_model extends CI_Model
{



    public function saveFabricDAO($data)
    {
        return $this->db->insert("fabrics", $data);
    }


    public function getLastOrder($business_id)
    {
        return $this->db->where('business_id', $business_id)
                        ->order_by('id', 'DESC')
                        ->limit(1)
                        ->get('orders')
                        ->row();
    }


    public function getCurrentOrderItemsDAO()
    {
        $business_id = $_SESSION['business_id'];
        $customer_id = $this->input->post('customer_id');
        // Alias use kar ke join query likhte hain
        $this->db->select('oi.id, oi.order_no, oi.customer_id, oi.order_date, oi.delivery_date, oi.quantity, oi.price, oi.total_amount, c.name AS customer_name, c.phone AS customer_phone, c.address AS customer_address');
        $this->db->from('current_order_items oi'); // `oi` alias for current_order_items
        $this->db->join('customers c', 'c.id = oi.customer_id AND c.business_id = oi.business_id', 'left');  // `c` alias for customers
        $this->db->where('oi.business_id', $business_id);
        $this->db->where('oi.customer_id', $customer_id);
        $this->db->where('oi.is_deleted', 0);
        $this->db->order_by('oi.id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }


    public function getCurrentItems($business_id, $user_id)
    {
        return $this->db
            ->where('business_id', $business_id)
            ->where('user_id', $user_id)
            ->where('is_deleted', 0)
            ->get('current_order_items')
            ->result();
    }

    public function insertOrder($data)
    {
        $this->db->insert('orders', $data);
        return $this->db->insert_id();
    }

    public function insertOrderItem($data)
    {
        return $this->db->insert('order_items', $data);
    }

    public function markCurrentItemsDeleted($customer_id)
    {
        $this->db->where('customer_id', $customer_id);
        $this->db->update('current_order_items', ['is_deleted' => 1]);
    }


    public function deleteCurrentItemDAO($id)
    {
        $this->db->where('id', $id);

        return $this->db->update('current_order_items', [
            'is_deleted' => 1,
            'deleted_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function getOrderDataDAO()
    {
        $business_id = $_SESSION['business_id'];

        return $this->db
            ->select('o.id as order_id, o.order_no,o.order_date,o.delivery_date,o.total_amount, o.disc_percent, o.disc_amount,o.net_total,
        o.advance,o.balance,o.payment_mode, o.status as order_status, c.id as customer_id,c.name as customer_name, c.phone as customer_phone')
            ->from('orders o')
            ->join('customers c', 'c.id = o.customer_id AND c.business_id = o.business_id', 'inner')
            ->where('o.business_id', $business_id)
            ->where('o.is_deleted', 0)
            ->get()
            ->result();
    }

public function getOrderItemsDAO()
    {
        $business_id = $_SESSION['business_id'];
        $orderId = $this->input->post('id');

        return $this->db
            ->select('o.id as order_id,o.order_no, o.order_date, o.delivery_date, o.total_amount,o.disc_percent, o.disc_amount,
            o.net_total, o.advance, o.balance,o.payment_mode, o.status as order_status, c.id as customer_id,
            c.name as customer_name, c.phone as customer_phone, oi.id as order_item_id, oi.measurement_id,
            oi.item_type,oi.quantity,oi.delivery_date, oi.price,oi.total as item_total, oi.disc_percent as item_disc_percent,
            oi.disc_amount as item_disc_amount,oi.net_amount as item_net_amount,oi.special_instructions')
            ->from('orders o')
            ->join('customers c', 'c.id = o.customer_id AND c.business_id = o.business_id', 'inner')
            ->join('order_items oi', 'oi.order_id = o.id AND oi.business_id = o.business_id', 'inner')
            ->where('o.business_id', $business_id)
            ->where('o.is_deleted', 0)
            ->where('o.id', $orderId)
            ->get()
            ->result();
    }
}
