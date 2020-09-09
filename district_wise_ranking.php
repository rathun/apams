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
    
        <div class="container">
        <div class="card" style="padding: 20px">
            <div class="card-header">
                <h4 style="color:#662200" class="text-center"><i><?php echo $_POST['district']; ?> District Ranking</i></h4>    
            </div>
            <div class="card-body">
                <div class="table-responsive text-center">
                    <table class="table table-striped text-center" >
                        <tr><th></th><th>Rank</th><th>Institution</th><th>Rating</th></tr>
                            <?php
                            include 'db.php';
                            $dis_name=$_POST['district'];
                            $sql="SELECT * FROM rating WHERE district='$dis_name' ORDER BY rating DESC";
                            if($res=mysqli_query($con,$sql))
                            {
                                $rank=1;
                                if(mysqli_num_rows($res)==0)
                                {
                                    ?><tr><td colspan="3" class="text-center">Sorry!No Records Found</td></tr><?php 
                                }
                                while($row=mysqli_fetch_array($res))
                                {
                                    ?><tr><td><form action="ranking_chart.php" method="POST"><input type="hidden" name="ins" value="<?php echo $row['institution_name']; ?>"><input type="hidden" name="year" value="<?php echo $row['academic_year']; ?>"><button type="submit"  class="btn"><i class="fa fa-eye"></i></button></form></td><td><?php echo $rank; ?></td><td><?php echo $row['institution_name']; ?></td><td><?php echo number_format((float)$row['rating'], 2, '.', ''); ?></td></tr><?php
                                    $rank++;
                                }

                            }
                            ?>
                        </table>
                    
                    </div>
           
        </div>
           
        </div>
        </div>
  
      <br/>
    <!-- Including Footer -->
	<?php include 'footer.php'; ?> 
    
</body>
</html>
