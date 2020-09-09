<?php
if(isset($_POST['key']) && $_POST['key']=='456')
{
    ?>

<div class="table-responsive text-center">
    <table class="table table-striped">
        <tr><th></th><th>Rank</th><th>Institution</th><th>District</th><th>Rating</th></tr>
            <?php
            include 'db.php';
            $search=$_POST['search'];
            $sql="SELECT * FROM rating WHERE institution_name LIKE '%$search%' ORDER BY rating DESC";
            if($res=mysqli_query($con,$sql))
            {
                $rank=1;
                while($row=mysqli_fetch_array($res))
                {
                    ?><tr><td><form action="ranking_chart.php" method="POST"><input type="hidden" name="ins" value="<?php echo $row['institution_name']; ?>"><input type="hidden" name="year" value="<?php echo $row['academic_year']; ?>"><button type="submit"  class="btn"><i class="fa fa-plus"></i></button></form></td><td><?php echo $rank; ?></td><td><?php echo $row['institution_name']; ?></td><td><?php echo $row['district']; ?></td><td><?php echo number_format((float)$row['rating'], 2, '.', ''); ?></td></tr><?php
                    $rank++;
                }

            }
            ?>
        </table>
         
    </div>
<?php
}
else
{
header("location:ranking.php");
}
?>