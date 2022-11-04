<?php
ini_set('display_errors',1);
include_once('config/config.php');
//fetch team
$service_our_team = "select * from tbl_service_our_team where is_active=1 and is_delete=1 order by sort_order ASC"; 
$service_our_team = $objTypes->fetchAll($service_our_team); 

//fetch blog
$blogdetails   = "select b.*,bc.* from tbl_blogs b inner join tbl_blogs_category bc on b.`category_id`=bc.id where b.is_active = 1 and b.is_delete = 1 order by b.created_date DESC limit 3";
$details       = $objTypes->fetchAll($blogdetails);

//fetch service
$title = isset($_GET['title'])?$_GET['title']:'';
$service_details       = "select * from tbl_service where is_active=1 and is_delete=1 and service_slug='$title'"; 
$service_details       = $objTypes->fetchRow($service_details);

//fetch all consulting service
$all_consulting_service_details       = "select * from tbl_service where is_active=1 and is_delete=1 and service_slug!='$title' order by id ASC limit 6"; 
$all_consulting_service_details       = $objTypes->fetchAll($all_consulting_service_details);

//fetch overview service
$fetch_service_overview_details = "select * from tbl_service_overview where is_active=1 and is_delete=1 and id=1";
$all_consulting_service         = $objTypes->fetchRow($fetch_service_overview_details);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Marmore Service</title>
    <meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?php echo base_url ?>style.css">
    <link rel="stylesheet" href="<?php echo base_url ?>responsive.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;501;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.1.1/css/hover.css"
        integrity="sha512-O0OajC2ZbewIBOO1RxRSm/kvJ0hn19ACNJXfBH0HflppYK9QCq9v/wfNdcKNs/Dh8IXFXc1URFame5IJVxLrWA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css"
        integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.40/css/uikit.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url ?>/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;501;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.1.1/css/hover.css"
        integrity="sha512-O0OajC2ZbewIBOO1RxRSm/kvJ0hn19ACNJXfBH0HflppYK9QCq9v/wfNdcKNs/Dh8IXFXc1URFame5IJVxLrWA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
</head>


<body>
<div class="top-navbar">
        <div class="container">
            <div class="content-box d-flex align-items-center">
                <ul class="website-info">
                    <li>
                        <img src="assets/image/Miconpng.png" alt="">
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
                    <img src="<?php echo base_url ?>./image/logo.png">
                </a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item dropdown active has-megamenu"><a class="nav-link dropdown-toggle menu"
                            role="button" data-bs-toggle="dropdown" href="#">What We Do<span class="caret"><i
                                    class="fa-solid fa-chevron-down"></i></span></a>

                        <div class="dropdown-menu megamenu" role="menu">
                            <div class="row g-3">

                                <div class="col-lg-4 col-12">
                                    <div class="col-megamenu">
                                        <h6 class="title">Consulting</h6>
                                        <ul class="list-unstyled">
                                            <li class="menu-lst"><a class="mega-lnk" href="#">Strategic/Competitors
                                                    Intelligence</a></li>
                                            <li class="menu-lst"><a class="mega-lnk" href="#">Market Entry
                                                    Strategies</a></li>
                                            <li class="menu-lst"><a class="mega-lnk" href="#">Company Valuation</a></li>
                                            <li class="menu-lst"><a class="mega-lnk" href="#">Business Plan</a></li>
                                            <li class="menu-lst"><a class="mega-lnk" href="#">Digital Banking
                                                    Intelligence</a></li>
                                            <li class="menu-lst"><a class="mega-lnk" href="#">Fintech
                                                    Adoption/Integration</a></li>
                                            <li class="menu-lst"><a class="mega-lnk" href="#">Robo-advisory
                                                    Solutions</a></li>
                                        </ul>
                                    </div> <!-- col-megamenu.// -->
                                </div><!-- end col-3 -->
                                <div class="col-lg-4 col-12">
                                    <div class="col-megamenu">
                                        <h6 class="title">Market Advisory</h6>
                                        <ul class="list-unstyled">
                                            <li class="menu-lst"><a class="mega-lnk" href="#">Macro Economic
                                                    Research</a></li>
                                            <li class="menu-lst"><a class="mega-lnk" href="#">Industry Research</a></li>
                                            <li class="menu-lst"><a class="mega-lnk" href="#">Capital Markets
                                                    Research</a></li>
                                            <li class="menu-lst"><a class="mega-lnk" href="#">Thematic Reports</a></li>
                                            <li class="menu-lst"><a class="mega-lnk" href="#">White Papers</a></li>
                                            <li class="menu-lst"><a class="mega-lnk" href="#">ESG Research</a></li>
                                        </ul>
                                    </div> <!-- col-megamenu.// -->
                                </div>
                                <div class="col-lg-4 col-12">
                                    <div class="col-megamenu">
                                        <h6 class="title">Published Research</h6>
                                        <ul class="list-unstyled">
                                            <li class="menu-lst"> <a class="mega-lnk" href="#">Research By Country</a>
                                            </li>
                                            <li class="menu-lst"><img src="<?php echo base_url ?>./assets/image/emojione_flag-for-kuwait.png"
                                                    alt="" class="menu-imgs"><a class="mega-lnk" href="#">Kuwait</a>
                                            </li>
                                            <li class="menu-lst"><img
                                                    src="<?php echo base_url ?>./assets/image/emojione_flag-for-saudi-arabia.png" alt=""
                                                    class="menu-imgs"><a class="mega-lnk" href="#">Saudi Arabia</a></li>
                                            <li class="menu-lst"><img
                                                    src="<?php echo base_url ?>./assets/image/emojione_flag-for-united-arab-emirates.png"
                                                    alt="" class="menu-imgs"><a class="mega-lnk" href="#">United Arab
                                                    Emirates</a></li>
                                            <li class="menu-lst"><img src="<?php echo base_url ?>./assets/image/emojione_flag-for-qatar.png"
                                                    alt="" class="menu-imgs"><a class="mega-lnk" href="#">Qatar</a></li>
                                            <li class="menu-lst"><img src="<?php echo base_url ?>./assets/image/emojione_flag-for-oman.png"
                                                    alt="" class="menu-imgs"><a class="mega-lnk" href="#">Oman</a></li>
                                            <li class="menu-lst"><img src="<?php echo base_url ?>./assets/image/emojione_flag-for-bahrain.png"
                                                    alt="" class="menu-imgs"><a class="mega-lnk" href="#">Bahrain</a>
                                            </li>
                                            <li class="menu-lst"><a class="mega-lnk" href="#">View All Reports</a></li>
                                        </ul>
                                    </div> <!-- col-megamenu.// -->
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
                                    </div> <!-- col-megamenu.// -->
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
                                    </div> <!-- col-megamenu.// -->
                                </div>
                                <div class="col-lg-4 col-12">
                                    <div class="col-megamenu">
                                        <h6 class="title">&nbsp;</h6>
                                        <ul class="list-unstyled">
                                            <li class="menu-lst"><a class="mega-lnk" href="#">Ports</a></li>
                                            <li class="menu-lst"><a class="mega-lnk" href="#">Retail</a></li>
                                            <li class="menu-lst"><a class="mega-lnk" href="#">Real Estate</a></li>
                                            <li class="menu-lst"><a class="mega-lnk" href="#">Remittance Indudstry</a>
                                            </li>
                                            <li class="menu-lst"><a class="mega-lnk" href="#">Road and Railways</a></li>
                                            <li class="menu-lst"><a class="mega-lnk" href="#">Telecom</a></li>
                                            <li class="menu-lst"><a class="mega-lnk" href="#">Wealth Mangement</a></li>

                                        </ul>
                                    </div> <!-- col-megamenu.// -->
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
                                            <li class="menu-lst"><a class="mega-lnk" href="#">Marmore Radar - 202 In
                                                    Review</a></li>
                                            <li class="menu-lst"><a class="mega-lnk" href="#">GCC Crisis Series</a></li>
                                            <li class="menu-lst"><a class="mega-lnk" href="#">ESG Research</a></li>


                                        </ul>
                                    </div> <!-- col-megamenu.// -->
                                </div><!-- end col-3 -->
                                <div class="col-lg-4 col-12">
                                    <div class="col-megamenu">
                                        <h6 class="title">&nbsp;</h6>
                                        <ul class="list-unstyled">
                                            <li class="menu-lst"><a class="mega-lnk" href="#">Mamore Channel</a></li>
                                            <li class="menu-lst"><a class="mega-lnk" href="#">Infographics</a></li>
                                            <li class="menu-lst"><a class="mega-lnk" href="#">Webinar</a></li>

                                        </ul>
                                    </div> <!-- col-megamenu.// -->
                                </div>
                                <div class="col-lg-4 col-12">
                                    <img src="<?php echo base_url ?>./assets/image/mega-menu.jpeg" alt="">
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
                                            <li class="menu-lst"><a class="mega-lnk" href="#">Markaz - Parent Company
                                                </a></li>
                                            <li class="menu-lst"><a class="mega-lnk" href="#">Journey So Far</a></li>
                                            <li class="menu-lst"><a class="mega-lnk" href="#">Leadership</a></li>
                                            <li class="menu-lst"><a class="mega-lnk" href="#">Mamore In News </a></li>



                                        </ul>
                                    </div> <!-- col-megamenu.// -->
                                </div><!-- end col-3 -->
                                <div class="col-lg-4 col-12">
                                    <div class="col-megamenu">
                                        <h6 class="title">&nbsp;</h6>
                                        <ul class="list-unstyled">
                                            <li class="menu-lst"><a class="mega-lnk" href="#">Careers</a></li>
                                            <li class="menu-lst"><a class="mega-lnk" href="#">Contact Us</a></li>
                                            <li class="menu-lst"><a class="mega-lnk" href="#">Social Media</a></li>

                                        </ul>
                                    </div> <!-- col-megamenu.// -->
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

<div class="container-fuild breadcrumb1 pr-3 pl-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
            <li class="breadcrumb-item active">Services</li>

        </ol>
    </nav>
</div>


<div class="container-fuild">

    <div class="content content1">

        <div class="row">
            <div class="col-lg-6">
                <div class="box-align" style="padding-right: 100px;">
                    <?php if(isset($service_details) && !empty($service_details)) { ?>
                    <div class="major-content">
                        <h2 class="title pt-4" style="font-weight:800;"><?php echo $service_details['service_head'] ?>
                        </h2>
                        <p class="sub-title pt-3"><?php echo $service_details['service_long_desc'] ?></p>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="col-lg-6 ">
                <div class="text-right world-img">
                    <img src="<?php echo base_url ?>uploads/service_images/<?php echo $service_details['service_img']?>"
                        alt="world" width="600">
                </div>

            </div>

        </div>

    </div>
</div>


    <section class="guides1" id="">

        <div class="tabs tabs-style-line">
            <nav class="tab-list">
                <ul>
                    <li class="tab-current"><a class="tab-section" href="#section-line-1"><span>Overview</span></a></li>
                    <li><a class="tab-section" href="#section-line-2"><span>Experience</span></a> </li>
                    <li><a class="tab-section" href="#section-line-3"><span>Our Team</span></a></li>
                    <li><a class="tab-section" href="#section-line-4"><span>Insights</span></a></li>
                    <li><a class="tab-section" href="#section-line-5"><span>How can we help?</span></a></li>
                </ul>
            </nav>
            <div class="content-wrap mt-4">
                <section id="section-line-1" class="content-current">
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="tablinks">
                               <?php if(isset($all_consulting_service) && !empty($all_consulting_service)) { ?>
                                <p><?php echo isset($all_consulting_service['overview_desc'])?$all_consulting_service['overview_desc']:''?></p>
                               <?php } ?>
                            </div>
                        </div>
                    </div>

                </section>

            </div><!-- /content -->
        </div><!-- /tabs -->
    </section>


    <!-- Hero -->
    <!-- <section class="et-hero-tabs">
    
    <div class="et-hero-tabs-container">
      <a class="et-hero-tab" href="#tab-es6">Overview</a>
      <a class="et-hero-tab" href="#tab-flexbox">Experience</a>
      <a class="et-hero-tab" href="#tab-react">Our Team</a>
      <a class="et-hero-tab" href="#tab-angular">Insights</a>
      <a class="et-hero-tab" href="#tab-other">How can we help?</a>
      <span class="et-hero-tab-slider"></span>
    </div>
  </section>

  <main class="et-main">
    <section class="et-slide" id="tab-es6">
      <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
    </section>
    <section class="et-slide" id="tab-flexbox">
        <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>

    </section>
    <section class="et-slide" id="tab-react">
        <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>

    </section>
    <section class="et-slide" id="tab-angular">
        <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>

    </section>
    <section class="et-slide" id="tab-other">
        <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>

    </section>
  </main> -->






    <div class="container-fuild">
        <div class="counter count1">
            <div class="row">
                <div class="col-lg-6 experts ex2" style="text-align: right;">
                    <?php if(isset($all_consulting_service) && !empty($all_consulting_service)) { ?>
                        <h1 class="values"><?php echo isset($all_consulting_service['exp_year'])?$all_consulting_service['exp_year']:''?>+</h1>
                        <p class="q_p"><?php echo isset($all_consulting_service['exp_title'])?$all_consulting_service['exp_title']:''?></p>
                    <?php } ?>
                    
                </div>
                <div class="col-lg-6 experts ex1" style="text-align: left;">
                    <?php if(isset($all_consulting_service) && !empty($all_consulting_service)) { ?>
                        <h1 class="values"><?php echo isset($all_consulting_service['exp_report_count'])?$all_consulting_service['exp_report_count']:''?>+</h1>
                        <p class="q_p"><?php echo isset($all_consulting_service['exp_report_title'])?$all_consulting_service['exp_report_title']:''?></p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <section class="guides" id="">
        <div class="tabout">
            <h2 class="pt-3 pb-2 text-center title">Our Team</h3>
                <p class="text-center">Lorem Ipsum passage, and going through the cites of the word in <br>classical
                    literature, discovered the undoubtable source.</p>
        </div>
        <div class="directors">
            <div class="row our-team-service">
                <?php if(isset($service_our_team) && !empty($service_our_team)) 
                       {
                           foreach($service_our_team as $our_team) {
                ?>
                <div class="col-lg-4">
                    <img src="<?php echo base_url ?>uploads/team_images/<?php echo $our_team['image'] ?>" alt="">
                    <h1 class="value1"><?php echo isset($our_team['name'])? $our_team['name']:''?></h1>
                    <p><?php echo isset($our_team['position'])? $our_team['position']:''?></p>
                </div>
                <?php } } ?>
            </div>
        </div>
    </section>
    <div class="container-fuild">
        <div class="counter1">
            <div class="item">
                <div class="card blog-card">
                    <div class="row no-gutters align-items-center">
                        <div class="col-sm-4" style="text-align: center;">
                            <img class="card-img" src="<?php echo base_url ?>image/Frame 6418.png" style="width: 300px;" alt="alt-img">
                        </div>
                        <div class="col-sm-8 align-items-center">
                            <div class="card-body">
                                <h2 class="card-title book-title" style="color: white;">Stategic Competitor/
                                    Intelligence</h2>
                                <p class="card-text book-text pt-3 pb-3">Strategic
                                    intelligence focuses on longer-term
                                    issues, such as key risks and opportunities facing the enterprise.
                                    In either case, competitive intelligence differs from corporate or industrial
                                    espionage, which relies on illegal and unethical methods to gain an unfair
                                    competitive advantage.</p>
                                <a class="btn btn-2" href="#" style="border-radius: 0;"><span>Get Report</span></a>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
    <section class="guides blog-list" id="" style="background-color: #EEF1FA;">
        <div class="tabout">
            <h2 class="pt-3 pb-3 text-center title">Blogs</h3>
                <p class="text-center">Lorem Ipsum passage, and going through the cites of the word in classical<br>
                    literature, discovered the undoubtable source.</p>
        </div>
        <div class="row">
            <?php if(isset($details) && !empty($details)) { 
              foreach($details as $details) {
            ?>
            <div class="col-lg-4">
                <div class="card blog-b">
                    <img class="card-img-top" src="<?php echo base_url ?>uploads/blog_images/<?php echo $details['blog_img'] ?>" alt="Card image" style="width:100%">
                    <div class="card-body ">
                        <a href="<?php echo base_url ?>blog/category/<?php echo $details['category_name'] ?>" class="btn-link"><?php echo $details['category_name'] ?></a>
                        <h4 class="card-title " style="margin-top: 20px;"><?php echo $details['blog_title'] ?></h4>
                        <p class="card-text"><?php echo $details['short_desc'] ?>
                        </p>
                        <a href="<?php echo base_url ?>blog/<?php echo $details['slug'] ?>" class="hvr-icon-forward btn-link">Read More </a>
                    </div>
                </div>
            </div>
            <?php } } ?>
        </div>
    </section>


    <section class="guides strategic" id="">
        <div class="tabout">
            <h2 class="pt-3 pb-3 text-center title">How Can We Help In Stategic <br>Competitor/ Intelligence ?</h3>
                <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra non
                    arcu<br> nam. Enim curabitur nunc, proin facilisi ut in nunc, hac donec. Odio faucibus<br> viverra
                    cursus in feugiat. Nisi pellentesque quis egestas tortor non.</p>
        </div>
        <div class="row pb-3">
                <?php if(isset($all_consulting_service_details) && !empty($all_consulting_service_details)) 
                { foreach($all_consulting_service_details as $consulting_service_details) { ?>
                <div class="col-lg-4">
                <div class="card blog-b">
                    <div class="card-body sheet ">
                        <img src="<?php echo base_url ?>./assets/image/Vector.png" alt="">
                        <h4 class="card-title cap " style="margin-top: 20px;"><?php echo isset($consulting_service_details['service_head'])?$consulting_service_details['service_head']:''?></h4>
                        <p class="card-text"><?php echo $consulting_service_details['service_short_desc'] ?></p>
                        <a href="<?php echo base_url ?>service/<?php echo $consulting_service_details['service_slug']?>" class=" btn-link">View More </a>
                    </div>
                </div>
                            </div>

                <?php } } ?>
        </div>
        <div class="link1 pt-5 pb-4" style="text-align: center;"><a href="#" class=" btn-link">View All Consulting
                Services</a>
        </div>
    </section>



    <div class="container-fluid pb-0 mb-0 justify-content-center  ">
        <div class="contentbox">
            <div class="row">
                <div class="col-lg-6 left-bg">
                    <div class="tabout  align-items-center" style="text-align: center;">
                        <h2 class="title">Ready To Talk? </h3>
                            <p class="cta">I want to talk to experts in</p>
                            <select class="wide center mt-5">
                                <option class="selected" value="0" selected>Business Plan</option>
                                <option class="selected" value="1">Business Plan</option>
                                <option class="selected" value="2">Business Plan</option>

                            </select>
                    </div>
                </div>
                <div class="col-lg-6 cursus right-bg">
                    <p class="">We look forward to answering<br> your questions and helping you<br> find a solution.</p>
                    <div class="mb-3 mt-3">
                        <input type="email" class="form-control" id="email" placeholder="Email Address" name="email">
                    </div>
                    <a class="btn btn-2 btn-blue" href="#"><span>Contact Us</span></a>
                </div>
            </div>
        </div>

        <footer>
            <div class="row justify-content-center mb-0 pt-5 pb-0 row-2 px-3">
                <div class="col-12">
                    <div class="row row-2">
                        <div class="col-sm-6 ">
                            <div class="logo-part">
                                <img src="<?php echo base_url ?>image/Group 6440.png" class="w-50 logo-footer">

                            </div>
                        </div>
                        <div class="col-sm-6 text-md-center"></div>
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="mb10">Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br> Duis
                                    pharetra non arcu nam. Enim curabitur nunc, proin <br>facilisi ut in nunc, hac
                                    donec.</p>
                                <span style="margin-right: 10px;"><i class="fa fa-linkedin-square fa-lg"></i></span><b
                                    style="margin-right:25px ;">Linkedin</b>
                                <span style="margin-right: 10px;"><i class="fa fa-facebook"></i></span><b
                                    style="margin-right:25px ;">facebook</b>

                                <span style="margin-right: 10px;"><i class="fa fa-medium"></i></span><b
                                    style="margin-right:25px ;">medium</b>
                                <span style="margin-right: 10px;"><i class="fa  fa-youtube"></i></span><b
                                    style="margin-right:25px ;">Youtube</b>
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
                                        <div class="col-sm-10">
                                            <span style="margin-right: 10px;"><i class="fa fa-phone"></i></span><b
                                                style="margin-right:25px ;">+91 44 4231 6217</b>
                                            <span style="margin-right: 10px;"><i class="fa fa fa-envelope"></i></span><b
                                                style="margin-right:25px ;">enquiry@e-marmore.com</b>
                                        </div>
                                        <div class="col-sm-10"></div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-0 pt-0 row-1 mb-0  px-sm-3 px-2">
                <div class="col-12">
                    <div class="row my-4 row-1 no-gutters">
                        <div class="col-sm-4 col-auto pl-50">
                            <small>© All Rights Reserved 2022 | Marmore MENA Intelligence</small>
                        </div>
                        <div class="col-md-4 col-auto ">

                        </div>
                        <div class="col-md-4  my-auto text-md-left">
                            <small> Privacy Policy | Terms & Conditions | FAQ | Sitemap </small>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.js"></script>

    <!-- <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script> -->
    <script>
        $(document).ready(function () {
            $('select').niceSelect();
        });


        (function (window) {

            'use strict';

            function extend(a, b) {
                for (var key in b) {
                    if (b.hasOwnProperty(key)) {
                        a[key] = b[key];
                    }
                }
                return a;
            }

            function CBPFWTabs(el, options) {
                this.el = el;
                this.options = extend({}, this.options);
                extend(this.options, options);
                this._init();
            }

            CBPFWTabs.prototype.options = {
                start: 0
            };

            CBPFWTabs.prototype._init = function () {
                // tabs elems
                this.tabs = [].slice.call(this.el.querySelectorAll('nav > ul > li'));
                // content items
                this.items = [].slice.call(this.el.querySelectorAll('.content-wrap > section'));
                // current index
                this.current = -1;
                // show current content item
                this._show();
                // init events
                this._initEvents();
            };

            CBPFWTabs.prototype._initEvents = function () {
                var self = this;
                this.tabs.forEach(function (tab, idx) {
                    tab.addEventListener('click', function (ev) {
                        ev.preventDefault();
                        self._show(idx);
                    });
                });
            };

            CBPFWTabs.prototype._show = function (idx) {
                if (this.current >= 0) {
                    this.tabs[this.current].className = this.items[this.current].className = '';
                }
                // change current
                this.current = idx != undefined ? idx : this.options.start >= 0 && this.options.start < this.items.length ? this.options.start : 0;
                this.tabs[this.current].className = 'tab-current';
                this.items[this.current].className = 'content-current';
            };

            // add to global namespace
            window.CBPFWTabs = CBPFWTabs;

        })(window);

        (function () {

            [].slice.call(document.querySelectorAll('.tabs')).forEach(function (el) {
                new CBPFWTabs(el);
            });

        })();


        (function () {

            [].slice.call(document.querySelectorAll('.tabs')).forEach(function (el) {
                new CBPFWTabs(el);
            });

        })();

        class StickyNavigation {

            constructor() {
                this.currentId = null;
                this.currentTab = null;
                this.tabContainerHeight = 70;
                let self = this;
                $('.et-hero-tab').click(function () {
                    self.onTabClick(event, $(this));
                });
                $(window).scroll(() => { this.onScroll(); });
                $(window).resize(() => { this.onResize(); });
            }

            onTabClick(event, element) {
                event.preventDefault();
                let scrollTop = $(element.attr('href')).offset().top - this.tabContainerHeight + 1;
                $('html, body').animate({ scrollTop: scrollTop }, 600);
            }

            onScroll() {
                this.checkTabContainerPosition();
                this.findCurrentTabSelector();
            }

            onResize() {
                if (this.currentId) {
                    this.setSliderCss();
                }
            }

            checkTabContainerPosition() {
                let offset = $('.et-hero-tabs').offset().top + $('.et-hero-tabs').height() - this.tabContainerHeight;
                if ($(window).scrollTop() > offset) {
                    $('.et-hero-tabs-container').addClass('et-hero-tabs-container--top');
                }
                else {
                    $('.et-hero-tabs-container').removeClass('et-hero-tabs-container--top');
                }
            }

            findCurrentTabSelector(element) {
                let newCurrentId;
                let newCurrentTab;
                let self = this;
                $('.et-hero-tab').each(function () {
                    let id = $(this).attr('href');
                    let offsetTop = $(id).offset().top - self.tabContainerHeight;
                    let offsetBottom = $(id).offset().top + $(id).height() - self.tabContainerHeight;
                    if ($(window).scrollTop() > offsetTop && $(window).scrollTop() < offsetBottom) {
                        newCurrentId = id;
                        newCurrentTab = $(this);
                    }
                });
                if (this.currentId != newCurrentId || this.currentId === null) {
                    this.currentId = newCurrentId;
                    this.currentTab = newCurrentTab;
                    this.setSliderCss();
                }
            }

            setSliderCss() {
                let width = 0;
                let left = 0;
                if (this.currentTab) {
                    width = this.currentTab.css('width');
                    left = this.currentTab.offset().left;
                }
                $('.et-hero-tab-slider').css('width', width);
                $('.et-hero-tab-slider').css('left', left);
            }

        }

        new StickyNavigation();
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