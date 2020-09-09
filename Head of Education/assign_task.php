<?php 
if(isset($_SESSION['key']) && $_SESSION['key']=='123')
{
	if(isset($_POST['key']) && $_POST['key']=='258')
	{
		include '../db.php';
		$nsc=$_POST['nsc'];
		$nvo=$_POST['nvo'];
		$date=$_POST['date'];
		$district=$_POST['district'];
		$year=$_POST['year'];
		$status="Yet to Visit";
		$feed='0';
		$sql="INSERT INTO `assign_task`(`institution`, `date`, `visiting_officer`,`status`,`feedback`,`district`,`academic_year`) VALUES (?,?,?,?,?,?,?) ";
		$sql_stmt = mysqli_prepare($con,$sql);
		mysqli_stmt_bind_param($sql_stmt,'sssssss',$nsc,$date,$nvo,$status,$feed,$district,$year);
		if(mysqli_stmt_execute($sql_stmt))
		{
			$to = $nvo;
			$subject = "AP-AMS Assigned Visit";
			$headers = "Reply-To: <hypertexttechies2020@gmail.com>\r\n";
			$headers .= "Return-Path:<hypertexttechies2020@gmail.com>\r\n";
			$headers .= "From:<hypertexttechies2020@gmail.com>\r\n";
			$headers .= "Organization: KEC\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
			$headers .= "X-Priority: 3\r\n";
			$headers .= "X-Mailer: PHP". phpversion() ."\r\n";
			$message="Dear Officer,\r\nYou have assigned to visit ".$nsc." on ".$date."\r\nFor Further details visit AP-AMS App.";
			 $message.="\r\n";
			$message.="Thank You!";
			//Mail function to send mail
			mail($to,$subject,$message,$headers);
			echo "Success! Task Assigned SuccessFully.";
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
      location.replace("assign_task_form.php");
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