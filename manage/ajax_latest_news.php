<?php
//  ini_set('display_errors', 1);
//  ini_set('display_startup_errors', 1);
//  error_reporting(E_ALL);
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
$news = "SELECT * FROM tbl_news where is_active=1 and is_delete=1 order by created_date DESC LIMIT 3";
$fecth_news=mysqli_query($con,$news);

// echo '<pre>';
// print_r($fecth_news);
// exit;
$html ='';

 $html .='<div class="card1" style="padding-top: 40px;padding-bottom:0px">
 <h2 class="pt-3 pb-3 text-center title"><strong>Marmore In News</strong></h2>
    <div class="row">';
         if(isset($fecth_news) && count($fecth_news)>0) { 
            foreach($fecth_news as $news)
            {
                $blog_image = pathinfo($news['media']);
                                    
                 if(isset($news['media']) && isset($blog_image['dirname']) && $blog_image['dirname']=='.')
                  {
                      $img = base_url.'uploads/news_images/'.$news['media'];
                  }
                  else if(isset($news['media']) && isset($blog_image['dirname']))
                  {
                      $img = $news['media'];
                  }
                  else
                  {
                      $img = base_url.'uploads/blog_images/Group 160532.png';
                  }
                 
        $html .='<div class="col-lg-4">
            <div class="card card_m" onclick="window.location.href=\''.$news['news_link'].'\'" >
                <img class="card-img-top" src='.$img.' alt="Card image"
                    style="width:100%">
                <div class="card-body card_client">
                    <span class="news-date">'.date("F d, Y",strtotime($news['created_date'])).'</span>
                    <a href='.$news['news_link'].' target="_blank" class="btn-link">'.$news['category'].'</a>
                    <h4 class="card-title card_client" style="margin-top: 5px; font-weight: bold;">'.$news['news_name'].'</h4>
                    <p class="card-text" style="padding: 0px;">'.$news['short_desc'].'
                    </p>
                    <a href='.$news['news_link'].' target="_blank" class="hvr-icon-forward btn-link">Read More</a>
                </div>
            </div>
        </div>
        ';
         } } else
         {
             $html .='<h1>No results found!</h1>';
         }
    $html .='</div>
</div>
<div class="text-center icon-btn b1">
<a class="btn btn-2 btn-icon" href="marmore-news/"><span>View All News</span></a>
</div><br/>';
echo $html;
?>