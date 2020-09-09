<?php
	if(isset($_POST['key']) && $_POST['key']=='258')
	{
	include('../db.php');
	
    $id=$_POST['id'];
		
			 ?><iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=<?php echo $id; ?>&amp;output=embed"></iframe><?php
			
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
	
