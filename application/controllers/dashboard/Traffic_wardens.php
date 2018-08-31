<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Traffic_wardens extends CI_Controller 
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
        elseif ($this->session->userdata('admin_district') != 'peshawar') 
        {
            redirect('Admin/dashboard','refresh');
        }
	}

	/**
	 * [Load Traffic Warden]
	 * @return [void]
	 */
	public function index()
	{
		$data['title']        =  'Traffic Police | Dashboard';
        $data['heading']      =  'Traffic Wardens';
        $data['page_name']    =  'admin/traffic_wardens/add_traffic_warden';
        $data['duty_points']  = $this->common_model->getAllData('traffic_warden_duty_point');


		view('template',$data);	
	}

	/**
	 * [add traffic warden]
	 */
	public function add()
	{
		$this->form_validation->set_rules('warden_name', 'Warden Name', 'trim|required');
		$this->form_validation->set_rules('belt_no', 'Belt NO', 'trim|required');
		$this->form_validation->set_rules('rank', 'Rank', 'trim|required');
		$this->form_validation->set_rules('designation', 'Designation', 'trim|required');
		$this->form_validation->set_rules('duty_point', 'Duty Point', 'trim|required');
		$this->form_validation->set_rules('phone_no', 'Phone No', 'trim|required');
		$this->form_validation->set_rules('shift', 'Shift', 'trim|required');
		$this->form_validation->set_rules('duration', 'Duration', 'trim|required');
		// $this->form_validation->set_rules('address', 'Address', 'trim|required');

		if ($this->form_validation->run() == FALSE) 
		{
			$this->index();
		} 
		else 
		{
			$config['upload_path']          = './uploads/traffic_warden_images/';
            $config['allowed_types']        = 'gif|jpg|png';
            

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image'))
            {
                $error = array('error' => $this->upload->display_errors());
                pr($error);die;
                $msg = $error['error'];
		        $this->session->set_flashdata('error',$msg);
		        redirect('dashboard/Traffic_wardens','refresh');
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());
                $image = base_url().'uploads/traffic_warden_images/'.$data['upload_data']['file_name'];
            }

			$data = array(
							'name'         => post('warden_name'),
							'belt_no' 	   => post('belt_no'),
							'duty_point'   => post('duty_point'),
							'rank'   	   => post('rank'),
							'Designation'  => post('designation'),
							'phone_number' => post('phone_no'),
							'shift'   	   => post('shift'),
							'duration'     => post('duration'),
							'latitude'     => post('lat'),
							'longitude'    => post('log'),
							// 'address'      => post('address'),
							'image'        => $image,
							'created_at'   => date('Y-m-d H:i:s'),
							'updated_at'   => date('Y-m-d H:i:s'),
						 );


			$result = $this->common_model->InsertData('traffic_wardens',$data);

			if ($result) 
			{
				$this->session->set_flashdata('msg','Traffic Warden Added Successfully!');
				redirect('dashboard/Traffic_wardens');
			} 
			
		}
	}

	/**
	 * [get all traffic wardens]
	 * @return [type] [description]
	 */
	public function show()
	{
		$data['title']      =  'Traffic Police | Dashboard';
        $data['heading']    =  'Traffic Wardens';
        $data['page_name']  =  'admin/traffic_wardens/show_wardens';

        $data['wardens'] = $this->common_model->getAllData('traffic_wardens');

		view('template',$data);	
	}

	public function traffic_warden_card($id)
	{
		$traffic_warden_card = $this->common_model->getAllData('traffic_wardens','*','1',array('id' => $id));

		echo json_encode($traffic_warden_card);
	}

	/**
	 * [delete traffic warden]
	 * @param  [int] $id 
	 */
	public function delete($id)
	{
		$this->db->where(array('id' => $id));
    	$this->db->delete('traffic_wardens');

		$this->session->set_flashdata('msg','Traffic Warden Deleted Successfully!');
		redirect('dashboard/Traffic_wardens/show');
		
	}

	/**
	 * [edit traffic warden]
	 * @param  [int] $id
	 */
	public function edit($id)
	{
		$data['title']      =  'Traffic Police | Dashboard';
        $data['heading']    =  'Traffic Wardens';
        $data['page_name']  =  'admin/traffic_wardens/edit';

        $data['warden'] = $this->common_model->getAllData('traffic_wardens','*','1',array('id' => $id));

		view('template',$data);	
	}

	public function update()
	{
		$this->form_validation->set_rules('warden_name', 'Warden Name', 'trim|required');
		$this->form_validation->set_rules('belt_no', 'Belt NO', 'trim|required');
		$this->form_validation->set_rules('rank', 'Rank', 'trim|required');
		$this->form_validation->set_rules('designation', 'Designation', 'trim|required');
		$this->form_validation->set_rules('duty_point', 'Duty Point', 'trim|required');
		$this->form_validation->set_rules('phone_no', 'Phone No', 'trim|required');
		$this->form_validation->set_rules('shift', 'Shift', 'trim|required');
		$this->form_validation->set_rules('duration', 'Duration', 'trim|required');
		// $this->form_validation->set_rules('address', 'Address', 'trim|required');

		if ($this->form_validation->run() == FALSE) 
		{
			$this->index();
		} 
		else 
		{
			if ($_FILES['image']['name'] != "") 
			{
				$config['upload_path']          = './uploads/traffic_warden_images/';
	            $config['allowed_types']        = 'gif|jpg|png';
	            

	            $this->load->library('upload', $config);

	            if (!$this->upload->do_upload('image'))
	            {
	                $error = array('error' => $this->upload->display_errors());
	                pr($error);die;
	                $msg = $error['error'];
			        $this->session->set_flashdata('error',$msg);
			        redirect('dashboard/Traffic_wardens','refresh');
	            }
	            else
	            {
	                $data = array('upload_data' => $this->upload->data());
	                $image = base_url().'uploads/traffic_warden_images/'.$data['upload_data']['file_name'];
	            }
			} 
			else {
				$image = post('old');
			}

			$data = array(
							'name'         => post('warden_name'),
							'belt_no' 	   => post('belt_no'),
							'duty_point'   => post('duty_point'),
							'rank'   	   => post('rank'),
							'Designation'  => post('designation'),
							'phone_number' => post('phone_no'),
							'shift'   	   => post('shift'),
							'duration'     => post('duration'),
							'latitude'     => post('lat'),
							'longitude'    => post('log'),
							// 'address'      => post('address'),
							'image'        => $image,
							'updated_at'   => date('Y-m-d H:i:s')
						 );

			$result = $this->common_model->UpdateDB('traffic_wardens',array('id' => post('id')),$data);

			if ($result) 
			{
				$this->session->set_flashdata('msg','Traffic Warden Updated Successfully!');
				redirect('dashboard/Traffic_wardens/show');
			}
		}	 
	}

	/**
	 * [Change Warden Place]
	 * @param  [int] $id 
	 */
	public function change_place($id)
	{
		$data['title']      =  'Traffic Police | Dashboard';
        $data['heading']    =  'Traffic Wardens';
        $data['page_name']  =  'admin/traffic_wardens/change_place';
        $data['id']			=  $id;


		view('template',$data);	
	}

	public function update_warden_place()
	{
		$this->form_validation->set_rules('duty_point', 'Duty Point', 'trim|required');
		$this->form_validation->set_rules('shift', 'Shift', 'trim|required');
		$this->form_validation->set_rules('duration', 'Duration', 'trim|required');

		if ($this->form_validation->run() == FALSE) 
		{
			$this->index();
		} 
		else 
		{
			$warden = $this->common_model->getAllData('traffic_wardens','*','1',array('id' => post('id')));

			$data = array(
							'traffic_warden_id' => post('id'),
							'duty_point'   		=> $warden->duty_point,
							'shift'   	   		=> $warden->shift,
							'duration'     		=> $warden->duration,
							'latitude'     		=> $warden->latitude,
							'longitude'    		=> $warden->longitude,
							'updated_at'   => date('Y-m-d H:i:s'),
							'created_at'   => date('Y-m-d H:i:s')
						 );

			$this->common_model->InsertData('traffic_wardens_history',$data);


			$data = array(
							'duty_point'   => post('duty_point'),
							'shift'   	   => post('shift'),
							'duration'     => post('duration'),
							'latitude'     => post('lat'),
							'longitude'    => post('log'),
							'updated_at'   => date('Y-m-d H:i:s')
						 );

			$result = $this->common_model->UpdateDB('traffic_wardens',array('id' => post('id')),$data);

			if ($result) 
			{
				$this->session->set_flashdata('msg','Traffic Warden Place Changed Successfully!');
				redirect('dashboard/Traffic_wardens/show');
			}
		}
	}

	/**
	 * [wardens_history ]
	 * @return [int]
	 */
	public function wardens_history($id)
	{
		$data['title']      =  'Traffic Police | Dashboard';
        $data['heading']    =  'Traffic Wardens';
        $data['page_name']  =  'admin/traffic_wardens/traffic_warden_history';

        $data['wardens'] = $this->common_model->DJoin('
        			traffic_wardens_history.duty_point AS history_duty_point,
        			traffic_wardens_history.shift AS history_shift,
        			traffic_wardens_history.duration AS history_duration,traffic_wardens.*'

        			,'traffic_wardens_history','traffic_wardens','traffic_wardens.id = traffic_wardens_history.traffic_warden_id','',array('traffic_wardens_history.traffic_warden_id' => $id));

		view('template',$data);
	}

	/**
	 * [traffic_wardens_map ]
	 * @return [void]
	 */
	public function traffic_wardens_map()
	{
		$data['title']      =  'Traffic Police | Dashboard';
        $data['heading']    =  'Traffic Wardens';
        $data['page_name']  =  'admin/traffic_wardens/wardens_map';

        $data['wardens'] = $this->common_model->getAllData('traffic_wardens');

        // pr($data['wardens']);die;

        
		view('template',$data);
	}

	public function duty_point()
	{
		$data['title']       =  'Traffic Police | Dashboard';
        $data['heading']     =  'Traffic Wardens';
        $data['page_name']   =  'admin/traffic_wardens/add_traffic_warden_duty_point';

        
		view('template',$data);
	}

	/**
	 * [Add Traffic Warden duty point]
	 */
	public function add_duty_point()
	{
		$this->form_validation->set_rules('duty_point', 'Duty Point', 'trim|required');
		$this->form_validation->set_rules('lat', 'Latitude', 'trim|required');
		$this->form_validation->set_rules('long', 'Longitude', 'trim|required');
		// $this->form_validation->set_rules('address', 'Address', 'trim|required');

		if ($this->form_validation->run() == FALSE) 
		{
			$this->duty_point();
		} 
		else 
		{
			$data = array(
							'duty_point'   => post('duty_point'),
							'latitude'     => post('lat'),
							'longitude'    => post('long'),
							'created_at'   => date('Y-m-d H:i:s'),
							'updated_at'   => date('Y-m-d H:i:s'),
						 );


			$result = $this->common_model->InsertData('traffic_warden_duty_point',$data);

			if ($result) 
			{
				$this->session->set_flashdata('msg','Traffic Warden Duty Point Added Successfully!');
				redirect('dashboard/Traffic_wardens/duty_point');
			} 
			
		}
	}

	/**
	 * [Duty List]
	 */
	public function duty_point_list()
	{
		$data['title']       =  'Traffic Police | Dashboard';
        $data['heading']     =  'Traffic Wardens';
        $data['page_name']   =  'admin/traffic_wardens/duty_point_list';
        $data['duty_points'] =  $this->common_model->getAllData('traffic_warden_duty_point');
        
		view('template',$data);
	}

	/**
	 * [Duty Point Delete ]
	 * @param  [int] $id
	 * @return [void]
	 */
	public function duty_point_delete($id)
	{
		$this->db->where(array('id' => $id));

    	$this->db->delete('traffic_warden_duty_point');

		$this->session->set_flashdata('msg','Duty Point Deleted Successfully!');
		redirect('dashboard/Traffic_wardens/duty_point_list');
	}

	/**
	 * [Edit Duty Point]
	 * @param  [int] $id
	 * @return [void]     
	 */
	public function duty_point_edit($id)
	{
		$data['title']      =  'Traffic Police | Dashboard';
        $data['heading']    =  'Traffic Wardens';
        $data['page_name']  =  'admin/traffic_wardens/edit_duty_point';

        $data['edit'] = $this->common_model->getAllData('traffic_warden_duty_point','*','1',array('id' => $id));

		view('template',$data);	
	}

	public function duty_point_update()
	{
		$data = array(
							'duty_point'   => post('duty_point'),
							'latitude'     => post('lat'),
							'longitude'    => post('long'),
							'created_at'   => date('Y-m-d H:i:s'),
							'updated_at'   => date('Y-m-d H:i:s'),
						 );


		$result = $this->common_model->UpdateDB('traffic_warden_duty_point',array('id',post('id')),$data);

		if ($result) 
		{
			$this->session->set_flashdata('msg','Traffic Warden Duty Point Updated Successfully!');
			redirect('dashboard/Traffic_wardens/duty_point_list');
		} 
	}

	/**
	 * [Get Warden Duty Point]
	 * @param  [int] $id 
	 * @return [void]    
	 */
	public function get_duty_point($id)
	{
		$this->db->select('*');
		$this->db->from('traffic_warden_duty_point');
		$this->db->where('id', $id);
		$query = $this->db->get();
		
		echo json_encode($query->row());
	}

	/**
	 * [Circle Form]
	 */
	public function add_circle()
	{
		$data['title']      =  'Traffic Police | Dashboard';
        $data['heading']    =  'Traffic Wardens';
        $data['page_name']  =  'admin/traffic_wardens/add_circle';

		view('template',$data);	
	}

	/**
	 * [Add new Circle]
	 */
	public function add_new_circle()
	{
		$this->form_validation->set_rules('add_circle', 'Circle', 'trim|required');

		if ($this->form_validation->run() == FALSE) 
		{
			$this->duty_point();
		} 
		else 
		{
			$data = array(
							'circle_and_sector'   => post('add_circle'),
							'slug' 			      => slugify(post('add_circle')),
							'created_at'   		  => date('Y-m-d H:i:s'),
							'updated_at'   		  => date('Y-m-d H:i:s'),
						 );


			$result = $this->common_model->InsertData('traffic_warden_circles',$data);

			if ($result) 
			{
				$this->session->set_flashdata('msg','Circle Added Successfully!');
				redirect('dashboard/Traffic_wardens/add_circle');
			} 
			
		}
	}

	/**
	 * [List All Circles]
	 */
	public function list_circle()
	{
		$data['title']      =  'Traffic Police | Dashboard';
        $data['heading']    =  'Traffic Wardens';
        $data['page_name']  =  'admin/traffic_wardens/list_circle';

        $data['circles'] = $this->common_model->getAllData('traffic_warden_circles','*','',array('level'=>0));

		view('template',$data);
	}

	/**
	 * [Delete Circle]
	 * @param  [int] $id
	 */
	public function delete_circle($id)
	{
		$this->db->where(array('id' => $id));

    	$this->db->delete('traffic_warden_circles');

		$this->session->set_flashdata('msg','Circle Deleted Successfully!');
		redirect('dashboard/Traffic_wardens/list_circle');
	}

	/**
	 * [Get circle data for edit]
	 * @param  [int] $id
	 */
	public function edit_circle($id)
	{
		$data['title']      =  'Traffic Police | Dashboard';
        $data['heading']    =  'Traffic Wardens';
        $data['page_name']  =  'admin/traffic_wardens/edit_circle';

        $data['edit'] = $this->common_model->getAllData('traffic_warden_circles','*',1,array('id'=>$id));

		view('template',$data);
	}

	/**
	 * [update_circle]
	 * @return [void] 
	 */
	public function update_circle()
	{
		$this->form_validation->set_rules('add_circle', 'Circle', 'trim|required');

		if ($this->form_validation->run() == FALSE) 
		{
			$this->duty_point();
		} 
		else 
		{
			$data = array(
							'circle_and_sector'   => post('add_circle'),
							'slug' 			      => slugify(post('add_circle')),
							'updated_at'   		  => date('Y-m-d H:i:s'),
						 );


			$result = $this->common_model->UpdateDB('traffic_warden_circles',array('id' => post('id')),$data);

			if ($result) 
			{
				$this->session->set_flashdata('msg','Circle Added Successfully!');
				redirect('dashboard/Traffic_wardens/list_circle');
			} 
			
		}
	}


	/**
	 * [Circle Form]
	 */
	public function add_sectors()
	{
		$data['title']      =  'Traffic Police | Dashboard';
        $data['heading']    =  'Traffic Wardens';
        $data['page_name']  =  'admin/traffic_wardens/add_sector';

		view('template',$data);	
	}

	/**
	 * [Add new Circle]
	 */
	public function add_new_sector()
	{
		$this->form_validation->set_rules('add_circle', 'Circle', 'trim|required');

		if ($this->form_validation->run() == FALSE) 
		{
			$this->duty_point();
		} 
		else 
		{
			$data = array(
							'circle_and_sector'   => post('add_circle'),
							'slug' 			      => slugify(post('add_circle')),
							'created_at'   		  => date('Y-m-d H:i:s'),
							'updated_at'   		  => date('Y-m-d H:i:s'),
						 );


			$result = $this->common_model->InsertData('traffic_warden_circles',$data);

			if ($result) 
			{
				$this->session->set_flashdata('msg','Circle Added Successfully!');
				redirect('dashboard/Traffic_wardens/add_circle');
			} 
			
		}
	}

	/**
	 * [List All Circles]
	 */
	public function list_sectors()
	{
		$data['title']      =  'Traffic Police | Dashboard';
        $data['heading']    =  'Traffic Wardens';
        $data['page_name']  =  'admin/traffic_wardens/list_circle';

        $data['circles'] = $this->common_model->getAllData('traffic_warden_circles','*','',array('level'=>0));

		view('template',$data);
	}

	/**
	 * [Delete Circle]
	 * @param  [int] $id
	 */
	public function delete_sector($id)
	{
		$this->db->where(array('id' => $id));

    	$this->db->delete('traffic_warden_circles');

		$this->session->set_flashdata('msg','Circle Deleted Successfully!');
		redirect('dashboard/Traffic_wardens/list_circle');
	}

	/**
	 * [Get circle data for edit]
	 * @param  [int] $id
	 */
	public function edit_sector($id)
	{
		$data['title']      =  'Traffic Police | Dashboard';
        $data['heading']    =  'Traffic Wardens';
        $data['page_name']  =  'admin/traffic_wardens/edit_circle';

        $data['edit'] = $this->common_model->getAllData('traffic_warden_circles','*',1,array('id'=>$id));

		view('template',$data);
	}

	/**
	 * [update_circle]
	 * @return [void] 
	 */
	public function update_sector()
	{
		$this->form_validation->set_rules('add_circle', 'Circle', 'trim|required');

		if ($this->form_validation->run() == FALSE) 
		{
			$this->duty_point();
		} 
		else 
		{
			$data = array(
							'circle_and_sector'   => post('add_circle'),
							'slug' 			      => slugify(post('add_circle')),
							'updated_at'   		  => date('Y-m-d H:i:s'),
						 );


			$result = $this->common_model->UpdateDB('traffic_warden_circles',array('id' => post('id')),$data);

			if ($result) 
			{
				$this->session->set_flashdata('msg','Circle Added Successfully!');
				redirect('dashboard/Traffic_wardens/list_circle');
			} 
			
		}
	}
}

/* End of file Traffic_wardens.php */
/* Location: ./application/controllers/dashboard/Traffic_wardens.php */