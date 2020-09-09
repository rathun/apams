<?php 
  if(isset($_SESSION['key']) && $_SESSION['key']=='123')
  {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Create New User</title>
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
  <div class="card-header text-center"><h4><b><i style="color:#16336d">Create New User</i></b></h4></div>
  <div class="card-body">
  <form id="frm" >
      <div class="form-group">
          <img src="../images/type.png" class="input_img" />
          <select name="user_type" class="form-fields">
              
              <option value="Visiting Officer">Visiting Officer</option>
          </select>
      </div><br/>
      <div class="form-group">
          <img src="../images/name.png" class="input_img" />
          <input type="text" name="name" class="form-fields" placeholder="Name" pattern="[A-z ]{4,}" title="Invalid Name" required />
      </div>
      <br/>
      <div class="form-group">
          <img src="../images/user.png" class="input_img" />
          <input type="text" name="username" class="form-fields" placeholder="Email ID" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Invalid Email ID" required />
      </div>
      <br/>
      <div class="form-group">
          <img src="../images/password.png" class="input_img" />
          <input type="password" name="password" class="form-fields" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
  title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" required />
      </div><br/>
      <div class="form-group">
        <label>Upload Profile Photo:</label>
          <img src="../images/file.png" class="input_img" />
          <input type="file" name="photo" class="form-fields" accept=".jpg"  required />
      </div>
      <br/>
      <input type="hidden" name="key" value="120" />
      <div class="form-group text-center">
          <input type="submit" value="Create New User" class="login-btn btn" />
          <div class="spinner-border" id="load" style="display: none;cursor: none"></div>
      </div><br/>
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
//AJAX call to validate user
$('#frm').submit(function(e)
{
    $('#load').show();
    $('.btn').hide();
    e.preventDefault();
    var formData = new FormData($('#frm')[0]);
    $.ajax({
        url:"new_user.php",
        type:"POST",
        data: formData,
        processData: false,
        contentType: false,
        cache : false,
        success:function(result){
            $('#load').hide();
            $('.btn').show();
            var res=$.trim(result);
            if(res=='Success! New User Created SuccessFully')
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