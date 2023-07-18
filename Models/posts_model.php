<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php

	function createNewPost($PostTitle,$PostContent,$Category,$Image,$Admin,$DateTime) {
		$result = false;
		global $ConnectingDB;
		$sql = "INSERT INTO posts(datetime,title,category,author,image,post)
		VALUES(:datetimE,:titlE,:categorY,:authoR,:imagE,:posT)";
		$stmt = $ConnectingDB->prepare($sql);
		$stmt->bindValue(':datetimE',$DateTime);
		$stmt->bindValue(':titlE',$PostTitle);
		$stmt->bindValue(':categorY',$Category);
		$stmt->bindValue(':authoR',$Admin);
		$stmt->bindValue(':imagE',$Image);
		$stmt->bindValue(':posT',$PostContent);
		$Execute = $stmt->execute();
		move_uploaded_file($_FILES["image"]["tmp_name"],"Uploads/".basename($Image));
		if($Execute){
			$result = $ConnectingDB->lastInsertId();
		}
		return $result;
	}
	
	function updatePost($PostTitle,$PostContent,$Category,$Image){
		$result = false;
		global $ConnectingDB;
		global $SearchQueryParameter;
		if (!empty($Image)){
			$sql = "UPDATE posts 
					SET title='$PostTitle', category='$Category', image='$Image', post='$PostContent' 
					WHERE id='$SearchQueryParameter'";
		}else{
			$sql = "UPDATE posts 
					SET title='$PostTitle', category='$Category', post='$PostContent' 
					WHERE id='$SearchQueryParameter'";
		}
		$Execute = $ConnectingDB->query($sql);
		move_uploaded_file($_FILES["image"]["tmp_name"],"Uploads/".basename($_FILES["image"]["name"]));
		if($Execute){
			$result = true;
		}
		return $result;
	}
	
	function deletePost(){
		$result = false;
		global $ConnectingDB;
		global $SearchQueryParameter;
		$sql = "DELETE FROM posts WHERE id='$SearchQueryParameter'";
		$Execute = $ConnectingDB->query($sql);
		if($Execute){
			$result = true;
		}
		return $result;
	}
	
	function validateNewPost($PostTitle,$PostContent) {
		$result = false;
		if(empty($PostTitle)){
			$_SESSION["ErrorMessage"] = "Post title must be filled in.";
			Redirect_to("addposts_html.php");
		}elseif(strlen($PostTitle)<5){
			$_SESSION["ErrorMessage"] = "Post title should be greater than 5 characters.";
			Redirect_to("addposts_html.php");
		}elseif(strlen($PostTitle)>49){
			$_SESSION["ErrorMessage"] = "Post title should be less than 50 characters.";
			Redirect_to("addposts_html.php");
		}elseif(strlen($PostContent)>9999){
			$_SESSION["ErrorMessage"] = "Post content should be less than 10000 characters.";
			Redirect_to("addposts_html.php");
		}elseif(!preg_match("/^[A-Za-z0-9. _,.?!]+$/",$PostTitle)){
			$_SESSION["ErrorMessage"] = "Post title contains invalid characters.";
			Redirect_to("addposts_html.php");
		}else{
			$result = true;
			return $result;
		}
	}
	
	function fetchPosts(){
		$result = array();
		global $ConnectingDB;
		global $SearchQueryParameter;
		global $Page;
		$i=0;
		// SQL when search button active
		if(isset($_GET["SearchButton"])){
			$Search = $_GET["search"];
			$sql = "SELECT * FROM posts
			WHERE datetime LIKE :search
			OR category LIKE :search
			OR post LIKE :search
			OR title LIKE :search
			ORDER BY id desc";
			$stmt = $ConnectingDB->prepare($sql);
			$stmt->bindValue(':search','%'.$Search.'%');
			$stmt->execute();
		// SQL when pagination is active
		}elseif(isset($_GET["page"])){
			$Page = $_GET["page"];
			if($Page < 1){
				$ShowPostFrom=0;
			}else{
				$ShowPostFrom = ($Page*5)-5;
			}
			$sql = "SELECT * FROM posts ORDER BY id desc LIMIT $ShowPostFrom,5";
			$stmt = $ConnectingDB->query($sql);
			$i=$Page*5-5;
		//SQL when category is set
		}elseif(isset($_GET["category"])) {
			$Category = $_GET["category"];
			$sql = "SELECT * FROM posts WHERE category='$Category' ORDER BY id desc";
			$stmt = $ConnectingDB->query($sql);
		//SQL for fetching single post
		}elseif(isset($SearchQueryParameter)){
			$sql = "SELECT * FROM posts WHERE id='$SearchQueryParameter'";
			$stmt = $ConnectingDB->query($sql);
		// SQL default
		}else{
			$sql = "SELECT * FROM posts ORDER BY id desc";
			$stmt = $ConnectingDB->query($sql);
		}
		while ($DataRows = $stmt->fetch()){
			$Id = $DataRows["id"];
			$DateTime = $DataRows["datetime"];
			$PostTitle = $DataRows["title"];
			$CategoryName = $DataRows["category"];
			$Admin = $DataRows["author"];
			$Image = $DataRows["image"];
			$PostContent = $DataRows["post"];
			$i++;
			$Post = array($i,$Id,$DateTime,$PostTitle,$CategoryName,$Admin,$Image,$PostContent);
			array_push($result,$Post);
		}
		return $result;
	}
	
	function pagination(){
		global $ConnectingDB;
		$sql = "SELECT COUNT(*) FROM posts";
		$stmt=$ConnectingDB->query($sql);
		$RowPagination = $stmt->fetch();
		$TotalPosts = array_shift($RowPagination);
		$result = ceil($TotalPosts/5);
		return $result;
	}

?>