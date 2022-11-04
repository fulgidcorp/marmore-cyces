<?php
require_once __DIR__ . '/assets/vendor/autoload.php';

if(isset($_POST) && $_POST['blog_id']!='')
{
    $blogs_list_details ="select * from tbl_blogs where is_active=1 and is_delete=1 and blog_title='".$_POST['blog_id']."'";
    $all_blog_list_details       = $objTypes->fetchRow($blogs_list_details); 
    if(isset($all_blog_list_details) && !empty($all_blog_list_details))
    {
        $data = '<section class="guides" id="" style="padding: 0;">
                 <div class="row">
                <div class="col-md-12 blog_i">';
                        $blog_image = pathinfo($all_blog_list_details['blog_img']);
                                    
                         if(isset($all_blog_list_details['blog_img']) && isset($blog_image['dirname']) && $blog_image['dirname']=='.')
                          {
                              $img = base_url.'uploads/blog_images/'.$all_blog_list_details['blog_img'];
                          }
                          else if(isset($all_blog_list_details['blog_img']) && isset($blog_image['dirname']))
                          {
                              $img = $all_blog_list_details['blog_img'];
                          }
                          else
                          {
                              $img = base_url.'uploads/blog_images/Group 160532.jpg';
                          }
                          if(isset($all_blog_list_details['blog_author_img']))
                         {
                             $author_img = base_url.$all_blog_list_details['blog_author_img'];
                         }
                         else
                         {
                             $author_img = base_url.'image/fqQKrP7.png';
                         }
                         if(isset($all_blog_list_details['read_time']) && !empty($all_blog_list_details['read_time']))
                         { 
                              $author_name = $all_blog_list_details['blog_author_name'];
                         } 
                         else 
                         { 
                              $author_name = 'Marmore Team';
                         } 
                         if(isset($all_blog_list_details['read_time']) && !empty($all_blog_list_details['read_time']))
                         { 
                           $read_time = '~'.$all_blog_list_details['read_time'].'min read |';
                         } 
                         else
                         {
                             $read_time = '';
                         }
                   $data .='<div class="tabout">
                            <div class="row">
                                <div class="col-lg-1">
                                    <img src='.$author_img.' alt="" class="author">
                                </div>
                                <div class="col-lg-4">
                                    <h4 class="a-content">'.$author_name.'</h4>
                                    <p class="b-content">'.$read_time.' '.date("d F Y",strtotime($all_blog_list_details['created_date'])).'</p>
                                </div>
                            </div>
                    </div>
                     <section class="banner">
                        <img src="'.$img.'" alt="" class="banner-img">
                    </section>
                    <section class="guides" style="padding: 50px 0;" id="">
                        <div class="row">
                                <div class="col-md-9 blog-body">'.$all_blog_list_details['long_desc'].'</div>
                            </div>
                            </section>
                    </div></div></section>';
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->SetHTMLHeader('<h2 class="title" style="margin-top: auto;">'.$all_blog_list_details['blog_title'].'</h2>');
        $mpdf->setFooter('<div style="text-align: center">{PAGENO} of {nbpg}</div>');
        $mpdf->Image($img, 0, 0, 210, 297, 'png', '', true, false);
        $mpdf->WriteHTML($data);
        $mpdf->Output($all_blog_list_details['blog_title'].'.pdf','D');
    }
}
?>