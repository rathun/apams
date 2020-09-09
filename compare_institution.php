
    
    

        
        <?php
        include 'db.php';
        $ins1=$_POST['ins1'];
        $ins2=$_POST['ins2'];
        //echo $ins1." ",$ins2;
        $overall_dataPoints = array();
        $sql="SELECT rating FROM rating WHERE institution_name='$ins1'";
        if($res=mysqli_query($con,$sql))
        {
            //echo "1";

            
            $i=1;
            while($row=mysqli_fetch_array($res))
            {
                //echo mysqli_num_rows($res);
            
                //$question=;
                
               // echo $row["rating"];
                array_push($overall_dataPoints,array("y" => number_format((float)$row['rating'], 2, '.', ''),"label" => $ins1));
                $i++;
            
           }
                
        }
        else
        {
            echo mysqli_error($con);
        }
         $sql="SELECT rating FROM rating WHERE institution_name='$ins2'";
        if($res=mysqli_query($con,$sql))
        {
            //echo "1";

            
            $i=1;
            while($row=mysqli_fetch_array($res))
            {
                //echo mysqli_num_rows($res);
            
                //$question=;
                
                //echo $row["rating"];
                array_push($overall_dataPoints,array("y" => number_format((float)$row['rating'], 2, '.', ''),"label" => $ins2));
                $i++;
            
           }
                
        }
        else
        {
            echo mysqli_error($con);
        }
        ?>
        <script src="js/canvasjs.min.js"></script>
        <script>
                            
                             
        var overall_chart = new CanvasJS.Chart("overall_chart", {
           animationEnabled: true,
            theme: "light2",
            title:{
                text: "Comparison",
                fontSize: 20
            },
            axisY: {
                title: "Rating"
            },
            data: [{
                type: "column",
                yValueFormatString: "#,##0.## ",
                dataPoints: <?php echo json_encode($overall_dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        overall_chart.render();
         
        </script>
  
      <br/>
   
    

