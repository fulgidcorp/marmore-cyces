<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
//if(isset($parent) && ($parent=='service'))
//{
?>
<!--<div class="link1 pb-5" style="text-align: center;"><a href="#" class=" btn-link">View All Consulting-->
<!--                Services</a>-->
<!--        </div>-->
<?php //} ?>
<?php 
if(isset($parent) && $parent=='Home')
{ 
?>
<section class="guides home-footer-section" id="footer-forms">
    <div class="tabout text-center">
        <div class="row pd-10">
          <div class="row pd-10">
            <div class="col-lg-6">
                <p class="box-contend text-left"><b>Research On the Go</b></p>
                <span class="pb-3 text-left" style="display:block;font-size:15px">Whatsapp Broadcast
Send YES to +965 9405 9005 from Whatsapp to Subscribe</span>
                <script charset="utf-8" type="text/javascript" src="//js-eu1.hsforms.net/forms/v2.js"></script>
                <script>
                  hbspt.forms.create({
                    region: "eu1",
                    portalId: "26031663",
                    formId: "5c4ad4da-863a-4c08-824b-6bb6067d35a3"
                  });
                </script>
            </div>
            <div class="col-lg-6">
                <p class="box-contend text-left"><b>Subscribe To Your Newsletter</b></p>
                <span class="pb-3 text-left" style="display:block;font-size:15px">Receive insightful research regularly.</span>
                <script charset="utf-8" type="text/javascript" src="//js-eu1.hsforms.net/forms/v2.js"></script>
                <script>
                  hbspt.forms.create({
                    region: "eu1",
                    portalId: "26031663",
                    formId: "8508e3f2-87b8-4942-8a5b-281d3e8c4d48"
                  });
                </script>
            </div>
          </div>
        </div>
    </div>
  </section>
    

<?php }

?>

<?php 

if(isset($parent) && $parent=='service' && $path[1]='service' && $path[2]=='capital-markets-research')
{ 
$daily_research = "select id,date_of_upload,pdf,type_of_upload,is_active,is_delete from tbl_daily_research where is_active=1 and is_delete=1 order by date_of_upload DESC limit 4";

//$daily_research = "select id,max(date_of_upload) AS date_of_upload,pdf,type_of_upload,is_active,is_delete from tbl_daily_research where is_active=1 and is_delete=1 group by type_of_upload";
//echo $daily_research;exit;
$daily_research       = $objTypes->fetchAll($daily_research); 

?>
<section class="guides" id="">
    <div class="tabout text-center">
      <h2 class="pt-3 pb-3 text-center title">Daily Research</h3>
        <p class="text-center">We publish daily research and updates. Download the latest one below. </p>
        <a href="<?php echo base_url.$lang ?>/daily-research" class="theme-color text-center">View Archive <i class="fa fa-long-arrow-right theme-color"
                  aria-hidden="true"></i></a>
        <div class="row pd-10">
            <?php if(isset($daily_research) && count($daily_research)>0) { 
              foreach($daily_research as $daily_research)
              {
                  if($daily_research['type_of_upload']==1)
				     {
				         $type='Weekly Wrap';
				     }
				     else if($daily_research['type_of_upload']==2)
				     {
				         $type='Daily Morning Brief';
				     }
				     else if($daily_research['type_of_upload']==3)
				     {
				         $type='MENA Fixed Income Daily';
				     }
				     else
				     {
				         $type='Monthly Market Review (MMR)';
				     }
				     $blog_image = pathinfo($daily_research['pdf']);
				     
                     if(isset($daily_research['pdf']) && isset($blog_image['dirname']) && $blog_image['dirname']=='.')
                      {
                          //echo '1';
                          $img = base_url.'uploads/daily_research_pdf/'.$daily_research['pdf'];
                      }
                      else if(isset($daily_research['pdf']) && isset($blog_image['dirname']))
                      {
                          //echo '2';
                          $img = $daily_research['pdf'];
                      }
                      else
                      {
                          //echo '3';
                          $img = base_url.'uploads/daily_research_pdf/Group 160532.png';
                      }
            ?>
          <div class="col-lg-3">
            <div class="icon-boxes-h1" onclick='window.open("<?php echo $img ?>","","width=600,height=600,scrollbars=Yes,resizable=yes")'>
            <div class="icon text-left"><img src="<?php echo base_url ?>/assets/image/pdf1.png"  onerror="this.style.display='none'" height="50" width="40" />
              </div>
              <p class="home-sub text-left"><?php echo date("F d, Y",strtotime($daily_research['date_of_upload'])) ?></p>
              <h3 class="text-left icon-home1"><?php echo $type ?></h3>
            </div>
          </div>
          <?php  } } ?>
        </div>
    </div>
  </section>
    
    
<?php }

?>
 <?php if(isset($parent) && ($parent=='Home' || $parent=='clients')) { 
        ?>
        <div class="container-fluid pb-0 mb-0 justify-content-center text-light ">
          <div class="row justify-content-center">
          <div class="card mg-5 cta border-0">
              <div class="card-body">
                  <div class="row justify-content-center">
                    <div class="col-md-4 col">
                    <div class="cta-box text-center">
                    <h2 class="contains text-white">Ready to get started ?</h2>
                      <p class="pt-3 color-text pb-4">Book a free, personalized onboarding call with our senior consultants.</p>
                      <a class="btn btn-2" href="#" data-bs-toggle="modal" data-bs-target="#freeConsulting"><span>Schedule Free Consulting Call</span></a>
                      <a class="btn btn-1 ml-30"  href="#" data-bs-toggle="modal" data-bs-target="#submitrfq"><span>Submit RFP</span></a>
                    </div>
                    </div>
                </div>
              </div>                       
      </div>
  </div>
</div>
        <?php } ?>
        <?php if(isset($parent) && ($parent=='data-book' || $parent=='industry')) { ?>
        <div class="container-fluid pb-0 mb-0 justify-content-center  ">
        <div class="contentbox">
            <div class="row bottom-cta">
                <div class="col-lg-6 left-bg">
                    <div class="tabout">
                    
                    <h2 class="title"><b>Ready to Get Started?</b></h2>
                      <p class="cta text-left">How can we help your business? Let's get connected</p>
                        <!--<h2 class="title">Ready to get started?</h3>-->
                        <!--    <p class="cta text-left">Book a free, personalized onboarding call with one of our-->
                        <!--        intelligence experts experts.</p>-->
                    </div>
                </div>
                <div class="col-lg-6 cursus right-bg">
                    <div class="block">
                        <a class="btn btn-2 btn-blue" href="#" data-bs-toggle="modal" data-bs-target="#freeConsulting"><span>Schedule Free Consultation Call</span></a>
                        <a class="btn btn-2 btn-theme2"  href="#" data-bs-toggle="modal" data-bs-target="#submitrfq"><span>Submit RFP</span></a>

                    </div>
                </div>
            </div>
        </div>
        </div>
        

        <?php } ?>
        <?php if(isset($parent) && ($parent=='service' || $parent=='blog' || $parent=='report')) 
        { ?>
        
        <div class="contentbox">
                            <form id="subscribe" class="footer-subscribe">

            <div class="row">
                <div class="col-lg-6 left-bg">
                    <div class="tabout">
                        <?php if(isset($parent) && $parent=='blog') { ?>
                        <h2 class="title">Ready to get started?</h3>
                        <?php } else { ?>
                        <h2 class="title">Let’s Connect To Know More</h3>
                        <p class="cta">We look forward to answering your questions
and helping you find a solution.</p>
                        <?php } ?>
                            <!--<p class="cta">I want to talk to experts in,</p>-->
                            
                    </div>
                </div>
               
                <div class="col-lg-6 cursus right-bg">
                        <script charset="utf-8" type="text/javascript" src="//js-eu1.hsforms.net/forms/v2.js"></script>
                        <script>
                          hbspt.forms.create({
                            region: "eu1",
                            portalId: "26031663",
                            formId: "a3afb3df-5f5c-4bc3-8fbe-af70e881a8ee"
                          });
                        </script>
                </div>
                </div>
                 
            </div>
           </form>
        </div>
    
       <?php } ?>
       <?php if(isset($path[1]) && $path[1]=='careers' && $path[1]!='service') { 
         $fetch_all_jobs =$objTypes->fetchAll("select * from tbl_career_jobs where is_active=1 and is_delete=1");
         if(isset($fetch_all_jobs) && !empty($fetch_all_jobs))
         {
       ?>
       <section class="career-blog">
        <div class="container">
            <div class="tabout">
                <h2 class="text-center title">Build Your Future</h2>
            </div>
            <?php foreach($fetch_all_jobs as $all_jobs) { 
              if($all_jobs['work_type']==1)
              {
                  $type="Full Time";
              }
              else
              {
                  $type ="Part Time";
              }
            ?>
            <div class="career-card">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="create">
                            <h4 class="Schedule-card d-inline"><?php echo $all_jobs['position']?></h4><span class="online"><?php echo $type ?></span>
                        </div>
                        <p class="">
                            <span style="margin-right: 30px;"><i class="fa-solid fa-suitcase"
                                    style="margin-right: 10px;"></i> <?php echo $all_jobs['position_type'] ?></span>
                                    <span><i class="fa-solid fa-clock" style="margin-right: 10px;"></i>2 Hour Ago</span>

                        </p>

                        <p><span><i class="fa-solid fa-location-dot" style="margin-right: 10px;"></i><?php echo $all_jobs['office_address']?></span></p>
                    </div>
                    <div class="col-lg-6 text-right">
                        <a class="btn btn-theme" href="#"  data-bs-toggle="modal" data-bs-target="#job-apply"><span>Apply Now</span><i class="fa fa-long-arrow-right"
                                aria-hidden="true" style="margin-left: 10px;"></i></a>

                    </div>
                </div>
            </div>
           <?php } ?>
        </div>
    </section>

 <?php } } ?>
 <footer>
            <div class="row justify-content-center mb-0 pt-5 pb-0 row-2 px-3">
                <div class="col-12">
                    <div class="row row-2">
                        <div class="col-sm-6 ">
                            <div class="logo-part">
                                <img src="<?php echo base_url ?>/assets/image/footer-logo.svg" class="w-50 logo-footer">

                            </div>
                        </div>
                        <div class="col-sm-6 text-md-center"></div>
                        <div class="row">
                            <div class="col-sm-6 footer_content">
                                <p class="mb10 foot">Your Preferred Consultant And Market Advisory Partner In The Middle East.
                                </p>
                                <a href="https://www.linkedin.com/company/marmore-mena" target="_blank"><span style="margin-right: 10px;"><i class="fa-brands fa-linkedin"></i></span><b
                                    class="social_icon">Linkedin</b></a>
                                <a href="https://www.facebook.com/marmoremena" target="_blank"><span style="margin-right: 10px;"><i class="fa-brands fa-facebook-square"></i></span><b
                                    class="social_icon">facebook</b></a>

                                 <a href="https://twitter.com/marmoremena" target="_blank">
                                     <span style="margin-right: 10px;"><i class="fa-brands fa-twitter"></i></span>
                                          <b class="social_icon">Twitter</b>
                                </a>
                              
                                <a href="https://www.youtube.com/user/marmoreMENA" target="_blank"> <span style="margin-right: 10px;">
                                    <i class="fa-brands fa-youtube-square"></i>
                               </span>
                                    <b class="social_icon">Youtube</b></a>
                                    
                               <a href="https://www.instagram.com/marmore_mena" target="_blank"> <span style="margin-right: 10px;">
                                    <i class="fa-brands fa-instagram-square"></i>
                               </span>
                                    <b class="social_icon">Instagram</b></a>
                                    
                            <a href="https://api.whatsapp.com/send?phone=96594059005" target="_blank"> <span style="margin-right: 10px;">
                                    <i class="fa-brands fa-whatsapp-square"></i>
                               </span>
                                    <b class="social_icon">Whatsapp</b></a>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <p class="mb10">Do you have a question for us?<br>
                                            We will be delighted to answer</p>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="footer-btn px-4">
                                            <a class="btn-footer" href="<?=base_url.$lang."/enquiry"?>">Send an Enquiry Online</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-10 bootom-footer">
                                            <!--<div class="phonenum">-->
                                            <!--    <span style="margin-right: 10px;"><i class="fa fa-phone"></i></span><b-->
                                            <!--        class="phone_fa" style="margin-right:25px;"><a href="tel:+91 44 4231 6217">+91 44 4231 6217</a></b>-->
                                            <!--</div>-->
                                            <div class="mail">
                                                <span style="margin-right: 10px;"><i
                                                        class="fa fa fa-envelope"></i></span><b
                                                    class="phone_fa1"><a href="mailto:enquiry@e-marmore.com">enquiry@e-marmore.com</a></b>
                                            </div>
                                        </div>
                                        <div class="col-sm-10"></div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-sm-3 text-md-center">
                           <h5><span> <i class="fa fa-firefox text-light" aria-hidden="true"></i></span><b>  Stride</b></h5></div>
                         <div class="col-sm-3  my-sm-0 mt-5">
                           <ul class="list-unstyled"><li class="mt-0">Platform</li><li>Help Center</li><li>Security</li></ul></div>
                         <div class="col-sm-3  my-sm-0 mt-5">
                           <ul class="list-unstyled"><li class="mt-0">Customers</li><li>Use Cases</li><li>Customers Services</li></ul></div>
                         <div class="col-sm-3  my-sm-0 mt-5">
                           <ul class="list-unstyled"><li class="mt-0">Company</li><li>About</li><li>Careers- <span class="Careers">We're-hiring</span></li></ul></div>-->
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-0 pt-0 row-1 mb-0  px-sm-3 px-2">
                <div class="col-12">
                    <div class="row my-4 row-1 no-gutters">
                        <div class="col-sm-6 col-auto pl-50">
                            <small>Copyright © <?=date("Y")?> Marmore MENA Intelligence All Rights Reserved.</small>
                        </div>
                        <div class="col-md-6  my-auto text-md-end pr-md-50">
                            <small> <a class="foot_link" href="<?=base_url.$lang."/privacy-policy"?>">Privacy Policy</a> | <a class="foot_link"
                                    href="<?=base_url.$lang."/terms-conditions"?>">Terms & Conditions</a> | <a class="foot_link" href="<?php echo base_url.$lang ?>/faq" target="_blank">FAQ</a> | <a
                                    class="foot_link" href="<?=base_url?>sitemap.xml">Sitemap</a> </small>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Start of HubSpot Embed Code -->
<script type="text/javascript" id="hs-script-loader" async defer src="//js-eu1.hs-scripts.com/26031663.js"></script>
<!-- End of HubSpot Embed Code -->
        <div class="modal" id="job-apply" style="display: none; padding-left: 0px;" aria-modal="true" role="dialog">
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
              <div class="col-lg-7">
                <div class="model-r">
                  <h3 class="title1 text-left">Job Apply</h3>
                  <p class="model-sub text-left">Please submit the form below. Our relationship manager will
                    reach out
                    to you.</p>
                    <script charset="utf-8" type="text/javascript" src="//js-eu1.hsforms.net/forms/v2.js"></script>
                    <script>
                      hbspt.forms.create({
                        region: "eu1",
                        portalId: "26031663",
                        formId: "79d45c22-4d83-48df-b782-651f2181b773"
                      });
                    </script>
                </div>
              </div>
            </div>
           
          </div>
        </div>
      </div>
</div>

                <div class="modal" id="submitrfq" style="display: none;" aria-modal="true" role="dialog">
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
                          <div class="col-lg-7">
                            <div class="model-r">
                              <h3 class="title1 text-left">Submit your RFP</h3>
                              
                              <p class="model-sub text-left">Please submit the form below. Our relationship manager will
                                reach out
                                to you.</p>
                                <script charset="utf-8" type="text/javascript" src="//js-eu1.hsforms.net/forms/v2.js"></script>
                                <script>
                                  hbspt.forms.create({
                                    region: "eu1",
                                    portalId: "26031663",
                                    formId: "c6a63826-1e1b-4cd7-9102-e3bb48a9a1cf"
                                  });
                                </script>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

        <div class="modal" id="freeConsulting" style="display: none;" aria-modal="true" role="dialog">
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
                          <div class="col-lg-7">
                            <div class="model-r">
                              <h3 class="title1 text-left">Enquiry</h3>
                              <p class="model-sub text-left">Please submit the form below. Our relationship manager will
                                reach out
                                to you.</p>
                                <script charset="utf-8" type="text/javascript" src="//js-eu1.hsforms.net/forms/v2.js"></script>
                                <script>
                                  hbspt.forms.create({
                                    region: "eu1",
                                    portalId: "26031663",
                                    formId: "84d0ffb3-522a-4430-9828-61a6929ad708"
                                  });
                                </script>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

