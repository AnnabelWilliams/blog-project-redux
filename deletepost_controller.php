<?php require_once("Models/posts_model.php"); ?>
<?php

	$SearchQueryParameter = $_GET["id"];

	if(isset($_POST["Submit"])){
		if(true == deletePost()){
			unlink("Uploads/$ImageUpdate");
			$_SESSION["SuccessMessage"] = "Post deleted successfully.";
			Redirect_to("addposts_html.php");
		}else{
			$_SESSION["ErrorMessage"] = "Something went wrong.";
			Redirect_to("addposts_html.php");
		}
	}
	
	$fetchedPost = fetchPosts();

?>