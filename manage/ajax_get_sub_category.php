<?php
#=== Includes
ini_set('display_errors',1);
require_once("../config/config.php");
require_once("verify_logins.php");
#===== PROTOCOL.
if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')
{
	$protocol = 'https://';
}
else
{
	 $protocol = 'http://';
}
define('base_url' , $protocol.$_SERVER['SERVER_NAME'].preg_replace('@/+$@','',dirname($_SERVER['SCRIPT_NAME'])).'/');
// echo '<pre>';
// print_r($_POST);exit;
#==== Validations For Security
$POST		= $objTypes->validateUserInput($_POST);
$id 		= isset($POST['id']) ? intval($POST['id']) : intval($_REQUEST['id']) ;
$params     = array(":report_category_id" => $id,":is_active" => 1);
$TypeArray	= $objTypes->fetchAll("SELECT id, report_sub_category_name, report_category_id FROM tbl_report_sub_category WHERE report_category_id = :report_category_id and is_active = :is_active", $params);
// $subcategory_list   = "select rsc.*,rscm.* from tbl_report_sub_category rsc left join tbl_report_subcategory_mapping rscm on rsc.id=rscm.report_subcategory_id where rsc.is_active = 1 and rsc.is_delete = 1 and rsc.report_category_id='".$id."'";
// $TypeArray	= $objTypes->fetchAll($subcategory_list);
// echo '<pre>';
// print_r($TypeArray);exit;
$html = ''; 
if(sizeof($TypeArray) > 0){
	$html .='<label for="exampleInputEmail1">Sub Category</label><select class="form-control" name="product_type_id[]" id="product_type_id" style="width: 40%" multiple="multiple">
				<option value="">Select Sub Category</option>';			
					foreach($TypeArray as $prod_v){   
					    if($prod_v['report_sub_category_name']!='' && $prod_v['report_sub_category_name']!=NULL)
                            {
						$html .='<option value="'.$prod_v['id'].'" >'.$prod_v['report_sub_category_name'].'</option>';
                            }
				   }			
	$html .='</select>';
}
				
echo $html; 