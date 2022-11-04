<?php
#=== Includes
ini_set('display_errors',1);
require_once("config/config.php");

#==== Validations For Security
$POST		= $objTypes->validateUserInput($_POST);
$autocompleteSearch = isset($POST['blog_keyword'])?$POST['blog_keyword']:'';
// $limit = 21;  
// if (isset($_GET["page"])) 
// {
// 	$page  = $_GET["page"]; 
// } 
// else
// { 
//   $page=1;
// }
// $start_from = ($page-1) * $limit;
//auto search report
if(isset($autocompleteSearch))
{
    $report_list = "select bc.*,b.* from tbl_blogs_category bc right join tbl_blogs b on bc.id=b.`category_id` where b.is_active = 1 and b.is_delete = 1  and b.blog_title LIKE '%".$autocompleteSearch."%' order by b.sort_order ASC";
    //$report_list = "select * from tbl_blogs where is_active=1 and is_delete=1 and blog_title LIKE '".$autocompleteSearch."%' order by created_date DESC LIMIT $start_from, $limit";
}
$TypeArray	= $objTypes->fetchAll($report_list);
// echo '<pre>';
// print_r($TypeArray);
// exit;
$html = ''; 
if(sizeof($TypeArray) > 0){
    $html .='<div class="col-md-12">
                    <div class="tabout">
                        <h2 class="title b_title">Blogs</h3>
                            <p class=""></p>
                    </div>
                    <!--Blog Starts-->
                    <div class="row blogs" style="padding-bottom: 25px;" id="myAllreport">';
                      if(isset($TypeArray) && !empty($TypeArray)) 
                              { 
                                  foreach($TypeArray as $bloglist)
                                    {
                                         $blog_image = pathinfo($bloglist['blog_img']);
                                         
                                             if(isset($bloglist['blog_img']) && isset($blog_image['dirname']) && $blog_image['dirname']=='.')
                                              {
                                                  $img = base_url.'uploads/blog_images/'.$bloglist['blog_img'];
                                              }
                                              else if(isset($bloglist['blog_img']) && isset($blog_image['dirname']))
                                              {
                                                  $img = $bloglist['blog_img'];
                                              }
                                              else
                                              {
                                                  $img = base_url.'uploads/blog_images/Group160532.png';
                                              }
                                              if(!empty($bloglist['short_desc']) && $bloglist['short_desc']!=NULL) 
                                                { 
                                                    $desc = $bloglist['short_desc'];
                                                } 
                                                else if(isset($bloglist['long_desc']) && empty($bloglist['short_desc']))
                                                {
                                                    $desc = strip_tags(substr($bloglist['long_desc'],0,250));
                                                }
                                                else 
                                                {
                                                    $desc = strip_tags(substr($bloglist['long_desc'],0,250));
                                                } 
                               // $img = base_url.'uploads/blog_images/'.$bloglist['blog_img'];

                        $html .='<div class="col-lg-4">
                            <div class="card blog-b border" onclick="window.location.href=\''.base_url.'en/insights/'.$bloglist['slug'].'\'">
                                <img class="card-img-top" src='.$img.' alt="Card image" style="width:100%">
                                <div class="card-body ">
                                    <a href='.base_url.'en/insights/category/'.$bloglist['category_name'].' class="btn-link">'.$bloglist['category_name'].'</a>
                                    <h4 class="card-title" style="margin-top: 20px;">'.(isset($bloglist['blog_title']) ? $bloglist['blog_title'] : '').'</h4>
                                    <span>'.date("F d, Y",strtotime($bloglist['created_date'])).'</span>
                                    <p class="card-text">'.(isset($desc) ? $desc : '').'</p>
                                    <a href="'.base_url.'en/insights/'.$bloglist['slug'].'" class="hvr-icon-forward btn-link">Read More </a>
                                </div>
                            </div>
                        </div>';
                         } }
                    $html .='</div>
                </div>';
}
else
{
    $html .='<h1>No results found!</h1>';
}

echo $html;
?>
