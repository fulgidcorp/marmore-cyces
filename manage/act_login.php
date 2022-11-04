<?php
ini_set('display_errors', 1);

#=== Includes
require_once("../config/config.php");

#=== Validations For Security
$POST = $objTypes->validateUserInput($_POST);
//echo '<pre>';print_r($POST); exit;

#=====Form Action
if(($POST['txt_username']<>"")&&($POST['txt_password']<>""))
{
	$password  = md5($POST['txt_password']);
	$params    = array(":is_active" => 1, ":username" => $POST['txt_username']);
	$userArray = $objTypes->fetchRow("SELECT id,username, password FROM tbl_admin WHERE is_active = :is_active AND username = :username", $params);
    
    
	if(password_verify($POST['txt_password'],$userArray['password']))
	{
		#=== Save Data to Session
		$_SESSION['SessAdminName'] 	= $userArray['username'];
		$_SESSION['SessAdminId'] 	= $userArray['id'];

		header("location:dashboard.php"); //Redirect to Super Admin's Dashboard
		exit();
	}
	else
	{
		header("location:index.php?sysmsg=100");
		exit();
	}
}
else
{
	header("location:index.php?sysmsg=100");
	exit();
}

?>

