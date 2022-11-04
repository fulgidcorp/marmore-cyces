<?php
#=== Includes
ini_set('display_errors',1);

require_once("../config/config.php");
require_once("verify_logins.php");
// echo '<pre>';
// print_r($_REQUEST);
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
		'type_of_upload' => $POST['daily_research_id'],
        'date_of_upload'   =>$_POST['date_of_upload'],
        'language'     => $POST['language'],
		'is_active'			=>  1,
		'is_delete'			=>  1,
        'created_by'          => $_SESSION['SessAdminId']
		
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
		$update 	= $objTypes->update("tbl_daily_research", $params, "id = :id", $where);

		if($update){
			$insert_id	= $id;
		}
	
	}
	else{
		$insert = $objTypes->insert("tbl_daily_research", $params);
		if($insert){
			$insert_id = $objTypes->lastInsertId();
			
        }
	}
	
	if($insert_id > 0){
		$validatefiles 	= array("jpg", "bmp", "jpeg", "gif","JPG", "BMP", "JPEG", "GIF","png","PNG");
		$filetype 		= array('image/gif', 'image/jpeg','image/JPG','image/jpg', 'image/JPEG', 'image/GIF', 'image/bmp', 'image/BMP','image/png','image/PNG');
        if($POST['daily_research_id']==1)
        {
            $type = 'Weekly Wrap';
        }
        else if($POST['daily_research_id']==2)
        {
            $type = 'Daily Morning Brief';
        }
        else
        {
            $type = 'Daily Fixed Income ';
        }
        $date = date("d-m-Y",strtotime($_POST['date_of_upload']));
        //report pdf
        if(isset($_FILES['daily_research_pdf']['name']) && $_FILES['daily_research_pdf']['name'] != "")
			{			
				$ext 			= pathinfo($_FILES['daily_research_pdf']['name'], PATHINFO_EXTENSION);
				$ext			= strtolower($ext);
				$validatefiles  = array("pdf", "PDF");
				$filetype 		= array('application/pdf','application/PDF');

				if(in_array($ext, $validatefiles) == false){
					header("location:add_daily_research.php?sysmsg=35");
					exit();		
				}

				if(in_array(strtolower($_FILES['daily_research_pdf']['type']), $filetype) == false ){
					header("location:add_daily_research.php?sysmsg=35");
					exit();	
				}
				
				
				if(isset($_FILES['daily_research_pdf']['name'])){
					$ext 	  = pathinfo($_FILES['daily_research_pdf']['name'], PATHINFO_EXTENSION);
					$filename = basename($_FILES['daily_research_pdf']['name'], $ext);			
					$filename = $type.' '.$date.'.'.$ext;
					$movefile = move_uploaded_file($_FILES['daily_research_pdf']['tmp_name'], "../uploads/daily_research_pdf/".$filename);				
				}
				// echo $movefile;exit;
				$update_params  = array('pdf'=> $filename);
				$params			= array_merge($params, $update_params);
				$where	  		= array(':id'=> $insert_id);
				$updatepdf 		= $objTypes->update("tbl_daily_research", $params, "id = :id", $where);
			}	
		
			}

	header("location:list_daily_research.php?sysmsg=1000&pgNo=".$pgNo);
	exit();
}

#==== STATUS UPDATION

if(($_REQUEST['status']<>"") && ($_REQUEST['id'] <> "")){
	$statusVal  = intval($_REQUEST['status']);
	$status		= ($statusVal=='0') ? '1' : '0';
	$id			= intval($_REQUEST['id']);
	$pgNo 		= intval(base64_decode($_REQUEST['pgNo']));
	$title  = $_REQUEST['id'];
	//$cat_type = $_REQUEST['cat_type'];
    $params     = array("is_active" => $status);
	$where 		= array(":id" => $id);

	$update     = $objTypes->update("tbl_daily_research", $params, "id = :id", $where);
	if($update){
		header("location:list_daily_research.php?sysmsg=1001&pgNo=$pgNo&title=$title");
		exit();
	}
    else{
		header("location:list_daily_research.php?sysmsg=4&pgNo=$pgNo&title=$title");
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
	$delete = $objTypes->update("tbl_daily_research", $params, "id = :id", $where);
	if($delete){
		header("location:list_daily_research.php?sysmsg=1002&pgNo=$pgNo&title=$title");
		exit();
	}else{
		header("location:list_daily_research.php?sysmsg=4&pgNo=$pgNo&title=$title");
		exit();
	}
}

#==== ACTIVE ALL
if(($POST['action']=="activeall") && ($_POST['DelCheckBox'] <> "")){
	$DelCheckBox	= $_POST['DelCheckBox'];
	$Result			= count($DelCheckBox);
	$pgNo 			= intval($_REQUEST['pgNo']);
	$title  = $_REQUEST['language'];
	$cat_type = $_REQUEST['cat_type'];

	if($Result == "0"){
		header("location:list_daily_research.php?sysmsg=8&pgNo=$pgNo&title=$title");
		exit();
	}
	$Delete	= implode(',', $DelCheckBox);
	$update = $objTypes->inquery("UPDATE tbl_daily_research SET is_active = '1' WHERE id IN ($Delete)");

	if($update > 0){
		header("location:list_daily_research.php?sysmsg=1012&pgNo=$pgNo&title=$title");
		exit();
	}
    else{
		header("location:list_daily_research.php?sysmsg=13&pgNo=$pgNo&title=$title");
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
		header("location:list_daily_research.php?sysmsg=9&pgNo=$pgNo&title=$title");
		exit();
	}
    $Delete = implode(',',$DelCheckBox);
	$update = $objTypes->inquery("UPDATE tbl_daily_research SET is_active = '0' WHERE id IN ($Delete)");

	if($update > 0){
		header("location:list_daily_research.php?sysmsg=1013&pgNo=$pgNo&title=$title");
		exit();
	}
    else{
		header("location:list_daily_research.php?sysmsg=14&pgNo=$pgNo&title=$title");
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
		header("location:list_daily_research.php?sysmsg=10");
		exit();
	}
	$Delete = implode(',',$DelCheckBox);
	$update = $objTypes->inquery("UPDATE tbl_daily_research SET is_delete = '0' WHERE id IN ($Delete)");

	if($update > 0){
		header("location:list_daily_research.php?sysmsg=1014&title=$title");
		exit();
	}
    else{
		header("location:list_daily_research.php?sysmsg=4&title=$title");
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