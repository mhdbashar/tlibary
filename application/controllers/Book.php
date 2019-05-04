<?php
 
class Book extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Book_model');
    } 

    /*
     * Listing of books
     */
    function index()
    {

        check_admin_login();

        $params['limit'] = RECORDS_PER_PAGE; 
        $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        
        $config = $this->config->item('pagination');
        $config['base_url'] = site_url('book/index?');
        $config['total_rows'] = $this->Book_model->get_all_books_count();
        $this->pagination->initialize($config);

        $data['books'] = $this->Book_model->get_all_books($params);
        
        $data['_view'] = 'book/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new book
     */
    function add()
    {   
        check_admin_login();

        $this->load->library('form_validation');

		$this->form_validation->set_rules('category_id','Category Id','required');
		$this->form_validation->set_rules('author','Author','required');
		$this->form_validation->set_rules('publisher','Publisher','required');
		$this->form_validation->set_rules('price','Price','numeric');
		$this->form_validation->set_rules('discount','Discount','numeric');
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('ISBN','ISBN','required');
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'category_id' => $this->input->post('category_id'),
				'author' => $this->input->post('author'),
				'publisher' => $this->input->post('publisher'),
				'price' => $this->input->post('price'),
				'discount' => $this->input->post('discount'),
				'published_date' => $this->input->post('published_date'),
				'number_of_sales' => $this->input->post('number_of_sales'),
				'name' => $this->input->post('name'),
				'ISBN' => $this->input->post('ISBN'),
				'description' => $this->input->post('description'),
            );
            
            $book_id = $this->Book_model->add_book($params);
            redirect('book/index');
        }
        else
        {
			$this->load->model('Category_model');
			$data['all_categories'] = $this->Category_model->get_all_categories();
            
            $data['_view'] = 'book/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a book
     */
    function edit($id)
    {   
        check_admin_login();

        // check if the book exists before trying to edit it
        $data['book'] = $this->Book_model->get_book($id);
        
        if(isset($data['book']['id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('category_id','Category Id','required');
			$this->form_validation->set_rules('author','Author','required');
			$this->form_validation->set_rules('publisher','Publisher','required');
			$this->form_validation->set_rules('price','Price','numeric');
			$this->form_validation->set_rules('discount','Discount','numeric');
			$this->form_validation->set_rules('name','Name','required');
			$this->form_validation->set_rules('ISBN','ISBN','required');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'category_id' => $this->input->post('category_id'),
					'author' => $this->input->post('author'),
					'publisher' => $this->input->post('publisher'),
					'price' => $this->input->post('price'),
					'discount' => $this->input->post('discount'),
					'published_date' => $this->input->post('published_date'),
					'number_of_sales' => $this->input->post('number_of_sales'),
					'name' => $this->input->post('name'),
					'ISBN' => $this->input->post('ISBN'),
					'description' => $this->input->post('description'),
                );

                $this->Book_model->update_book($id,$params);            
                redirect('book/index');
            }
            else
            {
				$this->load->model('Category_model');
				$data['all_categories'] = $this->Category_model->get_all_categories();

                $data['_view'] = 'book/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The book you are trying to edit does not exist.');
    } 

    /*
     * Deleting book
     */
    function remove($id)
    {
        check_admin_login();

        $book = $this->Book_model->get_book($id);

        // check if the book exists before trying to delete it
        if(isset($book['id']))
        {
            $this->Book_model->delete_book($id);
            redirect('book/index');
        }
        else
            show_error('The book you are trying to delete does not exist.');
    }
    
}
