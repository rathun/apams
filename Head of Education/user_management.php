<?php 
	if(isset($_POST['key']) && $_POST['key']=='528')
	{
		include '../db.php';
		$type=$_POST['type'];
		$name=$_POST['name'];
		$action=$_POST['action'];
		if($action=="Enable")
		{
			$sql="UPDATE user SET status='1' WHERE username='$name' AND type='$type'";
			if(mysqli_query($con,$sql))
			{
				echo "Success!User Enabled SuccessFully.";
			}
			else
			{
				echo "Failed! Some Error Occured.<br/>".mysqli_error($con);
			}
		}
		else
		{
	    	$sql="UPDATE user SET status='2' WHERE username='$name' AND type='$type'";
			if(mysqli_query($con,$sql))
			{
				echo "Success!User Disabled SuccessFully.";
			}
			else
			{
				echo "Failed! Some Error Occured.<br/>".mysqli_error($con);
			}
		}
	}
	else
	{
		 ?>
    <script type="text/javascript">
      location.replace("user_management_form.php");
    </script>
    <?php
	}

	
	
?>