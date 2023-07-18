<?php

if(isset($_SESSION["Username"])){
	Redirect_to("dashboard_html.php");
}

if(isset($_POST["Submit"])){
	$Username = $_POST["Username"];
	$Password = $_POST["Password"];
	if(empty($Username)||empty($Password)){
		$_SESSION["ErrorMessage"] = "All fields must be filled in.";
		Redirect_to("login_html.php");
	}else{
		$Found_Account = Login_Attempt($Username, $Password);
		if($Found_Account){
			$_SESSION["User_ID"] = $Found_Account["id"];
			$_SESSION["Username"] = $Found_Account["username"];
			$_SESSION["AdminName"] = $Found_Account["aname"];
			$_SESSION["Role"] = $Found_Account["role"];
			$_SESSION["SuccessMessage"] = "Welcome back, ".$_SESSION["AdminName"];
			if(isset($_SESSION["TrackingURL"])){
				Redirect_to($_SESSION["TrackingURL"]);
			}else{
				Redirect_to("dashboard_html.php");
			}
		}else{
			$_SESSION["ErrorMessage"] = "Username or password does not exist.";
			Redirect_to("login_html.php");
		}
	}
}

?>