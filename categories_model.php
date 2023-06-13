<?php require_once("Includes/DB.php"); ?>
<?php

	function fetchCategories() {
		global $ConnectingDB;
		$sql = "SELECT id,title FROM category";
		$stmt = $ConnectingDB->query($sql);
		while ($DataRows = $stmt->fetch()){
			$Id = $DataRows["id"];
			$CategoryName = $DataRows["title"];
			
		?>
			<option> <?php echo $CategoryName ?> </option>
		<?php } //while loop ending
	}

?>