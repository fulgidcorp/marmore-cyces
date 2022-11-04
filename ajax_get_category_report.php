<?php
// echo 'ajax_call';
// exit;
// echo '<pre>';
// print_r($_POST);
#=== Includes
// ini_set('display_errors',1);
require_once("config/config.php");
#==== Validations For Security
$POST		= $objTypes->validateUserInput($_POST);
$id = isset($POST['category'])?$POST['category']:'';
$country = isset($POST['country'])?$POST['country']:'';
//category only
if(isset($_POST['category']) && empty($_POST['country']))
{
$report = "'".implode("','", $_POST['category'])."'";
$report_list   = "select * from tbl_report_data where is_active=1 and is_delete=1 and report_industry IN ($report) order by report_date DESC";
    //$report_list   = "select r.*,rc.id from tbl_report r left join tbl_report_category rc on r.report_category_id=rc.id where r.is_active = 1 and r.is_delete = 1 and r.report_category_id IN (".$id.")";
}
//country only
// if(isset($_POST['country']) && empty($_POST['category']))
// {
//     $report_list   = "select r.*,cm.report_id,cm.country_id from tbl_report r left join tbl_report_country_mapping cm on r.id=cm.report_id where r.is_active = 1 and r.is_delete = 1 and cm.country_id IN (".$country.") GROUP BY cm.report_id";
// }
if(isset($_POST['country']) && empty($_POST['category']))
{
    $country = "'".implode("','", $_POST['country'])."'";
    $report_list   = "select * from tbl_report_data where is_active=1 and is_delete=1 and report_country IN ($country) order by report_date DESC";
}
//category and country
if(isset($_POST['country']) && isset($_POST['category']))
{
    $report = "'".implode("','", $_POST['category'])."'";
    $country = "'".implode("','", $_POST['country'])."'";
    $report_list   = "select * from tbl_report_data where is_active=1 and is_delete=1 and report_country IN ($country) and report_industry IN ($report) order by report_date DESC";
   
    //$report_list   = "select r.*,cm.report_id,cm.country_id,rc.id from tbl_report r left join tbl_report_country_mapping cm on r.id=cm.report_id left join tbl_report_category rc on r.report_category_id=rc.id where r.is_active = 1 and r.is_delete = 1 and r.report_category_id IN (".$id.") and cm.country_id IN (".$country.") GROUP BY cm.report_id";
}
$TypeArray	= $objTypes->fetchAll($report_list);
// echo '<pre>';
// print_r($TypeArray);
// exit;

$html = ''; 
if(sizeof($TypeArray) > 0){
    $html .='<div class="col-md-12" id="report_category_search_div">

                    <div class="tabout tabout1">
                        <h2 class="title b_title">Research Reports</h3>
                            <p class="text-left paratext"></p>
                    </div>
                    <div class="report-card">
                    <div class="row relative-report blogs">';
                          if(isset($TypeArray) && !empty($TypeArray))
                          {
                             foreach($TypeArray as $reports)
                             {
                                 $blog_image = pathinfo($reports['report_images']);
                                    
                                 if(isset($reports['report_images']) && isset($blog_image['dirname']) && $blog_image['dirname']=='.')
                                  {
                                      $img = base_url.'uploads/report_images/'.$reports['report_images'];
                                  }
                                  else if(isset($reports['report_images']) && isset($blog_image['dirname']))
                                  {
                                      $img = $reports['report_images'];
                                  }
                                  else
                                  {
                                      $img = base_url.'uploads/blog_images/Group 160532.png';
                                  }
                                 $report_image = $img;
                                 $wp_slug = base_url.'en/reports/'.$reports['wp_slug'];
                                
                                 $html .='<div class="col-lg-4 blog_1">
                                     <div class="card blog-b border"
                                         onclick="window.location.href=\''.base_url.'en/reports/'.$reports['wp_slug'].'\'">
                                         <img class="card-img-top" src='.$report_image.' alt='.$reports['
                                             report_name'].'>
                                         <div class="card-body ">
                                             <a href='.$wp_slug.'>
                                                 <h4 class="card-title card_3">'.$reports['report_name'].'</h4>
                                             </a>
                                             <p class="gray">'.date("F d, Y",strtotime($reports['created_date'])).'
                                             </p>

                                         </div>
                                     </div>
                                 </div>';
                       } } 
                   $html .='</div>
                </div>
                </div>';
	
} else
{
    $html .='<h1>No results found!</h1>';
}
				
echo $html;