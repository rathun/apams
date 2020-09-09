<?php
if(isset($_POST['key']) && $_POST['key']=='789')
{
  
  
  include '../db.php';
  $date=$_POST['date'];
  $nsc=$_POST['nsc'];
  $vo=$_POST['vo'];
  //echo $id;
  ?>
    <!DOCTYPE html>
    <html>
    <head>
      <title>View Feedbacks</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="../css/bootstrap.min.css">
      <script src="../js/jquery.min.js"></script>
      <script src="../js/popper.min.js"></script>
      <script src="../js/bootstrap.min.js"></script>
      <link rel="stylesheet" type="text/css" href="../css/home.css">
      <script src="../js/font.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <style type="text/css">
        
        body
        {
          font-style: italic;
        }
        .container-fluid{
          width:920px;
          left:0;
          scroll-behavior: smooth;
        }
        .t
        {
          height: 100px;
        }
        .img
        {
          width:300px;
        }
      </style>
    </head>
    <body>
    <?php include 'header.php' ?>
    <!-- <div class="table-responsive fixed-bottom">
    <div class="d-flex container-fluid justify-content-center ">
      <ul class="pagination">    

      <li class="page-item"><a class="page-link" href="#tab1">Section 1</a></li>
      <li class="page-item"><a class="page-link" href="#tab2">Section 2</a></li>
      <li class="page-item"><a class="page-link" href="#tab3">Section 3</a></li>
      <li class="page-item"><a class="page-link" href="#tab4">Section 4</a></li>
      <li class="page-item"><a class="page-link" href="#tab5">Section 5</a></li>
      <li class="page-item"><a class="page-link" href="#tab6">Section 6</a></li>
      <li class="page-item"><a class="page-link" href="#tab7">Section 7</a></li>
      <li class="page-item"><a class="page-link" href="#tab8">Section 8</a></li>
      <li class="page-item"><a class="page-link" href="#tab9">Section 9</a></li>    
      <li class="page-item"><a class="page-link" href="#tab10">Section 10</a></li>
    </ul></div></div> -->
    <div class="container justify-content-center">
       <div class="card" >
            <div class="card-header text-center">
            <b>Details</b>
            </div>
            <?php
            
            $sql1="SELECT DISTINCT * FROM feedback WHERE date='$date' AND institution='$nsc' AND visiter_id='$vo'";
            if($res1=mysqli_query($con,$sql1))
            {
              $row1=mysqli_fetch_array($res1);
            
            ?>
            <div class="card-body">
            <div class="form-group">
              <label>Name of Institution:</label>
              <input type="text" value="<?php echo $row1['institution']; ?>" class="form-control1" readonly>
            </div><br/>
            <div class="form-group">
              <label>Date of Visit:</label>
              <input type="text" value="<?php echo date_format(date_create($row1["date"]),"d-m-Y"); ?>" class="form-control1" readonly>
            </div><br/>
            <div class="form-group">
              <label>Academic year:</label>
              <input type="text" value="<?php echo $row1["year"]; ?>" class="form-control1" readonly>
            </div><br/>
            <div class="form-group">
              <label>Visited By:</label>
              <?php
              $name=$row1['visiter_id'];
              $sql="SELECT * FROM user WHERE username='$name'";
              if($res=mysqli_query($con,$sql))
              {
                $row=mysqli_fetch_array($res);
              ?>
              <input type="text" value="<?php echo $row['name']; ?>" class="form-control1" readonly>
              <?php
              }
            ?>
            </div><br/>
            <div class="form-group">
              <label>Feedback Submitted Location:<i class="btn map text-primary">Map View</i></label>
              <input type="hidden" name="id" id="loc" value="<?php echo $row1['location']; ?>">
              
            </div><br/>
            </div>
            </div>
            <div class="modal" id="map">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
              
                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">Location</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body" id="mapcon">
                 
                </div>
                
                
                
              </div>
            </div>
          </div>
          <br/>
          <div class="card" >
            <div class="card-header text-center">
            <b>Rating</b>
            </div>
            <div class="card-body" >
                  <div id="overall_chart" style="height: 350px; width: 100%;"></div>
          <?php
            }
            $sql_rating="SELECT * FROM feedback INNER JOIN criteria ON feedback.criteria_id=criteria.criteria_id WHERE feedback.date='$date' AND feedback.institution='$nsc' AND feedback.visiter_id='$vo'";
            if($res_rating=mysqli_query($con,$sql_rating))
            {
              $overall_dataPoints = array();
              while($row_rating=mysqli_fetch_array($res_rating))
              {
               
                   array_push($overall_dataPoints,array("label" =>  $row_rating['criteria_name'] ,"y" => number_format((float)$row_rating['rating'], 2, '.', '')));
                 
              }
            }
            ?>
            <script src="../js/canvasjs.min.js"></script>
        <script>
                            
                             
        var overall_chart = new CanvasJS.Chart("overall_chart", {
          theme: "light2",
    animationEnabled: true,
    title: {
        text: " Rating",fontSize:20
    },
    data: [{
        type: "doughnut",
        indexLabel: "{y}",
        yValueFormatString: "#,##0.0\"%\"",
        showInLegend: true,
        legendText: "{label} : {y}",
        dataPoints: <?php echo json_encode($overall_dataPoints, JSON_NUMERIC_CHECK); ?>
    }]
        });
        overall_chart.render();
         
        </script>

                  </div>
          </div>
          <br/>
          <script>
          $(document).on("click", ".map", function(){
                    //alert("hi");
                    var idm=$('#loc').val();
                    //alert(idm);
                    $.ajax({
                        url: 'map.php',
                        type: "POST",
                        data:{id :idm ,key:'258'},
                        
                        success: function(data) {
                            $('#map').modal('show');
                            $('#mapcon').html(data);
                            
                        },
                        error: function(xhr, status, err) {
                            alert("Error");
                        }
                    });     
                    
                  });
                </script>
    <div id="btn-criteria">
    <div class="dropdown">
    <button type="button"  class="btn alert-info" data-toggle="dropdown">
      <i class="fa fa-bars"></i>
    </button>
    <div class="dropdown-menu">
    <?php 
    $sql_criteria3="SELECT criteria_id FROM criteria";
    if($res_criteria3=mysqli_query($con,$sql_criteria3))
    {
      $c=1;
      while($row_criteria3=mysqli_fetch_array($res_criteria3))
      {
        ?><a class="dropdown-item" href="#<?php echo 'tab'.$c; ?>">Criteria <?php echo $c; ?></a><?php
        $c++;
      }
    }
    ?>
  </div>
</div>
    </div>
      
      
   
    <?php
    $sql_criteria="SELECT * FROM criteria WHERE criteria_type='O'";
    if($res_criteria=mysqli_query($con,$sql_criteria))
    {
      $c=1;
      while($row_criteria=mysqli_fetch_array($res_criteria))
      {

              $id=$row_criteria['criteria_id'];
              ?>
              
              <div  id="tab<?php echo $c; ?>" class="p-5"></div>
              <div class="card " >
              <div class="card-header text-center">
                <b>Criteria <?php echo $c; ?>:<?php echo $row_criteria['criteria_name']; ?></b>
              </div>
              <?php
              $file=$row_criteria['criteria_questions'];
              $msg=json_decode($file,true);
              //echo $msg;
              $array=$msg;
              $n=sizeof($msg);
              $sql1="SELECT * FROM feedback WHERE date='$date' AND institution='$nsc' AND visiter_id='$vo' AND criteria_id='$id'";
              if($res1=mysqli_query($con,$sql1))
              {
                $row1=mysqli_fetch_row($res1);
                 $pd=$row1['20'];
                  $ins=$row1['3'];
                  $photo=$row1['19'];
              for($i=0,$j=8;$i<$n;$i++,$j++)
              {
                // echo $j;
                
                // echo $row1[$j];
              ?>
              <div class="card-body">
              <div class="form-group">
                  <label><?php echo $msg[$i]["question"]; ?></label>
                  <?php 
                  //echo $row1[$j];
                  if($row1[$j]=='1')
                  {
                    ?>
                  <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" value="1" checked>
                    <label class="custom-control-label" for="section1yes<?php echo $i+1; ?>">1</label>
                  </div>    
                  <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input"  value="2" disabled>
                    <label class="custom-control-label" for="section1no<?php echo $i+1; ?>">2</label>
                  </div>
                    <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input"  value="3" disabled>
                    <label class="custom-control-label" for="section1no<?php echo $i+1; ?>">3</label>
                  </div>
                    <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="section1no<?php echo $i+1; ?>" name="section1<?php echo $i+1; ?>" value="4" disabled>

                    <label class="custom-control-label" for="section1no<?php echo $i+1; ?>">4</label>
                     </div>
                    <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="section1no<?php echo $i+1; ?>" name="section1<?php echo $i+1; ?>" value="5" disabled>
                    <label class="custom-control-label" for="section1no<?php echo $i+1; ?>">5</label>
                  </div>  <?php
                  }  
                  else if($row1[$j]=='2')
                  {
                     ?>
                  <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" value="1" disabled>
                    <label class="custom-control-label" for="section1yes<?php echo $i+1; ?>">1</label>
                  </div>    
                  <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input"  value="2" checked>
                    <label class="custom-control-label" for="section1no<?php echo $i+1; ?>">2</label>
                  </div>
                    <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="section1no<?php echo $i+1; ?>" name="section1<?php echo $i+1; ?>" value="3" disabled>
                    <label class="custom-control-label" for="section1no<?php echo $i+1; ?>">3</label>
                  </div>
                    <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="section1no<?php echo $i+1; ?>" name="section1<?php echo $i+1; ?>" value="4" disabled>
                    <label class="custom-control-label" for="section1no<?php echo $i+1; ?>">4</label>
                  </div>
                    <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="section1no<?php echo $i+1; ?>" name="section1<?php echo $i+1; ?>" value="5" disabled>
                    <label class="custom-control-label" for="section1no<?php echo $i+1; ?>">5</label>
                  </div>   <?php
                  }
                  else if($row1[$j]=='3')
                  {
                      ?>
                  <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" value="1" disabled>
                    <label class="custom-control-label" for="section1yes<?php echo $i+1; ?>">1</label>
                  </div>    
                  <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="section1no<?php echo $i+1; ?>" name="section1<?php echo $i+1; ?>" value="2" disabled>
                    <label class="custom-control-label" for="section1no<?php echo $i+1; ?>">2</label>
                  </div>
                    <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input"  value="3" checked>
                    <label class="custom-control-label" for="section1no<?php echo $i+1; ?>">3</label>
                  </div>
                    <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="section1no<?php echo $i+1; ?>" name="section1<?php echo $i+1; ?>" value="4" disabled>
                    <label class="custom-control-label" for="section1no<?php echo $i+1; ?>">4</label>
                  </div>
                    <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="section1no<?php echo $i+1; ?>" name="section1<?php echo $i+1; ?>" value="5" disabled>
                    <label class="custom-control-label" for="section1no<?php echo $i+1; ?>">5</label>
                  </div>   <?php
                  }
                  else if($row1[$j]=='4')
                  {
                      ?>
                  <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" value="1" disabled>
                    <label class="custom-control-label" for="section1yes<?php echo $i+1; ?>">1</label>
                  </div>    
                  <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="section1no<?php echo $i+1; ?>" name="section1<?php echo $i+1; ?>" value="2" disabled>
                    <label class="custom-control-label" for="section1no<?php echo $i+1; ?>">2</label>
                  </div>
                    <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="section1no<?php echo $i+1; ?>" name="section1<?php echo $i+1; ?>" value="3" disabled>
                    <label class="custom-control-label" for="section1no<?php echo $i+1; ?>">3</label>
                  </div>
                    <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input"  value="4" checked>
                    <label class="custom-control-label" for="section1no<?php echo $i+1; ?>">4</label>
                  </div>
                    <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="section1no<?php echo $i+1; ?>" name="section1<?php echo $i+1; ?>" value="5" disabled>
                    <label class="custom-control-label" for="section1no<?php echo $i+1; ?>">5</label>
                  </div>   <?php
                  }
                  else if($row1[$j]=='5')
                  {
                      ?>
                  <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" value="1" disabled>
                    <label class="custom-control-label" for="section1yes<?php echo $i+1; ?>">1</label>
                  </div>    
                  <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="section1no<?php echo $i+1; ?>" name="section1<?php echo $i+1; ?>" value="2" disabled>
                    <label class="custom-control-label" for="section1no<?php echo $i+1; ?>">2</label>
                  </div>
                    <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="section1no<?php echo $i+1; ?>" name="section1<?php echo $i+1; ?>" value="3" disabled>
                    <label class="custom-control-label" for="section1no<?php echo $i+1; ?>">3</label>
                  </div>
                    <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="section1no<?php echo $i+1; ?>" name="section1<?php echo $i+1; ?>" value="4" disabled>
                    <label class="custom-control-label" for="section1no<?php echo $i+1; ?>">4</label>
                  </div>
                    <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input"  value="5" checked>
                    <label class="custom-control-label" for="section1no<?php echo $i+1; ?>">5</label>
                  </div>   <?php
                  }
                  ?>
              </div>
              </div>
              
             
              <?php
              }
              ?>
              <div class="card-body">
              <div class="form-group">
                <label>Comments:</label>
                <textarea class="form-control1" disabled=""><?php echo $row1['22']; ?></textarea>
              </div>
              <br/>
              <div class="form-group">
                <label>Rating:</label>
                <input type="text" class="form-control1" value="<?php echo number_format((float)$row1['21'], 2, '.', ''); ?>" readonly>
              </div>
            </div>
              <br/>
               <div class="form-group">
                <center>
                  <?php
                  // $pd=$row_criteria['photo_data'];
                  // $ins=$row_criteria['institution'];
                  $sql_check="SELECT rating,comments FROM feedback WHERE photo_data='$pd' AND institution!='$ins' AND criteria_id!='$id'";
                  $res_check=mysqli_query($con,$sql_check);
                  $n_check=mysqli_num_rows($res_check);
                  $row_check=mysqli_fetch_array($res_check);
                  ?>
                  <img src="../Photos/<?php echo $photo; ?>" class="img"><br/>
                  <?php
                  if($n_check>0)
                  {
                    ?><p class="text-danger"><b><?php echo "This photo upload for different institution"; ?></b></p><?<?php
                  }
                  ?>
                  </center>
              </div>
              
              <br/>
              <?php
              }
              ?>
              
              </div>
          <?php
              $c++;
            }
          }
          ?>
           </div>
  
        
       
  <br/>
  <?php include '../footer.php'; ?>
 
</body>
</html>
<?php

}
else
{
  
   ?>
    <script type="text/javascript">
      location.replace("view_feedbacks.php");
    </script>
    <?php
}
?>
