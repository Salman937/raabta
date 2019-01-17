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
              <h3 class="box-title">ALL Users List</h3>
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
                    <th>Username</th>
                    <th>Email</th>
                    <th>District</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php if (empty($users)): ?>
                    <tr>User Not Available</tr>

                  <?php else: ?>
                  
                    <?php foreach ($users as $user): ?>

                    <tr>
                      <td> <?php echo $user->admin_name ?> </td>
                      <td> <?php echo $user->admin_email ?> </td>
                      <td> <?php echo $user->admin_district ?> </td>
                      <td>
                        <?php echo anchor('dashboard/user/delete/'.$user->admin_id.'', 
                          '<button type="button" class="btn btn-danger btn-xs">
                            <i class="fa fa-trash"></i>
                          </button>', 'title="News title"'); 
                        ?>
                          <button type="button" edit="<?= $user->admin_id ?>" data-toggle="modal" data-target="#myModal" class="btn btn-info btn-xs update">
                            <i class="fa fa-pencil"></i>
                          </button>
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


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update User</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" action="<?php echo base_url()?>dashboard/User/update" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label for="lic_number" class="col-sm-3 control-label">Username</label>
              
              <div class="col-sm-6">
                  <input type="text" class="form-control" name="username" id="username" maxlength="30" placeholder="Enter Username">
                  <?php echo '<span class="error">'. form_error('username').'</span>'; ?>
              </div>
            </div>              
            
            <div class="form-group">
              <label for="cnic" class="col-sm-3 control-label">Email</label>
              
              <div class="col-sm-6">
                <input type="text" class="form-control" name="email" id="email" maxlength="50" placeholder="Enter Email">
                <?php echo '<span class="error">'. form_error('email').'</span>'; ?>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-3 control-label">Select User District</label>
              <div class="col-sm-6">
                  <select name="district" id="update_district" class="form-control">
                    <option value="bannu">Bannu</option>
                    <option value="lakki marwat">Lakki Marwat</option>
                    <option value="dera ismail khan">Dera Ismail Khan</option>
                    <option value="tank">Tank</option>
                    <option value="abbottabad">Abbottabad</option>
                    <option value="battagram">Battagram</option>
                    <option value="haripur">Haripur</option>
                    <option value="lower kohistan">Lower Kohistan</option>
                    <option value="mansehra">Mansehra</option>
                    <option value="torghar">torghar</option>
                    <option value="upper kohistan">Upper Kohistan</option>
                    <option value="hangu">Hangu</option>
                    <option value="karak">Karak</option>
                    <option value="kohat">Kohat</option>
                    <option value="mardan">Mardan</option>
                    <option value="charsadda">charsadda</option>
                    <option value="nowshera">Nowshera</option>
                    <option value="peshawar">Peshawar</option>
                  </select>
                  <?php echo '<span class="error">'. form_error('district').'</span>'; ?>
              </div>
            </div>

            <div class="form-group">
              <label for="password" class="col-sm-3 control-label">Password</label>
              <div class="col-sm-6">
                <input type="password" class="form-control" id="myInput" name="password" id="password" maxlength="50" placeholder="Update Password">
                <input type="checkbox" onclick="myFunction()"> Show Password
              </div>
            </div>
                    
            <input type="hidden" name="id" id="edit">
            <input type="hidden" name="old_pass" id="old_pass">

          </div>
          
      </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
      </form>
    </div>
  </div>
</div>


<!-- DataTables -->
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>


<script>
$("body").on('click','.update',function(event) 
 {
     event.preventDefault();
     // body...
     var id = $(this).attr('edit');

     $.ajax({

         url : "<?php bs('dashboard/User/edit') ?>/"+id,

         success :function (success) 
         {
             var obj = $.parseJSON(success);
             $("#username").val(obj.admin_name);
             $("#email").val(obj.admin_email);
             $("#update_district").val(obj.admin_district);
             $("#edit").val(obj.admin_id);
             $("#old_pass").val(obj.admin_password);
         }

     })
 });

 function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>