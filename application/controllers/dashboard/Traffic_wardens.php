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
        $data['duty_points']  =  $this->common_model->getAllData('traffic_warden_duty_point');
        $data['circles'] 	  =  $this->common_model->getAllData('traffic_warden_circles','*','',array('level'=>0));

		view('template',$data);	
	}

	/**
	 * [add traffic warden]
	 */
	public function add()
	{
		$this->form_validation->set_rules('warden_name', 'Warden Name', 'trim|required');
		$this->form_validation->set_rules('belt_no', 'Belt NO', 'trim|required');
		$this->form_validation->set_rules('designation', 'Designation', 'trim|required');
		$this->form_validation->set_rules('phone_no', 'Phone No', 'trim|required');
		$this->form_validation->set_rules('shift', 'Shift', 'trim|required');
		$this->form_validation->set_rules('str_date', 'Start', 'trim|required');
		$this->form_validation->set_rules('circle', 'Circle', 'trim|required');
		$this->form_validation->set_rules('sector', 'Sector', 'trim|required');
		$this->form_validation->set_rules('war_duty_point', 'Duty Point', 'trim|required');

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
							'duty_point'   => post('war_duty_point'),
							'Designation'  => post('designation'),
							'phone_number' => post('phone_no'),
							'shift'   	   => post('shift'),
							'start_date'   => date("Y-m-d", strtotime(post('str_date'))),
							'latitude'     => post('update_lat'),
							'longitude'    => post('update_long'),
							'circle_id'    => post('circle'),
							'sector_id'    => post('sector'),
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

        $where = array(
        				'traffic_warden_circles' => 'traffic_wardens.circle_id = traffic_warden_circles.id', 
        				'traffic_warden_circles AS a' => 'traffic_wardens.sector_id = a.id', 
        			  );

        $data['wardens'] = $this->common_model->DJoin('*,traffic_warden_circles.circle_and_sector AS circle,traffic_wardens.id AS warden_id','traffic_wardens','traffic_warden_duty_point','traffic_wardens.duty_point = traffic_warden_duty_point.id',$where);

        // pr($data['wardens']);die;

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

        $where = array(
        				'traffic_warden_circles' => 'traffic_wardens.circle_id = traffic_warden_circles.id', 
        				'traffic_warden_circles AS a' => 'traffic_wardens.sector_id = a.id', 
        			  );

        $data['warden'] = $this->common_model->DJoin('*,traffic_wardens.id AS warden_id,traffic_warden_circles.circle_and_sector AS circle, traffic_warden_duty_point.duty_point AS war_duty_point ','traffic_warden_duty_point','traffic_wardens','traffic_wardens.duty_point = traffic_warden_duty_point.id',$where,1,array('traffic_wardens.id' => $id));

        $data['circles'] = $this->common_model->getAllData('traffic_warden_circles','*','',array('level'=>0));
        $data['circles'] = $this->common_model->getAllData('traffic_warden_circles','*','',array('level'=>0));

        $data['duty_points'] =  $this->common_model->getAllData('traffic_warden_duty_point');


        $data['duty_points'] =  $this->common_model->getAllData('traffic_warden_duty_point');


        // pr($data['warden']);die;

		view('template',$data);	
	}

	public function update()
	{
		$this->form_validation->set_rules('warden_name', 'Warden Name', 'trim|required');
		$this->form_validation->set_rules('belt_no', 'Belt NO', 'trim|required');
		$this->form_validation->set_rules('designation', 'Designation', 'trim|required');
		$this->form_validation->set_rules('phone_no', 'Phone No', 'trim|required');
		$this->form_validation->set_rules('shift', 'Shift', 'trim|required');
		$this->form_validation->set_rules('str_date', 'Start', 'trim|required');
		$this->form_validation->set_rules('circle', 'Circle', 'trim|required');
		$this->form_validation->set_rules('sector', 'Sector', 'trim|required');
		$this->form_validation->set_rules('war_duty_point', 'Duty Point', 'trim|required');

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
							'duty_point'   => post('war_duty_point'),
							'Designation'  => post('designation'),
							'phone_number' => post('phone_no'),
							'shift'   	   => post('shift'),
							'start_date'   => date("Y-m-d", strtotime(post('str_date'))),
							'latitude'     => post('lat'),
							'longitude'    => post('log'),
							'circle_id'    => post('circle'),
							'sector_id'    => post('sector'),
							'image'        => $image,
							'created_at'   => date('Y-m-d H:i:s'),
							'updated_at'   => date('Y-m-d H:i:s'),
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
        $data['duty_points'] =  $this->common_model->getAllData('traffic_warden_duty_point');
        $data['circles'] = $this->common_model->getAllData('traffic_warden_circles','*','',array('level'=>0));

		view('template',$data);	
	}

	public function update_warden_place()
	{
		$this->form_validation->set_rules('shift', 'Shift', 'trim|required');
		$this->form_validation->set_rules('end_date', 'End Date', 'trim|required');
		$this->form_validation->set_rules('new_postion_date', 'New Position Date', 'trim|required');
		$this->form_validation->set_rules('circle', 'Circle', 'trim|required');
		$this->form_validation->set_rules('sector', 'Sector', 'trim|required');
		$this->form_validation->set_rules('war_duty_point', 'Duty Point', 'trim|required');

		if ($this->form_validation->run() == FALSE) 
		{
			$this->change_place();
		} 
		else 
		{
			$warden = $this->common_model->getAllData('traffic_wardens','*','1',array('id' => post('id')));

			$data = array(
							'traffic_warden_id' => post('id'),
							'circle_id' 	    => post('circle'),
							'sector_id' 		=> post('sector'),
							'duty_point'   		=> $warden->duty_point,
							'shift'   	   		=> $warden->shift,
							'start_date'   		=> $warden->start_date,
							'end_date'   		=> date("Y-m-d", strtotime(post('end_date'))),
							'latitude'     		=> $warden->latitude,
							'longitude'    		=> $warden->longitude,
							'updated_at'   		=> date('Y-m-d H:i:s'),
							'created_at'        => date('Y-m-d H:i:s')
						 );

			$this->common_model->InsertData('traffic_wardens_history',$data);


			$data = array(
							'circle_id'    => post('circle'),
							'sector_id'    => post('sector'),
							'duty_point'   => post('war_duty_point'),
							'shift'   	   => post('shift'),
							'start_date'   => date("Y-m-d", strtotime(post('new_postion_date'))),
							'latitude'     => post('update_lat'),
							'longitude'    => post('update_long'),
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

        $where = array(
        				'traffic_warden_circles' => 'traffic_wardens.circle_id = traffic_warden_circles.id', 
        				'traffic_warden_circles AS a' => 'traffic_wardens.sector_id = a.id', 
        				'traffic_warden_duty_point AS b' => 'b.id = traffic_wardens_history.duty_point', 
        			  );

        $data['wardens'] = $this->common_model->DJoin('traffic_wardens.name AS name,traffic_wardens.belt_no AS belt_no,traffic_wardens.Designation AS Designation,traffic_wardens_history.shift AS shift,traffic_wardens_history.start_date AS start_date,traffic_wardens_history.end_date AS end_date,b.duty_point AS duty_point'

        			,'traffic_wardens_history','traffic_wardens','traffic_wardens.id = traffic_wardens_history.traffic_warden_id',$where,'',array('traffic_wardens_history.traffic_warden_id' => $id));

        // pr($data['wardens']);die;

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
        $data['circles'] 	  =  $this->common_model->getAllData('traffic_warden_circles','*','',array('level'=>0));

        
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
		$this->form_validation->set_rules('circle', 'Circle', 'trim|required');
		$this->form_validation->set_rules('sector', 'Sector', 'trim|required');

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
							'circle_id'    => post('circle'),
							'sector_id'    => post('sector'),
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


		$data['get_circle'] = $this->common_model->DJoin('*,A.id AS duty_point_id','traffic_warden_duty_point AS A','traffic_warden_circles AS B','A.circle_id = B.id','',1,array('A.id' => $id));

		$data['sectors'] = $this->common_model->getAllData('traffic_warden_circles','*','',array('parent_id' => $data['get_circle']->circle_id));

		$data['get_sector'] = $this->common_model->DJoin('*','traffic_warden_duty_point AS A','traffic_warden_circles AS B','A.sector_id = B.id','',1,array('A.id' => $id));
		
        $data['circles'] 	  =  $this->common_model->getAllData('traffic_warden_circles','*','',array('level'=>0));
		
		// pr($data['get_circle']);die;

		view('template',$data);	
	}

	public function duty_point_update()
	{
		
		$data = array(
						'duty_point'   => post('duty_point'),
						'latitude'     => post('lat'),
						'longitude'    => post('long'),
						'circle_id'    => post('circle'),
						'sector_id'    => post('sector'),
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
				redirect('dashboard/Traffic_wardens/list_circle');
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
	 * [Add new Sector]
	 */
	public function add_new_sector()
	{
		$this->form_validation->set_rules('add_sector', 'Sector', 'trim|required');
		$this->form_validation->set_rules('circle', 'Circle', 'trim|required');

		if ($this->form_validation->run() == FALSE) 
		{
			$this->add_sectors();
		} 
		else 
		{
			$data = array(
							'circle_and_sector'   => post('add_sector'),
							'slug' 			      => slugify(post('add_sector')),
							'level'			      => 1,
							'parent_id'		      => post('circle'),
							'created_at'   		  => date('Y-m-d H:i:s'),
							'updated_at'   		  => date('Y-m-d H:i:s'),
						 );


			$result = $this->common_model->InsertData('traffic_warden_circles',$data);

			if ($result) 
			{
				$this->session->set_flashdata('msg','Sector Added Successfully!');
				redirect('dashboard/Traffic_wardens/list_sectors');
			} 
			
		}
	}

	/**
	 * [List All Sectors]
	 */
	public function list_sectors()
	{
		$data['title']      =  'Traffic Police | Dashboard';
        $data['heading']    =  'Traffic Wardens';
        $data['page_name']  =  'admin/traffic_wardens/sector_list';

        $query =  $this->db->query('SELECT a.circle_and_sector AS head_circle, 
        	                        a.id AS circle_id,
        	                        b.id AS sector_id,
        					        b.circle_and_sector AS sector FROM 
        										  traffic_warden_circles AS a, 
			     								  traffic_warden_circles AS b 
												  WHERE a.id = b.parent_id ');

        $data['sectors'] = $query->result();

         $data['circles']    = $this->common_model->getAllData('traffic_warden_circles','*','',array('level' => 0));

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

		$this->session->set_flashdata('msg','Sector Deleted Successfully!');
		redirect('dashboard/Traffic_wardens/list_sectors');
	}

	/**
	 * [Get circle data for edit]
	 * @param  [int] $id
	 */
	public function edit_sector($id)
	{
		// echo $id;die;
		$data['title']      =  'Traffic Police | Dashboard';
        $data['heading']    =  'Traffic Wardens';
        $data['page_name']  =  'admin/traffic_wardens/edit_sector';

        $query =  $this->db->query('SELECT a.circle_and_sector AS head_circle, 
        	                        a.id AS circle_id,
        	                        b.id AS sector_id,
        					        b.circle_and_sector AS sector FROM 
								    traffic_warden_circles AS a, 
 								    traffic_warden_circles AS b 
								    WHERE a.id = b.parent_id
								    AND b.id = '.$id.' '
	  							    );

        $data['circles'] = $this->common_model->getAllData('traffic_warden_circles','*','',array('level'=>0));

        $data['edit_sector'] = $query->row();

		view('template',$data);
	}

	/**
	 * [update_circle]
	 * @return [void] 
	 */
	public function update_sector()
	{
		$this->form_validation->set_rules('add_sector', 'Sector', 'trim|required');
		$this->form_validation->set_rules('circle', 'Circle', 'trim|required');

		if ($this->form_validation->run() == FALSE) 
		{
			$this->add_sectors();
		} 
		else 
		{
			$data = array(
							'circle_and_sector'   => post('add_sector'),
							'slug' 			      => slugify(post('add_sector')),
							'level'			      => 1,
							'parent_id'		      => post('circle'),
							'updated_at'   		  => date('Y-m-d H:i:s'),
						 );


			$result = $this->common_model->UpdateDB('traffic_warden_circles',array('id' => post('sector_id')),$data);

			if ($result) 
			{
				$this->session->set_flashdata('msg','Sector Updated Successfully!');
				redirect('dashboard/Traffic_wardens/list_sectors');
			} 
			
		}
	}

	/**
	 * [Get Cricle Related Sector]
	 * @param  [int] $id
	 * @return [void] 
	 */
	public function get_sector($id)
	{
		$data['sectors'] = $this->common_model->getAllData('traffic_warden_circles','*','',array('parent_id'=>$id));

		$this->load->view('admin/traffic_wardens/get_sector', $data);
	}

	/**
	 * get sector for duty point
	 */
	public function duty_point_sector($id)
	{
		$sectors = $this->common_model->getAllData('traffic_warden_circles','*','',array('parent_id'=>$id));

		echo '<div class="form-group">
				<label for="sector" class="col-sm-3 control-label">Sector</label>
				<div class="col-sm-6">
					<select name="sector" class="form-control">';

						foreach ($sectors as $sector):
						
						echo '<option value="'.$sector->id.'"> '.$sector->circle_and_sector.' </option>';

						endforeach;

		echo'		</select>
				</div>
			  </div>';

		// $this->load->view('admin/traffic_wardens/get_sector', $data);
	}
}

/* End of file Traffic_wardens.php */
/* Location: ./application/controllers/dashboard/Traffic_wardens.php */