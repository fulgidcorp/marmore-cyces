<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

function not_authorized(){
    http_response_code(403);
    echo "<title>Unauthorized</title>";
    echo "<h1>403 Not Authorized.</h1>";
    exit;
}

function get_php_name($url, $query_url=""){
    return str_replace(".php","",basename($url, '?' . $query_url));
}



if(isset($_SESSION['SessAdminId']))
{
	$admin_id = $_SESSION['SessAdminId'];
	
	$fileName = get_php_name($_SERVER['REQUEST_URI'],$_SERVER['QUERY_STRING']);
	    
	$fileName = str_replace("export_","list_",$fileName);
	
	$fileName = str_replace("act_","list_",$fileName);
	
	$fileName = str_replace("add_","list_",$fileName);

	
	if($admin_id!=1 && $fileName!="dashboard" && $fileName!="changepassword")
	{

	    
	    $AdminArray	= $objTypes->fetchAll("SELECT  * FROM `tbl_admin`  WHERE id=".$_SESSION['SessAdminId']);
	    
	    $departments = $AdminArray[0]['department'];
	    $departments = explode(",", $departments);
	    
	    
	    $PageArray	= $objTypes->fetchAll("SELECT  menu_id FROM `tbl_adminsubmenu`  WHERE file_name='$fileName'");
	    
	    if(isset($PageArray[0])){
	        $menu_id = $PageArray[0]['menu_id'];
	    }else{
	        not_authorized();
	    }

	    
	    if(in_array($menu_id,$departments)){
	        //Do nothing
	    }else{
	        not_authorized();
	    }
	    
	    
	}
	
}else{
    //header("location: index.php");
    not_authorized();
}
?>
