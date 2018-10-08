
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
                  <h3 class="box-title">Add New User</h3>
                </div>
                <!-- /.box-header -->
                
                <!-- form start -->
                <form class="form-horizontal" action="<?php echo base_url()?>dashboard/User/add" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="lic_number" class="col-sm-3 control-label">Username</label>
                      
                      <div class="col-sm-6">
                          <input type="text" class="form-control" name="username" id="username" maxlength="30" placeholder="Enter Username" required>
                          <?php echo '<span class="error">'. form_error('username').'</span>'; ?>
                      </div>
                    </div>              
                    
                    <div class="form-group">
                      <label for="cnic" class="col-sm-3 control-label">Email</label>
                      
                      <div class="col-sm-6">
                        <input type="text" class="form-control" name="email" id="email" maxlength="50" placeholder="Enter Email" required>
                        <?php echo '<span class="error">'. form_error('email').'</span>'; ?>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="name" class="col-sm-3 control-label">Password</label>
                      <div class="col-sm-6">
                        <input type="password" class="form-control" name="password" id="pass" placeholder="Enter Password" required>
                        <?php echo '<span class="error">'. form_error('password').'</span>'; ?>
                      </div>
                    </div>  
                     
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Select User District</label>
                      <div class="col-sm-6">
                          <select name="district" id="district" class="form-control" required>
                            <option value="">Select District</option>

                            <?php foreach ($districts as $district): ?>
                              <option value="<?php echo $district->slug ?>" ><?php echo $district->name ?></option>
                            <?php endforeach ?> 
                          </select>
                          <?php echo '<span class="error">'. form_error('district').'</span>'; ?>
                      </div>
                    </div>
                             
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
