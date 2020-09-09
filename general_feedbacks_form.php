<!DOCTYPE html>
<html>
<head>
	<title>Give Feedbacks</title>
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
 <!-- <div class="text-center"><a href="feedbacks.php" class="btn btn-light">Feedbacks Home</a>&nbsp;</div> -->
    <br/>
<div class="d-flex container justify-content-center">
          <div class="card ">
          <div class="card-header text-center"><h4><i>Give Feedbacks</i></h4></div>
            <form id="frm">
              <div class="card ">
                <div class="card-body">
                <div class="form-group">
                <label class="text-left"><i>Select the District:</i></label>
                <img src="images/location.png" class="input_img" />
                <select class="form-fields" name="district" id="district">
                  <option value="None">None</option>
          <?php
            include 'db.php';
            $sql1="SELECT * FROM district";
            if($res1=mysqli_query($con,$sql1))
            {
              while($row1=mysqli_fetch_array($res1))
              {
               ?><option value="<?php echo $row1['district_name']; ?>"><?php echo $row1['district_name']; ?></option><?php
              }
              
            }
            else
            {
              echo mysqli_error($con);
            }

          ?>
          </select>
          </div><br/>
          <div id="institu"></div>
                <br/>
                <div class="form-group">
                  <label>Select your Designation:</label>
                  <img src="images/name.png" class="input_img">
                    <select class="form-fields" name="role">
                      <option value="Parent">Parent</option>
                      <option value="Teacher">Teacher</option>
                      <option value="Student">Student</option>
                      <option value="Alumni">Alumni</option>
                      <option value="Others">Others</option>
                    </select>
                </div>
                <br/>
                <div class="form-group">
                  <label>Enter your Name:</label>
                  <img src="images/name.png" class="input_img" />
                   <input type="text" name="name" class="form-fields" placeholder="Name" required="">
                </div><br/>
                 <div class="form-group">
                  <label>Enter your Mobile No(Optional):</label>
                  <img src="images/name.png" class="input_img" />
                   <input type="text" name="mobile" class="form-fields"  placeholder="Mobile No">
                </div>
                <br/>
                <div class="form-group">
                  <label>Enter your Email Id(Optional):</label>
                  <img src="images/name.png" class="input_img" />
                   <input type="email" name="email" class="form-fields" placeholder="Email Id" >
                </div>
                </div>
              </div>
             
              
              <?php 
              $sql="SELECT * FROM criteria WHERE criteria_type='G'";
              if($res=mysqli_query($con,$sql))
              {
                //echo mysqli_num_rows($res);
                $c=1;
                while($row=mysqli_fetch_array($res))
                {
                    ?>
                    <div class="card">
                  <div class="card-header text-center">
                    <b><?php echo $row['criteria_name']." Feedback"; ?>
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

                        <select class="form-control1" name="answer<?php echo $i; ?>">
                          <option value="5">5</option>
                          <option value="4">4</option>
                          <option value="3">3</option>
                          <option value="2">2</option>
                          <option value="1">1</option>
                        </select>
                    </div>
                  </div>
                    <?php
                  }
                  ?>

                  
                
                  <div class="card-body">
                    <div class="form-group">
                      <label>Comments/Suggestions:</label>
                      <textarea class="form-control1" name="comments"></textarea>
                      <span id="gp" class="text-danger"></span>
                    </div>
                  </div>
                  
              </div>
              <?php
                $c++;
                }
              }
              ?>
              

                          
                
                    
                    
                    <input type="hidden" name="key" value="258">
               <div class="form-group text-center">
            <center><input type="submit" class="btn login-btn" value="Submit" name="submit" id="submit"  /></center>
            <div class="spinner-border" id="load" style="display: none;cursor: none"></div>
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
          <h4 class="modal-title"><img src="images/info.png" width="50px">&nbsp;Information</h4>
          <a href="general_feedbacks_form.php" class="close" >&times;</a>
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
<div class="sticky-bottom"><?php include 'footer.php'; ?></div>
<script type="text/javascript">
$("input").prop('disabled', true);
$(document).on('change', '#district', function(){
  //alert("hi");
      var id=$('#district').val();
      //alert(id);
      if(id=="None" )
      {
        alert("District not Selected");
      }
      else
      {
      $.ajax({
        url:"get_institution_details.php",
        type:"POST",
        data:{id:id,key:'528'},
        success:function(result){
          $('#institu').html(result);
          
          if($('#nsc').val()=="None")
          {
            alert("No Institution is available in this district");
          }
          else
          {
            $("input").prop('disabled', false);
          }

        }
    });
    }
  });
$('#frm').submit(function(e)
{
    $('#load').show();
    $('.btn').hide();
    e.preventDefault();
    $.ajax({
        url:"general_feedbacks.php",
        type:"POST",
        data:$('#frm').serialize(),
        success:function(result){
            
            var res=$.trim(result);
            $('#load').hide();
            $('.btn').show();
            if(res=='Success! Feedback Submitted SuccessFully.')
            {
              $('#frm')[0].reset();
              $('#resmodal').modal('show');
              $('#error').html('<b>'+res+'</b>');
              $('#error').css('color', 'green');
              
            }
            else{
              $('#resmodal').modal('show');
              $('#error').html('<b>'+res+'</b>');
              $('#error').css('color', 'red');
            }
            
            
        }
    });
});


</script>
</body>
</html>
