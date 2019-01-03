  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $heading; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Print Complaint</li>
      </ol>
    </section>
    
    <!-- Main content dataTable -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">ALL Complaints List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="col-md-6 col-md-offset-2">
                    <a class="btn btn-default" href="javascript:window.print()" >
                    <i class="fa fa-print" aria-hidden="true"></i> Print
                    </a>
                    <br>
                    <br>
                    <ul class="list-group">
                        <li class="list-group-item"><b>Name: <span class="pull-right"><?= $print[0]->name ?></span></b></li>
                        <li class="list-group-item"><b>Email: <span class="pull-right"><?= $print[0]->email ?></span></b></li>
                        <li class="list-group-item"><b>District: <span class="pull-right"><?= $print[0]->district ?></span></b></li>
                        <li class="list-group-item"><b>Cnic: <span class="pull-right"><?= $print[0]->cnic ?></span></b></li>
                        <li class="list-group-item"><b>Phone No: <span class="pull-right"><?= $print[0]->phone ?></span></b></li>
                        <li class="list-group-item"><b>Status: <span class="pull-right"><?= $print[0]->status ?></span></b></li>
                        <li class="list-group-item" style="height:200px"><b>Description: <span class="pull-right"><?= $print[0]->description ?></span></b></li>
                    </ul>
                </div>
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

