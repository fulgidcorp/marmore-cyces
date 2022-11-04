<?php
#=== Includes
ini_set('display_errors',1);

require_once("../config/config.php");
require_once("verify_logins.php");
// echo '<pre>';
// print_r($_POST);
// exit;
#==== Validations For Security
//$POST		= $objTypes->validateUserInput($_POST);
$POST		= ($_POST);
$id 		= isset($POST['id']) ? intval($POST['id']) : intval($_REQUEST['id']) ;
$ip			= $_SERVER['REMOTE_ADDR'];
$agent		= addslashes($_SERVER['HTTP_USER_AGENT']);

// print_r($POST); 
#==== ADD - UPDATE - INSERT 
if(($POST['SAVE']=="SAVE")){
	$pgNo 	= intval(base64_decode($_REQUEST['pgNo']));
	$params = array(
		'gcc_name'		=> $POST['gcc_name'],
        'short_desc'	=> $POST['short_desc'],		
        'long_desc'  => $POST['long_desc'],
        'date'   =>$_POST['date'],
        'slug' => (isset($POST['slug'])&&$POST['slug']!='') ? fixForUri($POST['slug']):fixForUri($POST['gcc_name']),
        'language'     => $POST['language'],
        // 'seo_title'     => $POST['seo_title'],
        // 'seo_desc'        => $POST['seo_desc'],
		'is_active'			=>  1,
		'is_delete'			=>  1,
        'added_by'          => $_SESSION['SessAdminId']
		
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
		$update 	= $objTypes->update("tbl_gcc", $params, "id = :id", $where);

		if($update){
			$insert_id	= $id;
		}
	
	}
	else{
		$insert = $objTypes->insert("tbl_gcc", $params);
		if($insert){
			$insert_id = $objTypes->lastInsertId();
        }
	}
	
	if($insert_id > 0){
		$validatefiles 	= array("jpg", "bmp", "jpeg", "gif","JPG", "BMP", "JPEG", "GIF","png","PNG");
		$filetype 		= array('image/gif', 'image/jpeg','image/JPG','image/jpg', 'image/JPEG', 'image/GIF', 'image/bmp', 'image/BMP','image/png','image/PNG');
        
        
        //report pdf
        if(isset($_FILES['book_pdf']['name']) && $_FILES['book_pdf']['name'] != "")
			{			
				$ext 			= pathinfo($_FILES['book_pdf']['name'], PATHINFO_EXTENSION);
				$ext			= strtolower($ext);
				$validatefiles  = array("pdf", "PDF");
				$filetype 		= array('application/pdf','application/PDF');

				if(in_array($ext, $validatefiles) == false){
					header("location:add_gcc.php?sysmsg=35");
					exit();		
				}

				if(in_array(strtolower($_FILES['book_pdf']['type']), $filetype) == false ){
					header("location:add_gcc.php?sysmsg=35");
					exit();	
				}
				
				
				if(isset($_FILES['book_pdf']['name'])){
					$ext 	  = pathinfo($_FILES['book_pdf']['name'], PATHINFO_EXTENSION);
					$filename = basename($_FILES['book_pdf']['name'], $ext);			
					$filename = 'report_'.time().'.'.$ext;
					$movefile = move_uploaded_file($_FILES['book_pdf']['tmp_name'], "../uploads/book_pdf/".$filename);				
				}
				$update_params  = array('book_pdf'=> $filename);
				$params			= array_merge($params, $update_params);
				$where	  		= array(':id'=> $insert_id);
				$updatepdf 		= $objTypes->update("tbl_gcc", $params, "id = :id", $where);
			}	
		
			}

	header("location:list_gcc.php?sysmsg=1000&pgNo=".$pgNo);
	exit();
}

#==== STATUS UPDATION
if(($_REQUEST['status']<>"") && ($_REQUEST['id'] <> "")){
	$statusVal  = intval($_REQUEST['status']);
	$status		= ($statusVal=='0') ? '1' : '0';
	$id			= intval($_REQUEST['id']);
	$pgNo 		= intval(base64_decode($_REQUEST['pgNo']));
	$title  = $_REQUEST['title'];
	$cat_type = $_REQUEST['cat_type'];
    $params     = array("is_active" => $status);
	$where 		= array(":id" => $id);

	$update     = $objTypes->update("tbl_gcc", $params, "id = :id", $where);
	if($update){
		header("location:list_gcc.php?sysmsg=1001&pgNo=$pgNo&title=$title");
		exit();
	}
    else{
		header("location:list_gcc.php?sysmsg=4&pgNo=$pgNo&title=$title");
		exit();
	}
}

#==== DELETE
if(($_REQUEST['action']=="delete") && ($_REQUEST['id'] <> ""))
{
	$id		= intval($_REQUEST['id']);
	$pgNo 	= intval(base64_decode($_REQUEST['pgNo']));
	$title  = $_REQUEST['title'];
	$cat_type = $_REQUEST['cat_type'];
	$params	= array("is_delete" => '0');
	$where  = array(":id" => $id);
	$delete = $objTypes->update("tbl_gcc", $params, "id = :id", $where);
	if($delete){
		header("location:list_gcc.php?sysmsg=1002&pgNo=$pgNo&title=$title");
		exit();
	}else{
		header("location:list_gcc.php?sysmsg=4&pgNo=$pgNo&title=$title");
		exit();
	}
}

#==== ACTIVE ALL
if(($POST['action']=="activeall") && ($_POST['DelCheckBox'] <> "")){
	$DelCheckBox	= $_POST['DelCheckBox'];
	$Result			= count($DelCheckBox);
	$pgNo 			= intval($_REQUEST['pgNo']);
	$title  = $_REQUEST['title'];
	$cat_type = $_REQUEST['cat_type'];

	if($Result == "0"){
		header("location:list_gcc.php?sysmsg=8&pgNo=$pgNo&title=$title");
		exit();
	}
	$Delete	= implode(',', $DelCheckBox);
	$update = $objTypes->inquery("UPDATE tbl_gcc SET is_active = '1' WHERE id IN ($Delete)");

	if($update > 0){
		header("location:list_gcc.php?sysmsg=1012&pgNo=$pgNo&title=$title");
		exit();
	}
    else{
		header("location:list_gcc.php?sysmsg=13&pgNo=$pgNo&title=$title");
		exit();
	}
}

#==== DEACTIVE ALL
if(($POST['action']=="deactiveall") && ($_POST['DelCheckBox'] <> "")){
	$DelCheckBox	= $_POST['DelCheckBox'];
	$Result			= count($DelCheckBox);
	$pgNo 			= intval($_REQUEST['pgNo']);
	$title  = $_REQUEST['title'];
	//$cat_type = $_REQUEST['cat_type'];

	if($Result == "0"){
		header("location:list_gcc.php?sysmsg=9&pgNo=$pgNo&title=$title");
		exit();
	}
    $Delete = implode(',',$DelCheckBox);
	$update = $objTypes->inquery("UPDATE tbl_gcc SET is_active = '0' WHERE id IN ($Delete)");

	if($update > 0){
		header("location:list_gcc.php?sysmsg=1013&pgNo=$pgNo&title=$title");
		exit();
	}
    else{
		header("location:list_gcc.php?sysmsg=14&pgNo=$pgNo&title=$title");
		exit();
	}
}

#==== DELETE  ALL
if(($POST['action']=="deleteall") && ($_POST['DelCheckBox'] <> "")){
	$DelCheckBox	= $_POST['DelCheckBox'];
	$Result			= count($DelCheckBox);
	$title  = $_REQUEST['title'];
	$cat_type = $_REQUEST['cat_type'];

	if($Result == "0"){
		header("location:list_gcc.php?sysmsg=10");
		exit();
	}
	$Delete = implode(',',$DelCheckBox);
	$update = $objTypes->inquery("UPDATE tbl_gcc SET is_delete = '0' WHERE id IN ($Delete)");

	if($update > 0){
		header("location:list_gcc.php?sysmsg=1014&title=$title");
		exit();
	}
    else{
		header("location:list_gcc.php?sysmsg=4&title=$title");
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