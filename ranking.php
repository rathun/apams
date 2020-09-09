<!DOCTYPE html>
<html>
<head>
	<title>AP-AMS</title>
    <!--Including Bootstrap Files,Jquery and Stylesheet -->
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <script src="js/font.js"></script>
     <script src="js/canvasjs.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     
</script>
</head>
<body>
    <!--Including Header -->
	<div class="sticky-top">
    <nav class="navbar navbar-dark" >
        <div class="text-left"><img src="images/logo.jpeg" width="40px">&nbsp;<i>AP-AMS</i></div>
        <div class="text-right"><a href="index.php"><i class="fa fa-home"></i></a></div>
    </nav>
    </div>
    <br/>
    
    
        <div class="card" style="padding: 20px">
            <div class="card-header">
                <h4 style="color:#662200" class="text-center"><i>Overall Ranking</i></h4>    
            </div>
            <div class="card-body">
               <!--  <div class="container">
                    <div class="form-group">
                        <img src="images/search.png" class="input_img" />
                        <select id="search" class="form-fields">
                            <option value="None">None</option>
                            <?php 
                            include 'db.php';
                            // $sql_ins="SELECT name from institution";
                            // if($res_ins=mysqli_query($con,$sql_ins))
                            // {
                            //     while($row_ins=mysqli_fetch_array($res_ins))
                            //     {
                            //         ?><option value="<?php //echo $row_ins['name']; ?>"><?php// echo $row_ins['name']; ?></option><?php
                            //     }
                            // }
                            ?>
                        </select>
                        
                    </div>
                </div> -->
                <br/>
                <center><button class="btn btn-light" data-toggle="modal" data-target="#modal_cmp"><i class="fa fa-filter"></i>Compare</button></center>
                <br/>
                <div id="res_search">
                <div class="table-responsive text-center">
                    <table class="table table-striped">
                        <tr><th></th><th>Rank</th><th>Institution</th><th>District</th><th>Rating</th></tr>
                            <?php
                            
                            $sql="SELECT * FROM rating ORDER BY rating DESC";
                            if($res=mysqli_query($con,$sql))
                            {
                                $rank=1;
                                while($row=mysqli_fetch_array($res))
                                {
                                    ?><tr id="<?php echo $row['institution_name']; ?>" class="ins"><td><form action="ranking_chart.php" method="POST"><input type="hidden" name="ins" value="<?php echo $row['institution_name']; ?>"><input type="hidden" name="year" value="<?php echo $row['academic_year']; ?>"><button type="submit"  class="btn"><i class="fa fa-eye"></i></button></form></td><td><?php echo $rank; ?></td><td><?php echo $row['institution_name']; ?></td><td><?php echo $row['district']; ?></td><td><?php echo number_format((float)$row['rating'], 2, '.', ''); ?></td></tr><?php
                                    $rank++;
                                   
                                }

                            }
                            ?>
                        </table>
                         
                    </div>
                </div>
            </div>
       
        </div>
  
      <br/>
      <!-- The Modal -->
        <div class="modal" id="modal_cmp">
          <div class="modal-dialog">
            <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Compare</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                <form id="cmp">
                    <div class="form-group">
                         <label>Select Type of Compare:</label>
                        <select name="type" id="type" class="form-control1">
                           
                            <option value="None">None</option>
                            <option value="Compare Between years">Compare Between years</option>
                            <option value="Compare Institution">Compare Institution</option>
                        </select>
                    </div>
                    <br/>
                    <div id="res_cmp">
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" id="sub" class="btn btn-warning" value="Get Report">
                    </div>
                </form>
              </div>
              <div class="modal-footer">
                <div id="overall_chart" style="height: 350px; width: 100%;"></div>
                
              </div>

            </div>
          </div>
        </div>
<div id="graph">
                    
                </div>
    <!-- Including Footer -->
	<?php include 'footer.php'; ?> 
    <script type="text/javascript">
        $("#sub").hide();
       if($('#type').val()=="Compare Between years" && $('#type').val()=="None")
        {
            $("input").prop('disabled', true);
        }
        else
        {
            $("input").prop('disabled', false);
        }
          $(document).on('change', '#type', function(){
        
        
        //alert("hi");
            var id=$('#type').val();
            //alert(id);
            if(id=="None")
            {
                alert("Compare Type not Selected");
            }
            else
            {
                $.ajax({
                url:"compare_ranking.php",
                type:"POST",
                data:{type:id},
                success:function(result){
                $('#res_cmp').html(result);
               $("#sub").show();
                

            }
            });
        }
        });
          $('#cmp').submit(function(e)
          {
            e.preventDefault();
            if($('#type').val()=="Compare Between years")
            {
                $.ajax({
                url:"compare_years.php",
                type:"POST",
                data:$('#cmp').serialize(),
                success:function(result){
                $('#graph').html(result);
                }
            });
            }
            else if($('#type').val()=="Compare Institution")
            {
                $.ajax({
                url:"compare_institution.php",
                type:"POST",
                data:$('#cmp').serialize(),
                success:function(result){
                $('#graph').html(result);
                }
            });
            }
          });
          //  $.ajax({
          //     url:"search_overall_ranking.php",
          //     type:"POST",
          //     data:{search:search,key:456},
          //     success:function(result){
          //       //alert("hi");
          //         $('#res_search').html(result);
          //     }
          // });
      //     $(document).on('change', '#search', function(){
      //       var search=$('#search').val();
      //     if(search=="None")
      //     {
      //       $('.ins').show();
      //     }
      //     else
      //     {
      //       var s="#"+search;
      //       alert(s);
      //       $('.ins').hide();
      //       $(s).show();
            
      //     }
      // });
          // 
          // for(var i=1;i<n.length;i++)
          // {

          // }
          
          // var s="#"+search;
          // if(search==name)
          // {

          // }
       
    </script>
</body>
</html>
