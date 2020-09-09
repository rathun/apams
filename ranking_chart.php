<!DOCTYPE html>
<html>
<head>
	<title>AP-AMS</title>
    <!--Including Bootstrap Files,Jquery and Stylesheet -->
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
     
</script>
</head>
<body>
    <!--Including Header -->
	<div class="sticky-top">
    <nav class="navbar navbar-dark" >
        <div class="text-left"><img src="images/logo.jpeg" width="40px">&nbsp;<i>AP-AMS</i></div>
        <div class="text-right"><a href="index.php"><i class="fa fa-home"></i></a></div>
    </nav>
    </div>
    <br/>
    
<div class="d-flex justify-content-center container" >
        <div id="overall_chart" style="height: 350px; width: 100%;"></div>
        <?php
        include 'db.php';
        $ins=$_POST['ins'];
        $year=$_POST['year'];
        $sql="SELECT criteria_name,rating FROM feedback INNER JOIN criteria ON feedback.criteria_id=criteria.criteria_id WHERE feedback.institution='$ins' AND feedback.year='$year' ORDER BY rating DESC";
        if($res=mysqli_query($con,$sql))
        {
            //echo "1";

            $overall_dataPoints = array();
            while($row=mysqli_fetch_array($res))
            {
                //echo $row['criteria_name'];
                array_push($overall_dataPoints,array("label" => $row['criteria_name'],"y" => number_format((float)$row['rating'], 2, '.', '')));
            }
        }
        else
        {
            echo mysqli_error($con);
        }
        ?>
        <script>
                            
                             
        var overall_chart = new CanvasJS.Chart("overall_chart", {
          theme: "light2",
    animationEnabled: true,
    title: {
        text: "<?php echo $ins." Rating"; ?>"
    },
    data: [{
        type: "doughnut",
        indexLabel: "{symbol} - {y}",
        yValueFormatString: "#,##0.0\"%\"",
        showInLegend: true,
        legendText: "{label} : {y}",
        dataPoints: <?php echo json_encode($overall_dataPoints, JSON_NUMERIC_CHECK); ?>
    }]
        });
        overall_chart.render();
         
        </script>
  </div>
      <br/>
    <!-- Including Footer -->
	<?php include 'footer.php'; ?> 
    
</body>
</html>
