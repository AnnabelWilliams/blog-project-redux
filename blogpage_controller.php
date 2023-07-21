<?php require_once("Models/posts_model.php"); ?>
<?php require_once("Models/categories_model.php"); ?>
<?php require_once("Models/comments_model.php"); ?>
<?php

	$fetchedPosts = fetchPosts();
	
	$fetchedCategories = fetchCategories();
	
	$OnComments = array();
	for($i=0; $i < count($fetchedPosts); $i++){
		array_push($OnComments,TotalComments($fetchedPosts[$i][1],"ON"));
	}
	
	// Pagination
	$PostPagination = pagination();

?>