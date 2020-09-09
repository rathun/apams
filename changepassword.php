<?php
	//DB Connect
	include 'db.php';
	//Checking for Session variable
	if(isset($_POST['key']) && $_POST['key']=='User')
  	{
	//Getting Form values and storing to variable
	$email=$_POST['email'];
	$old=$_POST['old'];
	//Encryting the Password
	//echo $old;
	$new=$_POST['new'];
	//Checking the old and new password values
	if($old == $new)
	{
		echo "Old & New Password are Same";
	}
	else
	{
	//Sql query to get the password form DB table
	$sql="SELECT password FROM user WHERE username=?";
	$sql_stmt = mysqli_prepare($con, $sql);
	mysqli_stmt_bind_param($sql_stmt, 's',$email);
	mysqli_stmt_execute($sql_stmt);		
	if($res=mysqli_stmt_get_result($sql_stmt))
	{
		if(mysqli_num_rows($res)==1)
		{
			$row=mysqli_fetch_array($res);
			if(password_verify($old, $row['password'])) 
			{
				$password=password_hash($new, PASSWORD_DEFAULT);;
				//Sql query to update the password form DB table
				$sql1="UPDATE user SET password=? WHERE username=?";
				$sql_stmt1 = mysqli_prepare($con,$sql1);
				mysqli_stmt_bind_param($sql_stmt1,'ss',$password,$email);
				if(!mysqli_stmt_execute($sql_stmt1))
				{
					echo mysqli_error($con);
				}
				else
				{
					echo "Password Changed Successfully.";
					
				}
			}
			else
			{
				echo "Invalid Old Password";
			}
		}
		else
		{
				echo "Invalid Credentials";
		}
	}
	else
	{
		echo mysqli_error($con);
	}
	}
  }
  else
  {
      header("location:index.php");
  }
?>