<?php
	//Checking whether the variable is set or not
	if(isset($_POST['email']))
	{
	$email=$_POST['email'];
	//DB Connect
	include 'db.php';
	//Sql Query to get user details
	$sql="SELECT * FROM user WHERE username=?";
	$sql_stmt = mysqli_prepare($con, $sql);
	mysqli_stmt_bind_param($sql_stmt, 's',$email);
	mysqli_stmt_execute($sql_stmt);
	if($res=mysqli_stmt_get_result($sql_stmt))
	{
		if(mysqli_num_rows($res)==1)
		{
			$row=mysqli_fetch_array($res);
			$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890@!#$%^&*';
		    $pass =array();
		    //Generating random password
		    $alphaLength = strlen($alphabet) - 1; 
		    for ($i = 0; $i < 8; $i++) {
		        $n = rand(0, $alphaLength);
		        $pass[]= $alphabet[$n];
		    }
		    $reset=implode($pass);
		    $password=password_hash($reset, PASSWORD_DEFAULT);
		    //Sql query to update new password in DB table
		    $sql1="UPDATE user SET password=? WHERE username=?";
		    $sql_stmt1 = mysqli_prepare($con,$sql1);
			mysqli_stmt_bind_param($sql_stmt1,'ss',$password,$email);
			if(!mysqli_stmt_execute($sql_stmt1))
			{
				echo mysqli_error($con);
			}
			else
			{
				//Sending the password through Mail
				$to = $email;
				$subject = "AP-AMS Account Password";
				$headers = "Reply-To: <hypertexttechies2020@gmail.com>\r\n";
				$headers .= "Return-Path:<hypertexttechies2020@gmail.com>\r\n";
				$headers .= "From:<hypertexttechies2020@gmail.com>\r\n";
				$headers .= "Organization: KEC\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
				$headers .= "X-Priority: 3\r\n";
				$headers .= "X-Mailer: PHP". phpversion() ."\r\n";
				$message="Hi ".$row['name'].",\r\nYour AP-AMS Account Password is ".$reset."\r\nYou can Login using Your Email id and this Password.";
				 $message.="\r\n";
				$message.="Thank You!";
				//Mail function to send mail
				mail($to,$subject,$message,$headers);
				

				echo "Password Sent to Your E-mail ID.";
				
					
			}
		}
		else
		{
			echo "Invalid Email/Username";
				
		}
	}
	
	
	}
	else
	{
		
		header("location:index.php");
	}
   ?>