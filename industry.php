<?php
//fetch all industry list
$all_industry_list = "select * from tbl_industry where is_active=1 and is_delete=1";
$industry_list       = $objTypes->fetchAll($all_industry_list); 
// echo '<pre>';
// print_r($path);
// exit;
if(isset($path[2]) && $path[2]!='')
{
$fetch_industry_details = "select * from tbl_industry where is_active=1 and is_delete=1 and slug='$path[2]'";
$industry_list_details       = $objTypes->fetchRow($fetch_industry_details); 
//related blogs
if(isset($path[2]) && $prev_row['title']=="Business Plan & Feasibility Studies")
    {
         $category_name = "Business Sector";
    }
$fetch_related_blogs   = "select b.*,bc.* from tbl_blogs b inner join tbl_blogs_category bc on b.`category_id`=bc.id where b.is_active = 1 and b.is_delete = 1 order by b.created_date DESC limit 3";
$related_blog_list       = $objTypes->fetchAll($fetch_related_blogs); 
//related client stories
$client_story = "select cs.*,i.* from tbl_client_stories cs right join tbl_industry i on cs.`client_industry_id`=i.id where cs.is_active = 1 and cs.is_delete = 1 and cs.client_industry_id=".$industry_list_details['id']." order by cs.updated_date DESC limit 3";
//$client_story = "select * from tbl_client_stories where is_active=1 and is_delete=1 and client_industry_id=".$industry_list_details['id']." order by updated_date DESC limit 3";
$related_client_story       = $objTypes->fetchAll($client_story); 
if(empty($related_client_story))
{
    //echo 'hii';
    $related_client_story = "select * from tbl_client_stories  where is_active=1 and is_delete=1 and client_industry_id IS NULL order by updated_date DESC limit 3";
    $related_client_story       = $objTypes->fetchAll($related_client_story); 
}
require("individual-industry.php");
exit;
}
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
        <div class="content content1 pb-50">
            <div class="row vertical-align">
                <div class="col-lg-6">
                    <div class=" pb-50">
                        <div class="major-content">
                            <h2 class="title pt-4">Industry</h2>
                            <p class="sub-title subtitle pt-3">Whether you have a question about features, trails,
                                pricing, need a demo, or anything else, our team is ready to answer all your questions.
                            </p>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 ">
                    <div class="text-right">
                        <img src="/assets/image/about-us-banner.png" alt="world" class="banner-img1" width="600">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--<div class="container">-->
    <!--    <div class="content-us">-->
    <!--        <p class="text-center">Established in 2010, Marmore is a research subsidiary of Kuwait Financial Centre-->
    <!--            “Markaz”, an investment bank and asset management firm with a track record of 45 years of business.-->
    <!--            Marmore caters to the growing research and information needs of organizations in the MENA region.-->
    <!--            The company publishes reports and conducts research on demand. Our narrative revolves around supporting-->
    <!--            constructive transitions for many of our clients and partners. As a focused research company with a-->
    <!--            robust track record, we continuously look beyond the horizon to lead the next wave of growth and-->
    <!--            transformation for our clients, stakeholders and for ourselves.-->
    <!--            Marmore has been conferred the “Research Provider of the Year in MENA“ award by the Global Investor – a-->
    <!--            Euromoney Group company.</p>-->
    <!--    </div>-->
    <!--</div>-->
    <section class="about-icon pt-50 pb-50">
        <div class="container-fuild">
            <div class="title-content">
                <h2 class="icon-tittle">Areas of Expertise</h2>
                <p class="icon-text"></p>
            </div>
            <div class="row">
                <?php if(isset($industry_list) && count($industry_list) > 0) {
                foreach($industry_list as $industry_list)
                {
                ?>
                <div class="col-lg-3">
                    <div class="icon-boxes">
                        <div class="icon text-left"><img src="<?php echo base_url?>uploads/industry_images/<?php echo $industry_list['image']?>" alt=""></div>
                        <a href="<?php echo base_url ?>/<?= $lang ?>/industry/<?php echo $industry_list['slug'] ?>"><h3 class="text-left i-content"><?php echo $industry_list['title'] ?></h3></a>
                    </div>
                </div>
                <?php } } ?>
            </div>
            <!--<div class="text-center icon-btn">-->
            <!--    <a class="btn btn-2 btn-icon" href="#"><span>Download Corporate Profile</span></a>-->
            <!--</div>-->

        </div>
    </section>
   <script src="<?php echo base_url ?>assets/js/jquery.min.js"></script>
          <script src="<?php echo base_url ?>assets/js/bootstrap.bundle.min.js"></script>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>-->

    <script src="<?php echo base_url ?>assets/js/main.js"></script>

    <script>
        const anchors = document.querySelectorAll('nav a')

        anchors.forEach(anchor => anchor.addEventListener("click", onClick));

        function onClick(e) {
            anchors.forEach(achor => achor.classList.remove('active'))
            e.target.classList.add('active')
        }
    </script>
