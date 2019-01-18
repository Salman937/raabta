
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $heading; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Complaints</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <!-- Main content dataTable -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Update Complaint</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?php if ($this->session->flashdata('msg')) : ?>
                  <div class="callout callout-success" id="msg">
                      <p align="center" style="position:relative; font-size:16px;">
                          <?= $this->session->flashdata('msg') ?>
                      </p>
                  </div>
                <?php endif; ?>
                <h4 class="text-center">Complaint ID: <?php echo $this->uri->segment(3); ?></h4>
                <form class="form-horizontal" action="<?= $action; ?>" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                   
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Complaint Status</label>
                      <input type="hidden" name="complaint_id" value="<?= $id ?>" />
                      
                      <div class="col-sm-6">
                          <select name="status" class="form-control">
                            <!--<option>Choose Complaint Status</option>-->
                            <?php 
                            if (isset($status)) foreach ($status as $row) {
                              ?>
                            <option value="<?= $row->complaints_status_id; ?>" <?php if ($record['complaints_status_id'] == $row->complaints_status_id) {
                                                                                echo 'selected="selected"';
                                                                              } ?>><?= $row->status; ?></option>
                            <?php 
                          } ?>
                          </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-3 control-label">Complaint District</label>
                      
                      <div class="col-sm-6">
                          <select name="district" class="form-control">
                            <!--<option>Choose Complaint Status</option>-->
                            <?php 
                            if (isset($districts)) foreach ($districts as $district) {
                              ?>
                            <option value="<?= $district->slug; ?>" <?php if ($record['district'] == $district->slug) {
                                                                      echo 'selected="selected"';
                                                                    } ?>><?= $district->district_name; ?></option>
                            <?php 
                          } ?>
                          </select>
                      </div>
                    </div>
                    
                    <!-- textarea -->
                    <div class="form-group">
                      <label for="description" class="col-sm-3 control-label">Complaint Description</label>
                      
                      <div class="col-sm-6">
                      <textarea class="form-control" rows="3" name="description" placeholder="Enter Complaint Description" disabled><?php echo $record['description']; ?></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group no-print">
                      <label for="image" class="col-sm-3 control-label">Upload Image/Video</label>
                      
                      <div class="col-sm-6">
                        <?php if ($record['image']) { ?>
                          <img class="img-responsive" src="<?= base_url() . "uploads/images/" . $record['image']; ?>" style="width:80px; height:50px;" />
                          <?php 
                        } else if ($record['video']) { ?>
                          <video width="160" height="120" controls autoplay>
                             <source src="<?= base_url() . "uploads/videos/" . $record['video']; ?>" type="video/mp4">
                             Sorry, your browser doesn't support the video element.
                          </video>
                       <?php 
                    } else {
                      echo 'Sorry! No image/video to display';
                    } ?>
                        
                         <input type="file" name="image" value="" id="imgUpload" disabled>
                      </div>
                    </div>
                    
                   <!-- select -->
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Complaint Type</label>
                      <div class="col-sm-6">
                          <select name="type" class="form-control" disabled>
                            <option>Choose Complaint Type</option>
                            <?php 
                            if (isset($types)) foreach ($types as $row) {
                              ?>
                            <option value="<?= $row->complaint_type_id; ?>" <?php if ($record['complaint_type_id'] == $row->complaint_type_id) {
                                                                              echo 'selected="selected"';
                                                                            } ?>><?= $row->complaint_type; ?></option>
                            <?php 
                          } ?>
                          </select>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="dated" class="col-sm-3 control-label">Date</label>

                      <div class="col-sm-6">
                        <input type="text" class="form-control" name="dated" value="<?php echo date('d-m-Y', strtotime($record['dated'])); ?>" id="lat" placeholder="Enter Date" disabled>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="response" class="col-sm-3 control-label">Response</label>

                      <div class="col-sm-6">
                        <textarea name="response" class="form-control" rows="5"></textarea>
                      </div>
                    </div>
                  </div>

                  
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <div class="col-sm-offset-7 col-sm-3">
                        <a href="<?php echo base_url() . 'admin/get_complaints'; ?>" class="btn btn-default">Cancel</a>
                        <button type="submit" class="btn btn-info">Update</button>
                        <a class="btn btn-danger" onclick="printDiv('print_comp')" ><i class="fa fa-print"></i>  Print</a>
                    </div>
                  </div>
                  <!-- /.box-footer -->
                </form>

                  <div class="box-footer">
                    <div class="col-sm-12">
                      <table class="table">
                        <thead>
                          <tr class="active">
                            <th>
                              Status
                            </th>
                            <th>
                              Responses
                            </th>
                            <th>
                              Actions
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if (empty($responses)) : ?> 
                          <tr>
                            <td>
                            <font color="red">Response No Available</font>
                            </td>
                          </tr>
                          <?php else : ?> 
                          
                          <?php foreach ($responses as $response) : ?>
                          <tr>
                            <td>
                              <?php echo $response->status ?>
                            </td>
                            <td>
                              <?php echo $response->complaint_response ?>
                            </td>
                            <td>
                              <a href="<?php bs() ?>Admin/response_delete/<?php echo $response->id ?>">
                                <button class="btn btn-danger btn-xs">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                              </a>
                              <a href="<?php bs() ?>Admin/edit_response/<?php echo $response->id ?>">
                                <button class="btn btn-success btn-xs">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                </button>
                              </a>
                            </td>
                          </tr>
                          <?php endforeach; ?>

                          <?php endif; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <div class="container" id="print_comp" style="display:none">
                    <div class="row">
                      <div class="col-md-2 text-center col-md-offset-1">
                            <img src="<?php bs() ?>assets/images/kp-logo.svg"  alt="Logo" style="width:100px">
                      </div>
                      <div class="col-md-8 text-center" style="margin:-1.5em">
                          <h3 style=""> <b>Raabta Complaint Cell</b></h3>
                          <h3 style="margin:-0.4em"> <b>Traffic Police Khyber Pakhtunkhwa</b></h3>
                      </div>
                    </div>
                    <div class="row" style="margin-top:3em">
                      <div class="col-md-5 col-md-offset-1">
                        Complaint Date: <?php echo date('d-m-Y', strtotime($record['dated'])); ?>
                        <br>
                        Complaint Type:
                        <?php
                        if ($record['complaint_type_id'] == 1) :
                          echo '<b>Traffic Jam</b> ';
                        elseif ($record['complaint_type_id'] == 2) :
                          echo '<b> Compliant against Wardens </b>';
                        elseif ($record['complaint_type_id'] == 3) :
                          echo '<b>Illegal Parking</b>';
                        elseif ($record['complaint_type_id'] == 4) :
                          echo '<b>Other</b>';
                        endif;
                        ?>
                      </div>
                      <div class="col-md-4 text-right" style="margin-top:-3em">
                        Current Status: 
                        <br>
                         <?php
                        if ($record['complaints_status_id'] == 1) :
                          echo '<b>Completed</b> ';
                        elseif ($record['complaints_status_id'] == 2) :
                          echo '<b>Pending</b>';
                        elseif ($record['complaints_status_id'] == 3) :
                          echo '<b>In Progress</b>';
                        elseif ($record['complaints_status_id'] == 4) :
                          echo '<b>Irrelevant</b>';
                        elseif ($record['complaints_status_id'] == 5) :
                          echo '<b>Not Understandable</b>';
                        endif;
                        ?>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-9 col-md-offset-1" style="margin-top:3em">
                            <b> Complaint Description: </b>
                            <br>
                            <br>
                            <div>
                              <?php echo $record['description']; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top:3em">
                      <div class="col-md-5 col-md-offset-1">
                        <b> District:</b>  <?php echo $record['district'] ?>
                      </div>
                      <div class="col-md-4 text-right" style="margin-top:-1em">
                        <b> Contact Number: </b> <?php echo $record['phone'] ?>
                      </div>
                    </div>
                    <div class="row" style="margin-top:3em">
                      <div class="col-md-4 col-md-offset-1">
                        <b> User Feedback: </b> 
                      </div>
                    </div>
                    <div class="row" style="margin-top:3em">
                      <div class="col-md-10 col-md-offset-1">
                        <b> User Response: </b> 
                        <br>
                        <br>
                        <table class="table">
                        <thead>
                          <tr class="active">
                            <th>
                              Status
                            </th>
                            <th>
                              Responses
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if (empty($responses)) : ?> 
                          <tr>
                            <td>
                            <font color="red">Response No Available</font>
                            </td>
                          </tr>
                          <?php else : ?> 
                          
                          <?php foreach ($responses as $response) : ?>
                          <tr>
                            <td>
                              <?php echo $response->status ?>
                            </td>
                            <td>
                              <?php echo $response->complaint_response ?>
                            </td>
                          </tr>
                          <?php endforeach; ?>

                          <?php endif; ?>
                        </tbody>
                      </table>
                      </div>
                    </div>
                    </div>  
                  </div>
                </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script type="text/javascript">
    function printDiv(print_comp){
      var printContents = document.getElementById(print_comp).innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents;
      window.location.reload();
  }
</script>
