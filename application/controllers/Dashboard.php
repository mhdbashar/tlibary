<?php
class Dashboard extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Book_model','Book');
        $this->load->model('Order_model','Order');
        
    }

    function index()
    {
        check_admin_login();
        $data['books_count'] = $this->Book->count_all();
        $data['orders_count'] = $this->Order->get_all_orders_count();

        $data['_view'] = 'dashboard';
        $this->load->view('layouts/main',$data);
    }
}
