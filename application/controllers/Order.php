<?php
 
class Order extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Order_model');
    } 

    /*
     * Listing of orders
     */
    function index()
    {
        check_admin_login();

        $params['limit'] = RECORDS_PER_PAGE; 
        $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        
        $config = $this->config->item('pagination');
        $config['base_url'] = site_url('order/index?');
        $config['total_rows'] = $this->Order_model->get_all_orders_count();
        $this->pagination->initialize($config);

        $data['orders'] = $this->Order_model->get_all_orders($params);
        
        $data['_view'] = 'order/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new order
     */
    function add()
    {   
        $this->load->library('form_validation');

		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('phone','Phone','required');
		$this->form_validation->set_rules('email','Email','valid_email');
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'username' => $this->input->post('username'),
				'phone' => $this->input->post('phone'),
				'email' => $this->input->post('email'),
				'create_date' => $this->input->post('create_date'),
				'order_description' => $this->input->post('order_description'),
            );
            
            $order_id = $this->Order_model->add_order($params);
            redirect('order/index');
        }
        else
        {            
            $data['_view'] = 'order/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a order
     */
    function edit($id)
    {   
        // check if the order exists before trying to edit it
        $data['order'] = $this->Order_model->get_order($id);
        
        if(isset($data['order']['id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('username','Username','required');
			$this->form_validation->set_rules('phone','Phone','required');
			$this->form_validation->set_rules('email','Email','valid_email');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'username' => $this->input->post('username'),
					'phone' => $this->input->post('phone'),
					'email' => $this->input->post('email'),
					'create_date' => $this->input->post('create_date'),
					'order_description' => $this->input->post('order_description'),
                );

                $this->Order_model->update_order($id,$params);            
                redirect('order/index');
            }
            else
            {
                $data['_view'] = 'order/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The order you are trying to edit does not exist.');
    } 

    /*
     * Deleting order
     */
    function remove($id)
    {
        $order = $this->Order_model->get_order($id);

        // check if the order exists before trying to delete it
        if(isset($order['id']))
        {
            $this->Order_model->delete_order($id);
            redirect('order/index');
        }
        else
            show_error('The order you are trying to delete does not exist.');
    }
    
}
