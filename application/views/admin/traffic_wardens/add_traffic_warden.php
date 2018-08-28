
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $heading;?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">New User</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    
    
      <!-- Main content dataTable -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

            <!-- session message -->
            <?php if($this->session->flashdata('msg')):?>
            <div class="callout callout-success" id="msg">
                <p align="center" style="position:relative; font-size:16px;">
                    <?=$this->session->flashdata('msg')?>
                </p>
            </div>
            <?php endif;?>

            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Add New Traffic Warden</h3>
                </div>
                <!-- /.box-header -->
                
                <!-- form start -->
                <form class="form-horizontal" action="<?php echo base_url()?>dashboard/Traffic_wardens/add" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="warden_name" class="col-sm-3 control-label">Warden Name</label>
                      <div class="col-sm-6">
                          <input type="text" class="form-control" name="warden_name" id="warden_name" maxlength="30" placeholder="Enter Warden Name" required>
                          <?php echo '<span class="error">'. form_error('warden_name').'</span>'; ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="belt_no" class="col-sm-3 control-label">Belt No</label>
                      <div class="col-sm-6">
                          <input type="text" class="form-control" name="belt_no" id="belt_no" maxlength="30" placeholder="Enter Belt No" required>
                          <?php echo '<span class="error">'. form_error('belt_no').'</span>'; ?>
                      </div>
                    </div>              
                    
                    <div class="form-group">
                      <label for="rank" class="col-sm-3 control-label">Rank</label>
                      <div class="col-sm-6">
                          <input type="text" class="form-control" name="rank" id="rank" maxlength="30" placeholder="Enter Rank" required>
                          <?php echo '<span class="error">'. form_error('rank').'</span>'; ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="designation" class="col-sm-3 control-label">Designation</label>
                      <div class="col-sm-6">
                          <input type="text" class="form-control" name="designation" id="designation" maxlength="30" placeholder="Enter Designation" required>
                          <?php echo '<span class="error">'. form_error('designation').'</span>'; ?>
                      </div>
                    </div>

                    <!-- <div class="form-group">
                      <label for="duty_point" class="col-sm-3 control-label">Duty Point</label>
                      <div class="col-sm-6">
                          <input type="text" class="form-control address" name="duty_point" id="duty_point" maxlength="30" placeholder="Enter Duty Point" required>
                          <?php echo '<span class="error">'. form_error('duty_point').'</span>'; ?>
                      </div>
                    </div> -->

                    <div class="form-group">
                      <label for="phone_no" class="col-sm-3 control-label">Phone No</label>
                      <div class="col-sm-6">
                          <input type="text" class="form-control" name="phone_no" id="phone_no" maxlength="30" placeholder="Enter Phone No" required>
                          <?php echo '<span class="error">'. form_error('phone_no').'</span>'; ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="shift" class="col-sm-3 control-label">Shift</label>
                      <div class="col-sm-6">
                          <input type="text" class="form-control" name="shift" id="shift" maxlength="30" placeholder="Enter Shift" required>
                          <?php echo '<span class="error">'. form_error('shift').'</span>'; ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="duration" class="col-sm-3 control-label">Duration</label>
                      <div class="col-sm-6">
                          <input type="text" class="form-control" name="duration" id="duration" maxlength="30" placeholder="Enter Duration" required>
                          <?php echo '<span class="error">'. form_error('duration').'</span>'; ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="image" class="col-sm-3 control-label">Image</label>
                      <div class="col-sm-6">
                          <input type="file" name="image" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="Search" class="col-sm-3 control-label">Duty Point</label>
                      <div class="col-sm-6">
                        <input type="text" class="input form-control address" id="address" name="duty_point" />
                        <br>
                        <div id="map-view" class="is-vcentered" style="width: 100%; height:400px;"></div>
                      </div>
                    </div>

                      <input type="hidden" name="lat" id="lat">
                      <input type="hidden" name="log" id="lon">

                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <div class="col-sm-offset-3 col-sm-3">
                       <a href="<?php echo base_url().'admin/get_license_list'; ?>" class="btn btn-default">Cancel</a>
                        <button type="reset" class="btn btn-default">Reset</button>
                        <button type="submit" class="btn btn-info">Submit</button>
                    </div>
                  </div>
                  <!-- /.box-footer -->
                </form>
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


<script>

 $('#map-view').locationpicker({

   location: {latitude: 34.0149748, longitude: 71.5804899},
   enableAutocomplete: true,
   radius:0,
   onchanged: function (currentLocation, radius, isMarkerDropped) {
       var addressComponents = $(this).locationpicker('map').location.addressComponents;
       // updateControls(addressComponents);
   },
   oninitialized: function(component) {
       var addressComponents = $(component).locationpicker('map').location.addressComponents;
       // updateControls(addressComponents);
   },
   inputBinding: {
       latitudeInput: $('#lat'),
       longitudeInput: $('#lon'),
       locationNameInput: $('#address')
   },

 });

</script>