<?php
include_once('config/config.php');

$result = $objTypes->fetchAll("SELECT * FROM tbl_gcc where is_active=1 and is_delete=1");
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
                            <h2 class="title pt-4">GCC Crises</h2>
                            <p class="sub-title subtitle pt-3">
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
            if(isset($result) && count($result)>0)
            { 
                foreach($result as $gcc)
                {
                    $blog_image = pathinfo($gcc['image_featured']);
                                    
                     if(isset($gcc['image_featured']) && isset($blog_image['dirname']) && $blog_image['dirname']=='.')
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
                    <div class="col-md-5">
                        <img src="<?php echo $img ?>" class="card-img" alt="...">
                    </div>
                    <div class="col-md-7 card-b">
                        <div class="card-body gcc-body">
                            <a href="#"><?php echo date("F d, Y",strtotime($gcc['date'])) ?></a>
                            <h5 class="card-title gcc-heading"><?php echo $gcc['gcc_name'] ?></h5>
                            <ol class="list-group list-group-numbered gcc-list">
                                <li class="list-group-item gc-list"><?php echo $gcc['long_desc'] ?></li>
                            </ol>
                            <a class="btn btn-theme" href="<?php echo $gcc['book_pdf'] ?>" target="_blank"><span>Download GCC</span></a>

                        </div>
                    </div>
                </div>
            </div>
            <?php } } ?>
        </div>
    </section>

      <script src="<?php echo base_url ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url ?>assets/js/bootstrap.bundle.min.js"></script>
