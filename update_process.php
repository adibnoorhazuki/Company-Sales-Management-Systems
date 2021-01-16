<?php
include("connection.php");

if(isset($_GET["type"])){
	$type = $_GET["type"];
}
else{
	$type = "";
}

//Start Update Department
if($type == "dept"){
	$id = $_POST["deptid"];
	$deptname = $_POST["dept_name"];
	$deptdesc = $_POST["dept_desc"];

	$update = "UPDATE department SET dept_name = '".$deptname."', dept_desc = '".$deptdesc."' WHERE dept_id = '".$id."'";
	if($conn->query($update) == TRUE){
		echo "<script>alert('Department updated!');</script>";
		echo "<meta http-equiv='refresh' content='0; url= view_dept.php?department'/>";
	}
	else{
		echo "<script>alert('Update Failed!');</script>";
		echo "<meta http-equiv='refresh' content='0; url= add_dept.php?department&type=update&deptid='".$id."''/>";
	}
}
//End Update Department

//Start Update Supplier
if($type == "supp"){
	$supp_name = $_POST["supp_name"];
	$supp_add = $_POST["supp_add"];
	$supp_phone = $_POST["supp_phone"];
	$supp_email = $_POST["supp_email"];
	$supp_fax = $_POST["supp_fax"];
	$id = $_GET["suppid"];


	$update = "UPDATE supplier SET supp_name = '".$supp_name."', supp_address = '".$supp_add."', supp_no = '".$supp_phone."', supp_email = '".$supp_email."', fax_no = '".$supp_fax."' WHERE supp_id = '".$id."'";
	if($conn->query($update) == TRUE){
		echo "<script>alert('Supplier Updated!');</script>";
		echo "<meta http-equiv='refresh' content='0; url= view_supp.php?supp'/>";
	}
	else{
		
		echo "<script>alert('Failed to update Supplier.');</script>";
		echo "<meta http-equiv='refresh' content='0; url= add_supp.php?supp&type=update&suppid='".$id."''/>";
	}
}
//End Update Supplier

//Start Update Item
if($type == "item"){
	
	$image_name = "";
	$video_name = "";
	$id = $_POST["id"];

	$sql = "SELECT * FROM item WHERE item_id = '".$id."'";
		$rslt = $conn->query($sql);
		if($rslt->num_rows>0){
			while($row = $rslt->fetch_assoc()){
				$img = $row["image_name"];
				$vid = $row["video_name"];
			}
		}

	function upload($image_name, $video_name){
		include("connection.php");
		
		$id = $_POST["id"];
		$item_name = $_POST["item_name"];
		$item_desc = $_POST["item_desc"];
		$item_price = $_POST["item_price"];
		$item_quantity = $_POST["item_quantity"];
		if(isset($_POST["new_item_quantity"])){
			$new_item_quantity = $_POST["new_item_quantity"];
		}
		else{
			$new_item_quantity = "";
		}

		$item_measure = $_POST["item_measure"];
		$item_dept = $_POST["item_dept"];
		$item_supp = $_POST["item_supp"];

		$sql = "SELECT * FROM item WHERE item_id = '".$id."'";
		$rslt = $conn->query($sql);
		if($rslt->num_rows>0){
			while($row = $rslt->fetch_assoc()){
				$bal = $row["balance"];
				$qty = $row["total_in"];
			}
		}

		if($item_quantity < $qty){
			$newquan = $qty - $item_quantity;
			$bal = $bal - $newquan;
		}
		else if($item_quantity > $qty){
			$newquan = $item_quantity - $qty;
			$bal = $bal + $newquan;
		}

		if($new_item_quantity != ""){
			$item_quantity = $new_item_quantity;
			$bal = $bal + $new_item_quantity;
		}

		$update = "UPDATE item SET item_name = '".$item_name."', item_desc = '".$item_desc."', total_in = '".$item_quantity."', balance = '".$bal."', unit_price = '".$item_price."', unit_measure = '".$item_measure."', department = '".$item_dept."', image_name = '".$image_name."', video_name = '".$video_name."' WHERE item_id = '".$id."'";
		if($conn->query($update) == TRUE){
			$upsupp = "UPDATE supply_item SET supp_id = '".$item_supp."' WHERE item_id = '".$id."'";
			if($conn->query($upsupp) == TRUE){
				echo "<script>alert('Item Updated!');</script>";
				echo "<meta http-equiv='refresh' content='0; url= view_item.php?item'/>";
			}
			else{
				echo "<script>alert('Add Bridge failed.');</script>";
				echo "<meta http-equiv='refresh' content='0; url= add_item.php?item&type=update&itemid='".$id."''/>";
			}
		}
		else{
			echo "ERROR : " . $update . "<br>" . $conn->error;
		}
	}

	function checkvid($image_name, $Bvid){
		if(isset($_FILES["video_name"]["name"])){
			$video_name = $_FILES["video_name"]["name"];
			$size = $_FILES["video_name"]["size"];
			$targetDir = "video/";
			$temp = explode(".", $_FILES["video_name"]["name"]);
			$targetFilePath = $targetDir . $video_name;
			$filesize = ($size)/(1024*1024);

			if($filesize > "10"){
				echo "<script>alert('Video is more than 10 MB');</script>";
				echo "<meta http-equiv='refresh' content='0; url= add_item.php?item'/>";
			}
			else{
				if(!empty($_FILES["video_name"]["name"])){
					// Upload file to server
					if(move_uploaded_file($_FILES["video_name"]["tmp_name"], $targetFilePath)){
						upload($image_name, $video_name);
					}
				}
				else{
					$video_name = $Bvid;
					upload($image_name, $video_name);
				}
			}
		}
	}

	if(isset($_FILES["image_name"]["name"])){
		$image_name = $_FILES["image_name"]["name"];
		$targetDir = "image/";
		$temp = explode(".", $_FILES["image_name"]["name"]);
		$targetFilePath = $targetDir . $image_name;

		if(!empty($_FILES["image_name"]["name"])){
			// Upload file to server
			if(move_uploaded_file($_FILES["image_name"]["tmp_name"], $targetFilePath)){
				$Bvid = $vid;
				checkvid($image_name, $Bvid);
			}
		}
		else{
			$image_name = $img;
			$Bvid = $vid;
			checkvid($image_name, $Bvid);
		}
	}
}
//End Update Item

//Start Update Sales
if($type == "sale"){
	$id = $_POST["sales_id"];
	$sales_date = $_POST["sales_date"];
	$cust_id = $_POST["cust_id"];
	$item_id = $_POST["item_id"];
	$sales_qty = $_POST["sales_qty"];
	$sales_total_amount = $_POST["sales_total_amount"];
	$sales_desc = $_POST["sales_desc"];
	$sales_delivery_date = $_POST["sales_delivery_date"];

	$sql = "SELECT * FROM item WHERE item_id = '".$item_id."'";
	$rslt = $conn->query($sql);
	if($rslt->num_rows>0){
		while($row = $rslt->fetch_assoc()){
			$bal = $row["balance"];
		}
	}

	$sql = "SELECT * FROM sales WHERE sales_id = '".$id."'";
	$rslt = $conn->query($sql);
	if($rslt->num_rows>0){
		while($row = $rslt->fetch_assoc()){
			$sqty = $row["sales_qty"];
		}
	}

	if($sales_qty < $sqty){
		$newqty = $sqty - $sales_qty;
		$bal = $bal + $newqty;
	}
	else if($sales_qty > $sqty){
		$newqty = $sales_qty - $sqty;
		$bal = $bal - $newqty;
	}

	$update = "UPDATE sales SET sales_date = '".$sales_date."', cust_id = '".$cust_id."', item_id = '".$item_id."', sales_qty = '".$sales_qty."', sales_total_amount = '".$sales_total_amount."', sales_desc = '".$sales_desc."', sales_delivery_date = '".$sales_delivery_date."' WHERE sales_id = '".$id."'";
	if($conn->query($update) == TRUE){
		
		$check = "SELECT SUM(sales_qty) AS total FROM sales WHERE item_id = '".$item_id."'";
		$rslt = $conn->query($check);
		if($rslt->num_rows>0){
			while($row = $rslt->fetch_assoc()){
				$total = $row["total"];
			}
		}

		$item = "UPDATE item SET balance = '".$bal."', total_out = '".$total."' WHERE item_id = '".$item_id."'";
		if($conn->query($item) == TRUE){
			echo "<script>alert('Sales Updated!');</script>";
			echo "<meta http-equiv='refresh' content='0; url= view_sales.php?sales'/>";
		}
	}
	else{
		echo "<script>alert('Failed to update Sales.');</script>";
		echo "<meta http-equiv='refresh' content='0; url= add_sales.php?sales&type=update&custid='".$id."''/>";
	}
}
//End Update Sales

//Start Update Customer
if($type == "cust"){
	$id = $_POST["custid"];
	$cust_name = $_POST["cust_name"];
	$cust_address = $_POST["cust_add"];
	$cust_phone = $_POST["cust_phone"];
	$cust_email = $_POST["cust_email"];	


	$update = "UPDATE customer SET cust_name = '".$cust_name."', cust_address = '".$cust_address."', cust_phone = '".$cust_phone."', cust_email = '".$cust_email."' WHERE cust_id = '".$id."'";
	if($conn->query($update) == TRUE){
		echo "<script>alert('Customer Updated!');</script>";
		echo "<meta http-equiv='refresh' content='0; url= view_customer.php?cust'/>";
	}
	else{
		
		echo "<script>alert('Failed to update Customer.');</script>";
		echo "<meta http-equiv='refresh' content='0; url= add_customer.php?cust&type=update&custid='".$id."''/>";
	}
}
//End Update Customer

//Start Update User
if($type == "user"){
	$id = $_POST["user_id"];
	$name = $_POST["user_name"];
  	$user_ic = $_POST["user_ic"];
  	$user_email = $_POST["user_email"];
	$user_phone = $_POST["user_phone"];
  	$user_type = $_POST["user_type"];
  	$password = $_POST["password"];
  	$confirm_password = $_POST["confirm_password"];


	$update = "UPDATE user SET user_name = '".$name."', user_ic = '".$user_ic."', user_email = '".$user_email."', user_phone = '".$user_phone."', user_type = '".$user_type."', password = '".$password."', confirm_password = '".$confirm_password."' WHERE user_id = '".$id."'";
	if($conn->query($update) == TRUE){
		echo "<script>alert('User Updated!');</script>";
		echo "<meta http-equiv='refresh' content='0; url= view_user.php?user'/>";
	}
	else{
		echo "<script>alert('Failed to update User.');</script>";
		echo "<meta http-equiv='refresh' content='0; url= add_user.php?user&type=update&userid='".$id."''/>";
	}
}
//End Update User

//Start Update Profile
if($type == "profile"){
	$id = $_POST["user_id"];
	$name = $_POST["user_name"];
  	$user_ic = $_POST["user_ic"];
  	$user_email = $_POST["user_email"];
	$user_phone = $_POST["user_phone"];
  	$user_type = $_POST["user_type"];
  	$password = $_POST["password"];
  	$confirm_password = $_POST["confirm_password"];


	$update = "UPDATE user SET user_name = '".$name."', user_ic = '".$user_ic."', user_email = '".$user_email."', user_phone = '".$user_phone."', user_type = '".$user_type."', password = '".$password."', confirm_password = '".$confirm_password."' WHERE user_id = '".$id."'";
	if($conn->query($update) == TRUE){
		echo "<script>alert('Profile Updated!');</script>";
		echo "<meta http-equiv='refresh' content='0; url= profile.php'/>";
	}
	else{
		echo "<script>alert('Failed to update Profile.');</script>";
		echo "<meta http-equiv='refresh' content='0; url= profile.php'/>";
	}
}
//End Update Profile
?>