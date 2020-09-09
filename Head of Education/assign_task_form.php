<?php 
  
  if(isset($_SESSION['key']) && $_SESSION['key']=='123')
  {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Assign Task</title>
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
  <div class="container d-flex justify-content-center">
                
  <div class="card" style="width:350px;">
  <div class="card-header text-center"><h4><b><i style="color:#16336d">Assign Task</i></b></h4></div>
  <div class="card-body">
  <form id="frm" >

        <?php
          
          include('../db.php');
          ?>
          <div class="form-group">
                <label class="text-left"><i>Select the District:</i></label>
                <img src="../images/location.png" class="input_img" />
                <select class="form-fields" name="district" id="district">
                  <option value="None">None</option>
          <?php

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
          <div class="form-group">
                <label><i>Select the Date of Visit:</i></label>
                <img src="../images/date.png" class="input_img" />
                <input type="date" name="date" id="date" class="form-fields" required />
            </div><br/>
            <div class="form-group">
                <label><i>Select the Academic Year:</i></label>
                <img src="../images/date.png" class="input_img" />
                <select name="year" class="form-fields">
                  <option value="2020-2021">2020-2021</option>
                </select>
            </div><br/>
          <div class="form-group">
                <label><i>Select the Visiting Officer:</i></label>
                <img src="../images/name.png" class="input_img" />
                <select class="form-fields" name="nvo" id="nvo">
          <?php

          $sql="SELECT * FROM user WHERE type='Visiting Officer'";
          if($res=mysqli_query($con,$sql))
          {
            while($row=mysqli_fetch_array($res))
            {
             ?><option value="<?php echo $row['username']; ?>"><?php echo $row['name']; ?></option><?php
            }
            
          }
          else
          {
            echo mysqli_error($con);
          }

        ?>
        </select>
        </div><br/>
        <input type="hidden" name="key" value="258" />
        
        <div class="form-group text-center">
            <center><input type="submit" class="btn login-btn" value="Assign Task" name="submit" id="submit"  /></center>
            <div class="spinner-border" id="load" style="display: none;cursor: none"></div>
        </div>
        </form>
    </div>
</div>
</div>
<div class="modal" id="resmodal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title"><img src="../images/info.png" width="50px">&nbsp;Information</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body" id="error">
         
        </div>
        
       
      </div>
    </div>
  </div>
<div class="fixed-bottom"><?php include '../footer.php'; ?></div>
<script type="text/javascript">
$('input').focus(function()
{
  $('#error').html('');
});
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
//AJAX call to validate user
$('#frm').submit(function(e)
{
    $('#load').show();
    $('.btn').hide();
    e.preventDefault();
    $.ajax({
        url:"assign_task.php",
        type:"POST",
        data:$('#frm').serialize(),
        success:function(result){
            
            var res=$.trim(result);
            $('#load').hide();
            $('.btn').show();
            if(res=='Success! Task Assigned SuccessFully.')
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