<?php require_once("Models/admins_model.php"); ?>
<?php

$currentAdmin = fetchCurrentAdmin();

if(isset($_POST["Submit"])){
	date_default_timezone_set("Europe/London");
	$CurrentTime=time();
	$DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
	//Determine bitmask value of $ARole
	$ARole=0;
	if(isset($_POST["Deleter"])){
		$ARole += PostDeleter;
	}
	if(isset($_POST["Creator"])){
		$ARole += PostCreator;
	}
	if(isset($_POST["Editor"])){
		$ARole += PostEditor;
	}
	
	if(true == validateAdmin($_POST["Name"],$_POST["Bio"],$_POST["Headline"])) {
		if(true == updateAdmin($_POST["Name"],$_POST["Bio"],$_POST["Headline"],$_FILES["image"]["name"],$ARole,$DateTime,$AdminId)){
			$_SESSION["SuccessMessage"] = "Details updated successfully.";
			$_SESSION["AdminName"] = $AName;
			$_SESSION["Role"] = $ARole;
			Redirect_to("myprofile_html.php");
		}else{
			$_SESSION["ErrorMessage"] = "Something went wrong.";
			Redirect_to("myprofile_html.php");
		}
	}
}

?>