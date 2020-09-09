<?php 
  if(isset($_POST['key']) && $_POST['key']=='258')
  {
    include 'db.php';
    $district=$_POST['district'];
    $nsc=$_POST['nsc'];
    $designation=$_POST['role'];
    $name=$_POST['name'];
    //$answer=0;
    if(isset($_POST['mobile']))
    {
      $mobile=$_POST['mobile'];
    }
    else
    {
      $mobile="";
    }
    if(isset($_POST['email']))
    {
      $email=$_POST['email'];
    }
    else
    {
      $email="";
    }
    $rating_total=0;
    $comments=$_POST['comments'];
    $sql_count="SELECT criteria_id FROM criteria WHERE criteria_type='G'";
    $res_count=mysqli_query($con,$sql_count);
    $n=mysqli_num_rows($res_count);
    for($j=1;$j<=$n;$j++)
    {
      for($i=0;$i<10;$i++)
      {
        if(isset($_POST['answer'.$i]))
        {
        $answer[$i+1]=mysqli_real_escape_string($con,$_POST['answer'.$i]);
        $rating_total+=$answer[$i+1];
        //echo $answer[$i+1];
        }
        else
        {
          $answer[$i]="";
        }

        
      }
    }
    $rating=$rating_total/10;
    //echo $rating_total;
    $answers1=$answer[1];
    $answers2=$answer[2];
    $answers3=$answer[3];
    $answers4=$answer[4];
    $answers5=$answer[5];
    $answers6=$answer[6];
    $answers7=$answer[7];
    $answers8=$answer[8];
    $answers9=$answer[9];
    $answers10=$answer[10];
    
    $sql_feed="INSERT INTO `general_feedback`(`district_name`, `institution`, `designation`, `question1`, `question2`, `question3`, `question4`, `question5`, `question6`, `question7`, `question8`, `question9`, `question10`, `comments`,`rating`) VALUES ('$district','$nsc','$designation','$answers1','$answers2','$answers3','$answers4','$answers5','$answers6','$answers7','$answers8','$answers9','$answers10','$comments','$rating')";
    if(mysqli_query($con,$sql_feed))
    {
      echo "Success! Feedback Submitted SuccessFully.";
    }
    else
    {
      echo "Some Error Occured".mysqli_error($con);
    }
  }
  else
  {
    
     ?>
    <script type="text/javascript">
      location.replace("general_feedbacks_form.php");
    </script>
    <?php
  }
  
  
?>