<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends CI_Model {

    public function get_user($user_id) {
        return $this->db->get_where('users', ['id' => $user_id])->row();
    }

    public function update_profile($user_id, $data) {
        $this->db->where('id', $user_id);
        return $this->db->update('users', $data);
    }

    public function check_password($user_id, $password) {
        $user = $this->get_user($user_id);
        return password_verify($password, $user['password']);
    }

    public function update_password($user_id, $password) {
        $data = ['password' => password_hash($password, PASSWORD_DEFAULT)];
        $this->db->where('id', $user_id);
        return $this->db->update('users', $data);
    }
}