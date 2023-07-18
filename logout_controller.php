<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php

$_SESSION["User_ID"] = null;
$_SESSION["Username"] = null;
$_SESSION["AdminName"] = null;
$_SESSION["Role"] = null;

session_destroy();
Redirect_to("login_html.php");

?>