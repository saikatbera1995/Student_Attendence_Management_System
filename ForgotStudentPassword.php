<?php
  include_once("classes/Student.php");
  include_once("lib/Session.php");
  Session::checkLogin(); 
 ?>

<?php
error_reporting(0);
  $stu = new Student();
  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']))
  {
    $forgotPass = $stu->forgotPassword($_POST);
  }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Student Attandance System</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
  <link rel="icon" type="image/png" href="StudentLoginTemplate/images/icons/favicon.ico"/>
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="StudentLoginTemplate/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="StudentLoginTemplate/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="StudentLoginTemplate/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="StudentLoginTemplate/vendor/animate/animate.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="StudentLoginTemplate/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="StudentLoginTemplate/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="StudentLoginTemplate/vendor/select2/select2.min.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="StudentLoginTemplate/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="StudentLoginTemplate/css/util.css">
  <link rel="stylesheet" type="text/css" href="StudentLoginTemplate/css/main.css">
<!--===============================================================================================-->
</head>
<style type="text/css">
  .error{
    color: red;
  }
  .success{
    color: green;
  }
</style>
<body>
  
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <div class="container-login100-form-btn" style="text-align: center; margin-left: 250px;">
          
            <button class="login100-form-btn"  style="background: blue;color: white">
              <a href="index.php">Home Page</a>
            </button>
          
      </div>
        <div class="login100-form-title" style="background-image: url(StudentLoginTemplate/images/bg-01.jpg);">
          <span class="login100-form-title-1">
            Sign In
          </span>
        </div>

        <form class="login100-form validate-form" action="" method="post">
          <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
            <span class="label-input100">Email</span>
            <input class="input100" type="text" name="email" placeholder="Enter email">
            <span class="focus-input100"></span>
          </div>


          <?php
              if(isset($forgotPass))
              {
                echo $forgotPass;
              }

            ?>

          <div class="container-login100-form-btn">
            <button class="login100-form-btn" name="submit">
              Login
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  
<!--===============================================================================================-->
  <script src="StudentLoginTemplate/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
  <script src="StudentLoginTemplate/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
  <script src="StudentLoginTemplate/vendor/bootstrap/js/popper.js"></script>
  <script src="StudentLoginTemplate/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
  <script src="StudentLoginTemplate/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
  <script src="StudentLoginTemplate/vendor/daterangepicker/moment.min.js"></script>
  <script src="StudentLoginTemplate/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
  <script src="StudentLoginTemplate/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
  <script src="StudentLoginTemplate/js/main.js"></script>

</body>
</html>