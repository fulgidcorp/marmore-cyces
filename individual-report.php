<style>
    #more{display:none;}
    /*
*
* ==========================================
* CUSTOM UTIL CLASSES
* ==========================================
*/
.nav-pills-custom .nav-link {
    color: #aaa;
    background: #fff;
    position: relative;
}

.nav-pills-custom .nav-link.active {
       color: white;
    background: #00548f;
    font-weight:600;
}
#v-pills-tabContent h4.font-italic.mb-4 {
    font-weight: bold;
}

/* Add indicator arrow for the active tab */
@media (min-width: 992px) {
    .nav-pills-custom .nav-link::before {
        content: '';
        display: block;
        border-top: 8px solid transparent;
        border-left: 10px solid #00548f;
        border-bottom: 8px solid transparent;
        position: absolute;
        top: 50%;
        right: -10px;
        transform: translateY(-50%);
        opacity: 0;
    }
}

.nav-pills-custom .nav-link.active::before {
    opacity: 1;
}
    nav.navbar.align-items-center {
    position: relative;
}
.breadcrumb1 {
    margin-top: 0px !important;
}



</style>
<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
$blog_image = pathinfo($all_report_list_details['report_images']);
                                    
 if(isset($all_report_list_details['report_images']) && isset($blog_image['dirname']) && $blog_image['dirname']=='.')
  {
      $img = base_url.'uploads/report_images/'.$all_report_list_details['report_images'];
  }
  else if(isset($all_report_list_details['report_images']) && isset($blog_image['dirname']))
  {
      $img = $all_report_list_details['report_images'];
  }
  else
  {
      $img = base_url.'uploads/blog_images/Group 160532.png';
  }
?>
        <section class="report-detailed" id="">
            <?php if(isset($all_report_list_details) && !empty($all_report_list_details)) { ?>
            <div class="container">
                <a href="<?php echo base_url.$lang?>/reports" class="r-link">Research Reports</a>
                <div class="report-book">
                <div class="row">
                <div class="col-lg-8">
                    <h1 class="report-content text-capitalize"><?php echo $all_report_list_details['report_name'] ?></h1>
                    <p><?php echo date("F, Y",strtotime($all_report_list_details['report_date'])) ?></p>
                    <?php if(!isset($all_report_list_details['report_pdf_free_report'])  && !isset($all_report_list_details['report_pdf_executive_summary'])) { ?>
                    <a class="btn btn-2 btn-blue" href="#" data-bs-toggle="modal" data-bs-target="#RequestfullReport"><span>Request Full Report</span></a>
                    <?php } ?>
                    <?php if(isset($all_report_list_details['report_pdf_executive_summary']) && !empty($all_report_list_details['report_pdf_executive_summary'])) { ?>
                    <a class="btn btn-2 btn-blue block_side" href="#" data-bs-toggle="modal" data-bs-target="#mySummaryPdf"><span>Download Executive Summary</span></a>
                    <?php } ?>
                    <?php if(isset($all_report_list_details['report_pdf_free_report']) && !empty($all_report_list_details['report_pdf_free_report']) && empty($all_report_list_details['report_pdf_executive_summary'])) { ?>
                    <a class="btn btn-2 btn-blue block_side" href="#" data-bs-toggle="modal" data-bs-target="#mySummaryFreePdf"><span>Download Free PDF Report</span></a>
                    <?php } ?>
                    <!--<a class="btn btn-2 btn-blue block_side" href="#" onerror="this.style.display='none'" onclick='window.open("<?php //echo base_url?>uploads/report_pdf/<?php //echo $all_report_list_details['report_pdf']?>","","width=600,height=600,scrollbars=Yes,resizable=yes")'><span>Download Executive Summary</span></a>-->
                    <!--<a class="btn btn-2 btn-blue" href="#"><span>Download Executive Summary</span></a>-->

                </div>
                <div class="col-lg-4">
                    <div class="report-img">
                    <img src="<?php echo $img ?>" alt="" class="book-card">
                </div>
                </div>
            </div>
            </div>
            </div>
            <div class="">
    <!-- Demo header-->
<section class="py-5 header">
    <div class="container py-4">
     
        <div class="row">
            <div class="col-md-3">
                <!-- Tabs nav -->
                <div class="nav flex-column nav-pills nav-pills-custom" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <?php if(isset($all_report_list_details['report_executive_summary']) && !empty($all_report_list_details['report_executive_summary'])) { ?>
                    <a class="nav-link mb-3 p-3 shadow active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
                        <span class="font-weight-bold small text-uppercase">Executive Summary</span></a>
                    <?php } ?>
                    <?php if(isset($all_report_list_details['report_chart_reports']) && !empty($all_report_list_details['report_chart_reports'])) { ?>

                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                        <span class="font-weight-bold small text-uppercase">Customize this report
                    </span></a>
                    <?php } ?>
                    <?php if(isset($all_report_list_details['report_faq']) && !empty($all_report_list_details['report_faq'])) { ?>

                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-faq-tab" data-toggle="pill" href="#v-pills-faq" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                        <span class="font-weight-bold small text-uppercase">FAQ</span>
                        </a>
                    <?php } ?>
                    <?php if(isset($all_report_list_details['report_key_questions_addressed']) && !empty($all_report_list_details['report_key_questions_addressed'])) { ?>
                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                        <span class="font-weight-bold small text-uppercase">Key Questions Addressed</span></a>
                    <?php } ?>
                    <?php if(isset($all_report_list_details['report_add_value_to']) && !empty($all_report_list_details['report_add_value_to'])) { ?>

                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                        <span class="font-weight-bold small text-uppercase">Add Value To</span></a>
                        <?php } ?>
                        <?php if(isset($all_report_list_details['report_table_of_contents']) && !empty($all_report_list_details['report_table_of_contents'])) { ?>
                        <a class="nav-link mb-3 p-3 shadow" id="v-pills-table-tab" data-toggle="pill" href="#v-pills-table" role="tab" aria-controls="v-pills-table" aria-selected="false">
                        <span class="font-weight-bold small text-uppercase">Table of Contents</span></a>
                        <?php } ?>
                    </div>
            </div>


            <div class="col-md-9">
                <!-- Tabs content -->
                <div class="tab-content" id="v-pills-tabContent">
                    <?php if(isset($all_report_list_details['report_executive_summary']) && !empty($all_report_list_details['report_executive_summary'])) { ?>
                    <div class="tab-pane fade shadow rounded bg-white show active p-5" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <h4 class="font-italic mb-4">Executive Summary</h4>
                        <p class="font-italic text-muted mb-2"><?php echo $all_report_list_details['report_executive_summary'] ?></p>
                    </div>
                    <?php } ?>
                    
                    <?php if(isset($all_report_list_details['report_chart_reports']) && !empty($all_report_list_details['report_chart_reports'])) { ?>
                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <h4 class="font-italic mb-4">Customize this report</h4>
                        <p class="font-italic text-muted mb-2">
                         <h3><strong>Why Custom Research?</strong></h3>
                        <ul class="rdetails_list">
                        <li>Research and intelligence to suit your business requirements </li>
                        <li>Informed decision making</li>
                        </ul>
                        <h3>What are Benefits of Customization?</h3>
                        <ul class="rdetails_list">
                        <li>To-the-point, long or short research reports could be requested</li>
                        <li>Reports are exclusively prepared for you</li>
                        </ul><br />
                        <p><a class="cta_btn btn btn-theme" data-bs-toggle="modal" data-bs-target="#customizethisreport">Customize this report</a></p>
                        <h3>You Ask We Deliver</h3>
                        <ul class="rdetails_list">
                        <li>Over a decade Marmore has successfully navigated this space of customized research to serve its clients and cater to their unique requirements.</li>
                        <li>Our customized research support spans sector research, equity and credit investment notes, modelling, valuation, investment screening, periodical etc.</li>
                        <li>We offer clients with intelligence and insights on unexplored and under-researched areas that help stakeholders take well-informed business and investment decisions.</li>
                        <li>Our offerings marries the challenges of cost, time, scope &amp; data availability to generate actionable outcomes that are specific to our clients' needs.</li>
                        </ul><br />
                            
                        </p>
                    </div>
                    <?php } ?>
                    <?php if(isset($all_report_list_details['report_faq']) && !empty($all_report_list_details['report_faq'])) { ?>
                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-faq" role="tabpanel" aria-labelledby="v-pills-faq-tab">
                        <h4 class="font-italic mb-4">FAQ</h4>
                        <p class="font-italic text-muted mb-2"><?php echo $all_report_list_details['report_faq'] ?></p>
                    </div>
                    <?php } ?>
                    <?php if(isset($all_report_list_details['report_key_questions_addressed']) && !empty($all_report_list_details['report_key_questions_addressed'])) { ?>
                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                        <h4 class="font-italic mb-4">Key Questions Addressed</h4>
                        <p class="font-italic text-muted mb-2"><?php echo $all_report_list_details['report_key_questions_addressed'] ?></p>
                    </div>
                    <?php } ?>
                    <?php if(isset($all_report_list_details['report_add_value_to']) && !empty($all_report_list_details['report_add_value_to'])) { ?>
                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                        <h4 class="font-italic mb-4">Add Value To</h4>
                        <p class="font-italic text-muted mb-2"><?php echo $all_report_list_details['report_add_value_to'] ?></p>
                    </div>
                    <?php } ?>
                    <?php if(isset($all_report_list_details['report_table_of_contents']) && !empty($all_report_list_details['report_table_of_contents'])) { ?>
                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-table" role="tabpanel" aria-labelledby="v-pills-table-tab">
                        <h4 class="font-italic mb-4">Table of Contents</h4>
                        <p class="font-italic text-muted mb-2"><?php echo $all_report_list_details['report_table_of_contents'] ?></p>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>




                <!--<div id="test">-->
                <!--    <p><?php //echo $all_report_list_details['report_long_desc']; ?></p>-->
                <!--</div>-->
                <!--<p><?php //echo substr($all_report_list_details['report_long_desc'],0,700) ?><span id="dots">...</span><span id="more"><?php echo substr($all_report_list_details['report_long_desc'],251) ?></span></p>-->
                </div>
            </div>
            <?php } ?>
            <!--<div class="container">-->
            <!--    <div class="box">-->
            <!--        <h3 class="title" >Explore The Report</h3>-->
            <!--      </div>-->
            <!--      <div class="card-block">-->
            <!--          <div class="row mb-3">-->
             <!--               if(isset($all_explore_products_list_details) && !empty($all_explore_products_list_details))-->
             <!--               {-->
            <!--                   $count = 1;-->
             <!--                   foreach($all_explore_products_list_details as $all_explore_report)-->
             <!--                   {-->
             <!--                       if($count != 3 )-->
             <!--                       {-->
            <!--              ?>-->
            <!--            <div class="col-lg-3">-->
            <!--                <div class="card card_side">-->
            <!--                      <h4 class="crd-title"><?php //echo $all_explore_report['report_name'] ?></h4>-->
            <!--                      <p class="crd-sub"><?php //echo $all_explore_report['report_short_desc'] ?></p>-->
            <!--                      <a href="#" class="crd-lnk">Global Private Equity Report  <i class="fa-solid fa-bookmark"></i></a>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--             <?php //} else { ?>-->
            <!--          <div class="col-lg-6">-->
            <!--            <div class="card card-r">-->
            <!--                <h4 class="crd-title"><?php //echo $all_explore_report['report_name'] ?></h4>-->
            <!--                      <p class="crd-sub"><?php //echo $all_explore_report['report_short_desc'] ?></p>-->
            <!--                 <a href="#" class="crd-lnk crd1">Global Private Equity Report  <i class="fa-solid fa-bookmark"></i></a>-->
                            
            <!--              </div>-->
            <!--          </div>-->
            <!--        <?php //}  $count++; }   } ?>-->
            <!--        </div>-->
            <!--      </div>-->
            <!--</div>-->
            
             <div class="card1">
                <div class="tabout">
                    <h2 class="text-center title">Related Reports</h2>

                </div>
                <div class="row relative-report blogs">
                    <?php if(isset($all_explore_products_list_details) && count($all_explore_products_list_details) > 0) { 
                     foreach($all_explore_products_list_details as $all_explore_products_list_details){
                         
                         $blog_image = pathinfo($all_explore_products_list_details['report_images']);
                                    
                         if(isset($all_explore_products_list_details['report_images']) && isset($blog_image['dirname']) && $blog_image['dirname']=='.')
                          {
                              $img = base_url.'uploads/report_images/'.$all_explore_products_list_details['report_images'];
                          }
                          else if(isset($all_explore_products_list_details['report_images']) && isset($blog_image['dirname']))
                          {
                              $img = $all_explore_products_list_details['report_images'];
                          }
                          else
                          {
                              $img = base_url.'uploads/blog_images/Group 160532.png';
                          }
                    ?>
                    <div class="col-lg-3 blog_1">
                        <a href="<?php echo base_url.$lang ?>/reports/<?php echo $all_explore_products_list_details['wp_slug'] ?>">
                            <div class="card blog-b border">
                                <img class="card-img-top" src="<?php echo $img ?>" alt="<?php echo $all_explore_products_list_details['report_name']?>">
                                <div class="card-body ">
                                    <a href="<?php echo base_url.$lang ?>/reports/<?php echo $all_explore_products_list_details['wp_slug'] ?>"><h4 class="card-title card_3"><?php echo $all_explore_products_list_details['report_name']?></h4></a>
                                    <p class="gray" ><?php echo date("F d, Y",strtotime($all_explore_products_list_details['created_date'])) ?>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php } } ?>
                </div>
            </div>
        </section>
 <?php include("include/footer.php"); ?>
 <div class="modal fade" id="customizethisreport"  aria-modal="true" role="dialog">
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
                                <h2 class="title text-left pt-4 titleb" style="font-weight:bold;"><?php echo $all_report_list_details['report_name'] ?>
                                </h2>
                               <p class="sub-title text-left text-white"> <?php echo date("F d, Y",strtotime($all_report_list_details['report_date'])) ?></p>
                                <!--<p class="sub-title text-left text-white">Lorem ipsum dolor sit amet, consectetur adipiscing-->
                                <!--  elit.-->
                                <!--  Duis pharetra non-->
                                <!--  arcu nam. Enim curabitur nunc, proin facilisi ut in nunc, hac donec. </p>-->
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <div class="model-r">
                              <h3 class="title1 text-left">Request This Report</h3>
                              <p class="model-sub text-left">Please submit the form below. Our relationship manager will
                                reach out
                                to you.</p>
                                <script charset="utf-8" type="text/javascript" src="//js-eu1.hsforms.net/forms/v2.js"></script>
                                <script>
                                  hbspt.forms.create({
                                    region: "eu1",
                                    portalId: "26031663",
                                    formId: "6fae6ce1-b866-45f1-ac8f-05642e132f0f"
                                  });
                                </script>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>


<div class="modal fade" id="RequestfullReport"  aria-modal="true" role="dialog">
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
                                <h2 class="title text-left pt-4 titleb" style="font-weight:bold;"><?php echo $all_report_list_details['report_name'] ?>
                                </h2>
                               <p class="sub-title text-left text-white"> <?php echo date("F d, Y",strtotime($all_report_list_details['report_date'])) ?></p>
                                <!--<p class="sub-title text-left text-white">Lorem ipsum dolor sit amet, consectetur adipiscing-->
                                <!--  elit.-->
                                <!--  Duis pharetra non-->
                                <!--  arcu nam. Enim curabitur nunc, proin facilisi ut in nunc, hac donec. </p>-->
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <div class="model-r">
                              <h3 class="title1 text-left">Request This Report</h3>
                              <p class="model-sub text-left">Please submit the form below. Our relationship manager will
                                reach out
                                to you.</p>
                                <script charset="utf-8" type="text/javascript" src="//js-eu1.hsforms.net/forms/v2.js"></script>
                                <script>
                                  hbspt.forms.create({
                                    region: "eu1",
                                    portalId: "26031663",
                                    formId: "6e0b918f-edc8-43b0-947f-4cfe8c732634"
                                  });
                                </script>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal" id="mySummaryFreePdf" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-xl vertical-align-center">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header" style="font-weight: bold;font-size: 20px;">
              Download Free PDF Report
          </div>
          <div class="modal-body">
              <?php
                  $get_file_name = basename($all_report_list_details['report_pdf_free_report']);
                 if(file_exists('uploads/report_pdf/'.$all_report_list_details['report_pdf_free_report']))
                  {
                    $report_pdf = base_url.'uploads/report_pdf/'.$all_report_list_details['report_pdf_free_report'];

                  }
                  else
                  {
                    $report_pdf = base_url.'/wp-content/uploads/pdf/'.$get_file_name;
                  }
              ?>
              <embed src="<?php echo $report_pdf ?>" frameborder="0" width="100%" height="700px">
              <!--<button type="button" class="btn-close" data-bs-dismiss="modal"></button>-->
          </div>
        </div>
      </div>
</div>

<div class="modal" id="mySummaryPdf" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-xl vertical-align-center">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header" style="font-weight: bold;font-size: 20px;">
              Download Executive Summary
          </div>
          <div class="modal-body">
              <?php
                  $get_file_name = basename($all_report_list_details['report_pdf_executive_summary']);
                  
                  if(file_exists('uploads/report_pdf/'.$all_report_list_details['report_pdf_executive_summary']))
                  {
                    $report_pdf = base_url.'uploads/report_pdf/'.$all_report_list_details['report_pdf_executive_summary'];
                  }
                  else
                  {
                    $report_pdf = base_url.'wp-content/uploads/pdf/'.$get_file_name;
                  }

              ?>
              <embed src="<?php echo $report_pdf ?>" frameborder="0" width="100%" height="700px">
              <!--<button type="button" class="btn-close" data-bs-dismiss="modal"></button>-->
          </div>
        </div>
      </div>
</div>

      <script src="<?php echo base_url ?>assets/js/jquery.min.js"></script>
        <script src="<?php echo base_url ?>assets/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url ?>assets/css/fontawesome-free-6.1.1-web/css/all.min.css">

    <script>
        const anchors = document.querySelectorAll('nav a')

        anchors.forEach(anchor => anchor.addEventListener("click", onClick));

        function onClick(e) {
            anchors.forEach(achor => achor.classList.remove('active'))
            e.target.classList.add('active')
        }
    </script>
      <script>
        $(document).ready(function () {
            $('select').niceSelect();
        });
//         $(document).scroll(function() {
// var y = $(this).scrollTop();
// if (y > 100) {
// $( ".navbar-header a" ).removeClass( "d-none" );
// $('.logo-nav').fadeIn();
// } else {
// $('.logo-nav').fadeOut();
// $( ".navbar-header a" ).addClass( "d-none" );
// }
// });
    </script>
