<link rel="stylesheet" type="text/css" href="<?php bs() ?>assets/bootstrap/css/style.css">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $heading; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Warden History</li>
      </ol>
    </section>
    
    <!-- Main content dataTable -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box" id='printMe'>
            <div class="box-header">
              <h3 class="box-title">Traffic Warden History</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                 <!-- session message -->
              <?php if ($this->session->flashdata('msg')) : ?>
              <div class="callout callout-success" id="msg">
                  <p align="center" style="position:relative; font-size:16px;">
                      <?= $this->session->flashdata('msg') ?>
                  </p>
              </div>
              <?php endif; ?>

              <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                <caption class="text-center">
                    <button class="btn btn-success btn-xs" style="font-size:16px;font-weight:bold">Current Duty Point</button>

                    <button class="btn btn-default pull-right" onclick="printDiv('printMe')" ><i class="fa fa-print"></i>  Print</button>
                     <br><br>
                </caption>

                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Belt No</th>
                        <th>Duty Point</th>
                        <th>Designation</th>
                        <th>Shift</th>
                        <th>Start Date</th>
                        <th>Religion</th>
                    </tr>
                    <tr>
                        <td>
                            <?= $current_duty_point[0]->name ?>
                        </td>
                        <td>
                            <?= $current_duty_point[0]->belt_no ?>
                        </td>
                        <td>
                            <?= $current_duty_point[0]->duty_point ?>
                        </td>
                        <td>
                            <?= $current_duty_point[0]->designation ?>
                        </td>
                        <td>
                            <?= $current_duty_point[0]->shift ?>
                        </td>
                        <td>
                            <?=  date('d-m-Y', strtotime($current_duty_point[0]->start_date)) ?>
                        </td>
                        <td>
                            <?= $current_duty_point[0]->religion ?>
                        </td>
                    </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
                <br><br>
              <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                <caption class="text-center">
                    <button class="btn btn-success btn-xs" style="font-size:16px;font-weight:bold">Traffic Warden Duty Point History</button>
                    <br><br>
                </caption>

                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Belt No</th>
                        <th>Duty Point</th>
                        <th>Designation</th>
                        <th>Shift</th>
                        <th>Start Date</th>
                        <th>Religion</th>
                    </tr>
                    <?php foreach($duty_point_history as $history): ?>
                    <tr>
                        <td>
                            <?= $history->name ?>
                        </td>
                        <td>
                            <?= $history->belt_no ?>
                        </td>
                        <td>
                            <?= $history->duty_point ?>
                        </td>
                        <td>
                            <?= $history->designation ?>
                        </td>
                        <td>
                            <?= $history->shift ?>
                        </td>
                        <td>
                            <?=  date('d-m-Y', strtotime($history->start_date)) ?>
                        </td>
                        <td>
                            <?= $history->religion ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </thead>
                <tbody>
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
  
<script type="text/javascript">
    function printDiv(divName){
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    window.location.reload();
}
</script>