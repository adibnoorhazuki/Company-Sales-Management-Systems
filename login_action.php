<?php
session_start();
include ("connection.php");

if (isset($_POST['user_email'])) {

	$email = $_POST['user_email'];
	$password = $_POST['password'];
	//$name =$_POST['name'];

	$sql = "SELECT * FROM user WHERE user_email='$email' and password='$password'";
	$execute = $conn->query($sql);
	if($execute->num_rows>0){
		while($row = $execute->fetch_assoc()){
			//set the session
			$_SESSION['LoggedIn'] = true;
			$_SESSION['userid'] = $row["user_id"];
			$_SESSION['name'] = $row["user_name"];
			$_SESSION['email'] = $row["user_email"];
			$_SESSION['password'] = $row["password"];
			$type = $row["user_type"];

			echo "<script>alert('Login Success!');</script>";
			if($type == "staff"){
				echo "<meta http-equiv='refresh' content='0; url= view_dept.php?department'/>";
			}
			else if($type == "accountant"){
				echo "<meta http-equiv='refresh' content='0; url= view_item.php?item'/>";
			}
			else if($type == "production"){
				echo "<meta http-equiv='refresh' content='0; url= view_item.php?item'/>";
			}
			else{
				echo "<meta http-equiv='refresh' content='0; url= index.php?dashboard'/>";
			}			
		}
	}
	else{
		echo "<script>alert('Login fail!');</script>";
		echo "<meta http-equiv='refresh' content='0; url= login.php'/>";
		echo "error:" .$sql. "<br>". $conn->error;
	}
}
	
mysqli_close($conn);

?>


