<?php
include('connection.php');

if(isset($_GET["type"])){
	$type = $_GET["type"];
}
else{
	$type = "";
}

if($type == "item"){
	$itemid = $_GET["itemid"];

	$deleteitem = "DELETE FROM item WHERE item_id = '".$itemid."'";
	if($conn->query($deleteitem) == TRUE){
		$delsupp = "DELETE FROM supply_item WHERE item_id = '".$itemid."'";
		if($conn->query($delsupp) == TRUE){
			echo "<script>alert('Item Deleted.');</script>";
			echo "<meta http-equiv='refresh' content='0; url= view_item.php?item'/>";
		}
		else{
			echo "<script>alert('Supplier Failed to Deleted.');</script>";
			echo "<meta http-equiv='refresh' content='0; url= view_item.php?item'/>";
		}
	}
	else{
		echo "<script>alert('Delete Item Failed!');</script>";
		echo "<meta http-equiv='refresh' content='0; url= view_item.php?item'/>";
		echo "ERROR : " . $deleteitem . "<br>" . $conn->error;
	}
}

if($type == "supp"){
	$suppid = $_GET["suppid"];

	$deleteitem = "DELETE FROM supplier WHERE supp_id = '".$suppid."'";
	if($conn->query($deleteitem) == TRUE){		
		echo "<script>alert('Supplier Deleted.');</script>";
		echo "<meta http-equiv='refresh' content='0; url= view_supp.php?supp'/>";
	}
	else{
		echo "<script>alert('Delete Supplier Failed!');</script>";
		echo "<meta http-equiv='refresh' content='0; url= view_supp.php?supp'/>";
		echo "ERROR : " . $deleteitem . "<br>" . $conn->error;
	}
}

if($type == "cust"){
	$custid = $_GET["custid"];

	$deleteitem = "DELETE FROM customer WHERE cust_id = '".$custid."'";
	if($conn->query($deleteitem) == TRUE){		
		echo "<script>alert('Customer Deleted.');</script>";
		echo "<meta http-equiv='refresh' content='0; url= view_customer.php?cust'/>";
	}
	else{
		echo "<script>alert('Delete Customer Failed!');</script>";
		echo "<meta http-equiv='refresh' content='0; url= view_customer.php?cust'/>";
		echo "ERROR : " . $deleteitem . "<br>" . $conn->error;
	}
}

if($type == "user"){
	$userid = $_GET["userid"];

	$deleteitem = "DELETE FROM user WHERE user_id = '".$userid."'";
	if($conn->query($deleteitem) == TRUE){		
		echo "<script>alert('User Deleted.');</script>";
		echo "<meta http-equiv='refresh' content='0; url= view_user.php?user'/>";
	}
	else{
		echo "<script>alert('Delete User Failed!');</script>";
		echo "<meta http-equiv='refresh' content='0; url= view_user.php?user'/>";
		echo "ERROR : " . $deleteitem . "<br>" . $conn->error;
	}
}
?>