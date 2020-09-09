<!-- <div class="table-responsive text-center">
		<table class="table table-bordered">
			<tr><th>Date of Visit</th><th>Name of Institution</th><th>Name of Visited Officer</th><th>View FeedBacks</th></tr> -->
			<div class="row text-center">
	<?php
    include '../db.php';
  	$search=$_POST['search'];
	$sql="SELECT * FROM assign_task INNER JOIN user ON assign_task.visiting_officer=user.username WHERE date LIKE '%$search%' OR institution LIKE '%$search%' OR user.name LIKE '%$search%'";
  
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
	else
	{
		echo mysqli_error($con);
	}
    
?>
</table>
</div>