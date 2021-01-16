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

if(isset($_GET["salesid"])){
  $id = $_GET["salesid"];
}
else{
  $id = "";
}

$date = "";
$name = "";
$nameid = "";
$item = "";
$itemid = "";
$qty = "";
$total = "";
$desc = "";
$deliverydate = "";
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
    <title>Update Sales</title>
    <?php
  }
  else{
    ?>
    <title>Add Sales</title>
    <?php
  }
  ?>
  
  <link rel="icon" href="img/C.png" type="image/gif" sizes="25x25">

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <style type="text/css">
    .Modalcontent{
      position: relative;
      display: flex;
      flex-direction: column;
      width: 120%;
      pointer-events: auto;
      background-color: #fff;
      background-clip: padding-box;
      border: 1px solid rgba(0, 0, 0, 0.2);
      border-radius: 0.3rem;
      outline: 0;
    }
  </style>

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
                <h3 class="card-title"><b>Update Sales</b></h3>
                <?php
              }
              else{
                ?>
                <h3 class="card-title"><b>Add Sales</b></h3>
                <?php
              }
              ?>
            </div>
            <div class="card-body">
                <div class="toolbar">
                  <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>
  
                <div class="col-lg-12">
                  <?php
                  if($type == "update"){
                    ?>
                    <form id="add_dept" method="post" action="update_process.php?type=sale">
                    <?php
                  }
                  else{
                    ?>
                    <form id="add_dept" method="post" action="add_process.php?type=sale">
                    <?php
                  }

                  $sales = "SELECT * FROM sales AS a INNER JOIN customer AS b ON a.cust_id = b.cust_id INNER JOIN item AS c ON a.item_id = c.item_id WHERE sales_id = '".$id."'";
                  $rsltsales = $conn->query($sales);
                  if($rsltsales->num_rows>0){
                    while($rowsales = $rsltsales->fetch_assoc()){
                      $date = $rowsales["sales_date"];
                      $name = $rowsales["cust_name"];
                      $nameid = $rowsales["cust_id"];
                      $item = $rowsales["item_name"];
                      $itemid = $rowsales["item_id"];
                      $qty = $rowsales["sales_qty"];
                      $total = $rowsales["sales_total_amount"];
                      $desc = $rowsales["sales_desc"];
                      $deliverydate = $rowsales["sales_delivery_date"];
                    }
                  }
                  ?>  
                    <div class="form-group">
                      <label for="sales_date">Sales Date</label>
                      <input type="date" id="sales_date" name="sales_date" class="form-control" value="<?php echo $date ?>" required>
                    </div>
  
                    <div class="form-group">
                      <label for="cust_id">Customer Name</label>
                      <select class="form-control" name="cust_id">
                        <?php
                        if($type == "update"){
                          ?>
                          <option value="<?php echo $nameid ?>"> <?php echo $name ?> </option>
                          <?php
                        }
                        else{
                          ?>
                          <option value=""> Select Customer </option>
                          <?php
                        }
                        ?>
                        
                        <?php
                        $cust = "SELECT * FROM customer";
                        $rsltcut = $conn->query($cust);
                        if($rsltcut->num_rows>0){
                          while($rowcust = $rsltcut->fetch_assoc()){
                            $custid = $rowcust["cust_id"];
                            $custname = $rowcust["cust_name"];
                            ?>
                            <option value="<?php echo $custid ?>"><?php echo $custname ?></option>
                            <?php
                          }
                        }
                        ?>
                      </select>
                      <label for="cust_id">
                        <a href="#" data-toggle="modal" data-target="#addCustModal"> 
                          Add Customer 
                        </a>
                      </label>
                    </div>
                    
                    <div class="form-group">
                      <label for="item_id">Item Name</label>
                      <select class="form-control" name="item_id">
                        <?php
                        if($type == "update"){
                          ?>
                          <option value="<?php echo $itemid ?>"> <?php echo $item ?> </option>
                          <?php
                        }
                        else{
                          ?>
                          <option value=""> Select Item </option>
                          <?php
                        }
                        ?>
                        
                        <?php
                        $item = "SELECT * FROM item";
                        $rsltitem = $conn->query($item);
                        if($rsltitem->num_rows>0){
                          while($rowitem = $rsltitem->fetch_assoc()){
                            $itemid = $rowitem["item_id"];
                            $itemname = $rowitem["item_name"];
                            ?>
                            <option value="<?php echo $itemid ?>"> <?php echo $itemname ?></option>
                            <?php
                          }
                        }
                        ?>
                      </select>
                    </div>
  
                    <div class="form-group">
                      <label for="sales_qty">Sales Quantity</label>
                      <input type="text" id="sales_qty" name="sales_qty" class="form-control" value="<?php echo $qty ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
                    </div>
  
                    <div class="form-group">
                      <label for="sales_total_amount">Sales Total Amount</label>
                      <input type="text" id="sales_total_amount" name="sales_total_amount" class="form-control" value="<?php echo $total ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
                    </div>

                    <div class="form-group">
                      <label for="sales_desc">Sales Description</label>
                      <input type="text" id="sales_desc" name="sales_desc" class="form-control" value="<?php echo $desc ?>" required>
                    </div>

                    <div class="form-group">
                      <label for="sales_delivery_date">Delivery Date</label>
                      <input type="date" id="sales_delivery_date" name="sales_delivery_date" class="form-control" value="<?php echo $deliverydate ?>" required>
                    </div>
                    
                    <?php 
                    if($type == "update"){
                      ?>
                      <input type="hidden" name="sales_id" value="<?php echo $id ?>">
                      <input style="margin-top: 20px;" type="submit" name="submit" class="btn btn-primary btn-round btn-lg btn-block mb-3" value="Update">
                      <?php
                    }
                    else{
                      ?>
                      <input type="hidden" name="user_id" value="<?php echo $userid ?>">
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

  <!-- Customer Modal-->
  <div class="modal fade" id="addCustModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form action="add_process.php?type=cust&stat=pro" method="POST">
        <div class="Modalcontent">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>

          <div class="form-group" style="padding-left: 10px; padding-right: 10px;">
            <label for="cust_name">Customer Name</label>
            <input type="text" id="cust_name" name="cust_name" class="form-control" required>
          </div>

          <div class="form-group" style="padding-left: 10px; padding-right: 10px;">
            <label for="cust_add">Customer Address</label>
            <input type="text" id="cust_add" name="cust_add" class="form-control" required>
          </div>

          <div class="form-group" style="padding-left: 10px; padding-right: 10px;">
            <label for="cust_phone">Customer Phone Number</label>
            <input type="text" id="cust_phone" name="cust_phone" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  required>
          </div>

          <div class="form-group" style="padding-left: 10px; padding-right: 10px;">
            <label for="cust_email">Customer Email</label>
            <input type="email" id="cust_email" name="cust_email" class="form-control" required>
          </div>
          
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <input type="submit" class="btn btn-primary" value="Add">
          </div>
        </div>
      </form>
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
