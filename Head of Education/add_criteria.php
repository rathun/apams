<?php 
	if(isset($_POST['key']) && $_POST['key']=='528')
	{
		include '../db.php';
		$question=array();
		$criteria_name=$_POST['criteria_name'];
		//$data=array();
		$question_count=count($_POST['question']);
		for($i=0;$i<$question_count;$i++)
		{
			
				$question[$i]=mysqli_real_escape_string($con,$_POST['question'][$i]);
				$data[]=array("question"=>$question[$i]);
			
			
			
		}
		$type=$_POST['type'];
    	$jsonData = json_encode($data);
    	$sql="INSERT INTO criteria (`criteria_name`,`criteria_questions`,`criteria_type`) VALUES ('$criteria_name','$jsonData','$type')";
		if(mysqli_query($con,$sql))
		{
			echo "Success!Criteria Added SuccessFully.";
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
      location.replace("add_criteria_form.php");
    </script>
    <?php
	}

	
	
?>