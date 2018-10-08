

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $heading; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Traffic Wardens</li>
      </ol>
    </section>
    
    <!-- Main content dataTable -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Traffic Wardens History</h3>
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
                    <th>Name</th>
                    <th>Belt No</th>
                    <th>Duty Point</th>
                    <th>Designation</th>
                    <th>Shift</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Duration</th>
                </tr>
                </thead>
                <tbody>
                  <?php if (empty($wardens)): ?>

                    <tr>
                      <td colspan="8s">
                        User History Not Available
                      </td>  
                    </tr>

                  <?php else: ?>
                  
                    <?php foreach ($wardens as $warden): ?>

                    <tr>
                      <td> <?php echo $warden->name ?> </td>
                      <td> <?php echo $warden->belt_no ?> </td>
                      <td> <?php echo $warden->duty_point  ?> </td>
                      <td> <?php echo $warden->designation ?> </td>
                      <td> <?php echo $warden->shift ?> </td>
                      <td> <?php echo date('m-d-Y',strtotime($warden->his_str_date)) ?> </td>
                      <td> <?php echo date('m-d-Y',strtotime($warden->his_end_date)) ?> </td>
                      <td>
                        
                      <?php 

                          $date1 = new DateTime($warden->his_str_date);
                          $date2 = new DateTime($warden->his_end_date);

                          $interval = $date1->diff($date2);

                          echo $interval->m." months, ".$interval->d." days "; 

                      ?>

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
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header card-header-title">
        <h4 class="modal-title card-element-title">User Profile Card</h4>
      </div>
      <div class="modal-body">
        <div class="card">
          <img src="https://simpleisbetterthancomplex.com/img/picture.jpg" id="my_image" alt="user_pic" style="width:35%">

            <div class="pull-right user-details">
            
              <h2 id="name"></h2>
              <p id="duty_point"></p>
              <p id="designation"></p>
              <p id="phone_no"></p>
              <p id="shift"></p>
              <p id="belt_no"></p>
              <p id="rank"></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>  
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

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

         url : "<?php bs('dashboard/Traffic_wardens/traffic_warden_card') ?>/"+id,

         success :function (success) 
         {
             var obj = $.parseJSON(success);
             // console.log(obj);
             $("#my_image").attr("src",obj.image);
             $("#name").html(obj.name);
             $("#duty_point").html('<b>Duty Point: </b>'+obj.duty_point);
             $("#designation").html('<b>Designation: </b>'+obj.Designation);
             $("#phone_no").html('<b>Phone Number: </b>'+obj.phone_number);
             $("#shift").html('<b>Shift: </b>'+obj.shift);
             $("#belt_no").html('<b>Belt No: </b>'+obj.belt_no);
             $("#rank").html('<b>Rank: </b>'+obj.rank);
         }

     })
 })
</script>
