<?php
$session_time=time();
require_once("../config/config.php");
    // echo $report1=$_POST['report_1'];
    // echo $report2=$_POST['report_2'];
    // echo $report3=$_POST['report_3'];
    $params = array(
		'news1'	    => $_POST['news1'],
		'news2'	=> $_POST['news2'],
		'news3'			=> $_POST['news3'],
		'added_by' =>$_SESSION['SessAdminId']
		
	);
    $insert = $objTypes->insert("tbl_feature_news", $params);
    header("location:add_feature_news.php");
	
    ?>