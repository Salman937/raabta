 <!-- Left side column. contains the logo and sidebar -->
 <aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo base_url(); ?>assets/images/kp-logo.png" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>Admin Panel</p>
        KP TRAFFIC POLICE
      </div>
    </div>
    
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <li class="<?= $heading == "Dashboard" ? "active" : ""; ?>">
        <a href="<?php echo base_url() . "admin/dashboard" ?>">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          <span class="pull-right-container">
            <!--<i class="fa fa-angle-left pull-right"></i>-->
          </span>
        </a>
      </li>
      
      <li class="treeview <?= $heading == "Complaints" ? "active" : ""; ?>">
        <a href="#">
          <i class="fa fa-files-o"></i><span>Complaints</span>
          <span class="pull-right-container">
           <i class="fa fa-angle-left pull-right"></i>
         </span>
       </a>
       <ul class="treeview-menu">
        <li class="<?= $this->uri->segment(2) == "get_complaints" ? "active" : ""; ?>">
          <a href="<?= base_url() . 'admin/get_complaints'; ?>"><i class="fa fa-list-alt"></i> All Complaints 
            <span class="badge pull-right">
              <?php
                  if ($this->session->userdata('admin_district') == 'peshawar') {
                      $where = "";
                  } else {
                      $where = array('complaints.district' => $this->session->userdata('admin_district'));
                  }

                  $total_complaints = $this->common_model->getAllData('complaints','COUNT(complaint_id) AS total_complaints',1,$where);

                  echo $total_complaints->total_complaints;
              ?>
            </span>
        </a>
        </li>
        <li class="<?= $this->uri->segment(2) == "pending_complaints" ? "active" : ""; ?>">
          <a href="<?= base_url() . 'admin/pending_complaints'; ?>"><i class="fa fa-exclamation-circle"></i> Pending Complaints
            <span class="badge pull-right">
              <?php
        
                $pendingComplaints = $this->Admin_model->pending_complaints_list('complaints', $where);

                echo $total = count($pendingComplaints);
              ?>
            </span>
        </a>
        </li>
        <li class="<?= $this->uri->segment(2) == "inprogress_complaints" ? "active" : ""; ?>">
          <a href="<?= base_url() . 'admin/inprogress_complaints'; ?>"><i class="fa fa-inbox"></i> In Progress Complaints
            <span class="badge pull-right">
              <?php
        
                $inProgessComplaints = $this->Admin_model->inprogress_complaints_list('complaints', $where);

                echo $total_inProgessComplaints = count($inProgessComplaints);
              ?>
            </span>
        </a>
        </li>
        <li class="<?= $this->uri->segment(2) == "completed_complaints" ? "active" : ""; ?>">
          <a href="<?= base_url() . 'admin/completed_complaints'; ?>"><i class="fa fa-check-square-o"></i> Completed Complaints
                  
            <span class="badge pull-right">
              <?php
        
                $completedList = $this->Admin_model->completed_complaints_list('complaints', $where);

                echo $total_completedList = count($completedList);
              ?>
            </span>
        </a>
        </li>
        <li class="<?= $this->uri->segment(2) == "irrelevant_complaints" ? "active" : ""; ?>">
          <a href="<?= base_url() . 'admin/irrelevant_complaints'; ?>"><i class="fa fa-check-square-o"></i> Irrelevant Complaints
            <span class="badge pull-right">
              <?php
        
                $Irrelevant = $this->Admin_model->irrelevant_complaints_list('complaints', $where);

                echo $total_Irrelevant = count($Irrelevant);
              ?>
            </span>
          </a>
        </li>
        <li class="<?= $this->uri->segment(2) == "notUndestandable_complaints" ? "active" : ""; ?>">
          <a href="<?= base_url() . 'admin/notUndestandable_complaints'; ?>"><i class="fa fa-check-square-o"></i> Not Understandable
          <span class="badge pull-right">
              <?php
                $notunderstandable = $this->Admin_model->notunderstandable_complaints_list('complaints', $where);

                echo $total_notunderstandable = count($notunderstandable);
              ?>
            </span>
          </a>
        </li>
      </ul>
    </li>



    <?php if ($this->session->userdata('admin_district') == 'peshawar') : ?>

    <li class="treeview <?= $heading == "Peshawar Complaints" ? "active" : ""; ?>">

        <a href="#">
        <i class="fa fa-list-alt"></i><span></span><span>Peshawar Complaints</span>
          <span class="pull-right-container">
           <i class="fa fa-angle-left pull-right"></i>
          </span>
       </a>

       <ul class="treeview-menu">
       <li class="<?= $this->uri->segment(2) == "all_peshawar_complaints" ? "active" : ""; ?>">
          <a href="<?= base_url() . 'admin/all_peshawar_complaints'; ?>">
            <i class="fa fa-list-alt"></i> All Complaints
            <span class="badge pull-right">
              <?php
                $where_pesh = array(
                  'district' => $this->session->userdata('admin_district')
                );
      
                $all_pesh_complaints = $this->Admin_model->get_complaints('complaints', $where_pesh);

                echo $total_all_pesh_complaints = count($all_pesh_complaints);
              ?>
            </span>
          </a>
        </li>
        <li class="<?= $this->uri->segment(2) == "peshawar_complaints" ? "active" : ""; ?>">
          <a href="<?= base_url() . 'admin/peshawar_complaints'; ?>"><i class="fa fa-list-alt"></i> Completed Complaints
          <span class="badge pull-right">
              <?php
                $where_pesh = array(
                  'district' => $this->session->userdata('admin_district')
                );
      
                $pesh_completed_complaints_list = $this->Admin_model->completed_complaints_list('complaints', $where_pesh);

                echo $total_completed_complaints_list = count($pesh_completed_complaints_list);
              ?>
            </span>
        </a>
        </li>
        <li class="<?= $this->uri->segment(2) == "peshawar_pending_complaints" ? "active" : ""; ?>">
          <a href="<?= base_url() . 'admin/peshawar_pending_complaints'; ?>"><i class="fa fa-exclamation-circle"></i> Pending Complaints
          <span class="badge pull-right">
              <?php
                $where_pesh = array(
                  'district' => $this->session->userdata('admin_district')
                );
      
                $pesh_pending_complaints_list = $this->Admin_model->pending_complaints_list('complaints', $where_pesh);

                echo $total_pesh_pending_complaints_list = count($pesh_pending_complaints_list);
              ?>
            </span>
        </a>
        </li>
        <li class="<?= $this->uri->segment(2) == "peshawar_inprogress_complaints" ? "active" : ""; ?>">
          <a href="<?= base_url() . 'admin/peshawar_inprogress_complaints'; ?>"><i class="fa fa-inbox"></i> In Progress Complaints
            <span class="badge pull-right">
              <?php
                $where_pesh = array(
                  'district' => $this->session->userdata('admin_district')
                );
      
                $pesh_inprogress_complaints_list = $this->Admin_model->inprogress_complaints_list('complaints', $where_pesh);

                echo $total_inprogress_complaints_list = count($pesh_inprogress_complaints_list);
              ?>
            </span>
        </a>
        </li>
        <li class="<?= $this->uri->segment(2) == "peshawar_irrelevant_complaints" ? "active" : ""; ?>">
          <a href="<?= base_url() . 'admin/peshawar_irrelevant_complaints'; ?>"><i class="fa fa-check-square-o"></i> Irrelevant Complaints
            <span class="badge pull-right">
              <?php
                $where_pesh = array(
                  'district' => $this->session->userdata('admin_district')
                );
      
                $pesh_irrelevant_complaints_list = $this->Admin_model->irrelevant_complaints_list('complaints', $where_pesh);

                echo $total_irrelevant_complaints_list = count($pesh_irrelevant_complaints_list);
              ?>
            </span>
        </a>
        </li>
        <li class="<?= $this->uri->segment(2) == "peshawar_not_understandable_complaints" ? "active" : ""; ?>">
          <a href="<?= base_url() . 'admin/peshawar_not_understandable_complaints'; ?>"><i class="fa fa-check-square-o"></i> Not Understandable
          <span class="badge pull-right">
              <?php
                $where_pesh = array(
                  'district' => $this->session->userdata('admin_district')
                );
      
                $pesh_notunderstandable_complaints_list = $this->Admin_model->notunderstandable_complaints_list('complaints', $where_pesh);

                echo $total_notunderstandable_complaints_list = count($pesh_notunderstandable_complaints_list);
              ?>
            </span>
        </a>
        </li>
      </ul>
    </li>

    <li class="<?= $this->uri->segment(2) == "map" ? "active" : ""; ?>">
      <a href="<?= base_url() . 'admin/map'; ?>">
        <i class="fa fa-map-o"></i> <span>Heat Map</span>
        <span class="pull-right-container">
         <!--<i class="fa fa-angle-left pull-right"></i>-->
       </span>
     </a>
    </li>
   
   <li class="treeview <?= $heading == "Live Traffic Updates" ? "active" : ""; ?>">
    <a href="#">
      <i class="fa fa-road"></i> <span>Live Traffic Updates</span>
      <span class="pull-right-container">
       <i class="fa fa-angle-left pull-right"></i>
     </span>
   </a>
   <ul class="treeview-menu">

          <li class="<?= $this->uri->segment(2) == "routes_list" ? "active" : ""; ?>">
            <a href="<?= base_url() . 'admin/routes_list'; ?>"><i class="fa fa-car"></i> All Routes Status</a>
          </li>
        </ul>
      </li>
      
      <li class="treeview <?= $heading == "License Verification" ? "active" : ""; ?>">
        <a href="#">
          <i class="fa fa-id-card-o" aria-hidden="true"></i>
          <span>License Verification</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="<?= $this->uri->segment(2) == "add_license" ? "active" : ""; ?>">
            <a href="<?= base_url() . 'admin/add_license'; ?>"><i class="fa fa-file-text"></i> Add New License</a>
          </li>
          <li class="<?= $this->uri->segment(2) == "get_license_list" ? "active" : ""; ?>">
            <a href="<?= base_url() . 'admin/get_license_list'; ?>"><i class="fa fa-list-alt"></i> License List</a>
          </li>
          <li class="<?= $this->uri->segment(2) == "add_lic_type" ? "active" : ""; ?>">
            <a href="<?= base_url() . 'admin/add_lic_type'; ?>"><i class="fa fa-bus"></i> Add New License Type</a>
          </li>
          <li class="<?= $this->uri->segment(2) == "get_lic_types" ? "active" : ""; ?>">
            <a href="<?= base_url() . 'admin/get_lic_types'; ?>"><i class="fa fa-file-text-o"></i> License Types List</a>
          </li>
          <li class="<?= $this->uri->segment(2) == "add_lic_district" ? "active" : ""; ?>">
            <a href="<?= base_url() . 'admin/add_lic_district'; ?>"><i class="fa fa-street-view"></i> Add New District</a>
          </li>
          <li class="<?= $this->uri->segment(2) == "get_lic_districts" ? "active" : ""; ?>">
            <a href="<?= base_url() . 'admin/get_lic_districts'; ?>"><i class="fa fa-list"></i> Districts List</a>
          </li>
        </ul>
      </li>
      
      <li class="treeview <?= $heading == "Traffic Education" ? "active" : ""; ?>">
        <a href="#">
          <i class="fa fa-hand-stop-o"></i>
          <span>Traffic Education</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="<?= $this->uri->segment(2) == "add_traffic_sign" ? "active" : ""; ?>">
            <a href="<?php echo base_url() . 'admin/add_traffic_sign'; ?>"><i class="fa fa-file-image-o"></i> Add Traffic Sign</a>
          </li>
          <li class="<?= $this->uri->segment(2) == "view_all_signs" ? "active" : ""; ?>">
            <a href="<?php echo base_url() . 'admin/view_all_signs'; ?>"><i class="fa fa-th-list"></i> Show All Signs</a>
          </li>
          <!--<li><a href="#"><i class="fa fa-pencil-square-o"></i> Update Traffic Sign</a></li>-->
        </ul>
      </li>
      
      <li class="treeview <?= $heading == "Emergency Contacts" ? "active" : ""; ?>">
        <a href="#">
          <i class="fa fa-ambulance"></i> <span>Emergency Contacts</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="<?= $this->uri->segment(2) == "add_emergency" ? "active" : ""; ?>">
            <a href="<?= base_url() . "admin_emergency/add_emergency"; ?>"><i class="fa fa-plus-square"></i> Add Emergency Contact</a>
          </li>
          <li class="<?= $this->uri->segment(2) == "emergency_list" ? "active" : ""; ?>">
            <a href="<?= base_url() . "admin_emergency/emergency_list"; ?>"><i class="fa fa-list"></i> Emergency Contacts List</a>
          </li>
          <li class="<?= $this->uri->segment(2) == "add_division" ? "active" : ""; ?>">
            <a href="<?= base_url() . "admin_emergency/add_division"; ?>"><i class="fa fa-plus"></i> Add Division</a>
          </li>
          <li class="<?= $this->uri->segment(2) == "show_divisions" ? "active" : ""; ?>">
            <a href="<?= base_url() . "admin_emergency/show_divisions"; ?>"><i class="fa fa-file-text-o"></i> Show Divisions</a>
          </li>
          <li class="<?= $this->uri->segment(2) == "add_district" ? "active" : ""; ?>">
            <a href="<?= base_url() . "admin_emergency/add_district"; ?>"><i class="fa fa-plus"></i> Add District</a>
          </li>
          <li class="<?= $this->uri->segment(2) == "show_districts" ? "active" : ""; ?>">
            <a href="<?= base_url() . "admin_emergency/show_districts"; ?>"><i class="fa fa-file-text-o"></i> Show Districts</a>
          </li>
        </ul>
      </li>


        <li class="treeview <?= $heading == "Users" ? "active" : ""; ?>">
          <a href="#">
            <i class="fa fa-user-o"></i> <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?= $this->uri->segment(2) == "User" ? "active" : ""; ?>">
              <a href="<?= base_url() . "dashboard/User"; ?>"><i class="fa fa-plus-square"></i> Add New Users</a>
            </li>
            <li class="<?= $this->uri->segment(3) == "show" ? "active" : ""; ?>">
              <a href="<?= base_url() . "dashboard/user/show"; ?>"><i class="fa fa-eye"></i> View Users</a>
            </li>
          </ul>
        </li>


        <li class="treeview <?= $heading == "Traffic Wardens" ? "active" : ""; ?>">
          <a href="#">
            <i class="fa fa-male"></i> <span>Traffic Wardens</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?= $this->uri->segment(2) == "add_traffic_warden" ? "active" : ""; ?>">
              <a href="<?= base_url() . "dashboard/Traffic_wardens"; ?>"><i class="fa fa-plus-square"></i> Add New Warden</a>
            </li>
            <li class="<?= $this->uri->segment(3) == "show" ? "active" : ""; ?>">
              <a href="<?= base_url() . "dashboard/Traffic_wardens/show"; ?>"><i class="fa fa-eye"></i> View Traffic wardens</a>
            </li>
            <li class="<?= $this->uri->segment(3) == "traffic_wardens_map" ? "active" : ""; ?>">
              <a href="<?= base_url() . "dashboard/Traffic_wardens/traffic_wardens_map"; ?>">
                <i class="fa fa-map-marker" aria-hidden="true"></i> Traffic Wardens Map</a>
            </li>
            <li class="<?= $this->uri->segment(3) == "duty_point" ? "active" : ""; ?>">
              <a href="<?= base_url() . "dashboard/Traffic_wardens/duty_point"; ?>">
                <i class="fa fa-hand-o-right" aria-hidden="true"></i> Add Traffic Warden Duty Point</a>
            </li>

            <li class="<?= $this->uri->segment(3) == "duty_point_list" ? "active" : ""; ?>">
              <a href="<?= base_url() . "dashboard/Traffic_wardens/duty_point_list"; ?>">
                <i class="fa fa-list" aria-hidden="true"></i> Duty Point List</a>
            </li>
            <li class="<?= $this->uri->segment(3) == "list_circle" ? "active" : ""; ?>">
              <a href="<?= base_url() . "dashboard/Traffic_wardens/list_circle"; ?>">
                <i class="fa fa-list" aria-hidden="true"></i> Circle List</a>
            </li>
            <li class="<?= $this->uri->segment(3) == "list_sectors" ? "active" : ""; ?>">
              <a href="<?= base_url() . "dashboard/Traffic_wardens/list_sectors"; ?>">
                <i class="fa fa-list" aria-hidden="true"></i> Sectors List</a>
            </li>
          </ul>
        </li>

        <li class="treeview <?= $heading == "Report" ? "active" : ""; ?>">
          <a href="<?php bs() ?>dashboard/User/district_result">
          <i class="fa fa-list" aria-hidden="true"></i> <span>District Report</span>
          </a>
        </li>

      <?php endif ?>

      <li class="treeview <?= $heading == "Revisions" ? "active" : ""; ?>">
        <a href="<?php bs() ?>Admin/admin_reviews">
        <i class="fa fa-registered" aria-hidden="true"></i> <span>Admin Reviwed</span>
        </a>
      </li>

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
