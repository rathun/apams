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
    
    
        <div class="card" style="padding: 20px">
            <div class="card-header">
                <h4 style="color:#662200" class="text-center"><i>District Wise Ranking</i></h4>    
            </div>
            <div class="row">
            <?php
            include 'db.php';
            $sql_dis="SELECT * FROM district";
            if($res_dis=mysqli_query($con,$sql_dis))
            {
                $i=1;
                while($row_dis=mysqli_fetch_array($res_dis))
                {

                    ?>
                    <div class="col-sm-4 p-2">
            <div class="card" style="background-color:white;padding: 20px">
            <div class="card-header">
                <h6 style="color:#662200" class="text-center"><i><?php echo $dis_name=$row_dis['district_name']; ?></i></h6>    
            </div>
            <div class="card-body">
                <div class="table-responsive text-center">
                   <div id="district_chart<?php echo $i; ?>" style="height: 350px; width: 100%;"></div>
                            <?php
                           

                            $sql="SELECT * FROM rating WHERE district='$dis_name' ORDER BY rating DESC LIMIT 3";
                            if($res=mysqli_query($con,$sql))
                            {
                                $rank=1;
                                ${'district_dataPoints'.$i}=array();
                                // $district_dataPoints = array();
                                if(mysqli_num_rows($res)==0)
                                {
                                    ?><tr><td colspan="3" class="text-center">Sorry!No Records Found</td></tr><?php 
                                }
                                while($row=mysqli_fetch_array($res))
                                {
                                   array_push(${'district_dataPoints'.$i},array("y" => number_format((float)$row['rating'], 2, '.', ''),"label" => $row['institution_name']));
                                    $rank++;
                                }

                            }
                            ?>
                       
                        <script>
                            
                             
                            var district_chart<?php echo $i; ?> = new CanvasJS.Chart("district_chart<?php echo $i; ?>", {
                                animationEnabled: true,
                                theme: "light2",
                                title:{
                                    text: "District Wise Rating",
                                    fontSize: 20
                                },
                                axisY: {
                                    title: "Rating"
                                },
                                data: [{
                                    type: "column",
                                    yValueFormatString: "#,##0.## ",
                                    dataPoints: <?php echo json_encode(${'district_dataPoints'.$i}, JSON_NUMERIC_CHECK); ?>
                                }]
                            });
                            district_chart<?php echo $i; ?>.render();
                             
                            
                            </script>
                         <form action="district_wise_ranking.php" method="POST">
                            <input type="hidden" name="district" value="<?php echo $dis_name; ?>">
                            <input type="submit" class="btn btn-light" value="More Info" >
                         </form>
                    </div>
            </div>
            </div>
        </div>
            <?php
            $i++;
                }
            }
            ?>
        </div>
        </div>
  
      <br/>
    <!-- Including Footer -->
	<?php include 'footer.php'; ?> 
    
</body>
</html>
