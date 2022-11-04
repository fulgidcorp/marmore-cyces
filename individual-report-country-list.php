<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include_once('config/config.php');

$report_category        = "select * from tbl_report_data where is_active=1 and is_delete=1 and report_industry IS NOT NULL and report_industry!='' GROUP BY report_industry"; 
$report_category_list       = $objTypes->fetchAll($report_category); 

$country       = "select * from tbl_report_data where is_active=1 and is_delete=1 and report_country IS NOT NULL and report_country!='' GROUP BY report_country"; 
$country_list       = $objTypes->fetchAll($country);
//fetch all reports
// $limit = 12;  
// if (isset($_GET["page"])) 
// {
// 	$page  = $_GET["page"]; 
// } 
// else
// { 
//    $page=1;
// }
// $start_from = ($page-1) * $limit;  
// $title = ucfirst($path[2]);
// $reports      = "select * from tbl_report_data where is_active=1 and is_delete=1 and report_country='$title' order by report_date DESC LIMIT $start_from, $limit"; 
// $report_list       = $objTypes->fetchAll($reports); 

if(isset($path[2]) && $path[1]!='reports')
{
    $title = $path[2];
    $report_list_details   = "select * from tbl_report_data where is_active = 1 and is_delete = 1 and wp_slug='$title'";
    $all_report_list_details       = $objTypes->fetchRow($report_list_details); 
    
    //fetch related reports list
    $explore_reports_list_details   = "select * from tbl_report_data where is_active = 1 and is_delete = 1 and report_country LIKE '%".$all_report_list_details['report_country']."%' and id NOT IN (".$all_report_list_details['id'].") order by report_date DESC limit 4";
    $all_explore_products_list_details= $objTypes->fetchAll($explore_reports_list_details); 
    require("individual-report.php");
    exit;
}
else{
?>
<style>
    nav.navbar.align-items-center {
    position: relative;
}
.breadcrumb1 {
    margin-top: 0px !important;
}
</style>
        <section class="banner">

            <img src="<?php echo base_url ?>/assets/image/report-banner.png" alt="" class="banner-img b1">
            <div class="input-group mb-3 search">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-search" aria-hidden="true"></i></span>
                <input type="text" class="form-control reportSearch" placeholder="Search Reports" aria-label="report" aria-describedby="basic-addon1">
                <div id="suggesstion-box"></div>
            </div>
            <!-- <input class="form-control " name="search" placeholder="Search Article...." /> -->
        </section>

        <section class="guides" id="">
            <div class="row">
                <div class="col-md-4 col-lg-3 side-filter">
                    <div class="tabout">
                        <h2 class="title b_title">Filters</h3>
                        <div class="input-group mb-3 search1">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-search" aria-hidden="true"></i></span>
                            <input type="text" class="form-control reportSearch" placeholder="Search Reports" aria-label="report" aria-describedby="basic-addon1">
                            <div id="suggesstion-box"></div>
                        </div>
                    </div>
                    <div class="col-lg-12 grey-bg card_2">
                        <h4 class="font-weight-bold grey-color-text"><strong>Categories</strong></h4>
                        <div class="blog-card">
                            <form action="">
                                <?php 
                                if(isset($report_category) && !empty($report_category))
                                    {
                                foreach($report_category_list as $report_category) 
                                    { 
                                ?>
                                <!--report-category class used in script-->
                                <div class="form-group card_2">
                                    <?php
                                     $category_path = str_replace("-"," ",$path[3]);
                                     if($path[2]=='category' && $path[3]!='' && ucwords($category_path) == $report_category['report_industry'])
                                     {
                                        $checked = 'checked';
                                     }
                                     else
                                     {
                                        $checked = '';
                                     }
                                    ?>
                                    <input type="checkbox" class="report-category" id="Categories<?php echo $report_category['report_industry']?>" name="reportcategory<?php echo $report_category['report_industry']?>" value="<?php echo $report_category['report_industry']?>" <?php echo $checked ?>>
                                    <a href="<?php echo base_url.$lang ?>/reports/category/<?php echo str_replace(" ","-",strtolower($report_category['report_industry'])); ?>"><label for="report-category<?php echo $report_category['report_industry']?>" style="padding-bottom: 5px;"><?php echo $report_category['report_industry']?></label></a>
                                </div>
                                <?php } } ?>
                            </form>
                            
                        </div>
                    </div>
                    <div class="col-lg-12 grey-bg card_2">
                        <h4 class="font-weight-bold grey-color-text"><strong>Countries</strong></h4>
                        <div class=" blog-card">
                            <form action="">
                                <?php
                                 if(isset($country_list) && !empty($country_list))
                                 {
                                    foreach($country_list as $con)
                                    {
                                ?>
                                <!--report-country class used in script-->
                                <div class="form-group card_2">
                                <?php
                                     $country_path = str_replace("-"," ",$path[3]);
                                     if($path[2]=='country' && $path[3]!='' && ucwords($country_path) == $con['report_country'])
                                     {
                                        $checked = 'checked';
                                     }
                                     else
                                     {
                                        $checked = '';
                                     }
                                    ?>
                                    <input type="checkbox" class="report-country" id="reportcountry<?php echo $con['report_country']?>" name="reportcountry<?php echo $con['report_country']?>" value="<?php echo $con['report_country']?>" <?php echo $checked ?>>
                                    <a href="<?php echo base_url.$lang ?>/reports/country/<?php echo str_replace(" ","-",strtolower($con['report_country'])); ?>"><label for="report-country<?php echo $con['report_country']?>" style="padding-bottom: 5px;"><?php echo $con['report_country']?></label></a>
                                </div>
                                <?php }} ?>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-lg-9" id="report_category_search_div">
                    <div class="tabout tabout1">
                    <?php $name = str_replace("-"," ",$path[3]); ?>
                        <h2 class="title b_title"><?php echo isset($name)?ucwords($name):''?></h3>
                            <p class="text-left paratext"></p>
                    </div>
                    <div class="report-card">
                    <div class="row relative-report blogs">
                        <?php 
                          if(isset($all_report_country_details) && !empty($all_report_country_details))
                          {
                             foreach($all_report_country_details as $reports)
                             {
                                 $blog_image = pathinfo($reports['report_images']);
                                    
                                 if(isset($reports['report_images']) && isset($blog_image['dirname']) && $blog_image['dirname']=='.')
                                  {
                                      $img = base_url.'uploads/report_images/'.$reports['report_images'];
                                  }
                                  else if(isset($reports['report_images']) && isset($blog_image['dirname']))
                                  {
                                      $img = $reports['report_images'];
                                  }
                                  else
                                  {
                                      $img = base_url.'uploads/blog_images/Group 160532.png';
                                  }
                        ?>
                        <div class="col-lg-4 blog_1">
                                <div class="card blog-b border" onclick="window.location.href='<?php echo base_url.$lang ?>/reports/<?php echo $reports['wp_slug'] ?>'">
                                <img class="card-img-top" src="<?php echo $img ?>" alt="<?php echo $reports['report_name']?>">
                                <div class="card-body ">
                                    <a href="<?php echo base_url.$lang ?>/reports/<?php echo $reports['wp_slug'] ?>"><h4 class="card-title card_3"><?php echo $reports['report_name']?></h4></a>
                                    <p class="gray" ><?php echo date("F d, Y",strtotime($reports['report_date'])) ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php } } ?>
                    </div>
                    
                </div>
                    <!--<div class="link1 text-center" id="loadMore"><a class=" btn1-link"><i class="fa fa-download"-->
                    <!--            aria-hidden="true"></i>View more</a>-->
                    <!--</div>-->
                </div>


            </div>
        </section>

   <?php } ?>
    

    <script src="<?php echo base_url ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url ?>assets/js/main.js"></script>
    <script src="<?php echo base_url ?>assets/js/bootstrap.bundle.min.js"></script>

    <!--AJAX call for autocomplete-->
<script type="text/javascript">
$(document).ready(function(){
	$(".reportSearch").keyup(function(){
	    var report = $(this).val();
	    if(report.length > 0)
	    {
		$.ajax({
		type: "POST",
		url: "ajax_get_autocomplete_report.php",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$(".reportSearch").css("background","#FFF no-repeat 165px");
			$(".pagination").css("display","none")
		},
		
		success: function(data){
          if(data)
		    {
    			$("#suggesstion-box").show();
    			//$("#suggesstion-box").html(data);
    			$(".reportSearch").css("background","#FFF");
    			$("#report_category_search_div").html(data);
		    }
		    else
		    {
		        location.reload();
		    }
		}
		});
	}
	else
	{
	    location.reload();
	}
	});
});
//To select country name
// function selectReport(val) {
// $("#reportSearch").val(val);
// $("#suggesstion-box").hide();
// // $("#report_category_search_div").html(result);

// }
</script>
    <script type="text/javascript">
    //     $(document).ready(function () {
    // size_div = $("#myAllreport div").length;
    // x=15;
    // $('#myAllreport div:lt('+x+')').show();
    // $('#loadMore').click(function () {
    //     x= (x+5 <= size_div) ? x+5 : size_div;
    //     $('#myAllreport div:lt('+x+')').show();
    // });
    // $('#showLess').click(function () {
    //     x=(x-5<0) ? 3 : x-5;
    //     $('#myAllreport div').not(':lt('+x+')').hide();
    // });
//});
    </script>
    <script type="text/javascript">
  $(document).ready(function(){
      //report category search
      $(".report-category").on("click",function(e){
          //e.preventDefault();
          var category = [];
          $(".report-category").each(function(){
              if ($(this).is(":checked")) {
                  category.push($(this).val());
              }
          });
          
          category = category; // toString function convert array to string
          //console.log(category);
          //return false;
          if (category.length > 0) {
            $.ajax({
              url : "ajax_get_category_report.php",
              type: "POST",
              cache: false,
              data : {category:category},
              beforeSend: function(){
			$(".pagination").css("display","none")
		},
              success:function(result){
                  if(result){
                		$("#report_category_search_div").html(result);
                  }
                  else
                  {
                    window.location = "/en/reports";               

                  }
              }
            });
          }else{
            window.location = "/en/reports";
          }
      });
      
      //country search
       $(".report-country").on("click",function(e){
         // e.preventDefault();
          var country = [];
          $(".report-country").each(function(){
              if ($(this).is(":checked")) {
                  country.push($(this).val());
              }
          });
          
          country = country; // toString function convert array to string
        //   console.log(country);
        //   return false;
          if (country.length > 0) {
            $.ajax({
              url : "ajax_get_category_report.php",
              type: "POST",
              cache: false,
              data : {country:country},
              beforeSend: function(){
			$(".pagination").css("display","none")
		},
              success:function(result){
                  if(result){
                	 $("#report_category_search_div").html(result);
                  }
                  else
                  {
                    window.location = "/en/reports";
                  }
              }
            });
          }else
          {
            window.location = "/en/reports";
          }
      });
  });
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