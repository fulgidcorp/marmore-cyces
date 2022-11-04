<?php
include_once('config/config.php');
$limit = 6;  
if (isset($_GET["page"])) {
	$page  = $_GET["page"]; 
	} 
	else{ 
	$page=1;
	};  
$start_from = ($page-1) * $limit;  
$result = $objTypes->fetchAll("SELECT * FROM tbl_webinar where is_active=1 and is_delete=1 ORDER by webinar_date DESC LIMIT $start_from, $limit");
// $result = $objTypes->fetchAll("SELECT * FROM tbl_webinar where is_active=1 and is_delete=1");

?>
<style>
    nav.navbar.align-items-center {
    position: relative;
}
.breadcrumb1 {
    margin-top: 0px !important;
}
</style>
<div class="container-fuild ">
        <div class="content content1 dark pb-50">
            <div class="row vertical-align">
                <div class="col-lg-6">
                    <div class=" pb-50">
                        <div class="major-content">
                            <h2 class="title pt-4">Webinar</h2>
                            <p class="sub-title subtitle pt-3">
                            </p>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 ">
                    <div class="text-right">
                        <img src="<?php echo base_url ?>/assets/image/Webinar-pana.svg" alt="world" class="banner-img1 webinar-banner" height="250">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="webinar-card" id="">
        <div class="container">
                    <div class="row">

            <?php
          
            if(isset($result) && count($result)>0)
            { 
                foreach($result as $gcc)
                {
            ?>
            <div class="col-lg-6 mb-4">
                <div class="card">
<iframe src="<?php echo $gcc['webinar_video_url']?>">
</iframe>    
                    <div class="card-body">
                                <span class="date-webinar"><?php echo date("F d, Y",strtotime($gcc['webinar_date'])) ?></span>

                        <h5 class="card-title"><?php echo $gcc['webinar_name']?></h5>
                        <p class="card-text">
                            <?php echo $gcc['webinar_sort_content']?>
                        </p>
 
                    </div>
                </div>
            </div>
            <?php } } ?>
        </div>
    </section>
    

</div>
<div class="pagination">
<?php  
    $row_db = $objTypes->fetchAll("SELECT * FROM tbl_webinar where is_active=1 and is_delete=1"); 
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
    <script src="<?php echo base_url ?>assets/js/bootstrap.bundle.min.js"></script>
