<?php
	$filepath = realpath(dirname(__FILE__));
	include_once($filepath.'/../lib/Session.php');
	include_once($filepath.'/../lib/Database.php');
	Session::init();
	Session::checkAdminSession();

?>


<html>
<head>
	<meta charset="utf-8">
	<title> Student Attandance System </title>
	<link rel="stylesheet" href="inc/bootstrap.min.css" media="screen" title="no-title" />
	<script type="text/javascript" src="inc/jquery.min.js"></script>
	<script type="text/javascript" src="inc/bootstrap.min.js"></script>
</head>
<style type="text/css">
	body
	{
  		background-image: url("image/Simple-Background-Images-25.png");
	}
</style>
<body>
	<?php
		if(isset($_GET['action']) && $_GET['action'] == 'logout')
		{
			Session::destroy();
			header("Location:AdminLogin.php");
			exit();
		}
	?>
	<div class="container">
		<div class="well text-center">
			<h2>Student Attandance System</h2>
		</div>
		<h3 style="margin-left: 1000px"><a class="btn btn-success" href="?action=logout">Logout</a></h3>
