<?php
 
class Book extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Book_model','Book');
        $this->load->model('Category_model','Category');

    } 


    // main books view
    function index()
    {

        check_admin_login();

        $data['Categories']= $this->Category->get_all_categories();
        $data['_view'] = 'book/books';
        $this->load->view('layouts/main',$data);
    }

    // prepare data
    public function ajax_list()
	{
        check_admin_login();

		$list = $this->Book->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $Book) {
			$no++;
            $row = array();
			$row[] = $Book->name;
			$row[] = $this->Category->get_category($Book->category_id)['name'];
			$row[] = $Book->ISBN;
			$row[] = $Book->author;
            $row[] = $Book->publisher;
            $row[] = $Book->price." $";
			$row[] = $Book->discount." $";            
			$row[] = $Book->description;
			$row[] = $Book->published_date;
			if($Book->photo)
				$row[] = '<a href="'.base_url('upload/'.$Book->photo).'" target="_blank"><img src="'.base_url('upload/'.$Book->photo).'" class="img-responsive" /></a>';
			else
				$row[] = '(No photo)';

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_book('."'".$Book->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_book('."'".$Book->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Book->count_all(),
						"recordsFiltered" => $this->Book->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
        check_admin_login();

		$data = $this->Book->get_by_id($id);
		$data->published_date = ($data->published_date == '0000-00-00') ? '' : $data->published_date; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
        check_admin_login();

		$this->_validate();
		
		$data = array(
				'name' => $this->input->post('name'),
				'category_id' => $this->input->post('category_id'),
				'ISBN' => $this->input->post('ISBN'),
				'author' => $this->input->post('author'),
                'publisher' => $this->input->post('publisher'),
                'price' => $this->input->post('price'),
				'description' => $this->input->post('description'),
				'discount' => $this->input->post('discount'),
                'published_date' => $this->input->post('published_date'),
			);

		if(!empty($_FILES['photo']['name']))
		{
			$upload = $this->_do_upload();
			$data['photo'] = $upload;
		}

		$insert = $this->Book->save($data);

		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{

        check_admin_login();

		$this->_validate();
		$data = array(
            'name' => $this->input->post('name'),
            'category_id' => $this->input->post('category_id'),
            'ISBN' => $this->input->post('ISBN'),
            'author' => $this->input->post('author'),
            'publisher' => $this->input->post('publisher'),
            'price' => $this->input->post('price'),
            'description' => $this->input->post('description'),
            'discount' => $this->input->post('discount'),
            'published_date' => $this->input->post('published_date'),
        );

		if($this->input->post('remove_photo')) // if remove photo checked
		{
			if(file_exists('upload/'.$this->input->post('remove_photo')) && $this->input->post('remove_photo'))
				unlink('upload/'.$this->input->post('remove_photo'));
			$data['photo'] = '';
		}

		if(!empty($_FILES['photo']['name']))
		{
			$upload = $this->_do_upload();
			
			//delete file
			$Book = $this->Book->get_by_id($this->input->post('id'));
			if(file_exists('upload/'.$Book->photo) && $Book->photo)
				unlink('upload/'.$Book->photo);

			$data['photo'] = $upload;
		}

		$this->Book->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		//delete file
		$Book = $this->Book->get_by_id($id);
		if(file_exists('upload/'.$Book->photo) && $Book->photo)
			unlink('upload/'.$Book->photo);
		
		$this->Book->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	private function _do_upload()
	{

        // https://www.codeigniter.com/user_guide/libraries/file_uploading.html
		$config['upload_path']          = 'upload/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 3000; //set max size allowed in Kilobyte
        // $config['max_width']            = 1000; // set max width image allowed
        // $config['max_height']           = 1000; // set max height allowed
        $config['file_name']            = $this->input->post('name').round(microtime(true) * 1000); //for unique name (book name + milisecond timestamp fot)

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('photo')) //upload and validate
        {
            $data['inputerror'][] = 'photo';
			$data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}

	private function _validate()
	{
        // `id`, `name`, `category_id`, `ISBN`, `author`, `publisher`, `price`, `description`, `discount`, `published_date`, `photo`

		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('name') == '')
		{
			$data['inputerror'][] = 'name';
			$data['error_string'][] = 'Book name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('ISBN') == '')
		{
			$data['inputerror'][] = 'ISBN';
			$data['error_string'][] = 'ISBN is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('author') == '')
		{
			$data['inputerror'][] = 'author';
			$data['error_string'][] = 'Book Author is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('price') == '')
		{
			$data['inputerror'][] = 'price';
			$data['error_string'][] = 'Book price is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}
