<?php 
  
  if(isset($_SESSION['key']) && $_SESSION['key']=='321')
  {
    if(isset($_SESSION['feed_ins']) && $_SESSION['feed_ins']=='')
    {
?>
<!DOCTYPE html>
<html>
<head>
	<title>View Assigned Task</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/home.css">
  <script src="../js/font.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     
     
   
</head>
<body>
<?php include 'header.php' ?>

<div class="container text-center">
  <h4><i>Assigned Task</i></h4>
  <?php 
  include '../db.php';
  
  
  
  $name=$_SESSION['email'];
  
  $date=date("Y-m-d");
  $sql="SELECT * FROM assign_task WHERE visiting_officer='$name' AND status!='Visited' AND date='$date' AND feedback!='1' ORDER BY date";
  if($res=mysqli_query($con,$sql))
  {
    ?><div class="row"><!-- <div class="table-responsive text-center"><table class="table table-bordered"><tr><th>Date of Visit</th><th>Name of School/College</th><th>Status</th></tr> --><?php
    if(mysqli_num_rows($res)==0)
    {
      ?><tr><td colspan="3">Sorry! No Records Found.</td></tr><?php
    }
    else
    {
        $i=0;
    while($row=mysqli_fetch_array($res))
    {
      $name=$row['institution'];
      ?>
      <div class="col-sm-4 p-2"><div class="card"><div class="card-header"><?php echo date_format(date_create($row["date"]),"d-m-Y"); ?></div><div class="card-body"><div><?php echo $name; ?></div><br/><div><form><input type="hidden" id="<?php echo 'id'.$i; ?>" name="id" value="<?php echo $row['id']; ?>"><input type="hidden" id="<?php echo 'id1'.$i; ?>" name="id" value="<?php echo $name; ?>"><button class="btn btn-success s" type="submit" id="<?php echo $i; ?>"><i>Visit Now</i></button></form></div></div></div></div><br/><?php
            $i++;
    }
  }
  }
?>

</div>



</div>
  
<div class="fixed-bottom"><?php include '../footer.php'; ?></div>

  <?php
    if(isset($_POST['loc']))
    {
      $loc=explode(",",$_POST['loc']);
      $lati=$loc[0];
      $loni=$loc[1];
    }
    else
    {
      $lati="";
      $loni="";
    }
    ?>
  <input type="hidden" value="<?php echo $lati; ?>" id="lat" >
  <input type="hidden" value="<?php echo $loni; ?>" id="lon">
    <form id="link_frm" action="https://api-geo-location.herokuapp.com/" method="POST">
      <input type="hidden" id="link" name="link">
      
    </form>
    <div class="modal" id="resmodal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title"><img src="../images/info.png" width="50px">&nbsp;Information</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body" id="error">
         
        </div>
        
       
      </div>
    </div>
  </div>
<script type="text/javascript">
  
  // navigator.geolocation.getCurrentPosition(onSuccess, onError);
    
  // function onSuccess(position) {
      
  // $('#lat').val(position.coords.latitude);
  // $('#lon').val(position.coords.longitude);
  
  // }
  // function onError(error) {
  //     alert('code: '    + error.code    + '\n' +
  //         'message: ' + error.message + '\n');
  // }
  
  if($('#lat').val()=="" && $('#lon').val()=="")
  {
    $('#link').val(window.location.href);
    //alert(window.location.href);
    document.getElementById("link_frm").submit();
  }
  
  
  
  $(document).on("click", ".s", function(e){
    e.preventDefault();
    var f_id = $(this).attr("id");
        var idf=$('#id1'+f_id+'').val();
        $.ajax({
            url: 'check_location.php',
            type: "POST",
            data:{id : idf},
            
            success: function(data) {
                var res=$.trim(data);
                var res = res.split(",");
                var lat2=res[0];
                var lon2=res[1];
                var radius=res[2];
                var lat1=$('#lat').val();
                var lon1=$('#lon').val();
                //alert(lat1+",sdaf"+lon1);
                //alert(lat2+",hfg"+lon2);
                var R = 6371; // Radius of the earth in km
                var dLat = deg2rad(lat2-lat1);  // deg2rad below
                var dLon = deg2rad(lon2-lon1); 
                
                var a = Math.sin(dLat/2) * Math.sin(dLat/2)+Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *Math.sin(dLon/2) * Math.sin(dLon/2);
                  
                var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
                var d = R * c ; // Distance in km
                //alert(d);
                if( Math.abs(d)<=radius)
                {
                  //var f_id = $(this).attr("id");
                  var idf1=$('#id'+f_id+'').val();
                  //alert(idf1);
                  $.ajax({
                      url: 'assigned_task.php',
                      type: "POST",
                      data:{id : idf1,key:'456'},
            
                    success: function(data) {
                        var res=$.trim(data);
                        // alert(res);
                        if(res=='Visited SuccessFully')
                        {
                          location.replace("give_feedback_form.php");
                        }
                        else
                        {
                          alert(res);
                        }
                
               
                
                      },
                      error: function(xhr, status, err) {
                          alert("Error");
                      }
                  });     
                }
                else
                {
                  
                  $('#resmodal').modal('show');
                  $('#error').html("<b>Your are "+d+" KM Away</b>");
                  $('#error').css('color', 'red');
                }
                
              
            function deg2rad(deg) {
            return deg * (Math.PI/180)
                         }
                          
                      },
            error: function(xhr, status, err) {
                alert("Error");
            }
        });     
      });
  
    //alert("hi");
    

</script>
</body>
</html>
<?php 
}
  else
  {
    header("location:give_feedback_form.php");
     ?>
    <script type="text/javascript">
      location.replace("give_feedback_form.php");
    </script>
    <?php
  }
  }
  else
  {
     ?>
    <script type="text/javascript">
      location.replace("../index.php");
    </script>
    <?php
  }
 ?>