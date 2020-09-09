<?php
  //echo $name;
    include '../db.php';
    $id=$_POST['id'];
    $sql2="SELECT * FROM institution WHERE name='$id'";

    if($res2=mysqli_query($con,$sql2))
    {
      $row2=mysqli_fetch_array($res2);
      $lat=$row2['latitude'];
      $lon=$row2['longitude'];
      $radius=$row2['radius'];
      echo $lat.",".$lon.",".$radius;
    }
    else
    {
      echo mysqli_error($con);
    }
  ?>