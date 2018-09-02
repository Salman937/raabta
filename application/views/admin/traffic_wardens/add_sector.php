
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $heading;?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Sector</li>
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
                  <h3 class="box-title">Add New Sector</h3>
                </div>
                <!-- /.box-header -->
                
                <!-- form start -->
                <form class="form-horizontal" action="<?php echo base_url()?>dashboard/Traffic_wardens/add_new_sector" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Select Circle</label>
                      <div class="col-sm-6">
                          <select name="circle" class="form-control" required>
                            <option value="">Select Circle</option>

                            <?php foreach ($circles as $circle): ?>
                              <option value="<?php echo $circle->id ?>"><?php echo $circle->circle_and_sector ?></option>
                            <?php endforeach ?>

                          </select>
                          <?php echo '<span class="error">'. form_error('add_sector').'</span>'; ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Add Sector</label>
                      <div class="col-sm-6">
                          <input type="text" class="form-control" name="add_sector" id="add_sector" placeholder="Add New Sector" required>
                          <?php echo '<span class="error">'. form_error('add_sector').'</span>'; ?>
                      </div>
                    </div>
                  </div>

                  <!-- /.box-body -->
                  <div class="box-footer">
                    <div class="col-sm-offset-3 col-sm-3">
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
  
</script>