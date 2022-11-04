<?php
// echo '<pre>';
// print_r($all_related_blog_list_details);
// exit;
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
?>
<style>
    nav.navbar.align-items-center {
    position: relative;
}
.breadcrumb1 {
    margin-top: 0px !important;
}
</style>
        <section class="guides" id="" style="padding: 0;">
            <div class="row">
                <div class="col-md-12 blog_i">
                    <?php if(isset($all_blog_list_details) && !empty($all_blog_list_details)) { 
                             $blog_image = pathinfo($all_blog_list_details['blog_img']);
                             if(isset($all_blog_list_details['blog_img']) && isset($blog_image['dirname']) && $blog_image['dirname']=='.')
                              {
                                  $img = base_url.'uploads/blog_images/'.$all_blog_list_details['blog_img'];
                              }
                              else if(isset($all_blog_list_details['blog_img']) && isset($blog_image['dirname']))
                              {
                                  $img = $all_blog_list_details['blog_img'];
                              }
                              else
                              {
                                  $img = base_url.'uploads/blog_images/Group 160532.png';
                              }
                        
                        
                                  //$parse = parse_url($all_blog_list_details['blog_img']);
                                       
                                             
                                            //   if($parse['host'] = 'www.marmoremena.com')
                                            //   {
                                            //       $img = 'uploads/blog_images/GCC-logistics-sector_1200x600.jpg';
                                            //   }
                                            //   else
                                            //   {
                                                 // $img = 'uploads/blog_images/'.$all_blog_list_details['blog_img'];
                                              //}
                    ?>
                    <div class="tabout">
                        <a href="<?php echo base_url.$lang ?>/insights/category/<?php echo str_replace(" ","-",strtolower($all_blog_list_details['category_name'])) ?>" class="btn-link" style="font-size: 22px;"><?php echo isset($all_blog_list_details['category_name'])?$all_blog_list_details['category_name']:''?></a>
                        <h2 class="title" style="margin-top: auto;"><?php echo isset($all_blog_list_details['blog_title'])?$all_blog_list_details['blog_title']:''?></h3>
                            <div class="row">
                                <div class="col-lg-1 col-md-2 col-3">
                                    <?php
                                     if(isset($all_blog_list_details['blog_author_img']))
                                     {
                                         $author_img = base_url.'/uploads/blog_author_images/'.$all_blog_list_details['blog_author_img'];
                                     }
                                     else
                                     {
                                         $author_img = base_url.'image/fqQKrP7.png';
                                     }
                                    ?>
                                    <img src="<?php echo $author_img ?>" alt="" class="author">
                                </div>
                                <div class="col-lg-4 col-md-5 col-7">
                                    <h4 class="a-content">
                                        <?php 
                                         if(isset($all_blog_list_details['blog_author_name']) && !empty($all_blog_list_details['blog_author_name']))
                                         { 
                                              $author_name = $all_blog_list_details['blog_author_name'];
                                          } 
                                          else { 
                                              $author_name = 'Marmore Team';
                                        } ?>
                                        <?php echo $author_name;?>
                                    </h4>
                                    <p class="b-content">
                                        <?php 
                                         if(isset($all_blog_list_details['read_time']) && !empty($all_blog_list_details['read_time']))
                                         { ?>
                                        ~<?php echo isset($all_blog_list_details['read_time'])?$all_blog_list_details['read_time']:'' ?> min read | 
                                       <?php } ?>
                                        <?php echo date("d F Y",strtotime($all_blog_list_details['created_date'])) ?></p>
                                </div>
                            </div>
                    </div>

                    <section class="banner">
                                                <!--<img src="<?php //echo base_url ?>uploads/blog_images/<?php //echo $all_blog_list_details['blog_img'] ?>" alt="" class="banner-img">-->
                        <img src="<?php echo $img ?>" alt="" class="banner-img">
                    </section>
                    <?php } ?>
                    <section class="guides" style="padding: 50px 0;" id="">
                        <div class="row">
                            <?php if(isset($all_blog_list_details) && !empty($all_blog_list_details)) { ?>
                                <div class="col-md-9 blog-body"><?php echo isset($all_blog_list_details['long_desc'])?$all_blog_list_details['long_desc']:'' ?></div>
                            <?php } ?>

                            <div class="col-md-3">
                                <div class="card-body box_shadow">
                                    <h4 class="card-title p-large" style="text-align: left;
                                    padding: 0;">Stay Tuned To Marmore MENA Insights!</h4>
                                    <p class="card-text">Never miss a patch or an update with Marmore's
                                        Newsletter. Subscribe now!</p>
                                        <script charset="utf-8" type="text/javascript" src="//js-eu1.hsforms.net/forms/v2.js"></script>
                                        <script>
                                          hbspt.forms.create({
                                            region: "eu1",
                                            portalId: "26031663",
                                            formId: "f7cee55d-c33d-46e7-a15c-1d6b4561b49d"
                                          });
                                        </script>
                                    <!--<div class="mb-3 mt-3">-->

                                    <!--    <input type="email" class="form-control" id="email" placeholder="Email Address"-->
                                    <!--        name="email" style=" border: 1px solid #C3CCE5; width: 100%;-->
                                    <!--    ">-->
                                    <!--</div>-->
                                    <!--<a href="#" class="link" style=" font-size: 17px;   font-weight: 600;">Subscribe <i class="fa-solid fa-circle-arrow-right"></i>-->

                                    <!--</a>-->
                                </div>
                                <h4 class="font-weight-bold grey-color-text">
                                    <strong>Related Article</strong>
                                </h4>
                                <?php if(isset($all_related_blog_list_details) && !empty($all_related_blog_list_details)) 
                                      { 
                                          foreach($all_related_blog_list_details as $all_related_blog_list_details)
                                            {
                                ?>

                                <div class="card-body r-card" style="padding: 1rem 0;">
                                    <h4 class="card-title p-large" style="text-align: left;
                                padding: 0; font-size: 18px;"><?php echo isset($all_related_blog_list_details['blog_title'])?$all_related_blog_list_details['blog_title']:''?></h4>
                                    <p class="card-text blog-side-p"><?php echo substr($all_related_blog_list_details['short_desc'], 0, 260); ?></p>
                                    <a href="<?php echo base_url ?><?= $lang ?>/insights/<?php echo $all_related_blog_list_details['slug'] ?>" class="btn-link related-article" target="_blank">Read More<i class="fa fa-angle-right left-icon"
                                            aria-hidden="true"></i></a>
                                </div>
                                <h4 class="font-weight-bold grey-color-text" style="margin-top: 0;"></h4>
                                <?php } } else { ?>
                                <p>No related artical found!</p>
                                <?php } ?>
                                <h4 class="font-weight-bold grey-color-text" style=" margin-bottom: 40px;
                                margin-top: 40px;">
                                    <strong>Share via</strong>
                                </h4>

<!--<a href="https://www.facebook.com/sharer/sharer.php?s=100&p[title]=<?php //echo $all_blog_list_details['blog_title'] ?>&p[summary]=<?php //echo $all_blog_list_details['short_desc'] ?>&p[url]=<?php echo $_SERVER[REQUEST_URI] ?>&&p[images][0]=<?php //echo $all_blog_list_details['blog_img'] ?>" target="_blank">-->
<!--    <span style="margin-right: 40px;"><i class="fa-brands fa-facebook"></i></i></span>-->
<!--</a>-->
                               <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo "https://$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]";?>" target="_blank"> <span style="margin-right: 40px;"><i class="fa-brands fa-facebook"></i></i></span></a>

                               <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>" target="_blank"> <span style="margin-right: 40px;"><i class="fa-brands fa-linkedin-in"></i></span></a>
                                <a href="https://twitter.com/intent/tweet?text=<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>" target="_blank"><span style="margin-right: 40px;"><i class="fa-brands fa-twitter"></i></span></a>
                                <a href="https://api.whatsapp.com/send?text=<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>" target="_blank"><span style="margin-right: 40px;"><i class="fa-brands fa-whatsapp"></i></span></a>
                                <h4 class="font-weight-bold grey-color-text" style=" margin-bottom: 40px;
                                margin-top: 40px;">
                                    <strong>Downloads</strong>
                                </h4>
                                        <form action="<?php echo base_url ?>blog_article_pdf" method="post">
                                            <input type="hidden" name="blog_id" value="<?php echo $all_blog_list_details['blog_title'] ?>" />
                                        <button class="btn btn-7 ml-30" type="submit"> 
                                        <img src="<?php echo base_url ?>image/Vector (1).png" alt=""
                                                style="padding-right: 10px;"><span>
                                                Article
                                                (PDF-233KB)</span></button>
                                        </form>
                            </div>



                        </div>

                    </section>
                </div>
            </div>
        </section>
        <section class="guides" id="" style="background-color: #D7EDFF;">
            <div class="tabout">
                <h2 class="pt-3 pb-3 text-center title">Recent Insights</h3>
                    <p class="text-center"></p>
            </div>
                <div class="row">
                <?php if(isset($details) && !empty($details)) 
                      { 
                          foreach($details as $details)
                            {
                                $blog_image = pathinfo($details['blog_img']);
                                    
                             if(isset($details['blog_img']) && isset($blog_image['dirname']) && $blog_image['dirname']=='.')
                              {
                                  $img = base_url.'uploads/blog_images/'.$details['blog_img'];
                              }
                              else if(isset($details['blog_img']) && isset($blog_image['dirname']))
                              {
                                  $img = $details['blog_img'];
                              }
                              else
                              {
                                  $img = base_url.'uploads/blog_images/Group 160532.png';
                              }
                ?>

                <div class="col-lg-4">
                    <div class="card blog-b" onclick="window.open('<?php echo base_url.$lang ?>/insights/<?php echo $details['slug'] ?>','_blank')">
                        <img class="card-img-top" src="<?php echo $img ?>" alt="Card image" style="width:100%">
                        <div class="card-body text-center">
                            <?php
                             if(isset($details['category_name']) && $details['category_name']!='')
                             {
                            ?>
                            <a href="<?php echo base_url.$lang ?>/insights/category/<?php echo $details['category_name'] ?>" class="btn-link"><?php echo isset($details['category_name']) ? $details['category_name']:'' ?></a>
                            <?php
                             }else { ?>
                            <?php }
                            ?>
                            <h4 class="card-title " style="margin-top: 20px; text-align: center;"><?php echo isset($details['blog_title'])?$details['blog_title']:''?></h4>
                            <!--<p class="card-text card_2"><?php // echo isset($details['short_desc']) ? $details['short_desc'] : '' ?></p>-->
                            <a href="" class="hvr-icon-forward btn-link" target="_blank">Read More </a>
                        </div>
                    </div>
                </div>

               <?php }} else { ?>
                  <p>No results found!</p>
               <?php } ?>
            </div>
        </section>

 <?php include("include/footer.php"); ?>

      <script src="<?php echo base_url ?>assets/js/jquery.min.js"></script>
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.40/js/uikit.min.js"></script>-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.40/js/uikit-icons.min.js"></script>-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>-->
    <script>
        $(document).ready(function () {
            $('select').niceSelect();
        });

    </script>
  