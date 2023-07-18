<?php require_once("Models/comments_model.php"); ?>
<?php

	$fetchedUnapprovedComments = fetchUnapprovedComments();
	$fetchedApprovedComments = fetchApprovedComments();
	
	$CommentPaginationOn = commentPagination("ON");
	$CommentPaginationOff = commentPagination("OFF");

?>