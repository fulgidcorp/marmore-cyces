<?php
ini_set('display_errors',1);

include_once('config/config.php');
function noHTML($input, $encoding = 'UTF-8') {
   return htmlentities($input, ENT_QUOTES | ENT_HTML5, $encoding);
}
//fetch all client story
$client_story_slide      = "select * from tbl_client_stories where is_active=1 and is_delete=1 order by id DESC LIMIT 5"; 
$client_story_list_slide       = $objTypes->fetchAll($client_story_slide); 
// echo '<pre>';
// print_r($client_story_list);
// exit;
$limit = 12;  
if (isset($_GET["page"])) {
	$page  = $_GET["page"]; 
	} 
	else{ 
	$page=1;
	}
$start_from = ($page-1) * $limit; 
$client_story      = "select a.*,b.* from tbl_industry a right join tbl_client_stories b ON a.id=b.client_industry_id where b.is_active=1 and b.is_delete=1 order by b.id DESC LIMIT $start_from, $limit"; 
// $client_story      = "select * from tbl_client_stories where is_active=1 and is_delete=1 LIMIT $start_from, $limit"; 
$client_story_list       = $objTypes->fetchAll($client_story); 
// echo '<pre>';
// print_r($client_story_list);
// exit;
if(isset($path[2]))
{
     $title = $path[2];
    $client_story_list_details   = "select * from tbl_client_stories where is_active = 1 and is_delete = 1 and slug='$title'";
    $client_story_list_details       = $objTypes->fetchRow($client_story_list_details); 
    
    //fetch related reports list
    $explore_reports_list_details   = "select * from tbl_client_stories where is_active = 1 and is_delete = 1 and id NOT IN (".$client_story_list_details['id'].") limit 3";
    $all_explore_products_list_details       = $objTypes->fetchAll($explore_reports_list_details); 
    require("client-page.php");
    exit;
}
?>
<style>
    .carousel-item {
  /*//height: 50vh;*/
  /*min-height: 300px;*/
  background-color: #EAF5FE;
  /*width: 540px;*/
}


    nav.navbar.align-items-center {
    position: relative;
}
.breadcrumb1 {
    margin-top: 0px !important;
}
</style>
        <!--<section class="banner b_client">-->
            <!--<div class="banner-img i_client">-->
            <!--    <div class="row">-->
            <!--        <div class="col-lg-6">-->
                         
            <!--        </div>-->
                  
                 
                   
                   
            <!--    </div>-->
            <!--</div>-->



        <!--</section>-->
        <section class="guides" id="">
            <div class="row">
                <div class="col-md-6">
                   <div class="tabout">
                        <h2 class="title text-left" style="text-align: left; font-size: 30px;">How Clients Win With Marmore</h2>
                    </div>
                </div>
                <div class="col-md-6">
                    <select class="right wide1" name="client_industry_id" id="client_industry_id">
                         <option value="All">Select Client Industry</option>
                    <?php
                    $ProdArray  = $objTypes->fetchAll("SELECT id,title FROM tbl_industry where is_active=1 and is_delete=1");
                    if(sizeof($ProdArray) > 0){
                        foreach($ProdArray as $prod_v){
                            if($prod_v['id'] == $client_story_list['client_industry_id']){
                                $selected = 'selected';
                            }
                            else{
                                $selected = '';
                            }
                            ?>
                            <option value="<?php echo $prod_v['id'] ?>" <?=$selected?>><?php echo $prod_v['title']; ?></option>
                            <?php
                        }
                    }
                    ?>
                        <!--<option class="selected" selected value="0">Business Plan</option>-->
                        <!--<option class="selected" value="1">Some option</option>-->
                        <!--<option class="selected" value="2">Another option</option>-->
                        <!--<option class="selected" value="4">Potato</option>-->
                    </select>
                </div>
                <div class="card1" style="padding-top: 40px;" id="report_client_industry_search_div">
                    <div class="row">
                         <?php if(isset($client_story_list) && !empty($client_story_list)) 
                               { 
                                   foreach($client_story_list as $val)
                                    {
                                        $blog_image = pathinfo($val['image']);
                                        if(isset($val['image']) && isset($blog_image['dirname']) && $blog_image['dirname']=='.')
                                          {
                                              $img = base_url.'uploads/client_images/'.$val['image'];
                                          }
                                          else if(isset($val['image']) && isset($blog_image['dirname']))
                                          {
                                              $img = $val['image'];
                                          }
                                          else
                                          {
                                              $img = base_url.'uploads/blog_images/Group 160532.png';
                                          }
                        
                            ?>
                        <div class="col-lg-4">
                            <div class="card card_m" onclick="window.location.href='<?php echo base_url.$lang ?>/clients/<?php echo $val['slug'] ?>'">
                                <img class="card-img-top" src="<?php echo $img ?>" alt="Card image"
                                    style="width:100%">
                                <div class="card-body card_client">
                                    <a href="<?php echo base_url.$lang ?>/clients/<?php echo $val['slug'] ?>" class="btn-link"><?php echo $val['title']?></a>
                                    <h4 class="card-title card_client" style="margin-top: 5px; font-weight: bold;"><?php echo $val['story_title']?></h4>
                                    <p class="card-text" style="padding: 0px;"><?php echo $val['story_desc']?>
                                    </p>
                                    <a href="<?php echo base_url.$lang ?>/clients/<?php echo $val['slug'] ?>" class="hvr-icon-forward btn-link">Read More </a>
                                </div>
                            </div>
                        </div>
                        <?php } } ?>
                    
                    </div>
                   
                </div>
            </div>
            </div>
                 </section>
                


    </div>
    
  <script src="<?php echo base_url ?>assets/js/jquery.min.js"></script>
          <script src="<?php echo base_url ?>assets/js/bootstrap.bundle.min.js"></script>
                    <script src="<?php echo base_url ?>assets/js/jquery.nice-select.js"></script>

    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.js"></script>-->
        <script src="<?php echo base_url ?>assets/js/main.js"></script>
  <link rel="stylesheet" href="<?php echo base_url ?>assets/css/nice-select.css">

<script>
    $(document).ready(function () {
        $('select').niceSelect();
    });
</script>
<script>
    $(document).ready(function(){
      $("#client_industry_id").on("change",function(e){
        var client_industry = $("#client_industry_id").val();
        $.ajax({
              url : "ajax_get_client_industry.php",
              type: "POST",
              cache: false,
              data : {client_industry:client_industry},
              success:function(result){
                  if(result){
                		$("#report_client_industry_search_div").html(result);
                		$(".pagination").css("display","none")
                  }
                  else
                  {
                     location.reload();
                  }
              }
              });
      });
    });
</script>
<?php 
if(isset($path[1]) && !isset($_POST['client_industry'])){
?>
<div class="pagination">
<?php  
    $row_db = $objTypes->fetchAll("SELECT * FROM tbl_client_stories where is_active=1 and is_delete=1"); 
    $row_db = count($row_db);  
    $total_records = $row_db;  
    $total_pages = ceil($total_records / $limit);
?>
 <?php 
  $count = 5;
$startPage = max(1, $page - $count);
$endPage = min( $total_pages, $page + $count);
?>
<a href="?page=<?=($page-1)?>" class="<?=$page <= 1 ? 'disabled': ''; ?>">&laquo;</a>
 <?php 
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
<?php } ?>
<section class="guides" id="" style="">
            <div class="row">
              <div class="tabout">
                        <h2 class="title text-center" style="text-align: left; font-size: 30px;">Hear from our clients</h2>
              </div> 
             <div class="col-lg-12 carousel" id="demo" data-bs-ride="carousel">
                        <!-- The slideshow/carousel -->
                        <div class="carousel-inner c_client1">
                            <div class="carousel-item  active">
                                <div class="carousel-caption caption caption_client1">
                                    <p class="slide c_client">Marmore services were very useful and their team have provided a timely and reliable service in a challenging task. We are definitely looking for more cooperation in the future.</p>
                                     <h5 class="gcc">- Mrs. Rana Adawi, Chairperson and Managing Director of Acumeno Asset Management</h5>
                                </div>
                            </div>
                            <div class="carousel-item ">
                                <div class="carousel-caption caption caption_client1">
                                    <p class="slide c_client">We were fortunate to work with Marmore on our project recently. The team was always professional, efficient and attentive to all our requests. They were prompt in addressing any concerns raised and we felt at ease approaching the team with our needs. We were pleased with the end result and would not hesitate to highly recommend Marmore for their business intelligent services.</p>
                                     <h5 class="gcc">- Dr. Fatima Al Awadhi,Founder of Kuwait-based Aesthetic Clinic</h5>
                                </div>
                            </div>
                            <div class="carousel-item ">
                                <div class="carousel-caption caption caption_client1">
                                    <p class="slide c_client">Marmore team is very professional, from day one I saw that when they replied to my first email. We had our first project and they did a great. Many changes have been done and they were very flexible with us. It will not be our last project for sure, thanks Marmore team.</p>
                                     <h5 class="gcc">- Abdullah Molla, Head of Communication &amp; Business Development, Riyadh Valley Company</h5>
                                </div>
                            </div>
                            <div class="carousel-item ">
                                <div class="carousel-caption caption caption_client1">
                                    <p class="slide c_client">Marmore has provided both timely and reliable and services in the provision of market data. This service has proven valuable in supporting the research activities of Acreditus across all our client focus areas of credit, rating and Islamic finance advisory. I sincerely hope to continue to engage them on more advanced projects soon.</p>
                                     <h5 class="gcc">- Khalid F Howladar, Managing Director and Founder of Acreditus</h5>
                                </div>
                            </div>
                            <div class="carousel-item ">
                                <div class="carousel-caption caption caption_client1">
                                   <p class="slide c_client">The experience of working with Marmore has been very positive. A precise understanding of our requirements and high quality deliverables were the key takeaways. The turnaround time for the tasks was excellent, without any delays and the tasks were handled in a professional manner.</p>
                                     <h5 class="gcc">- Nigel Sillitoe, CEO, Insight Discovery - UAE</h5>
                                </div>
                            </div>
                            <div class="carousel-indicators c_client1">
                                <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                                <button type="button" data-bs-target="#demo" data-bs-slide-to="1" class=""></button>
                                <button type="button" data-bs-target="#demo" data-bs-slide-to="2" class=""></button>
                                <button type="button" data-bs-target="#demo" data-bs-slide-to="3" class=""></button>
                                <button type="button" data-bs-target="#demo" data-bs-slide-to="4" class="" aria-current="true"></button>
                            </div>
                        </div>
                        
                    </div>
                    </div>
        </section>