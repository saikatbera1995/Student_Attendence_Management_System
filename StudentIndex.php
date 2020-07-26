<?php
 include_once("inc/StudentHeaderPage.php");
 include_once("classes/Student.php");
 $studentRoll = Session::get("userRoll");
 
?>

		<div class="panel panel-default">
			
			<div class="panel-body">
				<div class="well text-center" style="font-size: 20px">
					<strong>Today Date: </strong>
					<?php
						$cur_date = date('Y-m-d');
						echo $cur_date;
						echo  $studentRoll;
					?>
					
				</div>
				
					
					<table class="table table-striped">

					<?php 
						$stu = new Student();
						$get_data = $stu->getStudentData($studentRoll);
						if($get_data)
						{
							
							while ($value = $get_data->fetch_assoc()) {
					?>
						<tr>
							<td> Roll No: 
							<?php echo $value['roll'];?></td>
							<td> Name: 
							<?php echo $value['name']; ?>
							<a class="btn btn-info pull-right" href="StudentAttView.php">View Your Attendance</a></td>
						</tr>
					<?php }} ?>

					</table>
					
				
			</div>
		</div>
<?php include "inc/StudentFooterPage.php"; ?>