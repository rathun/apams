<?php 
  
  if(isset($_SESSION['key']) && $_SESSION['key']=='123')
  {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Institution</title>
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

<div class="container">
  <div class="text-center"><h3>Add New Institution</h3></div>
  <div class="row text-center">
	<!-- <div class="table-responsive text-center">
		<table class="table table-bordered">
			<tr><th>Name of Instution</th><th>Photo</th><th>Registration Certificate</th><th>Location</th><th>Approve/Reject</th></tr> -->
	<?php
    include '../db.php';
  
	$sql="SELECT * FROM user INNER JOIN institution WHERE user.status='0' AND user.name=institution.name";
  
	if($res=mysqli_query($con,$sql))
	{
		if(mysqli_num_rows($res)!=0)
		{
		$i=0;
		while($row=mysqli_fetch_array($res))
		{
			$location=$row['latitude'].",".$row['longitude'];

			?>
      <input type="hidden" id="loc<?php echo $i; ?>" value="<?php echo $location; ?>">
      <input type="hidden" id="cer<?php echo $i; ?>" value="<?php echo $row['certificate']; ?>">
      <div class="col-sm-4 p-2">
      <div class="card">
        <div class="card-header">
          <?php echo $row['name'].",".$row['location']; ?>
        </div>
        <div class="card-body">
          <i class="btn" data-toggle="modal" data-target="#photo<?php echo $i; ?>" ><img src="../Profile/<?php echo $row['photo']; ?>" class="rounded" width="100px"></i>
          <br/>
          <i class="btn text-primary cer" id="<?php echo $i; ?>" style="text-decoration: none"><?php echo "Certificate No:".$row['certificate']; ?></i>
          <br/>
          <i class="btn text-success map" id="<?php echo $i; ?>" style="text-decoration: none">Map View</i><br/>
          <input type="hidden" value="<?php echo $row['username']; ?>" name="id" id="<?php echo 'fid'.$i; ?>"><button class="btn btn-success avf" id="<?php echo $i; ?>">✓<div class="spinner-border" id="load" style="display: none;cursor: none"></div>
    		</button>&nbsp;<button class="btn btn-danger avf1" id="<?php echo $i; ?>">✗
        </button>
      </div></div></div>
        
    <div class="modal" id="photo<?php echo $i; ?>">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Photo</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <img src="../Profile/<?php echo $row['photo']; ?>" width="100%">
        </div>
        
      </div>
    </div>
  </div>
  <?php
    		$i++;
		}
		}
		else
		{
			?><div class="card container"><div class="card-body">Sorry! No Records Found.</div></div><?php 
		}
	}
    
?>

</div>


  <div class="modal" id="map">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Location</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body" id="mapcon">
         
        </div>
        
        
        
      </div>
    </div>
  </div>
</div>
  <button type="button" class="btn btn-primary" style="display: none" id="modal" data-toggle="modal" data-target="#myModal1">
    Open modal
  </button>
  
<div class="fixed-bottom"><?php include '../footer.php'; ?></div>
<script type="text/javascript">
  // $('.cer').click(function()
  // {
  //   var f_id = $(this).attr("id");
  //   var idm=$('#cer'+f_id+'').val();
  //   window.open("http://192.168.1.104/AP-AMS/Files/"+idm,"_blank");
  // });
	$(document).on("click", ".avf", function(){
		//alert("ji");
        $('#load').show();
        
        var f_id = $(this).attr("id");
        var idf=$('#fid'+f_id+'').val();
        $(f_id).hide();
        $(f_id).hide();
        $.ajax({
            url: 'approve_institution.php',
            type: "POST",
            data:{id : idf,key:'789'},
            
            success: function(data) {
            	//alert("ji");
               alert(data);
                location.reload();
                
            },
            error: function(xhr, status, err) {
                alert("Error");
            }
        });     
        
      });
  $(document).on("click", ".avf1", function(){
    //alert("ji");
        $('#load').show();
        $('.avf').hide();
        $('.avf1').hide();
        var f_id = $(this).attr("id");
        var idf=$('#fid'+f_id+'').val();
        $.ajax({
            url: 'reject_institution.php',
            type: "POST",
            data:{id : idf,key:'789'},
            
            success: function(data) {
              //alert("ji");
                var res=$.trim(data);
                alert(red);
                location.reload();
                
            },
            error: function(xhr, status, err) {
                alert("Error");
            }
        });     
        
      });
	$(document).on("click", ".map", function(){
            
            var f_id = $(this).attr("id");
            var idm=$('#loc'+f_id+'').val();
            //alert(idm);
            $.ajax({
                url: 'map.php',
                type: "POST",
                data:{id : idm,key:'258'},
                
                success: function(data) {
                    $('#map').modal('show');
                    $('#mapcon').html(data);
                    
                },
                error: function(xhr, status, err) {
                    alert("Error");
                }
            });     
            
          });
</script>
</body>
</html>
<?php 
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