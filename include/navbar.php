<?php
// echo '<pre>';
// print_r($path);
// exit;
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include_once('config/config.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!--<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">-->
  <?php 
    if(isset($path) && $path[1]=='reports' && $path[2]!='')
     {
        $title = $path[2];
        $find_seo_details   = "select * from tbl_report_data where is_active = 1 and is_delete = 1 and wp_slug='$title'";
        $all_find_seo_details   = $objTypes->fetchRow($find_seo_details); 
         if(isset($all_find_seo_details) && !empty($all_find_seo_details))
         {
?>
<title><?php echo (isset($all_find_seo_details['report_seo_title']) && !empty($all_find_seo_details['report_seo_title']))?$all_find_seo_details['report_seo_title']:$all_find_seo_details['report_name'] ?></title>
  <meta name="description" content="<?php echo $all_find_seo_details['report_seo_description'] ?>" />
<?php
         }
     }
     else if(isset($path) && $path[1]=='industry' && $path[2]!='')
     {
           $title = $path[2];
           $find_industryseo_details   = "select * from tbl_industry where is_active = 1 and is_delete = 1 and slug='$title'";
           $all_find_industryseo_details   = $objTypes->fetchRow($find_industryseo_details); 
            if(isset($all_find_industryseo_details) && !empty($all_find_industryseo_details))
            {
    ?>

        <title><?php echo (isset($all_find_industryseo_details['seo_title']) && !empty($all_find_industryseo_details['seo_title']))?$all_find_industryseo_details['seo_title']:$all_find_industryseo_details['title'] ?></title>
        <meta name="description" content="<?php echo $all_find_industryseo_details['seo_desc'] ?>" />
     <?php
            }
     }
     else if(isset($path) && $path[1]=='clients' && $path[2]!='')
     {
           $title = $path[2];
           $find_clientseo_details   = "select * from tbl_client_stories where is_active = 1 and is_delete = 1 and slug='$title'";
           $all_find_clientseo_details   = $objTypes->fetchRow($find_clientseo_details); 
            if(isset($all_find_clientseo_details) && !empty($all_find_clientseo_details))
            {
    ?>
        <title><?php echo (isset($all_find_clientseo_details['seo_title']) && !empty($all_find_clientseo_details['seo_title']))?$all_find_clientseo_details['seo_title']:$all_find_clientseo_details['story_title'] ?></title>
        <meta name="description" content="<?php echo $all_find_clientseo_details['seo_desc'] ?>" />
     <?php
            }
     }
     else if(isset($path) && $path[1]=='data-book' && $path[2]!='')
     {
           $title = $path[2];
           $find_databookseo_details   = "select * from tbl_data_book where is_active = 1 and is_delete = 1 and slug='$title'";
           $all_find_databookseo_details   = $objTypes->fetchRow($find_databookseo_details); 
           
            if(isset($all_find_databookseo_details) && !empty($all_find_databookseo_details))
            {
    ?>
        <title><?php echo (isset($all_find_databookseo_details['seo_title']) && !empty($all_find_databookseo_details['seo_title']))?$all_find_databookseo_details['seo_title']:$all_find_databookseo_details['data_book_name'] ?></title>
        <meta name="description" content="<?php echo $all_find_databookseo_details['seo_desc'] ?>" />
     <?php
            }
     }
     else if(isset($path) && $path[1]=='insights' && $path[2]!='')
     {
        //    $title = $path[2];
        //    $find_blogseo_details   = "select * from tbl_blogs where is_active = 1 and is_delete = 1 and slug='$title'";
        //    $all_find_blogseo_details   = $objTypes->fetchRow($find_blogseo_details); 
           
           $title = $path[2];
           $find_blogseo_details   = "select * from tbl_blogs where is_active = 1 and is_delete = 1 and slug='$title'";
           $all_find_blogseo_details   = $objTypes->fetchRow($find_blogseo_details); 
           
            if(isset($all_find_blogseo_details) && !empty($all_find_blogseo_details))
            {
                $blog_image = pathinfo($all_find_blogseo_details['media_image']);
                                         
                if(isset($all_find_blogseo_details['media_image']) && isset($blog_image['dirname']) && $blog_image['dirname']=='.')
                {
                    $img = base_url.'uploads/blog_images/'.$all_find_blogseo_details['media_image'];
                }
                else if(isset($all_find_blogseo_details['media_image']) && isset($all_find_blogseo_details['dirname']))
                {
                    $img = $all_find_blogseo_details['media_image'];
                }
                else
                {
                    $img = base_url.'uploads/blog_images/Group160532.png';
                }
    ?>
        <meta name="description" property="og:description" content="<?php echo $all_find_blogseo_details['seo_desc'] ?>" />
        <meta name="image" property="og:image" content="<?php echo $img ?>"> 
        <!-- <meta name="twitter:image" content="<?php //echo $img ?>"> -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="<?php echo $all_find_blogseo_details['seo_title']?>">
        <meta name="twitter:description" content="<?php echo $all_find_blogseo_details['seo_desc'] ?>">
        <meta name="twitter:image" content="<?php echo $img ?>">
     <?php
            }
     }
     else{
  ?>
  <title><?php echo $prev_row['meta_title'] ?></title>
  <meta name="description" content="<?php echo $prev_row['meta_description'] ?>" />
   <?php  } ?>
  <link rel="icon" type="image/x-icon" href="/image/icon.png">
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <link rel="stylesheet" href="<?php echo base_url ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url ?>assets/css/uikit.min.css">
    <link rel="stylesheet" href="<?php echo base_url ?>assets/css/splide.min.css">
    <link rel="stylesheet" href="<?php echo base_url ?>assets/css/hover.css">
    <link rel="stylesheet" href="<?php echo base_url ?>assets/css/fontawesome-free-6.1.1-web/css/all.min.css">

  <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css"  crossorigin="anonymous" referrerpolicy="no-referrer" />-->
  <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A==" crossorigin="anonymous" referrerpolicy="no-referrer" />-->
  <!--<link href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.40/css/uikit.min.css" rel="stylesheet">-->
  <link rel="stylesheet" href="<?php echo base_url ?>style.css">
  <link rel="stylesheet" href="<?php echo base_url ?>responsive.css">
  <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />-->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;501;600;700;800;900&display=swap" rel="stylesheet">
  <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">-->
  <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.css">-->
  <style>
 
                .splide__slide img{
                    width: 100%;
                    height: 550px;
                    object-fit: cover;
                    opacity: 0.5;
                    transition: all 0.5 ease-in-out;
                }
                .splide__slide.is-visible img{
                    opacity: 1;
                }
                .splide__arrow--prev {
                    left: 9em;
                }
                .splide__arrow--next {
                    right: 9em;
                }
            </style>
  

  <link rel="alternate" hreflang="x-default" href="https://www.marmoremena.com/"/>
<link rel="alternate" hreflang="en-us" href="https://www.marmoremena.com/"/>
<script type="application/ld+json">

{ "@context": "https://schema.org",

"@type": "Organization",

"name": "Marmore MENA",

"legalName" : "Marmore MENA Intelligence Pvt Ltd",

"url": "https://www.marmoremena.com",

"logo": "https://www.marmoremena.com/wp-content/themes/marmore/img/Marmore_Markazlogo.png",

"foundingDate": "2010",

"parentOrganization": [

{

"@type": "Organization",

"name": "Kuwait Financial Centre 'Markaz'"

} ],

"contactPoint": {

"@type": "ContactPoint",

"contactType": "Research Support",

"telephone": "[+965-2224-8280]",

"email": "enquiry@e-marmore.com"

},

"sameAs": [

 "https://twitter.com/marmoremena",

"https://www.linkedin.com/company/marmore-mena",

"https://www.facebook.com/marmoremena",

"https://www.instagram.com/marmore_mena",

"https://www.youtube.com/user/marmoreMENA"

]}


{

  "@context": "https://schema.org",

  "@type": "WebSite",

  "url": "https://www.marmoremena.com/",

  "potentialAction": {

    "@type": "SearchAction",

    "target": "https://marmoremena.com/?s={search_term_string}",

    "query-input": "required name=search_term_string"

  }

}

</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-9BLPNDT327"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-9BLPNDT327');
</script>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TWX92TS');</script>
<!-- End Google Tag Manager -->

</head>
<?php
// echo '<pre>';
// print_r($path);
// exit;
if($prev_row['name']=='home')
{
    $bodyCls = 'home landing-page';
}

else if(empty($path[2]) && $prev_row['name']=='insights' && $path[1]='insights')
{
    $bodyCls = 'blog';
}
else if(isset($path[2]) && $prev_row['name']=='insights' && $path[1]=='insights' && $path[2]!='')
{
    $bodyCls = 'blog individual-blog';
}
else if(empty($path[2]) && $prev_row['name']=='service' && $path[1]='service')
{
    $bodyCls = 'service-page about-us';
}
else if(isset($path[2]) && $path[1]=='service' && $path[2]!='')
{
    $bodyCls = 'service-page individual-service';
}
else if(empty($path[2]) && $prev_row['name']=='reports' && $path[1]='reports')
{
    $bodyCls = 'report';
}
else if(isset($path[2]) && $prev_row['name']=='reports' && $path[1]=='reports' && $path[2]!='' && $path[2]!='category' && $path[2]!='country')
{
    $bodyCls = 'individual-report';
}
else if($prev_row['name']=='who-we-are' )
{
    $bodyCls = 'about-us';
}
else if($prev_row['name']=='clients')
{
    $bodyCls = 'client-page';
}
else if(empty($path[2]) && $prev_row['name']=='data-book' && $path[1]='data-book')
{
    $bodyCls = 'data-book';
}
else if(isset($path[2]) && $prev_row['name']=='data-book' && $path[1]=='data-book' && $path[2]!='')
{
    $bodyCls = 'individual-report individual-databook';
}
else if($prev_row['name']=='faq')
{
    $bodyCls = 'faq';
}
else if($prev_row['name']=='industry')
{
    $bodyCls = 'about-us industry';
}
else if($prev_row['name']=='marmore-news' )
{
    $bodyCls = 'about-us news';
}
else if($prev_row['name']=='gcc-crises-series' )
{
    $bodyCls = 'gcc-crises-series';
}
else if($path[1]=='marmore-bulletin' )
{
    $bodyCls = 'bulletin';
}
else if($prev_row['name']=='webinars' )
{
    $bodyCls = 'webinar';
}
else if($prev_row['name']=='daily-research' )
{
    $bodyCls = 'daily-research home data-book';
}
else if($prev_row['name']=='our-parent' )
{
    $bodyCls = 'about-us parent-page';
}
else if($prev_row['name']=='careers' )
{
    $bodyCls = 'about-us career';
}
else if($prev_row['name']=='enquiry' )
{
    $bodyCls = 'cta-page';
}
else if($prev_row['name']=='contact-us' )
{
    $bodyCls = 'contact-page';
}
else if($prev_row['name']=='privacy-policy' )
{
    $bodyCls = 'privacy-policy';
}
else if($prev_row['name']=='terms-conditions' )
{
    $bodyCls = 'terms-conditions';
}
else if($prev_row['name']=='customized-research' )
{
    $bodyCls = 'data-book individual-databook customized-research';
}
else if($prev_row['name']=='channel' )
{
    $bodyCls = 'channel';
}
else if(isset($path[2]) && $prev_row['name']=='reports' && $path[1]=='reports' && $path[2]=='category' && $path[3]!='')
{
    $bodyCls = 'report individual-reports-category';
}
else if(isset($path[2]) && $prev_row['name']=='reports' && $path[1]=='reports' && $path[2]=='country' && $path[3]!='')
{
    $bodyCls = 'report individual-reports-country';
}
else if($prev_row['name']=='marmore-channel' || $prev_row['name']=='channel-test')
{
    $bodyCls = 'channel';
}
?>
<body class="<?php echo $bodyCls ?>">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TWX92TS"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php
if(isset($path[1]) && isset($path[2]) && ($prev_row['name']!='' && $path[1]=='service' || $prev_row['name']!='' && $path[1]=='industry' || $prev_row['name']!='' && $path[1]=='insights') && $path[2]!=''&& $path[1]!='') { 
?>
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
                        <p>Read our latest GCC insights, ideas, and perspectives shaping the future</p>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="<?=base_url.$lang."/insights"?>" class=" btn-link">Go to Insights <i class="fa fa-long-arrow-right"
                                aria-hidden="true"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

<?php } ?>
<?php if(isset($path[1]) && isset($path[2]) && ($prev_row['name']=='reports' && $path[1]=='reports' || $prev_row['name']=='clients' && $path[1]=='clients')  && $path[2]!=''&& $path[1]!='') { ?>
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
                        <p>Read our latest GCC insights, ideas, and perspectives shaping the future</p>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="<?=base_url.$lang."/insights"?>" class=" btn-link">Go to Insights <i class="fa fa-long-arrow-right"
                                aria-hidden="true"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<?php } ?>
<?php if(isset($path[1]) && !isset($path[2]) && ($prev_row['name']=='who-we-are' && $path[1]=='who-we-are' ||  $prev_row['name']=='insights' && $path[1]=='insights' ||  $prev_row['name']=='reports' && $path[1]=='reports' ||  $prev_row['name']=='clients' && $path[1]=='clients' || $prev_row['name']=='data-book' && $path[1]=='data-book' || $prev_row['name']=='industry' && $path[1]=='industry' || $prev_row['name']=='insights' && $path[1]=='insights' || $prev_row['name']=='marmore-news' && $path[1]=='marmore-news' || $prev_row['name']=='gcc-crises-series' && $path[1]=='gcc-crises-series' || $prev_row['name']=='marmore-bulletin' && $path[1]=='marmore-bulletin' || $prev_row['name']=='daily-research' && $path[1]=='daily-research' || $prev_row['name']=='our-parent' && $path[1]=='our-parent' || $prev_row['name']=='careers' && $path[1]=='careers' || $prev_row['name']=='service' && $path[1]=='service' || $prev_row['name']=='enquiry' && $path[1]=='enquiry' || $prev_row['name']=='contact-us' && $path[1]=='contact-us' || $prev_row['name']=='customized-research' && $path[1]=='customized-research' || $prev_row['name']=='marmore-channel' && $path[1]=='marmore-channel')) { ?>
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
                        <p>Read our latest GCC insights, ideas, and perspectives shaping the future</p>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="<?=base_url.$lang."/insights"?>" class=" btn-link">Go to Insights <i class="fa fa-long-arrow-right"
                                aria-hidden="true"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<?php } ?>

<nav class="navbar  navbar-inverse bg-inverse navbar-expand-lg fixed-top align-items-center" id="topNav">
        <div class="container-fluid pl-3 pr-3">
            <div class="navbar-header">
                <a class="navbar-brand logo-nav " href="<?=base_url.$lang."/"?>">
                    <img src="<?php echo base_url ?>assets/image/logo-mormore.svg" alt="">
                </a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item dropdown  has-megamenu"><a class="nav-link dropdown-toggle menu"
                            role="button" data-bs-toggle="dropdown" href="#">What We Do<span class="caret"><i
                                    class="fa-solid fa-chevron-down"></i></span></a>
                        <div class="dropdown-menu megamenu" role="menu">
                            <div class="row g-3">
                                <div class="col-lg-4 col-12">
                                    <div class="col-megamenu">
                                        <h6 class="title">Consulting</h6>
                                        <ul class="list-unstyled">
                                            <li class="menu-lst" onclick="window.location.href='<?=base_url.$lang."/service/strategic-competitors-intelligence"?>'"><a class="mega-lnk" href="<?=base_url.$lang."/service/strategic-competitors-intelligence"?>">Strategic & Competitor
                                                    Intelligence</a></li>
                                            <li class="menu-lst" onclick="window.location.href='<?=base_url.$lang."/service/market-entry-strategies"?>'"><a class="mega-lnk" href="<?=base_url.$lang."/service/market-entry-strategies"?>">Market Entry
                                                    Strategies</a></li>
                                                    
                                            <li class="menu-lst" onclick="window.location.href='<?=base_url.$lang."/service/business-plan-feasibility-studies"?>'"><a class="mega-lnk" href="<?=base_url.$lang."/service/business-plan-feasibility-studies"?>">Business Plan & Feasibility Studies
                                            </a></li>
                                            <li class="menu-lst" onclick="window.location.href='<?=base_url.$lang."/service/fintech-adoption-integration"?>'"><a class="mega-lnk" href="<?=base_url.$lang."/service/fintech-adoption-integration"?>">Fintech
                                                    Adoption & Integration</a></li>
                                            <li class="menu-lst" onclick="window.location.href='<?=base_url.$lang."/service/digital-banking-intelligence-and-services"?>'"><a class="mega-lnk" href="<?=base_url.$lang."/service/digital-banking-intelligence-and-services"?>">Digital Banking
                                                    Intelligence</a></li>
                                            
                                                    <li class="menu-lst" onclick="window.location.href='<?=base_url.$lang."/service/robo-advisory-solutions"?>'"><a class="mega-lnk" href="<?=base_url.$lang."/service/robo-advisory-solutions"?>">Robo-advisory
                                                    Solutions</a></li>
                                            <li class="menu-lst" onclick="window.location.href='<?=base_url.$lang."/service/company-valuation-business-valuation"?>'"><a class="mega-lnk" href="<?=base_url.$lang."/service/company-valuation-business-valuation"?>">Business Valuation</a></li>
                                            <li class="menu-lst" onclick="window.location.href='<?=base_url.$lang."/service/esg-research"?>'"><a class="mega-lnk" href="<?=base_url.$lang."/service/esg-research"?>">ESG Consulting</a></li>

                                            <!--<li class="menu-lst" onclick="window.location.href='<?//=base_url."/".$lang."/strategic-competitors-intelligence"?>'"><a class="mega-lnk" href="#">Business Plan</a></li>-->
                                            
                                            
                                            
                                            
                                        </ul>
                                    </div> <!-- col-megamenu.// -->
                                </div><!-- end col-3 -->
                                <div class="col-lg-4 col-12">
                                    <div class="col-megamenu">
                                        <h6 class="title">Market Advisory</h6>
                                        <ul class="list-unstyled">
                                            <li class="menu-lst" onclick="window.location.href='<?=base_url.$lang."/service/macro-economic-research"?>'"><a class="mega-lnk" href="<?=base_url.$lang."/service/macro-economic-research"?>">Macro Economic
                                                    </a></li>
                                            <li class="menu-lst" onclick="window.location.href='<?=base_url.$lang."/service/industry-research"?>'"><a class="mega-lnk" href="<?=base_url.$lang."/service/industry-research"?>">Industry</a></li>
                                            <li class="menu-lst" onclick="window.location.href='<?=base_url.$lang."/service/capital-markets-research"?>'"><a class="mega-lnk" href="<?=base_url.$lang."/service/capital-markets-research"?>">Capital Markets
                                                    </a></li>
                                            <li class="menu-lst" onclick="window.location.href='<?=base_url.$lang."/service/thematic-reports-white-papers"?>'"><a class="mega-lnk" href="<?=base_url.$lang."/service/thematic-reports-white-papers"?>">Thematic and White Papers</a></li>
                                            <!--<li class="menu-lst" onclick="window.location.href='<?//=base_url."/".$lang."/service/thematic-reports-white-papers"?>'"><a class="mega-lnk" href="<?//=base_url."/".$lang."/service/thematic-reports-white-papers"?>">White Papers</a></li>-->
                                        </ul>
                                    </div> <!-- col-megamenu.// -->
                                </div>
                               
                                
                <div class="col-lg-4 col-12">
                  <div class="col-megamenu">
                    <h6 class="title">Published Insights</h6>
                    <ul class="list-unstyled">
                    <li class="menu-lst" onclick="window.location.href='<?=base_url.$lang."/reports/"?>'"> <a class="mega-lnk" href="<?=base_url.$lang."/reports/"?>">Insights Repository</a></li>
                      <li class="menu-lst" onclick="window.location.href='<?=base_url.$lang."/data-book/"?>'"> <a class="mega-lnk" href="<?=base_url.$lang."/data-book/"?>">Databook by Country</a></li>
                      <li class="menu-lst" onclick="window.location.href='<?=base_url.$lang."/data-book/bahrain-databook/"?>'">
                          <a class="mega-lnk" href="<?=base_url.$lang."/data-book/bahrain-databook/"?>"><img src="<?php echo base_url ?>./assets/image/emojione_flag-for-bahrain.png" alt="" class="menu-imgs">
                       Bahrain</a></li>
                       <li class="menu-lst" onclick="window.location.href='<?=base_url.$lang."/data-book/kuwait-databook/"?>'">
                          <a class="mega-lnk" href="<?=base_url.$lang."/data-book/kuwait-databook/"?>">                          <img src="<?php echo base_url ?>./assets/image/emojione_flag-for-kuwait.png" alt="" class="menu-imgs">
                    Kuwait</a></li>
                     <li class="menu-lst" onclick="window.location.href='<?=base_url.$lang."/data-book/oman-databook/"?>'">
                          <a class="mega-lnk" href="<?=base_url.$lang."/data-book/oman-databook/"?>"><img src="<?php echo base_url ?>./assets/image/emojione_flag-for-oman.png" alt="" class="menu-imgs">
                      Oman</a></li>
                      <li class="menu-lst" onclick="window.location.href='<?=base_url.$lang."/data-book/qatar-databook/"?>'">
                          <a class="mega-lnk" href="<?=base_url.$lang."/data-book/qatar-databook/"?>"><img src="<?php echo base_url ?>./assets/image/emojione_flag-for-qatar.png" alt="" class="menu-imgs">
                        Qatar</a></li>
                      <li class="menu-lst" onclick="window.location.href='<?=base_url.$lang."/data-book/saudi-databook/"?>'">
                          <a class="mega-lnk" href="<?=base_url.$lang."/data-book/saudi-databook/"?>"><img src="<?php echo base_url ?>./assets/image/emojione_flag-for-saudi-arabia.png" alt="" class="menu-imgs">
                       Saudi Arabia</a></li>
                         <li class="menu-lst" onclick="window.location.href='<?=base_url.$lang."/data-book/uae-databook/"?>'">
                          <a class="mega-lnk" href="<?=base_url.$lang."/data-book/uae-databook/"?>"><img src="<?php echo base_url ?>./assets/image/emojione_flag-for-united-arab-emirates.png" alt="" class="menu-imgs">
                      UAE</a></li>
                          
                    </ul>
                  </div> <!-- col-megamenu.// -->
                </div><!-- end col-3 -->

                            </div><!-- end row -->
                        </div>
                        <div class="dot"></div>
                    </li>
          <li class="nav-item dropdown has-megamenu"><a class="nav-link dropdown-toggle menu" role="button"
              data-bs-toggle="dropdown" href="#">Industry Touchpoints<span class="caret"><i
                  class="fa-solid fa-chevron-down"></i></span></a>

            <div class="dropdown-menu megamenu" role="menu">
              <div class="row g-3">

                <div class="col-lg-4 col-12">
                  <div class="col-megamenu">
                    <h6 class="title">GCC Focused Industry Offerings</h6>
                    <ul class="list-unstyled">
                      <li class="menu-lst"><a class="mega-lnk" href="<?=base_url.$lang."/industry/banking-financial-services-and-insurance"?>">Banking, Financial Services & Insurance</a></li>
                      <li class="menu-lst"><a class="mega-lnk" href="<?=base_url.$lang."/industry/automobile"?>">Automobile</a></li>
                      <li class="menu-lst"><a class="mega-lnk" href="<?=base_url.$lang."/industry/logistics"?>">Logistics</a></li>
                      <li class="menu-lst"><a class="mega-lnk" href="<?=base_url.$lang."/industry/infrastructure"?>">Infrastructure</a></li>
                      <li class="menu-lst"><a class="mega-lnk" href="<?=base_url.$lang."/industry/education"?>">Education</a></li>
                      <li class="menu-lst"><a class="mega-lnk" href="<?=base_url.$lang."/industry/healthcare"?>">Healthcare</a></li>
                      <li class="menu-lst"><a class="mega-lnk" href="<?=base_url.$lang."/industry/hospitality"?>">Hospitality</a></li>
                      
                    </ul>
                  </div> <!-- col-megamenu.// -->
                </div><!-- end col-3 -->
                <div class="col-lg-4 col-12">
                  <div class="col-megamenu">
                    <h6 class="title">&nbsp;</h6>
                    <ul class="list-unstyled">
                      <li class="menu-lst"><a class="mega-lnk" href="<?=base_url.$lang."/industry/real-estate"?>">Real Estate</a></li>
                      <li class="menu-lst"><a class="mega-lnk" href="<?=base_url.$lang."/industry/energy-natural-resources"?>">Energy & Natural Resources</a></li>
                      <li class="menu-lst"><a class="mega-lnk" href="<?=base_url.$lang."/industry/retail"?>">Retail</a></li>
                      <li class="menu-lst"><a class="mega-lnk" href="<?=base_url.$lang."/industry/technology"?>">Technology </a></li>
                      <li class="menu-lst"><a class="mega-lnk" href="<?=base_url.$lang."/industry/media-entertainment"?>">Media & Entertainment</a></li>
                      <li class="menu-lst"><a class="mega-lnk" href="<?=base_url.$lang."/industry/telecom"?>">Telecom</a></li>
                    </ul>
                  </div> <!-- col-megamenu.// -->
                </div>
                <div class="col-lg-4 text-center col-12 hide-img-mob">
                                   <a href="<?=base_url.$lang."/industry/banking-financial-services-and-insurance"?>" ><img class="nav-banner" src="<?php echo base_url ?>/assets/image/Industry banner.png" alt=""></a> 
                                </div><!-- end col-3 -->
              </div><!-- end row -->
            </div>
            <div class="dot"></div>
          </li>


                    <li class="nav-item dropdown" onclick="window.location.href='<?=base_url.$lang."/clients"?>'"><a class="menu" href="<?=base_url.$lang."/clients"?>">Client Stories</a>
                        <div class="dot"></div>
                    </li>

<li class="nav-item dropdown"><a class="nav-link dropdown-toggle menu" role="button" data-bs-toggle="dropdown" href="<?=base_url.$lang."/insights"?>" aria-expanded="false">Insights<span class="caret"><i class="fa-solid fa-chevron-down"></i></span></a>

                        
                                        
                                        <ul class="list-unstyled dropdown-menu pt-3 pb-3 pr-3 pl-3 single-menu">
                                           
                                            <li class="menu-lst" onclick="window.location.href='<?=base_url.$lang."/insights"?>'"><a class="mega-lnk" href="<?=base_url.$lang."/insights"?>">Blogs </a></li>
                                            <li class="menu-lst" onclick="window.location.href='<?=base_url.$lang."/gcc-crises-series"?>'"><a class="mega-lnk" href="<?=base_url.$lang."/gcc-crises-series"?>">GCC Crisis Series</a></li>
                                            <li class="menu-lst" onclick="window.location.href='<?=base_url.$lang."/marmore-bulletin"?>'"><a class="mega-lnk" href="<?=base_url.$lang."/marmore-bulletin"?>">Bulletin</a></li>
                                           <li class="menu-lst" onclick="window.location.href='<?=base_url.$lang."/webinars"?>'"><a class="mega-lnk" href="<?=base_url.$lang."/webinars"?>">Webinars</a></li>
                                            <!--<li class="menu-lst" onclick="window.location.href='<?//=base_url.$lang."/channel"?>'"><a class="mega-lnk" href="<?//=base_url.$lang."/channel"?>">Mamore Channel</a></li>-->
                                            <li class="menu-lst" onclick="window.location.href='<?=base_url.$lang."/channel"?>'"><a class="mega-lnk" href="<?=base_url.$lang."/marmore-channel"?>">Marmore Channel</a></li>
                                        </ul>
                                   
                        <div class="dot"></div>
                    </li>
                    
                    <!--<li class="nav-item dropdown has-megamenu"><a class="nav-link dropdown-toggle menu" role="button"-->
                    <!--        data-bs-toggle="dropdown" href="<?=base_url.$lang."/blog"?>">Insights<span class="caret"><i-->
                    <!--                class="fa-solid fa-chevron-down"></i></span></a>-->

                    <!--    <div class="dropdown-menu megamenu mega12" role="menu">-->
                    <!--        <div class="row g-3">-->

                    <!--            <div class="col-lg-12 col-12">-->
                    <!--                <div class="col-megamenu">-->
                    <!--                    <h6 class="title">Insights</h6>-->
                    <!--                    <ul class="list-unstyled">-->
                    <!--                        <li class="menu-lst" onclick="window.location.href='<?=base_url.$lang."/blog"?>'"><a class="mega-lnk" href="<?=base_url.$lang."/blog"?>">Blogs </a></li>-->
                    <!--                        <li class="menu-lst" onclick="window.location.href='<?=base_url.$lang."/gcc"?>'"><a class="mega-lnk" href="<?=base_url.$lang."/gcc"?>">GCC Crisis Series</a></li>-->
                    <!--                        <li class="menu-lst" onclick="window.location.href='<?=base_url.$lang."/bulletin"?>'"><a class="mega-lnk" href="<?=base_url.$lang."/bulletin"?>">Bulletin</a></li>-->
                    <!--                        <li class="menu-lst" onclick="window.location.href='<?=base_url.$lang."/webinar"?>'"><a class="mega-lnk" href="<?=base_url.$lang."/webinar"?>">Webinar</a></li>-->
                    <!--                        <li class="menu-lst" onclick="window.location.href='<?=base_url.$lang."/channel"?>'"><a class="mega-lnk" href="<?=base_url.$lang."/channel"?>">Mamore Channel</a></li>-->
                    <!--                    </ul>-->
                    <!--                </div> -->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--    <div class="dot"></div>-->
                    <!--</li>-->

                    <li class="nav-item dropdown has-megamenu"><a class="nav-link dropdown-toggle menu" role="button"
                            data-bs-toggle="dropdown" href="#" >About<span class="caret"><i
                                    class="fa-solid fa-chevron-down"></i></span></a>

                        <div class="dropdown-menu megamenu" role="menu">
                            <div class="row g-3">
                                <div class="col-lg-4 col-12">
                                    <div class="col-megamenu">
                                        <h6 class="title" onclick="window.location.href='<?=base_url.$lang."/who-we-are"?>'">About Marmore</h6>
                                        <ul class="list-unstyled">
                                            <li class="menu-lst" ><a class="mega-lnk" href="<?=base_url.$lang."/our-parent"?>">Markaz - Parent Company</a></li>
                                            <!--<li class="menu-lst"><a class="mega-lnk" href="#">Journey So Far</a></li>-->
                                            <li class="menu-lst"><a class="mega-lnk" href="<?=base_url.$lang."/who-we-are#our_team_51"?>">Leadership</a></li>
                                            <li class="menu-lst"><a class="mega-lnk" href="<?=base_url.$lang."/who-we-are#board_of_directors_319"?>">Board of Directors of Marmore</a></li>
                                            <li class="menu-lst"><a class="mega-lnk" href="<?=base_url.$lang."/marmore-news"?>">Mamore In News </a></li>
                                        </ul>
                                    </div> <!-- col-megamenu.// -->
                                </div><!-- end col-3 -->
                                <div class="col-lg-4 col-12">
                                    <div class="col-megamenu">
                                        <h6 class="title">&nbsp;</h6>
                                        <ul class="list-unstyled">
                                            <li class="menu-lst" ><a class="mega-lnk" href="<?=base_url.$lang."/careers"?>">Careers</a></li>
                                            <li class="menu-lst"><a class="mega-lnk" href="<?=base_url.$lang."/contact-us"?>">Contact Us</a></li>
                                            <!-- <li class="menu-lst"><a class="mega-lnk" >Social Media</a></li> -->
                                            <li class="menu-lst"><a class="mega-lnk" href="https://www.linkedin.com/company/marmore-mena" target="_blank"><span
                                                        style="margin-right: 10px;"><i
                                                            class="fa-brands fa-linkedin"></i></span></a>
                                                <a class="mega-lnk" href="https://www.facebook.com/marmoremena" target="_blank"> <span style="margin-right: 10px;"><i
                                                            class="fa-brands fa-facebook-square"></i></span></a>
                                                 <a class="mega-lnk" href="https://twitter.com/marmoremena" target="_blank">
                                     <span style="margin-right: 10px;"><i class="fa-brands fa-twitter"></i></span>
                                </a>
                                                <a class="mega-lnk" href="https://www.instagram.com/marmore_mena" target="_blank"> <span style="margin-right: 10px;">
                                    <i class="fa-brands fa-instagram-square"></i>
                               </span>
                                    </a>
                                                <a class="mega-lnk" href="https://www.youtube.com/user/marmoreMENA" target="_blank"> <span style="margin-right: 10px;"><i
                                                            class="fa-brands fa-youtube-square"></i></span></a>
                                            <a class="mega-lnk" href="https://api.whatsapp.com/send?phone=96594059005" target="_blank"> <span style="margin-right: 10px;"><i
                                                            class="fa-brands fa-whatsapp-square"></i></span></a>
                                            </li>
                                        </ul>
                                    </div> <!-- col-megamenu.// -->
                                </div>
                                <div class="col-lg-4 text-center col-12 hide-img-mob">
                                   <a href="https://bit.ly/3Olbdb0" ><img class="nav-banner" src="<?php echo base_url ?>./assets/image/marmore-banner.png" alt=""></a> 
                                </div><!-- end col-3 -->
                            </div><!-- end row -->
                        </div>
                        <div class="dot"></div>
                    </li>

                    <!--<li class="dropdown option">-->
                    <!--    <a class="menu" href="#"> <i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>-->
                    <!--</li>-->
                    <li class="item buttons" onclick="window.location.href='<?=base_url.$lang."/enquiry"?>'">
                        <a class="btn btn-theme" href="<?=base_url.$lang."/contact-us"?>"><span>Contact Us</span></a>
                    </li>
                    <!--<li class="translate">-->
                    <!--    <a class="menu" href="#">عربي <i class="fa-solid fa-globe"></i></a>-->
                    <!--</li>-->
                </ul>
            </div>
        </div>
    </nav>
   <?php
//   echo '<pre>';
// print_r($prev_row);
// exit;
   ?>
    <div class="container-fluid breadcrumb1 pr-3 pl-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadc">
                <?php  $linkk= $lang."/"; ?>
                <li class="breadcrumb-item"><a href="/"><img class="about-home-image" src="/assets/image/home.png" alt="home" loading="lazy" /></a></li>
                <?php if($prev_row['name']=='who-we-are') { ?>
                <li onclick="window.location.href='<?=base_url.$linkk.$prev_row['name']?>'" class="breadcrumb-item active"><?=$prev_row['title']?></li>
                <?php } ?>
                <?php if($prev_row['name']=='service') { ?>
                <li onclick="window.location.href='<?=base_url.$linkk.$prev_row['name']?>'" class="breadcrumb-item active"><?=$prev_row['title']?></li>
                <?php } ?>
                 <?php if(($prev_row['name']=='strategic-competitors-intelligence' || $prev_row['name']=='market-entry-strategies' || $prev_row['name']=='business-plan-feasibility-studies' || $prev_row['name']=='fintech-adoption-integration' || $prev_row['name']=='digital-banking-intelligence-and-services' || $prev_row['name']=='robo-advisory-solutions' || $prev_row['name']=='company-valuation-business-valuation' || $prev_row['name']=='macro-economic-research' || $prev_row['name']=='industry-research' || $prev_row['name']=='capital-markets-research' || $prev_row['name']=='thematic-reports-white-papers' || $prev_row['name']=='esg-research') && $path[1]=='service') { ?>
                 <li onclick="window.location.href='<?=base_url.$linkk.$path[1]?>'" class="breadcrumb-item active">Service</li>
                <li onclick="window.location.href='<?=base_url.$linkk.'/service/'.$prev_row['name']?>'" class="breadcrumb-item active"><?=$prev_row['title']?></li>
                <?php } ?>
                <?php if(empty($path[2]) && $prev_row['name']=='insights' && $path[1]='insights') { ?>
                <li onclick="window.location.href='<?=base_url.$linkk.$prev_row['name']?>'" class="breadcrumb-item active"><?=$prev_row['title']?></li>
                <?php } ?>
                <?php if(isset($path[2]) && $prev_row['name']=='insights' && $path[1]=='insights' && $path[2]!='' && $path[3]!='') { ?>
                <li onclick="window.location.href='<?=base_url.$linkk.$prev_row['name']?>'" class="breadcrumb-item active"><?=$prev_row['title']?></li>
                <li onclick="window.location.href='<?=base_url.$linkk.'/insights/category/'.$path[3]?>'" class="breadcrumb-item active"><?=str_replace("-"," ",ucwords($path[3]))?></li>
                <?php } ?>
                <?php if(isset($path[2]) && $prev_row['name']=='insights' && $path[1]=='insights' && $path[2]!='' && $path[3]=='') 
                { 
                    $find_category_id="select category_id,slug from tbl_blogs where slug='".$path[2]."'";
                    $find_category_id       = $objTypes->fetchRow($find_category_id); 
                    if(isset($find_category_id) && !empty($find_category_id))
                    {
                        $category_name = "select category_name,id from tbl_blogs_category where id=".$find_category_id['category_id'];
                        $category_name       = $objTypes->fetchRow($category_name); 
                    }
                ?>
                <li onclick="window.location.href='<?=base_url.$linkk.$prev_row['name']?>'" class="breadcrumb-item active"><?=$prev_row['title']?></li>
                <li onclick="window.location.href='<?=base_url.$linkk.'/insights/category/'.lcfirst($category_name['category_name'])?>'" class="breadcrumb-item active"><?=str_replace("-"," ",ucwords($category_name['category_name']))?></li>
                <?php } ?>
                <?php if(isset($path[2]) && $prev_row['name']=='reports' && $path[1]=='reports' && $path[2]!='' && $path[3]!='') { ?>
                <li onclick="window.location.href='<?=base_url.$linkk.$prev_row['name']?>'" class="breadcrumb-item active"><?=$prev_row['title']?></li>
                <li onclick="window.location.href='<?=base_url.$linkk.'/reports/category/'.$path[3]?>'" class="breadcrumb-item active"><?=str_replace("-"," ",ucwords($path[3]))?></li>
                <?php } ?>
                 <?php 
                 if(empty($path[2]) && $prev_row['name']=='reports' && $path[1]='reports')
                    { ?>
                    <li onclick="window.location.href='<?=base_url.$linkk.$prev_row['name']?>'" class="breadcrumb-item active"><?=$prev_row['title']?></li>
                   <?php } ?>                    
                   <?php 
                    if(isset($path[2]) && $prev_row['name']=='reports' && $path[1]=='reports' && $path[2]!='' && $path[2]!='category' && $path[2]!='country')
                    { 
                        $find_wp_slug = $objTypes->fetchRow("select wp_slug,report_name from tbl_report_data where is_active=1 and is_delete=1 and wp_slug='$path[2]'");
                    ?>
                        <li onclick="window.location.href='<?=base_url.$linkk.$prev_row['name']?>'" class="breadcrumb-item active"><?=$prev_row['title']?></li>
                      <li onclick="window.location.href='<?=base_url.$linkk.'reports/'.$path[2]?>'" class="breadcrumb-item active"><?=$find_wp_slug['report_name']?></li>
                   <?php }
                    ?>
                    <?php if(empty($path[2]) && $prev_row['name']=='data-book' && $path[1]='data-book') { ?>
                <li onclick="window.location.href='<?=base_url.$linkk.$prev_row['name']?>'" class="breadcrumb-item active"><?=$prev_row['title']?></li>
                <?php } ?>
                 <?php if(isset($path[2]) && $prev_row['name']=='data-book' && $path[1]=='data-book' && $path[2]!='') { 
                       $data_book_name = $objTypes->fetchRow("select data_book_name,slug from tbl_data_book where is_active=1 and is_delete=1 and slug='$path[2]'");
                 ?>
                <li onclick="window.location.href='<?=base_url.$linkk.$prev_row['name']?>'" class="breadcrumb-item active"><?=$prev_row['title']?></li>
                <li onclick="window.location.href='<?=base_url.$linkk.$prev_row['name']?>'" class="breadcrumb-item active"><?=$data_book_name['data_book_name']?></li>
                <?php } ?>
                <?php if(empty($path[2]) && $prev_row['name']=='clients' && $path[1]='clients') { ?>
                <li onclick="window.location.href='<?=base_url.$linkk.$prev_row['name']?>'" class="breadcrumb-item active"><?=$prev_row['title']?></li>
                <?php } ?>
                 <?php if(isset($path[2]) && $prev_row['name']=='clients' && $path[1]=='clients' && $path[2]!='') { ?>
                <li onclick="window.location.href='<?=base_url.$linkk.$prev_row['name']?>'" class="breadcrumb-item active"><?=$prev_row['title']?></li>
                <!--<li onclick="#" class="breadcrumb-item active"><?//=$path[2]?></li>-->
                <?php } ?>
                <?php if(empty($path[2]) && $prev_row['name']=='industry' && $path[1]='industry') { ?>
                <li onclick="window.location.href='<?=base_url.$linkk.$prev_row['name']?>'" class="breadcrumb-item active"><?=$prev_row['title']?></li>
                <?php } ?>
                 <?php if(isset($path[2]) && $prev_row['name']=='industry' && $path[1]=='industry' && $path[2]!='') { 
                     $title = $path[2];
                    $industry_name = "select title from tbl_industry where slug='$title'";
                    $industry_name       = $objTypes->fetchRow($industry_name); 
                    
                 ?>
                <li onclick="window.location.href='<?=base_url.$linkk.$prev_row['name']?>'" class="breadcrumb-item active"><?=$prev_row['title']?></li>
                <li onclick="window.location.href='#'" class="breadcrumb-item active"><?=$industry_name['title']?></li>
                <?php } ?>
                 <?php if(empty($path[2]) && $prev_row['name']=='marmore-news' && $path[1]='marmore-news') { ?>
                <li onclick="window.location.href='<?=base_url.$linkk.$prev_row['name']?>'" class="breadcrumb-item active"><?=$prev_row['title']?></li>
                <?php } ?>
                <?php if(empty($path[2]) && $prev_row['name']=='gcc-crises-series' && $path[1]='gcc-crises-series') { ?>
                <li onclick="window.location.href='<?=base_url.$linkk.$prev_row['name']?>'" class="breadcrumb-item active"><?=$prev_row['title']?></li>
                <?php } ?>
                <?php if(empty($path[2]) && $prev_row['name']=='marmore-bulletin' && $path[1]='marmore-bulletin') { ?>
                <li onclick="window.location.href='<?=base_url.$linkk.$prev_row['name']?>'" class="breadcrumb-item active"><?=$prev_row['title']?></li>
                <?php } ?>
                <?php if(empty($path[2]) && $prev_row['name']=='webinars' && $path[1]='webinars') { ?>
                <li onclick="window.location.href='<?=base_url.$linkk.$prev_row['name']?>'" class="breadcrumb-item active"><?=$prev_row['title']?></li>
                <?php } ?>
                <?php if(empty($path[2]) && $prev_row['name']=='daily-research' && $path[1]='daily-research') { ?>
                <li onclick="window.location.href='<?=base_url.$linkk.$prev_row['name']?>'" class="breadcrumb-item active"><?=$prev_row['title']?></li>
                <?php } ?>
                <?php if(empty($path[2]) && $prev_row['name']=='our-parent' && $path[1]='our-parent') { ?>
                <li onclick="window.location.href='<?=base_url.$linkk.$prev_row['name']?>'" class="breadcrumb-item active"><?=$prev_row['title']?></li>
                <?php } ?>
                <?php if(empty($path[2]) && $prev_row['name']=='careers' && $path[1]='careers') { ?>
                <li onclick="window.location.href='<?=base_url.$linkk.$prev_row['name']?>'" class="breadcrumb-item active"><?=$prev_row['title']?></li>
                <?php } ?>
                <?php if(empty($path[2]) && $prev_row['name']=='enquiry' && $path[1]='enquiry') { ?>
                <li onclick="window.location.href='<?=base_url.$linkk.$prev_row['name']?>'" class="breadcrumb-item active"><?=$prev_row['title']?></li>
                <?php } ?>
                <?php if(empty($path[2]) && $prev_row['name']=='contact-us' && $path[1]='contact-us') { ?>
                <li onclick="window.location.href='<?=base_url.$linkk.$prev_row['name']?>'" class="breadcrumb-item active"><?=$prev_row['title']?></li>
                <?php } ?>
                <?php if(empty($path[2]) && $prev_row['name']=='privacy-policy' && $path[1]='privacy-policy') { ?>
                <li onclick="window.location.href='<?=base_url.$linkk.$prev_row['name']?>'" class="breadcrumb-item active"><?=$prev_row['title']?></li>
                <?php } ?>
                <?php if(empty($path[2]) && $prev_row['name']=='terms-conditions' && $path[1]='terms-conditions') { ?>
                <li onclick="window.location.href='<?=base_url.$linkk.$prev_row['name']?>'" class="breadcrumb-item active"><?=$prev_row['title']?></li>
                <?php } ?>
                 <?php if(empty($path[2]) && $prev_row['name']=='customized-research' && $path[1]='customized-research') { ?>
                <li onclick="window.location.href='<?=base_url.$linkk.$prev_row['name']?>'" class="breadcrumb-item active"><?=$prev_row['title']?></li>
                <?php } ?>
                <?php if(empty($path[2]) && $prev_row['name']=='marmore-channel' && $path[1]='marmore-channel') { ?>
                <li onclick="window.location.href='<?=base_url.$linkk.$prev_row['name']?>'" class="breadcrumb-item active"><?=$prev_row['title']?></li>
                <?php } ?>
            </ol>
        </nav>
    </div>
    <?php
    
       include_once('cookies.php');
    ?>
