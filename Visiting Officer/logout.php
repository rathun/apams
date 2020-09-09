<?php
    //destroying session
if(isset($_SESSION['feed_ins']) && $_SESSION['feed_ins']=='')
    {
    session_destroy();
    header("location:../index.php");
    }
  else
  {
    header("location:give_feedback_form.php");
  }

?>