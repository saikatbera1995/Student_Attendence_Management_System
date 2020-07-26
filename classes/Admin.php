<?php
	$filepath = realpath(dirname(__FILE__));
	include_once($filepath.'/../lib/Session.php');
	include_once($filepath.'/../lib/Database.php');
	include_once($filepath.'/../lib/Format.php');

	class Admin
	{
		private $db;
		private $fm;
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function getAdminData($adminUser,$adminPass)
		{
			$adminUser = $this->fm->validation($adminUser);
			$adminPass = $this->fm->validation($adminPass);
			$adminUser = mysqli_real_escape_string($this->db->link,$adminUser);
			$adminPass = mysqli_real_escape_string($this->db->link,md5($adminPass));

			$query = "SELECT * FROM tbl_admin WHERE username='$adminUser' AND password='$adminPass'";
			$result = $this->db->select($query);
			if($result != false)
			{
				$value = $result->fetch_assoc();
				Session::init();
				Session::set("adminLogin",true);
				Session::set("adminUser",$value['username']);
				Session::set("adminId",$value['id']);
				Session::set("adminSub",$value['subject']);
				header("Location:AdminIndex.php");
			}
			else
			{
				$msg = "<span class='danger'>Username or Passsword not Matched!</span>";
				return $msg;
			}
		}
	}


?>