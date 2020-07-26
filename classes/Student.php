<?php
	$filepath = realpath(dirname(__FILE__));
	include_once($filepath.'/../lib/Session.php');
	include_once($filepath.'/../lib/Database.php');
	include_once($filepath.'/../lib/Format.php');
?>
<?php
	Class Student
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function getStudents()
		{
			$query = "SELECT * FROM tbl_student";
			$result = $this->db->select($query);
			return $result;
		}

		public function insertStudent($name,$roll)
		{
			$name = mysqli_real_escape_string($this->db->link,strtoupper($name));
			$roll = mysqli_real_escape_string($this->db->link,$roll);
			if(empty($name) || empty($roll))
			{
				$msg = "<div class='alert alert-danger'><strong>Error!</strong>Field must not be empty !</div>";
				return $msg;
			}
			else
			{
				$stu_query = "INSERT INTO tbl_student(name,roll) VALUES('$name','$roll')";
				$stu_insert = $this->db->insert($stu_query);
				if($stu_insert)
				{
					$msg = "<div class='alert alert-success'><strong>Success!</strong>Student data inserted successfully!</div>";
					return $msg;
				}
				else
				{
					$msg = "<div class='alert alert-danger'><strong>Error!</strong>Student data not inserted!</div>";
					return $msg;
				}
			}
		}

		public function insertAttendance($attend=array(),$cur_date,$adminSub)
		{
			$adminSub = mysqli_real_escape_string($this->db->link,strtoupper($adminSub));
			$cur_date = mysqli_real_escape_string($this->db->link,$cur_date);
			$query = "SELECT * FROM tbl_attendance";
			$getdata = $this->db->select($query);
			
			while($result = $getdata->fetch_assoc())
			{
				$db_date = $result['att_time'];
				$db_subject = $result['subject'];
				if($adminSub == $db_subject)
				{
					if($cur_date == $db_date)
					{
						$msg = "<div class='alert alert-danger'><strong>Error!</strong> Attendance already taken today!</div>";
						
						return $msg;
					}
				}
			}
			foreach ($attend as $atn_key => $atn_value)
			{
				if($atn_value == "present")
				{
					$stu_query="INSERT INTO tbl_attendance(roll,attend,att_time,subject) VALUES('$atn_key','Present',now(),'$adminSub')";
					$data_insert = $this->db->insert($stu_query);
				}
				elseif($atn_value == "absent")
				{
					$stu_query= "INSERT INTO tbl_attendance(roll,attend,att_time,subject) VALUES('$atn_key','Absent',now(),'$adminSub')";
					$data_insert = $this->db->insert($stu_query);
				}
			}

			if($data_insert)
			{
				$msg = "<div class='alert alert-success'><strong>Success!</strong>Student attendance taken successfully!</div>";
				return $msg;
			}
			else
			{
				$msg = "<div class='alert alert-danger'><strong>Student attendance are alrealy taken!</strong></div>";
				return $msg;
			}	

							

		}

		public function getDateList()
		{
			$query = "SELECT DISTINCT att_time FROM tbl_attendance";
			$getdata = $this->db->select($query);
			return $getdata;
		}

		public function getAllData($dt)
		{
			$query = "SELECT tbl_student.name , tbl_attendance.*
						FROM tbl_student
						INNER JOIN tbl_attendance
						ON tbl_student.roll = tbl_attendance.roll
						WHERE att_time = '$dt'";
			$result = $this->db->select($query);
			return $result;
		}

		public function updateAttendance($attend,$dt)
		{
			foreach ($attend as $atn_key => $atn_value)
			{
				if($atn_value == "present")
				{
					$query = "UPDATE tbl_attendance SET attend='present'
								WHERE roll = '".$atn_key."' 
								AND att_time = '".$dt."'";
								$data_update = $this->db->update($query);
				}
				elseif($atn_value == "absent")
				{
					$query = "UPDATE tbl_attendance SET attend='absent'
								WHERE roll = '".$atn_key."' 
								AND att_time = '".$dt."'";
								$data_update = $this->db->update($query);
				}
			}

			if($data_update)
			{
				$msg = "<div class='alert alert-success'><strong>Success!</strong>Student attendance updated successfully!</div>";
				return $msg;
			}
			else
			{
				$msg = "<div class='alert alert-danger'><strong>Student attendance are not updated!</strong></div>";
				return $msg;
			}
		}

		public function userRegistration($roll,$password,$cnfpassword,$email)
		{
			$roll 	= $this->fm->validation($roll);
			$password 	= $this->fm->validation($password);
			$cnfpassword= $this->fm->validation($cnfpassword);
			$email 		= $this->fm->validation($email);
			
			$roll	= mysqli_real_escape_string($this->db->link,$roll);
			$password 	= mysqli_real_escape_string($this->db->link,$password);
			$cnfpassword 	= mysqli_real_escape_string($this->db->link,$cnfpassword);
			$email 		= mysqli_real_escape_string($this->db->link,$email);
			
			if($roll == "" || $password == "" || $cnfpassword == "" || $email == "" )
			{
				$msg = "<span class='danger'>Field must not be empty!</span>";
				return $msg;
			}
			else
			{

				if(preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $password) === 0)
				{
					$msg = "<span class='danger'>Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit</span>";
					return $msg;
				}
				if($password != $cnfpassword)
				{
					$msg = "<span class='danger'>pleace enter same password!</span>";
					return $msg;
				}
				if(!filter_var($email, FILTER_VALIDATE_EMAIL))
				{
					$msg = "<span class='danger'>Invalid email address!</span>";
					return $msg;
				}

				$chkquery1 = "SELECT * FROM tbl_student WHERE roll='$roll'";
				$chkRollresult = $this->db->select($chkquery1);
				if($chkRollresult == false)
				{
					$msg = "<span class='danger'>Rollno doesn't matched! enter valid roll no</span>";
					return $msg;
				}
				
				$chkquery = "SELECT * FROM tbl_user_reg WHERE email='$email'";
				$chkresult = $this->db->select($chkquery);
				if($chkresult != false)
				{
					$msg = "<span class='danger'>Email already exit!</span>";
					return $msg;
				}
				else
				{
					$password = md5($password);
					$query = "INSERT INTO tbl_user_reg(roll,password,email) VALUES('$roll','$password','$email')";
					$insert_row = $this->db->insert($query);
					if($insert_row)
					{
						$msg = "<span class='success'>Registration Successfully</span>";
						return $msg;
					}
					else
					{
						$msg = "<span class='danger'>Error try again!</span>";
						return $msg;
					}
				}
			}

		}

		public function userLogin($email,$password)
		{
			$email 		= $this->fm->validation($email);
			$password 	= $this->fm->validation($password);
			$email 		= mysqli_real_escape_string($this->db->link,$email);
			$password 	= mysqli_real_escape_string($this->db->link,md5($password));
			
			if($email == "" || $password == "")
			{
				$msg = "<span class='danger'>enter email & password!</span>";
				return $msg;
			}
			else
			{
				$query = "SELECT * FROM tbl_user_reg WHERE email='$email' AND password='$password'";
				$result = $this->db->select($query);
				if($result != false)
				{
						$value = $result->fetch_assoc();
						Session::init();
						Session::set("userLogin",true);
						Session::set("userId",$value['id']);
						Session::set("userRoll",$value['roll']);
						header("Location:StudentIndex.php");
				}
				else
				{
					$msg = "<span class='danger'>Email & Password doesn't matched!</span>";
						return $msg;
				}
			}
		}

		public function getStudentData($roll)
		{
			$roll 	= $this->fm->validation($roll);
			$roll	= mysqli_real_escape_string($this->db->link,$roll);
			$query = "SELECT * FROM tbl_student WHERE roll='$roll' ";
			$result = $this->db->select($query);
			return $result;
		}

		public function getStuAttData($StuRoll)
		{
			$StuRoll 	= $this->fm->validation($StuRoll);
			$StuRoll 	= mysqli_real_escape_string($this->db->link,$StuRoll);
			$query = "SELECT * FROM tbl_attendance WHERE roll='$StuRoll' ";
			$result = $this->db->select($query);
			return $result;
		}

		public function forgotPassword($data)
		{
			$email 		= $this->fm->validation($data['email']);
			$email 		= mysqli_real_escape_string($this->db->link,$email);
			
			if($email == "")
			{
				$msg = "<span class ='error'> Please enter a valid Email Id</span>";
				return $msg;
			}
			else
			{
				$query = "SELECT * FROM tbl_user_reg WHERE email='$email'";
				$result = $this->db->select($query);
				if($result == false)
				{
					$msg = "<span class ='error'> Invalid Email Id</span>";
					return $msg;
				}
				else
				{
						$value = $result->fetch_assoc();
						require_once("phpmailer/PHPMailer.php");
    					require_once("phpmailer/class.smtp.php");					
    					$mail = new PHPMailer();
						$mail->IsSMTP();
						$mail->SMTPDebug = 0;                                     // set mailer to use SMTP
						$mail->Host = "smtp.gmail.com";  // specify main and backup server
						$mail->SMTPAuth = true;
						$mail->SMTPSecure = "tls";
						$mail->Port     = 587;     // turn on SMTP authentication
						$mail->Username = "gdas64682@gmail.com";  // SMTP username
						$mail->Password = "Gopaldas5#"; // SMTP password

						$mail->AddReplyTo("gdas64682@gmail.com", "Information");
						$mail->SetFrom("gdas64682@gmail.com", "Student Attendance System");
						$mail->AddReplyTo("gdas64682@gmail.com", "Information");
						

						$mail->WordWrap = 50;                                 // set word wrap to 50 characters
						$mail->IsHTML(true);
						$address = $email;
						$message = "For the Security of your property , do not disclose your verification code to others";
						$name = $value['name'];
						$mail->addAddress($address);                               // set email format to HTML
						
						$mail->Subject = "Your forgot password";
						$mail->Body    = "<tr>
											<td><h3 style='color:Chartreuse'>".$name."</h3>Your password is <strong>".$value['password']."</strong></td>
										</tr>
										<tr>
											<td style='color:Crimson'>". $message." </td>
										</tr>";
						$mail->AltBody = "This is the body in plain text for non-HTML mail clients";

						if(!$mail->Send())
						{
						   $msg = "<span class ='error'> please enter correct </span>".$mail->ErrorInfo;
						   return $msg;
						}
						else
						{

						   $msg = "<span class ='success'> Your password has been sent to your gmail</span>";
						   return $msg;
						}

				}
								
							
			}
		}
	}
?>