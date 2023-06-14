<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("addposts_controller.php"); ?>
<?php

	function createNewPost() {
		if(isset($_POST["Submit"])){
			global $PostTitle;
			global $PostContent;
			$PostTitle=$_POST["PostTitle"];
			$Category=$_POST["CategoryTitle"];
			$Image=$_FILES["image"]["name"];
			$Target="Uploads/".basename($_FILES["image"]["name"]);
			$PostContent=$_POST["Post"];
			$Admin = $_SESSION["Username"];
			date_default_timezone_set("Europe/London");
			$CurrentTime=time();
			$DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
			if(validateNewPost()){
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
				move_uploaded_file($_FILES["image"]["tmp_name"],$Target);
				if($Execute){
					$_SESSION["SuccessMessage"] = "Post with id: ".$ConnectingDB->lastInsertId() . " added successfully.";
					Redirect_to("addposts_html.php");
				}else{
					$_SESSION["ErrorMessage"] = "Something went wrong.";
					Redirect_to("addposts_html.php");
				}
			}
		}
	}

?>