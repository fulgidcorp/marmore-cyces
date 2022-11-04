<?php
include_once('config/config.php');
$limit = 3;  
if (isset($_GET["page"])) 
{
	$page  = $_GET["page"]; 
} 
else
{ 
   $page=1;
}
$start_from = ($page-1) * $limit;  
$fetch_gcc = $objTypes->fetchAll("SELECT * FROM tbl_bulletin where is_active=1 and is_delete=1 LIMIT $start_from, $limit");
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
                            <h2 class="title pt-4">Marmore Bulletin</h2>
                            <p class="sub-title subtitle pt-3" id>
                            </p>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 ">
                    <div class="text-right">
                        <img src="<?php echo base_url ?>/assets/image/undraw_world_re_768g 1 (1).png" alt="world" class="banner-img1 gcc-banner" width="600">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="gcc-card" id="">
        <div class="container">
            <?php
            // $fetch_gcc = "select * from tbl_bulletin where is_active=1 and is_delete=1";
            // $fetch_gcc       = $objTypes->fetchAll($fetch_gcc); 
           
            if(isset($fetch_gcc) && count($fetch_gcc)>0)
            { 
                foreach($fetch_gcc as $gcc)
                {
                    $blog_image = pathinfo($gcc['image_featured']);
                                    
                     if(isset($gcc['image_featured']) && !isset($blog_image['dirname']))
                      {
                          $img = base_url.'uploads/gcc_images/'.$gcc['image_featured'];
                      }
                      else if(isset($gcc['image_featured']) && isset($blog_image['dirname']))
                      {
                          $img = $gcc['image_featured'];
                      }
                      else
                      {
                          $img = base_url.'uploads/blog_images/Group 160532.png';
                      }
            ?>
            <div class="card gcc mb-3">
                <div class="row no-gutters">
                    <div class="col-md-4 text-left">
                        <img src="<?php echo $img ?>" class="card-img" alt="...">
                    </div>
                    <div class="col-md-8 card-b">
                        <div class="card-body gcc-body scroller" id="">
                            <a href="#"><?php echo date("F d, Y",strtotime($gcc['date'])) ?></a>
                            <h5 class="card-title gcc-heading"><?php echo $gcc['gcc_name'] ?></h5>
                            <ol class="list-group list-group-numbered gcc-list">
                                <li class="list-group-item gc-list"><?php echo $gcc['long_desc'] ?></li>
                            </ol>
                        </div>
                        <a class="btn btn-theme" href="<?php echo $gcc['book_pdf'] ?>" target="_blank"><span>Download Pdf</span></a>
                    </div>
                </div>
            </div>
            <?php } } ?>
        </div>
    </section>
    <div class="pagination">
<?php  
    $row_db = $objTypes->fetchAll("SELECT * FROM tbl_bulletin where is_active=1 and is_delete=1"); 
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
<?php } ?> <?php 
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
