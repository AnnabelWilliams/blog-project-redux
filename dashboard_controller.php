<?php require_once("Models/posts_model.php"); ?>
<?php require_once("Models/comments_model.php"); ?>
<?php
	
	$postCount = TotalRows("posts");
	$categoryCount = TotalRows("category");
	$adminCount = TotalRows("admins");
	$commentCount = TotalRows("comments");
	
	$fetchedPosts = fetchPosts();
	
	$OnComments = array();
	$OffComments = array();
	
	for($i=0; $i < count($fetchedPosts); $i++){
		array_push($OnComments,TotalComments($fetchedPosts[$i][1],"ON"));
		array_push($OffComments,TotalComments($fetchedPosts[$i][1],"OFF"));
	}

?>