<?php
  include_once("classes/Student.php");
  include_once("lib/Session.php");
  Session::checkLogin(); 
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
						<a class="btn btn-info pull-right" href="AdminLogin.php">Admin Login</a>
				</h2>
			</div>
		<div class="well text-center">
			<h2>Student Attandance System</h2>
		</div>
<style type="text/css">
	h3{
		height: 50px;
		width: 500px;
		margin-left: 400px;
		margin-top: 200px;
	}
</style>
		<div class="panel panel-default">

			<div class="panel-body">
				<h3>
					<a class="btn btn-success" href="StudentRegister.php">Student Register</a>
					<a class="btn btn-info pull-right" href="StudentLogin.php">Student Login</a>
				</h3>
				
			</div>
		</div>

<div class="well">
		</div>
	</div>
</body>
</html>