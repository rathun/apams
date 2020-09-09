<html>
<head>
	<title>Geolocation</title>
    <!--Including Bootstrap Files,Jquery and Stylesheet -->
	  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</script>
</head>
<body>
  //Link form the page
  <?php $link=$_POST['link']; ?>
	<form action="<?php echo $link; ?>" id="frm" method="POST">
		<input type="hidden" id="loc" name="loc">
	</form>
<script type="text/javascript">
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      } else { 
       alert("Geolocation is not supported by this browser.");
      }
      function showPosition(position) {
       	$('#loc').val(position.coords.latitude+","+position.coords.longitude);
	     document.getElementById("frm").submit();
      }     
</script>

</body>
</html>