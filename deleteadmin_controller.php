<?php require_once("Models/admins_model.php"); ?>
<?php Confirm_Login(); ?>
<?php

	$SearchQueryParameter = $_GET["id"];

	if(isset($SearchQueryParameter)){
		if(deleteAdmin()){
			$_SESSION["SuccessMessage"] = "Admin has been deleted.";
			Redirect_to("admins_html.php?page=1");
		}else{
			$_SESSION["ErrorMessage"] = "Something went wrong.";
			Redirect_to("admins_html.php?page=1");
		}
	}

?>