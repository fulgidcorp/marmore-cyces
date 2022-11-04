<style>
    h3.side-slider::before {
        border: none !important;
    }

    .slick-next:before,
    .slick-prev:before {
        font-size: 20px;
        line-height: 1;
        opacity: .75;
        /*color: #000000;*/
    }
    .side-slider {
        /*background: #000000;*/
        color: #ffffff;
        font-size: 36px;
        line-height: 100px;
        margin: -2px;
        padding: 2%;
        position: relative;
        text-align: center;
    }
</style>
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.0.10/flickity.css">-->
      <link rel="stylesheet" href="<?php echo base_url ?>assets/css/slick-theme.min.css">
            <link rel="stylesheet" href="<?php echo base_url ?>assets/css/slick.min.css">

    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css">-->

        <section class="report-detailed" id="">
            <div class="container">
                <a href="<?php echo base_url.$lang ?>/data-book" class="r-link">Data Book</a>
                
                <div class="report-book">
                    <div class="row">
                        <div class="col-lg-8">
                             <span class="databook-country"><img src="/assets/image/emojione_flag-for-kuwait.png" ><span><?php echo $all_report_list_details['country_name'] ?></span></span>
                            <h1 class="report-content"><?php echo $all_report_list_details['data_book_name'] ?></h1>
                            <p class="report-p"><?php echo $all_report_list_details['short_desc'] ?>
                            </p>

                            <a class="btn btn-2 btn-blue" href="#" data-bs-toggle="modal" data-bs-target="#fullDatabook"><span>Request Full Databook</span></a>
                            <a class="btn btn-2 btn-blue block_side" href="#" data-bs-toggle="modal" data-bs-target="#fullDatabookDownload"><span>Download Executive
                                    Summary</span></a>
                        </div>
                        <div class="col-lg-4">
                            <div class="report-img">
                                <img src="/uploads/databook_images/<?=$all_report_list_details['image'] ?>" alt="" class="book-card data" data-toggle="tooltip" data-placement="top" title="Request Full Databook">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--<section class="data-slider" id="">-->
        <!--    <div class="container">-->
        <!--        <div class="tabout">-->
        <!--            <h2 class="text-center title">Data Book</h2>-->
        <!--        </div>-->
        <!--        <div class="">-->
        <!--            <div class="slider slider-for">-->
        <!--                <?php //for($i=0;$i<5;$i++)  { ?>-->
        <!--                <div>-->
        <!--                    <h3 class="side-slider"><?//= $i ?></h3>-->
        <!--                </div>-->
        <!--                <?php //} ?>-->
                        
        <!--            </div>-->
        <!--            <div class="slider slider-nav">-->
        <!--                <?php //for($i=0;$i<5;$i++)  { ?>-->
        <!--                <div>-->
        <!--                    <h3 class="side-slider"><?//= $i ?></h3>-->
        <!--                </div>-->
        <!--                <?php //} ?>-->
                        
        <!--            </div>-->

        <!--        </div>-->
        <!--    </div>-->
        <!--</section>-->

         <section class="data-slider" id="">
            <div class="container">
                <div class="tabout">
                    <h2 class="text-center title">Data Book</h2>
                </div>
                <div class="">
                    <div class="slider slider-for">
                    <?php if(isset($related_images) && count($related_images)>0) 
                    { 
                    foreach($related_images as $related_images) { ?>

                        <div>
                            <h3 class="side-slider"><img src="/uploads/databook_images/<?php echo $related_images['url'] ?>" /></h3>
                        </div>
                        <?php }  } ?>
                    </div>
                    <div class="slider slider-nav">
                          <?php 
                          $related_images = "select * from tbl_databook_images where data_book_id=".$all_report_list_details['id'];
                          $related_images       = $objTypes->fetchAll($related_images); 
                          if(isset($related_images) && count($related_images)>0) { foreach($related_images as $related_images) { ?>
                        <div>
                            <h3 class="side-slider"><img src="/uploads/databook_images/<?php echo $related_images['url'] ?>" height="140px" width"140px" /></h3>
                        </div>
                          <?php }  } ?>

                    </div>

                </div>
            </div>
        </section>
        <!--<section class="data-slider" id="">-->
        <!--    <div class="container">-->
        <!--        <div class="tabout">-->
        <!--            <h2 class="text-center title">Data Book</h2>-->
        <!--        </div>-->
        <!--        <div class="js-product-carousel">-->
        <!--            <?php //if(isset($related_images) && count($related_images)>0) { foreach($related_images as $related_images) { ?>-->
        <!--            <div class="carousel-cell">-->
        <!--                <div class="product-image">                            -->
        <!--                <img class="card-img" src="/uploads/databook_images/<?php //echo $related_images['url'] ?>" alt="Card image">-->
        <!--                </div>-->
        <!--            </div>-->
        <!--            <?php //}} ?>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</section>-->

        <section class="data-slider" id="">
            <div class="tabout">
                <h2 class="text-center title">Data Sets</h2>

            </div>
            <div class="card-section">

                <div class="row">
                    <?php if(isset($data_sets_list) && count($data_sets_list) > 0) { 
                      foreach($data_sets_list as $sets_list) {
                    ?>
                    <div class="col-lg-3">
                        <div class="icon-boxes-a">
                            <div class="icon text-center"><img src="/uploads/dataset_images/<?php echo $sets_list['image'] ?>" alt="">
                            </div>
                            <h3 class="text-center icon-content"><?php echo $sets_list['title'] ?></h3>
                        </div>
                    </div>
                    <?php } } ?>
                </div>

            </div>

        </section>
        <section class="data-slider" id="">
            <div class="card-section">
                <div class="tabout">
                    <h2 class="text-center title">Why Purchase The Data Book?</h2>

                </div>
                <div class="row data-booki">
                    <div class="col-lg-3">
                        <div class="icon-boxes i-data">
                            <div class="icon text-left"><img src="<?php echo base_url ?>/assets/image/Customize.png" alt=""></div>
                            <h3 class="text-left i-content">Customize</h3>
                            <p>Customize data as per your needs, upon request</p>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="icon-boxes i-data">
                            <div class="icon text-left"><img src="<?php echo base_url ?>/assets/image/Coverage.png" alt=""></div>
                            <h3 class="text-left i-content">Coverage</h3>
                            <p>Comprehensive coverage of key information in single place</p>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="icon-boxes i-data">
                            <div class="icon text-left"><img src="<?php echo base_url ?>/assets/image/comparison.png" alt=""></div>
                            <h3 class="text-left i-content">Comparison</h3>
                            <p>Enables country-wise comparison</p>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="icon-boxes i-data">
                            <div class="icon text-left"><img src="<?php echo base_url ?>/assets/image/Long term data.png" alt=""></div>
                            <h3 class="text-left i-content">Long term data</h3>
                            <p>Data provided for long time series (5, 10 & 20 years)</p>
                        </div>
                    </div>

                </div>
                <!--<div class="row">-->
                <!--    <div class="col-lg-3"></div>-->
                <!--    <div class=" col-lg-6 box-data">-->
                <!--        <div class="idata">-->
                <!--            <h4 class="title">Buy UAE data book now</h3>-->
                <!--                <a class="btn btn-2 btn-blue" href="#"><span>Buy Now</span></a>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--    <div class="col-lg-3"></div>-->
                <!--</div>-->
            </div>
        </section>

        <section class="data-slider" id="">
            <div class="card1">
                <div class="tabout">
                    <h2 class="text-left title">More Such Data Books</h2>

                </div>
                <div class="row">
                    <?php if(isset($all_related_databook_list_details) && count($all_related_databook_list_details) > 0) { 
                     foreach($all_related_databook_list_details as $all_related_databook)
                     {
                     
                    ?>
                    <div class="col-lg-3 data-b">
                            <div class="card card-d" onclick="window.location.href='<?php echo base_url.$lang ?>/data-book/<?php echo $all_related_databook['slug'] ?>'">
                                <img class="card-img" src="/uploads/databook_images/<?php echo $all_related_databook['image'] ?>" alt="Card image">
                                <div class="card-body ">
                                    <a href="<?php echo base_url ?>/<?= $lang ?>/data-book/<?php echo $all_related_databook['slug'] ?>"><h4 class="card-title text-center related-databook"><?php echo $all_related_databook['country_name'] ?></h4></a>
                                    <p class="card-text text-center"><?php echo $all_related_databook['short_desc'] ?>
                                    </p>
                                </div>
                            </div>
                    </div>
                <?php } } ?>
                </div>

            </div>
        </section>
            <div class="modal" id="myDownloadExecuteSummary" aria-hidden="true" style="display: none;" role="dialog">
      <div class="modal-dialog modal-xl vertical-align-center">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header" style="font-weight: bold;font-size: 20px;">
              Download Execute Summary
          </div>
          <div class="modal-body">
              <embed src="<?php echo base_url ?>/uploads/databook_images/<?php echo $all_report_list_details['databook_pdf']?>" frameborder="0" width="100%" height="700px">
              <!--<button type="button" class="btn-close" data-bs-dismiss="modal"></button>-->
          </div>
        </div>
      </div>
</div>

         <div class="modal" id="fullDatabook" style="display: none;" aria-modal="true" role="dialog">
              <div class="modal-dialog modal-xl vertical-align-center">
                <div class="modal-content">
                  <!-- Modal Header -->
                  <!-- <div class="modal-header">-->
                  <!--  <button type="button" class="btn-close" data-bs-dismiss="modal">Enquiry</button>-->
                  <!--</div>-->
                  <!-- Modal body -->
                  <div class="modal-body">
                    <div class="row ">
                      <div class="col-lg-5 model-p">
                        <div class="model-img">
                          <img src="/assets/image/Picture1-1.png" alt="world" width="50%">
                        </div>
                        <div class="box-align1">
                          <div class="logo-content text-left">
                            <img src="/assets/image/white-icon.png" alt="logo" style="height: 50px;">
                          </div>
                          <div class="major-content">
                            <h2 class="title text-left pt-4 titleb" style="font-weight:bold;">Your Trusted
                              <br>Partner
                              For
                              Middle<br> East Intelligence
                            </h2>
                            <p class="sub-title text-left text-white"></p>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-7" style="z-index:999;">
                        <div class="model-r">
                          <h3 class="title1 text-left">Download The Sample Data Book </h3>
                          <p class="model-sub text-left">Please submit the form below. Our relationship manager will
                            reach out
                            to you.</p>
                            <script charset="utf-8" type="text/javascript" src="//js-eu1.hsforms.net/forms/v2.js"></script>
                            <script>
                              hbspt.forms.create({
                                region: "eu1",
                                portalId: "26031663",
                                formId: "3d4705df-ab8a-4709-8b0c-6a8de860a96a"
                              });
                            </script>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        </div>
        
                 <div class="modal" id="fullDatabookDownload" style="display: none;" aria-modal="true" role="dialog">
              <div class="modal-dialog modal-xl vertical-align-center">
                <div class="modal-content">
                  <!-- Modal Header -->
                  <!-- <div class="modal-header">-->
                  <!--  <button type="button" class="btn-close" data-bs-dismiss="modal">Enquiry</button>-->
                  <!--</div>-->
                  <!-- Modal body -->
                  <div class="modal-body">
                    <div class="row ">
                      <div class="col-lg-5 model-p">
                        <div class="model-img">
                          <img src="/assets/image/Picture1-1.png" alt="world" width="50%">
                        </div>
                        <div class="box-align1">
                          <div class="logo-content text-left">
                            <img src="/assets/image/white-icon.png" alt="logo" style="height: 50px;">
                          </div>
                          <div class="major-content">
                            <h2 class="title text-left pt-4 titleb" style="font-weight:bold;">Your Trusted
                              <br>Partner
                              For
                              Middle<br> East Intelligence
                            </h2>
                            <p class="sub-title text-left text-white"></p>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-7" style="z-index:999;">
                        <div class="model-r">
                          <h3 class="title1 text-left">Download Executive Summary  </h3>
                          <p class="model-sub text-left">Please submit the form below. Our relationship manager will
                            reach out
                            to you.</p>
                            <script charset="utf-8" type="text/javascript" src="//js-eu1.hsforms.net/forms/v2.js"></script>
                            <script>
                              hbspt.forms.create({
                                region: "eu1",
                                portalId: "26031663",
                                formId: "3d4705df-ab8a-4709-8b0c-6a8de860a96a"
                              });
                            </script>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        </div>

      <script src="<?php echo base_url ?>assets/js/jquery.min.js"></script>
      <script src="<?php echo base_url ?>assets/js/bootstrap.bundle.min.js"></script>
      <script src="<?php echo base_url ?>assets/js/slick.min.js"></script>

    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.0.10/flickity.pkgd.js"></script>-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>-->

    <script src="assets/js/main.js"></script>
     <script>
        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            fade: false,
            asNavFor: '.slider-nav'
        });
        $('.slider-nav').slick({
            slidesToShow: 6,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            dots: true,
            focusOnSelect: true
        });

        $('a[data-slide]').click(function (e) {
            e.preventDefault();
            var slideno = $(this).data('slide');
            $('.slider-nav').slick('slickGoTo', slideno - 1);
        });
    </script>

    <script>
        // $('.js-product-carousel').flickity({
        //     //options
        //     wrapAround: true,
        // });
    </script>

    <script>
        const anchors = document.querySelectorAll('nav a')

        anchors.forEach(anchor => anchor.addEventListener("click", onClick));

        function onClick(e) {
            anchors.forEach(achor => achor.classList.remove('active'))
            e.target.classList.add('active')
        }
    </script>
   
 <?php include("include/footer.php"); ?>


<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});
</script>