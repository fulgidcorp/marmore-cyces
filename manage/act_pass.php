<?php
#=== Includes
require_once("../config/config.php");

#=== Validations For Security
$POST = $objTypes->validateUserInput($_POST);

$params    	 = array(":id" => $_SESSION['SessAdminId']);
$userDetails = $objTypes->fetchRow("SELECT password FROM tbl_admin WHERE id = :id", $params);
$oldpassword = $POST['oldpass'];
$newpassword = password_hash($POST['pass1'], PASSWORD_BCRYPT);

//Form Action
if(($POST['SAVE']=='SAVE') && password_verify($oldpassword, $userDetails['password'])){
	$params  = array('password' => $newpassword);
	$pwhere  = array("id" => $_SESSION['SessAdminId']);
	if($objTypes->update("tbl_admin", $params, "Id = :id", $pwhere)){
		header("location:changepassword.php?sysmsg=1006");
		exit();
	}else{
		header("location:changepassword.php?sysmsg=4");
		exit();
	}
}else{
	 header("location:changepassword.php?sysmsg=102");
	 exit();
}
?>

