<?php
class Session
{
	 public static function init(){
	 	session_start();
	 }
	 
	 public static function set($key, $val){
	 	$_SESSION[$key] = $val;
	 }

	 public static function get($key){
	 	if (isset($_SESSION[$key])) {
	 		return $_SESSION[$key];
	 	} else {
	 		return false;
	 	}
	 }

	 public static function checkAdminSession(){
	 	
	 	if (self::get("adminLogin") == false) {
	 		self::destroy();
	 		header("Location:AdminLogin.php");
	 	}
	 }

	 public static function checkAdminLogin(){
	 	self::init();
	 	if (self::get("adminLogin") == true) {
	 		header("Location:AdminIndex.php");
	 	}
	 }

	 public static function checkSession(){
	 	if (self::get("userLogin") == false) {
	 		self::destroy();
	 		header("Location:StudentLogin.php");
	 	}
	 }

	 public static function checkLogin(){
	 	self::init();
	 	if (self::get("userLogin") == true) {
	 		header("Location:StudentIndex.php");
	 	}
	 }

	 public static function destroy(){
	 	session_destroy();
	 	session_unset();
	 }
}

?>