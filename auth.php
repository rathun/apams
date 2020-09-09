<?php
	
	if(isset($_POST['key']) && $_POST['key']=='120')
	{
		include('db.php');
		$type=$_POST['user_type'];
		$un=$_POST['username'];
		$pass=$_POST['password'];
		$date=$_POST['date'];
		$approval='1';
		$sql="SELECT * FROM user WHERE type=? AND username=? AND status=? ";
		$sql_stmt = mysqli_prepare($con, $sql);
		mysqli_stmt_bind_param($sql_stmt, 'ssi',$type,$un,$approval);
 		mysqli_stmt_execute($sql_stmt);
		if($res=mysqli_stmt_get_result($sql_stmt))
		{
			if(mysqli_num_rows($res)==1)
			{
				$row=mysqli_fetch_array($res);
				if(password_verify($pass, $row['password'])) 
				{
					$_SESSION['name']=$row['name'];
					$_SESSION['mail']=$row['username'];
					$_SESSION['feed_ins']='';
					if($row['type']=='Head of Education')
					{
						$_SESSION['type']=$row['type'];
						$_SESSION['key']='123';

					}
					else if($row['type']=='Visiting Officer')
					{
						$_SESSION['type']=$row['type'];
						$_SESSION['key']='321';
						$_SESSION['email']=$row['username'];

					}
					else if($row['type']=='Institution')
					{
						$_SESSION['type']=$row['type'];
						
						$_SESSION['key']='1234';
					}
					$login=$row['login'];

					$sql1="UPDATE user SET login_count=login_count+1,last_login=?,login=? WHERE username=?";
					$sql_stmt1 = mysqli_prepare($con,$sql1);
					mysqli_stmt_bind_param($sql_stmt1,'sss',$login,$date,$un);
					if(mysqli_stmt_execute($sql_stmt1))
					{
						echo "Success";
					}
				}
				else
				{
					echo "Invalid Password";
				}
			 	
			}
			else
			{
				echo "Invalid Login Credentials/Account not Acctivated";
			}
		}
		else
		{
			echo mysqli_error($con);
		}
	}
	else
	{
		header("location:index.php");
	}

?>