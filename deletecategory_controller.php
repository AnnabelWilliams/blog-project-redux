<?php require_once("Models/categories_model.php"); ?>
<?php Confirm_Login(); ?>
<?php

	$SearchQueryParameter = $_GET["id"];

	if(isset($SearchQueryParameter)){
		if(deleteCategory()){
			$_SESSION["SuccessMessage"] = "Category has been deleted.";
			Redirect_to("categories_html.php?page=1");
		}else{
			$_SESSION["ErrorMessage"] = "Something went wrong.";
			Redirect_to("categories_html.php?page=1");
		}
	}

?>