<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        error_reporting(E_ALL);
		$this->load->model('Admin_model');
		$this->load->model('common_model');
        // pr($this->session->userdata());die;
    }
    
    public function index()
	{
        $admin_id = $this->session->userdata('admin_id');
        
        if($admin_id != NULL){
            redirect('admin/login');
        }
        
        $data['title'] = 'Traffic Police | Login';
        //$data['action']	   = base_url('admin/login');
		$this->load->view('admin/login',$data);
	}
    
    /***
    * Login Process
    ***/
    public function login()
	{
		$this->form_validation->set_rules('admin_username' , 'Username' , 'required|trim');
		$this->form_validation->set_rules('admin_password' , 'Password' , 'required');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        
        if ($this->input->post('login')) 
        {
            if($this->form_validation->run() == true)
		    {

    			$username = $this->input->post('admin_username');
    			$password = md5($this->input->post('admin_password'));
                
    			$result = $this->Admin_model->validate_login($username , $password);

                if($result)
                {
                    $sess_data = array(
                        
                        'username'        => $result->admin_name,
                        'admin_id'        => $result->admin_id,
                        'admin_district'  => $result->admin_district,
                    );
                    
                    $this->session->set_userdata($sess_data);
                    
                    redirect('admin/dashboard');
                }
                else
                {
                    echo"failed";
                    die;
                    $this->session->set_flashdata("danger", " <div class='alert alert-danger text-center'>User name or Password not Matched !</div>");
				    redirect('admin/login');
                }
			}
			else
			{
				//echo $username;
				$this->session->set_flashdata("danger", " <div class='alert alert-danger text-center'>You must Login First!</div>");
				redirect('admin/login');
			}
        } else {
            $data['title'] = 'Traffic Police | Login';
            $this->load->view('admin/login', $data);
        }
	}
    
    public function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata("success", " <div class='alert alert-success text-center'>You have logout successfully!</div>");
		return redirect('admin'); 
	}
    
    /**
    * Main Page COUNTS (Dashboard)
    **/
    public function dashboard()
    {
        // Prevent from Direct Access
        if (!isset($_SESSION['admin_id'])) 
        {
            redirect('admin/login');
        }
        $data['title']          =  'Traffic Police | Dashboard';
        $data['heading']        =  'Dashboard';
        $data['page_name']      =  'admin/index';

        if ($this->session->userdata('admin_district') == 'peshawar' ) 
        {
            $where = "";
        } 
        else 
        {
            $where = array( 'district' => $this->session->userdata('admin_district'));
        }


        /** 
            * Complaints Module COUNTS
        **/
        $data['all_complaints'] 	=	$this->Admin_model->get_all_complaints('complaints',$where);
        $data['completed']	        =	$this->Admin_model->completed_complaints('complaints',$where);
        $data['in_progress']        =	$this->Admin_model->in_progress_complaints('complaints',$where);
        $data['pending']            =   $this->Admin_model->pending_complaints('complaints',$where);
        $data['irrelevant']         =   $this->Admin_model->irrelevant_complaints('complaints',$where);
        $data['notunderstandable']  =	$this->Admin_model->notunderstandable_complaints('complaints',$where);
        

        /** 
            * Live Traffic Updates Module COUNTS
        **/
        $data['live_updates']   = $this->Admin_model->live_updates('route_updates', $where);
        $data['total_routes']   = $this->Admin_model->total_routes('routes');


        /**
         * Emergency Contacts Details Module Counts
         */
        
        ($this->session->userdata('admin_district') == 'peshawar') ? 

            $where_emergency = ""
            :
            $where_emergency = array( 'emergency_districts.slug' => $this->session->userdata('admin_district'));
            // pr($where_emergency);die;
            

        $data['traffic_signs']  = $this->Admin_model->traffic_signs('traffic_education');
        
        $data['total_contacts'] = $this->Admin_model->total_emergency_counts('emergency_contacts_detail',$where_emergency);
        $data['total_divisions']= $this->Admin_model->total_divisions('emergency_divisions');
        $data['total_districts']= $this->Admin_model->total_districts('emergency_districts');
        $data['rescue_records'] = $this->Admin_model->total_rescue_records('emergency_contacts_detail');
        $data['health_records'] = $this->Admin_model->total_health_records('emergency_contacts_detail');
        $data['mechanics_records'] = $this->Admin_model->total_mechanics_records('emergency_contacts_detail');
        $data['highway_records'] = $this->Admin_model->total_highway_records('emergency_contacts_detail');
        
        /** 
            * License Verification Module COUNTS
        **/

        ($this->session->userdata('admin_district') == 'peshawar') ? 

            $where_license = ""
            :
            $where_license = array( 'license_districts.slug' => $this->session->userdata('admin_district'));


        $data['license_records'] = $this->Admin_model->total_license_counts('license_verification',$where_license);
        $data['verified_licenses'] = $this->Admin_model->verified_licenses('license_verification',$where_license);
        $data['expired_licenses'] = $this->Admin_model->expired_licenses('license_verification',$where_license);


        // pr($data['total_contacts']);die;

        $this->load->view('template', $data);
    }
    
    /**
    * Traffic Education Module
    **/
    public function add_traffic_sign()
    {
        // Prevent from Direct Access
        if (!isset($_SESSION['admin_id'])) 
        {
            redirect('admin/login');
        }
        elseif ($this->session->userdata('admin_district') != 'peshawar') 
        {
            redirect('Admin/dashboard','refresh');
        }
        $data['title']    =   'Traffic Police | Traffic Education';
        $data['heading']  =   'Traffic Education';
        $data['page_name']=   'admin/traffic-education/add-traffic-education';
        $data['action']   =   base_url('admin/add_traffic_sign_process');
        //echo '<pre>';print_r($data['action']);
        //echo 'Dashboard here.';

        $this->load->view('template', $data);
    }
    
    /* Insert data in traffic_education tbl */
    public function add_traffic_sign_process()
    {

        //echo 'add_traffic_sign_process'; die;
        
        // For Image
        $config = array(
            'upload_path'   =>'uploads/traffic-education',
            'allowed_types' =>'jpg|jpeg|png|gif',
            'max_size'      =>'4040KB'
            );

        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        // End Image
        
        if($this->upload->do_upload('image')){
            $image = $this->upload->data('file_name');
        }
        else{
            $image = $this->upload->display_errors();
        }
        
        $data = array(
            'image'                  => $image,
            'image_title'            => $this->input->post('image_title'),
            'image_description_eng'  => $this->input->post('image_description_eng'),
            'image_description_urdu' => $this->input->post('image_description_urdu')
        );
        
        /* Database Insertion */
        $this->Admin_model->insert('traffic_education', $data);
        $this->session->set_flashdata('msg','Record has been Submitted Succesfully!');
		redirect('admin/view_all_signs');
       
    }
    
    public function view_all_signs()
    {
        // Prevent from Direct Access
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/login');
        }
        elseif ($this->session->userdata('admin_district') != 'peshawar') 
        {
            redirect('Admin/dashboard','refresh');
        }
        $data['title']      =   'Traffic Police | Traffic Education';
        $data['heading']    =   'Traffic Education';
        $data['page_name']  =   'admin/traffic-education/traffic-education-list';
        $data['data']	    =	$this->Admin_model->select_all_signs('traffic_education');
        //echo '<pre>';print_r($data['data']);
        //echo 'Dashboard here.';
        $this->load->view('template', $data);
    }
    
    public function edit_traffic_sign($id){
		// Prevent from Direct Access
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/login');
        }
        elseif ($this->session->userdata('admin_district') != 'peshawar') 
        {
            redirect('Admin/dashboard','refresh');
        }
        $data['id']       = $id;
        $data['title']    = 'Traffic Police | Traffic Education';
        $data['heading']  = 'Traffic Education';
        $data['page_name']= 'admin/traffic-education/edit-traffic-education';
		$data['record']   = $this->Admin_model->get_record_by_id($id);
		$data['action']   = base_url('admin/edit_process');
		 
		$this->load->view('template',$data);
	 }
	 
	 public function edit_process(){
		$id = $this->input->post('traffic_education_id');
         
        // echo $id; die;
         // For Image
        $config = array(
            'upload_path'   =>'uploads/traffic-education',
            'allowed_types' =>'jpg|jpeg|png|gif',
            'max_size'      =>'4040KB'
            );

        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        // End Image
         
        $this->db->where('traffic_education_id',$id);
        $query=$this->db->get('traffic_education');
        $chk=$query->row();
        
        if(!$this->upload->do_upload('image')){
            //$error = array('error' => $this->upload->display_errors());
            $image=$chk->image;
        }
        else{
            $image = $this->upload->data('file_name');
        }
            
        $data = array(
            'image'                  => $image,
            'image_title'            => $this->input->post('image_title'),
            'image_description_eng'  => $this->input->post('image_description_eng'),
            'image_description_urdu' => $this->input->post('image_description_urdu')
            );
		//print_r($data); die; 
		$this->Admin_model->edit($id,$data);
		$this->session->set_flashdata('msg','Record has been Updated Successfully!!');
		redirect('admin/view_all_signs');
	 }
    
    public function delete_sign($id)
    {
        $this->Admin_model->delete('traffic_education',$id);
		
		// Setting message for front end
		$this->session->set_flashdata('msg','Record has been Deleted Successfully!!');
		redirect('admin/view_all_signs');
    }
    
/************************************ Traffic Education Module END ************************************************/
    
    /**
    * Complaint Module
    **/
    public function get_complaints()
    {
        // Prevent from Direct Access
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/login');
        }

        $data['title']      =   'Traffic Police | Complaints';
        $data['heading']    =   'Complaints';
        $data['page_name']  =   'admin/complaints/complaints-list';

        //Json Complete list
        $this->load->view('template', $data);
    }
    
    public function completed_complaints()
    {
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/login');
        }
        $data['title']      =   'Traffic Police | Complaints';
        $data['heading']    =   'Complaints';
        $data['page_name']  =   'admin/complaints/completed-list';
        $this->load->view('template', $data);
    }
    
    public function inprogress_complaints()
    {
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/login');
        }
        $data['title']      =   'Traffic Police | Complaints';
        $data['heading']    =   'Complaints';
        $data['page_name']  =   'admin/complaints/inprogress-list';
        $this->load->view('template', $data);
    }

    // View For Ajax Calls :: Complaints
    public function irrelevant_complaints()
    {
        // Prevent from Direct Access
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/login');
        }
        $data['title']      =   'Traffic Police | Complaints';
        $data['heading']    =   'Irrelevant Complaints';
        $data['page_name']  =   'admin/complaints/irrelevant-list';
        $this->load->view('template', $data);
    }
    public function notUndestandable_complaints()
    {
        // Prevent from Direct Access
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/login');
        }
        $data['title']      =   'Traffic Police | Complaints';
        $data['heading']    =   'Not Understandable Complaints';
        $data['page_name']  =   'admin/complaints/notunderstandable-list';
        $this->load->view('template', $data);
    }

    // Ajax Calls For Data :: Complaints
    function complaintList()
    {
        if ($this->session->userdata('admin_district') == 'peshawar' ) 
        {
            $where = "";
        } 
        else 
        {
            $where = array( 'complaints.district' => $this->session->userdata('admin_district'));
        }

        $allComplaints      =   $this->Admin_model->get_complaints('complaints',$where);

        // Making a json from the list
        $i = 1;
        foreach ($allComplaints as $each) 
        {
            // Status 
            $Status = '';
            if($each->status == 'Completed'):
                $Status .= '<span class="label label-success">Completed</span> ';
            elseif($each->status == 'Pending'):
                $Status .= '<span class="label label-danger">Pending</span>';
            elseif($each->status == 'In Progress'):
                $Status .= '<span class="label label-warning">In Progress</span>';
            elseif($each->status == 'Irrelevant'):
                $Status .= '<span class="label" style="background:#8e44ad !important;">Irrelevant</span>';
            elseif($each->status == 'Not Understandable'):
                $Status .= '<span class="label" style="background:#8e44ad !important;">Not Understandable</span>';
            endif;

            // Action Buttons
            $Button = '<div class="btn-group"> 
                <a onclick="viewDetails('.$each->complaint_id.')" class="btn btn-success btn-xs"><i class="fa fa-eye" data-toggle="modal" data-target="#exampleModalLong"></i></a>
                <a href="admin/edit_complaint/'.$each->complaint_id.'" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"></i></a>';
            if($each->status == 'Completed'){ 
                $Button .= '<a onclick="return confirm("Are you sure you want to delete this?"");" href="admin/delete_complaint/'.$each->complaint_id.'" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>';
            } else {
                $Button .= '<a onclick="return confirm("Are you sure you want to delete this?");" href="admin/delete_complaint/'.$each->complaint_id.'" class="btn btn-danger disabled-link btn-xs"><i class="fa fa-trash-o"></i></a> </div>';
            } 

            $phone = '';
            if (!empty($each->phone_no) && $each->phone_no !="00000000000") {
                $phone = $each->phone_no;
            }
            else if($each->phone_no == "00000000000")
            {
                $phone = $each->phone;
            }
 
            $fetchAllUsers[] = array(
                '0'         => $i,
                '1'         => substr($each->description,0,80).'.....',
                '5'         => date("d M Y",strtotime($each->dated)),
                '3'         => $each->name,
                '4'         => $phone,
                '6'         => $each->complaint_type,
                '8'         => $Status,
                '7'         => $Button
            );
            $i++;
        }

        if (empty($fetchAllUsers)) {

            $fetchAllUsers[] = array(
                '0'         => 'Complaints Not Found',
                '1'         => '',
                '5'         => '',
                '3'         => '',
                '4'         => '',
                '6'         => '',
                '8'         => '',
                '7'         => ''
            );

            $output = array(
                "data" => $fetchAllUsers
           );
           echo json_encode($output);
        }
        else
        {
            $output = array(
                 "data" => $fetchAllUsers
            );
            echo json_encode($output);
        }
    }

    function inProgressComplaints()
    {
        if ($this->session->userdata('admin_district') == 'peshawar' ): 
            $where = "";
        else: 
            $where = array( 'complaints.district' => $this->session->userdata('admin_district'));
        endif;    
            
        $inProgessComplaints = $this->Admin_model->inprogress_complaints_list('complaints',$where);

        // Making a json from the list
        $i = 1;
        foreach ($inProgessComplaints as $each) {
            // Status 
            $Status = '';
            if($each->status == 'Completed'):
                $Status .= '<span class="label label-success">Completed</span> ';
            elseif($each->status == 'Pending'):
                $Status .= '<span class="label label-danger">Pending</span>';
            elseif($each->status == 'In Progress'):
                $Status .= '<span class="label label-warning">In Progress</span>';
            endif;

            // Action Buttons
            $Button = '<div class="btn-group"> 
                <a onclick="viewDetails('.$each->complaint_id.')" class="btn btn-success btn-xs"><i class="fa fa-eye" data-toggle="modal" data-target="#exampleModalLong"></i></a>
                <a href="admin/edit_complaint/'.$each->complaint_id.'" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"></i></a>';
            if($each->status == 'Completed'){ 
                $Button .= '<a onclick="return confirm("Are you sure you want to delete this?"");" href="admin/delete_complaint/'.$each->complaint_id.'" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>';
            } else {
                $Button .= '<a onclick="return confirm("Are you sure you want to delete this?");" href="admin/delete_complaint/'.$each->complaint_id.'" class="btn btn-danger disabled-link btn-xs"><i class="fa fa-trash-o"></i></a> </div>';
            } 
            $phone = '';
            if (!empty($each->phone_no) && $each->phone_no !="00000000000") {
                $phone = $each->phone_no;
            }
            else if($each->phone_no == "00000000000")
            {
                $phone = $each->phone;
            }
 
            $fetchAllUsers[] = array(
                '0'         => $i,
                '1'         => substr($each->description,0,80).'.....',
                '5'         => date("d M Y",strtotime($each->dated)),
                '3'         => $each->name,
                '4'         => $phone,
                '6'         => $each->complaint_type,
                '8'         => $Status,
                '7'         => $Button
            );
            $i++;
        }
        if (empty($fetchAllUsers)) {

            $fetchAllUsers[] = array(
                '0'         => 'Complaints Not Found',
                '1'         => '',
                '5'         => '',
                '3'         => '',
                '4'         => '',
                '6'         => '',
                '8'         => '',
                '7'         => ''
            );

            $output = array(
                "data" => $fetchAllUsers
           );
           echo json_encode($output);
        }
        else
        {
            $output = array(
                 "data" => $fetchAllUsers
            );
            echo json_encode($output);
        }
    }


    function irRelevantComplaints()
    {
        if ($this->session->userdata('admin_district') == 'peshawar' ): 
            $where = "";
        else: 
            $where = array( 'complaints.district' => $this->session->userdata('admin_district'));
        endif;   

        $inProgessComplaints      =   $this->Admin_model->irrelevant_complaints_list('complaints',$where);

        // Making a json from the list
        $i = 1;
        foreach ($inProgessComplaints as $each) {
            // Status 
            $Status = '';
            if($each->status == 'Completed'):
                $Status .= '<span class="label label-success">Completed</span> ';
            elseif($each->status == 'Pending'):
                $Status .= '<span class="label label-danger">Pending</span>';
            elseif($each->status == 'In Progress'):
                $Status .= '<span class="label label-warning">In Progress</span>';
            elseif($each->status == 'Irrelevant'):
                $Status .= '<span class="label" style="background:#8e44ad !important;">Irrelevant</span>';
            elseif($each->status == 'Not Understandable'):
                $Status .= '<span class="label" style="background:#8e44ad !important;">Not Understandable</span>';
            endif;

            // Action Buttons
            $Button = '<div class="btn-group"> 
                <a onclick="viewDetails('.$each->complaint_id.')" class="btn btn-success btn-xs"><i class="fa fa-eye" data-toggle="modal" data-target="#exampleModalLong"></i></a>
                <a href="admin/edit_complaint/'.$each->complaint_id.'" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"></i></a>';
            if($each->status == 'Completed'){ 
                $Button .= '<a onclick="return confirm("Are you sure you want to delete this?"");" href="admin/delete_complaint/'.$each->complaint_id.'" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>';
            } else {
                $Button .= '<a onclick="return confirm("Are you sure you want to delete this?");" href="admin/delete_complaint/'.$each->complaint_id.'" class="btn btn-danger disabled-link btn-xs"><i class="fa fa-trash-o"></i></a> </div>';
            } 
 
            $phone = '';
            if (!empty($each->phone_no) && $each->phone_no !="00000000000") {
                $phone = $each->phone_no;
            }
            else if($each->phone_no == "00000000000")
            {
                $phone = $each->phone;
            }
 
            $fetchAllUsers[] = array(
                '0'         => $i,
                '1'         => substr($each->description,0,80).'.....',
                '5'         => date("d M Y",strtotime($each->dated)),
                '3'         => $each->name,
                '4'         => $phone,
                '6'         => $each->complaint_type,
                '8'         => $Status,
                '7'         => $Button
            );
            $i++;
        }
        if (empty($fetchAllUsers)) {

            $fetchAllUsers[] = array(
                '0'         => 'Complaints Not Found',
                '1'         => '',
                '5'         => '',
                '3'         => '',
                '4'         => '',
                '6'         => '',
                '8'         => '',
                '7'         => ''
            );

            $output = array(
                "data" => $fetchAllUsers
           );
           echo json_encode($output);
        }
        else
        {
            $output = array(
                 "data" => $fetchAllUsers
            );
            echo json_encode($output);
        }
    }

    function notUnderstandableComplaints()
    {
        if ($this->session->userdata('admin_district') == 'peshawar' ): 
            $where = "";
        else: 
            $where = array( 'complaints.district' => $this->session->userdata('admin_district'));
        endif;  

        $inProgessComplaints = $this->Admin_model->notunderstandable_complaints_list('complaints',$where);

        // Making a json from the list
        $i = 1;
        foreach ($inProgessComplaints as $each) {
            // Status 
            $Status = '';
            if($each->status == 'Completed'):
                $Status .= '<span class="label label-success">Completed</span> ';
            elseif($each->status == 'Pending'):
                $Status .= '<span class="label label-danger">Pending</span>';
            elseif($each->status == 'In Progress'):
                $Status .= '<span class="label label-warning">In Progress</span>';
            elseif($each->status == 'Irrelevant'):
                $Status .= '<span class="label" style="background:#8e44ad !important;">Irrelevant</span>';
            elseif($each->status == 'Not Understandable'):
                $Status .= '<span class="label" style="background:#8e44ad !important;">Not Understandable</span>';
            endif;

            // Action Buttons
            $Button = '<div class="btn-group"> 
                <a onclick="viewDetails('.$each->complaint_id.')" class="btn btn-success btn-xs"><i class="fa fa-eye" data-toggle="modal" data-target="#exampleModalLong"></i></a>
                <a href="admin/edit_complaint/'.$each->complaint_id.'" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"></i></a>';
            if($each->status == 'Completed'){ 
                $Button .= '<a onclick="return confirm("Are you sure you want to delete this?"");" href="admin/delete_complaint/'.$each->complaint_id.'" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>';
            } else {
                $Button .= '<a onclick="return confirm("Are you sure you want to delete this?");" href="admin/delete_complaint/'.$each->complaint_id.'" class="btn btn-danger disabled-link btn-xs"><i class="fa fa-trash-o"></i></a> </div>';
            } 
 
            $phone = '';
            if (!empty($each->phone_no) && $each->phone_no !="00000000000") {
                $phone = $each->phone_no;
            }
            else if($each->phone_no == "00000000000")
            {
                $phone = $each->phone;
            }
 
            $fetchAllUsers[] = array(
                '0'         => $i,
                '1'         => substr($each->description,0,80).'.....',
                '5'         => date("d M Y",strtotime($each->dated)),
                '3'         => $each->name,
                '4'         => $phone,
                '6'         => $each->complaint_type,
                '8'         => $Status,
                '7'         => $Button
            );
            $i++;
        }
        if (empty($fetchAllUsers)) {

            $fetchAllUsers[] = array(
                '0'         => 'Complaints Not Found',
                '1'         => '',
                '5'         => '',
                '3'         => '',
                '4'         => '',
                '6'         => '',
                '8'         => '',
                '7'         => ''
            );

            $output = array(
                "data" => $fetchAllUsers
           );
           echo json_encode($output);
        }
        else
        {
            $output = array(
                 "data" => $fetchAllUsers
            );
            echo json_encode($output);
        }

    }

    

    function completedList()
    {
        if ($this->session->userdata('admin_district') == 'peshawar' ): 
            $where = "";
        else: 
            $where = array( 'complaints.district' => $this->session->userdata('admin_district'));
        endif;

        $completedList =   $this->Admin_model->completed_complaints_list('complaints',$where);

        // Making a json from the list
        $i = 1;
        foreach ($completedList as $each) {
            // Status 
            $Status = '';
            if($each->status == 'Completed'):
                $Status .= '<span class="label label-success">Completed</span> ';
            elseif($each->status == 'Pending'):
                $Status .= '<span class="label label-danger">Pending</span>';
            elseif($each->status == 'In Progress'):
                $Status .= '<span class="label label-warning">In Progress</span>';
            endif;

            // Action Buttons
            $Button = '<div class="btn-group"> 
                <a onclick="viewDetails('.$each->complaint_id.')" class="btn btn-success btn-xs"><i class="fa fa-eye" data-toggle="modal" data-target="#exampleModalLong"></i></a>
                <a href="admin/edit_complaint/'.$each->complaint_id.'" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"></i></a>';
            if($each->status == 'Completed'){ 
                $Button .= '<a onclick="return confirm("Are you sure you want to delete this?"");" href="admin/delete_complaint/'.$each->complaint_id.'" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>';
            } else {
                $Button .= '<a onclick="return confirm("Are you sure you want to delete this?");" href="admin/delete_complaint/'.$each->complaint_id.'" class="btn btn-danger disabled-link btn-xs"><i class="fa fa-trash-o"></i></a> </div>';
            } 
 
            $phone = '';
            if (!empty($each->phone_no) && $each->phone_no !="00000000000") {
                $phone = $each->phone_no;
            }
            else if($each->phone_no == "00000000000")
            {
                $phone = $each->phone;
            }
 
            $fetchAllUsers[] = array(
                '0'         => $i,
                '1'         => substr($each->description,0,80).'.....',
                '5'         => date("d M Y",strtotime($each->dated)),
                '3'         => $each->name,
                '4'         => $phone,
                '6'         => $each->complaint_type,
                '8'         => $Status,
                '7'         => $Button
            );
            $i++;
        }
        if (empty($fetchAllUsers)) {

            $fetchAllUsers[] = array(
                '0'         => 'Complaints Not Found',
                '1'         => '',
                '5'         => '',
                '3'         => '',
                '4'         => '',
                '6'         => '',
                '8'         => '',
                '7'         => ''
            );

            $output = array(
                "data" => $fetchAllUsers
           );
           echo json_encode($output);
        }
        else
        {
            $output = array(
                 "data" => $fetchAllUsers
            );
            echo json_encode($output);
        }
    }
    
    function pendingComplaints()
    {
        if ($this->session->userdata('admin_district') == 'peshawar' ):
            $where = "";
        else:
            $where = array( 'complaints.district' => $this->session->userdata('admin_district'));
        endif;

        $pendingComplaints   =   $this->Admin_model->pending_complaints_list('complaints',$where);

        // Making a json from the list
        $i = 1;
        foreach ($pendingComplaints as $each) {
            // Status 
            $Status = '';
            if($each->status == 'Completed'):
                $Status .= '<span class="label label-success">Completed</span> ';
            elseif($each->status == 'Pending'):
                $Status .= '<span class="label label-danger">Pending</span>';
            elseif($each->status == 'In Progress'):
                $Status .= '<span class="label label-warning">In Progress</span>';
            endif;

            // Action Buttons
            $Button = '<div class="btn-group"> 
                <a onclick="viewDetails('.$each->complaint_id.')" class="btn btn-success btn-xs"><i class="fa fa-eye" data-toggle="modal" data-target="#exampleModalLong"></i></a>
                <a href="admin/edit_complaint/'.$each->complaint_id.'" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"></i></a>';
            if($each->status == 'Completed'){ 
                $Button .= '<a onclick="return confirm("Are you sure you want to delete this?"");" href="admin/delete_complaint/'.$each->complaint_id.'" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>';
            } else {
                $Button .= '<a onclick="return confirm("Are you sure you want to delete this?");" href="admin/delete_complaint/'.$each->complaint_id.'" class="btn btn-danger disabled-link btn-xs"><i class="fa fa-trash-o"></i></a> </div>';
            } 
 
            $phone = '';
            if (!empty($each->phone_no) && $each->phone_no !="00000000000") {
                $phone = $each->phone_no;
            }
            else if($each->phone_no == "00000000000")
            {
                $phone = $each->phone;
            }
 
            $fetchAllUsers[] = array(
                '0'         => $i,
                '1'         => substr($each->description,0,80).'.....',
                '5'         => date("d M Y",strtotime($each->dated)),
                '3'         => $each->name,
                '4'         => $phone,
                '6'         => $each->complaint_type,
                '8'         => $Status,
                '7'         => $Button
            );
            $i++;
        }
        if (empty($fetchAllUsers)) {

            $fetchAllUsers[] = array(
                '0'         => 'Complaints Not Found',
                '1'         => '',
                '5'         => '',
                '3'         => '',
                '4'         => '',
                '6'         => '',
                '8'         => '',
                '7'         => ''
            );

            $output = array(
                "data" => $fetchAllUsers
           );
           echo json_encode($output);
        }
        else
        {
            $output = array(
                 "data" => $fetchAllUsers
            );
            echo json_encode($output);
        }
    }
    
    // Get Single Complete Complaint
    function getComplaintDetail()
    {
        $complaintID = $this->input->post('id');
        $this->db->where('complaint_id',$complaintID);
        $this->db
            ->select("complaint_id, latitude, longitude, description, image, video,dated, complaint_type, status, signup.name, signup.phone_no")
            ->from('complaints')
            ->join('signup', 'signup.signup_id = complaints.signup_id', 'INNER ')
            ->join('complaint_types','complaint_types.complaint_type_id = complaints.complaint_type_id', 'inner')
            ->join('complaints_status','complaints_status.complaints_status_id = complaints.complaints_status_id', 'inner');
        $select_complaints  =   $this->db->get();
        $data['complaint'] = $select_complaints->result();
        $this->load->view('admin/complaints/singleComplaint',$data);
    }

    public function pending_complaints()
    {
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/login');
        }
        $data['title']      =   'Traffic Police | Complaints';
        $data['heading']    =   'Complaints';
        $data['page_name']  =   'admin/complaints/pending-list';
        
        $this->load->view('template', $data);
    }
    public function delete_complaint($id)
    {
        $this->Admin_model->delete_complaint('complaints',$id);
		// Setting message for front end
		$this->session->set_flashdata('msg','Complaint has been Deleted Successfully!!');
		redirect('admin/get_complaints');
    }
    public function edit_complaint($id)
    {
        // Prevent from Direct Access
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/login');
        }
        $data['id']       = $id;
        $data['title']    = 'Traffic Police | Complaints';
        $data['heading']  = 'Complaints';
        $data['page_name']= 'admin/complaints/edit-complaint';
		$data['record']   = $this->Admin_model->get_record($id);
        $data['types']    = $this->Admin_model->get_complaint_types();
        $data['status']   = $this->Admin_model->get_complaint_status();
        $data['responses']   = $this->common_model->DJoin('*','complaint_response','complaints_status','complaint_response.response_status = complaints_status.complaints_status_id','',array('complaint_id' => $id));

        // pr($data['record']);die;
        
        $data['action']   = base_url('admin/complaint_process');
        
        // pr($data['responses']);die;
		 
		$this->load->view('template',$data);
    }
    public function complaint_process()
    {
        $id = $this->input->post('complaint_id');
         
        // echo $id; die;
         // For Image
        $config = array(
            'upload_path'   =>'uploads/images',
            'allowed_types' =>'jpg|jpeg|png|gif',
            'max_size'      =>'4040KB'
            );

        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        // End Image
        
        $this->db->where('complaint_id',$id);
        $query=$this->db->get('complaints');
        $chk=$query->row();
        
        if(!$this->upload->do_upload('image')){
            // upload old image, load it from database
            $image=$chk->image;
        }
        else{
            $image = $this->upload->data('file_name');
        }
         
        $data = array(
            //'complaint_type_id'      => $this->input->post('type'),
            'complaints_status_id'   => $this->input->post('status'),
           // 'latitude'               => $this->input->post('lat'),
            //'longitude'              => $this->input->post('lng'),
           // 'description'            => $this->input->post('description'),
            //'image'                  => $image,
            //'video'                  => $video
            );

        $where = array(
                        'response_status' => $this->input->post('status'),
                        'complaint_id'    => $id
                        );    

        $check_response = $this->common_model->getAllData('complaint_response','*',1,$where);
        
        if (!empty($check_response)) 
        {
            echo"";
        } 
        else {
                $array = array(
                    'complaint_id'       => $id,
                    'complaint_response' => post('response'),
                    'response_status'    => $this->input->post('status'),
                    'admin_id'           => $this->session->userdata('admin_id'),
                    'res_status' => 'pending',
                );      

                $this->Admin_model->insert('complaint_response',$array); 
        }              

		//print_r($data); die; 
		$this->Admin_model->update_complaint($id,$data);
		$this->session->set_flashdata('msg','Record has been Updated Successfully!!');
		redirect('admin/get_complaints');
    }
    
    public function map()
    {
        // Prevent from Direct Access
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/login');
        }
        elseif ($this->session->userdata('admin_district') != 'peshawar') 
        {
            redirect('Admin/dashboard','refresh');
        }
        $data['title']      =   'Traffic Police | Complaints';
        $data['heading']    =   'Complaints Heat Map';
        $data['page_name']  =   'admin/complaints/map';
        $data['action']     =   site_url().'admin/map/';

        $results = $this->Admin_model->get_complaints('complaints');
        //echo '<pre>';print_r($results);die;
        $count = 0;
		
        foreach($results as $row)
        {
            $data['latlong'][$count]['latitude'] = $row->latitude;
			$data['latlong'][$count]['longitude'] = $row->longitude;
            $data['latlong'][$count]['complaint_type'] = $row->complaint_type;
            $data['latlong'][$count]['status'] = $row->status;
			$data['latlong'][$count]['description'] = $row->description;
			$data['latlong'][$count]['image'] = $row->image;
			$data['latlong'][$count]['video'] = $row->video;
			$data['latlong'][$count]['dated'] = $row->dated;
            $count++;
        }

        $data['map']    =   $count;

        // echo '<pre>';print_r($data);
        // echo 'Map here.';
        $this->load->view('template', $data);
    }
        
    /******************************************** Complaints Module END ***************************************************/
    
    /**
    * License Verification Module
    **/
    public function get_license_list()
    {
        // Prevent from Direct Access
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/login');
        }
        elseif ($this->session->userdata('admin_district') != 'peshawar') 
        {
            redirect('Admin/dashboard','refresh');
        }
        $data['title']      =   'Traffic Police | License Verification';
        $data['heading']    =   'License Verification';
        $data['page_name']  =   'admin/license_verification/license_verification-list';
        $data['data']	    =	$this->Admin_model->select_all_records('license_verification');
        //echo '<pre>';print_r($data['data']); die;
        $this->load->view('template', $data);
    }
    
    public function add_license()
    {
        // Prevent from Direct Access
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/login');
        }
        elseif ($this->session->userdata('admin_district') != 'peshawar') 
        {
            redirect('Admin/dashboard','refresh');
        }
        $data['title']      =   'Traffic Police | License Verification';
        $data['heading']    =   'License Verification';
        $data['page_name']  =   'admin/license_verification/add-license';
        $data['lic_type']   =	$this->Admin_model->get_lic_types('license_types');
        $data['districts']  =   $this->Admin_model->get_lic_districts('license_districts');
        $data['action']	    =	base_url('admin/add_license_process');
        //echo '<pre>';print_r($data['lic_type']);
        $this->load->view('template', $data);
    }
     public function add_license_process()
     {
        $makerValue = $_POST['lic_type']; // make value
        $maker = $_POST['selected_text']; // get the selected text
        //$maker = mysql_real_escape_string($_POST['selected_text']); // get the selected text
         
        $districtValue = $_POST['district']; // make value
        $district = $_POST['select_district']; // get the selected text
        //$district = mysql_real_escape_string($_POST['select_district']); // get the selected text
         //echo $maker;die;
         
        $this->form_validation->set_rules('lic_number', 'Driving License Number', 'trim|required|max_length[12]|numeric');
        $this->form_validation->set_rules('cnic', 'Cnic', 'trim|required|max_length[15]|alpha_dash');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('father_name', 'Father Name', 'trim|required');
        $this->form_validation->set_rules('lic_type', 'License Type', 'trim|required|callback_validate_type');
        $this->form_validation->set_rules('lic_expiry_date', 'License Expiry Date', 'trim|required');
        $this->form_validation->set_rules('district', 'Select District', 'trim|required|callback_validate_district');
         
        if ($this->form_validation->run() == FALSE){
            $data['title']      =   'Traffic Police | License Verification';
            $data['heading']    =   'License Verification';
            $data['page_name']  =   'admin/license_verification/add-license';
            $data['lic_type']   =	$this->Admin_model->get_lic_types('license_types');
            $data['districts']  =   $this->Admin_model->get_lic_districts('license_districts');
            $data['action']	    =	base_url('admin/add_license_process');
            
            $this->load->view('template', $data);
        }else{
            $cnic = $this->input->post('cnic');
            
             $data = array(
                'dl_number'          => $this->input->post('lic_number'),
                'cnic'               => str_replace("-","",$cnic),
                'name'               => $this->input->post('name'),
                'father_name'        => $this->input->post('father_name'),
                'license_type'       => $maker,
                'license_expiry_date'=> $this->input->post('lic_expiry_date'),
                'district_id'        => $district,
                'lic_status'         => 1
            );
            //print_r($data);die;
            /* Database Insertion */
            $this->Admin_model->insert('license_verification', $data);
            $this->session->set_flashdata('msg','Record has been Submitted Succesfully!');
            redirect('admin/add_license');
        }
     }
    // Below function is called for validating select option field.
    function validate_type($maker)
    {
       if($maker == 0){
        $this->form_validation->set_message('validate_type', 'Please Select License Type.');
        return false;
        } else{
        // User picked something.
        return true;
        }
    }
    function validate_district($district)
    {
       if($district == 0){
        $this->form_validation->set_message('validate_district', 'Please Select District.');
        return false;
        } else{
        // User picked something.
        return true;
        }
    }
    
    public function edit_license($id)
    {
        // Prevent from Direct Access
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/login');
        }
        elseif ($this->session->userdata('admin_district') != 'peshawar') 
        {
            redirect('Admin/dashboard','refresh');
        }
        $data['id']         =   $id;
        $data['title']      =   'Traffic Police | License Verification';
        $data['heading']    =   'License Verification';
        $data['page_name']  =   'admin/license_verification/edit-license';
        $data['lic_type']	=	$this->Admin_model->get_lic_types('license_types');
        $data['districts']  =   $this->Admin_model->get_lic_districts('license_districts');
		$data['record']     =   $this->Admin_model->get_license_by_id($id);
        $data['action']	    =	base_url('admin/edit_license_process');
        //echo '<pre>';print_r($data['record']);
        $this->load->view('template', $data);
    }
    
    public function edit_license_process()
    {
        $id = $this->input->post('lic_id');
        $lic_status = $this->input->post('lic_expiry_date');
        
        /*$makerValue = $_POST['lic_type']; // make value
        $maker = mysql_escape_string($_POST['selected_text']); // get the selected text
        //echo $makerValue;die;
        $districtValue = $_POST['district']; // make value
        $district = mysql_escape_string($_POST['select_district']); // get the selected text*/
        //echo $districtValue;
        
        $this->form_validation->set_rules('lic_number', 'Driving License Number', 'trim|required|exact_length[12]|numeric');
        $this->form_validation->set_rules('cnic', 'Cnic', 'trim|required|exact_length[13]|numeric');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('father_name', 'Father Name', 'trim|required');
        //$this->form_validation->set_rules('lic_type', 'License Type', 'trim|required|callback_validate_type');
        $this->form_validation->set_rules('lic_expiry_date', 'License Expiry Date', 'trim|required');
        //$this->form_validation->set_rules('district', 'Select District', 'trim|required|callback_validate_district');
         
        if ($this->form_validation->run() == FALSE){
            $data['id']         =   $id;
            $data['title']      =   'Traffic Police | License Verification';
            $data['heading']    =   'License Verification';
            $data['page_name']  =   'admin/license_verification/edit-license';
            $data['lic_type']	=	$this->Admin_model->get_lic_types('license_types');
            $data['districts']  =   $this->Admin_model->get_lic_districts('license_districts');
            $data['record']     =   $this->Admin_model->get_license_by_id($id);
            $data['action']	    =	base_url('admin/edit_license_process');
            
            $this->load->view('template', $data);
            
        }else if(date('Y-m-d') <= $lic_status)
        {
            $data = array(
                'dl_number'             => $this->input->post('lic_number'),
                'cnic'                  => $this->input->post('cnic'),
                'name'                  => $this->input->post('name'),
                'father_name'           => $this->input->post('father_name'),
                'license_type'          => $this->input->post('lic_type'),
                'license_expiry_date'   => $this->input->post('lic_expiry_date'),
                'district_id'           => $this->input->post('district'),
                'lic_status'            => 1
                );
            //echo '<pre>';print_r($data); die;
            $this->Admin_model->update_license($id,$data);
            $this->session->set_flashdata('msg','Record has been Updated Successfully!!');
            redirect('admin/get_license_list');
        }else{
            $data = array(
                'dl_number'             => $this->input->post('lic_number'),
                'cnic'                  => $this->input->post('cnic'),
                'name'                  => $this->input->post('name'),
                'father_name'           => $this->input->post('father_name'),
                'license_type'          => $this->input->post('lic_type'),
                'license_expiry_date'   => $this->input->post('lic_expiry_date'),
                'district_id'           => $this->input->post('district'),
                'lic_status'            => 0
                );
            //print_r($data); die;
            $this->Admin_model->update_license($id,$data);
            $this->session->set_flashdata('msg','Record has been Updated Successfully!!');
            redirect('admin/get_license_list');
        }
    }
    
    public function get_lic_districts()
    {
        // Prevent from Direct Access
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/login');
        }
        elseif ($this->session->userdata('admin_district') != 'peshawar') 
        {
            redirect('Admin/dashboard','refresh');
        }
        $data['title']      =   'Traffic Police | License Verification';
        $data['heading']    =   'License Verification';
        $data['page_name']  =   'admin/license_verification/license-districts-list';
        $data['data']	    =	$this->Admin_model->districts_list('license_districts');
        //echo '<pre>';print_r($data['data']);
        $this->load->view('template', $data);
    }
    
    public function add_lic_district()
    {
        // Prevent from Direct Access
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/login');
        }
        elseif ($this->session->userdata('admin_district') != 'peshawar') 
        {
            redirect('Admin/dashboard','refresh');
        }
        $data['title']      =   'Traffic Police | License Verification';
        $data['heading']    =   'License Verification';
        $data['page_name']  =   'admin/license_verification/add-license-district';
        $data['action']	    =	base_url('admin/add_district_process');
        //echo '<pre>';print_r($data['data']);
        $this->load->view('template', $data);
    }
     public function add_district_process()
     {
        $dis = $this->input->post('name');

        if($this->Admin_model->check_dis($dis))
        {
            $this->session->set_flashdata('msg','This District already exists.');
		    redirect('Admin/add_lic_district');
        }
        else
        {
             $data = array(
                            'name'  => $this->input->post('name'),
                            'slug'  => slugify($this->input->post('name')),
                           );

            /* Database Insertion */
            $this->Admin_model->insert('license_districts', $data);
            $this->session->set_flashdata('msg','Record has been Submitted Succesfully!');
            redirect('admin/get_lic_districts');
        }
     }
    
    public function edit_lic_district($id)
    {
        // Prevent from Direct Access
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/login');
        }
        elseif ($this->session->userdata('admin_district') != 'peshawar') 
        {
            redirect('Admin/dashboard','refresh');
        }
        $data['id']         =   $id;
        $data['title']      =   'Traffic Police | License Verification';
        $data['heading']    =   'License Verification';
        $data['page_name']  =   'admin/license_verification/edit-license-district';
		$data['record']     =   $this->Admin_model->lic_district_by_id($id);
        $data['action']	    =	base_url('admin/edit_lic_district_process');
        //echo '<pre>';print_r($data['data']);
        $this->load->view('template', $data);
    }
    public function edit_lic_district_process()
    {
        $id = $this->input->post('district_id');
         
        $data = array(
            'name'   => $this->input->post('name')
            );
		
		$this->Admin_model->update_license_district($id,$data);
		$this->session->set_flashdata('msg','Record has been Updated Successfully!!');
		redirect('admin/get_lic_districts');
    }
    
    public function delete_lic_district($id)
    {
        $this->Admin_model->delete_lic_district('license_districts',$id);
		
		// Setting message for front end
		$this->session->set_flashdata('msg','Record has been Deleted Successfully!!');
		redirect('admin/get_lic_districts');
    }
    
    public function get_lic_types()
    {
        // Prevent from Direct Access
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/login');
        }
        elseif ($this->session->userdata('admin_district') != 'peshawar') 
        {
            redirect('Admin/dashboard','refresh');
        }
        $data['title']      =   'Traffic Police | License Verification';
        $data['heading']    =   'License Verification';
        $data['page_name']  =   'admin/license_verification/license-types-list';
        $data['data']	    =	$this->Admin_model->types_list('license_types');
        //echo '<pre>';print_r($data['data']);
        $this->load->view('template', $data);
    }
    
    public function add_lic_type()
    {
        // Prevent from Direct Access
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/login');
        }
        elseif ($this->session->userdata('admin_district') != 'peshawar') 
        {
            redirect('Admin/dashboard','refresh');
        }
        $data['title']      =   'Traffic Police | License Verification';
        $data['heading']    =   'License Verification';
        $data['page_name']  =   'admin/license_verification/add-license-type';
        $data['action']	    =	base_url('admin/add_type_process');
        //echo '<pre>';print_r($data['data']);
        $this->load->view('template', $data);
    }
     public function add_type_process()
     {
        $type = $this->input->post('lic_type');
        if($this->Admin_model->check_type($type))
        {
            $this->session->set_flashdata('msg','This License Type already exists. Try Another!');
		    redirect('Admin/add_lic_type');
        }else{
             $data = array(
                'license_type'  => $this->input->post('lic_type')
            );
        
        /* Database Insertion */
        $this->Admin_model->insert('license_types', $data);
        $this->session->set_flashdata('msg','Record has been Submitted Succesfully!');
		redirect('admin/get_lic_types');
        }
     }
    
    public function edit_lic_type($id)
    {
        // Prevent from Direct Access
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/login');
        }
        elseif ($this->session->userdata('admin_district') != 'peshawar') 
        {
            redirect('Admin/dashboard','refresh');
        }
        $data['id']         =   $id;
        $data['title']      =   'Traffic Police | License Verification';
        $data['heading']    =   'License Verification';
        $data['page_name']  =   'admin/license_verification/edit-license-type';
		$data['record']     =   $this->Admin_model->lic_type_by_id($id);
        $data['action']	    =	base_url('admin/edit_lic_type_process');
        //echo '<pre>';print_r($data['data']);
        $this->load->view('template', $data);
    }
    public function edit_lic_type_process()
    {
        $id = $this->input->post('type_id');
         
        $data = array(
            'license_type'   => $this->input->post('lic_type')
            );
		
		$this->Admin_model->update_license_type($id,$data);
		$this->session->set_flashdata('msg','Record has been Updated Successfully!!');
		redirect('admin/get_lic_types');
    }
    
    public function delete_lic_type($id)
    {
        $this->Admin_model->delete_lic_type('license_types',$id);
		
		// Setting message for front end
		$this->session->set_flashdata('msg','Record has been Deleted Successfully!!');
		redirect('admin/get_lic_types');
    }
    
    /************************************ License Verification Module END ***************************************************/
    
    /**
    * Live Updates Module
    **/
    public function add_route_update()
    {
        // Prevent from Direct Access
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/login');
        }
        elseif ($this->session->userdata('admin_district') != 'peshawar') 
        {
            redirect('Admin/dashboard','refresh');
        }
        $data['title']      =   'Traffic Police | Live Traffic Updates';
        $data['heading']    =   'Live Traffic Updates';
        $data['page_name']  =   'admin/live-updates/add-route-update';
        $data['route']      =   $this->Admin_model->get_route('routes');
        $data['status']     =   $this->Admin_model->get_route_status('route_status');
        $data['action']	    =	base_url('admin/update_route_status');
        
        $this->load->view('template', $data);
    }
    public function update_route_status()
    {
        $data = array(
            'route_id'          => $this->input->post('route'),
            'route_status_id'   => $this->input->post('status'),
            'updated_time'      => $this->input->post('time')
        );
        
        /* Database Insertion */
        $this->Admin_model->insert('route_updates', $data);
        $this->session->set_flashdata('msg','Record has been Submitted Succesfully!');
		redirect('admin/routes_list');
    }
    
    public function routes_list()
    {
        // Prevent from Direct Access
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/login');
        }
        elseif ($this->session->userdata('admin_district') != 'peshawar') 
        {
            redirect('Admin/dashboard','refresh');
        }
        $data['title']      =   'Traffic Police | Live Traffic Updates';
        $data['heading']    =   'Live Traffic Updates';
        $data['page_name']  =   'admin/live-updates/routes-list';
        $data['data']	    =	$this->Admin_model->select_all_routes('route_updates');
        
        $this->load->view('template', $data);
    }
    
    public function edit_route($id)
    {
        // Prevent from Direct Access
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/login');
        }
        elseif ($this->session->userdata('admin_district') != 'peshawar') 
        {
            redirect('Admin/dashboard','refresh');
        }
        $data['id']         =   $id;
        $data['title']      =   'Traffic Police | Live Traffic Updates';
        $data['heading']    =   'Live Traffic Updates';
        $data['page_name']  =   'admin/live-updates/edit-route-update';
        $data['route']      =   $this->Admin_model->get_route('routes');
        $data['route_status']=   $this->Admin_model->get_route_status('route_status');
		$data['route_record']=   $this->Admin_model->get_route_by_id($id);
        $data['action']	    =	base_url('admin/edit_route_status');

        $this->load->view('template', $data);
    }
    
    public function edit_route_status()
    {
       $id = $this->input->post('route_update_id');
         
        $data = array(
            //'route_id'         => $this->input->post('route'),
            'route_status_id'  => $this->input->post('status'),
            'updated_time'     => $this->input->post('time')
        );
		
		$this->Admin_model->update_route($id,$data);
		$this->session->set_flashdata('msg','Record has been Updated Successfully!!');
		redirect('admin/routes_list');
    }
    
    public function response_delete($id)
    {
        $this->db->where(array('id' => $id));

    	$this->db->delete('complaint_response');

		$this->session->set_flashdata('msg','Response Deleted Successfully!');
		redirect('admin/get_complaints');
    }

    public function edit_response($id)
    {
        $data['title']      =   'Traffic Police | Edit Response';
        $data['heading']    =   'Edit Response';
        $data['edit_response'] = $this->common_model->getAllData('complaint_response','*',1,array('id' => $id));

        $data['page_name']  =   'admin/complaints/edit_response';

        $this->load->view('template', $data);
    }

    public function update_response()
    {
        $data = array(
            'complaint_response'   => $this->input->post('response'),
        );
        
        /* Database Insertion */
        $this->common_model->UpdateDB('complaint_response',array('id' => $this->input->post('id')),$data);
        $this->session->set_flashdata('msg','Response has been Updated Succesfully!');
		redirect('admin/get_complaints');
    }

    function admin_reviews()
    {
        $data['title']      =   'Traffic Police | Revisions';
        $data['heading']    =   'Revisions';

        $user = array('admin_login' => 'complaint_response.admin_id = admin_login.admin_id');

        if ($this->session->userdata('admin_district') == 'peshawar' ): 
            $where = "";
        else: 
            $where = array( 'complaints.district' => $this->session->userdata('admin_district'));
        endif;

        $data['revisions']  =   $this->common_model->DJoin('*','complaint_response','complaints','complaint_response.complaint_id = complaints.complaint_id',$user,$where);

        // pr($data['revisions']);die;

        $data['page_name']  =   'admin/users/revisions';

        $this->load->view('template', $data);
    }

}