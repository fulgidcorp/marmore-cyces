<?php
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
$lang='en';
$con = mysqli_connect('localhost', 'cycesskf_stagingmarmore', 'marmore@123!', 'cycesskf_marmore');
$html='';
//related blogs
$fetch_related_blogs   = "select b.*,bc.* from tbl_blogs b inner join tbl_blogs_category bc on b.`category_id`=bc.id where b.is_active = 1 and b.is_delete = 1 order by b.created_date DESC limit 3";
//$related_blog_list       = $objTypes->fetchAll($fetch_related_blogs);
$recent_blog_list=mysqli_query($con,$fetch_related_blogs);

$html .='<div class="tabout service-related-blog">
                    <h2 class="pt-3 pb-2 title b_title text-center">Related Insights</h3>
                    <p class="text-center paratext">Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.</p>
                </div>
                <div class="row blogs" id="section-line-4">';
                     if(isset($recent_blog_list) && count($recent_blog_list)>0)
                     {
                      foreach($recent_blog_list as $related_blog)
                      {
                           //$img = 'uploads/blog_images/'.$related_blog['blog_img'];
                           $blog_image = pathinfo($related_blog['blog_img']);
                                    
                         if(isset($related_blog['blog_img']) && !isset($blog_image['dirname']))
                          {
                              $img = base_url.'uploads/blog_images/'.$related_blog['blog_img'];
                          }
                         else if(isset($related_blog['blog_img']) && isset($blog_image['dirname']))
                          {
                              $img = $related_blog['blog_img'];
                          }
                          else
                          {
                              $img = base_url.'uploads/blog_images/Group160532.png';
                          }
                    $html .='<div class="col-lg-4 blog_1">
                        <div class="card blog-b border">
                            <img class="card-img-top" src='.$img.' alt="Card image">
                            <div class="card-body ">
                                <a href="#" class="btn-link">'.$related_blog['category_name'].'</a>
                                <h4 class="card-title card_2">'.$related_blog['blog_title'].'</h4>
                                <p class="card-text card_2">'.$related_blog['short_desc'].'
                                </p>
                                <a href='.base_url.'/'.$lang.'/insights/'.$related_blog['slug'].' class="hvr-icon-forward btn-link">Read More </a>
                            </div>
                        </div>
                    </div>';
                 } } 
                $html .='</div>
        ';
        echo $html;
        ?>