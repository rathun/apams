<?php 
	if(isset($_POST['key']) && $_POST['key']=='528')
	{
		include '../db.php';
		
		$id=$_POST['id'];
    	$sql="SELECT criteria_questions FROM criteria WHERE criteria_id=?";
    	$sql_stmt=mysqli_prepare($con,$sql);
    	mysqli_stmt_bind_param($sql_stmt,'s',$id);
    	mysqli_stmt_execute($sql_stmt);
		if($res=mysqli_stmt_get_result($sql_stmt))
		{
			while($row=mysqli_fetch_array($res))
			{
				$questions=$row['criteria_questions'];
			}
		}
		$msg=json_decode($questions,true);
      	$array=$msg;
      	$n=sizeof($msg);
      	for($i=0;$i<$n;$i++)
      	{	
      		?><div class="form-group"><textarea name="question[]" class="form-control1 q" rows="5"><?php echo $msg[$i]["question"]; ?></textarea></div><br/><?php
      	}
      	?><input type="hidden" id="num" value="<?php echo $n; ?>" ><?php
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