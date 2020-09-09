<?php 
  if(isset($_SESSION['key']) && $_SESSION['key']=='1234' || $_SESSION['key']=='321' || $_SESSION['key']=='123')
  {
    if(isset($_SESSION['feed_ins']) && $_SESSION['feed_ins']=='')
    {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/home.css">
  <script src="js/font.js"></script>
  <script src="js/canvasjs.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     
     
   
</head>
<body>
	<?php include 'header.php' ?>

<div class="container-fluid">
  <div class="card-deck">

    <div class="card text-left">
      <div class="card-body">
          <?php
          include 'db.php';
          $mail=$_SESSION['mail'];
          $sql="SELECT * FROM user WHERE username='$mail'";
          $res=mysqli_query($con,$sql);
          $row=mysqli_fetch_array($res);
          ?>
          <div class="text-center"><img src="Profile/<?php echo $row['photo']; ?>" class="rounded" width="280px"></div><br/>
          <?php
          echo '<div><b>Last Logged in On</b> <img src="images/last_login.png" width="30px"><br/><p style="color:#16336d"> '.$row['last_login'].'</p></div>';
          echo '<div><b>No of Times Logged in</b> <img src="images/last_login.png" width="30px"><br/><p style="color:#16336d">'.$row['login_count'].'</p></div>';

          ?>
      
    </div>

  </div>

<!-- </div>

  <div class="container-fluid" style="width:350px"> -->
  <div class="card">
    <div class="card-body">
      <div id="hoe_chart" style="height: 350px; width: 100%;"></div>
    </div>
  </div>
</div>
</div>

  
  <?php
  if(isset($_SESSION['key']) && $_SESSION['key']==='123')
  {
      include 'db.php';
      $dataPoints = array();
      $sql="SELECT id FROM assign_task";
      if($res=mysqli_query($con,$sql))
      {
        $n=mysqli_num_rows($res);
        array_push($dataPoints,array("y" => $n,"label" =>"No of Task Assigned"));
      }
      
      $sql="SELECT id FROM assign_task WHERE status='Visited'";
      if($res=mysqli_query($con,$sql))
      {
        $n=mysqli_num_rows($res);
        array_push($dataPoints,array("y" => $n,"label" =>"Visited"));
      }
      $sql="SELECT id FROM assign_task WHERE status='Yet to Visit'";
      if($res=mysqli_query($con,$sql))
      {
        $n=mysqli_num_rows($res);
        array_push($dataPoints,array("y" => $n,"label" =>"Yet to Visit"));
      }
  }
  else if(isset($_SESSION['key']) && $_SESSION['key']==='321')
  {

      include 'db.php';
      $dataPoints = array();
      $sql="SELECT id FROM assign_task WHERE visiting_officer='$mail'";
      if($res=mysqli_query($con,$sql))
      {
        $n=mysqli_num_rows($res);
        array_push($dataPoints,array("y" => $n,"label" =>"No of Task Assigned"));
      }
      
      $sql="SELECT id FROM assign_task WHERE status='Visited' AND visiting_officer='$mail'";
      if($res=mysqli_query($con,$sql))
      {
        $n=mysqli_num_rows($res);
        array_push($dataPoints,array("y" => $n,"label" =>"Visited"));
      }
      $sql="SELECT id FROM assign_task WHERE status='Yet to Visit' AND visiting_officer='$mail'";
      if($res=mysqli_query($con,$sql))
      {
        $n=mysqli_num_rows($res);
        array_push($dataPoints,array("y" => $n,"label" =>"Yet to Visit"));
      }
  }
  else
  {
        $name=$_SESSION['name'];
        $dataPoints = array();
        $sql="SELECT AVG(rating) AS avg_rating FROM general_feedback WHERE institution='$name' AND designation='Parent'";
        if($res=mysqli_query($con,$sql))
        {
            while($row=mysqli_fetch_array($res))
            {
                //echo $row['criteria_name'];
                //echo $row['avg_rating'];
                array_push($dataPoints,array("label" => "Parent","y" => number_format((float)$row['avg_rating'], 2, '.', '')));
            }
        }
        else
        {
            echo mysqli_error($con);
        }
        $sql1="SELECT AVG(rating) AS avg_rating FROM general_feedback WHERE institution='$name' AND designation='Student'";
        if($res1=mysqli_query($con,$sql1))
        {
            //echo "1";

            
            while($row1=mysqli_fetch_array($res1))
            {
                //echo $row['criteria_name'];
                array_push($dataPoints,array("label" => "Student","y" => number_format((float)$row1['avg_rating'], 2, '.', '')));
            }
        }
        else
        {
            echo mysqli_error($con);
        }
        $sql2="SELECT AVG(rating) AS avg_rating FROM general_feedback WHERE institution='$name' AND designation='Teacher'";
        if($res2=mysqli_query($con,$sql2))
        {
            //echo "1";

            
            while($row2=mysqli_fetch_array($res2))
            {
                //echo $row['criteria_name'];
                array_push($dataPoints,array("label" => "Teacher","y" => number_format((float)$row2['avg_rating'], 2, '.', '')));
            }
        }
        else
        {
            echo mysqli_error($con);
        }
       
        
  }
  ?>
  <script>
                            
                             
    var hoe_chart = new CanvasJS.Chart("hoe_chart", {
        theme: "light2",
        animationEnabled: true,
        title: {
            text: "<?php if($_SESSION['key']=='1234'){ echo 'General Rating'; } else { echo 'Visit Details'; }?>",
            fontSize:20
        },
        data: [{
            type: "pie",
            indexLabel: "{y}",
            yValueFormatString: "#",
            showInLegend: true,
            legendText: "{label} : {y}",
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
    });
    hoe_chart.render();
    //   var vo_chart = new CanvasJS.Chart("vo_chart", {
    //     theme: "light2",
    //     animationEnabled: true,
    //     title: {
    //         text: "Visit Details",
    //         fontSize:20
    //     },
    //     data: [{
    //         type: "pie",
    //         indexLabel: "{y}",
    //         yValueFormatString: "#",
    //         showInLegend: true,
    //         legendText: "{label} : {y}",
    //         dataPoints: <?php //echo json_encode($vo_dataPoints, JSON_NUMERIC_CHECK); ?>
    //     }]
    // });
    // vo_chart.render();
    
    </script>
    <br/>
    <br/>
<?php include 'footer.php'; ?>
</body>
</html>
<?php 
}
  else
  {
    //header("location:Visiting Officer/give_feedback_form.php");
    ?>
    <script type="text/javascript">
      location.replace("Visiting Officer/give_feedback_form.php");
    </script>
    <?php
  }
  }
  else
  {
    ?>
    <script type="text/javascript">
      location.replace("index.php");
    </script>
    <?php
  }
 ?>