<?php 
    if(isset($_POST['key']) && $_POST['key']=='789')
    {
    include '../db.php';
    $name=$_POST['name'];
    //echo $name;
    $sql="SELECT date,name,school_college,status FROM assign_task INNER JOIN user WHERE assign_task.visiting_officer=user.username AND user.name LIKE '%$name%'";
    if($res=mysqli_query($con,$sql))
    {
        ?><div class="table-responsive text-center"><table class="table table-bordered"><tr><th>Date of Visit<br/>(YYYY-MM-DD)</th><th>Visiting Officer Name</th><th>Name of Institution</th><th>Status</th></tr><?php
        if(mysqli_num_rows($res)==0)
        {
            ?><tr><td colspan="4" class="text-center">Sorry,No Records Found.</td></tr><?php
        }
        else
        {
        while($row=mysqli_fetch_array($res))
        {
            ?><tr><td><?php echo $row['date']; ?></td><td><?php echo $row['name']; ?></td><td><?php echo $row['school_college']; ?></td><td><p class="text-success" id="submit"><b><?php echo $row['status']; ?></b></p></td></tr><?php
        }
    }
    }
?>
</table>

</div>
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
?>