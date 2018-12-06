<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         <?= $heading; ?>
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
               <?php if ($this->session->flashdata('msg')) : ?>
               <div class="callout callout-success" id="msg">
                  <p align="center" style="position:relative; font-size:16px;">
                     <?= $this->session->flashdata('msg') ?>
                  </p>
               </div>
               <?php endif; ?>
               <!-- Horizontal Form -->
               <div class="box box-info">
                  <div class="box-header with-border">
                     
                     <h3 class="box-title">Change Traffic Warden Place</h3>
                  </div>
                  <!-- /.box-header -->
                  <!-- form start -->
                <div class="row">
                  <div class="col-md-5 col-md-offset-1"> 
                  <form class="form-horizontal" action="<?php echo base_url() ?>dashboard/Traffic_wardens/update_warden_place" method="post" enctype="multipart/form-data">
                     <div class="box-body">
                        <div class="form-group">
                           <label for="shift" class="control-label">Duty point end date</label>
                           <div>
                              <input type="date" class="form-control" name="duty_point_end_date" id="start_date" maxlength="30" required>
                              <?php echo '<span class="error">' . form_error('duty_point_end_date') . '</span>'; ?>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="shift" class="control-label">Appointed As</label>
                           <div>
                              <input type="date" class="form-control" name="start_date" id="start_date" maxlength="30" placeholder="Enter New Position Start Date" required>
                              <?php echo '<span class="error">' . form_error('shift') . '</span>'; ?>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="shift" class="control-label">Shift</label>
                           <div>
                              <select name="shift" class="form-control" required>
                                 <option value="">Select Shift</option>
                                 <option>Morning</option>
                                 <option>Eevning</option>
                                 <option>Night</option>
                              </select>
                              <?php echo '<span class="error">' . form_error('shift') . '</span>'; ?>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="start_date" class="control-label">Start Date</label>
                           <div>
                              <input type="date" class="form-control" name="start_date" id="start_date" maxlength="30" placeholder="Enter New Position Start Date" required>
                              <?php echo '<span class="error">' . form_error('start_date') . '</span>'; ?>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="end_date" class="control-label">End Date(optional)</label>
                           <div>
                              <input type="date" class="form-control" name="end_date" id="end_date" maxlength="30">
                              <?php echo '<span class="error">' . form_error('end_date') . '</span>'; ?>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="image" class="control-label">Circle</label>
                           <div>
                              <select name="circle" class="form-control" onchange="getSector(this)">
                                 <option value="">Select Circle</option>
                                 <?php foreach ($circles as $circle) : ?>
                                 <option value="<?php echo $circle->id ?>"><?php echo $circle->circle_and_sector ?></option>
                                 <?php endforeach ?>
                              </select>
                           </div>
                        </div>
                        <div class="add_sector">
                        </div>
                        <div class="duty_points">
                        </div>
                        <!-- <input type="hidden" name="lat" id="lat">
                           <input type="hidden" name="log" id="lon">
                           
                           <input type="hidden" name="update_lat" id="update_lat">
                           <input type="hidden" name="update_long" id="update_long"> -->
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
                  <div class="col-md-6 text-center">
                    <h1><?php echo $user->name ?></h3>
                    <img src="<?php echo $user->Image ?>" style="width:60%">
                  </div>
                </div> 
                <br>
                <br>
                <div class="row">
                  <div class="col-sm-12 show_user" style="margin:0px 2em">
                    
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

<script>
   // function myMap() 
   // {
   
   //   if ($('#update_lat').val().length === 0 && $('#update_long').val().length === 0)
   //   {
   //     var new_lat = 33.996249;
   //     var new_long = 71.459671;
   //   }
   //   else
   //   {
   //     var new_lat  = $('#update_lat').val();
   //     var new_long = $('#update_long').val();
   //   }
   
   //   $('#map-view').locationpicker({
   
   //    location: {latitude: new_lat, longitude:new_long},
   //    enableAutocomplete: true,
   //    radius:0,
   //    onchanged: function (currentLocation, radius, isMarkerDropped) {
   //        var addressComponents = $(this).locationpicker('map').location.addressComponents;
   //        // updateControls(addressComponents);
   //    },
   //    oninitialized: function(component) {
   //        var addressComponents = $(component).locationpicker('map').location.addressComponents;
   //        // updateControls(addressComponents);
   //    },
   //    inputBinding: {
   //        latitudeInput: $('#lat'),
   //        longitudeInput: $('#lon'),
   //        locationNameInput: $('#address')
   //    },
   
   //   });
   // }
   
   
   // myMap();
   
   function getval(sel)
   {
       var id = sel.value;
   
       $.ajax({
   
         url: '<?php echo base_url() ?>dashboard/Traffic_wardens/get_duty_point/'+id,
         success: function(data)
         {
           var parse_data = JSON.parse(data);
   
           $('#update_lat').val(parse_data.latitude);
           $('#update_long').val(parse_data.longitude);
   
           // myMap();
           // $("#results").append(html);
         }
       });
   }
   

   function getSector(sel)
   {
       var id = sel.value;
   
       $.ajax({
   
         url: '<?php echo base_url() ?>dashboard/Traffic_wardens/change_duty_point_sector/'+id,
         
         success: function(data)
         {
           $('.add_sector').html(data);
         }
       });
   }
   
   function get_duty_point(duty_id)
   {
       var id = duty_id.value;

       get_users(id); 

       $.ajax({
   
         url: '<?php echo base_url() ?>dashboard/Traffic_wardens/change_get_duty_points/'+id,
         
         success: function(data)
          {
           $('.duty_points').html(data);
          }
        });
   }

   function get_users(id)
   {
      $.ajax({
      
      url: '<?php echo base_url() ?>dashboard/Traffic_wardens/get_wardens/'+id,
        success: function(data)
        {
          $('.show_user').html(data);
        }
      });
   }

   function duty_point_wardens(sel)
   {
       var id = sel.value;

       $.ajax({
   
         url: '<?php echo base_url() ?>dashboard/Traffic_wardens/duty_point_wardens/'+id,
         
         success: function(data)
         {
           $('.show_user').html(data);
         }
       });
   }
   
</script>