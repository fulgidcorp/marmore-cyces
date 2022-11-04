    <style>
        nav.navbar.align-items-center {
            position: relative;
        }

        .breadcrumb1 {
            margin-top: 0px !important;
        }
    </style>
        <section class="banner">
            <img src="<?php echo base_url ?>image/blog-banner.png" alt="" class="banner-img b1">
            <div class="input-group mb-3 search">
            <h1 style="text-align:center;color:white;">Explore Latest GCC Insights</h1>
            <div class="Blog-Search">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-search" aria-hidden="true"></i></span>
                <input type="text" class="form-control blogsearch" placeholder="Search Article...." aria-label="Username" aria-describedby="basic-addon1">
                <div id="suggesstion-box"></div>
                </div>
            </div>
            <!-- <input class="form-control " name="search" placeholder="Search Article...." /> -->
        </section>

        <section class="guides" id="">
            <div class="row">
                <div class="col-lg-3 col-md-4 side-filter">
                    <div class="tabout">
                        <h2 class="title b_title">Filters</h3>
                        <p class=""></p>
                    </div>
                    <!--Category start-->
                    <div class="col-lg-12 grey-bg">
                        <h4 class="font-weight-bold grey-color-text"><strong>Categories</strong></h4>
                        <div class=" blog-card">
                                <?php if(isset($blog_category_list) && count($blog_category_list) > 0 && !empty($blog_category_list)) 
                                { 
                                    foreach($blog_category_list as $category_list)
                                    {
                                ?>
                                       <div class="form-group">
                                       <label for="Categories1" style="padding-bottom: 5px;"><a href="<?php echo base_url.$lang ?>/insights/category/<?php echo str_replace(" ","-",strtolower($category_list['category_name'])); ?>"><?php echo $category_list['category_name']?></a></label>
                                        </div>

                                <?php } } ?>
                        </div>
                    </div>
                    <br />
                    <div class="col-lg-12 grey-bg">
                        <h4 class="font-weight-bold grey-color-text"><strong>Blogs Date</strong></h4>
                        <div class=" blog-card">
                                <?php if(isset($all_blog_date_list) && count($all_blog_date_list) > 0 && !empty($all_blog_date_list)) 
                                { 
                                    foreach($all_blog_date_list as $date_list)
                                    {
                                ?>
                                       <div class="form-group">
                                            <label for="Categories" style="padding-bottom: 5px;"><a href="<?php echo base_url ?><?= $lang ?>/insights/categorydate/<?php echo date("Y",strtotime($date_list['created_date'])) ?>"><span><?php echo date("Y",strtotime($date_list['created_date'])) ?></span></a></label>
                                        </div>

                                <?php } } ?>
                        </div>
                    </div>
                    <!--category end-->
                </div>
                <div class="col-lg-9 col-md-8" id="report_blog_search_div">

                    <div class="tabout">
                        <?php $name = str_replace("-"," ",$path[3]); ?>

                        <h2 class="title b_title"><?php echo isset($name)?ucwords($name):''?></h3>
                            <p class=""></p>
                    </div>
                    <!--Blog Starts-->
                    <div class="row blogs" style="padding-bottom: 25px;">
                        <?php if(isset($all_blog_list) && !empty($all_blog_list) && count($all_blog_list)) 
                              { 
                                  foreach($all_blog_list as $bloglist)
                                    {
                                        $blog_image = pathinfo($bloglist['blog_img']);
                                    
                                             if(isset($bloglist['blog_img']) && isset($blog_image['dirname']) && $blog_image['dirname']=='.')
                                              {
                                                  $img = base_url.'uploads/blog_images/'.$bloglist['blog_img'];
                                              }
                                              else if(isset($bloglist['blog_img']) && isset($blog_image['dirname']))
                                              {
                                                  $img = $bloglist['blog_img'];
                                              }
                                              else
                                              {
                                                  $img = base_url.'uploads/blog_images/Group 160532.png';
                                              }
                                              if(!empty($bloglist['short_desc']) && $bloglist['short_desc']!=NULL) 
                                                { 
                                                    $desc = $bloglist['short_desc'];
                                                } 
                                                else if(isset($bloglist['long_desc']) && empty($bloglist['short_desc']))
                                                {
                                                    $desc = strip_tags(substr($bloglist['long_desc'],0,250));
                                                }
                                                else 
                                                {
                                                    $desc = strip_tags(substr($bloglist['long_desc'],0,250));
                                                } 
                        ?>
                        <div class="col-lg-4 blog_1">
                            <div class="card blog-b border" onclick="window.location.href='<?php echo base_url.$lang ?>/insights/<?php echo $bloglist['slug'] ?>'">
                                <!--<img class="card-img-top" src="<?php //echo base_url ?>uploads/blog_images/<?php //echo $bloglist['blog_img']?>" alt="Card image" style="width:100%">-->
                                <img class="card-img-top" src="<?php echo $img ?>" alt="Card image" style="width:100%">
                                <div class="card-body ">
                                    <a href="<?php echo base_url.$lang ?>/insights/category/<?php echo str_replace(" ","-",strtolower($bloglist['category_name'])) ?>" class="btn-link"><?php echo isset($bloglist['category_name']) ? $bloglist['category_name']:'' ?></a>
                                    <h4 class="card-title card_2" style="margin-top: 20px;"><?php echo isset($bloglist['blog_title']) ? $bloglist['blog_title'] : '' ?></h4>
                                    <span><?php echo date("F d, Y",strtotime($bloglist['created_date'])) ?></span>
                                     <?php //if(isset($bloglist['short_desc']) && !empty($bloglist['short_desc'])) { 
                                    //     $desc = $bloglist['short_desc'];
                                    //  } else {
                                    //      $desc = strip_tags(substr($bloglist['long_desc'],0,150));
                                     //} ?>
                                    <p class="card-text card_2"><?php echo $desc ?></p>                                    
                                    <a href="<?php echo base_url.$lang ?>/insights/<?php echo $bloglist['slug'] ?>" class="hvr-icon-forward btn-link">Read More </a>
                                </div>
                            </div>
                        </div>
                        <?php } } ?>
                    </div>
                    <!--Blog Ends-->
                    <!--<div class="link1" style="text-align: center;"><a href="#" class=" btn1-link"> -->
                    <!--<i class="fa fa-down-to-line" aria-hidden="true"></i> View more</a>-->
                    <!--</div>-->
                </div>


            </div>
        </section>
          <div class="pagination">
<?php  
    // $row_db = $objTypes->fetchAll("SELECT * FROM tbl_blogs where is_active=1 and is_delete=1"); 
    // $row_db = count($row_db);  
    $total_records = $row_db;  
    $total_pages = ceil($total_records / $limit);
    //echo $total_pages;exit;
?>
    
<?php 
$count = 5;
$startPage = max(1, $page - $count);
$endPage = min( $total_pages, $page + $count);
if($page==1)
{
?>
<a href="?page=1" class="<?=$page <= 1 ? 'disabled': ''; ?>">&laquo;</a>
<?php
} else {
?>
<a href="?page=<?=($page-1)?>" class="<?=$page <= 1 ? 'disabled': ''; ?>">&laquo;</a>
<?php } ?>
 
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
  <?php  } 
  if($page==1){
  ?>
    <a href="?page=<?=($page)?>" class="<?=$page >= $total_pages ? 'disabled': ''; ?>">&raquo;</a>
  <?php } else {  if($page < $total_pages){
?>
  <a href="?page=<?=($page+1)?>" class="<?=$page >= $total_pages ? 'disabled': ''; ?>">&raquo;</a>
  <?php } } ?>
</div>

     <?php include("include/footer.php"); ?>

      <script src="<?php echo base_url ?>assets/js/jquery.min.js"></script>
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.40/js/uikit.min.js"></script>-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.40/js/uikit-icons.min.js"></script>-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>-->
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
<script type="text/javascript">
$(document).ready(function(){
	$(".blogsearch").keyup(function(){
	    var blogsearch = $(this).val();
	    if(blogsearch.length > 0){
		$.ajax({
		type: "POST",
		url: "ajax_get_autocomplete_blog.php",
		data:'blog_keyword='+$(this).val(),
		beforeSend: function(){
			$(".blogsearch").css("background","#FFF no-repeat 165px");
			$(".pagination").css("display","none")
		},
		success: function(data){
		    if(data)
		    {
    			$("#suggesstion-box").show();
    			//$("#suggesstion-box").html(data);
    			$(".blogsearch").css("background","#FFF");
    			$("#report_blog_search_div").html(data);
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
</script>
