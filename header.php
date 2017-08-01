<?php
        if (session_status() == PHP_SESSION_NONE) session_start();
        $_SESSION["LASTPAGE"] = $_SERVER['PHP_SELF'];
        require("authorized.php");

	$isAuthorized = checkAuthorized();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta charset='utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1'>

	<title>
<?php
	echo $page_title;
?>
	</title>

	<!-- Latest compiled and minified CSS -->
	<link rel='stylesheet' href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
	<!-- <link rel='stylesheet' href='./css/bootstrap-slate.min.css'> -->

	<!-- Optional theme
	<link rel='stylesheet' href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css'>
	-->

	<!-- Custom styles for this template -->
	<link href='css/custom.css' rel='stylesheet'>
	<link href='css/navbar-fixed-top.css' rel='stylesheet'>

	<!-- jQuery (required by Bootstrap's JavaScript plugins) -->
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>


	<!-- Latest compiled and minified JavaScript -->
	<script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>

</head>
<body>
