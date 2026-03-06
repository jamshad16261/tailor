<?php
class Permission_model extends CI_Model {

    public function getModules()
    {
        return $this->db->get('modules')->result();
    }

    public function getPermissionsByModule($module_id)
    {
        return $this->db->where('module_id',$module_id)
                        ->get('permissions')->result();
    }

    public function getRolePermissions($role)
    {
        $rows = $this->db->where('role_key',$role)
                         ->get('role_permissions')->result();
        return array_column($rows,'permission_id');
    }

    public function saveRolePermissions($role,$permissions)
    {
        $this->db->where('role_key',$role)->delete('role_permissions');

        if(!empty($permissions)){
            foreach($permissions as $pid){
                $this->db->insert('role_permissions',[
                    'role_key'=>$role,
                    'permission_id'=>$pid
                ]);
            }
        }
    }
}

?>