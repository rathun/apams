<?php 
  
  if(isset($_SESSION['key']) && $_SESSION['key']=='123')
  {
?>
<!DOCTYPE html>
<html>
<head>
	<title>User Management</title>
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
    <div class="card-header text-center"><h3>User Management</h3></div>
    <div class="card-body">
      <form id="frm">
        <div class="form-group">
          <label>Select Type of User:</label>
          <select name="type" id="type" class="form-control1 get">
            <option value="None">None</option>
            <option value="Visiting Officer">Visiting Officer</option>
            <option value="Institution">Institution</option>
          </select>
        </div><br/>
        <div class="form-group">
          <label>Select Action:</label>
          <select name="action" id="action" class="form-control1 get">
            <option value="None">None</option>
            <option value="Enable">Enable</option>
            <option value="Disable">Disable</option>
          </select>
        </div>
        <br/>
        <div id="user_details">
        </div>
        
        <br/>
        <br/>
        <input type="hidden" name="key" value="528">
        <div class="form-group text-center">
          <input type="submit" value="Update User" id="submit" class="btn login-btn">
          <div class="spinner-border" id="load" style="display: none;cursor: none"></div>
        </div>
      </form>
    </div>
  </div>
  <div class="modal" id="resmodal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title"><img src="../images/info.png" width="50px">&nbsp;Information</h4>
          <button type="button" onclick="javascript:window.location.reload()" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body" id="error">
         
        </div>
        
       
      </div>
    </div>
  </div>
<script type="text/javascript">
  
  
  
  $(document).on('change', '.get', function(){
      var id=$('#type').val();
      var action=$('#action').val();
      if(id=="None" || action=="None")
      {
        alert("Type of User or Action not Selected");
      }
      else
      {
      $.ajax({
        url:"get_user_details.php",
        type:"POST",
        data:{id:id,action:action,key:'528'},
        success:function(result){
          $('#user_details').html(result);
          

        }
    });
    }
  });

  $('#frm').submit(function(e)
  {
    
    e.preventDefault();
    var check=$('#type').val();
    var check1=$('#action').val();
    if(check=="None" && check1=="None")
    {
      alert("Type of User or Action not Selected");
    }
    else
    {
      $('#load').show();
    $('.btn').hide();
    $.ajax({
        url:"user_management.php",
        type:"POST",
        data:$('#frm').serialize(),
        success:function(result){
            
            var res=$.trim(result);
            $('#load').hide();
            $('.btn').show();
            if(res=='Success!User Enabled SuccessFully.' || res=='Success!User Disabled SuccessFully.')
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
    }
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