<?php require_once("Models/categories_model.php"); ?>
<?php

	$fetchedCategories = fetchCategories();
	
	if(isset($_POST["Submit"])){
		date_default_timezone_set("Europe/London");
		$CurrentTime=time();
		$DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
		if(true == validateNewCategory($_POST["Title"])){
			$insert = createNewCategory($_POST["Title"],$_SESSION["Username"],$DateTime);
			if(false !== $insert){
				$_SESSION["SuccessMessage"] = "Category with id: ". $insert . " added successfully.";
				Redirect_to("categories_html.php?page=1");
			}else{
				$_SESSION["ErrorMessage"] = "Something went wrong.";
				Redirect_to("categories_html.php?page=1");
			}
		}
	}
	
	$CategoryPagination = categoryPagination();

?>