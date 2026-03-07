<?php
class Admin extends CI_Controller
{



    public function __construct()
    {
        parent::__construct();
        // Session check to ensure the user is logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('Permission_model', 'm');
    }


    public function role_permissions()
    {
        $data['page_title'] = 'Permission';
        $this->load->view('layout/header', $data);
        $data['roles'] = $this->db->get('roles')->result();
        $this->load->view('admin/role_permissions', $data);
           $this->load->view('layout/footer');
    }
    public function loadPermissions()
    {
        $role = $this->input->post('role');

        $modules = $this->m->getModules();
        $allowed = $this->m->getRolePermissions($role);

        echo '<div class="row g-3">';

        foreach ($modules as $m) {

            echo '
        <div class="col-md-3">
            <div class="border rounded p-3 h-100">

                <!-- Module Title -->
                <div class="fw-semibold text-secondary mb-2 small">
                    ' . $m->module_name . '
                </div>
<hr>
                <div class="row g-2 text-center">
        ';

            $perms = $this->m->getPermissionsByModule($m->id);

            foreach ($perms as $p) {

                $checked = in_array($p->id, $allowed) ? 'checked' : '';

                echo '
            <div class="col-6">
                <div class="form-check border rounded py-1">
                    <input class="form-check-input ms-1"
                           type="checkbox"
                           name="permissions[]"
                           value="' . $p->id . '"
                           id="perm_' . $p->id . '"
                           ' . $checked . '>

                    <label class="form-check-label small fw-medium ms-1"
                           for="perm_' . $p->id . '">
                        ' . ucfirst($p->action) . '
                    </label>
                </div>
            </div>
            ';
            }

            echo '
                </div>
            </div>
        </div>
        ';
        }

        echo '</div>';

        echo '<input type="hidden" name="role" value="' . $role . '">';
    }


    public function savePermissions()
    {
        $role = $this->input->post('role');
        $permissions = $this->input->post('permissions');

        $this->m->saveRolePermissions($role, $permissions);
        echo "Permissions Updated Successfully";
    }
}
