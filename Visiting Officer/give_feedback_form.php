<?php 
  
  if(isset($_SESSION['key']) && $_SESSION['key']=='321')
  {
    if(isset($_SESSION['feed_key']) && $_SESSION['feed_key']=='456')
    {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Give Feedbacks</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/home.css">
  <script src="../js/font.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style type="text/css">
    
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
<?php include 'header.php' ?>

<div class="d-flex container justify-content-center">
          <div class="card ">
          <div class="card-header text-center"><h4><i>Give Feedbacks</i></h4></div>
            <form id="frm">
              <div class="card tab">
                <div class="card-body">
                <div class="form-group">
                <label>Institution:</label>
                <select class="form-control1" name="nsc" id="nsc" >
                  
                    <?php 
                    include '../db.php';
                    $name=$_SESSION['email'];
                    $date=date("Y-m-d");
                    $district=$_SESSION['district'];
                    $year=$_SESSION['year'];
                    
                              ?><option><?php echo $_SESSION['feed_ins']; ?></option>
                          
                </select>
                </div>
                <br/>
                
                </div>
              </div>
             
              <br/>
              <input type="hidden" name="date" value="<?php echo $date; ?>">
              <input type="hidden" name="name" value="<?php echo $name; ?>">
              <input type="hidden" name="year" value="<?php echo $year; ?>">
              <input type="hidden" name="district" value="<?php echo $district; ?>">
              <?php 
              $sql="SELECT * FROM criteria WHERE criteria_type='O'";
              if($res=mysqli_query($con,$sql))
              {
                $c=1;
                while($row=mysqli_fetch_array($res))
                {
                    ?>
                    <div class="card tab">
                  <div class="card-header text-center">
                    <b>Criteria <?php echo $c; ?>:<?php echo $row['criteria_name']; ?>
                    <br/>
                     <label class="text-danger">5-(Very Satisfied) 4-(More than Satisfied) 3-(Satisfied) 2-(Partially Satisfied) 1-(Dissatisfied)</label></b>
                  </div>
                  <?php
                  $file=$row['criteria_questions'];
                  $msg=json_decode($file,true);
                  //echo $msg;
                  $array=$msg;
                  $n=sizeof($msg);
                  for($i=0;$i<$n;$i++)
                  {
                  ?>
                  <div class="card-body">

                    <div class="form-group">
                        <label><?php echo $msg[$i]["question"]; ?></label>

                        <div class="custom-control custom-radio">
                          <input type="radio" class="custom-control-input" id="section<?php echo $c; ?>not<?php echo $i+1; ?>" name="section<?php echo $c; ?><?php echo $i+1; ?>" value="5">
                          <label class="custom-control-label" for="section<?php echo $c; ?>not<?php echo $i+1; ?>">5</label>
                        </div>    
                        <div class="custom-control custom-radio">
                          <input type="radio" class="custom-control-input" id="section<?php echo $c; ?>some<?php echo $i+1; ?>" name="section<?php echo $c; ?><?php echo $i+1; ?>" value="4">
                          <label class="custom-control-label" for="section<?php echo $c; ?>some<?php echo $i+1; ?>">4</label>
                        </div> 
                        <div class="custom-control custom-radio">
                          <input type="radio" class="custom-control-input" id="section<?php echo $c; ?>ok<?php echo $i+1; ?>" name="section<?php echo $c; ?><?php echo $i+1; ?>" value="3">
                          <label class="custom-control-label" for="section<?php echo $c; ?>ok<?php echo $i+1; ?>">3</label>
                        </div>    
                        <div class="custom-control custom-radio">
                          <input type="radio" class="custom-control-input" id="section<?php echo $c; ?>satis<?php echo $i+1; ?>" name="section<?php echo $c; ?><?php echo $i+1; ?>" value="2">
                          <label class="custom-control-label" for="section<?php echo $c; ?>satis<?php echo $i+1; ?>">2</label>
                        </div>   
                        <div class="custom-control custom-radio">
                          <input type="radio" class="custom-control-input" id="section<?php echo $c; ?>v_satis<?php echo $i+1; ?>" name="section<?php echo $c; ?><?php echo $i+1; ?>" value="1">
                          <label class="custom-control-label" for="section<?php echo $c; ?>v_satis<?php echo $i+1; ?>">1</label>
                        </div>   
                    </div>
                  </div>
                    <?php
                  }
                  ?>

                  <div class="card-body">
                      <div class="form-group">
                        <label>Photo:</label>
                        <input type="file" name="section<?php echo $c; ?>_img" class="form-control1" required="">
                      </div>
                  </div>
                 <!--  <div class="card-body">
                      <div class="form-group">
                        <label>Rate this section out of 10:</label>
                        <select class="form-control1" name="section<?php //echo $c; ?>_rate">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                      </div>
                  </div> -->
                  <div class="card-body">
                    <div class="form-group">
                      <label>Comments:</label>
                      <textarea class="form-control1" name="section<?php echo $c; ?>_comment"></textarea>
                      <span id="gp" class="text-danger"></span>
                    </div>
                  </div>
                  <input type="hidden" name="criteria<?php echo $c; ?>_id" value="<?php echo $row['criteria_id']; ?>">
              </div>
              <?php
                $c++;
                }
              }
              ?>
              

                          
                
                    <?php
                      if(isset($_POST['loc']))
                      {
                        $gps=$_POST['loc'];
                      }
                      else
                      {
                       $gps="";
                      }
                      ?>
                    <input type="hidden" name="gps" class="form-control1" value="<?php echo $gps; ?>" id="gps" readonly required>
                    <input type="hidden" name="key" value="258">
               
              <div class="form-group text-center ">
                <!-- <input type="submit" class="btn login-btn" id="submit"   value="Submit" /> -->
                <button type="button" id="prevBtn" class="login-btn btn" onclick="nextPrev(-1)">Previous</button>
                <button type="button" id="nextBtn" class="login-btn btn" onclick="nextPrev(1)">Next</button>
              </div>
              <br/>
            </form>
            </div>


    



</div>
<div class="modal" id="resmodal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title"><img src="../images/info.png" width="50px">&nbsp;Information</h4>
          <a href="view_assigned_task.php" class="close" >&times;</a>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body" id="error">
         
        </div>
        
       
      </div>
    </div>
  </div>
  <br/>
   <form id="link_frm" action="https://api-geo-location.herokuapp.com/" method="POST">
      <input type="hidden" id="link" name="link">
    </form>
<div class="sticky-bottom"><?php include '../footer.php'; ?></div>
<script type="text/javascript">
  if($('#gps').val()=="")
  {
    $('#link').val(window.location.href);
    //alert(window.location.href);
    document.getElementById("link_frm").submit();
  }
  //navigator.geolocation.getCurrentPosition(onSuccess, onError);
    
  // function onSuccess(position) {
      
  // var lat=position.coords.latitude;
  // var lon=position.coords.longitude;
  // var loca=lat+","+lon;
  // $("#gps").val(loca);           
  // }
  // function onError(error) {
  //     alert('code: '    + error.code    + '\n' +
  //         'message: ' + error.message + '\n');
  // }
  function frmsub(e)
  {
    //alert("hi");
    e.preventDefault();
     
  };
  var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    $('.btn').hide();
    var ins=$('#nsc').val();
            
      if(ins!='None')
      {
        var formData = new FormData($('#frm')[0]);
      $.ajax({
          url: 'give_feedback.php',
          type: "POST",
          data: formData,
          processData: false,
          contentType: false,
          cache : false,
          success: function(data) {
            var res=$.trim(data);
              $('#resmodal').modal('show');
              $('#error').html('<b>'+res+'</b>');
              $('#error').css('color', 'green');
              if(res=="Some Fields are Missing")
              {
                alert(res);
                location.reload();
              }
              //alert(res);
             
              
          },
          error: function(xhr, status, err) {
              alert("Error");
          }
      });    
      }
      else
      {
          $('#resmodal').modal('show');
              $('#error').html('<b>School/College not selected</b>');
              $('#error').css('color', 'red');
      } 
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  
  // If the valid status is true, mark the step as finished and valid:
  
  return valid; // return the valid status
}

</script>
</body>
</html>
<?php 
 }
  else
  {
    
     ?>
    <script type="text/javascript">
      location.replace("view_assigned_task.php");
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