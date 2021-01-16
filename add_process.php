<?php
include("connection.php");

if(isset($_GET["type"])){
	$type = $_GET["type"];
}
else{
	$type = "";
}

//Start Add Department
if($type == "dept"){
	if(isset($_GET["stat"])){
		$stat = $_GET["stat"];
	}
	else{
		$stat = "";
	}
	$deptname = $_POST["dept_name"];
	$deptdesc = $_POST["dept_desc"];

	$sqlcheck = "SELECT * FROM department WHERE dept_name = '".$deptname."'";
	$rsltcheck = $conn->query($sqlcheck);
	if($rsltcheck->num_rows>0){
		if($stat == "pro"){
			echo "<script>alert('Department already exist!');</script>";
			echo "<meta http-equiv='refresh' content='0; url= add_item.php?item'/>";
		}
		else{
			echo "<script>alert('Department already exist!');</script>";
			echo "<meta http-equiv='refresh' content='0; url= add_dept.php?department'/>";
		}
	}
	else{
		$insertdept = "INSERT INTO department (dept_name, dept_desc) VALUES ('".$deptname."', '".$deptdesc."')";
		if($conn->query($insertdept) == TRUE){
			if($stat == "pro"){
				echo "<script>alert('Department Added!');</script>";
				echo "<meta http-equiv='refresh' content='0; url= add_item.php?item'/>";
			}
			else{
				echo "<script>alert('Department Added!');</script>";
				echo "<meta http-equiv='refresh' content='0; url= view_dept.php?department'/>";
			}
		}
	}
}
//End Add Department

//Start Add Supplier
if($type == "supp"){
	if(isset($_GET["stat"])){
		$stat = $_GET["stat"];
	}
	else{
		$stat = "";
	}
	$supp_name = $_POST["supp_name"];
	$supp_add = $_POST["supp_add"];
	$supp_phone = $_POST["supp_phone"];
	$supp_email = $_POST["supp_email"];
	$supp_fax = $_POST["supp_fax"];


	$sqlcheck = "SELECT * FROM supplier WHERE supp_name = '".$supp_name."'";
	$rsltcheck = $conn->query($sqlcheck);
	if($rsltcheck->num_rows>0){
		if($stat == "pro"){
			echo "<script>alert('Supplier already exist!');</script>";
			echo "<meta http-equiv='refresh' content='0; url= add_item.php?item'/>";
		}
		else{
			echo "<script>alert('Supplier already exist!');</script>";
			echo "<meta http-equiv='refresh' content='0; url= add_supp.php?supp'/>";
		}
	}
	else{
		$insertdept = "INSERT INTO supplier (supp_name, supp_address, supp_no, supp_email, fax_no) VALUES ('".$supp_name."', '".$supp_add."', '".$supp_phone."', '".$supp_email."', '".$supp_fax."')";
		if($conn->query($insertdept) == TRUE){
			if($stat == "pro"){
				echo "<script>alert('Supplier Added!');</script>";
				echo "<meta http-equiv='refresh' content='0; url= add_item.php?item'/>";
			}
			else{
				echo "<script>alert('Supplier Added!');</script>";
				echo "<meta http-equiv='refresh' content='0; url= view_supp.php?supp'/>";
			}
		}
	}
}
//End Add Supplier

//Start Add Item
if($type == "item"){
	$item_name = $_POST["item_name"];
	$item_desc = $_POST["item_desc"];
	$item_price = $_POST["item_price"];
	$item_quantity = $_POST["item_quantity"];
	$item_measure = $_POST["item_measure"];
	$item_dept = $_POST["item_dept"];
	$item_supp = $_POST["item_supp"];
	if(isset($_FILES["image_name"]["name"])){
		$image_name = $_FILES["image_name"]["name"];
		echo $image_name;
	}
	else{
		$image_name = "";
	}
	
	$targetDir = "image/";
	$temp = explode(".", $_FILES["image_name"]["name"]);
	$targetFilePath = $targetDir . $image_name;

	if(!empty($_FILES["image_name"]["name"])){
		// Upload file to server
		if(move_uploaded_file($_FILES["image_name"]["tmp_name"], $targetFilePath)){
			$item = "INSERT INTO item (item_name, item_desc, total_in, balance, unit_measure, unit_price, department, image_name, date_in) VALUES ('".$item_name."', '".$item_desc."', '".$item_quantity."', '".$item_quantity."', '".$item_measure."', '".$item_price."', '".$item_dept."', '".$image_name."', NOW())";
			if($conn->query($item) == TRUE){
				$checkiteem = "SELECT MAX(item_id) AS id FROM item";
				$rsltcheckitem = $conn->query($checkiteem);
				if($rsltcheckitem->num_rows>0){
					while($rowcheckitem = $rsltcheckitem->fetch_assoc()){
						$itemid = $rowcheckitem["id"];
					}
				}
				$insertsupp = "INSERT INTO supply_item (supp_id, item_id) VALUES ('".$item_supp."', '".$itemid."')";
				if($conn->query($insertsupp) == TRUE){
					echo "<script>alert('Item Added!');</script>";
					echo "<meta http-equiv='refresh' content='0; url= view_item.php?item'/>";
				}
				else{
					echo "<script>alert('Add Bridge failed.');</script>";
					echo "<meta http-equiv='refresh' content='0; url= add_item.php?item'/>";
				}
			}
			else{
				echo "<script>alert('Add Item failed.');</script>";
				echo "<meta http-equiv='refresh' content='0; url= add_item.php?item'/>";
			}
		}
	}
	else{
		$item = "INSERT INTO item (item_name, item_desc, total_in, balance, unit_measure, unit_price, department, image_name, date_in) VALUES ('".$item_name."', '".$item_desc."', '".$item_quantity."', '".$item_quantity."', '".$item_measure."', '".$item_price."', '".$item_dept."', '".$image_name."', NOW())";
		if($conn->query($item) == TRUE){
			$checkiteem = "SELECT MAX(item_id) AS id FROM item";
			$rsltcheckitem = $conn->query($checkiteem);
			if($rsltcheckitem->num_rows>0){
				while($rowcheckitem = $rsltcheckitem->fetch_assoc()){
					$itemid = $rowcheckitem["id"];
				}
			}
			$insertsupp = "INSERT INTO supply_item (supp_id, item_id) VALUES ('".$item_supp."', '".$itemid."')";
			if($conn->query($insertsupp) == TRUE){
				echo "<script>alert('Item Added!');</script>";
				echo "<meta http-equiv='refresh' content='0; url= view_item.php?item'/>";
			}
			else{
				echo "<script>alert('Add Bridge failed.');</script>";
				echo "<meta http-equiv='refresh' content='0; url= add_item.php?item'/>";
			}
		}
		else{
			echo "<script>alert('Add Item failed.');</script>";
			echo "<meta http-equiv='refresh' content='0; url= add_item.php?item'/>";
		}
	}
}
//End Add Item

// Start Add Sales
if($type == "sale"){
	$sales_date = $_POST["sales_date"];
	$cust_id = $_POST["cust_id"];
	$item_id = $_POST["item_id"];
	$sales_qty = $_POST["sales_qty"];
	$sales_total_amount = $_POST["sales_total_amount1"];
	$sales_desc = $_POST["sales_desc"];
	$sales_delivery_date = $_POST["sales_delivery_date"];
	$user_id = $_POST["user_id"];

	$sql = "SELECT * FROM item WHERE item_id = '".$item_id."'";
	$rslt = $conn->query($sql);
	if($rslt->num_rows>0){
		while($row = $rslt->fetch_assoc()){
			$itemqty = $row["balance"];
			$itemout = $row["total_out"];
		}
	}

	if($sales_qty > $itemqty){
		//trigger if not enough item
		$trigger = "CREATE OR REPLACE TRIGGER before_update_item BEFORE UPDATE ON item FOR EACH ROW SET NEW.item_id=UPPER(NEW.item_id);";
		
		if($conn->query($trigger) == TRUE){
			echo "<script>alert('Not Enough Item!');</script>";
			echo "<meta http-equiv='refresh' content='0; url= view_sales.php?sales'/>";
		}
		else{
			echo "ERROR : " . $trigger . "<br>" . $conn->error;
		}
		
	}
	else{
		$insertsales = "INSERT INTO sales (sales_date, sales_total_amount, sales_qty, sales_desc, sales_delivery_date, user_id, item_id, cust_id) VALUES ('".$sales_date."', '".$sales_total_amount."', '".$sales_qty."', '".$sales_desc."', '".$sales_delivery_date."', '".$user_id."', '".$item_id."', '".$cust_id."')";
		if($conn->query($insertsales) == TRUE){
			$out = $itemout + $sales_qty;
			$newbal = $itemqty - $sales_qty;
			$updateitem = "UPDATE item SET total_out = '".$out."', balance = '".$newbal."' WHERE item_id = '".$item_id."'";
			if($conn->query($updateitem) == TRUE){
				echo "<script>alert('Sales Added!');</script>";
				echo "<meta http-equiv='refresh' content='0; url= view_sales.php?sales'/>";
			}
			else{
				echo "<script>alert('Something Wrong');</script>";
				echo "<meta http-equiv='refresh' content='0; url= view_sales.php?sales'/>";
			}
		}
		else{
			echo "<script>alert('Add Sales failed.');</script>";
			echo "<meta http-equiv='refresh' content='0; url= add_sales.php?sales'/>";
		}
	}
}
// End Add Sales

// Start Add Customer
if($type == "cust"){
	if(isset($_GET["stat"])){
		$stat = $_GET["stat"];
	}
	else{
		$stat = "";
	}
	$cust_name = $_POST["cust_name"];
	$cust_add = $_POST["cust_add"];
	$cust_phone = $_POST["cust_phone"];
	$cust_email = $_POST["cust_email"];


	$sqlcheck = "SELECT * FROM customer WHERE cust_email = '".$cust_email."'";
	$rsltcheck = $conn->query($sqlcheck);
	if($rsltcheck->num_rows>0){
		if($stat == "pro"){
			echo "<script>alert('Email already exist!');</script>";
			echo "<meta http-equiv='refresh' content='0; url= add_sales.php?sales'/>";
		}
		else{
			echo "<script>alert('Email already exist!');</script>";
			echo "<meta http-equiv='refresh' content='0; url= add_customer.php?cust'/>";
		}
	}
	else{
		$insertcust = "INSERT INTO customer (cust_name, cust_address, cust_phone, cust_email) VALUES ('".$cust_name."', '".$cust_add."', '".$cust_phone."', '".$cust_email."')";
		if($conn->query($insertcust) == TRUE){
			if($stat == "pro"){
				echo "<script>alert('Customer Added!');</script>";
				echo "<meta http-equiv='refresh' content='0; url= add_sales.php?sales'/>";
			}
			else{
				echo "<script>alert('Customer Added!');</script>";
				echo "<meta http-equiv='refresh' content='0; url= view_customer.php?cust'/>";
			}
		}
		else{
			if($stat == "pro"){
				echo "<script>alert('Add Customer failed.');</script>";
				echo "<meta http-equiv='refresh' content='0; url= add_sales.php?sales'/>";
			}
			else{
				echo "<script>alert('Add Customer failed.');</script>";
				echo "<meta http-equiv='refresh' content='0; url= add_customer.php?cust'/>";
			}
		}
	}
}
// End Add Customer

// Start Add User
if($type == "user"){
	$name = $_POST["user_name"];
  	$user_ic = $_POST["user_ic"];
  	$user_email = $_POST["user_email"];
	$user_phone = $_POST["user_phone"];
  	$user_type = $_POST["user_type"];
  	$password = $_POST["password"];
  	$confirm_password = $_POST["confirm_password"];


	$sqlcheck = "SELECT * FROM user WHERE user_email = '".$user_email."'";
	$rsltcheck = $conn->query($sqlcheck);
	if($rsltcheck->num_rows>0){
		echo "<script>alert('Email already exist!');</script>";
		echo "<meta http-equiv='refresh' content='0; url= add_user.php?user'/>";
	}
	else{
		$insertuser = "INSERT INTO user (user_name, user_ic, user_email, user_phone, user_type, password, confirm_password) VALUES ('".$name."', '".$user_ic."', '".$user_email."', '".$user_phone."', '".$user_type."', '".$password."', '".$confirm_password."')";
		if($conn->query($insertuser) == TRUE){
			echo "<script>alert('User Added!');</script>";
			echo "<meta http-equiv='refresh' content='0; url= view_user.php?user'/>";
		}
		else{
			echo "<script>alert('Add User failed.');</script>";
			echo "<meta http-equiv='refresh' content='0; url= add_user.php?user'/>";
		}
	}
}
// End Add User

?>