<?php 
	if(isset($_POST['key']) && $_POST['key']=='120')
	{
	include '../db.php';
	$type=$_POST['user_type'];
	$username=$_POST['username'];
	$pass=$_POST['password'];
	$password=password_hash($_POST['password'], PASSWORD_DEFAULT);
	$name=$_POST['name'];
	
	$filetmp=$_FILES["photo"]["tmp_name"];
    $filepath="../Profile/".$username.".jpg";
	move_uploaded_file($filetmp,$filepath);
	$photo=$username.".jpg";
	$approval='1';
	$sql="INSERT INTO `user`(`username`, `password`, `type`, `name`,`photo`,`status`) VALUES (?,?,?,?,?,?) ";
	$sql_stmt = mysqli_prepare($con,$sql);
	mysqli_stmt_bind_param($sql_stmt,'ssssss',$username,$password,$type,$name,$photo,$approval);
	if(mysqli_stmt_execute($sql_stmt))
	{
		$to = $username;
		$subject = "AP-AMS Account Created SuccessFully";
		$headers = "Reply-To: <hypertexttechies2020@gmail.com>\r\n";
		$headers .= "Return-Path:<hypertexttechies2020@gmail.com>\r\n";
		$headers .= "From:<hypertexttechies2020@gmail.com>\r\n";
		$headers .= "Organization: KEC\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
		$headers .= "X-Priority: 3\r\n";
		$headers .= "X-Mailer: PHP". phpversion() ."\r\n";
		$message="Hi ".$name.",\r\nYour AP-AMS Account Created SuccessFully.\r\nYou can Login using Your Email id and this Password ".$pass."\r\nAfter Login Change your Password";
		 $message.="\r\n";
		$message.="Thank You!";
		//Mail function to send mail
		mail($to,$subject,$message,$headers);
		echo "Success! New User Created SuccessFully";
	}
	else
	{
		echo "Failed! Some Error Occured".mysqli_error($con);
	}
	}
	else
	{
		 ?>
    <script type="text/javascript">
      location.replace("create_new_user.php");
    </script>
    <?php
	}

	
	
?>