<?php
// echo '<pre>';
// print_r($industry_list);
// exit;
?>
<style>

    nav.navbar.align-items-center {
    position: relative;
}
.breadcrumb1 {
    margin-top: 0px !important;
}
</style>
<div class="container-fuild service-banner">
        <div class="content content1"><div class="row pb-5">
                <div class="col-lg-6">
                    <div>

                        <div class="major-content">
                            <h2 class="title pt-4"><?php echo $industry_list_details['title'] ?>
                            </h2>
                            <p class="sub-title subtitle pt-3"><?php echo $industry_list_details['short_desc'] ?></p></p>
                            <a class="btn btn-theme" href="<?=base_url.$lang."/enquiry"?>"><span>Talk to us</span></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 ">
                    <div class="text-right world-img">
                        <?php if($industry_list_details['title'] == 'Healthcare') { ?>
                        <img src="/assets/image/hospital.png" alt="" class="banner-img b1">
                        <?php } ?>
                        <?php if($industry_list_details['title'] == 'Real Estate') { ?>
                        <img src="/assets/image/realestate.png" alt="" class="banner-img b1">
                        <?php } ?>
                        <?php if($industry_list_details['title'] == 'Automobile') { ?>
                        <img src="/image/Frame (5).png" alt="" class="banner-img b1">
                        <?php } ?>
                        <?php if($industry_list_details['title'] == 'Hospitality') { ?>
                        <img src="/assets/image/image_46__1_.png" alt="" class="banner-img b1">
                        <?php } ?>
                        <?php if($industry_list_details['title'] == 'Retail') { ?>
                        <img src="<?php echo base_url ?>/image/retail.png" alt="" class="banner-img b1">
                        <?php } ?>
                        <?php if($industry_list_details['title'] == 'Banking, Financial Services and Insurance') { ?>
                        <img src="<?php echo base_url ?>/image/bank.png" alt="" class="banner-img b1">
                        <?php } ?> 
                        <?php if($industry_list_details['title'] == 'Energy & Natural Resources') { ?>
                        <img src="<?php echo base_url ?>/assets/image/AMP Resources.png" alt="" class="banner-img b1">
                        <?php } ?>
                        <?php if($industry_list_details['title'] == 'Media & Entertainment') { ?>
                        <img src="<?php echo base_url ?>/assets/image/Media & Entertainment.png" alt="" class="banner-img b1">
                        <?php } ?>
                        <?php if($industry_list_details['title'] == 'Logistics') { ?>
                        <img src="<?php echo base_url ?>/assets/image/Frame (1).png" alt="" class="banner-img b1">
                        <?php } ?>
                        <?php if($industry_list_details['title'] == 'Infrastructure') { ?>
                        <img src="<?php echo base_url ?>/assets/image/Frame (2).png" alt="" class="banner-img b1">
                        <?php } ?>
                        <?php if($industry_list_details['title'] == 'Education') { ?>
                        <img src="<?php echo base_url ?>/assets/image/Frame (3).png" alt="" class="banner-img b1">
                        <?php } ?>
                        <?php if($industry_list_details['title'] == 'Technology') { ?>
                        <img src="<?php echo base_url ?>/assets/image/Digital transformation-bro.svg" alt="" class="banner-img b1">
                        <?php } ?>
                        <?php if($industry_list_details['title'] == 'Telecom') { ?>
                        <img src="<?php echo base_url ?>/assets/image/Telecommuting-rafiki.svg" alt="" class="banner-img b1">
                        <?php } ?>
                    </div>
                </div>
            </div>
            </div>
            </div>

        <section class="industry-content">
            <div class="container pt-3">
                <p class="sub-content"><?php echo $industry_list_details['long_desc'] ?>
                </p>
            </div>
        </section>
        <?php if(isset($industry_list_details['feature_sub_title']) && !empty($industry_list_details['feature_sub_title'])){ ?>
        <div class="container-fuild">
        <div class="counter1">
            <div class="item">
                <div class="card blog-card">
                    <div class="row no-gutters align-items-center">
                        <div class="col-sm-4" style="text-align: center;">
                            <img class="card-img" src="<?php echo base_url ?>uploads/industry_images/<?php echo $industry_list_details['feature_image']?>" style="width: 300px;" alt="alt-img">
                        </div>
                        <div class="col-sm-8 align-items-center">
                            <div class="card-body cd1">
                                <p style="color:#00aeef !important;font-weight: 600;"><?php echo $industry_list_details['feature_sub_title'] ?></p>
                                <h2 class="card-title book-title" style="color: white;"><?php echo $industry_list_details['feature_heading'] ?></h2>
                                <p class="card-text book-text pt-3 pb-3"><?php echo $industry_list_details['feature_desc'] ?></p>
                                <a class="btn btn-2" href="<?php echo $industry_list_details['feature_cta_link'] ?>" style="border-radius: 0;"><span><?php echo $industry_list_details['feature_cta_text'] ?></span></a>
                                <a class="btn btn-2" href="<?php echo base_url.$lang ?>/reports" style="border-radius: 0;color:#FFFFFF"><span>View All Reports</span></a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
      <?php } ?>
      <?php if($industry_list_details['title'] == 'Banking, Financial Services and Insurance') 
      { ?>
        <section class="industry-blog">
            <div class="container">
                <div class="tabout">
                    <h2 class="title b_title">Related Insights</h3>
                </div>
                <div class="row blogs service-related-blog">
                    <div class="col-lg-4 blog_1">
                        <div class="card blog-b border" onclick="window.location.href='<?php echo base_url ?><?php echo $lang ;?>/insights/evolving-food--beverages-landscape-in-saudi-arabia/'">
                            <img class="card-img-top" src="<?php echo base_url ?>uploads/blog_images/Digital-shifts-impacting-KSA-banks_1200x600.jpeg" alt="Card image">
                            <div class="card-body ">
                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/category/business-sector/" class="btn-link">Business Sector</a>
                                <h4 class="card-title card_2">Five Digital Shifts Impacting KSA Banks</h4>
                                <p class="card-text card_2">Banks have been adopting digitalization at a faster pace driven by the covid-19 pandemic situation that entailed surge in contactless transactions. There is an increase in number of fintechs in the recent past and new neo banks are emerging across the globe. Almost 53 per cent of the global population is expected to access digital banking by 2026, according to Juniper Research. In 2018, the Middle East received less than 1% of worldwide FinTech funding, but it is growing at...
                                </p>
                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/evolving-food--beverages-landscape-in-saudi-arabia/" class="hvr-icon-forward btn-link">Read More </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 blog_1">
                        <div class="card blog-b border" onclick="window.location.href='<?php echo base_url ?><?php echo $lang ;?>/insights/gcc-markets-ended-2021-positively-supported-by-sharp-recovery-in-oil-prices/'">
                            <img class="card-img-top" src="<?php echo base_url ?>uploads/blog_images/Whats-behind-Kuwaits-increasing-fiscal-breakeven-oil-price_1200x600.jpg" alt="Card image">
                            <div class="card-body ">
                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/category/Capital%20Market/" class="btn-link">Captial Market</a>
                                <h4 class="card-title card_2">GCC markets ended 2021 positively supported by sharp recovery in oil prices</h4>
                                <p class="card-text card_2">
                                      GCC markets had a very positive year in 2021, supported by the sharp recovery in oil prices. The S&P GCC composite index ended the year with gains of 31.4%, following a 4.0% rise in December 2021. Abu Dhabi was the best performer among GCC markets, gaining 68.2% for the year followed by Saudi Arabia with yearly gains of 29.8%. Market Performance & Key Metrics Source: Refinitiv During December, Saudi equity market outperformed its peers, increasing 4.8% followed by Dubai equity...
                                </p>
                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/gcc-markets-ended-2021-positively-supported-by-sharp-recovery-in-oil-prices/" class="hvr-icon-forward btn-link">Read More </a>
                            </div>
                        </div>
                    </div>
                     <div class="col-lg-4 blog_1">
                        <div class="card blog-b border" onclick="window.location.href='<?php echo base_url ?><?php echo $lang ;?>/insights/changing-consumer-habits-amid-covid-19-accelerates-decline-of-saudi-arabia-bank-branches/'">
                            <img class="card-img-top" src="<?php echo base_url ?>uploads/blog_images/Changing-consumer-habits-amid-COVID-19-accelerates-decline-of-Saudi-Arabia-bank-branches-.jpg" alt="Card image">
                            <div class="card-body ">
                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/category/business-sector/" class="btn-link">Business Sector</a>
                                <h4 class="card-title card_2">Changing consumer habits amid COVID-19 accelerates decline of Saudi Arabia bank branches</h4>
                                <p class="card-text card_2">
                                 Bank branches operating in Saudi Arabia have reduced by 4.6% y/y in Q2 2021 to 1,969 branches (SAMA). The number of branches had been on a year-on-year declining trend since Q3 2020, with the current quarter posting the highest decline. The number of ATMs has also decreased by 9% y/y in Q2 2021. Operational considerations and uptake of digital banking, accelerated by COVID-19, seem to have contributed to the trend. Total Bank Branches in Saudi Arabia Source: SAMA According to...                                </p>
                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/changing-consumer-habits-amid-covid-19-accelerates-decline-of-saudi-arabia-bank-branches/" class="hvr-icon-forward btn-link">Read More </a>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </section>
        <?php } ?>
    
      <?php if($industry_list_details['title'] == 'Automobile') 
      { ?>
        <section class="industry-blog">
            <div class="container">
                <div class="tabout">
                    <h2 class="title b_title">Related Insights</h3>
                </div>
                <div class="row blogs service-related-blog">
                    <div class="col-lg-4 blog_1">
                        <div class="card blog-b border" onclick="window.location.href='<?php echo base_url ?><?php echo $lang ;?>/insights/3-reasons-why-gcc-automotive-market-is-facing-slump/'">
                            <img class="card-img-top" src="<?php echo base_url ?>uploads/blog_images/GCC-Automotive-Market-Marmore-Blog-Cover.jpg" alt="Card image">
                            <div class="card-body ">
                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/category/business-sector/" class="btn-link">Business Sector</a>
                                <h4 class="card-title card_2">3 reasons why GCC automotive market is facing slump</h4>
                                <p class="card-text card_2">
                               Automobile is an essential part of the lifestyle of middle east citizens and hence forms an important component of GCC’s annual imports. The region enjoys higher ownership of automobiles primarily attributable to per capita income above the world average. Middle East imports, often fluctuates with oil prices and so is the case with automobile imports too. But what is noteworthy is the sharp decline in imports of automobiles by value and more particularly by number of vehicles during 2016 and...
                                </p>
                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/3-reasons-why-gcc-automotive-market-is-facing-slump/" class="hvr-icon-forward btn-link">Read More </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 blog_1">
                        <div class="card blog-b border" onclick="window.location.href='<?php echo base_url ?><?php echo $lang ;?>/insights/autonomous-vehicles-how-will-they-transform-the-gcc-real-estate-sector/'">
                            <img class="card-img-top" src="<?php echo base_url ?>uploads/blog_images/Marmore-Blog-Autonomous-Vehicles-831x353.jpg" alt="Card image">
                            <div class="card-body ">
                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/category/Technology/" class="btn-link">Technology</a>
                                <h4 class="card-title card_2">Autonomous Vehicles – How will they transform the GCC Real Estate Sector?</h4>
                                <p class="card-text card_2">
                            The transport industry is on the cusp of another major breakthrough as Autonomous vehicles are expected not only to revolutionize the way we travel, but also the way we live. Billions of dollars have already been invested in pioneering the technology as well as equipping infrastructure to support it. Going by the trends, self-driven cars may soon be a common sight on roads in the near future. This disruptive change, which is expected to be a milestone for the auto...                                </p>
                                </p>
                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/autonomous-vehicles-how-will-they-transform-the-gcc-real-estate-sector/" class="hvr-icon-forward btn-link">Read More </a>
                            </div>
                        </div>
                    </div>
                     <div class="col-lg-4 blog_1">
                        <div class="card blog-b border" onclick="window.location.href='<?php echo base_url ?><?php echo $lang ;?>/insights/the-impact-of-vat-on-key-kuwaiti-sectors/'">
                            <img class="card-img-top" src="<?php echo base_url ?>uploads/blog_images/Impact-of-Vat-MarmoreBlog-Cover.jpg" alt="Card image">
                            <div class="card-body ">
                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/category/business-sector/" class="btn-link">Business Sector</a>
                                <h4 class="card-title card_2">The Impact of VAT on Key Kuwaiti Sectors</h4>
                                <p class="card-text card_2">
                                This article was originally published in Kuwait Times. Decrease in oil prices have led the member countries of GCC in search for alternative means of revenue. One way was to introduce a common tax called Value Added Tax (VAT) in the region. On July 09, 2017 two members of GCC, Saudi Arabia and UAE ratified the VAT framework agreement for the introduction of VAT in the region. With a tax rate of 5%, it will be applicable in the entire...                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/changing-consumer-habits-amid-covid-19-accelerates-decline-of-saudi-arabia-bank-branches/" class="hvr-icon-forward btn-link">Read More </a>
                                </p>
                            <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/the-impact-of-vat-on-key-kuwaiti-sectors/" class="hvr-icon-forward btn-link">Read More </a>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </section>
        <?php } ?>
        
     <?php if($industry_list_details['title'] == 'Media & Entertainment') 
      { ?>
        <section class="industry-blog">
            <div class="container">
                <div class="tabout">
                    <h2 class="title b_title">Related Insights</h3>
                </div>
                <div class="row blogs service-related-blog">
                    <div class="col-lg-4 blog_1">
                        <div class="card blog-b border" onclick="window.location.href='<?php echo base_url ?><?php echo $lang ;?>/insights/the-burgeoning-entertainment-industry-in-saudi-arabia/'">
                            <img class="card-img-top" src="https://marmore-assets-v2.s3.eu-west-1.amazonaws.com/insights/migrated/Saudi-Arabia-Entertainment-831x353.jpg" alt="Card image">
                            <div class="card-body ">
                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/category/Others/" class="btn-link">Others</a>
                                <h4 class="card-title card_2">The Burgeoning Entertainment Industry in Saudi Arabia</h4>
                                <p class="card-text card_2">
                                As a part of its broader economic diversification plans, Saudi Arabia took an unprecedented policy move by framing a new entertainment policy. In line with the Kingdom's Vision of 2030 of creating a vibrant society,...
                                </p>
                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/the-burgeoning-entertainment-industry-in-saudi-arabia/" class="hvr-icon-forward btn-link">Read More </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 blog_1">
                        <div class="card blog-b border" onclick="window.location.href='<?php echo base_url ?><?php echo $lang ;?>/insights/gcc-print-vs-digital-media/'">
                            <img class="card-img-top" src="<?php echo base_url ?>/uploads/blog_images/Group%20160532.png" alt="Card image">
                            <div class="card-body ">
                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/category/business-sector/" class="btn-link">Business Sector</a>
                                <h4 class="card-title card_2">GCC Print vs Digital Media</h4>
                                <p class="card-text card_2">
                                    The whiff of the early morning coffee has always romanced the fresh crispy fragrance of the newspaper. The winds of change are perhaps beginning to blow...                                </p>
                                </p>
                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/gcc-print-vs-digital-media/" class="hvr-icon-forward btn-link">Read More </a>
                            </div>
                        </div>
                    </div>
                     <div class="col-lg-4 blog_1">
                        <div class="card blog-b border" onclick="window.location.href='<?php echo base_url ?><?php echo $lang ;?>/insights/are-gcc-businesses-leveraging-social-media-enough/'">
                            <img class="card-img-top" src="<?php echo base_url ?>/uploads/blog_images/Group%20160532.png" alt="Card image">
                            <div class="card-body ">
                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/category/Technology/" class="btn-link">Technology</a>
                                <h4 class="card-title card_2">Are GCC businesses leveraging social media enough?                                </h4>
                                <p class="card-text card_2">
                                    This increasing reach, twinned with the growing presence of young people on social media, has opened up new avenues for companies to interact with their customers of the industries that are currently active on social channels across the region, the retail industry leads engagement on Facebook in almost all of the GCC countries...                                
                                    <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/are-gcc-businesses-leveraging-social-media-enough/" class="hvr-icon-forward btn-link">Read More </a>
                                </p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </section>
        <?php } ?>
        
      <?php if($industry_list_details['title'] == 'Technology') 
      { ?>
        <section class="industry-blog">
            <div class="container">
                <div class="tabout">
                    <h2 class="title b_title">Related Insights</h3>
                </div>
                <div class="row blogs service-related-blog">
                    <div class="col-lg-4 blog_1">
                        <div class="card blog-b border" onclick="window.location.href='<?php echo base_url ?><?php echo $lang ;?>/insights/five-digital-shifts-impacting-ksa-banks/'">
                            <img class="card-img-top" src="https://marmore-assets-v2.s3.eu-west-1.amazonaws.com/insights/migrated/Saudi-Arabia-Entertainment-831x353.jpg" alt="Card image">
                            <div class="card-body ">
                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/category/business-sector/" class="btn-link">Business Sector</a>
                                <h4 class="card-title card_2">Five Digital Shifts Impacting KSA Banks</h4>
                                <p class="card-text card_2">
                                    Banks have been adopting digitalization at a faster pace driven by the covid-19 pandemic situation that entailed surge in contactless transactions. There is an increase in number of fintechs in the recent past and new neo banks are emerging across the globe...
                                </p>
                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/five-digital-shifts-impacting-ksa-banks/" class="hvr-icon-forward btn-link">Read More </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 blog_1">
                        <div class="card blog-b border" onclick="window.location.href='<?php echo base_url ?><?php echo $lang ;?>/insights/covid-19-accelerates-saudi-arabias-push-towards-cashless-society/'">
                            <img class="card-img-top" src="https://marmore-assets-v2.s3.eu-west-1.amazonaws.com/insights/migrated/COVID-19-accelerates-Saudi-Arabia-push-towards-cashless-society_1200x600.jpg" alt="Card image">
                            <div class="card-body ">
                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/category/Economy/" class="btn-link">Economy</a>
                                <h4 class="card-title card_2">COVID-19 accelerates Saudi Arabia's push towards cashless society                                </h4>
                                <p class="card-text card_2">
                                    Event Youth between the ages 16 and 22 in Saudi Arabia are using less cash compared to other age groups, indicating that the country's transition towards a cashless society is on track...                                </p>
                                </p>
                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/covid-19-accelerates-saudi-arabias-push-towards-cashless-society/" class="hvr-icon-forward btn-link">Read More </a>
                            </div>
                        </div>
                    </div>
                     <div class="col-lg-4 blog_1">
                        <div class="card blog-b border" onclick="window.location.href='<?php echo base_url ?><?php echo $lang ;?>/insights/covid-19-a-catalyst-for-edtech-industry-in-gcc-region/'">
                            <img class="card-img-top" src="https://marmore-assets-v2.s3.eu-west-1.amazonaws.com/insights/migrated/EducationLaptop01_EdTech_1200x600.jpg" alt="Card image">
                            <div class="card-body ">
                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/category/Technology/" class="btn-link">Technology</a>
                                <h4 class="card-title card_2">'COVID-19' a catalyst for EdTech industry in GCC region </h4>
                                <p class="card-text card_2">
                                    The EdTech industry is transforming traditional learning methods by blending digital capabilities and the widespread penetration of digital devices within the general population...                                
                                    <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/covid-19-a-catalyst-for-edtech-industry-in-gcc-region/" class="hvr-icon-forward btn-link">Read More </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php } ?>
        
      <?php if($industry_list_details['title'] == 'Healthcare') 
      { ?>
        <section class="industry-blog">
            <div class="container">
                <div class="tabout">
                    <h2 class="title b_title">Related Insights</h3>
                </div>
                <div class="row blogs service-related-blog">
                    <div class="col-lg-4 blog_1">
                        <div class="card blog-b border" onclick="window.location.href='<?php echo base_url ?><?php echo $lang ;?>/insights/private-sector-participation-in-saudi-healthcare-picks-up-pace/'">
                            <img class="card-img-top" src="https://www.marmoremena.com/wp-content/uploads/2021/09/Saudi-Arabia-Towards-Healthcare-Transformation-1200x600.jpg" alt="Card image">
                            <div class="card-body ">
                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/category/business-sector/" class="btn-link">Business Sector</a>
                                <h4 class="card-title card_2">Private sector participation in Saudi Healthcare picks up pace</h4>
                                <p class="card-text card_2">
                                 Saudi Arabia has recently undertaken initiatives to increase private sector participation in its healthcare sector and improve competency of its healthcare workforce. The country has also highlighted key segments of focus in the healthcare sector. Saudi Arabia’s growing population with expected increase in average age and rising lifestyle related diseases are indicative of the uptrend in demand for healthcare in the country. As the Saudi Healthcare sector is predominantly operated by Ministry of Health (MoH), the demand could overload public...                                </p>
                                </p>
                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/private-sector-participation-in-saudi-healthcare-picks-up-pace/" class="hvr-icon-forward btn-link">Read More </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 blog_1">
                        <div class="card blog-b border" onclick="window.location.href='<?php echo base_url ?><?php echo $lang ;?>/insights/uae-fb-sector-what-are-the-pain-points/'">
                            <img class="card-img-top" src="<?php echo base_url ?>/uploads/blog_images/Group%20160532.png" alt="Card image">
                            <div class="card-body ">
                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/category/Economy/" class="btn-link">Economy</a>
                                <h4 class="card-title card_2">UAE F&B Sector – What are the pain points?</h4>
                                <p class="card-text card_2">
The total outlets in UAE for food services were 16,000+ in 2015 which is expect to expand by 17.4% annually to reach 19,000+ by 2020 (KPMG report). The market size for food and beverage (F&B) in UAE was measured at USD 14.27Bn and is expected to grow at a CAGR of more than 9% to reach USD 22.32Bn by 2020. While an affluent population with more mouths to feed is a positive indicator for the economy and for the F&B...                                </p>
                                </p>
                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/uae-fb-sector-what-are-the-pain-points/" class="hvr-icon-forward btn-link">Read More </a>
                            </div>
                        </div>
                    </div>
                     <div class="col-lg-4 blog_1">
                        <div class="card blog-b border" onclick="window.location.href='<?php echo base_url ?><?php echo $lang ;?>/insights/healthcare-in-saudi-arabia-where-are-the-opportunities/'">
                            <img class="card-img-top" src="<?php echo base_url ?>/uploads/blog_images/Group%20160532.png" alt="Card image">
                            <div class="card-body ">
                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/category/Technology/" class="btn-link">Technology</a>
                                <h4 class="card-title card_2">Healthcare in Saudi Arabia – where are the opportunities?</h4>
                                <p class="card-text card_2">
The government is benevolent to the extent that it pays for all medical charges even outside the country if it is deemed necessary for a patient to travel abroad for advanced healthcare facilities. Saudi’s healthcare system is comprised of three service providers – the Ministry of Health (MoH) hospitals, government hospitals and private hospitals. However, gaps are evident in the services offered to the people. The kingdom is projected to require 15,888 beds in 2018, accounting for almost 50 per...
                                     </p>
                                    <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/healthcare-in-saudi-arabia-where-are-the-opportunities/" class="hvr-icon-forward btn-link">Read More </a>
                               
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </section>
        <?php } ?>

         <?php if($industry_list_details['title'] == 'Retail') 
      { ?>
        <section class="industry-blog">
            <div class="container">
                <div class="tabout">
                    <h2 class="title b_title">Related Insights</h3>
                </div>
                <div class="row blogs service-related-blog">
                    <div class="col-lg-4 blog_1">
                        <div class="card blog-b border" onclick="window.location.href='<?php echo base_url ?><?php echo $lang ;?>/insights/kuwait-luxury-retail-evolving-amid-covid-19/'">
                            <img class="card-img-top" src="https://marmore-assets-v2.s3.eu-west-1.amazonaws.com/insights/migrated/Kuwait-Luxury-Retail_530x298.jpg" alt="Card image">
                            <div class="card-body ">
                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/category/business-sector/" class="btn-link">Business Sector</a>
                                <h4 class="card-title card_2">Kuwait Luxury Retail – Evolving amid COVID-19</h4>
                                <p class="card-text card_2">
                                    Kuwait boasts the presence of several major luxury brands such as Prada, Gucci, Louis Vuitton and Chaumet, Bottega Veneta etc. Ranking 13th in the world in terms of per capita GDP,...
                                </p>
                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/kuwait-luxury-retail-evolving-amid-covid-19/" class="hvr-icon-forward btn-link">Read More </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 blog_1">
                        <div class="card blog-b border" onclick="window.location.href='<?php echo base_url ?><?php echo $lang ;?>/insights/gcc-retail-sector-in-the-post-covid-world-bound-for-a-k-shaped-recovery/'">
                            <img class="card-img-top" src="https://marmore-assets-v2.s3.eu-west-1.amazonaws.com/insights/migrated/GCC-retail-sector-in-the-post-covid-world-iCover-1200x600.jpg" alt="Card image">
                            <div class="card-body ">
                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/category/business-sector/" class="btn-link">Business Sector</a>
                                <h4 class="card-title card_2">GCC retail sector in the post-covid world: Bound for a "K" shaped recovery</h4>
                                <p class="card-text card_2">
                                    The pandemic has changed the lives of billions of global citizens. Businesses have been forced to adopt new ways of functioning. The post pandemic world is expected to be never like before and experts have christened it as the "new-normal"....                                </p>
                                </p>
                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/gcc-retail-sector-in-the-post-covid-world-bound-for-a-k-shaped-recovery/" class="hvr-icon-forward btn-link">Read More </a>
                            </div>
                        </div>
                    </div>
                     <div class="col-lg-4 blog_1">
                        <div class="card blog-b border" onclick="window.location.href='<?php echo base_url ?><?php echo $lang ;?>/insights/islamic-retail-asset-management/'">
                            <img class="card-img-top" src="https://marmore-assets-v2.s3.eu-west-1.amazonaws.com/insights/migrated/Islamic-Retail-Asset-Management-Marmore-Article-Image.jpg" alt="Card image">
                            <div class="card-body ">
                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/category/Capital Market/" class="btn-link">Capital Market</a>
                                <h4 class="card-title card_2">Secular trends underline long-term growth for Islamic asset management
                                </h4>
                                <p class="card-text card_2">
                                    S&P global ratings expects Islamic finance industry (USD 2.4trillion) to witness subdued growth in low single digits for 2020/21 after registering strong growth of 11.4% the previous year, on the back of robust issuance and strong performance of Sukuk...                                
                                    <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/islamic-retail-asset-management/" class="hvr-icon-forward btn-link">Read More </a>
                                </p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </section>
        <?php } ?>
         
        <?php if($industry_list_details['title'] == 'Energy & Natural Resources') 
      { ?>
        <section class="industry-blog">
            <div class="container">
                <div class="tabout">
                    <h2 class="title b_title">Related Insights</h3>
                </div>
                <div class="row blogs service-related-blog">
                    <div class="col-lg-4 blog_1">
                        <div class="card blog-b border" onclick="window.location.href='<?php echo base_url ?><?php echo $lang ;?>/insights/msci-emerging-markets-index/'">
                            <img class="card-img-top" src="https://marmore-assets-v2.s3.eu-west-1.amazonaws.com/insights/migrated/MSCI-Emerging-Markets-Index-_1200x600.jpg" alt="Card image">
                            <div class="card-body ">
                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/category/Capital Market/" class="btn-link">Capital Market</a>
                                <h4 class="card-title card_2">MSCI Emerging Markets Index – How is the GCC placed?</h4>
                                <p class="card-text card_2">
                                    With a total market capitalization of USD 8.3 trillion, the MSCI Emerging Markets (EM) Index has emerged as one of the most important global indices tracked by many ETFs and mutual funds....
                                </p>
                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/msci-emerging-markets-index/" class="hvr-icon-forward btn-link">Read More </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 blog_1">
                        <div class="card blog-b border" onclick="window.location.href='<?php echo base_url ?><?php echo $lang ;?>/insights/will-covid-19-reduce-the-appetite-for-renewable-energy-projects-in-the-gcc/'">
                            <img class="card-img-top" src="https://marmore-assets-v2.s3.eu-west-1.amazonaws.com/insights/migrated/GCC-Renewable-energy_Blog_1200x600.jpg" alt="Card image">
                            <div class="card-body ">
                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/category/business-sector/" class="btn-link">Business Sector</a>
                                <h4 class="card-title card_2">Will COVID-19 reduce the appetite for renewable energy projects in the GCC?</h4>
                                <p class="card-text card_2">
                                    The outbreak of COVID-19 has deeply impacted global economies, pushing them into a recession. As health and economic concerns continue to mount, the near-term outlook for renewable energy projects look weak. ....                                </p>
                                </p>
                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/will-covid-19-reduce-the-appetite-for-renewable-energy-projects-in-the-gcc/" class="hvr-icon-forward btn-link">Read More </a>
                            </div>
                        </div>
                    </div>
                     <div class="col-lg-4 blog_1">
                        <div class="card blog-b border" onclick="window.location.href='<?php echo base_url ?><?php echo $lang ;?>/insights/electric-and-hybrid-vehicles-how-soon-can-they-disrupt-in-gcc/'">
                            <img class="card-img-top" src="https://marmore-assets-v2.s3.eu-west-1.amazonaws.com/insights/migrated/Electric-and-Hybrid-Vehicles-831x353.jpg" alt="Card image">
                            <div class="card-body ">
                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/category/Technology/" class="btn-link">Technology</a>
                                <h4 class="card-title card_2">Electric and Hybrid Vehicles – How soon can they disrupt in GCC?
</h4>
                                <p class="card-text card_2">
                                    Global demand for electric vehicles is expected to surge during the next few decades. The market was valued at almost USD 103bn in 2015 and expected to be close to USD 400bn by 2024....                                
                                    <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/electric-and-hybrid-vehicles-how-soon-can-they-disrupt-in-gcc/" class="hvr-icon-forward btn-link">Read More </a>
                                </p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </section>
        <?php } ?>
        <?php if($industry_list_details['title'] == 'Real Estate') 
      { ?>
        <section class="industry-blog">
            <div class="container">
                <div class="tabout">
                    <h2 class="title b_title">Related Insights</h3>
                </div>
                <div class="row blogs service-related-blog">
                    <div class="col-lg-4 blog_1">
                        <div class="card blog-b border" onclick="window.location.href='<?php echo base_url ?><?php echo $lang ;?>/insights/implications-of-covid-19-on-gcc-asset-classes/'">
                            <img class="card-img-top" src="https://marmore-assets-v2.s3.eu-west-1.amazonaws.com/insights/migrated/Implications-of-COVID-19-on-GCC-Asset-Classes_1200x600.jpg" alt="Card image">
                            <div class="card-body ">
                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/category/Capital Market/" class="btn-link">Capital Market</a>
                                <h4 class="card-title card_2">Implications of COVID-19 on GCC Asset Classes</h4>
                                <p class="card-text card_2">
                                    COVID-19 has rendered economic outlook and companies' performance projections for 2020 meaningless in a single stroke. Heightened uncertainty has become an everyday reality in the current times....
                                </p>
                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/implications-of-covid-19-on-gcc-asset-classes/" class="hvr-icon-forward btn-link">Read More </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 blog_1">
                        <div class="card blog-b border" onclick="window.location.href='<?php echo base_url ?><?php echo $lang ;?>/insights/impact-of-covid-19-on-gcc-reits/'">
                            <img class="card-img-top" src="https://marmore-assets-v2.s3.eu-west-1.amazonaws.com/insights/migrated/Covid-19-on-GCC-REITs_1200x600.jpg" alt="Card image">
                            <div class="card-body ">
                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/category/Capital Market/" class="btn-link">Capital Market</a>
                                <h4 class="card-title card_2">Impact of Covid-19 on GCC REITs </h4>
                                <p class="card-text card_2">
                                    The GCC has seen a number of Real Estate Investment Trusts (REITs) listed in stock exchanges in the past few years. This accelerated after Saudi Arabia's Capital Markets Authority (CMA) approved the listing of REITs in 2016 as a part of the National Transformation Program (NTP) and Saudi Vision 2030....                                </p>
                                </p>
                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/impact-of-covid-19-on-gcc-reits/" class="hvr-icon-forward btn-link">Read More </a>
                            </div>
                        </div>
                    </div>
                     <div class="col-lg-4 blog_1">
                        <div class="card blog-b border" onclick="window.location.href='<?php echo base_url ?><?php echo $lang ;?>/insights/autonomous-vehicles-how-will-they-transform-the-gcc-real-estate-sector/'">
                            <img class="card-img-top" src="https://marmore-assets-v2.s3.eu-west-1.amazonaws.com/insights/migrated/Marmore-Blog-Autonomous-Vehicles-831x353.jpg" alt="Card image">
                            <div class="card-body ">
                                <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/category/Technology/" class="btn-link">Technology</a>
                                <h4 class="card-title card_2">Autonomous Vehicles – How will they transform the GCC Real Estate Sector?                                </h4>
                                <p class="card-text card_2">
                                    The transport industry is on the cusp of another major breakthrough as Autonomous vehicles are expected not only to revolutionize the way we travel, but also the way we live...                                
                                    <a href="<?php echo base_url ?><?php echo $lang ;?>/insights/autonomous-vehicles-how-will-they-transform-the-gcc-real-estate-sector/" class="hvr-icon-forward btn-link">Read More </a>
                                </p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </section>
        <?php } ?>



        <section class="guides" id="" style="background-color: #EAF5FE;">
            <!-- Carousel -->
            <div id="demo" class="carousel slide" data-bs-ride="carousel">

                <!-- Indicators/dots -->
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="3"></button>
                    <button type="button" data-bs-target="#demo" data-bs-slide-to="4"></button>
                </div>

                <!-- The slideshow/carousel -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="carousel-caption caption">
                            <img src="/assets/image/“.png">
                            <p class="slide">Marmore services were very useful and their team have provided a timely and reliable service in a challenging task. We are definitely looking for more cooperation in the future.</p>
                            <h3 class="slider">- Mrs. Rana Adawi, Chairperson and Managing Director of Acumeno Asset Management</h3>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="carousel-caption caption">
                            <img src="/assets/image/“.png">
                            <p class="slide">We were fortunate to work with Marmore on our project recently. The team was always professional, efficient and attentive to all our requests. They were prompt in addressing any concerns raised and we felt at ease approaching the team with our needs. We were pleased with the end result and would not hesitate to highly recommend Marmore for their business intelligent services.</p>
                            <h3 class="slider">- Dr. Fatima Al Awadhi,Founder of Kuwait-based Aesthetic Clinic</h3>
                        </div>
                    </div>
                    
                    <div class="carousel-item">
                        <div class="carousel-caption caption">
                            <img src="/assets/image/“.png">
                            <p class="slide">Marmore team is very professional, from day one I saw that when they replied to my first email. We had our first project and they did a great. Many changes have been done and they were very flexible with us. It will not be our last project for sure, thanks Marmore team.</p>
                            <h3 class="slider">- Abdullah Molla, Head of Communication & Business Development, Riyadh Valley Company</h3>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="carousel-caption caption">
                            <img src="/assets/image/“.png">
                            <p class="slide">Marmore has provided both timely and reliable and services in the provision of market data. This service has proven valuable in supporting the research activities of Acreditus across all our client focus areas of credit, rating and Islamic finance advisory. I sincerely hope to continue to engage them on more advanced projects soon.</p>
                            <h3 class="slider">- Khalid F Howladar, Managing Director and Founder of Acreditus</h3>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="carousel-caption caption">
                            <img src="/assets/image/“.png">
                            <p class="slide">The experience of working with Marmore has been very positive. A precise understanding of our requirements and high quality deliverables were the key takeaways. The turnaround time for the tasks was excellent, without any delays and the tasks were handled in a professional manner.</p>
                            <h3 class="slider">- Nigel Sillitoe, CEO, Insight Discovery - UAE</h3>
                        </div>
                    </div>
                </div>

                <!-- Left and right controls/icons -->
                <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>

        </section>
        <!--<section class="industry-blogs">-->
        <!--    <div class="container">-->
        <!--        <div class="tabout">-->
        <!--            <h2 class="title b_title">Client stories</h2>-->
        <!--        </div>-->
        <!--        <div class="row">-->
            <?php //if(isset($related_client_story) && count($related_client_story)>0) { foreach($related_client_story as $related_client_story) { -->
                    
                    //$blog_image = pathinfo($related_client_story['image']);
                                    
                        //  if(isset($related_client_story['image']) && !isset($blog_image['dirname']) && !empty($related_client_story['image']))
                        //   {
                        //       $img = base_url.'uploads/client_images/'.$related_client_story['image'];
                        //   }
                        //  else if(isset($related_client_story['image']) && isset($blog_image['dirname']))
                        //   {
                        //       $img = $related_client_story['image'];
                        //   }
                        //   else
                        //   {
                          // $img = base_url.'uploads/blog_images/Group160532.png';-->
                          //}
                    
                    
             ?>
        <!--            <div class="col-lg-4">-->
        <!--                <a href="<?php //echo base_url.$lang ?>/clients/<?php //echo $related_client_story['slug'] ?>">-->
        <!--                <div class="card card_m">-->
        <!--                    <img class="card-img-top" src="<?php //echo $img ?>" alt="Card image"-->
        <!--                        style="width:100%">-->
        <!--                    <div class="card-body card_client ">-->
        <!--                        <a href="<?php //echo base_url ?>/<?//= $lang ?>/clients/<?php //echo $related_client_story['slug'] ?>" class="btn-link"><?php //echo $related_client_story['title']?></a>-->
        <!--                        <h4 class="card-title card_client" style="margin-top: 5px; font-weight: bold;"><?php //echo $related_client_story['story_title']?></h4>-->
        <!--                        <p class="card-text" style="padding: 0px;"><?php //echo $related_client_story['story_desc']?>-->
        <!--                        </p>-->
        <!--                        <a href="<?php //echo base_url.$lang ?>/clients/<?php //echo $related_client_story['slug'] ?>" class="hvr-icon-forward btn-link">Read More </a>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--                </a>-->
        <!--            </div>-->
          <?php //} } ?>
        <!--        </div>-->
        <!--    </div>-->
      <?php include("include/footer.php"); ?>

             <script src="<?php echo base_url ?>assets/js/jquery.min.js"></script>
          <script src="<?php echo base_url ?>assets/js/bootstrap.bundle.min.js"></script>

    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>-->

    <script src="assets/js/main.js"></script>

    <script>
        const anchors = document.querySelectorAll('nav a')

        anchors.forEach(anchor => anchor.addEventListener("click", onClick));

        function onClick(e) {
            anchors.forEach(achor => achor.classList.remove('active'))
            e.target.classList.add('active')
        }
    </script>
