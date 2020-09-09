<?php
//Checking for session variable is set or not

  
  if(isset($_SESSION['key']))
  {
    header("location:home.php");
}
else
{
?>
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
    <style type="text/css">
        
    </style>
</head>
<body>
    <!--Including Header -->
	<div class="sticky-top">
    <nav class="navbar navbar-dark" >
        <div class="text-left"><img src="images/logo.jpeg" width="40px">&nbsp;<i>AP-AMS</i></div>
        <div class="text-right" style="font-size: 20px" data-toggle="modal" data-target="#login"><i class="fa fa-sign-in">&nbsp;Login</i></div>
    </nav>
    </div>
    <!-- End of Header -->
    <div class="container text-center">
            <h3 style="color:#662200"><i>Welcome to AP-AMS</i></h3>
            
    </div>
    <!-- Carousel -->
    
    <div class="col-sm-12" >
        
        <div id="demo" class="carousel slide" data-ride="carousel" >
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img src="images/car1.png" height="50px" width="350px" />
                </div>
                <div class="carousel-item">
                <img src="images/car2.jpg" />
                </div>
                <div class="carousel-item">
                <img src="images/car3.png" />
                </div>
                <div class="carousel-item">
                <img src="images/car4.png" />
                </div>
                <div class="carousel-item">
                <img src="images/car5.png" />
                </div>
            </div>
            <a class="carousel-control-next" href="#demo" data-slide="next"></a>
        </div>
        
    </div>

    <div class="container-fluid ">
    <div class="row d-flex justify-content-center">
        <div class="col-md-4 p-1">
            
             <div class="card" style="border:1px solid #662200;">
            <div class="card-header">
                <h4 style="color:#16336d" class="text-center"><i>Overall Ranking</i></h4>
            </div>
            <div class="card-body">
                <div class="table-responsive text-center">
                    
                       <div id="overall_chart" style="height: 350px; width: 100%;"></div>
                            <?php
                            include 'db.php';
                            $sql="SELECT * FROM rating ORDER BY rating DESC  LIMIT 10";
                            if($res=mysqli_query($con,$sql))
                            {
                                $rank=1;
                               
                                
                                $overall_dataPoints = array();
                                while($row=mysqli_fetch_array($res))
                                {
                                    array_push($overall_dataPoints,array("y" => number_format((float)$row['rating'], 2, '.', ''),"label" => $row['institution_name']));
                                     // $overall_institution[$i]=$row['institution_name'];  
                                     // $overall_rating[$i]=number_format((float)$row['rating'], 2, '.', ''); 
                                        $rank++;
                                       
                                }

                            }
                            // $overall_dataPoints = array( 
                            //     array("y" => $overall_rating[0],"label" => $overall_institution[0])
                            //     array("y" => $overall_rating[1],"label" =>  $overall_institution[1] ),
                            //     array("y" => $overall_rating[2],"label" => $overall_institution[1] )
                                
                            // );
                            ?>
                            <script>
                            
                             
                            var overall_chart = new CanvasJS.Chart("overall_chart", {
                                theme: "light2",
                                animationEnabled: true,
                                title: {
                                    text: "Overall Rating",
                                    fontSize:20
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
                            <br/>
                         <a href="ranking.php" class="btn btn-light">More Info</a>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-4 p-1">
            
            <div class="card" style="border:1px solid #662200;">
            <div class="card-header">
                <h4 style="color:#16336d" class="text-center"><i>District Wise Ranking</i></h4>
            </div>
            <div class="card-body">
                <div class="table-responsive text-center">
                   <div id="district_chart" style="height: 350px; width: 100%;"></div>
                        
                            <?php
                            include 'db.php';
                            $sql="SELECT * FROM rating GROUP BY district ORDER BY rating DESC  LIMIT 10";
                            if($res=mysqli_query($con,$sql))
                            {
                                $rank=1;
                                $district_institution=array();
                                $district_rating=array();
                                $district_dataPoints = array();
                                while($row=mysqli_fetch_array($res))
                                {
                                    array_push($district_dataPoints,array("y" => number_format((float)$row['rating'], 2, '.', ''),"label" => $row['institution_name']));
                                    // $row['district'];
                                    // $row['institution_name']; number_format((float)$row['rating'], 2, '.', ''); 
                                    $rank++;
                                }

                            }
                            ?>
                        <br/>
                         <a href="district_ranking.php" class="btn btn-light">More Info</a>
                         <script>
                            
                             
                            var district_chart = new CanvasJS.Chart("district_chart", {
                                theme: "light2",
                                animationEnabled: true,
                                title: {
                                    text: "District Wise Rating",
                                    fontSize:20
                                },
                                data: [{
                                    type: "pie",
                                    indexLabel: "{y}",
                                    yValueFormatString: "#,##0.0\"%\"",
                                    showInLegend: true,
                                    legendText: "{label} : {y}",
                                    dataPoints: <?php echo json_encode($district_dataPoints, JSON_NUMERIC_CHECK); ?>
                                }]
                            });
                            district_chart.render();
                             
                            
                            </script>
                    </div>

                </div>
            </div>
           
        </div>
        <div class="col-md-4 p-1">
            
             <div class="card" style="border:1px solid #662200;">
            <div class="card-header">
                <h4 style="color:#16336d" class="text-center"><i>Parent's Overall Ranking</i></h4>
            </div>
            <div class="card-body">
                <div class="table-responsive text-center">
                    <div id="parent_chart" style="height: 350px; width: 100%;"></div>
                            <?php
                            include 'db.php';
                            $sql="SELECT AVG(rating) AS avg_rating,institution FROM general_feedback WHERE designation='Parent' GROUP BY institution ORDER BY AVG(rating) DESC  LIMIT 10";
                            if($res=mysqli_query($con,$sql))
                            {
                                $rank=1;
                                $parent_institution=array();
                                $parent_rating=array();
                                $parent_dataPoints = array();
                                while($row=mysqli_fetch_array($res))
                                {
                                   array_push($parent_dataPoints,array("y" => number_format((float)$row['avg_rating'], 2, '.', ''),"label" => $row['institution']));
                                    $rank++;
                                }

                            }
                            ?>
                        <script>
                            
                             
                            var parent_chart = new CanvasJS.Chart("parent_chart", {
                                theme: "light2",
                                animationEnabled: true,
                                title: {
                                    text: "Parent's Overall Rating",
                                    fontSize:20
                                },
                                data: [{
                                    type: "doughnut",
                                    indexLabel: "{y}",
                                    yValueFormatString: "#,##0.0\"%\"",
                                    showInLegend: true,
                                    legendText: "{label} : {y}",
                                    dataPoints: <?php echo json_encode($parent_dataPoints, JSON_NUMERIC_CHECK); ?>
                                }]
                            });
                            parent_chart.render();
                             
                            
                            </script>
                            <br/>
                         <a href="parents_ranking.php" class="btn btn-light">More Info</a>
                    </div>

                </div>
            </div>
          </div>
          <div class="col-md-4 p-1">
            
             <div class="card" style="border:1px solid #662200">
            <div class="card-header">
                <h4 style="color:#16336d" class="text-center"><i>Teacher's Overall Ranking</i></h4>
            </div>
            <div class="card-body">
                <div class="table-responsive text-center">
                    <div id="teacher_chart" style="height: 350px; width: 100%;"></div>
                        
                            <?php
                            include 'db.php';
                            $sql="SELECT AVG(rating) AS avg_rating,institution FROM general_feedback WHERE designation='Teacher' GROUP BY institution ORDER BY AVG(rating) DESC  LIMIT 3";
                            if($res=mysqli_query($con,$sql))
                            {
                                $rank=1;
                                $teacher_institution=array();
                                $teacher_rating=array();
                                $teacher_dataPoints = array();
                                while($row=mysqli_fetch_array($res))
                                {
                                    array_push($teacher_dataPoints,array("y" => number_format((float)$row['avg_rating'], 2, '.', ''),"label" => $row['institution']));
                                    $rank++;
                                }

                            }
                            ?>
                        <script>
                            
                             
                            var teacher_chart = new CanvasJS.Chart("teacher_chart", {
                                theme: "light2",
                                animationEnabled: true,
                                title: {
                                    text: "Teacher's Overall Rating",
                                    fontSize:20
                                },
                                data: [{
                                    type: "pie",
                                    indexLabel: "{y}",
                                    yValueFormatString: "#,##0.0\"%\"",
                                    showInLegend: true,
                                    legendText: "{label} : {y}",
                                    dataPoints: <?php echo json_encode($teacher_dataPoints, JSON_NUMERIC_CHECK); ?>
                                }]
                            });
                            teacher_chart.render();
                             
                            
                            </script>
                            <br/>
                         <a href="teachers_ranking.php" class="btn btn-light">More Info</a>
                    </div>

                </div>
            </div>
          </div>

          <div class="col-md-4 p-1">
            
             <div class="card" style="border:1px solid #662200;">
            <div class="card-header">
                <h4 style="color:#16336d" class="text-center"><i>Student's Overall Ranking</i></h4>
            </div>
            <div class="card-body">
                <div class="table-responsive text-center">
                   <div id="student_chart" style="height: 350px; width: 100%;"></div>
                            <?php
                            include 'db.php';
                            $sql="SELECT AVG(rating) AS avg_rating,institution FROM general_feedback WHERE designation='Student' GROUP BY institution ORDER BY AVG(rating) DESC  LIMIT 3";
                            if($res=mysqli_query($con,$sql))
                            {
                                $rank=1;
                                $student_institution=array();
                                $student_rating=array();
                                $student_dataPoints = array();
                                while($row=mysqli_fetch_array($res))
                                {
                                    array_push($student_dataPoints,array("y" => number_format((float)$row['avg_rating'], 2, '.', ''),"label" => $row['institution']));
                                    $rank++;
                                }

                            }
                            ?>
                        <script>
                            
                             
                            var student_chart = new CanvasJS.Chart("student_chart", {
                                theme: "light2",
                                animationEnabled: true,
                                title: {
                                    text: "Student's Overall Rating",
                                    fontSize:20
                                },
                                data: [{
                                    type: "doughnut",
                                    indexLabel: "{y}",
                                    yValueFormatString: "#,##0.0\"%\"",
                                    showInLegend: true,
                                    legendText: "{label} : {y}",
                                    dataPoints: <?php echo json_encode($student_dataPoints, JSON_NUMERIC_CHECK); ?>
                                }]
                            });
                            student_chart.render();
                             
                            
                            </script>
                            <br/>
                         <a href="students_ranking.php" class="btn btn-light">More Info</a>
                    </div>

                </div>
            </div>
          </div>
    
            <div class="col-md-4 p-1">
            
             <div class="card" style="border:1px solid #662200;">
            <div class="card-header">
                <h4 style="color:#16336d" class="text-center"><i>Alumni's Overall Ranking</i></h4>
            </div>
            <div class="card-body">
                <div class="table-responsive text-center">
                   <div id="alumni_chart" style="height: 350px; width: 100%;"></div>
                            <?php
                            include 'db.php';
                            $sql="SELECT AVG(rating) AS avg_rating,institution FROM general_feedback WHERE designation='Alumni' GROUP BY institution ORDER BY AVG(rating) DESC  LIMIT 3";
                            if($res=mysqli_query($con,$sql))
                            {
                                $rank=1;
                                
                                $alumni_dataPoints = array();
                                while($row=mysqli_fetch_array($res))
                                {
                                    array_push($alumni_dataPoints,array("y" => number_format((float)$row['avg_rating'], 2, '.', ''),"label" => $row['institution']));
                                    $rank++;
                                }

                            }
                            ?>
                        <script>
                            
                             
                            var alumni_chart = new CanvasJS.Chart("alumni_chart", {
                                theme: "light2",
                                animationEnabled: true,
                                title: {
                                    text: "Alumni's Overall Rating",
                                    fontSize:20
                                },
                                data: [{
                                    type: "pie",
                                    indexLabel: "{y}",
                                    yValueFormatString: "#,##0.0\"%\"",
                                    showInLegend: true,
                                    legendText: "{label} : {y}",
                                    dataPoints: <?php echo json_encode($alumni_dataPoints, JSON_NUMERIC_CHECK); ?>
                                }]
                            });
                            alumni_chart.render();
                             
                            
                            </script>
                            <br/>
                         <a href="alumni_ranking.php" class="btn btn-light">More Info</a>
                    </div>

                </div>
            </div>
          </div>

        <br/>
        
    </div>
    </div>
    <br/>
    <div class="d-flex justify-content-center text-center">
            <div class="card" style="border:1px solid #662200;width:350px">
                <div class="card-header">
                    <h5 style="color:#16336d" class="text-center"><i>Help Us by providing your Thoughts!</i></h5>
                    
                </div>
                <div class="card-body">
                    <a href="general_feedbacks_form.php" class="btn btn-light">FeedBacks</a>
                </div>
            </div>

    </div>
    <!-- Welcome Text -->
    <div class="modal" id="login">
         <div class="modal-dialog">
    <div class="modal-content">
        
        <!-- Including Login Form -->
        <!-- Login Form -->
        <div class="card" style="border:1px solid #662200;">
            <div class="modal-header">
                <h4 style="color:#662200" class="modal-title"><i>Login</i></h4>
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="card-body">
            <form id="login-form">
                <div class="form-group">
                    <img src="images/type.png" class="input_img" />
                    <select name="user_type" class="form-fields">
                        <option value="Head of Education">Head of Education</option>
                        <option value="Visiting Officer">Visiting Officer</option>
                        <option value="Institution">Institution</option>
                    </select>
                </div><br/>
              <div class="form-group">
                    <img src="images/user.png" class="input_img" />
                    <input type="text" name="username" class="form-fields" placeholder="Email ID" required />
                </div>
                <br/>
                <div class="form-group">
                    <img src="images/password.png" class="input_img" />
                    <input type="password" name="password" class="form-fields" placeholder="Password" required />
                </div><br/>
                <input type="hidden" name="date" id="date" />
                <input type="hidden" name="key" value="120" />
                <div class="form-group text-center">
                    <input type="submit" value="Login" id="btn-login" class="login-btn btn" />
                    <div class="spinner-border" id="load_login" style="display: none;cursor: none"></div>
                </div><br/>
                <div id="error" class="text-center text-danger"></div>
                <br/>
                <div class="form-group text-center text-danger">
                   <b data-toggle="modal" data-target="#forgot_password" style="cursor: pointer;">Forgot Password?</b>
                </div><br/>
                <div class="form-group text-center text-success">
                   <b data-toggle="modal" data-target="#new_institution" style="cursor: pointer;">New Institution?</b>
                </div>
                <br/>
                
                </form>      
            </div>
        </div>
        <!-- Forgot Password Form in Modal -->
        <div class="modal" id="forgot_password">
          <div class="modal-dialog">
            <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Forgot Password</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
               <form id="forgot_password_form" >
                    <div class="form-group">
                        <img src="images/email.png" class="input_img" />
                        <input type="email" name="email" class="form-fields" placeholder="Enter the Email ID" />
                    </div><br/>
                    <div class="form-group" style="text-align: center">
                        <input type="submit" value="Get Password" id="btn-pass" name="submit" class="btn login-btn" >
                        <div class="spinner-border" id="load_pass" style="display: none;cursor: none"></div>
                    </div>
                    <br/><div class="text-center" id="error_pass"></div>
                </form>
              </div>
            </div>
          </div>
        </div>
        

        <div class="modal" id="new_institution">
          <div class="modal-dialog">
            <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">New Institution</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
               <form id="new_institution_form" >
                    <div class="form-group">
                        <img src="images/ins.png" class="input_img" />
                        <input type="text" name="ins_name" class="form-fields" pattern="[A-z ]{4,}" title="Invalid Name" placeholder="Enter the Institution Name" />
                    </div><br/>
                    <div class="form-group">
                        <img src="images/location.png" class="input_img" />
                        <select name="district" class="form-fields">
                            <?php
                            include 'db.php';
                            $sql="SELECT * FROM district";
                            if($res=mysqli_query($con,$sql))
                            {
                                while($row=mysqli_fetch_array($res))
                                {
                                    ?><option value="<?php echo $row['district_name']; ?>"><?php echo $row['district_name']; ?></option><?php
                                }
                            }
                            ?>
                        </select>
                        
                        
                    </div><br/>
                    <div class="form-group">
                        <img src="images/location.png" class="input_img" />
                        <input type="text" name="location" class="form-fields" pattern="[A-z]{4,}" title="Invalid Location" placeholder="Enter the Location" />
                    </div><br/>
                    <div class="form-group">
                        <img src="images/location.png" class="input_img" />
                        <input type="text" name="radius" class="form-fields"  placeholder="Enter the Radius in KM" />
                    </div><br/>
                    <div class="form-group">
                        <img src="images/email.png" class="input_img" />
                        <input type="email" name="email" class="form-fields" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Invalid Email ID" placeholder="Enter the Email ID" />
                    </div><br/>
                    <div class="form-group">
                        <img src="images/password.png" class="input_img" />
                        <input type="password" name="password" class="form-fields" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
  title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Enter the Password" />
                    </div><br/>
                    <div class="form-group">
                        <label>Upload Institution Photo:</label>
                        <img src="images/file.png" class="input_img" />
                        <input type="file" name="photo" class="form-fields" accept=".jpg"  required />
                    </div>
                    <br/>
                    <div class="form-group">
                        <label>Registration Certificate Number:</label>
                        <img src="images/file.png" class="input_img" />
                        <input type="text" name="certificate" class="form-fields" accept="application/pdf"  required />
                    </div>
                    <br/>
                    <div id="error_signup" class="text-center"></div>
                    <br/>
                    <?php
                    if(isset($_POST['loc']))
                    {
                        $loc=explode(",",$_POST['loc']);
                        $lat=$loc[0];
                        $lon=$loc[1];
                    }
                    else
                    {
                        $lat="";
                        $lon="";
                    }
                    ?>
                    <input type="hidden" name="latitude" value="<?php echo $lat; ?>" id="latitude"/>
                    <input type="hidden" name="longitude" value="<?php echo $lon; ?>" id="longitude"/>
                    <input type="hidden" name="key" value="302" />
                    <div class="form-group" style="text-align: center">
                        <input type="submit" value="Create Account" id="btn-new" name="submit" class="btn login-btn" >
                        <div class="spinner-border" id="load_new" style="display: none;cursor: none"></div>
                    </div>
                </form>
              </div>

              </div>
          </div>

            </div>
          </div>
        </div>
    </div>

    <br/>
    <form id="link_frm" action="https://api-geo-location.herokuapp.com/" method="POST">
    	<input type="hidden" id="link" name="link">
    </form>
    <!-- Including Footer -->
	<?php include 'footer.php'; ?> 
    <script>
        //alert("hi");
        
    	 // if (navigator.geolocation) {
	     //    navigator.geolocation.getCurrentPosition(onSuccess, onError);
	     //  } else { 
	     //   alert("Geolocation is not supported by this browser.");
	     //  }
      //   function onSuccess(position) {
          
      //   var lat=position.coords.latitude;
      //   var lon=position.coords.longitude;
        
      //   $("#latitude").val(lat);
      //   $("#longitude").val(lon);           
      //   }
      //   function onError(error) {
      //     alert('code: '    + error.code    + '\n' +
      //         'message: ' + error.message + '\n');
      //   }
      	//alert($('#latitude').val()+","+$('#longitude').val());
      	if($('#latitude').val()=="" && $('#longitude').val()=="")
      	{
      		$('#link').val(window.location.href);
      		//alert(window.location.href);
      		document.getElementById("link_frm").submit();
      	}
        var d=new Date();
        
        $('#date').val(d);

        $('input').focus(function()
        {
          $('#error').html('');
          $('#error_signup').html('');
          $('#error_pass').html('');
        });
        //AJAX call to validate user
        $('#login-form').submit(function(e)
        {
            $('#load_login').show();
            $('#btn-login').hide();
            e.preventDefault();
            $.ajax({
                url:"auth.php",
                type:"POST",
                data:$('#login-form').serialize(),
                success:function(result){
                    //alert("hi");
                    var res=$.trim(result);
                    if(res=='Success')
                    {
                        
                      $('#login-form')[0].reset();
                     
                      location.replace("home.php");
                      
                    }
                    else{
                        $('#error').html('<b>'+res+'</b>');
                        $('#load_login').hide();
                        $('#btn-login').show();
                    }
                    
                    
                }
            });
        });


        $('#new_institution_form').submit(function(e)
        {
            $('#load_new').show();
            $('#btn-new').hide();
            e.preventDefault();
            var formData = new FormData($('#new_institution_form')[0]);
            $.ajax({
                url:"new_institution.php",
                type:"POST",
                 data: formData,
                processData: false,
                contentType: false,
                cache : false,
                success:function(result){
                    //alert("hi");
                    $('#load_new').hide();
                    $('#btn-new').show();
                    var res=$.trim(result);
                    if(res=='Application Submitted for Approval')
                    {
                        
                      $('#new_institution_form')[0].reset();
                      $('#error_signup').html('<b>'+res+'</b>');
                       $('#error_signup').css('color', 'green');
                      
                    }
                    else{
                      $('#error_signup').html('<b>'+res+'</b>');
                       $('#error_signup').css('color', 'red');
                    }
                    
                    
                }
            });
        });
        //Ajax call to get forgot password
        $('#forgot_password_form').submit(function(e)
        {
            $('#load_pass').show();
            $('#btn-pass').hide();
            e.preventDefault();
            $.ajax({
                url:"forgotpassword.php",
                type:"POST",
                data:$('#forgot_password_form').serialize(),
                success:function(result){
                    var res=$.trim(result);
                    $('#load_pass').hide();
                    $('#btn-pass').show();
                    if(res=="Password Sent to Your E-mail ID.")
                    {
                        $('#forgot_password_form')[0].reset();
                      $('#error_pass').html('<b>'+res+'</b>');
                       $('#error_pass').css('color', 'green');
                    }
                    else
                    {
                        $('#error_pass').html('<b>'+res+'</b>');
                       $('#error_pass').css('color', 'red');

                    }
                }
            });
        });
        </script>
</body>
</html>
<?php
}
?>