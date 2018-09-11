
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $heading;?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit User</li>
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
                <br>
                <form class="form-horizontal" action="<?php echo base_url()?>dashboard/Traffic_wardens/add" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="panel panel-default">
                        <div class="panel-heading"><h4><b>Personal Information</b></h4></div>
                        <div class="panel-body">
                          
                          <div class="row">
                            
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="personal_no" class="col-sm-3 control-label">Personal No</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" name="personal_no" id="personal_no" maxlength="30" value="<?= $warden->personal_no ?>" placeholder="Enter Personal No" required>
                                  <?php echo '<span class="error">'. form_error('personal_no').'</span>'; ?>
                                </div>  
                              </div>
                            </div>  
                              
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="belt_no" class="col-sm-3 control-label">Belt No</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" name="belt_no" id="belt_no" maxlength="30" value="<?= $warden->belt_no ?>" placeholder="Enter Belt No" required>
                                  <?php echo '<span class="error">'. form_error('belt_no').'</span>'; ?>
                                </div>  
                              </div>
                            </div>              
                          </div>

                          <div class="row">
                            
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">Name</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" name="name" id="name" maxlength="30" placeholder="Enter Name" value="<?= $warden->name ?>" required>
                                  <?php echo '<span class="error">'. form_error('name').'</span>'; ?>
                                </div>  
                              </div>
                            </div>  
                              
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="father_name" class="col-sm-3 control-label">Father/Husband's Name</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" name="father_name" id="father_name" maxlength="30" value="<?= $warden->father_husband_name ?>" placeholder="Enter Father/Husband's Name" required>
                                  <?php echo '<span class="error">'. form_error('father_name').'</span>'; ?>
                                </div>  
                              </div>
                            </div>              
                          </div>

                          <div class="row">
                            
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="nic_no" class="col-sm-3 control-label">NIC No</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" name="nic_no" id="nic_no" maxlength="30" value="<?= $warden->nic_no ?>" placeholder="Enter NIC NO" required>
                                  <?php echo '<span class="error">'. form_error('nic_no').'</span>'; ?>
                                </div>  
                              </div>
                            </div>  
                              
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="passport_no" class="col-sm-3 control-label">Passport No</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" name="passport_no" id="passport_no" maxlength="30" value="<?= $warden->passport_no ?>" placeholder="Enter Passport No" required>
                                  <?php echo '<span class="error">'. form_error('passport_no').'</span>'; ?>
                                </div>  
                              </div>
                            </div>              
                          </div>


                          <div class="row">
                            
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="license_no" class="col-sm-3 control-label">Diriving License No</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" name="license_no" id="license_no" maxlength="30" value="<?= $warden->diriving_license_no ?>" placeholder="Enter Diriving License No" required>
                                  <?php echo '<span class="error">'. form_error('license_no').'</span>'; ?>
                                </div>  
                              </div>
                            </div>  
                              
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="dob" class="col-sm-3 control-label">Date of Brith</label>
                                <div class="col-sm-9">
                                  <input type="date" class="form-control" name="dob" id="dob" maxlength="30" placeholder="Enter Belt No" value="<?= $warden->date_of_brith ?>" required>
                                  <?php echo '<span class="error">'. form_error('dob').'</span>'; ?>
                                </div>  
                              </div>
                            </div>              
                          </div>
                          <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="sex" class="col-sm-3 control-label">Gender/Sex</label>
                                <div class="col-sm-9">
                                  <select name="sex" class="form-control" required>
                                    <option value="<?= $warden->sex ?>" selected><?= $warden->sex ?></option>
                                    <option>Male</option>
                                    <option>Female</option>
                                    <option>Married</option>
                                    <option>Unmarried</option>
                                    <option>Divorced</option>
                                    <option>Widow</option>
                                  </select>
                                  <?php echo '<span class="error">'. form_error('sex').'</span>'; ?>
                                </div>  
                              </div>
                            </div>  
                              
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="religion" class="col-sm-3 control-label">Religion</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" name="religion" id="religion" maxlength="30" value="<?= $warden->religion ?>" placeholder="Enter Religion" required>
                                  <?php echo '<span class="error">'. form_error('religion').'</span>'; ?>
                                </div>  
                              </div>
                            </div>              
                          </div>

                          <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="blood_group" class="col-sm-3 control-label">Blood Group</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" name="blood_group" id="blood_group" maxlength="30" value="<?= $warden->blood_group ?>" placeholder="Enter Blood Group" required>
                                  <?php echo '<span class="error">'. form_error('blood_group').'</span>'; ?>
                                </div>  
                              </div>
                            </div>  
                              
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="mobile" class="col-sm-3 control-label">Mobile</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" name="mobile" id="mobile" maxlength="30" placeholder="Enter Mobile" value="<?= $warden->mobile ?>" required>
                                  <?php echo '<span class="error">'. form_error('mobile').'</span>'; ?>
                                </div>  
                              </div>
                            </div>              
                          </div>

                          <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="domicile" class="col-sm-3 control-label">District of Domicile</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" name="domicile" id="domicile" maxlength="30" value="<?= $warden->district_of_domicile ?>" placeholder="Enter Domicile" required>
                                  <?php echo '<span class="error">'. form_error('domicile').'</span>'; ?>
                                </div>  
                              </div>
                            </div>  
                              
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="present_address" class="col-sm-3 control-label">Present Address</label>
                                <div class="col-sm-9">
                                  <textarea name="present_address" class="form-control" placeholder="Enter Present Address" ><?= $warden->present_address ?></textarea>
                                  <?php echo '<span class="error">'. form_error('present_address').'</span>'; ?>
                                </div>  
                              </div>
                            </div>              
                          </div>

                          <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="permanent_address" class="col-sm-3 control-label">Permanent Address</label>
                                <div class="col-sm-9">
                                  <textarea name="permanent_address" class="form-control" placeholder="Enter Present Address"><?= $warden->permanent_address ?></textarea>
                                  <?php echo '<span class="error">'. form_error('permanent_address').'</span>'; ?>
                                </div>  
                              </div>
                            </div>    

                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="image" class="col-sm-3 control-label">Image</label>
                                <div class="col-sm-9">
                                  <br>
                                    <input type="file" name="image" required>
                                    <input type="hidden" name="old_img" value="<?= $warden->Image ?>" required>
                                </div>
                              </div>
                            </div>          
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Education -->

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="panel panel-default">
                        <div class="panel-heading"><h4><b>Education</b></h4></div>
                        <div class="panel-body">
                          
                          <div class="row">
                            
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="qualification" class="col-sm-3 control-label">Qualification</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" name="qualification" id="qualification" maxlength="30" value="<?= $warden->qualification ?>" placeholder="Enter Qualification" required>
                                  <?php echo '<span class="error">'. form_error('qualification').'</span>'; ?>
                                </div>  
                              </div>
                            </div>  
                              
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="belt_no" class="col-sm-8 control-label">Computer Literate(MS Office/Email & Web)</label>
                                <div class="col-sm-3">
                                  <div class="radio">
                                    <label>
                                      <input type="radio" name="computer_literate" id="optionsRadios1" value="yes" <?php echo ($warden->computer_literate == "yes") ? 'checked="checked"' : ''; ?>>
                                      Yes
                                    </label>
                                  </div>
                                  <div class="radio">
                                    <label>
                                      <input type="radio" name="computer_literate" id="optionsRadios2" value="no" <?php echo ($warden->computer_literate == "no") ? 'checked="checked"' : ''; ?>>
                                      No
                                    </label>
                                  </div>
                                  <?php echo '<span class="error">'. form_error('computer_literate').'</span>'; ?>
                                </div>  
                              </div>
                            </div>              
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Entry in Police Department -->

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="panel panel-default">
                        <div class="panel-heading"><h4><b>Entry in Police Department</b></h4></div>
                        <div class="panel-body">
                          <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="service_group" class="col-sm-3 control-label">Service Group</label>
                                <div class="col-sm-9">
                                  <select name="service_group" class="form-control">
                                    <option value="<?= $warden->service_group ?>" selected><?= $warden->service_group ?></option>
                                    <option>Police</option>
                                    <option>Warden</option>
                                  </select>
                                  <?php echo '<span class="error">'. form_error('service_group').'</span>'; ?>
                                </div>  
                              </div>
                            </div>  
                              
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="designation" class="col-sm-3 control-label">Rank/Designation</label>
                                <div class="col-sm-9">
                                  <input type="text" name="designation" class="form-control" placeholder="Enter Designation/Rank" value="<?= $warden->designation ?>">  
                                  <?php echo '<span class="error">'. form_error('designation').'</span>'; ?>
                                </div>  
                              </div>
                            </div>              
                          </div>

                          <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="current_designation" class="col-sm-3 control-label">Current Designation</label>
                                <div class="col-sm-9">
                                  <input type="text" name="current_designation" class="form-control" value="<?= $warden->current_designation ?>" placeholder="Enter Current Designation">  
                                  <?php echo '<span class="error">'. form_error('current_designation').'</span>'; ?>
                                </div>  
                              </div>
                            </div>  
                              
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="d_o_j" class="col-sm-3 control-label">Date of Joining</label>
                                <div class="col-sm-9">
                                  <input type="date" name="d_o_j" value="<?= $warden->date_of_joining ?>" class="form-control" placeholder="Enter Designation/Rank">  
                                  <?php echo '<span class="error">'. form_error('d_o_j').'</span>'; ?>
                                </div>  
                              </div>
                            </div>              
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Duty Information -->

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="panel panel-default">
                        <div class="panel-heading"><h4><b>Duty Information</b></h4></div>
                        <div class="panel-body">
                          <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="image" class="col-sm-3 control-label">Circle</label>
                                <div class="col-sm-9">
                                    <select name="circle" class="form-control" onchange="getSector(this)">
                                      <option value="<?= $warden->circle ?>" selected><?= $warden->circle ?></option>

                                      <?php foreach ($circles as $circle): ?>
                                        
                                        <option value="<?php echo $circle->id ?>"><?php echo $circle->circle_and_sector ?></option>

                                      <?php endforeach ?>

                                    </select>
                                </div>
                              </div>

                              <div class="add_sector">
                                <div class="form-group">
                                  <label for="sector" class="col-sm-3 control-label">Sector</label>
                                  <div class="col-sm-9">
                                    <select name="sector" class="form-control" onchange="get_duty_point(this)" required>';
                                    <option value="<?= $warden->sector_id ?>" selected><?= $warden->sector ?></option>
                                    <?php foreach ($sectors as $sector): ?>
                                      
                                      <option value="<?= $sector->id ?>"> <?= $sector->circle_and_sector ?> </option>';

                                    <?php endforeach; ?>

                                    </select>
                                  </div>
                                </div>';
                              </div>

                              <div class="duty_points">
                                <div class="form-group">
                                  <label for="sector" class="col-sm-3 control-label">Duty Points</label>
                                  <div class="col-sm-9">
                                    <select name="duty_point" class="form-control" required>';
                                      <option value="<?= $warden->duty_point ?>"><?= $warden->duty_point ?></option>  
                                      <?php foreach ($duty_points as $duty_point): ?>

                                        <option value="<?= $duty_point->id ?>"> <?php echo $duty_point->duty_point ?> </option>';
                                        
                                      <?php endforeach; ?>

                                    </select>
                                  </div>
                                </div>';
                              </div>
                            </div>  
                              
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="shift" class="col-sm-3 control-label">Shift</label>
                                <div class="col-sm-9">
                                  <select name="shift" class="form-control" required>
                                    <option value="<?= $warden->shift ?>" selected><?= $warden->shift ?></option>
                                    <option>Morning</option>
                                    <option>Eevning</option>
                                    <option>Night</option>
                                  </select>
                                  <?php echo '<span class="error">'. form_error('shift').'</span>'; ?>
                                </div>
                              </div>
                            </div>              
                          </div>

                          <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="str_date" class="col-sm-3 control-label">Start Date</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" name="str_date" id="str_date" value="<?= $warden->start_date ?>" maxlength="30" required>
                                    <?php echo '<span class="error">'. form_error('str_date').'</span>'; ?>
                                </div>
                              </div>
                            </div>  
                              
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="end_date" class="col-sm-3 control-label">End Date</label>
                                <div class="col-sm-9">
                                  <input type="date" class="form-control" name="end_date" id="end_date" maxlength="30" value="<?= $warden->end_date ?>" required>
                                  <?php echo '<span class="error">'. form_error('end_date').'</span>'; ?>
                                </div>
                              </div>
                            </div>              
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-offset-5 col-sm-3">
                       <a href="<?php echo base_url().'admin/get_license_list'; ?>" class="btn btn-default">Cancel</a>
                        <button type="reset" class="btn btn-default">Reset</button>
                        <button type="submit" class="btn btn-info">Submit</button>
                    </div>
                  </div>  
                  <br>
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

    // console.log(id);
    
    $.ajax({

      url: '<?php echo base_url()?>dashboard/Traffic_wardens/get_duty_point/'+id,
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

      url: '<?php echo base_url()?>dashboard/Traffic_wardens/get_sector/'+id,
      
      success: function(data)
      {
        $('.add_sector').html(data);
      }
    });
}

function get_duty_point(duty_id)
{
    var id = duty_id.value;

    console.log(id);

    $.ajax({

      url: '<?php echo base_url()?>dashboard/Traffic_wardens/get_duty_points/'+id,
      
      success: function(data)
      {
        $('.duty_points').html(data);
      }
    });
}

</script>