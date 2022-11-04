<?php
//  ini_set('display_errors',1);

include_once('config/config.php');
function noHTML($input, $encoding = 'UTF-8') {
   return htmlentities($input, ENT_QUOTES | ENT_HTML5, $encoding);
}
$limit = 12;  
if (isset($_GET["page"])) {
	$page  = $_GET["page"]; 
	} 
	else{ 
	$page=1;
	}
$start_from = ($page-1) * $limit; 
$channel_category      = "select a.*,b.* from tbl_channel_category a right join tbl_channel b ON a.id=b.category_id where b.is_active=1 and b.is_delete=1 order by b.channel_date DESC LIMIT $start_from, $limit"; 
$channel_category_list       = $objTypes->fetchAll($channel_category); 
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
 
        <section class="guides" id="">
            <div class="row">
                <div class="col-md-6">
                   <div class="tabout">
                        <h2 class="title text-left" style="text-align: left; font-size: 30px;">Marmore in the Channel</h2>
                        <p class="sub-title subtitle pt-3">Our corporate channel that depicts all of the information you need relating to our videos and graphical productions (like executive speeches, report launches, etc.).
                    </div>
                </div>
                <div class="col-md-6">
                    <select class="right wide1" name="client_industry_id" id="client_industry_id">
                         <option value="All">Select Channel Category</option>
                    <?php
                    $ProdArray  = $objTypes->fetchAll("SELECT id,category_name FROM tbl_channel_category where is_active=1 and is_delete=1");
                    if(sizeof($ProdArray) > 0){
                        foreach($ProdArray as $prod_v){
                            if($prod_v['id'] == $client_story_list['category_id']){
                                $selected = 'selected';
                            }
                            else{
                                $selected = '';
                            }
                            ?>
                            <option value="<?php echo $prod_v['id'] ?>" <?=$selected?>><?php echo $prod_v['category_name']; ?></option>
                            <?php
                        }
                    }
                    ?>
                    </select>
                </div>
                <div class="card1" style="padding-top: 40px;" id="report_client_industry_search_div">
                    <div class="row">
                         <?php if(isset($channel_category_list) && !empty($channel_category_list)) 
                               { 
                                   foreach($channel_category_list as $val)
                                    {
                                        $blog_image = pathinfo($val['image']);
                                        if(isset($val['image']) && isset($blog_image['dirname']) && $blog_image['dirname']=='.')
                                          {
                                              $img = base_url.'uploads/channel_image/'.$val['image'];
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
                            <div class="card card_m">
                                <!--<img class="card-img-top" src="<?php// echo $img ?>" alt="Card image"-->
                                <!--    style="width:100%">-->
                                <iframe src="<?php echo $val['video']?>" height="600px"></iframe>  
                                <div class="card-body card_client">
                                    <a class="btn-link"><?php echo $val['category_name']?></a>
                                    <h4 class="card-title card_client" style="margin-top: 5px; font-weight: bold;"><?php echo $val['channel_title']?></h4>
                                    <span><?php echo date("F d, Y",strtotime($val['channel_date'])) ?></span>
                                    <p class="card-text scroller" style="height: 150px !important;overflow-y: scroll;">
                                      <?php echo $val['short_desc']?>
                                    </p>
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
        var channel_category = $("#client_industry_id").val();
        $.ajax({
              url : "<?=base_url?>ajax_get_channel_category.php",
              type: "POST",
              cache: false,
              data : {channel_category:channel_category},
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
if(isset($path[1]) && !isset($_POST['channel_category'])){
?>
<div class="pagination">
<?php  
    $row_db = $objTypes->fetchAll("SELECT * FROM tbl_channel where is_active=1 and is_delete=1"); 
    $row_db = count($row_db);  
    $total_records = $row_db;  
    $total_pages = ceil($total_records / $limit);
?>
 <?php 
  $count = 5;
$startPage = max(1, $page - $count);
$endPage = min( $total_pages, $page + $count);
if($page==1)
{
?>
<a href="?page=<?=($page)?>" class="<?=$page <= 1 ? 'disabled': ''; ?>">&laquo;</a>
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
  <?php } ?>
  <a href="?page=<?=($page+1)?>" class="<?=$page >= $total_pages ? 'disabled': ''; ?>">&raquo;</a>
</div>
<?php } ?>
