<?php
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
    $user_type = $rowsql["user_type"];
  }
}
?>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <?php
  if($user_type == "staff"){
    ?>
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
      <div class="sidebar-brand-icon rotate-n-15">
        <img class="img-profile rounded-circle" width="43px" src="img/C.png">
      </div>
      <div class="sidebar-brand-text mx-3">CSMS</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      MODULE
    </div>

    <?php
    if(isset($_GET["dashboard"])){
      ?>
      <li class="nav-item active">
      <?php
    }
    else{
      ?>
      <li class="nav-item">
      <?php
    }
    ?>
      <a class="nav-link" href="index.php?dashboard">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <?php
    if(isset($_GET["department"])){
      ?>
      <li class="nav-item active">
      <?php
    }
    else{
      ?>
      <li class="nav-item">
      <?php
    }
    ?>
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="far fa-building"></i></i>
        <span>Department</span>
      </a>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="add_dept.php?department">Add Department</a>
          <a class="collapse-item" href="view_dept.php?department">View Department</a>
        </div>
      </div>
    </li>

    <?php
    if(isset($_GET["supp"])){
      ?>
      <li class="nav-item active">
      <?php
    }
    else{
      ?>
      <li class="nav-item">
      <?php
    }
    ?>
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-people-carry"></i></i>
        <span>Supplier</span>
      </a>
      <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="add_supp.php?supp">Add Supplier</a>
          <a class="collapse-item" href="view_supp.php?supp">View Supplier</a>
        </div>
      </div>
    </li>

  <!-- Nav Item - Utilities Collapse Menu -->
    <?php
    if(isset($_GET["item"])){
      ?>
      <li class="nav-item active">
      <?php
    }
    else{
      ?>
      <li class="nav-item">
      <?php
    }
    ?>
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities1" aria-expanded="true" aria-controls="collapseUtilities1">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Item</span>
      </a>
      <div id="collapseUtilities1" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="add_item.php?item">Add Item</a>
          <a class="collapse-item" href="view_item.php?item">View Item</a>
        </div>
      </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <?php
    if(isset($_GET["sales"])){
      ?>
      <li class="nav-item active">
      <?php
    }
    else{
      ?>
      <li class="nav-item">
      <?php
    }
    ?>
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-shopping-bag"></i>
        <span>Sales</span>
      </a>
      <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="view_sales.php?sales">View Sales</a>
        </div>
      </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
    <?php
  }
  else if($user_type == "accountant"){
    ?>
     <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
      <div class="sidebar-brand-icon rotate-n-15">
        <img class="img-profile rounded-circle" width="43px" src="img/C.png">
      </div>
      <div class="sidebar-brand-text mx-3">CSMS</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      MODULE
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <?php
    if(isset($_GET["item"])){
      ?>
      <li class="nav-item active">
      <?php
    }
    else{
      ?>
      <li class="nav-item">
      <?php
    }
    ?>
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities1" aria-expanded="true" aria-controls="collapseUtilities1">
      <i class="fas fa-fw fa-wrench"></i>
      <span>Item</span>
    </a>
    <div id="collapseUtilities1" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="view_item.php?item">View Item</a>
      </div>
    </div>
  </li>

  <?php
  if(isset($_GET["sales"])){
    ?>
    <li class="nav-item active">
    <?php
  }
  else{
    ?>
    <li class="nav-item">
    <?php
  }
  ?>
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
      <i class="fas fa-shopping-bag"></i>
      <span>Sales</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="add_sales.php?sales">Add Sales</a>
        <a class="collapse-item" href="view_sales.php?sales">View Sales</a>
      </div>
    </div>
  </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <?php
    if(isset($_GET["cust"])){
      ?>
      <li class="nav-item active">
      <?php
    }
    else{
      ?>
      <li class="nav-item">
      <?php
    }
    ?>
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages1" aria-expanded="true" aria-controls="collapsePages1">
        <i class="fa fa-users"></i>
        <span>Customers</span>
      </a>
      <div id="collapsePages1" class="collapse" aria-labelledby="headingPages1" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="add_customer.php?cust">Add Customers</a>
          <a class="collapse-item" href="view_customer.php?cust">View Customers</a>
        </div>
      </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <?php
  }
  else if($user_type == "production"){
    ?>
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
      <div class="sidebar-brand-icon rotate-n-15">
        <img class="img-profile rounded-circle" width="43px" src="img/C.png">
      </div>
      <div class="sidebar-brand-text mx-3">CSMS</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      MODULE
    </div>

  <!-- Nav Item - Utilities Collapse Menu -->
    <?php
    if(isset($_GET["item"])){
      ?>
      <li class="nav-item active">
      <?php
    }
    else{
      ?>
      <li class="nav-item">
      <?php
    }
    ?>
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities1" aria-expanded="true" aria-controls="collapseUtilities1">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Item</span>
      </a>
      <div id="collapseUtilities1" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="add_item.php?item">Add Item</a>
          <a class="collapse-item" href="view_item.php?item">View Item</a>
        </div>
      </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <?php
  }
  else{
    ?>
     <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php?dashboard">
      <div class="sidebar-brand-icon rotate-n-15">
        <img class="img-profile rounded-circle" width="43px" src="img/C.png">
      </div>
      <div class="sidebar-brand-text mx-3">CSMS</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <?php
    if(isset($_GET["dashboard"])){
      ?>
      <li class="nav-item active">
      <?php
    }
    else{
      ?>
      <li class="nav-item">
      <?php
    }
    ?>
      <a class="nav-link" href="index.php?dashboard">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      MODULE
    </div>

    

    <!-- Nav Item - Pages Collapse Menu -->
    <?php
    if(isset($_GET["department"])){
      ?>
      <li class="nav-item active">
      <?php
    }
    else{
      ?>
      <li class="nav-item">
      <?php
    }
    ?>
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="far fa-building"></i></i>
        <span>Department</span>
      </a>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="add_dept.php?department">Add Department</a>
          <a class="collapse-item" href="view_dept.php?department">View Department</a>
        </div>
      </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <?php
    if(isset($_GET["supp"])){
      ?>
      <li class="nav-item active">
      <?php
    }
    else{
      ?>
      <li class="nav-item">
      <?php
    }
    ?>
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-people-carry"></i></i>
        <span>Supplier</span>
      </a>
      <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="add_supp.php?supp">Add Supplier</a>
          <a class="collapse-item" href="view_supp.php?supp">View Supplier</a>
        </div>
      </div>
    </li>

  <!-- Nav Item - Utilities Collapse Menu -->
    <?php
    if(isset($_GET["item"])){
      ?>
      <li class="nav-item active">
      <?php
    }
    else{
      ?>
      <li class="nav-item">
      <?php
    }
    ?>
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities1" aria-expanded="true" aria-controls="collapseUtilities1">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Item</span>
      </a>
      <div id="collapseUtilities1" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="add_item.php?item">Add Item</a>
          <a class="collapse-item" href="view_item.php?item">View Item</a>
        </div>
      </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <?php
    if(isset($_GET["sales"])){
      ?>
      <li class="nav-item active">
      <?php
    }
    else{
      ?>
      <li class="nav-item">
      <?php
    }
    ?>
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-shopping-bag"></i>
        <span>Sales</span>
      </a>
      <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="add_sales.php?sales">Add Sales</a>
          <a class="collapse-item" href="view_sales.php?sales">View Sales</a>
        </div>
      </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <?php
    if(isset($_GET["cust"])){
      ?>
      <li class="nav-item active">
      <?php
    }
    else{
      ?>
      <li class="nav-item">
      <?php
    }
    ?>
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages1" aria-expanded="true" aria-controls="collapsePages1">
        <i class="fa fa-users"></i>
        <span>Customers</span>
      </a>
      <div id="collapsePages1" class="collapse" aria-labelledby="headingPages1" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="add_customer.php?cust">Add Customers</a>
          <a class="collapse-item" href="view_customer.php?cust">View Customers</a>
        </div>
      </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      OTHER
    </div>

    

    

    <!-- Nav Item - Charts -->
    <!-- <li class="nav-item">
      <a class="nav-link" href="stock.html">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Stock Level</span></a>
    </li> -->

    <!-- Nav Item - Tables -->

    <?php
    if(isset($_GET["user"])){
      ?>
      <li class="nav-item active">
      <?php
    }
    else{
      ?>
      <li class="nav-item">
      <?php
    }
    ?>
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#register" aria-expanded="true" aria-controls="register">
        <i class="fa fa-user-plus"></i>
        <span>Register User</span>
      </a>
      <div id="register" class="collapse" aria-labelledby="headingPages1" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="add_user.php?user">Add User</a>
          <a class="collapse-item" href="view_user.php?user">View User</a>
        </div>
      </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <?php
  }
  ?>
</ul>
<!-- End of Sidebar -->