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
		'report_name' => $POST['report_name'],
        'report_short_description'		=> $POST['report_short_description'],
        'report_description' => $POST['report_description'],
		'report_pages_count'		=> isset($POST['report_pages_count']) && $POST['report_pages_count']>0?$POST['report_pages_count']:0,
        'report_date'	=> $POST['report_date'],		
        'report_category1'  => $POST['report_category1'],
        'report_category2'   =>$_POST['report_category2'],
        'report_category3'	=> $POST['report_category3'],		
        'report_country'  => $POST['report_country'],
        'report_industry'   =>$_POST['report_industry'],
        'report_tags'	=> $POST['report_tags'],		
        'report_category1'  => $POST['report_category1'],
        'report_category2'   =>$_POST['report_category2'],
        'report_category3'   =>$_POST['report_category3'],
        
        'report_country'  => $POST['report_country'],
        'report_industry'   =>$_POST['report_industry'],
        'report_tags'   =>$_POST['report_tags'],
        'report_executive_summary'  => $POST['report_executive_summary'],
        'report_faq'   =>$_POST['report_faq'],
        'report_key_questions_addressed'   =>$_POST['report_key_questions_addressed'],
        'report_add_value_to'  => $POST['report_add_value_to'],
		// 'customize_report'  => $POST['customize_report'],
        'report_table_of_contents'   =>$_POST['report_table_of_contents'],
        'report_chart_reports'   =>$_POST['report_chart_reports'], //customize report
        'report_related_reports'  => $POST['report_related_reports'],
        'report_pdf_download_url' => $POST['report_pdf_download_url'],
        'wp_slug' => (isset($POST['wp_slug'])&&$POST['wp_slug']!='') ? fixForUri($POST['wp_slug']):fixForUri($POST['report_name']),
        'language'     => $POST['language'],
        'report_seo_title'     => $POST['report_seo_title'],
        'report_seo_description'        => $POST['report_seo_description'],
		'is_active'			=>  1,
		'is_delete'			=>  1,
       // 'added_by'          => $_SESSION['SessAdminName']
		
	);

	if($id > 0){
		$update_params = array(
	        'updated_date'		=> date("Y-m-d H:i:s"),
	       // 'updated_by'   		=> $_SESSION['SessAdminName'],
		);
		$params = array_merge($params, $update_params);
				  
		$where = array(
			':id'          => $id
		);
		$update 	= $objTypes->update("tbl_report_data", $params, "id = :id", $where);

		if($update){
			$insert_id	= $id;
		}
	
	}
	else{
		$insert = $objTypes->insert("tbl_report_data", $params);
		if($insert){
			$insert_id = $objTypes->lastInsertId();
		}}
		if($insert_id > 0){
			$validatefiles 	= array("jpg", "bmp", "jpeg", "gif","JPG", "BMP", "JPEG", "GIF","png","PNG");
			$filetype 		= array('image/gif', 'image/jpeg','image/JPG','image/jpg', 'image/JPEG', 'image/GIF', 'image/bmp', 'image/BMP','image/png','image/PNG');
			//report images
			
			if(isset($_FILES['report_image']['name']) && $_FILES['report_image']['name'] != ""){
			
				$ext 	  		= pathinfo($_FILES['report_image']['name'], PATHINFO_EXTENSION);
				$ext 	  		= strtolower($ext);
				$filename 		= basename($_FILES['report_image']['name'], $ext);
				$filename 		= time().'.'.$ext;
	
				if($_FILES['report_image']['size'] > 3097152){
					header("location:add_report.php?sysmsg=16&id=".$insert_id);
					exit();
				}
	
				if(in_array($ext, $validatefiles) == false){
					header("location:add_report.php?sysmsg=11&id=".$insert_id);
					exit();
				}
	
				if(in_array(strtolower($_FILES['report_image']['type']), $filetype) == false ){
					header("location:add_report.php?sysmsg=11&id=".$insert_id);
					exit();
				}
	
				$where      = array(':id' => $insert_id);
				
	
				if(move_uploaded_file($_FILES['report_image']['tmp_name'], "../uploads/report_images/".$filename)){
					$path 		= "../uploads/report_images/".$filename;
					$main_image = "../uploads/report_images/main_".$filename;
					// $main_width	= "350";
					// $main_height= "260";
	
					$magicianObj = new imageLib($path);
					//$magicianObj->resizeImage($main_width, $main_height);
					$magicianObj->saveImage($main_image, 100);
	
					// $thumb_image = "../uploads/report_images/thumb_".$filename;
					// // $thumb_width = "374";
					// // $thumb_height= "251";
	
					// $magicianObj2 = new imageLib($path);
					// //$magicianObj2->resizeImage($thumb_width, $thumb_height);
					// $magicianObj2->saveImage($thumb_image, 100);
	
					$img_params = array('report_images' => 'main_'.$filename);
					$update     = $objTypes->update("tbl_report_data", $img_params, "id = :id", $where);	
				}
				else{
					header("location:add_report.php?sysmsg=1003&id=".$insert_id);
					exit();
				}
			}
			
			//report pdf
			if(isset($_FILES['report_pdf_executive_summary']['name']) && $_FILES['report_pdf_executive_summary']['name'] != "")
				{			
					$ext 			= pathinfo($_FILES['report_pdf_executive_summary']['name'], PATHINFO_EXTENSION);
					$ext			= strtolower($ext);
					$validatefiles  = array("pdf", "PDF");
					$filetype 		= array('application/pdf','application/PDF');
	
					if(in_array($ext, $validatefiles) == false){
						header("location:add_report.php?sysmsg=35");
						exit();		
					}
	
					if(in_array(strtolower($_FILES['report_pdf_executive_summary']['type']), $filetype) == false ){
						header("location:add_report.php?sysmsg=35");
						exit();	
					}
					
					
					if(isset($_FILES['report_pdf_executive_summary']['name'])){
						$ext 	  = pathinfo($_FILES['report_pdf_executive_summary']['name'], PATHINFO_EXTENSION);
						$filename = basename($_FILES['report_pdf_executive_summary']['name'], $ext);			
						$filename = 'report_'.time().'.'.$ext;
						$movefile = move_uploaded_file($_FILES['report_pdf_executive_summary']['tmp_name'], "../uploads/report_pdf/".$filename);				
					}
					$update_params  = array('report_pdf_executive_summary'=> $filename);
					$params			= array_merge($params, $update_params);
					$where	  		= array(':id'=> $insert_id);
					$updatepdf 		= $objTypes->update("tbl_report_data", $params, "id = :id", $where);
				}	
				
				
				 if(isset($_FILES['report_pdf_free_report']['name']) && $_FILES['report_pdf_free_report']['name'] != "")
				{			
					$ext 			= pathinfo($_FILES['report_pdf_free_report']['name'], PATHINFO_EXTENSION);
					$ext			= strtolower($ext);
					$validatefiles  = array("pdf", "PDF");
					$filetype 		= array('application/pdf','application/PDF');
	
					if(in_array($ext, $validatefiles) == false){
						header("location:add_report.php?sysmsg=35");
						exit();		
					}
	
					if(in_array(strtolower($_FILES['report_pdf_free_report']['type']), $filetype) == false ){
						header("location:add_report.php?sysmsg=35");
						exit();	
					}
					
					
					if(isset($_FILES['report_pdf_free_report']['name'])){
						$ext 	  = pathinfo($_FILES['report_pdf_free_report']['name'], PATHINFO_EXTENSION);
						$filename = basename($_FILES['report_pdf_free_report']['name'], $ext);			
						$filename = 'report_'.time().'.'.$ext;
						$movefile = move_uploaded_file($_FILES['report_pdf_free_report']['tmp_name'], "../uploads/report_pdf/".$filename);				
					}
					$update_params  = array('report_pdf_free_report'=> $filename);
					$params			= array_merge($params, $update_params);
					$where	  		= array(':id'=> $insert_id);
					$updatepdf 		= $objTypes->update("tbl_report_data", $params, "id = :id", $where);
				}	
			
				}

	header("location:list_report.php?sysmsg=1000&pgNo=".$pgNo);
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

	$update     = $objTypes->update("tbl_report_data", $params, "id = :id", $where);
	if($update){
		header("location:list_report.php?sysmsg=1001&pgNo=$pgNo&title=$title");
		exit();
	}
    else{
		header("location:list_report.php?sysmsg=4&pgNo=$pgNo&title=$title");
		exit();
	}
}

#==== DELETE
if(($_REQUEST['action']=="delete") && ($_REQUEST['id'] <> ""))
{
	$id		= intval($_REQUEST['id']);
	$pgNo 	= intval(base64_decode($_REQUEST['pgNo']));
// 	$title  = $_REQUEST['title'];
// 	$cat_type = $_REQUEST['cat_type'];
	$params	= array("is_delete" => '0');
	$where  = array(":id" => $id);
	$delete = $objTypes->update("tbl_report_data", $params, "id = :id", $where);
	if($delete){
		header("location:list_report.php?sysmsg=1002&pgNo=$pgNo&title=$title");
		exit();
	}else{
		header("location:list_report.php?sysmsg=4&pgNo=$pgNo&title=$title");
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
		header("location:list_report.php?sysmsg=8&pgNo=$pgNo&title=$title");
		exit();
	}
	$Delete	= implode(',', $DelCheckBox);
	$update = $objTypes->inquery("UPDATE tbl_report_data SET is_active = '1' WHERE id IN ($Delete)");

	if($update > 0){
		header("location:list_report.php?sysmsg=1012&pgNo=$pgNo&title=$title");
		exit();
	}
    else{
		header("location:list_report.php?sysmsg=13&pgNo=$pgNo&title=$title");
		exit();
	}
}

#==== DEACTIVE ALL
if(($POST['action']=="deactiveall") && ($_POST['DelCheckBox'] <> "")){
	$DelCheckBox	= $_POST['DelCheckBox'];
	$Result			= count($DelCheckBox);
	$pgNo 			= intval($_REQUEST['pgNo']);
	$title  = $_REQUEST['title'];
	$cat_type = $_REQUEST['cat_type'];

	if($Result == "0"){
		header("location:list_report.php?sysmsg=9&pgNo=$pgNo&title=$title");
		exit();
	}
    $Delete = implode(',',$DelCheckBox);
	$update = $objTypes->inquery("UPDATE tbl_report_data SET is_active = '0' WHERE id IN ($Delete)");

	if($update > 0){
		header("location:list_report.php?sysmsg=1013&pgNo=$pgNo&title=$title");
		exit();
	}
    else{
		header("location:list_report.php?sysmsg=14&pgNo=$pgNo&title=$title");
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
		header("location:list_report.php?sysmsg=10");
		exit();
	}
	$Delete = implode(',',$DelCheckBox);
	$update = $objTypes->inquery("UPDATE tbl_report_data SET is_delete = '0' WHERE id IN ($Delete)");

	if($update > 0){
		header("location:list_report.php?sysmsg=1014&title=$title");
		exit();
	}
    else{
		header("location:list_report.php?sysmsg=4&title=$title");
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