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
        $desig=$_POST['desig'];
        $sql_criteria="SELECT criteria_questions FROM criteria WHERE criteria_type='G'";
        if($res_criteria=mysqli_query($con,$sql_criteria))
        {
            while($row_criteria=mysqli_fetch_array($res_criteria))
            {
              $file=$row_criteria['criteria_questions'];
              $msg=json_decode($file,true);
              //echo $msg;
              $array=$msg;
              $n=sizeof($msg);
            }
        }
        // echo $ins;
        // echo $msg;
        $sql="SELECT AVG(question1) AS question1,AVG(question2) AS question2,AVG(question3) AS question3,AVG(question4) AS question4,AVG(question5) AS question5,AVG(question6) AS question6,AVG(question7) AS question7,AVG(question8) AS question8,AVG(question9) AS question9,AVG(question10) AS question10 FROM general_feedback WHERE institution='$ins' AND designation='$desig'  ORDER BY rating DESC";
        if($res=mysqli_query($con,$sql))
        {
            //echo "1";

            $overall_dataPoints = array();
            
            $row=mysqli_fetch_array($res);
                //echo mysqli_num_rows($res);
            
                //$question=;
                array_push($overall_dataPoints,array("label" => $msg[0]["question"],"y" => number_format((float)$row["question1"], 2, '.', '')));
            
            array_push($overall_dataPoints,array("label" => $msg[1]["question"],"y" => number_format((float)$row["question2"], 2, '.', '')));
            array_push($overall_dataPoints,array("label" => $msg[2]["question"],"y" => number_format((float)$row["question3"], 2, '.', '')));
            array_push($overall_dataPoints,array("label" => $msg[3]["question"],"y" => number_format((float)$row["question4"], 2, '.', '')));
            array_push($overall_dataPoints,array("label" => $msg[4]["question"],"y" => number_format((float)$row["question5"], 2, '.', '')));
            array_push($overall_dataPoints,array("label" => $msg[5]["question"],"y" => number_format((float)$row["question6"], 2, '.', '')));
            array_push($overall_dataPoints,array("label" => $msg[6]["question"],"y" => number_format((float)$row["question7"], 2, '.', '')));
            array_push($overall_dataPoints,array("label" => $msg[7]["question"],"y" => number_format((float)$row["question8"], 2, '.', '')));
            array_push($overall_dataPoints,array("label" => $msg[8]["question"],"y" => number_format((float)$row["question9"], 2, '.', '')));
            array_push($overall_dataPoints,array("label" => $msg[9]["question"],"y" => number_format((float)$row["question10"], 2, '.', '')));
            
                
                // array_push($overall_dataPoints,array("label" => $msg[1]["question"],"y" => number_format((float)$row['question2'], 2, '.', '')));
                
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
        text: "<?php echo $ins." ".$desig." Rating"; ?>",
        fontSize:15
    },
    data: [{
        type: "doughnut",
        indexLabel: "{y}",
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
