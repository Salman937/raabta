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
        <li class="active">Cricle List</li>
      </ol>
    </section>
    
    <!-- Main content dataTable -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Cicle List</h3>
              <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-circle"></i> Add New Sector</button>
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
                    <th>Circles</th>
                    <th>Sectors</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php if (empty($sectors)): ?>

                    <tr>
                      <td>
                        Sectors Not Available
                      </td>  
                    </tr>

                  <?php else: ?>
                  
                    <?php foreach ($sectors as $sector): ?>

                        
                        <tr>
                          <td> 
                              <?php echo $sector->head_circle ?> 
                          </td>
                          
                          <td> 
                              <?php echo $sector->sector ?> 
                          </td>
                         
                          <td class="pull-left">
                            <a href="<?php echo base_url('dashboard/Traffic_wardens/delete_sector/'.$sector->sector_id.'') ?>" title="Delete">
                              <button type="button" class="btn btn-danger btn-xs">
                                <i class="fa fa-trash"></i>
                              </button> 
                            </a>
                            <a href="<?php echo base_url('dashboard/Traffic_wardens/edit_sector/'.$sector->sector_id.'') ?>" title='Edit'>
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

<!-- Modal -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New Circle</h4>
      </div>
      <div class="modal-body">
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

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
      </form>
    </div>
  </div>
</div>
</div>

<!-- DataTables -->
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
