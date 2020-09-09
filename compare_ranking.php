<?php
$type=$_POST['type'];
//echo $type;
if($type=="Compare Between years")
{
	?>


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
          <div class="form-group">
                <label class="text-left"><i>Select the Start Year:</i></label>
                <img src="images/date.png" class="input_img" />
                <select class="form-fields" name="start_year" >
                  <option value="None">None</option>
          <?php
          	
            $sql1="SELECT DISTINCT academic_year FROM rating";
            if($res1=mysqli_query($con,$sql1))
            {
              while($row1=mysqli_fetch_array($res1))
              {
               ?><option value="<?php echo $row1['academic_year']; ?>"><?php echo $row1['academic_year']; ?></option><?php
              }
              
            }
            else
            {
              echo mysqli_error($con);
            }

          ?>
          </select>
          </div><br/>
          <div class="form-group">
                <label class="text-left"><i>Select the End Year:</i></label>
                <img src="images/date.png" class="input_img" />
                <select class="form-fields" name="end_year">
                  <option value="None">None</option>
          <?php
          	
            $sql1="SELECT DISTINCT academic_year FROM rating";
            if($res1=mysqli_query($con,$sql1))
            {
              while($row1=mysqli_fetch_array($res1))
              {
               ?><option value="<?php echo $row1['academic_year']; ?>"><?php echo $row1['academic_year']; ?></option><?php
              }
              
            }
            else
            {
              echo mysqli_error($con);
            }

          ?>
          </select>
          </div><br/>

<script type="text/javascript">
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

		if($('#nsc').val()=="None"  && $('#district').val())
		{
		alert("Select the form-fields");
		}
		else
		{
		$("input").prop('disabled', false);
		}

	}
	});
}
});
</script>
<?php
}
else
{
	?>


    		<div class="form-group">
                <label class="text-left"><i>Select the Institution 1:</i></label>
                <img src="images/location.png" class="input_img" />
                <select class="form-fields" name="ins1" id="ins1">
                  
          <?php
          	include 'db.php';
            $sql1="SELECT name FROM institution";
            if($res1=mysqli_query($con,$sql1))
            {
              while($row1=mysqli_fetch_array($res1))
              {
               ?><option value="<?php echo $row1['name']; ?>"><?php echo $row1['name']; ?></option><?php
              }
              
            }
            else
            {
              echo mysqli_error($con);
            }

          ?>
          </select>
          </div><br/>
          <div class="form-group">
                <label class="text-left"><i>Select the Institution 2:</i></label>
                <img src="images/location.png" class="input_img" />
                <select class="form-fields" name="ins2" id="ins2">
                  
          <?php
          	include 'db.php';
            $sql1="SELECT name FROM institution";
            if($res1=mysqli_query($con,$sql1))
            {
              while($row1=mysqli_fetch_array($res1))
              {
               ?><option value="<?php echo $row1['name']; ?>"><?php echo $row1['name']; ?></option><?php
              }
              
            }
            else
            {
              echo mysqli_error($con);
            }

          ?>
          </select>
          </div><br/>
          
          


<?php
}
?>
