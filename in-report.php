<?php
include_once('config/config.php');
function noHTML($input, $encoding = 'UTF-8') {
   return htmlentities($input, ENT_QUOTES | ENT_HTML5, $encoding);
}

//fetch report details
// if(isset($_GET['title']) && $_GET['title']!='')
// {
    $title = 'captial-markets-dfi-kuwait';
    $report_list_details   = "select * from tbl_report where is_active = 1 and is_delete = 1 and report_slug='$title'";
    $all_report_list_details       = $objTypes->fetchRow($report_list_details); 
   
    //fetch related reports list
    $explore_reports_list_details   = "select * from tbl_report where is_active = 1 and is_delete = 1 and id NOT IN (".$all_report_list_details['id'].") order by created_date DESC limit 7";
    $all_explore_products_list_details       = $objTypes->fetchAll($explore_reports_list_details); 
//}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Marmore | Report</title>
    <meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="<?php echo base_url ?>assets/image/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="<?php echo base_url ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url ?>assets/css/responsive.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;501;600;700;800;900&display=swap"
        rel="stylesheet">
   
    

</head>
<style>
#more {display: none;}
</style>

<body class="individual-report">
    <div class="top-navbar">
        <div class="container">
            <div class="content-box d-flex align-items-center">
                <ul class="website-info">
                    <li>
                        <img src="<?php echo base_url ?>assets/image/Miconpng.png" alt="">
                        <a>Marmore</a>
                    </li>

                </ul>
                <ul>
                    <li>
                        <p>Look how we support our clients and partners through expertise and advisory </p>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="#" class=" btn-link">Go to Insights <i class="fa fa-long-arrow-right"
                                aria-hidden="true"></i></a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
    <nav class="navbar  navbar-inverse bg-inverse navbar-expand-lg fixed-top align-items-center" id="topNav">
        <div class="container-fluid pl-3 pr-3">
            <div class="navbar-header">
                <a class="navbar-brand logo-nav " href="#">
                    <img src="<?php echo base_url ?>./assets/image/logo.png">
                </a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item dropdown active has-megamenu"><a class="nav-link dropdown-toggle menu" role="button"
                            data-bs-toggle="dropdown" href="#">What We Do<span class="caret"><i
                                    class="fa-solid fa-chevron-down"></i></span></a>
                                 
                                    <div class="dropdown-menu megamenu" role="menu">
                                        <div class="row g-3">
                                            
                                            <div class="col-lg-4 col-12">
                                                <div class="col-megamenu">
                                                    <h6 class="title">Consulting</h6>
                                                    <ul class="list-unstyled">
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Strategic/Competitors Intelligence</a></li>
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Market Entry Strategies</a></li>
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Company Valuation</a></li>
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Business Plan</a></li>
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Digital Banking Intelligence</a></li>
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Fintech Adoption/Integration</a></li>
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Robo-advisory Solutions</a></li>
                                                    </ul>
                                                </div>  <!-- col-megamenu.// -->
                                            </div><!-- end col-3 -->
                                            <div class="col-lg-4 col-12">
                                                <div class="col-megamenu">
                                                    <h6 class="title">Market Advisory</h6>
                                                    <ul class="list-unstyled">
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Macro Economic Research</a></li>
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Industry Research</a></li>
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Capital Markets Research</a></li>
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Thematic Reports</a></li>
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">White Papers</a></li>
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">ESG Research</a></li>
                                                    </ul>
                                                </div>  <!-- col-megamenu.// -->
                                            </div>    
                                            <div class="col-lg-4 col-12">
                                                <div class="col-megamenu">
                                                    <h6 class="title">Published Research</h6>
                                                    <ul class="list-unstyled">
                                                        <li class="menu-lst"> <a class="mega-lnk" href="#">Research By Country</a></li>
                                                        <li class="menu-lst"><img src="<?php echo base_url ?>./assets/image/emojione_flag-for-kuwait.png" alt="" class="menu-imgs"><a class="mega-lnk" href="#">Kuwait</a></li>
                                                        <li class="menu-lst"><img src="<?php echo base_url ?>./assets/image/emojione_flag-for-saudi-arabia.png" alt="" class="menu-imgs"><a class="mega-lnk" href="#">Saudi Arabia</a></li>
                                                        <li class="menu-lst"><img src="<?php echo base_url ?>./assets/image/emojione_flag-for-united-arab-emirates.png" alt="" class="menu-imgs"><a class="mega-lnk" href="#">United Arab Emirates</a></li>
                                                        <li class="menu-lst"><img src="<?php echo base_url ?>./assets/image/emojione_flag-for-qatar.png" alt="" class="menu-imgs"><a class="mega-lnk" href="#">Qatar</a></li>
                                                        <li class="menu-lst"><img src="<?php echo base_url ?>./assets/image/emojione_flag-for-oman.png" alt="" class="menu-imgs"><a class="mega-lnk" href="#">Oman</a></li>
                                                        <li class="menu-lst"><img src="<?php echo base_url ?>./assets/image/emojione_flag-for-bahrain.png" alt="" class="menu-imgs"><a class="mega-lnk" href="#">Bahrain</a></li>
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">View All Reports</a></li>
                                                    </ul>
                                                </div>  <!-- col-megamenu.// -->
                                            </div><!-- end col-3 -->
                                        </div><!-- end row --> 
                                    </div> 
                        <div class="dot"></div>
                    </li>

                    <li class="nav-item dropdown has-megamenu"><a class="nav-link dropdown-toggle menu" role="button"
                            data-bs-toggle="dropdown" href="#">What We Work With<span class="caret"><i
                                    class="fa-solid fa-chevron-down"></i></span></a>

                                    <div class="dropdown-menu megamenu" role="menu">
                                        <div class="row g-3">
                                            
                                            <div class="col-lg-4 col-12">
                                                <div class="col-megamenu">
                                                    <h6 class="title">By Industry</h6>
                                                    <ul class="list-unstyled">
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Aviation</a></li>
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Banking</a></li>
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Brokerage</a></li>
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Contracting</a></li>
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Education</a></li>
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Hospitality</a></li>
                                                        
                                                    </ul>
                                                </div>  <!-- col-megamenu.// -->
                                            </div><!-- end col-3 -->
                                            <div class="col-lg-4 col-12">
                                                <div class="col-megamenu">
                                                    <h6 class="title">&nbsp;</h6>
                                                    <ul class="list-unstyled">
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Health Care</a></li>
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Insurance</a></li>
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Asset Management</a></li>
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Media</a></li>
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Petrochemical</a></li>
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Power</a></li>
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Water</a></li>
                                                    </ul>
                                                </div>  <!-- col-megamenu.// -->
                                            </div>    
                                            <div class="col-lg-4 col-12">
                                                <div class="col-megamenu">
                                                    <h6 class="title">&nbsp;</h6>
                                                    <ul class="list-unstyled">
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Ports</a></li>
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Retail</a></li>
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Real Estate</a></li>
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Remittance Indudstry</a></li>
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Road and Railways</a></li>
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Telecom</a></li>
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Wealth Mangement</a></li>
                                                        
                                                    </ul>
                                                </div>  <!-- col-megamenu.// -->
                                            </div><!-- end col-3 -->
                                        </div><!-- end row --> 
                                    </div>
                        <div class="dot"></div>
                    </li>

                    <li class="nav-item dropdown"><a class="menu" href="#">Customers</a>
                        <div class="dot"></div>
                    </li>

                    <li class="nav-item dropdown has-megamenu"><a class="nav-link dropdown-toggle menu" role="button"
                            data-bs-toggle="dropdown" href="#">Insights<span class="caret"><i
                                    class="fa-solid fa-chevron-down"></i></span></a>

                                    <div class="dropdown-menu megamenu" role="menu">
                                        <div class="row g-3">
                                            
                                            <div class="col-lg-4 col-12">
                                                <div class="col-megamenu">
                                                    <h6 class="title">Research</h6>
                                                    <ul class="list-unstyled">
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Blogs </a></li>
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Chart Bank</a></li>
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Marmore Radar - 202 In Review</a></li>
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">GCC Crisis Series</a></li>
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">ESG Research</a></li>
                                                        
                                                        
                                                    </ul>
                                                </div>  <!-- col-megamenu.// -->
                                            </div><!-- end col-3 -->
                                            <div class="col-lg-4 col-12">
                                                <div class="col-megamenu">
                                                    <h6 class="title">&nbsp;</h6>
                                                    <ul class="list-unstyled">
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Mamore Channel</a></li>
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Infographics</a></li>
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Webinar</a></li>
                                                       
                                                    </ul>
                                                </div>  <!-- col-megamenu.// -->
                                            </div>    
                                            <div class="col-lg-4 col-12">
                                               <img src="./assets/image/mega-menu.jpeg" alt="">
                                            </div><!-- end col-3 -->
                                        </div><!-- end row --> 
                                    </div>
                        <div class="dot"></div>
                    </li>

                    <li class="nav-item dropdown has-megamenu"><a class="nav-link dropdown-toggle menu" role="button"
                            data-bs-toggle="dropdown" href="#">About<span class="caret"><i
                                    class="fa-solid fa-chevron-down"></i></span></a>

                                    <div class="dropdown-menu megamenu" role="menu">
                                        <div class="row g-3">
                                            
                                            <div class="col-lg-4 col-12">
                                                <div class="col-megamenu">
                                                    <h6 class="title">About Marmore</h6>
                                                    <ul class="list-unstyled">
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Markaz - Parent Company </a></li>
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Journey So Far</a></li>
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Leadership</a></li>
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Mamore In News </a></li>
                                                       
                                                        
                                                        
                                                    </ul>
                                                </div>  <!-- col-megamenu.// -->
                                            </div><!-- end col-3 -->
                                            <div class="col-lg-4 col-12">
                                                <div class="col-megamenu">
                                                    <h6 class="title">&nbsp;</h6>
                                                    <ul class="list-unstyled">
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Careers</a></li>
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Contact  Us</a></li>
                                                        <li class="menu-lst"><a class="mega-lnk" href="#">Social Media</a></li>
                                                       
                                                    </ul>
                                                </div>  <!-- col-megamenu.// -->
                                            </div>    
                                            <div class="col-lg-4 col-12">
                                                <img src="<?php echo base_url ?>./assets/image/mega-menu.jpeg" alt="">
                                            </div><!-- end col-3 -->
                                        </div><!-- end row --> 
                                    </div>
                        <div class="dot"></div>
                    </li>

                    <li class="dropdown option">
                        <a class="menu" href="#"> <i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                    </li>
                    <li class="item buttons">
                        <a class="btn btn-theme" href="#"><span>Contact Us</span></a>
                    </li>
                    <li class="translate">
                        <a class="menu" href="#">عربي <i class="fa-solid fa-globe"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main>
        <div class="container-fluid breadcrumb1 pr-3 pl-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                    <li class="breadcrumb-item active">What we do</li>
                    <li class="breadcrumb-item active" aria-current="page">Strategic Competitor</li>
                    <li class="breadcrumb-item active" aria-current="page">Intelligence</li>
                </ol>
            </nav>
        </div>
       

        <section class="report-detailed" id="">
            <?php if(isset($all_report_list_details) && !empty($all_report_list_details)) { ?>
            <div class="container">
                <a href="#" class="r-link">Research Reports</a>
                <div class="report-book">
                <div class="row">
                <div class="col-lg-6">
                    <h1 class="report-content"><?php echo $all_report_list_details['report_name'] ?></h1>
                    <a class="btn btn-2 btn-blue" target="_blank" href="<?php echo base_url?>uploads/report_pdf/<?php echo $all_report_list_details['report_pdf']?>"><span>Download Executive Summary</span></a>
                </div>
                <div class="col-lg-6">
                    <div class="report-img">
                    <img src="<?php echo base_url ?>uploads/report_images/<?php echo $all_report_list_details['report_image'] ?>" alt="" class="book-card">
                </div>
                </div>
            </div>
            </div>
            </div>
            <div class="container con-r">
                

                <p><?php echo substr($all_report_list_details['report_long_desc'],0,250) ?><span id="dots">...</span><span id="more"><?php echo substr($all_report_list_details['report_long_desc'],251) ?></span></p>
                 
                 <div class="button-lnk"><a class="lnk" onclick="readMoreFunction()" id="readmore">Read More<i id="readMoreIcon" class="fa-solid fa-caret-down"></i></a>
                </div>
            </div>
            <?php } ?>
            <div class="container">
                <div class="box">
                    <h3 class="title" >Explore The Report</h3>
                  </div>
                  <div class="card-block">
                      <div class="row mb-3">
                          <?php 
                           if(isset($all_explore_products_list_details) && !empty($all_explore_products_list_details))
                           {
                               $count = 1;
                               foreach($all_explore_products_list_details as $all_explore_report)
                               {
                                   if($count != 3 )
                                   {
                          ?>
                        <div class="col-lg-3">
                            <div class="card">
                                  <h4 class="crd-title"><?php echo $all_explore_report['report_name'] ?></h4>
                                  <p class="crd-sub"><?php echo $all_explore_report['report_short_desc'] ?></p>
                                  <a href="#" class="crd-lnk">Global Private Equity Report  <i class="fa-solid fa-bookmark"></i></a>
                            </div>
                        </div>
                         <?php } else { ?>
                      <div class="col-lg-6">
                        <div class="card card-r">
                            <h4 class="crd-title"><?php echo $all_explore_report['report_name'] ?></h4>
                                  <p class="crd-sub"><?php echo $all_explore_report['report_short_desc'] ?></p>
                             <a href="#" class="crd-lnk crd1">Global Private Equity Report  <i class="fa-solid fa-bookmark"></i></a>
                            
                          </div>
                      </div>
                    <?php }  $count++; }   } ?>
                    </div>
                  </div>
            </div>
        </section>

    </main>

    <div class="container-fluid pb-0 mb-0 justify-content-center  ">
        <div class="contentbox">
            <div class="row bottom-cta">
                <div class="col-lg-6 left-bg">
                    <div class="tabout">
                        <h2 class="title">Ready to get started?</h3>
                            <p class="cta text-left">Book a free, personalized onboarding call with one of our
                                intelligence experts experts.</p>
                            <!-- <select class="wide center mt-5">
                                <option class="selected" value="0" selected>Business Plan</option>
                                <option class="selected" value="1">Business Plan</option>
                                <option class="selected" value="2">Business Plan</option>
                         
                            </select> -->
                    </div>
                </div>
                <div class="col-lg-6 cursus right-bg">
                    <div class="block">
                        <a class="btn btn-2 btn-blue" href="#"><span>Schedule Free Consultation Call</span></a>
                        <a class="btn btn-2 btn-theme2" href="#"><span>Submit RFQ</span></a>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <div class="row justify-content-center mb-0 pt-5 pb-0 row-2 px-3">
                <div class="col-12">
                    <div class="row row-2">
                        <div class="col-sm-6 ">
                            <div class="logo-part">
                                <img src="<?php echo base_url ?>assets/image/Group 6440.png" class="w-50 logo-footer">

                            </div>
                        </div>
                        <div class="col-sm-6 text-md-center"></div>
                        <div class="row">
                            <div class="col-sm-6 footer_content">
                                <p class="mb10 foot">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis
                                    pharetra non arcu nam. Enim curabitur nunc, proin facilisi ut in nunc, hac donec.
                                </p>
                                <span style="margin-right: 10px;"><i class="fa-brands fa-linkedin"></i></span><b
                                    class="social_icon">Linkedin</b>
                                <span style="margin-right: 10px;"><i class="fa-brands fa-facebook-square"></i></span><b
                                    class="social_icon">facebook</b>

                                <span style="margin-right: 10px;"><i class="fa-brands fa-medium"></i></span><b
                                    class="social_icon">medium</b>
                                <span style="margin-right: 10px;"><i
                                        class="fa-brands fa-youtube-square"></i></i></span><b
                                    class="social_icon">Youtube</b>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="mb10">Do you have a question on our report?<br>
                                            We'd be delighted to answer promptly</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="footer-btn px-4">
                                            <a href="#" class="btn-footer">Send an Enquiry Online</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-10 bootom-footer">
                                            <div class="phonenum">
                                                <span style="margin-right: 10px;"><i class="fa fa-phone"></i></span><b
                                                    class="phone_fa" style="margin-right:25px;">+91 44 4231 6217</b>
                                            </div>
                                            <div class="mail">
                                                <span style="margin-right: 10px;"><i
                                                        class="fa fa fa-envelope"></i></span><b
                                                    class="phone_fa1">enquiry@e-marmore.com</b>
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
                            <small>© All Rights Reserved 2022 | Marmore MENA Intelligence</small>
                        </div>
                        
                        <div class="col-md-6  my-auto text-md-left">
                            <small> <a class="foot_link" href="#">Privacy Policy</a> | <a class="foot_link"
                                    href="#">Terms & Conditions</a> | <a class="foot_link" href="#">FAQ</a> | <a
                                    class="foot_link" href="#">Sitemap</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
   
    
    <script src="assets/js/main.js"></script>
   <script>
function readMoreFunction() {
  var dots = document.getElementById("dots");
  var moreText = document.getElementById("more");
  var btnText = document.getElementById("readmore");
  var readMoreIcon = document.getElementById("readMoreIcon");
  if (dots.style.display === "none") {
    dots.style.display = "inline";
    // readMoreIcon.className = "fa fa-chevron-circle-right";
    btnText.innerHTML = "Read More";
    moreText.style.display = "none";
  } else {
    dots.style.display = "none";
    // readMoreIcon.className = "fa fa-chevron-circle-right";
    btnText.innerHTML = "Read Less"; 
    moreText.style.display = "inline";
  }
}
</script>
    <script>
        const anchors = document.querySelectorAll('nav a')

        anchors.forEach(anchor => anchor.addEventListener("click", onClick));

        function onClick(e) {
            anchors.forEach(achor => achor.classList.remove('active'))
            e.target.classList.add('active')
        }
    </script>
</body>

</html>