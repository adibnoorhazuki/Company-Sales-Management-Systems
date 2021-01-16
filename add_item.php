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

if(isset($_GET["itemid"])){
  $id = $_GET["itemid"];
}
else{
  $id = "";
}

$iname = "";
$idesc = "";
$iprice = "";
$quantity = "";
$unitmeasure = "";
$idept = "";
$ideptid = "";
$isupp = "";
$isuppid = "";
$image = "";
$video = "";
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
    <title>Update Item</title>
    <?php
  }
  else{
    ?>
    <title>Add Item</title>
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
                <h3 class="card-title"><b>Update Item</b></h3>
                <?php
              }
              else{
                ?>
                <h3 class="card-title"><b>Add Item</b></h3>
                <?php
              }
              if($type == "update"){
               $update = "SELECT *, c.supp_name AS suppname, d.dept_name AS deptname FROM item AS a INNER JOIN supply_item AS b ON a.item_id = b.item_id INNER JOIN supplier AS c ON b.supp_id = c.supp_id INNER JOIN department AS d ON a.department = d.dept_id WHERE a.item_id = '".$id."'";
                $rsltupdate = $conn->query($update);
                if($rsltupdate->num_rows>0){
                  while($rowupdate = $rsltupdate->fetch_assoc()){
                    $iname = $rowupdate["item_name"];
                    $idesc = $rowupdate["item_desc"];
                    $iprice = $rowupdate["unit_price"];
                    $quantity = $rowupdate["total_in"];
                    $unitmeasure = $rowupdate["unit_measure"];
                    $idept = $rowupdate["deptname"];
                    $ideptid = $rowupdate["department"];
                    $isupp = $rowupdate["suppname"];
                    $isuppid = $rowupdate["supp_id"];
                    $image = $rowupdate["image_name"];
                    $video = $rowupdate["video_name"];

                  }
                }
                else{
                  echo "Error : " . $update . "<br>" . $conn->error;
                }
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
                    <form id="add_dept" method="post" action="update_process.php?type=item&itemid=<?php echo $id ?>" enctype="multipart/form-data">
                    <?php
                  }
                  else{
                    ?>
                    <form id="add_dept" method="post" action="add_process.php?type=item" enctype="multipart/form-data">
                    <?php
                  }
                  ?>
                    <div class="form-group">
                      <label for="dept_name">Item Name</label>
                      <input type="text" id="dept_name" name="item_name" class="form-control" value="<?php echo $iname ?>" required>
                    </div>
  
                    <div class="form-group">
                      <label for="dept_desc">Item Description</label>
                      <input type="text" id="dept_desc" name="item_desc" class="form-control" value="<?php echo $idesc ?>" required>
                    </div>
                    
                    <div class="form-group">
                      <label for="dept_desc">Item Unit Price</label>
                      <input type="text" id="dept_desc" name="item_price" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo $iprice ?>" required>
                    </div>

                    <?php
                    if($type == "update"){
                      ?>
                      <div class="form-group">
                        <label for="new_item_quantity">New Item Quantity</label>
                        <input type="text" id="new_item_quantity" name="new_item_quantity" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                      </div>
                      <?php
                    }
                    ?>
  
                    <div class="form-group">
                      <label for="dept_desc">Item Quantity</label>
                      <input type="text" id="dept_desc" name="item_quantity" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo $quantity ?>" required>
                    </div>
  
                    <div class="form-group">
                      <label for="dept_desc">Unit Measure</label>
                      <input type="text" id="dept_desc" name="item_measure" class="form-control" value="<?php echo $unitmeasure ?>" required>
                    </div>

                    <div class="form-group">
                      <label for="dept_desc">Department</label>
                      <select class="form-control" name="item_dept">
                        <?php
                        if($type == "update"){
                          ?>
                          <option value="<?php echo $ideptid ?>"><?php echo $idept ?></option>
                          <?php
                        }
                        else{
                          ?>
                          <option value=""> Select Department </option>
                          <?php
                        }
                        ?>
                        
                        <?php
                        $dept = "SELECT * FROM department";
                        $rsltdept = $conn->query($dept);
                        if($rsltdept->num_rows>0){
                          while($rowdept = $rsltdept->fetch_assoc()){
                            $deptid = $rowdept["dept_id"];
                            $deptname = $rowdept["dept_name"];
                            ?>
                            <option value="<?php echo $deptid ?>"><?php echo $deptname ?></option>
                            <?php
                          }
                        }
                        ?>
                      </select>
                      <label style="margin-top: 5px;" for="dept_desc">
                        <a href="#" data-toggle="modal" data-target="#addDeptModal">
                          Add Department
                        </a>
                      </label>
                    </div>

                    <div class="form-group">
                      <label for="dept_desc">Supplier</label>
                      <select class="form-control" name="item_supp">
                        <?php
                        if($type == "update"){
                          ?>
                          <option value="<?php echo $isuppid ?>"><?php echo $isupp ?></option>
                          <?php
                        }
                        else{
                          ?>
                          <option value=""> Select Supplier </option>
                          <?php
                        }
                        ?>
                        
                        <?php
                        $supp = "SELECT * FROM supplier";
                        $rsltsupp = $conn->query($supp);
                        if($rsltsupp->num_rows>0){
                          while($rowsupp = $rsltsupp->fetch_assoc()){
                            $suppid = $rowsupp["supp_id"];
                            $suppname = $rowsupp["supp_name"];
                            ?>
                            <option value="<?php echo $suppid ?>"><?php echo $suppname ?></option>
                            <?php
                          }
                        }
                        ?>
                      </select>
                      <label style="margin-top: 5px;" for="dept_desc">
                        <a href="#" data-toggle="modal" data-target="#addSuppModal">
                          Add Supplier
                        </a>
                      </label>
                    </div>

                    <div class="form-group">
                      <label for="image_name">Image</label>
                      <?php
                      if($type == "update"){
                        if($image != ""){
                          ?>
                          <br>
                          <label>Existing Image: </label>
                          <img style="width: 200px; height: 200px; margin-top: 10px; margin-bottom: 10px;" src="image/<?php echo $image ?>" alt="Existing Image" />
                          <input type="hidden" name="ext_image" value="<?php echo $image ?>">
                          <?php
                        }
                      }
                      ?>
                      <input type="file" id="image_name" name="image_name" id="image_name" class="form-control" accept="image/*">
                      <img style="width: 200px; height: 200px; margin-top: 10px;" id="image_preview" src="#" alt="Selected Image" />
                    </div>

                    <div class="form-group">
                      <label for="video_name">Video (MUST BE LESS THAN 10 MB)</label>
                      <?php
                      if($type == "update"){
                        if($video != ""){
                          ?>
                          <br>
                          <label>Existing video: </label>
                          <a href="video/<?php echo $video ?> ?>"><?php echo $video ?></a>
                          <input type="hidden" name="ext_image" value="<?php echo $video ?>">
                          <?php
                        }
                      }
                      ?>
                      <input type="file" id="video_name" name="video_name" id="video_name" class="form-control" accept="video/*">
                    </div>

                    <?php
                    if($type == "update"){
                      ?>
                      <input type="hidden" name="id" value="<?php echo $id ?>">
                      <input style="margin-top: 20px;" type="submit" name="update" class="btn btn-primary btn-round btn-lg btn-block mb-3" value="Update">
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

  <!-- Department Modal-->
  <div class="modal fade" id="addDeptModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form action="add_process.php?type=dept&stat=pro" method="POST">
        <div class="Modalcontent">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Department</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          
          <div class="form-group" style="padding-left: 10px; padding-right: 10px;">
            <label for="dept_name">Department Name</label>
            <input type="text" id="dept_name" name="dept_name" class="form-control" required>
          </div>

          <div class="form-group" style="padding-left: 10px; padding-right: 10px;">
            <label for="dept_desc">Department Description</label>
            <input type="text" id="dept_desc" name="dept_desc" class="form-control" required>
          </div>
          
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <input type="submit" class="btn btn-primary" value="Add">
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Supplier Modal-->
  <div class="modal fade" id="addSuppModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form action="add_process.php?type=supp&stat=pro" method="POST">
        <div class="Modalcontent">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Supplier</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          
          <div class="form-group" style="padding-left: 10px; padding-right: 10px;">
            <label for="dept_name">Supplier Name</label>
            <input type="text" id="dept_name" name="supp_name" class="form-control" required>
          </div>

          <div class="form-group" style="padding-left: 10px; padding-right: 10px;">
            <label for="dept_desc">Supplier Address</label>
            <input type="text" id="dept_desc" name="supp_add" class="form-control" required>
          </div>
          
          <div class="form-group" style="padding-left: 10px; padding-right: 10px;">
            <label for="dept_desc">Supplier Phone No</label>
            <input type="tel" id="dept_desc" name="supp_phone" class="form-control" pattern="[0-9]{10,11}" required>
          </div>

          <div class="form-group" style="padding-left: 10px; padding-right: 10px;">
            <label for="dept_desc">Supplier Email</label>
            <input type="text" id="dept_desc" name="supp_email" class="form-control" required>
          </div>

          <div class="form-group" style="padding-left: 10px; padding-right: 10px;">
            <label for="dept_desc">Supplier Fax Number</label>
            <input type="text" id="dept_desc" name="supp_fax" class="form-control" required>
          
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <input type="submit" class="btn btn-primary" value="Add">
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- for image preview -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script type="text/javascript">
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
          reader.onload = function (e) {
            $('#image_preview').attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
        }
    }

    $("#image_name").change(function(){
        readURL(this);
    });
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
