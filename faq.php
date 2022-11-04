<?php 
//fetch faq list
$faq_list = "select * from tbl_faq where is_active=1 and is_delete=1 order by id DESC";
$faq_list       = $objTypes->fetchAll($faq_list); 

?>
<div class="container-fuild ">
        <div class="content content1 pb-50">
            <div class="row vertical-align">
                <div class="col-lg-6">
                    <div class=" pb-50">
                        <div class="major-content">
                            <h2 class="title pt-4">FAQ</h2>
                            <p class="sub-title subtitle pt-3">Whether you have a question about features, trails,
                                pricing, need a demo, or anything else, our team is ready to answer all your questions.
                            </p>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 ">
                    <div class="text-right">
                        <img src="/assets/image/Group 160498 (1).png" alt="world" class="banner-img1" width="600">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="content-us">
            <h2 class="text-center title faq pt-4">Frequently Asked Questions</h2>
            <div class="accordion" id="accordionExample">
                <?php if(isset($faq_list) && count($faq_list)>0) {
                foreach($faq_list as $key=>$faq_list) {
                ?>
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="heading<?=$key?>">
                      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?=$key?>" aria-expanded="true" aria-controls="collapse<?=$key?>">
                        <?php echo $faq_list['question'] ?>
                      </button>
                    </h2>
                    <div id="collapse<?=$key?>" class="accordion-collapse collapse" aria-labelledby="heading<?=$key?>" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                        <?php echo $faq_list['answer'] ?>
                      </div>
                    </div>
                  </div>
                  <?php }  } ?>
            </div>
        </div>
    </div>
      <script src="<?php echo base_url ?>assets/js/jquery.min.js"></script>
          <script src="<?php echo base_url ?>assets/js/bootstrap.bundle.min.js"></script>

   