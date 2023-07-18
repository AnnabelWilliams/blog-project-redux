<?php require_once("Models/posts_model.php"); ?>
<?php require_once("Models/categories_model.php"); ?>
<?php require_once("Models/comments_model.php"); ?>
<?php

	$SearchQueryParameter = $_GET['id'];
	
	$fetchedPosts = fetchPosts();
	$fetchedCategories = fetchCategories();
	$fetchedComments = fetchApprovedComments();
	
	if(isset($_POST["Submit"])){
		date_default_timezone_set("Europe/London");
		$CurrentTime=time();
		$DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
		if(true == validateNewComment($_POST["CommenterName"],$_POST["CommenterEmail"],$_POST["CommentText"])){
			if(true == createNewComment($_POST["CommenterName"],$_POST["CommenterEmail"],$_POST["CommentText"],$DateTime)){
				$_SESSION["SuccessMessage"] = "Comment added successfully.";
				Redirect_to("fullpost_html.php?id={$SearchQueryParameter}");
			}else{
				$_SESSION["ErrorMessage"] = "Something went wrong.";
				Redirect_to("fullpost_html.php?id={$SearchQueryParameter}");
			}
		}
	}

?>