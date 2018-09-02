
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $heading;?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit</li>
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
                  <h3 class="box-title">Edit Traffic Warden</h3>
                </div>
                <!-- /.box-header -->
                
                <!-- form start -->
                <form class="form-horizontal" action="<?php echo base_url()?>dashboard/Traffic_wardens/update" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="warden_name" class="col-sm-3 control-label">Warden Name</label>
                      <div class="col-sm-6">
                          <input type="text" class="form-control" name="warden_name" value="<?php echo $warden->name ?>" id="warden_name" maxlength="30" placeholder="Enter Warden Name" required>
                          <?php echo '<span class="error">'. form_error('warden_name').'</span>'; ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="belt_no" class="col-sm-3 control-label">Belt No</label>
                      <div class="col-sm-6">
                          <input type="text" class="form-control" name="belt_no" value="<?php echo $warden->belt_no ?>" id="belt_no" maxlength="30" placeholder="Enter Belt No" required>
                          <?php echo '<span class="error">'. form_error('belt_no').'</span>'; ?>
                      </div>
                    </div>              

                    <div class="form-group">
                      <label for="designation" class="col-sm-3 control-label">Designation / Rank</label>
                      <div class="col-sm-6">
                          <input type="text" class="form-control" name="designation" value="<?php echo $warden->Designation ?>" id="designation" maxlength="30" placeholder="Enter Designation" required>
                          <?php echo '<span class="error">'. form_error('designation').'</span>'; ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="phone_no" class="col-sm-3 control-label">Phone No</label>
                      <div class="col-sm-6">
                          <input type="text" class="form-control" name="phone_no" value="<?php echo $warden->phone_number ?>" id="phone_no" maxlength="30" placeholder="Enter Phone No" required>
                          <?php echo '<span class="error">'. form_error('phone_no').'</span>'; ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="shift" class="col-sm-3 control-label">Shift</label>
                      <div class="col-sm-6">
                        <select name="shift" class="form-control" required>
                          <option value="">Select Shift</option>
                          <option value="<?php echo $warden->shift ?>" selected=""><?php echo $warden->shift ?></option>
                          <option>Morning</option>
                          <option>Eevning</option>
                          <option>Night</option>
                        </select>
                        <?php echo '<span class="error">'. form_error('shift').'</span>'; ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="str_date" class="col-sm-3 control-label">Start Date</label>
                      <div class="col-sm-6">
                          <input type="date" class="form-control" name="str_date" id="str_date" value="<?php echo $warden->start_date  ?>" required>
                          <?php echo '<span class="error">'. form_error('str_date').'</span>'; ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="image" class="col-sm-3 control-label">Image</label>
                      <div class="col-sm-6">
                          <input type="file" name="image">
                          <input type="hidden" name="old" value="<?php echo $warden->image ?>">
                          <input type="hidden" name="id" value="<?php echo $warden->warden_id ?>">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="image" class="col-sm-3 control-label">Circle</label>
                      <div class="col-sm-6">
                          <select name="circle" class="form-control" onchange="getSector(this)">
                            <option value="">Select Circle</option>

                            <option value="<?php echo $warden->circle_id ?>" selected=""><?php echo $warden->circle ?></option>

                            <?php foreach ($circles as $circle): ?>
                              
                              <option value="<?php echo $circle->id ?>"><?php echo $circle->circle_and_sector ?></option>

                            <?php endforeach ?>

                          </select>
                      </div>
                    </div>
                    <div class="add_sector">
                      <div class="form-group">
                        <label for="image" class="col-sm-3 control-label">Sectors</label>
                        <div class="col-sm-6">
                            <select name="sector" class="form-control">
                              <option value="">Select Sector</option>

                              <option value="<?php echo $warden->id ?>" selected=""><?php echo $warden->circle_and_sector; ?></option>

                              <?php 

                                $sectors = $this->common_model->getAllData('traffic_warden_circles','*','',array('parent_id' => $warden->parent_id))

                               ?>

                              <?php foreach ($sectors as $sector): ?>
                                
                                <option value="<?php echo $sector->id ?>"> <?php echo $sector->circle_and_sector ?></option>

                              <?php endforeach ?>

                            </select>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="Search" class="col-sm-3 control-label">Duty Point</label>
                      <div class="col-sm-6">
                       
                        <select name="war_duty_point" class="form-control search_duty_point" onchange="getval(this);" required="">
                          <option value="">Select Duty Point</option>

                          <option value="<?php echo $warden->warden_id ?>" selected=""><?php echo $warden->war_duty_point; ?></option>

                          <?php foreach ($duty_points as $duty_point): ?>
                            
                            <option value="<?php echo $duty_point->id ?>"> <?php echo $duty_point->duty_point ?> </option>

                          <?php endforeach ?>
                        </select>
                        <br>
                        <div id="map-view" class="is-vcentered" style="width: 100%; height:400px;"></div>
                      </div>
                    </div>

                      <input type="hidden" name="lat" id="lat">
                      <input type="hidden" name="log" id="lon">

                      <input type="hidden" name="update_lat" id="update_lat">
                      <input type="hidden" name="update_long" id="update_long">

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

function myMap() 
{

  if ($('#update_lat').val().length === 0 && $('#update_long').val().length === 0)
  {
    var new_lat = 33.996249;
    var new_long = 71.459671;
  }
  else
  {
    var new_lat  = $('#update_lat').val();
    var new_long = $('#update_long').val();
  }

  $('#map-view').locationpicker({

   location: {latitude: new_lat, longitude:new_long},
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
}


myMap();

function getval(sel)
{
    var id = sel.value;

    // console.log(id);
    
    $.ajax({

      url: '<?php echo base_url()?>dashboard/Traffic_wardens/get_duty_point/'+id,
      success: function(data)
      {
        var parse_data = JSON.parse(data);

        $('#update_lat').val(parse_data.latitude);
        $('#update_long').val(parse_data.longitude);

        myMap();
        // $("#results").append(html);
      }
    });
}

function getSector(sel)
{
    var id = sel.value;

    console.log(id);
    
    $.ajax({

      url: '<?php echo base_url()?>dashboard/Traffic_wardens/get_sector/'+id,
      
      success: function(data)
      {
        $('.add_sector').html(data);
      }
    });
}

</script>