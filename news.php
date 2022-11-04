<div class="container-fuild ">
    <div class="content content1 pb-50">
            <div class="row vertical-align">
                <div class="col-lg-6">
                    <div class=" pb-50">
                        <div class="major-content">
                            <h2 class="title pt-4">Marmore in the News</h2>
                            <p class="sub-title subtitle pt-3">Marmore is a leading source of incisive economic, industry and policy insights on MENA for the media.
                            </p>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 ">
                    <div class="text-right">
                        <img src="<?php echo base_url ?>/assets/image/undraw_news_re_6uub.png" alt="world" class="banner-img1" width="600">
                    </div>
                </div>
            </div>
        </div>
</div>
<!--news-->
<?php
$limit = 12;  
if (isset($_GET["page"])) 
{
	$page  = $_GET["page"]; 
} 
else
{ 
   $page=1;
}
$start_from = ($page-1) * $limit;  
$fecth_news = $objTypes->fetchAll("SELECT * FROM tbl_news where is_active=1 and is_delete=1 order by created_date DESC LIMIT $start_from, $limit");
?>
 <div class="card1" style="padding-top: 40px;">
    <div class="row">
        <?php if(isset($fecth_news) && count($fecth_news)>0) { 
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
            ?>
        <div class="col-lg-3">
            <div class="card card_m" onclick="window.location.href='<?php echo $news['news_link'] ?>'">
                <img class="card-img-top" src="<?php echo $img ?>" alt="Card image"
                    style="width:100%">
                <div class="card-body card_client">
                    <span class="news-date"><?php echo date("F d, Y",strtotime($news['created_date'])) ?></span>
                    <a href="<?php echo $news['news_link'] ?>" class="btn-link"><?php echo $news['category'] ?></a>
                    <h4 class="card-title card_client" style="margin-top: 5px; font-weight: bold;"><?php echo $news['news_name']?></h4>
                    <p class="card-text" style="padding: 0px;"><?php echo $news['short_desc']?>
                    </p>
                    <a href="<?php echo $news['news_link'] ?>" class="hvr-icon-forward btn-link">Read More</a>
                </div>
            </div>
        </div>
        <?php } } ?>
    </div>
</div>
<div class="pagination">
<?php  
    $row_db = $objTypes->fetchAll("SELECT * FROM tbl_news where is_active=1 and is_delete=1"); 
    $row_db = count($row_db);  
    $total_records = $row_db;  
    $total_pages = ceil($total_records / $limit);
?>
  <?php 
  $count = 5;
$startPage = max(1, $page - $count);
$endPage = min( $total_pages, $page + $count);
if($page==1)
{
?>
<a href="?page=<?=($page)?>" class="<?=$page <= 1 ? 'disabled': ''; ?>">&laquo;</a>
<?php
} else {
?>
<a href="?page=<?=($page-1)?>" class="<?=$page <= 1 ? 'disabled': ''; ?>">&laquo;</a>
<?php } ?>
 <?php 
 for ($i=$startPage; $i<=$endPage; $i++) 
  { 
    if(isset($_GET['page']) && $_GET['page']!='' && $_GET['page']==$i)
    {
        $active ="active";
    }
    else
    {
        $active ="";
    }
   ?>
  <a href="?page=<?=$i?>" class="<?=$active?>"><?php echo $i ?></a>
  <?php } ?>
  <a href="?page=<?=($page+1)?>" class="<?=$page >= $total_pages ? 'disabled': ''; ?>">&raquo;</a>
</div>
