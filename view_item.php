<?php
session_start();
include('connection.php');

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
    $user_type = $rowsql["user_type"];
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

  <title>View Item</title>
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
                <h4 class="card-title">View Item</h4> 
              </div><br>
              <?php
              if($user_type != "accountant"){
                ?>
                 <button class="btn btn-primary btn-round text-white " style="position: absolute; right: 0; margin-top: 10px; margin-right: 10px; width: 120px;" onclick="location.href='add_item.php?item'">Add Item</button>
                <?php
              }
              ?>
             
              <form method="POST" action="#">
                <div class="input-group col-lg-12">
                  <input type="text" class="form-control" style="border-radius: 25px;" placeholder="Search" name="sfield">&nbsp;
                  <select class="form-control" name="sdept">
                    <option value="">Select Department</option>
                    <?php
                    $searchdept = "SELECT * FROM department";
                    $rsltsearchdept = $conn->query($searchdept);
                    if($rsltsearchdept->num_rows>0){
                      while($rowsearchdept = $rsltsearchdept->fetch_assoc()){
                        $deptid = $rowsearchdept["dept_id"];
                        $deptname = $rowsearchdept["dept_name"];
                        ?>
                        <option value="<?php echo $deptid ?>"><?php echo $deptname ?></option>
                        <?php
                      }
                    }
                    ?>
                  </select>
                  <button type="submit" class="btn btn-round" name="search"><i class="fas fa-search"></i></button>
                </div><br>
              </form>
              <div class="card-body">
                <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th style='font-size:16px'>No</th>
                      <th style='font-size:16px'>Item Name</th>
                      <th style='font-size:16px'>Supplier </th>
					  <th style='font-size:16px'>Department</th>
                      <th style='font-size:16px'>Total In</th>
                      <th style='font-size:16px'>Total Out</th>
                      <th style='font-size:16px'>Item Balance </th>
					  <?php 
					  if ($user_type != "production") {
					  ?>
                      <th style='font-size:16px'>Item Unit Price</th>
					  <?php
					  }
					  ?>
                      <th style='font-size:16px'>Unit measure</th>
                      <?php
                      if($user_type != "accountant"){
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
                    $itemlist = "SELECT * FROM item AS a INNER JOIN department AS b ON a.department = b.dept_id INNER JOIN supply_item AS c ON a.item_id = c.item_id INNER JOIN supplier AS d ON c.supp_id = d.supp_id WHERE a.item_id != ''";
                    if(isset($_POST["search"])){
                      
                      if(isset($_POST["sfield"])){
                        $sfield = $_POST["sfield"];
                      }
                      else{
                        $sfield = "";
                      }

                      if(isset($_POST["sdept"])){
                        $sdept = $_POST["sdept"];
                      }
                      else{
                        $sdept = "";
                      }
                      
                      if($sfield != ""){
                        $itemlist .= " AND item_name LIKE '%".$sfield."%' OR item_desc LIKE '%".$sfield."%' OR balance LIKE '%".$sfield."%' OR unit_price LIKE '%".$sfield."%' OR unit_measure LIKE '%".$sfield."%' OR supp_name LIKE '%".$sfield."%'";
                      }
                      if($sdept != ""){
                        $itemlist .= " AND department = '".$sdept."'";
                      }
                    }
                    $rsltitemlistt = $conn->query($itemlist);
                    if($rsltitemlistt->num_rows>0){
                      while($rowitemlist = $rsltitemlistt->fetch_assoc()){
                        $i++;
                        $id = $rowitemlist["item_id"];
                        $name = $rowitemlist["item_name"];
                        $supp_name = $rowitemlist["supp_name"];
						$depart = $rowitemlist["dept_name"];
                        $totalin = $rowitemlist["total_in"];
                        $totalout = $rowitemlist["total_out"];
                        $balance = $rowitemlist["balance"];
                        $price = $rowitemlist["unit_price"];
                        $quantity = $rowitemlist["balance"];
                        $measure = $rowitemlist["unit_measure"];
                        $imagename = $rowitemlist["image_name"];
                        $videoname = $rowitemlist["video_name"];
                        
                        ?>
                        <tr>
                          <td style='font-size:14px'><?php echo $i ?></td>
                          <td style='font-size:14px'><?php echo $name ?></td>
                          <td style='font-size:14px'><?php echo $supp_name ?></td>
						  <td style='font-size:14px'><?php echo $depart ?></td>
                          <td style='font-size:14px'><?php echo $totalin ?></td>
                          <td style='font-size:14px'><?php echo $totalout ?></td>
                          <td style='font-size:14px'><?php echo $balance ?></td>
						  <?php
						  if ($user_type != "production") {
						  ?>
                          <td style='font-size:14px'><?php echo $price ?></td>
						  <?php
						  }
						  ?>
                          <td style='font-size:14px'><?php echo $measure ?></td>  
                          <?php
                          if($user_type != "accountant"){
                            ?>
                            <td style="width: 100px; text-align: center;">
                            <?php
                            if($imagename != ""){
                              ?>
                              <a type="button" href="image/<?php echo $imagename ?>" rel="tooltip" class="btn btn-primary btn-sm " data-original-title="" title=""> IMAGE
                              </a>
                              <?php
                            }
                            ?>
                            <?php
                            if($videoname != ""){
                              ?>
                              <a type="button" style="margin-top: 5px;" href="video/<?php echo $videoname ?>" rel="tooltip" class="btn btn-primary btn-sm " data-original-title="" title=""> VIDEO
                              </a>
                              <?php
                            }
                            ?>
                              <a style="margin-top: 5px;" type="button" href="add_item.php?item&type=update&itemid=<?php echo $id ?>" rel="tooltip" class="btn btn-success btn-icon btn-sm " data-original-title="" title="">UPDATE
                              </a>
                              <a style="margin-top: 5px;" type="button" href="delete_process.php?type=item&itemid=<?php echo $id ?>" rel="tooltip" class="btn btn-success btn-danger btn-sm " data-original-title="" onclick="return confirm('Are you sure you want to delete this item?');" title="">REMOVE
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
                      <td colspan="7" style="text-align: center;">
                          No Data
                      </td>
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
