<?php
	include_once("inc/AdminLoginHeader.php");
	include_once("classes/Admin.php"); 
 ?>
 <?php
 	$adm = new Admin();
 	if($_SERVER['REQUEST_METHOD'] == 'POST')
 	{
 		$adminUser = $_POST['adminUser'];
 		$adminPass = $_POST['adminPass'];
 		$logindata = $adm->getAdminData($adminUser,$adminPass);
 	}
 ?>

 <?php
 	if(isset($logindata))
 	{
 		echo $logindata;
 	}
 ?>

		<div class="panel panel-default">

			<div class="panel-body">
				<form action="" method="post">

					<div class="form-group">
						<label for="name">Username</label>
						<input type="text" class="form-control"  name="adminUser" required="">
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" class="form-control" name="adminPass" required="">
					</div>
					<div class="form-group">
						<input type="submit" class="btn btn-primary" name="submit" value="Submit">
					</div>
					
				</form>
				
			</div>
		</div>


		<div class="well">
		</div>
	</div>
</body>
</html>