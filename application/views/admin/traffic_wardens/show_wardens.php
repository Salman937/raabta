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
        <li class="active">Traffic Wardens</li>
      </ol>
    </section>
    
    <!-- Main content dataTable -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">ALL Traffic Wardens</h3>
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
                    <th>Circle</th>
                    <th>Sector</th>
                    <th>Belt No</th>
                    <th>Duty Point</th>
                    <th>Designation</th>
                    <th>Shift</th>
                    <th>Start Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php if (empty($wardens)): ?>

                    <tr>
                      <td>
                        User Not Available
                      </td>  
                    </tr>

                  <?php else: ?>
                  
                    <?php foreach ($wardens as $warden): ?>

                    <tr>
                      <td> <?php echo $warden->name ?> </td>
                      <td> <?php echo $warden->circle ?> </td>
                      <td> <?php echo $warden->sector ?> </td>
                      <td> <?php echo $warden->belt_no ?> </td>
                      <td> <?php echo $warden->duty_point ?> </td>
                      <td> <?php echo $warden->designation ?> </td>
                      <td> <?php echo $warden->shift ?> </td>
                      <td> <?php echo date('m-d-Y',strtotime($warden->start_date)) ?> </td>
                      <td>
                           <button class='btn btn-success btn-xs'>current</button>
                      </td>
                      <td class="pull-right">
                      
                          <button type="button" edit="<?= $warden->warden_id ?>" data-toggle="modal" data-target="#myModal" class="btn btn-toolbar btn-xs update">
                            <i class="fa fa-eye"></i>
                          </button>

                          <a href="<?php bs('dashboard/Traffic_wardens/change_place/'.$warden->warden_id.'') ?>" title="Chnge Place"> 
                            <button type="button" class="btn btn-primary btn-xs">
                            <i class="fa fa-map-marker" aria-hidden="true"></i> 
                            </button> 
                          </a>
                        
                          <a href="<?php echo base_url('dashboard/Traffic_wardens/delete/'.$warden->warden_id.'') ?>" title="Delete">
                            <button type="button" class="btn btn-danger btn-xs">
                              <i class="fa fa-trash"></i>
                            </button> 
                          </a>
                          <a href="<?php echo base_url('dashboard/Traffic_wardens/edit/'.$warden->warden_id.'') ?>" title='Edit'>
                            <button type="button" class="btn btn-info btn-xs">
                              <i class="fa fa-pencil"></i>
                            </button>
                          </a>  
                          <a href="<?php echo base_url('dashboard/Traffic_wardens/wardens_history/'.$warden->warden_id.'') ?>" title="History">
                            <button type="button" class="btn btn-success btn-xs">
                              <i class="fa fa-history" aria-hidden="true"></i>
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
<div id="myModal" class="modal fade" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header card-header-title">
        <h4 class="modal-title card-element-title">User Profile Card</h4>
      </div>
      <div class="modal-body">
        <div class="card">
          <img src="https://simpleisbetterthancomplex.com/img/picture.jpg" id="my_image" alt="user_pic" style="width:40%;float: right;">

            <div class="pull-left user-details">
            
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
             console.log(obj);
             $("#my_image").attr("src",obj.Image);
             $("#name").html(obj.name);
             $("#duty_point").html('<b>Father/Husband Name: </b>'+obj.father_husband_name);
             $("#designation").html('<b>Designation: </b>'+obj.designation);
             $("#phone_no").html('<b>Phone Number: </b>'+obj.mobile);
             $("#shift").html('<b>Shift: </b>'+obj.shift);
             $("#belt_no").html('<b>Belt No: </b>'+obj.belt_no);
             $("#rank").html('<b>NIC NO: </b>'+obj.nic_no);
         }

     })
 })
</script>

<script>
  
  var timeout;
  var $cards = $(".card");
  var size = $cards.length - 1;

  function highlight(count){
    timeout = setTimeout(function(){ 
      $cards.removeClass("orange");
      $cards[count].classList.add("orange");
      
      clearTimeout(timeout);
      if(size === count){
         highlight((count - size));
      }else{
        highlight(count + 1);
      }
      
    }, 1000); 
  }

  $cards.off("click").on( "click", function() {
    clearTimeout(timeout);
  });

  highlight(0)

</script>