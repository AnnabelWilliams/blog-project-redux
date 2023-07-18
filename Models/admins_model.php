<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php
	
	function createNewAdmin($Username,$Password,$Name,$Admin,$DateTime){
		$result = false;
		global $ConnectingDB;
		$sql = "INSERT INTO admins(datetime,username,password,aname,addedby)
		VALUES(:datetimE,:usernamE,:passworD,:anamE,:addedbY)";
		$stmt = $ConnectingDB->prepare($sql);
		$stmt->bindValue(':datetimE',$DateTime);
		$stmt->bindValue(':usernamE',$Username);
		$stmt->bindValue(':passworD',$Password);
		$stmt->bindValue(':anamE',$Name);
		$stmt->bindValue(':addedbY',$Admin);
		$Execute = $stmt->execute();
		if($Execute){
			$result = true;
		}
		return $result;
	}
	
	function updateAdmin($AName,$ABio,$AHeadline,$Image,$ARole,$DateTime,$AdminId){
		$result = false;
		global $ConnectingDB;
		if (!empty($Image)){
			$sql = "UPDATE admins 
					SET aname='$AName', aheadline='$AHeadline', abio='$ABio', aimage='$Image', role='$ARole'
					WHERE id='$AdminId'";
		}else{
			$sql = "UPDATE admins 
					SET aname='$AName', aheadline='$AHeadline', abio='$ABio', role='$ARole'
					WHERE id='$AdminId'";
		}
		
		$Execute = $ConnectingDB->query($sql);
		move_uploaded_file($_FILES["image"]["tmp_name"],"Images/".basename($_FILES["image"]["name"]));
		if($Execute){
			$result = true;
		}
		return $result;
	}
	
	function deleteAdmin(){
		$result = false;
		global $ConnectingDB;
		global $SearchQueryParameter;
		$sql = "DELETE FROM admins WHERE id='$SearchQueryParameter'";
		$Execute = $ConnectingDB->query($sql);
		if($Execute){
			$result = true;
		}
		return $result;
	}
	
	function fetchAdmin(){
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
			$sql = "SELECT * FROM admins ORDER BY id asc LIMIT $ShowPostFrom,5";
			$Execute = $ConnectingDB->query($sql);
			$SrNo=$Page*5-5;
		//SQL default
		}else{
			$sql="SELECT * FROM admins ORDER BY id asc";
			$Execute = $ConnectingDB->query($sql);
			$SrNo = 0;
		}
		while($DataRows=$Execute->fetch()){
			$AdminId = $DataRows["id"];
			$AdminName = $DataRows["aname"];
			if(empty($AdminName)){
				$AdminName="N/A";
			}
			$AdminUsername = $DataRows["username"];
			$AddedBy = $DataRows["addedby"];
			$DateTime = $DataRows["datetime"];
			$SrNo++;
			$newAdmin = array($SrNo,$AdminId,$AdminName,$AdminUsername,$AddedBy,$DateTime);
			array_push($result,$newAdmin);
			}
			return $result;
	}
	
	function fetchCurrentAdmin(){
		$result = array();
		$AdminId = $_SESSION["User_ID"];
		global $ConnectingDB;
		$sql = "SELECT * FROM admins WHERE id='$AdminId'";
		$stmt = $ConnectingDB->query($sql);
		while ($DataRows = $stmt->fetch()){
			array_push($result,$DataRows["aname"]);
			array_push($result,$DataRows["username"]);
			array_push($result,$DataRows["aheadline"]);
			array_push($result,$DataRows["abio"]);
			array_push($result,$DataRows["aimage"]);
		}
		return $result;
	}
	
	function validateAdmin($AName,$ABio,$AHeadline) {
		$result = false;
		if(strlen($AHeadline)>12){
			$_SESSION["ErrorMessage"] = "Headline should be less than 12 characters.";
			Redirect_to("myprofile_html.php");
		}elseif(strlen($ABio)>500){
			$_SESSION["ErrorMessage"] = "Bio should be less than 500 characters.";
			Redirect_to("myprofile_html.php");
		}elseif(strlen($ABio)<1||strlen($AName)<1||strlen($AHeadline)<1){
			$_SESSION["ErrorMessage"] = "Please complete all mandatory fields.";
			Redirect_to("myprofile_html.php");
		}else{
			$result = true;
			return $result;
		}
	}
	
	function validateNewAdmin($Username,$Password,$ConfirmPassword) {
		$result = false;
		if(empty($Username)||empty($Password)||empty($ConfirmPassword)){
			$_SESSION["ErrorMessage"] = "All fields must be filled in.";
			Redirect_to("admins_html.php");
		}elseif($Password != $ConfirmPassword){
			$_SESSION["ErrorMessage"] = "Passwords must match.";
			Redirect_to("admins_html.php");
		}elseif(CheckUserNameExist($Username)){
			$_SESSION["ErrorMessage"] = "Username already exists.";
			Redirect_to("admins_html.php");
		}else{
			$result = true;
			return $result;
		}
	}

?>