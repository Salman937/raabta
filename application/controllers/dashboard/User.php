<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('common_model');

		// Prevent from Direct Access
        if (!isset($_SESSION['admin_id'])) 
        {
            redirect('admin/login');
        }
	}

	/**
	 * [load add new user page]
	 * @return [void]
	 */
	public function index()
	{
		
		$data['title']          =  'Traffic Police | Dashboard';
        $data['heading']        =  'Users';
        $data['page_name']      =  'admin/users/add_user';

        $data['districts']  =   $this->common_model->getAllData('license_districts');

		view('template',$data);		
		
	}

	/**
	 * [Add New User]
	 */
	public function add()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[30]|is_unique[admin_login.admin_name]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[50]|is_unique[admin_login.admin_email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('district', 'User District', 'trim|required');

		if ($this->form_validation->run() == FALSE) 
		{
			$this->index();
		} 
		else 
		{
			$data = array(
							'admin_name'     => post('username'),
							'admin_email'    => post('email'),
							'admin_password' => md5(post('password')),
							'admin_district' => post('district'),
						 );

			$result = $this->common_model->InsertData('admin_login',$data);

			if ($result) 
			{
				$this->session->set_flashdata('msg','User Added Successfully!');
				redirect('dashboard/User');
			} 
			
		}
	}

	/**
	 * [Show All Users]
	 * @param  string $value
	 * @return [void]
	 */
	public function show($value='')
	{
		$data['title']          =  'Traffic Police | Dashboard';
        $data['heading']        =  'Users';
        $data['page_name']      =  'admin/users/users';

        $data['users'] = $this->common_model->getAllData('admin_login','*');

		view('template',$data);	
	}

	/**
	 * [Delete a User]
	 * @param integer $id 
	 */
	public function delete($id='')
	{
		if ($id == 1) 
		{
			$this->session->set_flashdata('msg','You Can Not Delete Super Admin!');
			redirect('dashboard/User/show');
		} 
		
		$this->common_model->DeleteDB('admin_login',array('admin_id' => $id));

		$this->session->set_flashdata('msg','User Deleted Successfully!');
		redirect('dashboard/User/show');
	}

	/**
	 * [get user data for update]
	 * @param  integer $id [description]
	 * @return [void]      
	 */
	public function edit($id='')
	{
		$result = $this->common_model->getAllData('admin_login','*',1,array('admin_id' => $id));

		echo json_encode($result);
	}

	public function update()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('district', 'User District', 'trim|required');

		if ($this->form_validation->run() == FALSE) 
		{
			$this->show();
		} 
		else 
		{
			$data = array(
							'admin_name'     => post('username'),
							'admin_email'    => post('email'),
							'admin_district' => post('district'),
						 );

			$where = array('admin_id' => post('id'));

			$result = $this->common_model->UpdateDB('admin_login',$where,$data);

			if ($result) 
			{
				$this->session->set_flashdata('msg','User Updated Successfully!');
				redirect('dashboard/User/show');
			} 
			
		}
	}
}

/* End of file User.php */
/* Location: ./application/controllers/Admin/User.php */