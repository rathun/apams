<?php 
if(isset($_SESSION['key']) && $_SESSION['key']=='123')
{
	if(isset($_POST['key']) && $_POST['key']=='789')
	{
		include '../db.php';
		$id=$_POST['id'];
		//echo $id;
		$sql="DELETE user,institution  FROM user  INNER JOIN institution WHERE user.username= institution.username and user.username = '$id'";
		if(mysqli_query($con,$sql))
		{
			$to = $id;
			$subject = "AP-AMS Application Rejected";
			$headers = "Reply-To: <hypertexttechies2020@gmail.com>\r\n";
			$headers .= "Return-Path:<hypertexttechies2020@gmail.com>\r\n";
			$headers .= "From:<hypertexttechies2020@gmail.com>\r\n";
			$headers .= "Organization: KEC\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
			$headers .= "X-Priority: 3\r\n";
			$headers .= "X-Mailer: PHP". phpversion() ."\r\n";
			$message="Hi,\r\nSorry,Your Application has been Rejected.\r\nFor further details contact Head of Education.";
			 $message.="\r\n";
			$message.="Thank You!";
			//Mail function to send mail
			mail($to,$subject,$message,$headers);
			echo "Success! Institution Rejected Successfully.";
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

