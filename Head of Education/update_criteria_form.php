<?php 
  
  if(isset($_SESSION['key']) && $_SESSION['key']=='123')
  {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Update Criteria</title>
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
    <div class="card-header text-center"><h3>Update Criteria</h3></div>
    <div class="card-body">
      <form id="frm">
        <div class="form-group">
          <select name="criteria_name" id="criteria_name" class="form-control1">
            <option value="None">None</option>
        <?php
        include '../db.php';
        $sql="SELECT * FROM criteria";
        if($res=mysqli_query($con,$sql))
        {
          while($row=mysqli_fetch_array($res))
          {
            ?><option value="<?php echo $row['criteria_id']; ?>"><?php echo $row['criteria_name']; ?></option>  <?php
          }
        }

        ?>
          </select>
        </div>
        <br/>
        <div id="criteria_question">
        </div>
        <button type="button" name="add" id="add" class="btn btn-success">Add Question</button>
        <br/>
        <br/>
        <input type="hidden" name="key" value="528">
        <div class="form-group text-center">
          <input type="submit" value="Update Criteria" id="submit" class="btn login-btn">
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
  $('#add').hide();
  
  
  
    $('#add').click(function()
    {
      
      var n=$('.q').length+1;
      if(n<=10)
      {
         $('#criteria_question').append('<div class="form-group" id="row'+n+'"><textarea name="question[]" class="form-control1 q"  placeholder="Enter the Question '+n+'"></textarea><button type="button" name="add" id="'+n+'" class="btn btn-danger btn_remove">X</button></div>');
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
  $(document).on('change', '#criteria_name', function(){
      var criteria_id=$('#criteria_name').val();
      $.ajax({
        url:"get_criteria_details.php",
        type:"POST",
        data:{id:criteria_id,key:'528'},
        success:function(result){
          $('#criteria_question').html(result);
          $('#add').show();

        }
    });
  });

  $('#frm').submit(function(e)
  {
    
    e.preventDefault();
    var check=$('#criteria_name').val();
    if(check=="None")
    {
      alert("Criteria Not Selected");
    }
    else
    {
      $('#load').show();
    $('.btn').hide();
    $.ajax({
        url:"update_criteria.php",
        type:"POST",
        data:$('#frm').serialize(),
        success:function(result){
            
            var res=$.trim(result);
            $('#load').hide();
            $('.btn').show();
            if(res=='Success!Criteria Updated SuccessFully.')
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