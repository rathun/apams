
    
    

        
        <?php
        include 'db.php';
        $ins=$_POST['nsc'];
        $start_year=$_POST['start_year'];
        $end_year=$_POST['end_year'];
        $sql="SELECT rating,academic_year FROM rating WHERE institution_name='KNMS School' AND academic_year BETWEEN '$start_year' AND '$end_year'";
        if($res=mysqli_query($con,$sql))
        {
            //echo "1";

            $overall_dataPoints = array();
            
            while($row=mysqli_fetch_array($res))
            {
                //echo mysqli_num_rows($res);
            
                //$question=;
                //echo $row['academic_year'];
                //echo $row["rating"];
                array_push($overall_dataPoints,array("y" => number_format((float)$row['rating'], 2, '.', ''),"label" => $row['academic_year']));
            
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
                text: "<?php echo $ins; ?>",
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
   
    

