<?php
session_start();
if(!isset($_SESSION["LoggedIn"]) || $_SESSION["LoggedIn"] !== true)

include "connection.php";

 
    
if($_POST['register'])
{
    $name =$_POST['user_name']; 
    $nric =$_POST['user_ic'];
    $email =$_POST['user_email'];
    $phone =$_POST['user_phone'];
	$password =$_POST['password'];
	$confirmPassword =$_POST['confirm_password'];

    if($password==$confirmPassword)
	{
		$sql = "select * from user where user_email='$email'";
		$res_e =  mysqli_query($conn,$sql);
		
		if(mysqli_num_rows($res_e)>0)
		{
			 echo "<script>alert('This email already have an account!');</script>";
			 echo "<meta http-equiv='refresh' content='0; url=register.php'/>";
		}
		else
		{
			$sql1="INSERT INTO user( user_name, user_ic, user_email, user_phone, password, confirm_password)
				VALUES ('$name','$nric','$email','$phone','$password','$confirmPassword')";

				if(mysqli_query($conn,$sql1))
				{
					echo "<script>alert('Register Success!');</script>";
					echo "<meta http-equiv='refresh' content='0; url=login.php'/>";

				}
				else
				{
					echo "<script>alert('Register Fail!);</script>";
					echo "<meta http-equiv='refresh' content='0; url=register.php'/>";
				}
		}
	}
	else
	{
		echo "<script>alert('Password not match');</script>";
		echo "<meta http-equiv='refresh' content='0; url=register.php'/>";
	}
}
else
			{
				echo "<script>alert('Register Fail!');</script>";
			}
?>
