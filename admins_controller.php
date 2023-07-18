<?php require_once("Models/admins_model.php"); ?>
<?php

	$fetchedAdmin = fetchAdmin();
	
	if(isset($_POST["Submit"])){
		date_default_timezone_set("Europe/London");
		$CurrentTime=time();
		$DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
		if(true == validateNewAdmin($_POST["Username"],$_POST["Password"],$_POST["ConfirmPassword"])){
			if(true == createNewAdmin($_POST["Username"],$_POST["Password"],$_POST["Name"],$_SESSION["Username"],$DateTime)){
				$_SESSION["SuccessMessage"] = "Admin with username: $Username added successfully.";
				Redirect_to("admins_html.php");
			}else{
				$_SESSION["ErrorMessage"] = "Something went wrong.";
				Redirect_to("admins_html.php");
			}
		}
	}
	
	//Pagination
	$ConnectingDB;
	$sql = "SELECT COUNT(*) FROM admins";
	$stmt=$ConnectingDB->query($sql);
	$RowPagination = $stmt->fetch();
	$TotalPosts = array_shift($RowPagination);
	$PostPagination = ceil($TotalPosts/5);

?>