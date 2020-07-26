<?php
 include_once("inc/header.php");
 include_once("classes/Student.php");
?>

<script type="text/javascript">
	$(document).ready(function() {
		$("form").submit(function()
		{
			var roll = true;
			$(':radio').each(function()
			{
				name = $(this).attr('name');
				if(roll && !$(':radio[name="'+name+'"]:checked').length)
				{
					alert(name + " roll missing !");
					roll = false;
				}
			});
			return roll;
		});
	});
</script>

<?php
//error_reporting(0);
	$dt = $_GET['dt'];
	$stu = new Student();
	if($_SERVER['REQUEST_METHOD'] == 'POST')
 	{
 		$attend = $_POST['attend'];
 		$updateattend = $stu->updateAttendance($attend,$dt);
 	}
?>
<?php
	if(isset($updateattend))
	{
		echo $updateattend;
	}
?>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h2>
					<a class="btn btn-success" href="add.php">Add Student</a>
					<a class="btn btn-info pull-right" href="date_view.php">Back</a>
				</h2>
			</div>

			<div class="panel-body">
				<div class="well text-center" style="font-size: 20px">
					<strong>Today Date: </strong>
					<?php
						echo $dt;
					?>
				</div>
				<form action="" method="post">
					<table class="table table-striped">
						<tr>
							<th width="25%">Serial</th>
							<th width="25%">Student Name</th>
							<th width="25%">Student Roll</th>
							<th width="25%">Attendance</th>
						</tr>

					<?php 
						
						$get_data = $stu->getAllData($dt);
						if($get_data)
						{
							$i = 0;
							while ($value = $get_data->fetch_assoc()) {
							$i++;
					?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?php echo $value['name']; ?></td>
							<td><?php echo $value['roll']; ?></td>
							<td>
								<input type="radio" name="attend[<?php echo $value['roll']; ?>]" value="present"
								<?php if($value['attend'] == "present"){echo "checked" ;}?> >P
								<input type="radio" name="attend[<?php echo $value['roll']; ?>]" value="absent"
								<?php if($value['attend'] == "absent"){echo "checked" ;}?>>A
							</td>
						</tr>
					<?php }} ?>
						<tr>
							<td>
								<input type="submit" class="btn btn-primary"  name="submit" value="Update">
							</td>
						</tr>

					</table>
					
				</form>
				
			</div>
		</div>
<?php include "inc/footer.php"; ?>