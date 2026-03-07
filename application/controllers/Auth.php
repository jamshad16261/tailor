<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model', 'm');
    }

    public function index()
    {
        
        $data['page_title'] = 'Login';
        $this->load->view('auth/login');
    }

    // Registration Fucntion  
    public function register()
    {
        if ($this->input->post()) {
    
            // ---------- VALIDATION ----------
            $this->form_validation->set_rules('owner_name', 'Owner Name', 'required|trim');
            $this->form_validation->set_rules('business_name', 'Business Name', 'required|trim');
            $this->form_validation->set_rules('phone', 'Phone Number', 'required|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
    
            if ($this->form_validation->run() == TRUE) {
    
                // BUSINESS DATA
                $business_data = [
                    'business_name' => $this->input->post('business_name', TRUE),
                    'owner_name'    => $this->input->post('owner_name', TRUE),
                    'phone'         => $this->input->post('phone', TRUE),
                    'email'         => $this->input->post('email', TRUE),
                    'created_at'    => date('Y-m-d H:i:s')
                ];
    
                $this->db->insert('business_settings', $business_data);
                $business_id = $this->db->insert_id();
    
                // USER DATA
                $user_data = [
                    'business_id' => $business_id,
                    'name'        => $this->input->post('owner_name', TRUE),
                    'email'       => $this->input->post('email', TRUE),
                    'password'    => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                    'role'        => 'admin',
                    'status'      => 1,
                    'created_at'  => date('Y-m-d H:i:s')
                ];
    
                $this->db->insert('users', $user_data);
    
                $this->session->set_flashdata('success', 'Registration Successful. Please login.');
                redirect('Auth');
            }
        }
    
        $this->load->view('auth/register');
    }

    public function login_action()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
    
        $user = $this->m->get_user($email);
    
        if ($user && password_verify($password, $user->password)) {
    
            $this->session->set_userdata([
                'user_id' => $user->id,
                'business_id' => $user->business_id,
                'email'   => $user->email,
                'name'   => $user->name,
                'logo'       => $user->logo ?? '',
                'role'   => $user->role,
                'logged_in' => TRUE
            ]);
            
    
            if ($user->role == 'super_admin') {
                $permissions = 'ALL';
            } else {
                $permissions = $this->m->loadPermissionsByRole($user->role);
            }
    
            // permissions session me store
            $this->session->set_userdata([
                'permissions' => $permissions
            ]);
    
            $ip_address = $this->input->ip_address();
            $user_agent = $this->input->user_agent();
            if ($ip_address == '::1') {
                $ip_address = '127.0.0.1';
            }
    
            $system_name = gethostbyaddr($_SERVER['REMOTE_ADDR']);
    
            $this->load->library('user_agent');
            if ($this->agent->is_browser()) {
                $browser = $this->agent->browser() . ' ' . $this->agent->version();
            } elseif ($this->agent->is_robot()) {
                $browser = $this->agent->robot();
            } elseif ($this->agent->is_mobile()) {
                $browser = $this->agent->mobile();
            } else {
                $browser = 'Unidentified User Agent';
            }
    
            $os = $this->agent->platform();
    
            $activity = [
                'user_id' => $user->id,
                'ip_address' => $ip_address,
                'system_name' => $system_name,
                'browser' => $browser,
                'os' => $os
            ];
    
            $this->m->save_login_activity($activity);
            redirect('Home');
    
        } else {
            $this->session->set_flashdata('error', 'Invalid Email or Password');
            redirect('auth');
        }
    }



    //Function For LogOut
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }
}
