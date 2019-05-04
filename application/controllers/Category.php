<?php

class Category extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Category_model');
    } 

    /*
     * Listing of categories
     */
    function index()
    {
        check_admin_login();

        $params['limit'] = RECORDS_PER_PAGE; 
        $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        
        $config = $this->config->item('pagination');
        $config['base_url'] = site_url('category/index?');
        $config['total_rows'] = $this->Category_model->get_all_categories_count();
        $this->pagination->initialize($config);

        $data['categories'] = $this->Category_model->get_all_categories($params);
        
        $data['_view'] = 'category/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new category
     */
    function add()
    {   
        check_admin_login();

        $this->load->library('form_validation');

		$this->form_validation->set_rules('name','Name','required|max_length[200]');
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'name' => $this->input->post('name'),
            );
            
            $category_id = $this->Category_model->add_category($params);
            redirect('category/index');
        }
        else
        {            
            $data['_view'] = 'category/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a category
     */
    function edit($id)
    {   
        check_admin_login();

        // check if the category exists before trying to edit it
        $data['category'] = $this->Category_model->get_category($id);
        
        if(isset($data['category']['id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('name','Name','required|max_length[200]');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'name' => $this->input->post('name'),
                );

                $this->Category_model->update_category($id,$params);            
                redirect('category/index');
            }
            else
            {
                $data['_view'] = 'category/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The category you are trying to edit does not exist.');
    } 

    /*
     * Deleting category
     */
    function remove($id)
    {
        check_admin_login();

        $category = $this->Category_model->get_category($id);

        // check if the category exists before trying to delete it
        if(isset($category['id']))
        {
            $this->Category_model->delete_category($id);
            redirect('category/index');
        }
        else
            show_error('The category you are trying to delete does not exist.');
    }
    
}
