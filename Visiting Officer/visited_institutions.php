<?php 
  
  if(isset($_SESSION['key']) && $_SESSION['key']=='321')
  {
    if(isset($_SESSION['feed_ins']) && $_SESSION['feed_ins']=='')
    {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Visited Institutions</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/home.css">
  <script src="../js/font.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     
     
   
</head>
<body>
<?php include 'header.php' ?>

<div class="container text-center">
  <h4><i>Visited Institutions</i></h4>
  <?php 
  include '../db.php';
  
  
  
  $name=$_SESSION['email'];
  
  $date=date("Y-m-d");
  $sql="SELECT * FROM assign_task WHERE visiting_officer='$name' AND status='Visited' ORDER BY date";
  if($res=mysqli_query($con,$sql))
  {
    ?><div class="row"><!-- <div class="table-responsive text-center"><table class="table table-bordered"><tr><th>Date of Visit</th><th>Name of School/College</th><th>Status</th></tr> --><?php
    if(mysqli_num_rows($res)==0)
    {
      ?><tr><td colspan="3">Sorry! No Records Found.</td></tr><?php
    }
    else
    {
        $i=0;
    while($row=mysqli_fetch_array($res))
    {
      $name=$row['institution'];
      ?><div class="col-sm-3 p-2"><div class="card"><div class="card-header"><?php echo date_format(date_create($row["date"]),"d-m-Y"); ?></div><div class="card-body"><?php echo $row['institution']; ?><br/><div class="text-success"><?php echo $row['status']; ?></div></div></div></div><?php
            $i++;
    }
  }
  }
?>





</div>
  
<div class="fixed-bottom"><?php include '../footer.php'; ?></div>

</body>
</html>
<?php 
}
  else
  {
    
     ?>
    <script type="text/javascript">
      location.replace("give_feedback_form.php");
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