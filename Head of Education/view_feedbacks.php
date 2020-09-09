<?php 
  
  if(isset($_SESSION['key']) && $_SESSION['key']=='123')
  {
?>
<!DOCTYPE html>
<html>
<head>
	<title>View Feedbacks</title>
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
	<form id="frm">
	<div class="form-group">
		<img src="../images/search.png" class="input_img" />
		<input type="text" name="search" id="search" class="form-fields" placeholder="Search By Date,Institution and Visiting Officer" style="border:2px solid #16336d" />
		<input type="hidden" value="789" name="key">
	</div>
	</form>
	<br/>
	<div id="res_search">
		<div class="row text-center">
	<!-- <div class="table-responsive text-center">
		<table class="table-sm table-bordered">
			<tr><th>Date of Visit</th><th>Name of Institution</th><th>Name of Visited Officer</th><th>View FeedBacks</th></tr> -->
	<?php
    include '../db.php';
  
	$sql="SELECT * FROM assign_task INNER JOIN user ON assign_task.visiting_officer=user.username WHERE assign_task.status='Visited' AND assign_task.feedback='1'  ORDER BY date";
  
	if($res=mysqli_query($con,$sql))
	{
		if(mysqli_num_rows($res)!=0)
		{
		$i=0;
		while($row=mysqli_fetch_array($res))
		{
			
			?><div class="col-sm-4 p-2"><div class="card"><div class="card-header"><?php echo date_format(date_create($row["date"]),"d-m-Y"); ?></div><div class="card-body" style="width: 100%"><div><?php echo $row['name']; ?><?php echo " visited ".$row['institution']; ?></div><br/><form method="POST" action="view_feedback_details.php"><input type="hidden" value="<?php echo $row['date']; ?>" name="date" >
				<input type="hidden" value="<?php echo $row['institution']; ?>" name="nsc" >
				<input type="hidden" value="<?php echo $row['visiting_officer']; ?>" name="vo" ><input type="hidden" name="key" value="789"><button type="submit"  class="btn btn-info avf" >View Feedback
    		</button></form></div></div></div><?php
    		$i++;
		}
		}
		else
		{
			?><tr><td colspan="5">Sorry! No Records Found.</td></tr><?php 
		}
	}
    
?>

</div>
</div>
</div>
 <br/>
<div ><?php include '../footer.php'; ?></div>
<script type="text/javascript">
	$(document).on("click", ".avf", function(){
		//alert("ji");
        
        
        
        
    });
    $('#search').on('input',function()
    {
    	//alert("ji");
    	 $.ajax({
	        url:"search_feedback.php",
	        type:"POST",
	        data:$('#frm').serialize(),
	        success:function(result){
	        	//alert("hi");
	            $('#res_search').html(result);
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