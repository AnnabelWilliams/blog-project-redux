<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php

	function createNewComment($CommenterName,$CommenterEmail,$CommentText,$DateTime){
		$result = true;
		global $ConnectingDB;
		global $SearchQueryParameter;
		$sql = "INSERT INTO comments(datetime,name,email,comment,approvedby,status,post_id)
		VALUES(:datetimE,:namE,:emaiL,:commenT,'Pending','OFF',:postIdFromUrL)";
		$stmt = $ConnectingDB->prepare($sql);
		$stmt->bindValue(':datetimE',$DateTime);
		$stmt->bindValue(':namE',$CommenterName);
		$stmt->bindValue(':emaiL',$CommenterEmail);
		$stmt->bindValue(':commenT',$CommentText);
		$stmt->bindValue(':postIdFromUrL',$SearchQueryParameter);
		$Execute = $stmt->execute();
		var_dump($Execute);
		if($Execute){
			$result = true;
		}
		return $result;
	}
	
	function validateNewComment($CommenterName,$CommenterEmail,$CommentText){
		$result = false;
		if(empty($CommenterName)||empty($CommenterEmail)||empty($CommentText)){
			$_SESSION["ErrorMessage"] = "Please complete all fields.";
			Redirect_to("fullpost_html.php?id={$SearchQueryParameter}");
		}elseif(strlen($CommentText)>500){
			$_SESSION["ErrorMessage"] = "Comment should be less than 500 characters.";
			Redirect_to("fullpost_html.php?id={$SearchQueryParameter}");
		}else{
			$result = true;
			return $result;
		}
	}
	
	function approveComment(){
		$result = false;
		global $ConnectingDB;
		global $SearchQueryParameter;
		$Admin = $_SESSION["AdminName"];
		$sql = "UPDATE comments SET status='ON', approvedby='$Admin' WHERE id='$SearchQueryParameter'";
		$Execute = $ConnectingDB->query($sql);
		if($Execute){
			$result = true;
		}
		return $result;
	}
	
	function disapproveComment(){
		$result = false;
		global $ConnectingDB;
		global $SearchQueryParameter;
		$Admin = $_SESSION["AdminName"];
		$sql = "UPDATE comments SET status='OFF', approvedby='Pending' WHERE id='$SearchQueryParameter'";
		$Execute = $ConnectingDB->query($sql);
		if($Execute){
			$result = true;
		}
		return $result;
	}
	
	function deleteComment(){
		$result = false;
		global $ConnectingDB;
		global $SearchQueryParameter;
		$Admin = $_SESSION["AdminName"];
		$sql = "DELETE FROM comments WHERE id='$SearchQueryParameter'";
		$Execute = $ConnectingDB->query($sql);
		if($Execute){
			$result = true;
		}
		return $result;
	}
	
	function fetchUnapprovedComments(){
		$result = array();
		global $ConnectingDB;
		global $UPage;
		//SQL for pagination
		if(isset($_GET["upage"])){
			$UPage = $_GET["upage"];
			if($UPage < 1){
				$ShowPostFrom=0;
			}else{
				$ShowPostFrom = ($UPage*5)-5;
			}
			$sql = "SELECT * FROM comments WHERE status='OFF' ORDER BY id desc LIMIT $ShowPostFrom,5";
			$Execute = $ConnectingDB->query($sql);
			$SrNo=$UPage*5-5;
		//SQL default
		}else{
			$sql="SELECT * FROM comments WHERE status='OFF' ORDER BY id desc";
			$Execute = $ConnectingDB->query($sql);
			$SrNo = 0;
		}
		while($DataRows=$Execute->fetch()){
			$CommentId = $DataRows["id"];
			$DateTime = $DataRows["datetime"];
			$CommenterName = $DataRows["name"];
			$CommentContent = $DataRows["comment"];
			$CommentPostId = $DataRows["post_id"];
			$SrNo++;
			$Comment = array($SrNo,$CommentId,$DateTime,$CommenterName,$CommentContent,$CommentPostId);
			array_push($result,$Comment);
		}
		return $result;
	}
	
	function fetchApprovedComments(){
		$result = array();
		$SrNo = 0;
		global $ConnectingDB;
		global $APage;
		global $SearchQueryParameter;
		//SQL for pagination
		if(isset($_GET["apage"])){
			$APage = $_GET["apage"];
			if($APage < 1){
				$ShowPostFrom=0;
			}else{
				$ShowPostFrom = ($APage*5)-5;
			}
			$sql = "SELECT * FROM comments WHERE status='ON' ORDER BY id desc LIMIT $ShowPostFrom,5";
			$Execute = $ConnectingDB->query($sql);
			$SrNo=$APage*5-5;
		//SQL default
		}elseif(isset($SearchQueryParameter)){
			$sql = "SELECT * FROM comments WHERE post_id='$SearchQueryParameter' AND status='ON'";
			$Execute = $ConnectingDB->query($sql);
		}else{
			$sql="SELECT * FROM comments WHERE status='ON' ORDER BY id desc";
			$Execute = $ConnectingDB->query($sql);
		}
		while($DataRows=$Execute->fetch()){
			$CommentId = $DataRows["id"];
			$DateTime = $DataRows["datetime"];
			$CommenterName = $DataRows["name"];
			$CommentContent = $DataRows["comment"];
			$CommentPostId = $DataRows["post_id"];
			$SrNo++;
			$Comment = array($SrNo,$CommentId,$DateTime,$CommenterName,$CommentContent,$CommentPostId);
			array_push($result,$Comment);
		}
		return $result;
	}
	
	function TotalComments($id,$approved){
		global $ConnectingDB;
		$sql = "SELECT COUNT(*) FROM comments WHERE post_id='$id' AND status='$approved'";
		$stmt = $ConnectingDB->query($sql);
		$TotalRows = $stmt->fetch();
		$Total = array_shift($TotalRows);
		return $Total;
	}
	
	function commentPagination($approved){
		global $ConnectingDB;
		$sql = "SELECT COUNT(*) FROM comments WHERE status='$approved'";
		$stmt=$ConnectingDB->query($sql);
		$RowPagination = $stmt->fetch();
		$TotalPosts = array_shift($RowPagination);
		$result = ceil($TotalPosts/5);
		return $result;
	}

?>