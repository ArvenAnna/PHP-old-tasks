<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">
	<script src="js/jquery.js"></script>
	<script src="js/script.js"></script>

	<title>Rent</title>
</head>

<body>
<div class="container" id="page">

	<div id="header" style="background-color:pink">
		header
	</div>

	<div id="content">
	<?php include $_SERVER['DOCUMENT_ROOT'] . "/Controller/init.php";?>
	</div>
	
	<div id="msg">
	</div>
	
	<div style="margin:20px">
	<a href="Order_list.php">Order list</a>
	</div>
	
	<div id="footer" style="background-color:pink">
		footer
	</div>

</div>

</body>
</html>
