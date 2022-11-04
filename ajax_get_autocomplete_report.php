<?php
#=== Includes
ini_set('display_errors',1);
require_once("config/config.php");

#==== Validations For Security
$POST		= $objTypes->validateUserInput($_POST);
$autocompleteSearch = isset($POST['keyword'])?$POST['keyword']:'';

//auto search report
if(isset($autocompleteSearch))
{
    $report_list = "select id,report_name,created_date,is_active,is_delete,report_images,wp_slug from tbl_report_data where is_active=1 and is_delete=1 and report_name LIKE '%".$autocompleteSearch."%' order by created_date DESC";
}
$TypeArray	= $objTypes->fetchAll($report_list);

$html = ''; 
if(sizeof($TypeArray) > 0){
    $html .='<div class="col-md-12">
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
                                // $report_image = base_url.'uploads/report_images/'.$reports['report_image'];
                                 $wp_slug = base_url.'en/reports/'.$reports['wp_slug'];
                        $html .='<div class="col-lg-4 blog_1">
                            <div class="card blog-b border" onclick="window.location.href=\''.base_url.'en/reports/'.$reports['wp_slug'].'\'">
                                <img class="card-img-top" src='.$img.' alt='.$reports['report_name'].'>
                                <div class="card-body ">
                                    <a href='.$wp_slug.'><h4 class="card-title card_3">'.$reports['report_name'].'</h4></a>
                                    <p class="gray" >'.date("F d, Y",strtotime($reports['created_date'])).'
                                    </p>
                                </div>
                            </div>
                        </div>';
                       } } 
                   $html .='</div>
                </div>
                </div>';
}
else
{
    $html .='<h1>No results found!</h1>';
}

echo $html;