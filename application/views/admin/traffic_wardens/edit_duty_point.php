
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $heading;?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Traffic Warden Duty Point</li>
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
                  <h3 class="box-title">Traffic Warden Duty Point</h3>
                </div>
                <!-- /.box-header -->
                
                <!-- form start -->
                <form class="form-horizontal" action="<?php echo base_url()?>dashboard/Traffic_wardens/duty_point_update" method="post" enctype="multipart/form-data">
                  <div class="box-body">

                    <div class="form-group">
                      <label class="col-sm-3 control-label">Select Circle</label>
                      <div class="col-sm-6">
                      <select name="circle" class="form-control" onchange="getSector(this)">
                          <option value="<?php echo $get_circle[0]->circle_id ?>" selected = ""><?= $get_circle[0]->circle_and_sector ?></option>

                          <?php foreach ($circles as $circle): ?>
                            
                            <option value="<?php echo $circle->id ?>"><?php echo $circle->circle_and_sector ?></option>

                          <?php endforeach ?>

                        </select>

                        <?php echo '<span class="error">'. form_error('circle').'</span>'; ?>
                      </div>
                    </div>

                    <div class="add_sector">
                      <div class="form-group">
                        <label for="sector" class="col-sm-3 control-label">Sector</label>
                        <div class="col-sm-6">
                            <select name="sector" class="form-control">

                              <option value="<?= $get_sector[0]->sector_id ?>" selected=""> <?= $get_sector[0]->circle_and_sector ?> </option>

                              <?php foreach ($sectors as $sector): ?>
                                
                                <option value="<?php echo $sector->id ?>"> <?php echo $sector->circle_and_sector ?></option>

                              <?php endforeach ?>

                            </select>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-3 control-label">Duty Point</label>
                      <div class="col-sm-6">
                          <input type="text" class="form-control" name="duty_point" value="<?php echo $get_circle[0]->duty_point ?>" maxlength="30" placeholder="Traffic Warden Duty Point" required>
                          <?php echo '<span class="error">'. form_error('duty_point').'</span>'; ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-3 control-label">Latitude</label>
                      <div class="col-sm-6">
                          <input type="text" class="form-control" name="lat" id="lat" value="<?php echo $get_circle[0]->latitude ?>" maxlength="30" placeholder="Enter Latitude" required>
                          <?php echo '<span class="error">'. form_error('lat').'</span>'; ?>
                      </div>
                    </div>              
                    
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Longitude</label>
                      <div class="col-sm-6">
                          <input type="text" class="form-control" name="long" id="long" value="<?php echo $get_circle[0]->longitude ?>" maxlength="30" placeholder="Enter Logitude" required>
                          <?php echo '<span class="error">'. form_error('long').'</span>'; ?>
                      </div>
                    </div>

                    <input type="hidden" name="id" value="<?php echo $get_circle[0]->duty_point_id ?>">

                  <!-- /.box-body -->
                  <div class="box-footer">
                    <div class="col-sm-offset-3 col-sm-3">
                        <button type="reset" class="btn btn-default">Reset</button>
                        <button type="submit" class="btn btn-info">Update</button>
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

function getSector(sel)
{
    var id = sel.value;

    $.ajax({

      url: '<?php echo base_url()?>dashboard/Traffic_wardens/duty_point_sector/'+id,
      
      success: function(data)
      {
        $('.add_sector').html(data);
      }
    });
}

</script>