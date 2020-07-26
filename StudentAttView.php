<?php
 include_once("inc/StudentHeaderPage.php");
 include_once("classes/Student.php");
 $StuRoll = Session::get("userRoll");
?>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h2>
					<a class="btn btn-success" href="add.php">Add Student</a>
					<a class="btn btn-info pull-right" href="AdminIndex.php">Take Attendance</a>
				</h2>
			</div>

			<div class="panel-body">
				<div class="well text-center" style="font-size: 20px">
					<strong>Today Date: </strong>
					<?php
						$cur_date = date('Y-m-d');
						echo $cur_date;
					?>
				</div>
				<form action="" method="post">
					<table class="table table-striped">
						<tr>
							<th width="20%">Serial</th>
							<th width="30%">Subject</th>
							<th width="30%">Your Attandance</th>
							<th width="20%">Date</th>
						</tr>

					<?php 
						$stu = new Student();
						$get_data = $stu->getStuAttData($StuRoll);
						if($get_data)
						{
							$i = 0;
							while ($value = $get_data->fetch_assoc()) {
							$i++;
					?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?php echo $value['subject']; ?></td>
							<td><?php echo $value['attend']; ?></td>
							<td><?php echo $value['att_time']; ?></td>
						</tr>
					<?php }} ?>

					</table>
					
				</form>
				
			</div>
		</div>
<?php include "inc/footer.php"; ?>