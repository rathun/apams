<!-- SideNavBar -->
<div id="mySidenav" class="sidenav">
            <button class="closebtn btn"  onclick="closeNav()">&times;</button>
            <?php
            //checking the session variable to display the result based on condition
            if(isset($_SESSION['name']) && isset($_SESSION['key']) && $_SESSION['key']==='123')
            {
                ?>
                <a href="home.php"><i class="fa fa-home"></i>&nbsp;Home</a>
                <a href="Head of Education/assign_task_form.php"><i class="fa fa-plus"></i>&nbsp;Assign Task</a>
                <a href="Head of Education/view_assigned_task.php"><i class="fa fa-eye"></i>&nbsp;View Assigned Task</a>
                <a href="Head of Education/view_feedbacks.php"><i class="fa fa-eye"></i>&nbsp;View FeedBacks</a>

                <a href="Head of Education/add_criteria_form.php"><i class="fa fa-plus"></i>&nbsp;Add Criteria Questionnaries</a>
                 <a href="Head of Education/update_criteria_form.php"><i class="fa fa-plus"></i>&nbsp;Modify Criteria Questionnaries</a>
                <a href="Head of Education/add_institution.php"><i class="fa fa-plus"></i>&nbsp;Add Institution</a>
                <a href="Head of Education/create_new_user.php"><i class="fa fa-plus"></i>&nbsp;Create New Users</a>
                <a href="Head of Education/user_management.php"><i class="fa fa-plus"></i>&nbsp;User Management</a>
                <?php
            }
            else if(isset($_SESSION['name']) && isset($_SESSION['key']) && $_SESSION['key']==='1234')
            {
                ?>
                <a href="home.php"><i class="fa fa-home"></i>&nbsp;Home</a>
                <a href="Institution/view_visiter_details.php"><i class="fa fa-window-maximize"></i>&nbsp;View Visiter Details</a>
                <a href="Institution/view_feedbacks.php"><i class="fa fa-eye"></i>&nbsp;View Feedbacks</a>
                <a href="Institution/general_rating.php"><i class="fa fa-eye"></i>&nbsp;General Feedbacks</a>
                <?php
            }
            else if(isset($_SESSION['name']) && isset($_SESSION['key']) && $_SESSION['key']==='321')
            {
                ?>
                <a href="home.php"><i class="fa fa-home"></i>&nbsp;Home</a>
                <a href="Visiting Officer/view_assigned_task.php" ><i class="fa fa-eye"></i>&nbsp;View Assigned Task</a>
                <a href="Visiting Officer/visited_institutions.php" ><i class="fa fa-eye"></i>&nbsp;Visited Institutions</a>
                <a href="Visiting Officer/view_feedbacks.php" ><i class="fa fa-eye"></i>&nbsp;View Feedbacks</a>
                <?php
            }
           ?>
                    <a href="#" data-toggle="modal" data-target="#change_password"><i class="fa fa-edit"></i>&nbsp;Change Password</a>
                    <a href="logout.php"><i class="fa fa-sign-out"></i>&nbsp;Logout</a>
                
            
</div>
<!-- Header -->
<div class="sticky-top">
<nav class="navbar navbar-dark" >

    <div class="login">
     <a  onclick="openNav()" style="cursor:pointer;"><img src="images/menu.png" width="50px"></a>
    </div>
    <div class="text-center"><i>AP-AMS</i>&nbsp;<img src="images/logo.jpeg" width="40px"></div>
</nav>
</div>
<!-- Display User Name after Login using Session Variable -->
<?php
    if(isset($_SESSION['name']) && isset($_SESSION['key']) && $_SESSION['key']==='123')
    {
        ?>
        <div class="alert alert-info text-center">
           <i class="fa fa-user"></i> <?php echo "Welcome,".$_SESSION['name'].",Head of Education"; ?>
        </div>
        <?php
    }
    else if(isset($_SESSION['name']) && isset($_SESSION['key']) && $_SESSION['key']==='321')
    {
        ?>
        <div class="alert alert-info text-center">
           <i class="fa fa-user"></i> <?php echo "Welcome,".$_SESSION['name'].",Visiting Officer"; ?>
        </div>
        <?php
    }
     else if(isset($_SESSION['name']) && isset($_SESSION['key']) && $_SESSION['key']==='1234')
    {
        ?>
        <div class="alert alert-info text-center">
           <i class="fa fa-user"></i> <?php echo "Welcome,".$_SESSION['name']; ?>
        </div>
        <?php
    }
?>
<!-- Change Password Form in Modal Box -->
<div class="modal" id="change_password">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Change Password</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form id="change_password_form">
          <div class="form-group">
            <img src="images/email.png" class="input_img" />
            <input type="text" name="email" class="form-fields" value="<?php if(isset($_SESSION['mail'])) echo $_SESSION['mail']; ?>" placeholder="Username" readonly>
            
          </div><br/>
          <div class="form-group">
            <label>Enter the Old Password:</label>
            <img src="images/password.png" class="input_img" />
            <input type="password" name="old" class="form-fields" placeholder="Old Password" required>
          </div><br/>
          <div class="form-group">
            <label>Enter the New Password:</label>
            <img src="images/password.png" class="input_img" />
            <input type="password" name="new" class="form-fields" pattern="[A-Za-z0-9@_.]{6,10}" title="Must contain at least 6 and not more than 10 characters" placeholder="New Password" required>
          </div><br/>
          <input type="hidden" name="key" value="User">
          <div class="form-group" style="text-align: center">
            <input type="submit" value="Change Password" id="submit" class="btn login-btn" >
          </div>
          <div class="text-center" id="response"></div>
        </form>
      </div>

      

    </div>
  </div>
</div>

<script type="text/javascript">
$('input').focus(function()
{
    $('#response').html(" ");
});
//AJAX call to change password
$('#change_password_form').submit(function(e)
{
    e.preventDefault();
    $.ajax({
        url:"changepassword.php",
        type:"POST",
        data:$('#change_password_form').serialize(),
        success:function(result){
            var res=$.trim(result);

            
            if(res=="Password Changed Successfully.")
            {
                $('#response').html("<b>"+res+"</b>");
                $('#response').css('color', 'green');
                $('#change_password_form')[0].reset();

            }
            else
            {
                $('#response').html("<b>"+res+"</b>");
                $('#response').css('color', 'red');
            }
        }
    });
});
</script>
<script>
    //Function to open and close sidenav bar
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }
    
    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>
