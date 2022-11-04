<style>
    nav.navbar.align-items-center {
    position: relative;
}
.breadcrumb1 {
    margin-top: 0px !important;
}

        .card-body.box_shadow {
        background: #FFFFFF;
        box-shadow: 0px 0px 22px rgb(20 36 92 / 24%);
        border-radius: 0px;
        border-bottom: 4px solid #00AEEF;
        padding: 20px;
    }

    .tabs-style-line nav li.tab-current a {
        box-shadow: inset 0 -3px #00aeef;
        background-color: #00538B;
        padding: 20px 10px;
    }

    .tablinks {
        padding: 50px 120px;
        text-align: center;
    }

    .counter {
        background-color: #EAF5FE;
        padding: 70px;
    }

    .col-lg-6.experts {
        padding: 0 50px;
    }

    h1.values {
        /* text-align: center; */
        font-size: xxx-large;
        font-weight: bold;
        padding-left: 10px;
        padding-right: 20px;
    }

    nav.tab-list {
        background-color: #D6E6F2;

    }

    .tabs-style-line nav ul {
        padding: 0 9rem;
        margin: 0 100px;
    }



    .tabs {

        width: 100%;

    }

    h1.value1 {
        font-size: 20px;
        font-weight: bold;
    }

    .counter1 {
        background-color: #00538B;
        padding: 50px 150px;
    }

    .p-large {

        padding: 0;

        padding: 30px;

    }

    .blog-b .card-text {
        padding: 0;
    }



    .card-title {
        font-weight: bold;
        font-size: 24px;
    }

    .tabout {
        padding-bottom: 20px;
    }

    .card-body.sheet:hover {
        background-color: #00538B;
        color: white !important;
    }



    p.cta {
        margin-right: 80px;
    }

    .grey-bg {

        margin-bottom: 20px;
    }

    .counter {

        padding: 30px 90px;
    }

    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    h4.card-title {
        color: #021B33 !important;
        text-align: center;
    }

    h4.font-weight-bold.grey-color-text {
        font-size: 21px;
    }
    .recent-blogs .card:hover {
            box-shadow: 0 0 11px rgb(33 33 33 / 20%);
        }

        .recent-blogs  .card {
            transition: all 330ms ease;
        }
</style>

<body>
 <?php
 $blog_image = pathinfo($client_story_list_details['image']);
 if(isset($client_story_list_details['image']) && isset($blog_image['dirname']) && $blog_image['dirname']=='.')
  {
      $img = base_url.'uploads/client_images/'.$client_story_list_details['image'];
  }
  else if(isset($client_story_list_details['image']) && isset($blog_image['dirname']))
  {
      $img = $client_story_list_details['image'];
  }
  else
  {
      $img = base_url.'uploads/blog_images/Group 160532.png';
  }
   
 ?>
        <section class="guides" id="">
            <div class="row" style="">
                <div class="col-md-12 client-list">
                    <div class="tabout">
                        <h2 class="title" style="margin-top: auto; text-align: center;"><?php echo isset($client_story_list_details)?$client_story_list_details['story_title']:''?>
                        </h2>

                    </div>
                    <section class="banner">
                        <img src="<?php echo $img ?>" alt="" class="banner-img">
                    </section>
                    <section class="guides" style="padding: 50px 0;" id="">
                        <div class="row">
                            <div class="col-md-8 col-lg-9">
                                <div class="list-word" style="padding-bottom: 30px;">
                                    <h3 class="title">Scope of Work</h3>
                                   <p><?php echo $client_story_list_details['long_desc']?></p>
                                    <h3 class="title">Solution</h3>
                                   <p><?php echo $client_story_list_details['long_desc_2']?></p>
                                    <h3 class="title">Impact</h3>
                                   <p><?php echo $client_story_list_details['long_desc_3']?></p>
                                </div>
                            </div>

                             
                            <div class="col-md-4 col-lg-3">
                                <div class="card-body box_shadow">
                                    <h4 class="card-title p-large" style="text-align: left; padding: 0;">Let's Connect!</h4>
                                    <p class="card-text">Book a free, personalized onboarding call with one of our intelligence experts.</p>
                                   
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#freeConsulting" class="link" style=" font-size: 16px; font-weight: 501;">Schedule Free Consultation<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>

                                    </a>
                                </div>

                            </div>


                        </div>


                    </section>

                </div>
            </div>
        </section>
        <div class="card1 success-story">
            <h3 class="title" style="margin-top: auto; text-align: left; font-weight: bold;font-size:30px;">More Such Success Stories
                with
                Marmore
            </h3>
            <div class="row recent-blogs">
                <?php if(isset($all_explore_products_list_details) && !empty($all_explore_products_list_details)) 
                               { 
                                   foreach($all_explore_products_list_details as $val)
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
                    <div class="card blog-b" onclick="window.location.href='<?php echo base_url.$lang ?>/clients/<?php echo $val['slug'] ?>'">
                        <img class="card-img-top" src="<?php echo $img ?>" alt="Card image" style="width:100%">
                        <div class="card-body card_client">
                            <a href="<?php echo base_url ?>/<?= $lang ?>/clients/<?php echo $val['slug'] ?>" class="btn-link"><?php echo $val['client_category']?></a>
                            <h4 class="card-title text-left client_card" style="margin-top: 5px; font-weight: bold;"><?php echo $val['story_title']?></h4>
                            <p class="card-text" style="padding: 0px;"><?php echo $val['story_desc']?>
                            </p>
                            <a href="<?php echo base_url.$lang ?>/clients/<?php echo $val['slug'] ?>" class="hvr-icon-forward btn-link">Read More </a>
                        </div>
                    </div>
                </div>
                <?php } } ?>
            </div>
        </div>
    </main>

<?php include("include/footer.php"); ?>
<script src="<?php echo base_url ?>assets/js/jquery.min.js"></script>
          <script src="<?php echo base_url ?>assets/js/bootstrap.bundle.min.js"></script>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.40/js/uikit.min.js"></script>-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.40/js/uikit-icons.min.js"></script>-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.js"></script>-->
    <script src="<?php echo base_url ?>assets/js/main.js"></script>

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
</body>