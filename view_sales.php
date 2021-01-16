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
    $utype = $rowsql["user_type"];
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

  <title>View Sales</title>
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

    <?php  include("menu.php") ?>

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
                <h4 class="card-title">View Sales</h4>
              </div><br>
              <?php
              if($utype != "staff"){
                ?>
                 <button class="btn btn-primary btn-round text-white " style="position: absolute; right: 0; margin-top: 10px; margin-right: 10px; width: 120px;" onclick="location.href='add_sales.php?sales'">Add Sales</button>
                <?php
              }
              ?>
             
              
              <div class="card-body">
                <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th style='font-size:16px'>No</th>
                      <!-- <th style='font-size:16px'>Sales ID</th> -->
                      <th style='font-size:16px'>Customer Name</th>
                      <th style='font-size:16px'>Sales Date</th>
                      <th style='font-size:16px'>Item</th>
                      <th style='font-size:16px'>Quantity</th>
                      <th style='font-size:16px'>Total Amount</th>
                      <th style='font-size:16px'>Delivery Date</th>
                      <?php
                      if($utype != "staff"){
                        ?>
                        <th class="disabled-sorting text-center" style='font-size:16px'>Action</th>
                        <?php
                      }
                      ?>
                    </tr>
                  </thead>
                  
                  <tbody>
                    <?php
                    $i = 0;
                    $sales = "SELECT * FROM sales AS a INNER JOIN customer AS b on a.cust_id = b.cust_id INNER JOIN item AS c on a.item_id = c.item_id";
                    $rsltsales = $conn->query($sales);
                    if($rsltsales->num_rows>0){
                      while($rowsales = $rsltsales->fetch_assoc()){
                        $i++;
                        $id = $rowsales["sales_id"];
                        $custname = $rowsales["cust_name"];
                        $date = $rowsales["sales_date"];
                        $newdate = date("d/m/Y", strtotime($date));
                        $item = $rowsales["item_name"];
                        $qty = $rowsales["sales_qty"];
                        $total = $rowsales["sales_total_amount"];
                        $deliverydate = $rowsales["sales_delivery_date"];
                        $newdeliverydate = date("d/m/Y", strtotime($deliverydate));
                        ?>
                        <tr>
                          <td style='font-size:12px'><?php echo $i ?></td>
                          <!-- <td style='font-size:12px'><?php echo $id ?></td> -->
                          <td style='font-size:12px'><?php echo $custname ?></td>
                          <td style='font-size:12px'><?php echo $newdate ?></td>
                          <td style='font-size:12px'><?php echo $item ?></td>
                          <td style='font-size:12px'><?php echo $qty ?></td>
                          <td style='font-size:12px'>RM <?php echo $total ?></td>
                          <td style='font-size:12px'><?php echo $newdeliverydate ?></td>
                          <?php
                          if($utype != "staff"){
                            ?>
                            <td align="center">
                              <a type="button" href="add_sales.php?sales&type=update&salesid=<?php echo $id ?>" rel="tooltip" class="btn btn-success btn-icon btn-sm " data-original-title="" title="">UPDATE
                                <i class="now-ui-icons ui-2_settings-90"></i>
                              </a>
                            </td>
                            <?php
                          }
                          ?>
                          
                        </tr>
                        <?php
                      }
                    }
                    else{
                      ?>
                      <tr>
                        <td colspan="8" style="text-align: center;"> No Data </td>
                      </tr>
                      <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
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
