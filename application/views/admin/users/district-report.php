  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        District Report
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">District Report</li>
      </ol>
    </section>
    
    <!-- Main content dataTable -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All District Report </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                 <!-- session message -->
              <?php if($this->session->flashdata('msg')):?>
              <div class="callout callout-success" id="msg">
                  <p align = "center" style="position:relative; font-size:16px;">
                      <?=$this->session->flashdata('msg')?>
                  </p>
              </div>
              <?php endif;?>

              <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <a class="btn btn-success pull-right" href="javascript:window.print()" >
                      <i class="fa fa-print" aria-hidden="true"></i> Print
                    </a>
                <thead>
                  <tr>
                    <th>District</th>
                    <th>Pending</th>
                    <th>In Progress</th>
                    <th>Irrelevant</th>
                    <th>Not Understandable</th>
                    <th>Completed</th>
                    <!-- <th>Total Complaints</th> -->
                 </tr>
                </thead>
                <tbody>
                  <?php if (empty($district_results)): ?>
                    <tr>User Not Available</tr>

                  <?php else: ?>
                  
                    <?php foreach ($district_results as $get_district): ?>
                    <tr>
                      <td>
                        <?php echo $get_district->district ?>
                      </td>
                      <?php foreach ($get_district->level2 as $district_result): ?>

                        <td> 
                          <?php echo $district_result->total_complaint_status ?>
                        </td>

                      <?php endforeach; ?>
                    </tr>  
                  <?php endforeach; ?>

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
