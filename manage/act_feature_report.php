<?php
$session_time=time();
require_once("../config/config.php");
    $params = array(
		'report1'	    => $_POST['report1'],
		'report2'	=> $_POST['report2'],
		'report3'			=> $_POST['report3'],
		'added_by' =>$_SESSION['SessAdminId']
		
	);
    $insert = $objTypes->insert("tbl_feature_report", $params);
    
	header("location:add_feature_report.php");
    ?>