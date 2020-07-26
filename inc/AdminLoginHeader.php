<?php
	$filepath = realpath(dirname(__FILE__));
	include_once($filepath.'/../lib/Session.php');
	include_once($filepath.'/../lib/Format.php');
	Session::checkAdminLogin();

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
	<div class="container">
		<div class="panel-heading">
			<h2>
					<a class="btn btn-success" href="index.php">Home</a>
					<a class="btn btn-info pull-right" href="StudentPage.php">Student Login/Register</a>
			</h2>
		</div>
		<div class="well text-center">
			<h2>Student Attandance System</h2>
		</div>
