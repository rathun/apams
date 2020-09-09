<?php 
	if(isset($_POST['key']) && $_POST['key']=='528')
	{
		include '../db.php';
		$question=array();
		$criteria_id=$_POST['criteria_name'];
		//$data=array();
		$question_count=count($_POST['question']);
		for($i=0;$i<$question_count;$i++)
		{
			
				$question[$i]=mysqli_real_escape_string($con,$_POST['question'][$i]);
				$data[]=array("question"=>$question[$i]);
			
			
			
		}
		
    	$jsonData = json_encode($data);
    	$sql="UPDATE criteria SET criteria_questions='$jsonData' WHERE criteria_id='$criteria_id'";
		if(mysqli_query($con,$sql))
		{
			echo "Success!Criteria Updated SuccessFully.";
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
      location.replace("update_criteria_form.php");
    </script>
    <?php
	}

	
	
?>