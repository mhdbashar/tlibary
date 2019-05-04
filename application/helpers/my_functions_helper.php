<?php
defined('BASEPATH') or exit('No direct script access allowed');


/*
* Check login
*/
function check_admin_login()
{
    $CI =& get_instance();

    if (!$CI->session->userdata('is_admin_logged_in')) {
        redirect('login');
        return false;
    }
}
