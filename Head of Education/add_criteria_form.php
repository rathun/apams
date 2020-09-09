<?php 
  
  if(isset($_SESSION['key']) && $_SESSION['key']=='123')
  {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Criteria</title>
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
    <div class="card-header text-center"><h3>Add Criteria</h3></div>
    <div class="card-body">
      <form id="frm">
        <div class="form-group">
          <label>Select the Question Type:</label>
         <select name="type" class="form-control1">
           <option value="O">Visiting Officer</option>
           <option value="G">General</option>
         </select>
        </div><br/>
        <div class="form-group">
          <input type="text" name="criteria_name" class="form-control1" placeholder="Enter the Criteria Name" required="">
        </div><br/>
        <div id="question_field">
          <div class="form-group">
            <textarea name="question[]" class="form-control1" placeholder="Enter the Question" required=""></textarea><button type="button" name="add" id="add" class="btn btn-success">Add Question</button>
          </div><br/>
        </div>

        <input type="hidden" name="key" value="528">
        <div class="form-group text-center">
          <input type="submit" value="Add Criteria" id="submit" class="btn login-btn">
          <div class="spinner-border" id="load" style="display: none;cursor: none"></div>
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
<script type="text/javascript">
  var i=1;
  $('#add').click(function()
  {
    i++;
    if(i<=10)
    {
    $('#question_field').append('<div class="form-group" id="row'+i+'"><textarea name="question[]" class="form-control1"  placeholder="Enter the Question"></textarea><button type="button" name="add" id="'+i+'" class="btn btn-danger btn_remove">X</button></div>');
    }
    else
    {
      alert("Only 10 question can added");
    }
  });
  $(document).on('click', '.btn_remove', function(){
    var button_id = $(this).attr("id"); 
    $('#row'+button_id+'').remove();
  });
  $('#frm').submit(function(e)
  {
    $('#load').show();
    $('.btn').hide();
    e.preventDefault();
    $.ajax({
        url:"add_criteria.php",
        type:"POST",
        data:$('#frm').serialize(),
        success:function(result){
            
            var res=$.trim(result);
            $('#load').hide();
            $('.btn').show();
            if(res=='Success!Criteria Added SuccessFully.')
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