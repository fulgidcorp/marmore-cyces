<?php
#=== Includes
 ini_set('display_errors',1);

require_once("../config/config.php");
require_once("verify_logins.php");

#==== Validations For Security
$POST		= $objTypes->validateUserInput($_POST);
$id 		= isset($POST['id']) ? intval($POST['id']) : intval($_REQUEST['id']) ;
$ip			= $_SERVER['REMOTE_ADDR'];
$agent		= addslashes($_SERVER['HTTP_USER_AGENT']);
//echo "Reached Here1";
#==== ADD - UPDATE - INSERT 

if(($POST['SAVE']=="SAVE")){

	$session_time=time();
	$date=date("Y-m-d");
	$today = date("Y-m-d H:i:s"); 
	$added_date = date('d-m-Y');
	$date_var=explode("-",$added_date);
	$pgNo 	= intval(base64_decode($_REQUEST['pgNo']));
	$params = array(
		'report_category_name'	    => $POST['report_category_name'],
		'slug_report_category_name' => (isset($POST['slug_report_category_name'])&&$POST['slug_report_category_name']!='') ? fixForUri($POST['report_category_name']):fixForUri($POST['report_category_name']),
		'language' => $POST['language'],
		'seo_title' => $POST['seo_title'],
		'seo_desc' => $POST['seo_description'],
		'is_active'			=>  1,
		'is_delete'			=>  1,
        'added_by'          => $_SESSION['SessAdminId'],
	);

	if($id > 0){
		$update_params = array(
	        'updated_date'		=> date("Y-m-d H:i:s"),
	        'updated_by'   		=> $_SESSION['SessAdminId'],
		);
		$params = array_merge($params, $update_params);
		 
		$where = array(
			':id'          => $id
		);
		$update 	= $objTypes->update("tbl_report_category", $params, "id = :id", $where);

		if($update){
			$insert_id	= $id;
		}
	}
	else{
		$insert = $objTypes->insert("tbl_report_category", $params);
		if($insert){
			$insert_id = $objTypes->lastInsertId();
		}
	}
	
	header("location:list_report_category.php?sysmsg=1000&pgNo=".$pgNo);
	exit();
}

#==== STATUS UPDATION
if(($_REQUEST['status']<>"") && ($_REQUEST['id'] <> "")){
	$statusVal  = intval($_REQUEST['status']);
	$status		= ($statusVal=='0') ? '1' : '0';
	$id			= intval($_REQUEST['id']);
	$pgNo 		= intval(base64_decode($_REQUEST['pgNo']));
	$title  = $_REQUEST['report_category_name'];
    $params     = array("is_active" => $status);
	$where 		= array(":id" => $id);

	$update     = $objTypes->update("tbl_report_category", $params, "id = :id", $where);
	if($update){
		header("location:list_report_category.php?sysmsg=1001&pgNo=$pgNo&title=$title");
		exit();
	}
    else{
		header("location:list_report_category.php?sysmsg=4&pgNo=$pgNo&title=$title");
		exit();
	}
}

#==== DELETE
if(($_REQUEST['action']=="delete") && ($_REQUEST['id'] <> ""))
{
	$id		= intval($_REQUEST['id']);
	$pgNo 	= intval(base64_decode($_REQUEST['pgNo']));
	$title  = $_REQUEST['report_category_name'];
	$cat_type = $_REQUEST['cat_type'];
	$params	= array("is_delete" => '0');
	$where  = array(":id" => $id);
	$delete = $objTypes->update("tbl_report_category", $params, "id = :id", $where);
	if($delete){
		header("location:list_report_category.php?sysmsg=1002&pgNo=$pgNo&title=$title");
		exit();
	}else{
		header("location:list_report_category.php?sysmsg=4&pgNo=$pgNo&title=$title");
		exit();
	}
}

#==== ACTIVE ALL
if(($POST['action']=="activeall") && ($_POST['DelCheckBox'] <> "")){
	$DelCheckBox	= $_POST['DelCheckBox'];
	$Result			= count($DelCheckBox);
	$pgNo 			= intval($_REQUEST['pgNo']);
	$title  = $_REQUEST['report_category_name'];
	

	if($Result == "0"){
		header("location:list_report_category.php?sysmsg=8&pgNo=$pgNo&title=$title");
		exit();
	}
	$Delete	= implode(',', $DelCheckBox);
	$update = $objTypes->inquery("UPDATE tbl_report_category SET is_active = '1' WHERE id IN ($Delete)");

	if($update > 0){
		header("location:list_report_category.php?sysmsg=1012&pgNo=$pgNo&title=$title");
		exit();
	}
    else{
		header("location:list_report_category.php?sysmsg=13&pgNo=$pgNo&title=$title");
		exit();
	}
}

#==== DEACTIVE ALL
if(($POST['action']=="deactiveall") && ($_POST['DelCheckBox'] <> "")){
	$DelCheckBox	= $_POST['DelCheckBox'];
	$Result			= count($DelCheckBox);
	$pgNo 			= intval($_REQUEST['pgNo']);
	$title  = $_REQUEST['report_category_name'];
	$cat_type = $_REQUEST['cat_type'];

	if($Result == "0"){
		header("location:list_report_category.php?sysmsg=9&pgNo=$pgNo&title=$title");
		exit();
	}
    $Delete = implode(',',$DelCheckBox);
	$update = $objTypes->inquery("UPDATE tbl_report_category SET is_active = '0' WHERE id IN ($Delete)");

	if($update > 0){
		header("location:list_report_category.php?sysmsg=1013&pgNo=$pgNo&title=$title");
		exit();
	}
    else{
		header("location:list_report_category.php?sysmsg=14&pgNo=$pgNo&title=$title");
		exit();
	}
}

#==== DELETE  ALL
if(($POST['action']=="deleteall") && ($_POST['DelCheckBox'] <> "")){
	$DelCheckBox	= $_POST['DelCheckBox'];
	$Result			= count($DelCheckBox);
	$title  = $_REQUEST['report_category_name'];
	$cat_type = $_REQUEST['cat_type'];

	if($Result == "0"){
		header("location:list_report_category.php?sysmsg=10");
		exit();
	}
	$Delete = implode(',',$DelCheckBox);
	$update = $objTypes->inquery("UPDATE tbl_report_category SET is_delete = '0' WHERE id IN ($Delete)");

	if($update > 0){
		header("location:list_report_category.php?sysmsg=1014&title=$title");
		exit();
	}
    else{
		header("location:list_report_category.php?sysmsg=4&title=$title");
		exit();
	}
}
function fixForUri($string){
 $slug = trim($string); // trim the string
 $slug= preg_replace('/[^a-zA-Z0-9 -]/','',$slug ); // only take alphanumerical characters, but keep the spaces and dashes too...
 $slug= str_replace(' ','-', $slug); // replace spaces by dashes
 $slug= strtolower($slug);  // make it lowercase
 return $slug;
}