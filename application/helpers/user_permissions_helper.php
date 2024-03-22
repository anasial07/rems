<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_permissions {
    function check_permission($permission) {
        $CI = &get_instance();
        $CI->load->model('dashboard_model');
        $user_id = $CI->session->userdata('userId');
        if (!$user_id) {
            return false; // No user logged in
        }
        $user_permissions = $CI->dashboard_model->get_userPermissions();
        $myPermissions=explode(',',$user_permissions);
        if (in_array($permission, $myPermissions)) {
            return true;
        } else {
            return false;
        }
    }
}


