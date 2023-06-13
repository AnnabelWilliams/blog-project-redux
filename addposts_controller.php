<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php
	
	function validateNewPost() {
		global $PostTitle;
		global $PostContent;
		if(empty($PostTitle)){
			$_SESSION["ErrorMessage"] = "Post title must be filled in.";
			Redirect_to("AddNewPost.php");
			return FALSE;
		}elseif(strlen($PostTitle)<5){
			$_SESSION["ErrorMessage"] = "Post title should be greater than 5 characters.";
			Redirect_to("AddNewPost.php");
			return FALSE;
		}elseif(strlen($PostTitle)>49){
			$_SESSION["ErrorMessage"] = "Post title should be less than 50 characters.";
			Redirect_to("AddNewPost.php");
			return FALSE;
		}elseif(strlen($PostContent)>9999){
			$_SESSION["ErrorMessage"] = "Post content should be less than 10000 characters.";
			Redirect_to("AddNewPost.php");
			return FALSE;
		}elseif(!preg_match("/^[A-Za-z0-9. _,.?!]+$/",$PostTitle)){
			$_SESSION["ErrorMessage"] = "Post title contains invalid characters.";
			Redirect_to("AddNewPost.php");
			return FALSE;
		}else{
			return TRUE;
		}
	}

?>