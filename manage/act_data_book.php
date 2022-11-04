<?php
#=== Includes
ini_set('display_errors',1);

require_once("../config/config.php");
require_once("verify_logins.php");

#==== Validations For Security
//$POST		= $objTypes->validateUserInput($_POST);
$POST = $_POST;
$id 		= isset($POST['id']) ? intval($POST['id']) : intval($_REQUEST['id']) ;
$ip			= $_SERVER['REMOTE_ADDR'];
$agent		= addslashes($_SERVER['HTTP_USER_AGENT']);


#==== ADD - UPDATE - INSERT 
if(($POST['SAVE']=="SAVE")){
	$pgNo 	= intval(base64_decode($_REQUEST['pgNo']));
	$params = array(
	    'data_book_name'	=> $POST['data_book_name'],		
		'country_id'	            => $POST['country_id'],    
		'short_desc'	=> $POST['short_description'],		
        // 'long_desc'  => $POST['description'],	
        'slug' => (isset($POST['slug'])&&$POST['slug']!='') ? fixForUri($POST['slug']):fixForUri($POST['data_book_name']),
        'language'     => $POST['language'],
        'seo_title'     => $POST['seo_title'],
        'seo_desc'        => $POST['seo_desc'],
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
		$update 	= $objTypes->update("tbl_data_book", $params, "id = :id", $where);

		if($update){
			$insert_id	= $id;
		}
	}
	else{
		$insert = $objTypes->insert("tbl_data_book", $params);
		if($insert){
			$insert_id = $objTypes->lastInsertId();
		}
	}
	
	if($insert_id > 0){
		
		$validatefiles 	= array("jpg", "bmp", "jpeg", "gif","JPG", "BMP", "JPEG", "GIF","png","PNG","webm", "mp4", "ogv", "webp");
		$filetype 		= array('image/gif', 'image/jpeg','image/JPG','image/jpg', 'image/JPEG', 'image/GIF', 'image/bmp', 'image/BMP','image/png','image/PNG','image/webp','video/webm','video/mp4'.'video/ogv');
           //main image
            if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != ""){
		
			$ext 	  		= pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $ext 	  		= strtolower($ext);
			$filename 		= basename($_FILES['image']['name'], $ext);
            $filename 		= time().'.'.$ext;

			if($_FILES['image']['size'] > 3097152){
				header("location:add_data_book.php?sysmsg=16&id=".$insert_id);
                exit();
            }

            if(in_array($ext, $validatefiles) == false){
                header("location:add_data_book.php?sysmsg=11&id=".$insert_id);
                exit();
            }

			if(in_array(strtolower($_FILES['image']['type']), $filetype) == false ){
                header("location:add_data_book.php?sysmsg=11&id=".$insert_id);
                exit();
            }

			$where      = array(':id' => $insert_id);
			

			if(move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/databook_images/".$filename))
			{
				// $path 		= "../uploads/databook_images/".$filename;
				// $main_image = "../uploads/databook_images/main_".$filename;
				// $main_width	= "350";
				// $main_height= "260";

				// $magicianObj = new imageLib($path);
				// //$magicianObj->resizeImage($main_width, $main_height);
				// $magicianObj->saveImage($main_image, 100);

			//	$thumb_image = "../uploads/databook_images/thumb_".$filename;
				// $thumb_width = "374";
				// $thumb_height= "251";

				// $magicianObj2 = new imageLib($path);
				// //$magicianObj2->resizeImage($thumb_width, $thumb_height);
				// $magicianObj2->saveImage($thumb_image, 100);

				$img_params = array('image' => $filename);
				$update     = $objTypes->update("tbl_data_book", $img_params, "id = :id", $where);	
			}
			else{
				header("location:add_data_book.php?sysmsg=1003&id=".$insert_id);
				exit();
			}
		}
		
			//databook pdf
        if(isset($_FILES['databook_pdf']['name']) && $_FILES['databook_pdf']['name'] != "")
			{			
				$ext 			= pathinfo($_FILES['databook_pdf']['name'], PATHINFO_EXTENSION);
				$ext			= strtolower($ext);
				$validatefiles  = array("pdf", "PDF");
				$filetype 		= array('application/pdf','application/PDF');

				if(in_array($ext, $validatefiles) == false){
					header("location:add_data_book.php?sysmsg=35");
					exit();		
				}

				if(in_array(strtolower($_FILES['databook_pdf']['type']), $filetype) == false ){
					header("location:add_data_book.php?sysmsg=35");
					exit();	
				}
				
				
				if(isset($_FILES['databook_pdf']['name'])){
					$ext 	  = pathinfo($_FILES['databook_pdf']['name'], PATHINFO_EXTENSION);
					$filename = basename($_FILES['databook_pdf']['name'], $ext);			
					$filename = 'report_'.time().'.'.$ext;
					$movefile = move_uploaded_file($_FILES['databook_pdf']['tmp_name'], "../uploads/databook_images/".$filename);				
				}
				$update_params  = array('databook_pdf'=> $filename);
				$params			= array_merge($params, $update_params);
				$where	  		= array(':id'=> $insert_id);
				$updatepdf 		= $objTypes->update("tbl_data_book", $params, "id = :id", $where);
			}

		//for multiple 
				$counter = 0;
				if($_FILES['mul_image']['error'][0]==0)
				{							
					$where      = array(':data_book_id' => $insert_id);
					$i = 1 ;
					foreach($_FILES["mul_image"]["tmp_name"] as $key=>$tmp_name){
						 $temp = $_FILES["mul_image"]["tmp_name"][$key];
						 $name = $_FILES["mul_image"]["name"][$key];

						$ext 	  		= pathinfo($name, PATHINFO_EXTENSION);
						$ext 	  		= strtolower($ext);
						$filename 		= basename($name, $ext);
						$filename 		= $i.time().'.'.$ext;
					
					$counter++;
					$UploadOk = true;
                     
					if(move_uploaded_file($temp, "../uploads/databook_images/".$filename)){
						$path 		= "../uploads/databook_images/".$filename;
						$main_image = "../uploads/databook_images/main_".$filename;
						//$main_width	= "545";
						//$main_height= "367";

						//$magicianObj = new imageLib($path);
						//$magicianObj->resizeImage($main_width, $main_height);
						//$magicianObj->saveImage($main_image, 100);

					//	$thumb_image = "../uploads/databook_images/thumb_".$filename;
				// 		$thumb_width = "374";
				// 		$thumb_height= "251";

						//$magicianObj2 = new imageLib($path);
						//$magicianObj2->resizeImage($thumb_width, $thumb_height);
						//$magicianObj2->saveImage($thumb_image, 100);

							$img_params = array('url' => $filename, 'data_book_id' => $insert_id);
							//print_r($img_params); exit;
							$insert = $objTypes->insert("tbl_databook_images", $img_params);
						}
						$i++;
					}
				}else{
				header("location:add_data_book.php?sysmsg=1000&id=".$insert_id);
				exit();
			}
			
			
	
	}
		header("location:list_data_book.php?sysmsg=1000&pgNo=".$pgNo);
		exit();
		
}


#==== Image Removal
if(($_REQUEST['param']<>"") && ($_REQUEST['id'] <> "")){
    $id		 = intval($_REQUEST['id']);
    $prodid  = intval($_REQUEST['prodid']);
    $where 	 = array(":id" => $id);
    $pgNo 	 = intval(base64_decode($_REQUEST['pgNo']));

    $sql     = "SELECT url FROM tbl_databook_images WHERE id = :id";
    $image   = $objTypes->fetchRow($sql, $where);
    unlink("../uploads/databook_images/".str_replace('main_', '', $image['image']));
	unlink("../uploads/databook_images/".$image['image']);

    $delete  = $objTypes->delete("tbl_databook_images", "id = :id", $where);
    if($delete){
        header("location:add_data_book.php?sysmsg=1018&id=".$prodid."&pgNo=".$pgNo);
		exit();
    }
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

	$update     = $objTypes->update("tbl_data_book", $params, "id = :id", $where);
	if($update){
		header("location:list_data_book.php?sysmsg=1001&pgNo=$pgNo&title=$title");
		exit();
	}
    else{
		header("location:list_data_book.php?sysmsg=4&pgNo=$pgNo&title=$title");
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
	$delete = $objTypes->update("tbl_data_book", $params, "id = :id", $where);
	if($delete){
		header("location:list_data_book.php?sysmsg=1002&pgNo=$pgNo&title=$title");
		exit();
	}else{
		header("location:list_data_book.php?sysmsg=4&pgNo=$pgNo&title=$title");
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
		header("location:list_data_book.php?sysmsg=8&pgNo=$pgNo&title=$title");
		exit();
	}
	$Delete	= implode(',', $DelCheckBox);
	$update = $objTypes->inquery("UPDATE tbl_data_book SET is_active = '1' WHERE id IN ($Delete)");

	if($update > 0){
		header("location:list_data_book.php?sysmsg=1012&pgNo=$pgNo&title=$title");
		exit();
	}
    else{
		header("location:list_data_book.php?sysmsg=13&pgNo=$pgNo&title=$title");
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
		header("location:list_data_book.php?sysmsg=9&pgNo=$pgNo&title=$title");
		exit();
	}
    $Delete = implode(',',$DelCheckBox);
	$update = $objTypes->inquery("UPDATE tbl_data_book SET is_active = '0' WHERE id IN ($Delete)");

	if($update > 0){
		header("location:list_data_book.php?sysmsg=1013&pgNo=$pgNo&title=$title");
		exit();
	}
    else{
		header("location:list_data_book.php?sysmsg=14&pgNo=$pgNo&title=$title");
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
		header("location:list_data_book.php?sysmsg=10");
		exit();
	}
	$Delete = implode(',',$DelCheckBox);
	$update = $objTypes->inquery("UPDATE tbl_data_book SET is_delete = '0' WHERE id IN ($Delete)");

	if($update > 0){
		header("location:list_data_book.php?sysmsg=1014&title=$title");
		exit();
	}
    else{
		header("location:list_data_book.php?sysmsg=4&title=$title");
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