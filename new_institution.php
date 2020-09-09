<?php 
	if(isset(($_POST['key'])) && $_POST['key']=='302')
	{
		include 'db.php';
		$type="Institution";
		$username=$_POST['email'];
		$password=password_hash($_POST['password'], PASSWORD_DEFAULT);
		$name=$_POST['ins_name'];
		$radius=$_POST['radius'];
		$location=$_POST['location'];
		$district=$_POST['district'];
		$latitude=$_POST['latitude'];
		$longitude=$_POST['longitude'];
		$filetmp=$_FILES["photo"]["tmp_name"];
	    $filepath="Profile/".$username.".jpg";
		move_uploaded_file($filetmp,$filepath);
		$photo=$username.".jpg";
		$certificate=$_POST['certificate'];
		$sql="INSERT INTO `user`(`username`, `password`, `type`, `name`,`photo`) VALUES (?,?,?,?,?) ";
		$sql_stmt = mysqli_prepare($con,$sql);
		mysqli_stmt_bind_param($sql_stmt,'sssss',$username, $password,$type, $name, $photo);
		if(mysqli_stmt_execute($sql_stmt))
		{
			$sql1="INSERT INTO `institution`(`username`,`name`,`location`,`latitude`,`longitude`,`certificate`,`radius`,`district`) VALUES (?,?,?,?,?,?,?,?) ";
			$sql_stmt1 = mysqli_prepare($con,$sql1);
			mysqli_stmt_bind_param($sql_stmt1,'ssssssss',$username,$name,$location,$latitude,$longitude,$certificate,$radius,$district);
			if(mysqli_stmt_execute($sql_stmt1))
			{
				$to = $username;
				$subject = "AP-AMS Application Submitted for Approval";
				$headers = "Reply-To: <hypertexttechies2020@gmail.com>\r\n";
				$headers .= "Return-Path:<hypertexttechies2020@gmail.com>\r\n";
				$headers .= "From:<hypertexttechies2020@gmail.com>\r\n";
				$headers .= "Organization: KEC\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
				$headers .= "X-Priority: 3\r\n";
				$headers .= "X-Mailer: PHP". phpversion() ."\r\n";
				$message="Hi,".$name."\r\nYour Application has been submitted successfully for the approval.\r\nOnce your application gets approved you will receive an mail.";
				 $message.="\r\n";
				$message.="Thank You!";
				//Mail function to send mail
				mail($to,$subject,$message,$headers);
				echo "Application Submitted for Approval";
			}
			else
			{
				echo "Some Error Occured<br/>".mysqli_error($con);
			}
		}
		else
		{
			echo "Some Error Occured<br/>".mysqli_error($con);
		}
	}
	else
	{
		header("location:index.php");
	}
	
	
?>