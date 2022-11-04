<?php 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// $daily_research = "select * from tbl_daily_research where is_active=1 and is_delete=1 order by date_of_upload ASC limit 3";
// $daily_research       = $objTypes->fetchAll($daily_research); 
$startDate = date('Y-m-01', strtotime('-3 month'));
$endDate = date('Y-m-d H:i:s');

// $endDate = date('Y-m-d', strtotime('last day of last month'));
//echo $startDate;echo '<br />';echo $endDate;exit;
$previous_month_research = "select * from tbl_daily_research where is_active=1 and is_delete=1 and date_of_upload between '$startDate' and '$endDate' order by date_of_upload DESC";
$previous_month_research       = $objTypes->fetchAll($previous_month_research); 

?>
<style>
    nav.navbar.align-items-center {
    position: relative;
}
.breadcrumb1 {
    margin-top: 0px !important;
}
</style>
 <section class="data-slider" id="">
            <div class="tabout previous-daily-research">
             <h2 class="pt-3 pb-3 text-left title">Daily Research Archives</h3>
              <p class="text-left">We publish daily research and updates. Download the latest one below. </p>
            </div>
            <div class="card-section">
                <div class="row">
                    <div class="col-lg-9">
                         <?php if(isset($previous_month_research) && count($previous_month_research) > 0) { 
                      foreach($previous_month_research as $sets_list) {
                          if($sets_list['type_of_upload']==1)
				     {
				         $type='Weekly Wrap';
				     }
				     else if($sets_list['type_of_upload']==2)
				     {
				         $type='Daily Morning Brief';
				     }
				     else
				     {
				         $type='Daily Fixed Income';
				     }
				     $blog_image = pathinfo($sets_list['pdf']);
                                    
                     if(isset($sets_list['pdf']) && isset($blog_image['dirname']) && $blog_image['dirname']=='.')
                      {
                          $img = base_url.'uploads/daily_research_pdf/'.$sets_list['pdf'];
                      }
                      else if(isset($sets_list['pdf']) && isset($blog_image['dirname']))
                      {
                          $img = $sets_list['pdf'];
                      }
                      else
                      {
                          $img = base_url.'uploads/daily_research_pdf/Group 160532.png';
                      }
                    ?>
                    <a href="<?php echo $img ?>" target="_blank" class="dailyresearchname"><?php echo $type ?>(<?php echo date("Y-m-d",strtotime($sets_list['date_of_upload'])) ?>)</a>
                    
                    <?php } } ?>
                    </div>

                </div>

            </div>
            </div>
</section>
    