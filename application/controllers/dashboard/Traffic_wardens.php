<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Traffic_wardens extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('common_model');
	}

	/**
	 * [Load Traffic Warden]
	 * @return [void]
	 */
	public function index()
	{
		$data['title']      =  'Traffic Police | Dashboard';
        $data['heading']    =  'Add Traffic Warden';
        $data['page_name']  =  'admin/traffic_wardens/add_traffic_warden';

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
        $data['heading']    =  'All Traffic Wardens';
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
        $data['heading']    =  'Edit Traffic Wardens';
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
        $data['heading']    =  'Change Traffic Warden Place';
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
        $data['heading']    =  'Traffic Wardenss History';
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
        $data['heading']    =  'Traffic Wardens Map';
        $data['page_name']  =  'admin/traffic_wardens/wardens_map';

		view('template',$data);
	}
}

/* End of file Traffic_wardens.php */
/* Location: ./application/controllers/dashboard/Traffic_wardens.php */