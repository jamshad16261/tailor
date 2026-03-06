<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{

    public function create_business($data)
    {
        $this->db->insert('business_settings', $data);
        return $this->db->insert_id();
    }

    public function create_user($data)
    {
        return $this->db->insert('users', $data);
    }

    public function get_user_by_email($email)
    {
        return $this->db->get_where('users', ['email' => $email])->row();
    }

    public function get_user($username)
    {
        $this->db->where('email', $username);
        return $this->db->get('users')->row();
    }

    public function save_login_activity($data)
    {
        $this->db->insert('login_activity', $data);
    }


    public function loadPermissionsByRole($role)
{
    $this->db->select('m.module_key, p.action');
    $this->db->from('role_permissions rp');
    $this->db->join('permissions p', 'p.id = rp.permission_id');
    $this->db->join('modules m', 'm.id = p.module_id');
    $this->db->where('rp.role_key', $role);

    $result = $this->db->get()->result();

    $permissions = [];
    foreach ($result as $r) {
        $permissions[$r->module_key][] = $r->action;
    }

    return $permissions;
}




}
