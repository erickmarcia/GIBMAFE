<!DOCTYPE html>
<html>
<head lang="es">
	<meta charset="utf-8">
	<title>slide</title>
	<link rel="stylesheet" href="flexslider.css" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script src="jquery.flexslider.js"></script>
	
</head>
<body>
<div class="flexslider">
  <ul class="slides">
    <li>
      <img src="images/ima1.jpg" />
    </li>
    <li>
      <img src="images/ima2.jpg" />
    </li>
    <li>
      <img src="images/ima1.jpg" />
    </li>
    <li>
      <img src="images/ima2.jpg" />
    </li>
  </ul>
</div>

<script type="text/javascript">
		// Can also be used with $(document).ready()
$(window).load(function() {
  $('.flexslider').flexslider({
    animation: "slide"
  });
});
	</script>
</body>
</html>