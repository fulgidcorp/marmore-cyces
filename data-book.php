<?php
// echo '<pre>';
// print_r($path);
// exit;
include_once('config/config.php');
function noHTML($input, $encoding = 'UTF-8') {
   return htmlentities($input, ENT_QUOTES | ENT_HTML5, $encoding);
}
//fetch all databook
$fetch_all_databook_list = "SELECT a.*,b.* FROM tbl_data_book a INNER JOIN tbl_country b ON a.country_id = b.id and a.is_active=1 and a.is_delete=1";
$databook_list       = $objTypes->fetchAll($fetch_all_databook_list); 


if(isset($path[2]))
{
    //databook details
     $title = $path[2];
    $report_list_details    = "SELECT a.*,b.* FROM tbl_country a INNER JOIN tbl_data_book b ON a.id = b.country_id where b.is_active = 1 and b.is_delete = 1 and b.slug='$title'";
    $all_report_list_details       = $objTypes->fetchRow($report_list_details); 
    //databook images set
    $related_images = "select * from tbl_databook_images where data_book_id=".$all_report_list_details['id'];
    $related_images       = $objTypes->fetchAll($related_images); 
    //databook data sets
    $data_sets = "select * from tbl_db_datasets where is_active=1 and is_delete=1";
    $data_sets_list       = $objTypes->fetchAll($data_sets); 
    //related data book list
    $databook_list_details   = "SELECT a.*,b.* FROM tbl_country a INNER JOIN tbl_data_book b ON a.id = b.country_id where b.is_active = 1 and b.is_delete = 1 and b.id NOT IN (".$all_report_list_details['id'].") order by b.created_date DESC limit 4";
    $all_related_databook_list_details       = $objTypes->fetchAll($databook_list_details);
   
    require("individual-databook.php");
    exit;
}
?>
        <section class="banner">
            <img src="/assets/image/Rectangles-3934.png" alt="" class="banner-img b1">
            <div class="input-group mb-3 search search1">
                <h3 class="data-tittle text-center">GCC Data Book</h3>
                <p class="data-sub text-center"></p>
            </div>
        </section>

        <section class="report-detailed" id="">
            <div class="container">
                <div class="row">
                    <?php if(isset($databook_list) && count($databook_list)>0) { 
                      foreach($databook_list as $databook_list) {
                    ?>
                    <div class="col-lg-4 data-b">
                            <div class="card card-d" onclick="window.location.href='<?php echo base_url.$lang ?>/data-book/<?php echo $databook_list['slug'] ?>'">
                            <img class="card-img" src="/uploads/databook_images/<?php echo $databook_list['image']?>" alt="Card image">
                            <div class="card-body ">
                                <a href="<?php echo base_url.$lang ?>/data-book/<?php echo $databook_list['slug'] ?>"><h4 class="card-title text-center"><?php echo $databook_list['country_name']?></h4></a>
                                <p class="card-text text-center"><?php echo $databook_list['short_desc'] ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php } } ?>
                </div>
            </div>
            <div class="container data-b">
                <div class="row">
                    <div class="col-lg-3 card-b">
                        <div class="img-d text-center">
                            <img class="text-center" src="<?php echo base_url ?>/assets/image/Customize.png" alt="Card image">
                        </div>
                        <div class="card">

                            <div class="card-body">
                                <h4 class="card-title1 text-center">Customize</h4>
                                <p class="card-text text-center">Customize data as per your needs, upon request</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 card-b">
                        <div class="img-d text-center">
                            <img class="text-center" src="<?php echo base_url ?>/assets/image/Coverage.png" alt="Card image">
                        </div>
                        <div class="card">

                            <div class="card-body">
                                <h4 class="card-title1 text-center">Coverage</h4>
                                <p class="card-text text-center">Comprehensive coverage of key information in single place
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 card-b">
                        <div class="img-d text-center">
                            <img class="text-center" src="<?php echo base_url ?>/assets/image/comparison.png" alt="Card image">
                        </div>
                        <div class="card">

                            <div class="card-body">
                                <h4 class="card-title1 text-center">Comparison</h4>
                                <p class="card-text text-center">Enables country-wise comparison</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="img-d text-center">
                            <img class="text-center" src="<?php echo base_url ?>/assets/image/Long term data.png" alt="Card image">
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title1 text-center">Long term data</h4>
                                <p class="card-text text-center">Data provided for long time series

(5, 10 & 20 years)
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    <script src="<?php echo base_url ?>assets/js/bootstrap.bundle.min.js"></script>
