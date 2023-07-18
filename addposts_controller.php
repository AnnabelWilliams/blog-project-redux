<?php require_once("Models/posts_model.php"); ?>
<?php require_once("Models/categories_model.php"); ?>
<?php
	
	$categoryOptions = fetchCategories();
	
	if(isset($_POST["Submit"])){
		date_default_timezone_set("Europe/London");
		$CurrentTime=time();
		$DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
		if(true == validateNewPost($_POST["PostTitle"],$_POST["Post"])){
			$insert = createNewPost($_POST["PostTitle"],$_POST["Post"],$_POST["CategoryTitle"],$_FILES["image"]["name"],$_SESSION["Username"],$DateTime);
			if(false !== $insert){
				$_SESSION["SuccessMessage"] = "Post with id: ". $insert . " added successfully.";
				Redirect_to("addposts_html.php");
			}else{
				$_SESSION["ErrorMessage"] = "Something went wrong.";
				Redirect_to("addposts_html.php");
			}
		}
	}

?>