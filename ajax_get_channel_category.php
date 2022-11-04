<?php
// ini_set('display_errors',1);
// echo 'ajax_call';
// exit;
// echo '<pre>';
// print_r($_POST);exit;
#=== Includes
//ini_set('display_errors',1);
require_once("config/config.php");
#==== Validations For Security
//$POST		= $objTypes->validateUserInput($_POST);
$id = isset($_POST['channel_category'])?$_POST['channel_category']:'';
// echo $id;exit;
//category only
if(isset($_POST['channel_category']) && !empty($_POST['channel_category']) && $_POST['channel_category']!='All')
{
   $client_list = "select a.*,b.* from tbl_channel_category a right join tbl_channel b ON a.id=b.category_id where b.is_active=1 and b.is_delete=1 and b.category_id='$id' order by b.channel_date DESC";
$html .= $client_list;

}
else
{
  $client_list = "select a.*,b.* from tbl_channel_category a right join tbl_channel b ON a.id=b.category_id where b.is_active=1 and b.is_delete=1 order by b.channel_date DESC";
}
$TypeArray	= $objTypes->fetchAll($client_list);
$html = ''; 
if(count(array($TypeArray)) > 0){
   $html .=' <div class="card1" style="padding: 40px 0 0;" id="report_client_industry_search_div">
                    <div class="row">';
                    if(isset($TypeArray) && !empty($TypeArray)) 
                               { 
                                   foreach($TypeArray as $val)
                                    {
                                        $blog_image = pathinfo($val['image']);
                                    
                         if(isset($val['image']) && isset($blog_image['dirname']) && $blog_image['dirname']=='.')
                          {
                              $img = base_url.'uploads/channel_image/'.$val['image'];
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
                            <div class="card card_m">
                                <iframe src='.$val['video'].'  height="600px"></iframe>  
                                <div class="card-body card_client">
                                    <a class="btn-link">'.$val['category_name'].'</a>
                                    <h4 class="card-title card_client" style="margin-top: 5px; font-weight: bold;">'.$val['channel_title'].'</h4>
                                    <span>'.date("F d, Y",strtotime($val['channel_date'])).'</span>
                                    <p class="card-text scroller" style="height: 150px !important;overflow-y: scroll;">
                                       '.$val['short_desc'].'
                                    </p>
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