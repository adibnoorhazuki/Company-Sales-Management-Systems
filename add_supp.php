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


if(isset($_GET["type"])){
  $type = $_GET["type"];
}
else{
  $type = "";
}

if(isset($_GET["suppid"])){
  $id = $_GET["suppid"];
}
else{
  $id = "";
}

$name = "";
$add = "";
$phone = "";
$email = "";
$fax = "";
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <?php
  if($type == "update"){
    ?>
    <title>Update Supplier</title>
    <?php
  }
  else{
    ?>
    <title>Add Supplier</title>
    <?php
  }
  ?>
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
        <div class="col-md-10" style="margin: 0 auto;">
          <div class="card " >
            <div class="card-header">
              <?php
              if($type == "update"){
                ?>
                <h3 class="card-title"><b>Update Supplier</b></h3>
                <?php
              }
              else{
                ?>
                <h3 class="card-title"><b>Add Supplier</b></h3>
                <?php
              }
              ?>
            </div>
            <?php
            $update = "SELECT * FROM supplier WHERE supp_id = '".$id."'";
            $rsltupdate = $conn->query($update);
            if($rsltupdate->num_rows>0){
              while($rowupdate = $rsltupdate->fetch_assoc()){
                $name = $rowupdate["supp_name"];
                $add = $rowupdate["supp_address"];
                $phone = $rowupdate["supp_no"];
                $email = $rowupdate["supp_email"];
                $fax = $rowupdate["fax_no"];
              }
            }
            ?>
            <div class="card-body">
                <div class="toolbar">
                  <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>
  
                <div class="col-lg-12">
                  <?php
                  if($type == "update"){
                    ?>
                    <form id="add_dept" method="post" action="update_process.php?type=supp&suppid=<?php echo $id ?>">
                    <?php
                  }
                  else{
                    ?>
                    <form id="add_dept" method="post" action="add_process.php?type=supp">
                    <?php
                  }
                  ?>
                    <div class="form-group">
                      <label for="dept_name">Supplier Name</label>
                      <input type="text" id="dept_name" name="supp_name" class="form-control" value="<?php echo $name ?>" required>
                    </div>
  
                    <div class="form-group">
                      <label for="dept_desc">Supplier Address</label>
                      <input type="text" id="dept_desc" name="supp_add" class="form-control" value="<?php echo $add ?>" required>
                    </div>
                    
                    <div class="form-group">
                      <label for="dept_desc">Supplier Phone No</label>
                      <input type="tel" id="dept_desc" name="supp_phone" class="form-control" value="<?php echo $phone ?>" pattern="[0-9]{10,11}" required>
                    </div>
  
                    <div class="form-group">
                      <label for="dept_desc">Supplier Email</label>
                      <input type="text" id="dept_desc" name="supp_email" class="form-control" value="<?php echo $email ?>" required>
                    </div>

                    <div class="form-group">
                      <label for="dept_desc">Supplier Fax Number</label>
                      <input type="text" id="dept_desc" name="supp_fax" class="form-control" value="<?php echo $fax ?>" required>
                    </div>
                    <?php
                    if($type == "update"){
                      ?>
                      <input style="margin-top: 20px;" type="submit" name="submit" class="btn btn-primary btn-round btn-lg btn-block mb-3" value="Update">
                      <?php
                    }
                    else{
                      ?>
                      <input style="margin-top: 20px;" type="submit" name="submit" class="btn btn-primary btn-round btn-lg btn-block mb-3" value="Save">
                      <?php
                    }
                    ?>
                    
                  </form>
                </div>
            </div>
          </div>
        </div>
      </div>


      <!-- Footer -->
      <!-- <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; CSMS 2020</span>
          </div>
        </div>
      </footer> -->
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
