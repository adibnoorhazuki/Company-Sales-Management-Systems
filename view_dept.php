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

  <title>Department List</title>
  <link rel="icon" href="img/C.png" type="image/gif" sizes="25x25">

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

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

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Department List</h4>
              </div><br>
              <button class="btn btn-primary btn-round text-white " style="position: absolute; right: 0; margin-top: 10px; margin-right: 10px; width: 150px;" onclick="location.href='add_dept.php?department'">Add Department</button>

              <form method="POST" action="#">
                <div class="input-group col-lg-5">
                  <input type="text" class="form-control" style="border-radius: 25px; margin-top: 20px;" placeholder="Search" name="sfield">&nbsp;
                  <button type="submit" class="btn btn-round" name="search" style="margin-top: 20px;"><i class="fas fa-search"></i></button>
                </div>
              </form>

              <form>
                <div class="card-body">
                  <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th style='font-size:16px'>No</th>
                        <!-- <th style='font-size:16px'>ID</th> -->
                        <th style='font-size:16px'>Department Name</th>
                        <th style='font-size:16px'>Department Description</th>
                        <th class="disabled-sorting text-center" style='font-size:16px'>Action</th>
                      </tr>
                    </thead>
                    
                    <tbody>

                      <?php
                      $i = 0;
                      $deptlist = "SELECT * FROM department";
                      if(isset($_POST["search"])){
                        if(isset($_POST["sfield"])){
                          $sfield = $_POST["sfield"];
                        }
                        else{
                          $sfield = "";
                        }

                        if($sfield != ""){
                          $deptlist .= " WHERE dept_name LIKE '%".$sfield."%' OR dept_desc LIKE '%".$sfield."%'";
                        }
                      }
                      $rsltdeptlist = $conn->query($deptlist);
                      if($rsltdeptlist->num_rows>0){
                        while($rowdeptlist = $rsltdeptlist->fetch_assoc()){
                          $i++;
                          $deptid = $rowdeptlist["dept_id"];
                          $name = $rowdeptlist["dept_name"];
                          $desc = $rowdeptlist["dept_desc"];

                          ?>
                          <tr>
                            <td style='font-size:12px'><?php echo $i ?></td>
                            <!-- <td style='font-size:12px'><?php echo $deptid ?></td> -->
                            <td style='font-size:12px'><?php echo $name ?></td>
                            <td style='font-size:12px'><?php echo $desc ?></td>
         
                            <td align="center">
                              <a type="button" href="add_dept.php?department&type=update&deptid=<?php echo $deptid ?>" rel="tooltip" class="btn btn-success btn-icon btn-sm " data-original-title="" title="">UPDATE
                              </a>
                            </td>
                          </tr>
                          <?php
                        }
                      }
                      ?>
                      
                        
                    </tbody>
                  </table>
                </div>
              </form>
              <!-- end content-->
            </div>
            <!--  end card  -->
          </div>
          <!-- end col-md-12 -->
        </div>
        <!-- end row -->
        

            </div>
          </div>


      </div>
      <!-- End of Main Content -->

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
  <!-- <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a> -->

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
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
