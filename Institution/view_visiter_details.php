<?php 
  
  if(isset($_SESSION['key']) && $_SESSION['key']=='1234')
  {
?>
<!DOCTYPE html>
<html>
<head>
	<title>View Visiter Details</title>
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
  <div class="container ">
          <h4 class="text-center"><i>Visiter Details</i></h4>
    <?php 
    include '../db.php';
    $name=$_SESSION['name'];
    //echo $name;
    $sql="SELECT * FROM assign_task WHERE institution=?";
    $sql_stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($sql_stmt, 's',$name);
    mysqli_stmt_execute($sql_stmt);
    if($res=mysqli_stmt_get_result($sql_stmt))
    {
        ?><div class="row text-center"><!-- <div class="table-responsive text-center"><table class="table table-bordered"><tr><th>Date of Visit</th><th>Name of Visiter</th><th>Visiter Photo</th><th>Status</th></tr> --><?php
        if(mysqli_num_rows($res)==0)
        {
            ?><tr><td colspan="3">Sorry,No Records Found.</td></tr><?php
        }
        else
        {
          $i=1;
        while($row=mysqli_fetch_array($res))
        {
            ?><div class="col-sm-4 p-2"><div class="card">
              <div class="card-header"><?php echo date_format(date_create($row["date"]),"d-m-Y"); ?></div><?php
            $date=date("Y-m-d");
            if($date>=$row['date'])
            {
            $name1=$row['visiting_officer']; 
            $sql1="SELECT * FROM user WHERE username=?";
            $sql_stmt1 = mysqli_prepare($con, $sql1);
            mysqli_stmt_bind_param($sql_stmt1, 's',$name1);
            mysqli_stmt_execute($sql_stmt1);
            if($res1=mysqli_stmt_get_result($sql_stmt1))
            {
              $row1=mysqli_fetch_array($res1);
              ?>
              <div class="card-body"><div><?php echo "Visiter: ".$row1['name']; ?></div><div><a data-toggle="modal" data-target="#photo<?php echo $i; ?>"><img src="../Profile/<?php echo $row1['photo']; ?>" class="rounded" width="100px"></a></div>
              <div class="modal" id="photo<?php echo $i; ?>">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    
                      <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title">Photo</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      
                      <!-- Modal body -->
                      <div class="modal-body">
                          <img src="../Profile/<?php echo $row1['photo']; ?>" width="100%">
                      </div>
                      
                     
                      
                    </div>
                  </div>
                </div>
              <?php
            }
            }
            else
            {
              ?>
              <td>-</td><td>-</td>
              <?php
            }
            ?>
            <div><?php $r=$row['status'];  if($r=='Visited'){  ?><p class="text-success"><b><?php echo $row['status']; ?></b></p><?php }  else {  ?><p class="text-primary"><b><?php echo $row['status']; } ?> </b></p></div></div></div></div><?php
            $i++;
        }
    }
    }
?>

</div>
</div>


  
<br/>
<div><?php include '../footer.php'; ?></div>

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