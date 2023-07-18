<?php require_once("Models/categories_model.php"); ?>
<?php require_once("Models/posts_model.php"); ?>
<?php

	$SearchQueryParameter = $_GET["id"];

	if(isset($_POST["Submit"])){
		if(true == validateNewPost($_POST["PostTitle"],$_POST["Post"])){
			if(true == updatePost($_POST["PostTitle"],$_POST["Post"],$_POST["CategoryTitle"],$_FILES["image"]["name"])){
				$_SESSION["SuccessMessage"] = "Post updated successfully.";
				Redirect_to("blogposts_html.php?page=1");
			}else{
				$_SESSION["ErrorMessage"] = "Something went wrong.";
				Redirect_to("blogposts_html.php?page=1");
			}
		}
	}
	
	$fetchedPost = fetchPosts();
	$categoryOptions = fetchCategories();

?>