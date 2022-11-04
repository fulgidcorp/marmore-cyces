<?php
	ob_start();
	session_start();
	//error_reporting(0);
	error_reporting(E_ALL);
	#===== DBCONFIG START
    define("DB_HOST", "localhost");
    define("DB_USER", "cycesskf_stagingmarmore");
    define("DB_PASS", 'marmore@123!');
    define("DB_DATABASE", "cycesskf_marmore");
    $con = mysqli_connect('localhost', 'cycesskf_stagingmarmore', 'marmore@123!', 'cycesskf_marmore');


	#===== PROTOCOL.
	if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')
	{
		$protocol = 'https://';
	}
	else
	{
		 $protocol = 'http://';
	}

	#==== Base URL
	define('base_url' , $protocol.$_SERVER['SERVER_NAME'].preg_replace('@/+$@','',dirname($_SERVER['SCRIPT_NAME'])).'/');
    #====== SITE PATH START
    define("DIR_ROOT", $_SERVER['DOCUMENT_ROOT']."/");      //DIR PATH
    define("SITE_ROOT", $protocol.$_SERVER['HTTP_HOST']."/"); // IP

    #===== SITE ADMIN PATH START
    define("ADMIN_DIR", $_SERVER['DOCUMENT_ROOT'].dirname($_SERVER['REQUEST_URI']));
    define("ADMIN_SITE", $protocol.$_SERVER['HTTP_HOST'].dirname($_SERVER['REQUEST_URI']));


  	define("ADMIN_COUNT",10);
	define("MANDATORY","&nbsp;&nbsp;<SPAN STYLE='color:#FF0000'><sup>*</sup></span>");

 	include_once(DIR_ROOT."/class/load_utility.php");
 	include_once(DIR_ROOT."/class/sysmsg.php");
 	include_once(DIR_ROOT."/class/php_image_magician.php");

	$objSystemMsg = new systemMsg();
	$objTypes 	  = new load_utility('mysql:dbname='.DB_DATABASE.';host='.DB_HOST.';charset=UTF8', DB_USER, DB_PASS);
	@$sysmsg 	  = intval($_REQUEST['sysmsg']);
	
// 	$UrlTitle	  = strip_tags($_REQUEST['title'] ?? ""); 
// 	$UrlId		  = intval($_REQUEST['id']?? "");
// 	$UrlCatName	  = strip_tags($_REQUEST['cat_name']?? "");
	
// 	$usernameSmtp = 'AKIAYKD5OHVSDULXTX4M';
// 	$passwordSmtp = 'BNHzS+sG/eBzFA8D70pUguuwRdPIHtnM+doBsNbQI4Xe';
	

function DOMinnerHTML($element) 
{ 
    $innerHTML = ""; 
    $children  = $element->childNodes;

    foreach ($children as $child) 
    { 
        $innerHTML .= $element->ownerDocument->saveHTML($child);
    }

    return $innerHTML; 
} 

function strip_xss_data($html){
    
    if(!empty($html)){

    $dom = new DOMDocument();
    
    $dom->loadHTML($html);
    
    $script = $dom->getElementsByTagName('*');
    
    $remove_tags = ["script", "noscript", "link"];
    
    $element_allowed_attributes = ["href", "class", "style"];
    $allowed_attributes_regex = [ "href"=>"^(?!javascript:).+" ];
    
    $remove_elements = [];
    foreach($script as $item)
    {
    
      if(in_array($item->tagName, $remove_tags)){
          $remove_elements[] = $item;
      }else{
      
          $remove_attributes = [];
      
          $attributes = $item->attributes;
          
          foreach($attributes as $attribute){
              $attribute_name = $attribute->name;
              if((!in_array( $attribute_name,  $element_allowed_attributes)) or (array_key_exists($attribute_name, $allowed_attributes_regex) && !preg_match("/".$allowed_attributes_regex[$attribute_name]."/",$item->getAttribute($attribute_name)) )){
                  $remove_attributes[] = $attribute_name;
              }
    
          }
          
          foreach($remove_attributes as $attribute){
              $item->removeAttribute($attribute);
          }
      }
      
    }


    foreach($remove_elements as $item){
        $item->parentNode->removeChild($item);
    }

    $body = $dom->getElementsByTagName('body')[0];
    return DOMinnerHTML($body);
    
    }
    
    
    
    return $html;

}


function replace_request_escape_sequence($string){

    $string = str_replace("\\r\\n","\r\n",$string);
    $string = str_replace("\\n","\n", $string);
    return str_replace("\\t","\t", $string);

}

function filter_data($arr){
    $temp_request=[];
 
    foreach($arr as $key => $value){
        if(is_array($value)){
            $temp_array = [];
            
                $temp_request[strip_tags($key)] = filter_data($value);
        }else {
            
                if (is_bool($value)){
                    $temp_request[strip_tags($key)] = $value;
                }else{
                    $temp_request[strip_tags($key)] = replace_request_escape_sequence(strip_tags($value, "<ul><ol><li>"));
                }

        }
    }
    

    return $temp_request;
}


function sanitize_request_data(){
    global $_REQUEST, $_GET;
    
    $_REQUEST = filter_data($_REQUEST);
    //$_POST = filter_data($_POST);
    $_GET = filter_data($_GET);

}

sanitize_request_data();
	
?>