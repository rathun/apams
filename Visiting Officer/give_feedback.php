<?php 
	if(isset($_POST['key']) && $_POST['key']=='258')
	{
		include '../db.php';
		mysqli_autocommit($con,FALSE);
		$nsc=$_POST['nsc'];
		$sql_id="SELECT institution_id FROM institution WHERE name='$nsc'";
		$res=mysqli_query($con,$sql_id);
		$row=mysqli_fetch_array($res);
		$ins_id=$row['institution_id'];
		$name=$_POST['name'];
		$gps=$_POST['gps'];
		$date=$_POST['date'];
		$rating=0;
		$comments="";
		$criteria_id="";
		$filedata="";
		$criteria_img="";
		$insert=0;
		$rating_total=0;
		$count=0;
		$district=$_POST['district'];
		$year=$_POST['year'];
		$sql_count="SELECT criteria_id FROM criteria WHERE criteria_type='O'";
		$res_count=mysqli_query($con,$sql_count);
		$n=mysqli_num_rows($res_count);
		for($j=1;$j<=$n;$j++)
		{
			//${'criteria'.$j}=array();
			for($i=1;$i<=10;$i++)
			{
				if(isset($_POST['section'.$j.$i]))
				{
				$criteria[$i]=mysqli_real_escape_string($con,$_POST['section'.$j.$i]);
				$rating_total+=$criteria[$i];
				$count++;
				}
				else
				{
					$criteria[$i]="";
				}

				
			}
			// if(isset($_POST['section'.$j.'_rate']))
			// {
			// $rating=mysqli_real_escape_string($con,$_POST['section'.$j.'_rate']);
			
			// }
			// else
			// {
			// 	$rating="";
			// }
			if(isset($_POST['section'.$j.'_comment']))
			{
			$comments=mysqli_real_escape_string($con,$_POST['section'.$j.'_comment']);
			}
			else
			{
				$comments="";
			}
			if(isset($_POST['criteria'.$j.'_id']))
			{
			$criteria_id=mysqli_real_escape_string($con,$_POST['criteria'.$j.'_id']);
			}
			else
			{
				$criteria_id="";
			}
			$fn="section".$j."_img";
			$filetmp2=$_FILES[$fn]["tmp_name"];
		    $filepath2="../Photos/".$criteria_id.$ins_id.$date.$name.".jpg";
		    move_uploaded_file($filetmp2,$filepath2);
		    $myfile2 = fopen("../Photos/".$criteria_id.$ins_id.$date.$name.".jpg", "r") or die("Unable to open file!");
			$filedata=md5(fread($myfile2,filesize("../Photos/".$criteria_id.$ins_id.$date.$name.".jpg")));
			fclose($myfile2);
			$criteria_img=$criteria_id.$ins_id.$date.$name.".jpg";
		$question1=$criteria[1];
		$question2=$criteria[2];
		$question3=$criteria[3];
		$question4=$criteria[4];
		$question5=$criteria[5];
		$question6=$criteria[6];
		$question7=$criteria[7];
		$question8=$criteria[8];
		$question9=$criteria[9];
		$question10=$criteria[10];
		$rating_average=$rating_total/$count;	
		
		$sql1="INSERT INTO `feedback`( `date`, `institution_id`, `institution`, `visiter_id`, `criteria_id`, `question1`, `question2`, `question3`, `question4`, `question5`, `question6`, `question7`, `question8`, `question9`, `question10`, `location`, `photo`, `photo_data`, `rating`,`comments`,`district`,`year`) VALUES ('$date','$ins_id','$nsc','$name','$criteria_id','$question1','$question2','$question3','$question4','$question5','$question6','$question7','$question8','$question9','$question10','$gps','$criteria_img','$filedata','$rating_average','$comments','$district','$year')";
			if(mysqli_query($con,$sql1))
			{
				$insert++;
			}
			$rating+=$rating_average;
		}
		$overall_rating=$rating/$n;
		$sql_rate="INSERT INTO rating (`institution_name`, `rating`, `academic_year`, `district`) VALUES ('$nsc','$overall_rating','$year','$district')";
		mysqli_query($con,$sql_rate);
		$sql_up="UPDATE assign_task SET feedback='1' WHERE institution='$nsc' AND date='$date' AND visiting_officer='$name'";
		mysqli_query($con,$sql_up);
		if($insert==$n && mysqli_commit($con))
		{
			$_SESSION['feed_key']='258';
			$_SESSION['feed_ins']='';
			//echo $nsc.$date.$name;
			
			
				echo "FeedBack Submitted SuccesFully";
			
		}
		else
		{
			echo "Some Error Occured".mysqli_error($con);
			
  			
		}
		mysqli_rollback($con);
	
	}
	else
	{
		
		 ?>
    <script type="text/javascript">
      location.replace("view_assigned_task.php");
    </script>
    <?php
	}
	
	
?>