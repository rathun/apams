<?php 
if(isset($_POST['key']) && $_POST['key']=='456')
{


	include '../db.php';
	$id=$_POST['id'];
	$sq="SELECT * FROM assign_task WHERE id=?";
	$sql_stmt1 = mysqli_prepare($con,$sq);
	mysqli_stmt_bind_param($sql_stmt1,'s',$id);
	mysqli_stmt_execute($sql_stmt1);
	$res=mysqli_stmt_get_result($sql_stmt1);
	$row=mysqli_fetch_array($res);
	$sql="UPDATE assign_task SET `status`='Visited' WHERE id=? ";
	$sql_stmt = mysqli_prepare($con,$sql);
	mysqli_stmt_bind_param($sql_stmt,'s',$id);
	if(mysqli_stmt_execute($sql_stmt))
	{
		echo "Visited SuccessFully";
		$_SESSION['feed_key']="456";
		$_SESSION['feed_ins']=$row['institution'];
		$_SESSION['district']=$row['district'];
		$_SESSION['year']=$row['academic_year'];
	}
	else
	{
		echo mysqli_error($con);
	}
	
	}
	else
	{
		
		 ?>
    <script type="text/javascript">
      location.replace("view_assigned_task.php");
    </script>
    <?php
	}
?>