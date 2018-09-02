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

<!-- DataTables -->
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
