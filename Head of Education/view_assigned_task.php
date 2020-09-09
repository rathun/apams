<?php 
  
  if(isset($_SESSION['key']) && $_SESSION['key']=='123')
  {
?>
<!DOCTYPE html>
<html>
<head>
	<title>View Assigned Task</title>
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

<div class="container">
     <form id="frm">
  <div class="form-group">
    <img src="../images/search.png" class="input_img" />
    <input type="text" name="name" id="search" class="form-fields" placeholder="Search By Visiting Officer Name" style="border:2px solid #16336d" />
    <input type="hidden" value="789" name="key">
  </div>
  </form>
  <br/>
  <div id="res_search">
    <?php 
    include '../db.php';
    //$name=$_POST['name'];
    //echo $name;
    $sql="SELECT date,name,institution,assign_task.status,feedback FROM assign_task INNER JOIN user WHERE assign_task.visiting_officer=user.username ORDER BY date";
    if($res=mysqli_query($con,$sql))
    {
        ?><div class="row text-center"><!-- <div class="table-responsive-sm text-center" style="width:100%"><table class="table-sm table-bordered" style="width:100%"><tr><th>Date of Visit<br/>(YYYY-MM-DD)</th><th>Visiting Officer Name</th><th>Name of Institution</th><th>Status</th></tr> --><?php
        if(mysqli_num_rows($res)==0)
        {
            ?><tr><td colspan="4" class="text-center">Sorry,No Records Found.</td></tr><?php
        }
        else
        {
        while($row=mysqli_fetch_array($res))
        {
            ?><div class="col-sm-4 p-2"><div class="card"><div class="card-header"><?php echo date_format(date_create($row["date"]),"d-m-Y"); ?></div><div class="card-body"><?php echo "Visiting Officer: ".$row['name']; ?><br/><?php echo "Institution: ".$row['institution']; ?><br/><?php if($row['status']=='Visited'){ ?><p class="text-success" id="submit"><b><?php echo "Status: ".$row['status']; ?></b></p><?php } else { ?><p class="text-danger" id="submit"><b><?php echo "Status: ".$row['status']; ?></b></p><?php } 
            if($row['feedback']=='1')
            {
              ?><p class="text-success"><?php echo "Feedback Submitted"; ?></p><?php 
            }
            else
            {
              ?><p class="text-danger"><?php echo "Feedback Not Submitted"; ?></p><?php 
            }
            ?>

              </div></div></div><?php
        }
    }
    }
?>


</div>

</div>
</div><br/>
<div><?php include '../footer.php'; ?></div>
<script type="text/javascript">
  $('#search').on('input',function()
    {
      //alert("ji");
       $.ajax({
          url:"search_view_assigned_task.php",
          type:"POST",
          data:$('#frm').serialize(),
          success:function(result){
            //alert("hi");
              $('#res_search').html(result);
          }
      });
    });
</script>
</body>
</html>
<?php 
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