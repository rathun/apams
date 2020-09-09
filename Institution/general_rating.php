<!DOCTYPE html>
<html>
<head>
	<title>AP-AMS</title>
    <!--Including Bootstrap Files,Jquery and Stylesheet -->
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/home.css">
    <script src="../js/font.js"></script>
     
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     
</script>
</head>
<body>
    <!--Including Header -->
	<?php include 'header.php'; ?>
    <br/>
    
<div class="container">
    <center><h5>General Feedbacks</h5></center>
    <div class="table-responsive">
        <table class="table table-striped">
            <tr><th>Name</th><th>Designation</th><th>Rating</th><th>Comments</th></tr>
        <?php
        include '../db.php'; 
        $name=$_SESSION['name'];
        
        $sql="SELECT * FROM general_feedback WHERE institution='$name'";
        if($res=mysqli_query($con,$sql))
        {
            while($row=mysqli_fetch_array($res))
            {
                ?><tr><td><?php echo $row['name']; ?></td><td><?php echo $row['designation']; ?></td><td><?php echo $row['rating']; ?></td><td><?php echo $row['comments']; ?></td></tr><?php
            }
        }
        else
        {
            echo mysqli_error($con);
        }
        ?>
    </table>
</div>
  </div>
      <br/>
    <!-- Including Footer -->
	<?php include '../footer.php'; ?> 
    
</body>
</html>
