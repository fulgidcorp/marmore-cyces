<?php
ini_set('display_errors', 1);
require("../config/config.php");
// include("manager.php");
// if(isset($_SESSION['role']) && $_SESSION['role']>0){
//     echo '';
// }else{
//     http_response_code(401);
//     require("login.php");
//     exit;
// }
// echo '<pre>';
// print_r($_SERVER['REQUEST_METHOD']);
// exit;
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') { 
    $inputJSON =  file_get_contents('php://input');
    $input = json_decode($inputJSON, TRUE);
    // file delete for single file/single file with name 
    if($input['code'] === 'single_file' || $input['code'] === 'single_file_with_name')
    {
      $jsondata = $_SERVER['DOCUMENT_ROOT'].$input['data']['file_src'];
      unlink($jsondata);
    }
    mysqli_query($con,"DELETE FROM `tbl_page_contents` WHERE `tbl_page_contents`.`id`=".mysqli_real_escape_string($con,$input['id']));
}else if(isset($_FILES['file']) && is_uploaded_file($_FILES['file']['tmp_name'])){
    $target_dir = "../uploads/files/";
    $files_to_receive = array("upload_banner_img");
    $supported_files= array("jpg","png","jpeg","gif","pdf","doc","docx","txt","csv","mp4","3gp","mov","wmv","avi","xlsx","xls","rtf","xla","ppt","pptx","aac","mp3");
    $target_file = $target_dir.basename($_FILES["file"]["name"]);
    $target_file = str_replace(' ', '_', $target_file);
    $fFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if(in_array($fFileType,$supported_files) ) {
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)){
            echo '{"file":"'.substr($target_file,2).'"}';
        }else{
            echo '{"status":"failed"}';
        }
    }
        
}else if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $inputJSON = file_get_contents('php://input');
    
    $input = json_decode($inputJSON, TRUE);
    $idd = $input['page_id'];
    $code = $input['code'];
    //$inputJSON = json_encode(filter_data($input), JSON_UNESCAPED_UNICODE);
    if($input['id']=='' || $input['id']==null){
        $query="INSERT INTO `tbl_page_contents` ( `page_id`,`indx`, `code`, `data`) VALUES ('$idd','1', '$code', '".mysqli_real_escape_string($con,$inputJSON)."')";
    }else{
        $idd = $input['id'];
        $query="UPDATE `tbl_page_contents` SET `data` = '".mysqli_real_escape_string($con,$inputJSON)."' WHERE `tbl_page_contents`.`id` =".$idd;
    }
    if(!mysqli_query($con,$query)){
        echo json_encode(["status"=>"success", "inputjson"=> $inputJSON]);
    }else{
        echo '{"status":"failed","query":"'.$query.'"}';
    }

}
