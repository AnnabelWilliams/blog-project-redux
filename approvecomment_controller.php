<?php require_once("Models/comments_model.php"); ?>
<?php Confirm_Login(); ?>
<?php
	
	$SearchQueryParameter = $_GET["id"];

	if(isset($SearchQueryParameter)){
		if(true == approveComment()){
			$_SESSION["SuccessMessage"] = "Comment has been approved.";
			Redirect_to("comments_html.php?upage=1&apage=1");
		}else{
			$_SESSION["ErrorMessage"] = "Something went wrong.";
			Redirect_to("comments_html.php?upage=1&apage=1");
		}
	}

?>