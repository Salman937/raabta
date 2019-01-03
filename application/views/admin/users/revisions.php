  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $heading; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Users</li>
      </ol>
    </section>
    
    <!-- Main content dataTable -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                 <!-- session message -->
              <?php if($this->session->flashdata('msg')):?>
              <div class="callout callout-success" id="msg">
                  <p align="center" style="position:relative; font-size:16px;">
                      <?=$this->session->flashdata('msg')?>
                  </p>
              </div>
              <?php endif;?>

              <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Complaint ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Admin district</th>
                    <th>Complaint distirct</th>
                    <th>Complaint response</th>
                    <th>Response Status</th>
                </tr>
                </thead>
                <tbody>
                  <?php if (empty($revisions)): ?>
                    <tr>No Actions Available</tr>

                  <?php else: ?>
                  
                    <?php foreach ($revisions as $revision): ?>

                    <tr>
                      <td><?php echo $revision->complaint_id ?></td>
                      <td> <?php echo $revision->admin_name ?> </td>
                      <td> <?php echo $revision->admin_email ?> </td>
                      <td> <?php echo $revision->admin_district ?> </td>
                      <td> <?php echo $revision->district ?> </td>
                      <td> <?php echo $revision->complaint_response ?> </td>
                      <td> 
                            <?php
                                if($revision->response_status == 1):
                                    echo '<span class="label label-success">Completed</span> ';
                                elseif($revision->response_status == 2):
                                    echo '<span class="label label-danger">Pending</span>';
                                elseif($revision->response_status == 3):
                                    echo '<span class="label label-warning">In Progress</span>';
                                elseif($revision->response_status == 4):
                                    echo '<span class="label" style="background:#8e44ad !important;">Irrelevant</span>';
                                elseif($revision->response_status == 5):
                                    echo '<span class="label" style="background:#8e44ad !important;">Not Understandable</span>';
                                endif;
                            ?>    
                        </td>
                    </tr>  
                      
                    <?php endforeach ?>

                  <?php endif ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->


<!-- DataTables -->
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
