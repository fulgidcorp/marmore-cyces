<?php
#=== Includes
 ini_set('display_errors',1);

require_once("../config/config.php");
require_once("verify_logins.php");

#==== Validations For Security
//$POST		= $objTypes->validateUserInput($_POST);
$POST		= $_POST;
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
		'story_title'	    => $POST['story_title'],
		'title_1'	    => $POST['title_1'],
		'long_desc'	=> $POST['long_desc'],
		'title_2'	    => $POST['title_2'],
		'long_desc_2'	=> $POST['long_desc_2'],
		'title_3'	    => $POST['title_3'],
		'long_desc_3'	=> $POST['long_desc_3'],
		'client_category' => $POST['client_category'],
		'language'     => $POST['language'],
		'client_industry_id' => $POST['client_industry_id'],
		'is_popular'=> (isset($POST['is_popular']) && $POST['is_popular']=='on') ? '1':'0',
		 'slug' => (isset($POST['slug'])&&$POST['slug']!='') ? fixForUri($POST['slug']):fixForUri($POST['story_title']),
        'seo_title'     => $POST['seo_title'],
        'seo_desc'        => $POST['seo_desc'],
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
		$update 	= $objTypes->update("tbl_client_stories", $params, "id = :id", $where);

		if($update){
			$insert_id	= $id;
		}
	}
	else{
		$insert = $objTypes->insert("tbl_client_stories", $params);
		if($insert){
			$insert_id = $objTypes->lastInsertId();
		}
	}
	
	if($insert_id > 0){
		
		$validatefiles 	= array("jpg", "bmp", "jpeg", "gif","JPG", "BMP", "JPEG", "GIF","png","PNG");
		$filetype 		= array('image/gif', 'image/jpeg','image/JPG','image/jpg', 'image/JPEG', 'image/GIF', 'image/bmp', 'image/BMP','image/png','image/PNG');
		if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != ""){
			$ext 	  		= pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $ext 	  		= strtolower($ext);
			$filename 		= basename($_FILES['image']['name'], $ext);
            $filename 		= time().'.'.$ext;
	
			if($_FILES['image']['size'] > 3097152){
				header("location:add_client_story.php?sysmsg=16&id=".$insert_id);
                exit();
            }

            if(in_array($ext, $validatefiles) == false){
                header("location:add_client_story.php?sysmsg=11&id=".$insert_id);
                exit();
            }

			if(in_array(strtolower($_FILES['image']['type']), $filetype) == false ){
                header("location:add_client_story.php?sysmsg=11&id=".$insert_id);
                exit();
            }

			$where      = array(':id' => $insert_id);
			/*$imagename	= $objTypes->fetchRow("SELECT image, thumbnail FROM tbl_truck_product_types WHERE id = :id", $where);
			unlink("../uploads/truck_images/product_types/".str_replace('main_', '', $imagename['image']));
			unlink("../uploads/truck_images/product_types/".$imagename['image']);
			unlink("../uploads/truck_images/product_types/".$imagename['thumbnail']);*/

			if(move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/client_images/".$filename)){
				$path 		= "../uploads/client_images/".$filename;
				$main_image = "../uploads/client_images/main_".$filename;
				// $main_width	= "545";
				// $main_height= "367";

				$magicianObj = new imageLib($path);
				//$magicianObj->resizeImage($main_width, $main_height);
				$magicianObj->saveImage($main_image, 100);

				$thumb_image = "../uploads/client_images/thumb_".$filename;
				// $thumb_width = "374";
				// $thumb_height= "251";

				$magicianObj2 = new imageLib($path);
				//$magicianObj2->resizeImage($thumb_width, $thumb_height);
				$magicianObj2->saveImage($thumb_image, 100);

				$img_params = array('image' => 'main_'.$filename,'thumnail_image' => 'thumb_'.$filename);
				$update     = $objTypes->update("tbl_client_stories", $img_params, "id = :id", $where);
			}
			else{
				header("location:add_client_story.php?sysmsg=1003&id=".$insert_id);
				exit();
			}
		}
		
	}

	header("location:list_client_story.php?sysmsg=1000&pgNo=".$pgNo);
	exit();
}

#==== STATUS UPDATION
if(($_REQUEST['status']<>"") && ($_REQUEST['id'] <> "")){
	$statusVal  = intval($_REQUEST['status']);
	$status		= ($statusVal=='0') ? '1' : '0';
	$id			= intval($_REQUEST['id']);
	$pgNo 		= intval(base64_decode($_REQUEST['pgNo']));
	$title  = $_REQUEST['story_title'];
    $params     = array("is_active" => $status);
	$where 		= array(":id" => $id);

	$update     = $objTypes->update("tbl_client_stories", $params, "id = :id", $where);
	if($update){
		header("location:list_client_story.php?sysmsg=1001&pgNo=$pgNo&title=$title");
		exit();
	}
    else{
		header("location:list_client_story.php?sysmsg=4&pgNo=$pgNo&title=$title");
		exit();
	}
}

#==== DELETE
if(($_REQUEST['action']=="delete") && ($_REQUEST['id'] <> ""))
{
	$id		= intval($_REQUEST['id']);
	$pgNo 	= intval(base64_decode($_REQUEST['pgNo']));
	$title  = $_REQUEST['story_title'];
	$cat_type = $_REQUEST['cat_type'];
	$params	= array("is_delete" => '0');
	$where  = array(":id" => $id);
	$delete = $objTypes->update("tbl_client_stories", $params, "id = :id", $where);
	if($delete){
		header("location:list_client_story.php?sysmsg=1002&pgNo=$pgNo&title=$title");
		exit();
	}else{
		header("location:list_client_story.php?sysmsg=4&pgNo=$pgNo&title=$title");
		exit();
	}
}

#==== ACTIVE ALL
if(($POST['action']=="activeall") && ($_POST['DelCheckBox'] <> "")){
	$DelCheckBox	= $_POST['DelCheckBox'];
	$Result			= count($DelCheckBox);
	$pgNo 			= intval($_REQUEST['pgNo']);
	$title  = $_REQUEST['title'];
	

	if($Result == "0"){
		header("location:list_client_story.php?sysmsg=8&pgNo=$pgNo&title=$title");
		exit();
	}
	$Delete	= implode(',', $DelCheckBox);
	$update = $objTypes->inquery("UPDATE tbl_client_stories SET is_active = '1' WHERE id IN ($Delete)");

	if($update > 0){
		header("location:list_client_story.php?sysmsg=1012&pgNo=$pgNo&title=$title");
		exit();
	}
    else{
		header("location:list_client_story.php?sysmsg=13&pgNo=$pgNo&title=$title");
		exit();
	}
}

#==== DEACTIVE ALL
if(($POST['action']=="deactiveall") && ($_POST['DelCheckBox'] <> "")){
	$DelCheckBox	= $_POST['DelCheckBox'];
	$Result			= count($DelCheckBox);
	$pgNo 			= intval($_REQUEST['pgNo']);
	$title  = $_REQUEST['story_title'];
	$cat_type = $_REQUEST['cat_type'];

	if($Result == "0"){
		header("location:list_client_story.php?sysmsg=9&pgNo=$pgNo&title=$title");
		exit();
	}
    $Delete = implode(',',$DelCheckBox);
	$update = $objTypes->inquery("UPDATE tbl_client_stories SET is_active = '0' WHERE id IN ($Delete)");

	if($update > 0){
		header("location:list_client_story.php?sysmsg=1013&pgNo=$pgNo&title=$title");
		exit();
	}
    else{
		header("location:list_client_story.php?sysmsg=14&pgNo=$pgNo&title=$title");
		exit();
	}
}

#==== DELETE  ALL
if(($POST['action']=="deleteall") && ($_POST['DelCheckBox'] <> "")){
	$DelCheckBox	= $_POST['DelCheckBox'];
	$Result			= count($DelCheckBox);
	$title  = $_REQUEST['story_title'];
	$cat_type = $_REQUEST['cat_type'];

	if($Result == "0"){
		header("location:list_client_story.php?sysmsg=10");
		exit();
	}
	$Delete = implode(',',$DelCheckBox);
	$update = $objTypes->inquery("UPDATE tbl_client_stories SET is_delete = '0' WHERE id IN ($Delete)");

	if($update > 0){
		header("location:list_client_story.php?sysmsg=1014&title=$title");
		exit();
	}
    else{
		header("location:list_client_story.php?sysmsg=4&title=$title");
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