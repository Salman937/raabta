
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $heading;?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Change warden place</li>
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
                  <h3 class="box-title">Change Traffic Warden Place</h3>
                </div>
                <!-- /.box-header -->
                
                <!-- form start -->
                <form class="form-horizontal" action="<?php echo base_url()?>dashboard/Traffic_wardens/update_warden_place" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                    
                    <div class="form-group">
                      <label for="shift" class="col-sm-3 control-label">Shift</label>
                      <div class="col-sm-6">
                          <input type="text" class="form-control" name="shift" id="shift" value="<?php echo $warden->shift ?>" maxlength="30" placeholder="Enter Shift" required>
                          <?php echo '<span class="error">'. form_error('shift').'</span>'; ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="duration" class="col-sm-3 control-label">Duration</label>
                      <div class="col-sm-6">
                          <input type="text" class="form-control" name="duration" id="duration" value="<?php echo $warden->duration ?>" maxlength="30" placeholder="Enter Duration" required>
                          <?php echo '<span class="error">'. form_error('duration').'</span>'; ?>
                      </div>
                    </div>


                    <div class="form-group">
                      <label for="Search" class="col-sm-3 control-label">Duty Point</label>
                      <div class="col-sm-6">
                        <input type="text" class="input form-control" id="address" name="duty_point" />
                        <br>
                        <div id="map-view" class="is-vcentered" style="width: 100%; height:400px;"></div>
                      </div>
                    </div>

                      <input type="hidden" name="lat" id="lat">
                      <input type="hidden" name="log" id="lon">
                      <input type="hidden" name="id" value="<?php echo $id ?>">

                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <div class="col-sm-offset-3 col-sm-3">
                        <button type="submit" class="btn btn-info">Save Changes</button>
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

 location: {latitude: 23.9163336, longitude: 52.80361289999996},
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