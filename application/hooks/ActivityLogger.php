<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ActivityLogger {

    public function log_activity()
    {
        $CI =& get_instance();

        // POST requests hi log karenge
        $post = $CI->input->post();
        if(empty($post)){
            return; // GET request ignore
        }

        $controller = $CI->router->fetch_class();
        $method = $CI->router->fetch_method();

        // Sirf CRUD actions log karenge
        $crud_methods = ['save', 'insert', 'update', 'delete', 'soft_delete', 'permanent_delete', 'saveExpense', 'order_status'];
        $is_crud = false;

        foreach($crud_methods as $m){
            if(stripos($method, $m) !== false){
                $is_crud = true;
                break;
            }
        }

        if(!$is_crud){
            return; // ignore non-CRUD methods
        }

        // session se user_id
        $user_id = 0;
        $session = $CI->session->userdata();
        if(isset($session['user_id']) && !empty($session['user_id'])){
            $user_id = $session['user_id'];
        } elseif(isset($session['id']) && !empty($session['id'])){
            $user_id = $session['id'];
        } elseif(isset($session['admin_id']) && !empty($session['admin_id'])){
            $user_id = $session['admin_id'];
        } elseif(isset($session['user']['id']) && !empty($session['user']['id'])){
            $user_id = $session['user']['id'];
        }

        // Determine action type
        $action = 'unknown';
        if(stripos($method, 'save') !== false || stripos($method, 'insert') !== false){
            $action = 'insert';
        } elseif(stripos($method, 'update') !== false){
            $action = 'update';
        } elseif(stripos($method, 'delete') !== false){
            $action = 'delete';
        }

        // Prepare log data
        $log = [
            'user_id' => $user_id,
            'action' => $action,
            'table_name' => $controller,
            'record_id' => $post['id'] ?? NULL,
            'description' => ucfirst($action).' operation in '.$controller,
            'old_data' => NULL, // remove
            'new_data' => NULL, // remove
            'ip_address' => $CI->input->ip_address(),
            'user_agent' => $CI->input->user_agent(),
            'created_at' => date('Y-m-d H:i:s')
        ];

        $CI->db->insert('activity_log', $log);
    }
}