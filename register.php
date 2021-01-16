<?php
session_start();
include("connection.php");

if(isset($_SESSION["userid"])){
  $uid = $_SESSION["userid"];
}
else{
  header('Location: login.php');
}

$sql = "SELECT * FROM user WHERE user_id = '".$uid."'";
$rsltsql = $conn->query($sql);
if($rsltsql->num_rows>0){
  while($rowsql = $rsltsql->fetch_assoc()){
    $uname = $rowsql["user_name"];
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Register</title>
  <link rel="icon" href="img/C.png" type="image/gif" sizes="25x25">

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <img src="img/C.png" width= "45px" class="col-lg-5 d-none d-lg-block">
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account</h1>
              </div>
              <form action = "register_action.php" method="post" class="user">
                <div class="form-group">
                  <!-- <div class="col-sm-6"> -->
                    <input type="text" class="form-control form-control-user" name="user_name" id="user_name" placeholder="Name" autofocus required>
                </div>
                <div class="form-group">
                  <!-- <div class="col-sm-6"> -->
                    <input type="int" class="form-control form-control-user" name="user_ic" id="user_ic" placeholder="NRIC (without -)" maxlength="12">
                </div>
                <!-- </div> -->
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" name="user_email" id="user_email" placeholder="Email Address">
                </div>
                <div class="form-group">
                  <!-- <div class="col-sm-6"> -->
                    <input type="int" class="form-control form-control-user" name="user_phone" id="user_phone" placeholder="Phone No (without -)" maxlength="15">
                </div>
                <div class="form-group">
                  <!-- <div class="col-sm-6 mb-3 mb-sm-0"> -->
                    <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Password">
                  <!-- </div> -->
                </div>
                <div class="form-group">
                  <!-- <div class="col-sm-6 mb-3 mb-sm-0"> -->
                    <input type="password" class="form-control form-control-user" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                  <!-- </div> -->
                </div>
                <input name="register" type="submit" class="btn btn-primary btn-user btn-block" value="Register Account">
              </form>
              <hr>
              
              <div class="text-center">
                <a class="small" href="login.php">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
