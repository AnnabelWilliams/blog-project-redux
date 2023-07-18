<?php require_once("Models/posts_model.php"); ?>
<?php require_once("Models/comments_model.php"); ?>
<?php
	
	$fetchedPosts = fetchPosts();
	
	$OnComments = array();
	$OffComments = array();
	
	for($i=0; $i < count($fetchedPosts); $i++){
		if(strlen($fetchedPosts[$i][2])>11){	//Date and Time
			$fetchedPosts[$i][2]=substr($fetchedPosts[$i][2],0,11)."...";
		}
		if(strlen($fetchedPosts[$i][3])>20){	//Post Title
			$fetchedPosts[$i][3]=substr($fetchedPosts[$i][3],0,15)."...";
		}
		if(strlen($fetchedPosts[$i][4])>8){		//Category Name
			$fetchedPosts[$i][4]=substr($fetchedPosts[$i][4],0,8)."...";
		}
		if(strlen($fetchedPosts[$i][5])>20){	//Admin
			$fetchedPosts[$i][5]=substr($fetchedPosts[$i][5],0,15)."...";
		}
		array_push($OnComments,TotalComments($fetchedPosts[$i][1],"ON"));
		array_push($OffComments,TotalComments($fetchedPosts[$i][1],"OFF"));
	}
	
	// Pagination
	$PostPagination = pagination();

?>