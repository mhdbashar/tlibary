<?php

class User extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('User_model');
    } 


    /*
     * Listing of users
     */
    function index()
    {
        check_admin_login();

        $params['limit'] = RECORDS_PER_PAGE; 
        $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        
        $config = $this->config->item('pagination');
        $config['base_url'] = site_url('user/index?');
        $config['total_rows'] = $this->User_model->get_all_users_count();
        $this->pagination->initialize($config);

        $data['users'] = $this->User_model->get_all_users($params);
        
        $data['_view'] = 'user/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new user
     */
    function add()
    {   
        // helper function
        check_admin_login();

        $this->load->library('form_validation');

		$this->form_validation->set_rules('passwd','Passwd','required|md5|max_length[200]');
		$this->form_validation->set_rules('name','Name','required|max_length[200]');
		$this->form_validation->set_rules('email','Email','required|max_length[200]|valid_email');
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'passwd' => $this->input->post('passwd'),
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
            );
            
            $user_id = $this->User_model->add_user($params);
            redirect('user/index');
        }
        else
        {            
            $data['_view'] = 'user/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a user
     */
    function edit($id)
    {   
        // check if the user exists before trying to edit it
        $data['user'] = $this->User_model->get_user($id);
        
        if(isset($data['user']['id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('passwd','Passwd','required|md5|max_length[200]');
			$this->form_validation->set_rules('name','Name','required|max_length[200]');
			$this->form_validation->set_rules('email','Email','required|max_length[200]|valid_email');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'passwd' => $this->input->post('passwd'),
					'name' => $this->input->post('name'),
					'email' => $this->input->post('email'),
                );

                $this->User_model->update_user($id,$params);            
                redirect('user/index');
            }
            else
            {
                $data['_view'] = 'user/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The user you are trying to edit does not exist.');
    } 

    /*
     * Deleting user
     */
    function remove($id)
    {
        check_admin_login();

        $user = $this->User_model->get_user($id);

        // check if the user exists before trying to delete it
        if(isset($user['id']))
        {
            $this->User_model->delete_user($id);
            redirect('user/index');
        }
        else
            show_error('The user you are trying to delete does not exist.');
    }


    // login
    public function login()
    {
        $this->load->library(array('form_validation'));   

        if (intval($this->session->userdata('is_admin_logged_in')) > 0) {
            redirect('');
            return false;
        } else {
            $this->form_validation->set_rules('Email', 'Email', 'required|trim');
            $this->form_validation->set_rules('Password', 'Password', 'required|md5|trim');

            if ($this->form_validation->run()) {

                $resultAdmin = $this->User_model->get_by_email($this->input->post('Email'));

                print_r($resultAdmin);

                if ($resultAdmin != false && $this->input->post('Password') == $resultAdmin->passwd)//login success
                {
                	//create session for the user
                    $data = array(
                        'Ad_id' => $resultAdmin->id,
                        'Ad_email' => $resultAdmin->email,
                        'Ad_name' => $resultAdmin->name,
                        'is_admin_logged_in' => 1,

                    );
                    $this->session->set_userdata($data);

                    redirect('');
                } else {
                    $this->data['result_message_fail'] = "Please check your email or password and try again";
                }
            }
            $this->data['title'] = "TLibrary | Login";
            $this->load->view('user/login', $this->data);
        }

    }

    // logout
    public function logout()
    {
        $this->session->unset_userdata('Ad_id');
        $this->session->unset_userdata('Ad_email');
        $this->session->unset_userdata('Ad_name');
        $this->session->unset_userdata('is_admin_logged_in');
        
        redirect('');
    }


    
}
