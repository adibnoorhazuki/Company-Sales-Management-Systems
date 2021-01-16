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

if(isset($_GET["userid"])){
  $id = $_GET["userid"];
}
else{
  $id = "";
}

$name = "";
$user_ic = "";
$user_email = "";
$user_phone = "";
$user_type = "";
$password = "";
$confirm_password = "";
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Profile</title>
  
  <link rel="icon" href="img/C.png" type="image/gif" sizes="25x25">

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <?php include('menu.php'); ?>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $uname ?></span>
                <!-- <img src="img/C.png" width= "45px" class="col-lg-5 d-none d-lg-block"> -->
                <img class="img-profile rounded-circle" src="img/profile.jpg">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="profile.php">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">

                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- End of Topbar -->
        <!-- /.container-fluid -->

        <div class="col-md-10" style="margin: 0 auto;">
          <div class="card " >
            <div class="card-header">
              <h3 class="card-title"><b>Profile</b></h3>
              
            </div>
            <div class="card-body">
                <div class="toolbar">
                  <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>
  
                <div class="col-lg-12">
                  <form id="add_dept" method="post" action="update_process.php?type=profile&userid=<?php echo $uid ?>">
                    
                    <?php
                    $update = "SELECT * FROM user WHERE user_id = '".$uid."'";
                    $rsltupdate = $conn->query($update);
                    if($rsltupdate->num_rows>0){
                      while($rowupdate = $rsltupdate->fetch_assoc()){
                        $name = $rowupdate["user_name"];
                        $user_ic = $rowupdate["user_ic"];
                        $user_email = $rowupdate["user_email"];
                        $user_phone = $rowupdate["user_phone"];
                        $user_type = $rowupdate["user_type"];
                        $password = $rowupdate["password"];
                        $confirm_password = $rowupdate["confirm_password"];
                      }
                    }
                    ?>
  
                    <div class="form-group">
                      <label for="user_name">User Name</label>
                      <input type="text" id="user_name" name="user_name" class="form-control" placeholder="User Full Name" value="<?php echo $name ?>" required>
                    </div>
  
                    <div class="form-group">
                      <label for="user_ic">NRIC</label>
                      <input type="text" id="user_ic" name="user_ic" class="form-control" placeholder="NRIC (without -)" value="<?php echo $user_ic ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="12" required>
                    </div>

                    <div class="form-group">
                      <label for="user_email">Email</label>
                      <input type="email" id="user_email" name="user_email" class="form-control" placeholder="User Email" value="<?php echo $user_email ?>" required>
                    </div>

                    <div class="form-group">
                      <label for="user_phone">Phone Number</label>
                      <input type="text" id="user_phone" name="user_phone" class="form-control" placeholder="Phone No (without -)" value="<?php echo $user_phone ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="15" required>
                    </div>

                    <div class="form-group">
                      <label for="user_type">User Type</label>
                      <select name="user_type" class="form-control">
                        <option value=""> Select User Type </option>
                        <option value="staff"> Staff </option>
                        <option value="accountant"> Accountant </option>
                        <option value="production"> Production </option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" id="password" name="password" class="form-control" placeholder="User Password" value="<?php echo $password ?>" onkeyup="check();" required>
                    </div>

                    <div class="form-group">
                      <label for="confirm_password">Confirm Password</label>
                      <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm Password" value="<?php echo $confirm_password ?>" onkeyup="check();" required>
                      <span id='message'></span>
                    </div>
                      <input type="hidden" name="user_id" value="<?php echo $uid ?>">
                      <input style="margin-top: 20px;" type="submit" name="submit" class="btn btn-primary btn-round btn-lg btn-block mb-3" value="Update">
                  </form>
                </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; CSMS 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Are you sure want to logout?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    var check = function() {
      if (document.getElementById('password').value ==
        document.getElementById('confirm_password').value) {
        document.getElementById('message').style.color = 'green';
        document.getElementById('message').innerHTML = 'matching';
      } 
      else {
        document.getElementById('message').style.color = 'red';
        document.getElementById('message').innerHTML = 'not matching';
      }
    }
  </script>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
