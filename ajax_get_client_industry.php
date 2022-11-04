<?php
// echo 'ajax_call';
// exit;
// echo '<pre>';
// print_r($_POST);exit;
#=== Includes
//ini_set('display_errors',1);
require_once("config/config.php");
#==== Validations For Security
//$POST		= $objTypes->validateUserInput($_POST);
$id = isset($_POST['client_industry'])?$_POST['client_industry']:'';
// echo $id;exit;
//category only
if(isset($_POST['client_industry']) && !empty($_POST['client_industry']) && $_POST['client_industry']!='All')
{
   $client_list = "select a.*,b.* from tbl_industry a right join tbl_client_stories b ON a.id=b.client_industry_id where b.is_active=1 and b.is_delete=1 and client_industry_id=$id";
}
else
{
  $client_list = "select a.*,b.* from tbl_industry a right join tbl_client_stories b ON a.id=b.client_industry_id where b.is_active=1 and b.is_delete=1";
}
   $TypeArray	= $objTypes->fetchAll($client_list);

// echo '<pre>';
// print_r($TypeArray);
// exit;

$html = ''; 
if(count(array($TypeArray)) > 0){
    $html .=' <div class="card1" style="padding-top: 40px;" id="report_client_industry_search_div">
                    <div class="row">';
                    if(isset($TypeArray) && !empty($TypeArray)) 
                               { 
                                   foreach($TypeArray as $val)
                                    {
                                        $blog_image = pathinfo($val['image']);
                                    
                         if(isset($val['image']) && !isset($blog_image['dirname']) && !empty($val['image']))
                          {
                              $img = base_url.'uploads/client_images/'.$val['image'];
                          }
                         else if(isset($val['image']) && isset($blog_image['dirname']))
                          {
                              $img = $val['image'];
                          }
                          else
                          {
                              $img = base_url.'uploads/blog_images/Group160532.png';
                          }
                        $html .='<div class="col-lg-4">
                            <div class="card card_m" onclick="window.location.href=\''.base_url.'en/clients/'.$val['slug'].'\'">
                                <img class="card-img-top" src='.$img.' alt="Card image" style="width:100%">
                                <div class="card-body card_client">
                                    <a href='.base_url.'en/clients/'.$val['slug'].' class="btn-link">'.$val['title'].'</a>
                                    <h4 class="card-title card_client" style="margin-top: 5px; font-weight: bold;">'.$val['story_title'].'</h4>
                                    <p class="card-text" style="padding: 0px;">'.$val['story_desc'].'
                                    </p>
                                    <a href='.base_url.'en/clients/'.$val['slug'].' class="hvr-icon-forward btn-link">Read More </a>
                                </div>
                            </div>
                        </div>';
                 } } 
                    
                    $html .='</div>
                   
                </div>';
	
} else
{
    $html .='<h1>No results found!</h1>';
}
				
echo $html;