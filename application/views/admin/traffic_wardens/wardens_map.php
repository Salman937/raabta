
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $heading;?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Change warden place</li>
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
                <br>
                <!-- Date Filter -->
                <div class="row">
                <div class="col-sm-5 col-sm-offset-3">
                    <form class="" method="post" action="">
                        <div class="form-group">
                            <label for="startDate">Search Wardens </label>                  
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-users"></i>
                                </div>
                                <select name="search" class="form-control" id="search" onchange="filterMarkers(this.value);">
                                    <option>Search Users</option>

                                    <?php foreach($wardens as $warden): ?>
                                        <option value="<?php echo $warden->personal_no ?>"><?php  echo $warden->name ?></option>
                                    <?php endforeach; ?>    
                                </select>
                                <!-- <input type="text" class="form-control" name="dated" id="datepicker" onchange="filterMarkers(this.value);" placeholder="Start Date"> -->
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-1">
                    <button class="btn btn-info" onclick="initialize()" style="margin-top:1.8em"><i class="fa fa-refresh" aria-hidden="true"></i> Refresh</button>
                </div>  
                </div> 
                <br>
                <div class="row">
                  <div class="col-sm-11 show_user" style="margin:0px 2em">
                    
                  </div>
                </div>
                <!-- form start -->
                 <div id="map" style="width: 100%; height: 500px;"></div>

                 <input type="hidden" name="mytext" class="mytext">
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

<!-- <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCe0I76FCBsgJP2dh193EWuX2IPST4gn0k&sensor=false"></script> -->
          
<script type="text/javascript">

var locations = 
[
  <?php foreach ($wardens as $value) 
  {
?>  

  ['<?php echo $value->name ?>', <?php echo $value->latitude ?>, <?php echo $value->longitude ?>],

<?php
  } 
?>
];

  var latitude= [];
  var longitude= [];
  var user_name=[];
  var circle_id=[];
  var belt_no=[];
  var designation=[];
  var phone_number=[];
  var shift=[];
  var start_date=[];
  var img=[];
  var personl_number=[];
  var x=0;    
  var map = null; 
  var markerArray = []; 
  var infowindow; 

  <?php foreach ($wardens as $row) : ?>

      latitude.push(<?php echo $row->latitude; ?>);
      longitude.push(<?php echo $row->longitude; ?>);
      user_name.push("<?php echo $row->name  ?>");
      belt_no.push(<?php echo $row->belt_no; ?>);
      designation.push('<?php echo $row->designation; ?>');
      phone_number.push(<?php echo $row->mobile; ?>);
      shift.push('<?php echo $row->shift ?>');
      start_date.push(<?php echo $row->start_date;?>) ;
      circle_id.push(<?php echo $row->circle_id;?>) ;
      img.push("<?php echo $row->Image; ?>");
      personl_number.push("<?php echo $row->personal_no; ?>");

  <?php endforeach; ?>

      x = <?php echo count($wardens); ?>;

      function initialize() {
          var myOptions = {

              zoom: 12,
              center: new google.maps.LatLng(33.995476, 71.486102),
              mapTypeControl: true,
              mapTypeControlOptions: {
                  style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
              },
              navigationControl: true,
              mapTypeId: google.maps.MapTypeId.ROADMAP
          }
          map = new google.maps.Map(document.getElementById("map"), myOptions);

          infowindow = new google.maps.InfoWindow({
              size: new google.maps.Size(150, 50)
          });

          google.maps.event.addListener(map, 'click', function() {
              infowindow.close();
          });

          for (var i = 0; i < x; i++) {
              createMarker(new google.maps.LatLng(latitude[i],longitude[i]),belt_no[i],designation[i],phone_number[i],img[i],shift[i],start_date[i],circle_id[i],user_name[i]);
          }
      }

      var onMarkerClick = function() {
        var marker = this;
        var latLng = marker.getPosition();
        var designation = marker.content;
                
          // convert latlng to address
          var geocoder = new google.maps.Geocoder();
          var addr;
          var latLng = new google.maps.LatLng(latLng.lat(), latLng.lng());
         
              geocoder.geocode({      
                  latLng: latLng
                  }, 
                   function(responses) 
                      {
                         if (responses && responses.length > 0) 
                         {        
                              addr = responses[0].formatted_address;
                              infowindow.setContent('<p><b>Location: </b>'+addr+'</p><p>'+designation+'</p>');
                         } 
                         else 
                         {       
                              //alert('Not getting Any address for given latitude and longitude.');
                              infowindow.setContent('<p><b>Location: </b>No Address Found</p><p><b>Complaint Description: </b>'+designation+'</p>');
                         }
                      }
              );
        infowindow.open(map, marker);
      };
  
   
  function createMarker(latlng,belt_no,designation,phone_number,img,shift,start_date,circle_id,user_name){
     //console.log(JSON.stringify(latlng));
      
      var icon = "";

      switch (circle_id) 
      {
          case 2:
              icon = "yellow";
              break;                      
          case 5:
              icon = "purple";   
              break;
          case 6:
              icon = "red";
              break;
          case 7:
              icon = "pink";
              break;
          default:
              icon = "red";    
      }

      icon = "http://maps.google.com/mapfiles/ms/icons/"+icon+"-dot.png";

     var marker = new google.maps.Marker({
          position: latlng,
          icon: icon,
          animation: google.maps.Animation.DROP,
          content: '<p><b>Name: </b>'+user_name+'</p><p><b>Designation: </b>'+designation+'</p><p><b>Belt No: </b>'+belt_no+'</p><p><b>Phone Number: </b>'+phone_number+'</p>'+'</p><p><button onclick="kmladd('+phone_number+')" class="btn btn-success btn-xs">Show More</button></p>',
          
          dated: start_date,
          map: map,
          title: 'Click for more details',
          visible: true
      });
      
      google.maps.event.addListener(marker, 'click', onMarkerClick);
      markerArray.push(marker);
  }

  /**
   * Function to filter markers by date
   */
  filterMarkers = function(user) 
  {
      for (i = 0; i < markerArray.length; i++) 
      {
          // If is same dated or dated not picked
          if (personl_number[i] == user || personl_number.length === 0) {
              markerArray[i].setVisible(true);
          }
              // complaint status don't match 
          else {
              markerArray[i].setVisible(false);
          }
      }
  }

  window.onload = initialize;

</script>

<script>

function kmladd(ph_no)
{

    $.ajax({

        url: '<?php echo base_url() ?>dashboard/User/get_map_user_list/'+ph_no,
        
        success: function(data)
        {
            $('.show_user').html(data);
        }
    });
}

</script>
