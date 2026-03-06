<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function can($module, $action)
{
    $CI =& get_instance();

    if (!$CI->session->userdata('logged_in')) {
        return false;
    }

    $permissions = $CI->session->userdata('permissions');

    // Super Admin
    if ($permissions === 'ALL') {
        return true;
    }

    if (!isset($permissions[$module])) {
        return false;
    }

    return in_array($action, $permissions[$module]);
}
