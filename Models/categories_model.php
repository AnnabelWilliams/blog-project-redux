<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php
	
	function createNewCategory($Category, $Admin, $DateTime){
		$result = false;
		global $ConnectingDB;
		$sql = "INSERT INTO category(title,author,datetime)
		VALUES(:titlE,:authoR,:datetimE)";
		$stmt = $ConnectingDB->prepare($sql);
		$stmt->bindValue(':titlE',$Category);
		$stmt->bindValue(':authoR',$Admin);
		$stmt->bindValue(':datetimE',$DateTime);
		$Execute = $stmt->execute();
		if($Execute){
			$result = $ConnectingDB->lastInsertId();
		}
		return $result;
	}
	
	function validateNewCategory($Category){
		$result = false;
		if(empty($Category)){
			$_SESSION["ErrorMessage"] = "All fields must be filled in.";
			Redirect_to("categories_html.php");
		}elseif(strlen($Category)<2){
			$_SESSION["ErrorMessage"] = "Category title should be greater than 2 characters.";
			Redirect_to("categories_html.php");
		}elseif(strlen($Category)>49){
			$_SESSION["ErrorMessage"] = "Category title should be less than 50 characters.";
			Redirect_to("categories_html.php");
		}elseif(!preg_match("/^[A-Za-z0-9. _,.?!]+$/",$Category)){
			$_SESSION["ErrorMessage"] = "Category title contains invalid characters.";
			Redirect_to("categories_html.php");
		}else{
			$result = true;
			return $result;
		}
	}
	
	function deleteCategory(){
		$result = false;
		global $ConnectingDB;
		global $SearchQueryParameter;
		$sql = "DELETE FROM category WHERE id='$SearchQueryParameter'";
		$Execute = $ConnectingDB->query($sql);
		if($Execute){
			$result = true;
		}
		return $result;
	}
	
	function fetchCategories() {
		$result = array();
		global $ConnectingDB;
		global $Page;
		//SQL for pagination
		if(isset($_GET["page"])){
			$Page = $_GET["page"];
			if($Page < 1){
				$ShowPostFrom=0;
			}else{
				$ShowPostFrom = ($Page*5)-5;
			}
			$sql = "SELECT * FROM category ORDER BY id desc LIMIT $ShowPostFrom,5";
			$Execute = $ConnectingDB->query($sql);
			$SrNo=$Page*5-5;
		//SQL default
		}else{
			$sql="SELECT * FROM category ORDER BY id asc";
			$Execute = $ConnectingDB->query($sql);
			$SrNo = 0;
		}
		while($DataRows=$Execute->fetch()){
			$SrNo++;
			$category = array($SrNo,$DataRows["id"],$DataRows["title"],$DataRows["author"],$DataRows["datetime"]);
			array_push($result,$category);
		}
		return $result;
	}
	
	function categoryPagination(){
		global $ConnectingDB;
		$sql = "SELECT COUNT(*) FROM category";
		$stmt=$ConnectingDB->query($sql);
		$RowPagination = $stmt->fetch();
		$TotalPosts = array_shift($RowPagination);
		$result = ceil($TotalPosts/5);
		return $result;
	}

?>