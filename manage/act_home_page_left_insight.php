<?php
$session_time=time();
require_once("../config/config.php");
    $params = array(
		'blog1'	    => $_POST['blog1'],
		'report1'	=> $_POST['report1'],
		'report2'			=> $_POST['report2'],
		'added_by' =>$_SESSION['SessAdminId']
		
	);
    $insert = $objTypes->insert("tbl_home_page_left_feature_insight", $params);
    
	header("location:add_home_page_left_feature_insight.php");
    ?>