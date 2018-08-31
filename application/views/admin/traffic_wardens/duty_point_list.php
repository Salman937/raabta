  <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/style.css" type="text/css">


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $heading; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Traffic Wardens Duty Point List</li>
      </ol>
    </section>
    
    <!-- Main content dataTable -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Traffic Wardens Duty Points</h3>
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
                    <th>Duty Point</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php if (empty($duty_points)): ?>

                    <tr>
                      <td>
                        Duty Points Not Available
                      </td>  
                    </tr>

                  <?php else: ?>
                  
                    <?php foreach ($duty_points as $duty_point): ?>

                    <tr>
                      <td> <?php echo $duty_point->duty_point ?> </td>
                      <td> <?php echo $duty_point->latitude ?> </td>
                      <td> <?php echo $duty_point->longitude ?> </td>
                      <td class="pull-left">
                          <a href="<?php echo base_url('dashboard/Traffic_wardens/duty_point_delete/'.$duty_point->id.'') ?>" title="Delete">
                            <button type="button" class="btn btn-danger btn-xs">
                              <i class="fa fa-trash"></i>
                            </button> 
                          </a>
                          <a href="<?php echo base_url('dashboard/Traffic_wardens/duty_point_edit/'.$duty_point->id.'') ?>" title='Edit'>
                            <button type="button" class="btn btn-info btn-xs">
                              <i class="fa fa-pencil"></i>
                            </button>
                          </a>  
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

<!-- DataTables -->
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
