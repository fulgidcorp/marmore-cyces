<?php
$session_time=time();
require_once("../config/config.php");
    $params = array(
		'blog1'	    => $_POST['blog1'],
		'blog2'	=> $_POST['blog2'],
		'blog3'			=> $_POST['blog3'],
		'added_by' =>$_SESSION['SessAdminId']
		
	);
    $insert = $objTypes->insert("tbl_feature_blogs", $params);
	header("location:add_feature_blog.php");
	
    ?>