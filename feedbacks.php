<!DOCTYPE html>
<html>
<head>
	<title>Feedbacks</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/home.css">
  <script src="js/font.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style type="text/css">
    .card{
      background-color: #ffc266;
    }
    body
    {
      font-style: italic;
    }
    .tab
    {
      display: none;
    }
  </style>
  
   
</head>
<body >
 <!--Including Header -->
  <div class="sticky-top">
    <nav class="navbar navbar-dark" >
        <div class="text-left"><img src="images/logo.jpeg" width="40px">&nbsp;<i>AP-AMS</i></div>
        <div class="text-right"><a href="index.php"><i class="fa fa-home"></i></a></div>
    </nav>
    </div>
    <br/>
    <div class="text-center"><a href="general_feedbacks_form.php" class="btn btn-light">Give Feedback</a></div>
    <br/>
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-3 p-1">
            
             <div class="card" style="border:1px solid #662200;background-color: #ffc266">
            <div class="card-header">
                <h4 style="color:#662200" class="text-center"><i>Parent's Overall Ranking</i></h4>
            </div>
            <div class="card-body">
                <div class="table-responsive text-center">
                    <table class="table table-striped">
                        <tr><td>Rank</td><td>Institution</td><td>Rating</td></tr>
                            <?php
                            include 'db.php';
                            $sql="SELECT AVG(rating) AS avg_rating,institution FROM general_feedback WHERE designation='Parent' GROUP BY institution ORDER BY AVG(rating) DESC  LIMIT 3";
                            if($res=mysqli_query($con,$sql))
                            {
                                $rank=1;
                                while($row=mysqli_fetch_array($res))
                                {
                                    ?><tr><td><?php echo $rank; ?></td><td><?php echo $row['institution']; ?></td><td><?php echo number_format((float)$row['avg_rating'], 2, '.', ''); ?></td></tr><?php
                                    $rank++;
                                }

                            }
                            ?>
                        </table>
                         <a href="parents_ranking.php" class="btn btn-light">More Info</a>
                    </div>

                </div>
            </div>
          </div>
          <div class="col-md-3 p-1">
            
             <div class="card" style="border:1px solid #662200;background-color: #ffc266">
            <div class="card-header">
                <h4 style="color:#662200" class="text-center"><i>Teacher's Overall Ranking</i></h4>
            </div>
            <div class="card-body">
                <div class="table-responsive text-center">
                    <table class="table table-striped">
                        <tr><td>Rank</td><td>Institution</td><td>Rating</td></tr>
                            <?php
                            include 'db.php';
                            $sql="SELECT AVG(rating) AS avg_rating,institution FROM general_feedback WHERE designation='Teacher' GROUP BY institution ORDER BY AVG(rating) DESC  LIMIT 3";
                            if($res=mysqli_query($con,$sql))
                            {
                                $rank=1;
                                while($row=mysqli_fetch_array($res))
                                {
                                    ?><tr><td><?php echo $rank; ?></td><td><?php echo $row['institution']; ?></td><td><?php echo number_format((float)$row['avg_rating'], 2, '.', ''); ?></td></tr><?php
                                    $rank++;
                                }

                            }
                            ?>
                        </table>
                         <a href="teachers_ranking.php" class="btn btn-light">More Info</a>
                    </div>

                </div>
            </div>
          </div>

          <div class="col-md-3 p-1">
            
             <div class="card" style="border:1px solid #662200;background-color: #ffc266">
            <div class="card-header">
                <h4 style="color:#662200" class="text-center"><i>Student's Overall Ranking</i></h4>
            </div>
            <div class="card-body">
                <div class="table-responsive text-center">
                    <table class="table table-striped">
                        <tr><td>Rank</td><td>Institution</td><td>Rating</td></tr>
                            <?php
                            include 'db.php';
                            $sql="SELECT AVG(rating) AS avg_rating,institution FROM general_feedback WHERE designation='Student' GROUP BY institution ORDER BY AVG(rating) DESC  LIMIT 3";
                            if($res=mysqli_query($con,$sql))
                            {
                                $rank=1;
                                while($row=mysqli_fetch_array($res))
                                {
                                    ?><tr><td><?php echo $rank; ?></td><td><?php echo $row['institution']; ?></td><td><?php echo number_format((float)$row['avg_rating'], 2, '.', ''); ?></td></tr><?php
                                    $rank++;
                                }

                            }
                            ?>
                        </table>
                         <a href="#" class="btn btn-light">More Info</a>
                    </div>

                </div>
            </div>
          </div>
        </div>
      </div>



</body>
</html>
