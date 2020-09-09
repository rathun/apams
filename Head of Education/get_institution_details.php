
<?php
if(isset($_POST['key']) && $_POST['key']=='528')
{
 include '../db.php'; ?>

<div class="form-group">
                <label class="text-left"><i>Select the Institution:</i></label>
                <img src="../images/ins.png" class="input_img" />
                <select class="form-fields" name="nsc" id="nsc">
          <?php

            $district=$_POST['id'];
           
            $sql1="SELECT institution.name FROM user INNER JOIN institution ON user.username=institution.username WHERE user.status='1' AND institution.district='$district'";
            if($res1=mysqli_query($con,$sql1))
            {
              if(mysqli_num_rows($res1)==0)
              {
                ?><option value="None">None</option><?php
              }
              else
              {
                while($row1=mysqli_fetch_array($res1))
                {
                 ?><option value="<?php echo $row1['name']; ?>"><?php echo $row1['name']; ?></option><?php
                }
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
else
{
  header("location:assign_task_form");
}
?>