<?php
class Dashboard extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        
    }

    function index()
    {
        check_admin_login();

        $data['_view'] = 'dashboard';
        $this->load->view('layouts/main',$data);
    }
}
