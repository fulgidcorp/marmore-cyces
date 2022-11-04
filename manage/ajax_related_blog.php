<?php
//  ini_set('display_errors', 1);
//  ini_set('display_startup_errors', 1);
//  error_reporting(E_ALL);
// require_once("config/config.php");
$html ='';
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
    $con = mysqli_connect('localhost', 'cycesskf_stagingmarmore', 'marmore@123!', 'cycesskf_marmore');
    // $fetch_recent_blogs   = "select bc.*,b.* from tbl_blogs_category bc right join tbl_blogs b on bc.id=b.`category_id` where b.is_active = 1 and b.is_delete = 1  order by b.created_date DESC LIMIT 3";
    // $recent_blog_list       = $objTypes->fetchAll($con,$fetch_recent_blogs);
$fetch_recent_blogs   = "select bc.*,b.* from tbl_blogs_category bc right join tbl_blogs b on bc.`id`=b.`category_id` where b.is_active = 1 and b.is_delete = 1 order by b.created_date DESC limit 3";
$recent_blog_list=mysqli_query($con,$fetch_recent_blogs);

 $html .='
    <h2 class="font-weight-bold pt-5"><strong>Recent Insights</strong></h2>
    <p class="para1">Stay tuned to MENA & GCC Insights with our blogs.</p>
    <a class="btn btn-theme" href='.base_url.'en/insights/><span>Explore Our Insights</span></a>
    <div class="uk-margin"></div>
    <div class="uk-section">
      <div class="owl-carousel owl-theme blog">
        <div class=" item">';
         if(isset($recent_blog_list) && count(array($recent_blog_list))> 0) { foreach($recent_blog_list as $recent_blog_list) { 
            //$img = 'uploads/blog_images/'.$recent_blog_list['blog_img'];
            $blog_image = pathinfo($recent_blog_list['blog_img']);
                                    
         if(isset($recent_blog_list['blog_img']) && isset($blog_image['dirname']) && $blog_image['dirname']=='.')
          {
              $img = base_url.'uploads/blog_images/'.$recent_blog_list['blog_img'];
          }
         else if(isset($recent_blog_list['blog_img']) && isset($blog_image['dirname']))
          {
              $img = $recent_blog_list['blog_img'];
          }
          else
          {
              $img = base_url.'uploads/blog_images/Group160532.png';
          }
                        
 
          $html .='<div class="card blog-card">
            <div class="row no-gutters align-items-center" onclick="window.location.href=\''.base_url.'en/insights/'.$recent_blog_list['slug'].'\'">
              <div class="col-sm-4">
                <img class="card-img" src='.$img.' style="width: 250px;" alt="alt-img">
              </div>
              <div class="col-sm-8 align-items-center">
                <div class="card-body">
                  <h2 class="card-title">'.$recent_blog_list['blog_title'].'</h2>
                  <span style="margin-bottom:0.5em;display:inline-block;">'. date("F d, Y",strtotime($recent_blog_list['created_date'])).'</span>
                  <p class="card-text">'.$recent_blog_list['short_desc'].'</p>
                  <a href='.base_url.'en/insights/'.$recent_blog_list['slug'].' class=" btn-link">Read More <i class="fa fa-long-arrow-right"
                      aria-hidden="true"></i></a>
                </div>
              </div>
            </div>
          </div>';
        } } 
        $html .='</div>
      </div>
</div>
';
echo $html;

?>
