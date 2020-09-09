<?php 
if(isset($_SESSION['key']) && $_SESSION['key']=='123')
{
	if(isset($_POST['key']) && $_POST['key']=='789')
	{
		include '../db.php';
		$id=$_POST['id'];
		//echo $id;
		$sql1="SELECT name FROM user WHERE username=?";
		$sql_stmt1 = mysqli_prepare($con, $sql1);
		mysqli_stmt_bind_param($sql_stmt1, 's',$id);
 		mysqli_stmt_execute($sql_stmt1);
		$res=mysqli_stmt_get_result($sql_stmt1);
		$row=mysqli_fetch_array($res);
		$sql="UPDATE user SET status='1' WHERE username=?";
		$sql_stmt = mysqli_prepare($con,$sql);
		mysqli_stmt_bind_param($sql_stmt,'s',$id);
		if(mysqli_stmt_execute($sql_stmt))
		{
			$to = $id;
			$subject = "AP-AMS Account Approved SuccessFully";
			$headers = "Reply-To: <hypertexttechies2020@gmail.com>\r\n";
			$headers .= "Return-Path:<hypertexttechies2020@gmail.com>\r\n";
			$headers .= "From:<hypertexttechies2020@gmail.com>\r\n";
			$headers .= "Organization: KEC\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
			$headers .= "X-Priority: 3\r\n";
			$headers .= "X-Mailer: PHP". phpversion() ."\r\n";
			$message="Hi ".$row['name'].",\r\nYour AP-AMS Account Approved SuccessFully.\r\nNow you can Login using Your Email id and Password";
			 $message.="\r\n";
			$message.="Thank You!";
			//Mail function to send mail
			mail($to,$subject,$message,$headers);
			echo "Success! Institution Approved Successfully.";
		}
		else
		{
			echo "Failed! Some Error Occured.<br/>".mysqli_error($con);
		}
	}
	else
	{
		
		 ?>
    <script type="text/javascript">
      location.replace("add_institution.php");
    </script>
    <?php
	}
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

