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
    <!-- 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    -->

	<!-- <link rel='stylesheet' href='./css/bootstrap-slate.min.css'> -->

	<!-- Optional theme
	<link rel='stylesheet' href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css'>
	-->

	<!-- Custom styles for this template -->
	<link href='css/custom.css' rel='stylesheet'>
	<link href='css/navbar-fixed-top.css' rel='stylesheet'>
<!--	<link href='css/view.css' rel='stylesheet' media='all'> -->

	<!-- jQuery (required by Bootstrap's JavaScript plugins) -->
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
    <script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>

    <!--
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    --> 

	<script src='js/view.js'></script>
	<script src='js/calendar.js'></script>
	<script src="js/utilities.js"></script>

</head>
<body>
