<?php 
	if(isset($_POST['key']) && $_POST['key']=='528')
	{
		include '../db.php';
		
		$id=$_POST['id'];
		$action=$_POST['action'];
		if($action=='Enable')
		{
	    	$sql="SELECT name,username FROM user WHERE type=? AND status='2'";
	    	$sql_stmt=mysqli_prepare($con,$sql);
	    	mysqli_stmt_bind_param($sql_stmt,'s',$id);
	    	mysqli_stmt_execute($sql_stmt);
			if($res=mysqli_stmt_get_result($sql_stmt))
			{
				if(mysqli_num_rows($res)==0)
				{
					echo "No Records Available";
				}
				else
				{
					?><select name="name" class="form-control1"><?php
					while($row=mysqli_fetch_array($res))
					{
						?><option value="<?php echo $row['username']; ?>"><?php echo $row['name']; ?></option>	<?php
					}
					?></select><?php
				}
			}
		}
		else if($action=="Disable")
		{
			$sql="SELECT name,username FROM user WHERE type=? AND status='1'";
	    	$sql_stmt=mysqli_prepare($con,$sql);
	    	mysqli_stmt_bind_param($sql_stmt,'s',$id);
	    	mysqli_stmt_execute($sql_stmt);
			if($res=mysqli_stmt_get_result($sql_stmt))
			{
				if(mysqli_num_rows($res)==0)
				{
					echo "No Records Available";
				}
				else
				{
					?><select name="name" class="form-control1">
						<label>Select the User:</label><?php
					while($row=mysqli_fetch_array($res))
					{
						?><option value="<?php echo $row['username']; ?>"><?php echo $row['name']; ?></option>	<?php
					}
					?></select><?php
				}
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