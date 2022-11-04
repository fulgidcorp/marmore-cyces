<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include_once('config/config.php');

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['blog']) && $_POST['blog']==1)
{
    include_once('manage/ajax_related_blog.php');
    exit;
}
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['insights']) && $_POST['insights']==1)
{
    include_once('manage/ajax_home_related_tab.php');
    exit;
}
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['service_blog']) && $_POST['service_blog']==1)
{
    include_once('manage/ajax_service_related_blog.php');
    exit;
}
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['keyword']) && $_POST['keyword']!=='')
{
    include_once('ajax_get_autocomplete_report.php');
    exit;
}
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['keyword']) && $_POST['keyword']=='')
{
    include_once('ajax_get_autocomplete_report.php');
    exit;
}
// if($_SERVER['REQUEST_METHOD']=='GET')
// {
//     if((isset($_GET['country']) && $_GET['country']!=''))
//     {
//         include_once('ajax_get_category_report.php');
//         exit;
//     }
    
// }
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['blog_keyword']))
{
    if(($_POST['blog_keyword']!='' || $_POST['blog_keyword']==''))
    {
        include_once('ajax_get_autocomplete_blog.php');
        exit;
    }
}

if($_SERVER['REQUEST_METHOD']=='POST' && empty($_POST['blog_id']) && empty($_POST['client_industry']) && empty($_POST['news']))
{
    if((isset($_POST['category']) && $_POST['category']!='' && isset($_POST['country']) && $_POST['country']!=''))
    {   
        include_once('ajax_get_category_report.php');
        exit;
    }
    if((isset($_POST['category']) && $_POST['category']!='' || $_POST['country']==''))
    {
        include_once('ajax_get_category_report.php');
        exit;
    }
     if((isset($_POST['country']) && $_POST['country']!='' || $_POST['category']==''))
    {
        include_once('ajax_get_category_report.php');
        exit;
    }
    
}
if($_SERVER['REQUEST_METHOD']=='POST' && !empty($_POST['blog_id']))
{
    include_once('blog_article_pdf.php');
    exit;
}
if($_SERVER['REQUEST_METHOD']=='POST' && (!empty($_POST['client_industry']) || $_POST['client_industry']="All") && empty($_POST['news']) && empty($_POST['channel_category']))
{
    include_once('ajax_get_client_industry.php');
    exit;
}
if($_SERVER['REQUEST_METHOD']=='POST' && (!empty($_POST['channel_category']) || $_POST['channel_category']="All") && empty($_POST['news']))
{
    include_once('ajax_get_channel_category.php');
    exit;
}
if($_SERVER['REQUEST_METHOD']=='POST' && !empty($_POST['news']))
{
    include_once('manage/ajax_latest_news.php');
    exit;
}
$chk_path= explode('/', rtrim($_SERVER['REQUEST_URI'],"/"));
if(isset($chk_path[1]) && $chk_path[1]=="index.php"){
    if(isset($chk_path[2]) && strtolower($chk_path[2])=="Arabic"){
        header("location: /ar/".substr($_SERVER['REQUEST_URI'],20));
    }else{
        header("location: /en/".substr($_SERVER['REQUEST_URI'],19));
    }
    exit;
}

#$_GET['path'] = substr($_SERVER['REQUEST_URI'],1);

if(!isset($_GET['path'])){
    header("location: /en/");
     exit;
}else if(substr($_GET['path'],-1)!="/"){
    header("location: /".$_GET['path']."/");
    exit;
}
 $path= explode('/', rtrim($_GET['path'],"/"));
//  echo '<pre>';
//  print_r($path);
//  exit;
$linkpath=substr($_GET['path'],2);
$tmp=[];
foreach($path as $pat){
    $tmp[]=strtolower(mysqli_real_escape_string($con,$pat));
}
$path=$tmp;
if(isset($path[0])){
    $_SESSION['lang']=$path[0];
}else{
    $_SESSION['lang']='en';
}
$lang=$_SESSION['lang'];
$parent=(!isset($path[1]))?'Home':$path[1];
//echo $parent;exit;

function getid($slug,$lang,$con){
    $querynp="SELECT `title`,`id`,`post_id` from `tbl_pages` where language='$lang' and name='".$slug."' and is_published=1";
    $resultnp = mysqli_query($con,$querynp);
    $rownp = mysqli_fetch_array($resultnp);
    return $rownp['post_id'];
}

function getnam($slug,$lang,$con){
    $querynp="SELECT `title`,`id` from `tbl_pages` where language='$lang' and name='".$slug."'";
    $resultnp = mysqli_query($con,$querynp);
    $rownp = mysqli_fetch_array($resultnp);
    return $rownp['title'];
}


$parent_id=getid($parent,$lang,$con);
//echo $parent_id;exit;
if($parent_id==''){
   http_response_code(404);
    include("404.php");
    exit;
}
$prev_id=1;
$prev_row=[];
$bread=[];
//echo $parent;exit;
if($parent=='Home'){
    $queryp="SELECT * from `tbl_pages` where language='$lang' and post_id=1 order by `orderby` asc";
    $resultp = mysqli_query($con,$queryp);
    $prev_row = mysqli_fetch_array($resultp);
    $prev_id= $prev_row['post_id'];
}
// else if($parent=='service'){
//     $queryp="SELECT * from `tbl_pages` where language='$lang' and post_id=3 order by `orderby` asc";
//     $resultp = mysqli_query($con,$queryp);
//     $prev_row = mysqli_fetch_array($resultp);
//     $prev_id= $prev_row['post_id'];
//     $bread['service']=$prev_row['title'];
// }
else if($parent=='insights'){
    $queryp="SELECT * from `tbl_pages` where language='$lang' and post_id=7 order by `orderby` asc";
    $resultp = mysqli_query($con,$queryp);
    $prev_row = mysqli_fetch_array($resultp);
    $prev_id= $prev_row['post_id'];
    $bread['blog']=$prev_row['title'];
}
else if($parent=='reports'){
    $queryp="SELECT * from `tbl_pages` where language='$lang' and post_id=9 order by `orderby` asc";
    $resultp = mysqli_query($con,$queryp);
    $prev_row = mysqli_fetch_array($resultp);
    $prev_id= $prev_row['post_id'];
    $bread['reports']=$prev_row['title'];
}
else if($parent=='clients'){
    $queryp="SELECT * from `tbl_pages` where language='$lang' and post_id=11 order by `orderby` asc";
    $resultp = mysqli_query($con,$queryp);
    $prev_row = mysqli_fetch_array($resultp);
    $prev_id= $prev_row['post_id'];
    $bread['clients']=$prev_row['title'];
}
// else if($parent=='about'){
//     $queryp="SELECT * from `tbl_pages` where language='$lang' and post_id=13 order by `orderby` asc";
//     $resultp = mysqli_query($con,$queryp);
//     $prev_row = mysqli_fetch_array($resultp);
//     $prev_id= $prev_row['post_id'];
//     $bread['about']=$prev_row['title'];
// }
else if($parent=='data-book'){
    $queryp="SELECT * from `tbl_pages` where language='$lang' and post_id=15 order by `orderby` asc";
    $resultp = mysqli_query($con,$queryp);
    $prev_row = mysqli_fetch_array($resultp);
    $prev_id= $prev_row['post_id'];
    $bread['data-book']=$prev_row['title'];
}
else if($parent=='industry'){
    $queryp="SELECT * from `tbl_pages` where language='$lang' and post_id=17 order by `orderby` asc";
    $resultp = mysqli_query($con,$queryp);
    $prev_row = mysqli_fetch_array($resultp);
    $prev_id= $prev_row['post_id'];
    $bread['industry']=$prev_row['title'];
}
else if($parent=='faq'){
    $queryp="SELECT * from `tbl_pages` where language='$lang' and post_id=19 order by `orderby` asc";
    $resultp = mysqli_query($con,$queryp);
    $prev_row = mysqli_fetch_array($resultp);
    $prev_id= $prev_row['post_id'];
    $bread['faq']=$prev_row['title'];
}
else if($parent=='parent-page'){
    $queryp="SELECT * from `tbl_pages` where language='$lang' and post_id=21 order by `orderby` asc";
    $resultp = mysqli_query($con,$queryp);
    $prev_row = mysqli_fetch_array($resultp);
    $prev_id= $prev_row['post_id'];
    $bread['parent']=$prev_row['title'];
}
else if($parent=='news'){
    $queryp="SELECT * from `tbl_pages` where language='$lang' and post_id=23 order by `orderby` asc";
    $resultp = mysqli_query($con,$queryp);
    $prev_row = mysqli_fetch_array($resultp);
    $prev_id= $prev_row['post_id'];
    $bread['parent']=$prev_row['title'];
}
else if($parent=='gcc-crises-series'){
    $queryp="SELECT * from `tbl_pages` where language='$lang' and post_id=40 order by `orderby` asc";
    $resultp = mysqli_query($con,$queryp);
    $prev_row = mysqli_fetch_array($resultp);
    $prev_id= $prev_row['post_id'];
    $bread['parent']=$prev_row['title'];
}
// else if($parent=='marmore-bulletin'){
//     $queryp="SELECT * from `tbl_pages` where language='$lang' and post_id=43 order by `orderby` asc";
//     $resultp = mysqli_query($con,$queryp);
//     $prev_row = mysqli_fetch_array($resultp);
//     $prev_id= $prev_row['post_id'];
//     $bread['parent']=$prev_row['title'];
// }
else if($parent=='webinar'){
    $queryp="SELECT * from `tbl_pages` where language='$lang' and post_id=44 order by `orderby` asc";
    $resultp = mysqli_query($con,$queryp);
    $prev_row = mysqli_fetch_array($resultp);
    $prev_id= $prev_row['post_id'];
    $bread['parent']=$prev_row['title'];
}
else if($parent=='daily-research'){
    $queryp="SELECT * from `tbl_pages` where language='$lang' and post_id=46 order by `orderby` asc";
    $resultp = mysqli_query($con,$queryp);
    $prev_row = mysqli_fetch_array($resultp);
    $prev_id= $prev_row['post_id'];
    $bread['parent']=$prev_row['title'];
}
else if($parent=='cta'){
    $queryp="SELECT * from `tbl_pages` where language='$lang' and post_id=50 order by `orderby` asc";
    $resultp = mysqli_query($con,$queryp);
    $prev_row = mysqli_fetch_array($resultp);
    $prev_id= $prev_row['post_id'];
    $bread['parent']=$prev_row['title'];
}
else if($parent=='contact us'){
    $queryp="SELECT * from `tbl_pages` where language='$lang' and post_id=52 order by `orderby` asc";
    $resultp = mysqli_query($con,$queryp);
    $prev_row = mysqli_fetch_array($resultp);
    $prev_id= $prev_row['post_id'];
    $bread['parent']=$prev_row['title'];
}
// else if($parent=='Privacy Policy'){
//     $queryp="SELECT * from `tbl_pages` where language='$lang' and post_id=54 order by `orderby` asc";
//     $resultp = mysqli_query($con,$queryp);
//     $prev_row = mysqli_fetch_array($resultp);
//     $prev_id= $prev_row['post_id'];
//     $bread['parent']=$prev_row['title'];
// }
else{
   
      for($i=1;$i<count($path);$i++){
        $queryp="SELECT * from `tbl_pages` where language='$lang' and parent_id=$prev_id and name='".$path[$i]."' order by `orderby` asc";
        
        $resultp = mysqli_query($con,$queryp);
    //      echo '<pre>';
    // print_r($resultp);
        if(mysqli_num_rows($resultp)==0){
                http_response_code(404);
                include("404.php");
                exit;
            }
        $prev_row = mysqli_fetch_array($resultp);
        $prev_id= $prev_row['post_id'];
        $bread[$prev_row['name']]=$prev_row['title'];
    }
//   echo '<pre>';
//   print_r($bread);
}

include("include/navbar.php");
function render_app($without_html=false){
    global $prev_row, $con, $bread;
    
    
    ?>
<style>
    nav.navbar.align-items-center {
    position: relative;
}
.breadcrumb1 {
    margin-top: 0px !important;
}
</style>
    <?php
    if($without_html){ 
    ?>
<section class="">
<div class="about-us-outer">
    <div class="container-fuild">
        <div id="main_parent_content">
            <div id="main_page_content" class="row<?= (!empty($prev_row["name"]))? " page-".$prev_row["name"] : "" ?>">
                
            </div>
            <div class="col-md-10 about-content">
                <?php ////include("//include/bread.php"); ?>
            </div>
        </div>
    </div>
</div>
    <?php } else { ?>
    <?php include_once("404.php"); } ?>
 </section>
    <script>

        let saved_elements_data = [
            <?php
            $idjs = $prev_row['id'];
            $resjson = mysqli_query($con,"SELECT * FROM tbl_page_contents where page_id=".$idjs." order by indx ASC");
            $count = 0;
            while($dataa = mysqli_fetch_row($resjson)){
                $json=json_decode($dataa[4],true);
                $json['id']=$dataa[0];
                if($count>1){
                    echo str_replace("image_carousel", "image_carousel_splide", json_encode($json));
                }else{
                    echo json_encode($json);
                }
                echo ",";
                $count++;
            }
            ?>
        ];
    </script>
      <script src="<?php echo base_url ?>assets/js/jquery.min.js"></script>
          <script src="<?php echo base_url ?>assets/js/bootstrap.bundle.min.js"></script>
   
    <script src="<?php echo base_url ?>assets/js/aos.js"></script>
    <script src="<?php echo base_url ?>assets/js/splide.min.js"></script>

      <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>-->
      <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.js"></script>-->
      <!--<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>-->
      <!--<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>-->
    <script src="/assets/js/app_helpers.js"></script>
    <script src="/assets/js/app_main.js"></script>
    <script src="<?php echo base_url ?>assets/js/main.js"></script>

    <script>   
    //   $(document).ready(function () {
    //         $('select').niceSelect();
    //     });

        renderSavedElements($("#main_page_content"), false);
        $(".carousel-item").each(function(index){
            if($(this).find("img[src=\"\"]").length > 0){
                $(this).remove()
            }
        })
        <?php if($without_html){ ?>
        $(`[class="about-content col-md-10"]`).attr("class", "about-content");
        
        
        $('.box:not(:nth-of-type(1))').hover(() => document.querySelector('.box:nth-of-type(1)').style.flexGrow = 1);
        $('.box:not(:nth-of-type(1))').mouseleave(() => document.querySelector('.box:nth-of-type(1)').style.flexGrow = 10);
        $('.box:not(:nth-of-type(1))').hover(() => document.querySelector('.box:nth-of-type(1) .expand-box-content ').style.display = 'none');
        $('.box:not(:nth-of-type(1))').mouseleave(() => document.querySelector('.box:nth-of-type(1) .expand-box-content ').style.display = 'block');
        
        $(function () {
        var screen = $("#animate-image");
        $(window).scroll(function () {
            var scroll = $(window).scrollTop();
    
            if (scroll >= 1300) {
                if(screen.attr("src")=="")
                    screen.attr("src","/assets/images/truck-moving-gif.gif")
            }
                });
        });
        
        <?php } ?>
        $('div[class="col-md-4 press-card history-card"]').each(function(index){
            if($(this).find("img[src=\"\"]").length > 0){
                $(this).remove();
            }
        })
        $(`img[data-tag="image-c"]`).each(
            function(index){
                if($(this).attr("src")=="")
                    $(this).parent().remove();
            }
        );
        $(`img[src=""]`).each(
            function(index){
                if($(this).attr("id")!="animate-image")
                    $(this).remove();
            }
        );
        
        
        $(`button[class="nav-link"]`).each(function(index){
          if($(this).html()==""){
              $(this).remove();
          } 
        });
        
        $('#main_page_content').children().each(function(index){
            $(this).attr("data-aos","fade-up");
        });
        

      AOS.init({
          duration: 1200,
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

     
    
   


        $('.splide').each(function(index){
            new Splide( this, {
            	type   : 'loop',
            	padding: {
            		right: '10rem',
            		left : '10rem',
            	},
            	gap: '2em',
            	updateOnMove: true
            } ).mount();
        });
        </script>
        <script>


    //   $(document).ready(function () {
    //     var infoToast = document.getElementById('infoToast');
    //     infoToast.addEventListener('hidden.bs.toast', function () {
    //       //roll-in-blurred-right
    //       $("#gitBtn").addClass("jello-horizontal");
    //     });
    //     var toast = new bootstrap.Toast(infoToast);
    //     toast.show();
    //   });

    //   $('#vertical-carousel').bind('mousewheel DOMMouseScroll', function (e) {
    //     if (e.originalEvent.wheelDelta > 0 || e.originalEvent.detail < 0) {
    //       $(this).carousel('prev');
    //     }
    //     else {
    //       $(this).carousel('next');
    //     }
    //     e.preventDefault();
    //   });

    //   $("#vertical-carousel").on("touchstart", function (event) {
    //     var yTouchPointStart = event.originalEvent.touches[0].pageY;
    //     $(this).on("touchmove", function (event) {
    //       var yTouchPointEnd = event.originalEvent.touches[0].pageY;
    //       if (Math.floor(yTouchPointStart - yTouchPointEnd) > 1) {
    //         $(".carousel").carousel('next');
    //       }
    //       else if (Math.floor(yTouchPointStart - yTouchPointEnd) < -1) {
    //         $(".carousel").carousel('prev');
    //       }
    //     });
    //     $(".carousel").on("touchend", function () {
    //       $(this).off("touchmove");
    //     });
    //     event.preventDefault();
    //   });
    //   $('.carousel').carousel({
    //     interval: false,
    //   });
    </script>

        <?php if($prev_row['name']=='Home') { ?>
        <script>
        ( function( window ) {

'use strict';

function extend( a, b ) {
for( var key in b ) { 
  if( b.hasOwnProperty( key ) ) {
    a[key] = b[key];
  }
}
return a;
}

function CBPFWTabs( el, options ) {
this.el = el;
this.options = extend( {}, this.options );
  extend( this.options, options );
  this._init();
}

CBPFWTabs.prototype.options = {
start : 0
};

CBPFWTabs.prototype._init = function() {
   
// tabs elems
this.tabs = [].slice.call( this.el.querySelectorAll( 'nav > ul > li' ) );
 //console.log(this.tabs);
// content items
this.items = [].slice.call( this.el.querySelectorAll( '.content-wrap > section' ) );
 //console.log(this.items);

// current index
this.current = -1;
// show current content item
this._show();
// init events
this._initEvents();
};

CBPFWTabs.prototype._initEvents = function() {
var self = this;
this.tabs.forEach( function( tab, idx ) {

  tab.addEventListener( 'click', function( ev ) {
    ev.preventDefault();
          console.log(idx);

    self._show( idx );
  } );
} );
};

CBPFWTabs.prototype._show = function( idx ) {
if( this.current >= 0 ) {
  this.tabs[ this.current ].className = this.items[ this.current ].className = '';
}
// change current
this.current = idx != undefined ? idx : this.options.start >= 0 && this.options.start < this.items.length ? this.options.start : 0;
this.tabs[ this.current ].className = 'tab-current';
this.items[ this.current ].className = 'content-current';
};

// add to global namespace
window.CBPFWTabs = CBPFWTabs;

})( window );

(function() {

    [].slice.call( document.querySelectorAll( '.tabs' ) ).forEach( function( el ) {
      new CBPFWTabs( el );
    });

  })();


(function() {

  [].slice.call( document.querySelectorAll( '.tabs' ) ).forEach( function( el ) {
    new CBPFWTabs( el );
  });

})
();
	
    </script>
    <?php } ?>
    <script>
        /**
         * Function to set the height of carousel images
         * This needs to be called after the DOM is rendered
        */
        function setSplideHeight(){
            $('div[id*="image_carousel_splide"]').each(function(){
                const splide_height =  $(`#${this.id} .splide_wrapper`)[0].offsetHeight
                this.style.height = `${splide_height}px`
            })
        }
        window.onload = setSplideHeight

    </script>
    <!-- <script src="/assets/js/app_custom.js"></script> -->



<?php }

if(count(array($path))!=1){
    include("pages.php");
}else if(isset($path[1]) && $path[1]=='insights'){
    include("blog.php");
}
else if(isset($path[1]) && !isset($path[2]) && $path[1]=='reports'){
    include("report.php");
}
else if(isset($path[1]) && isset($path[2]) && $path[1]=='reports'){
    include("report.php");
}
else if(isset($path[1]) && $path[1]=='clients'){
    include("clients.php");
}
else if(isset($path[1]) && $path[1]=='data-book'){
    include("data-book.php");
}
else if(isset($path[1]) && $path[1]=='faq'){
    include("faq.php");
}
else if(isset($path[1]) && $path[1]=='industry'){
    include("industry.php");
}
else if(isset($path[1]) && $path[1]=='marmore-news'){
    include("news.php");
}
else if(isset($path[1]) && $path[1]=='gcc-crises-series'){
    include("gcc.php");
}
else if(isset($path[1]) && $path[1]=='marmore-bulletin'){
    include("bulletin.php");
}
else if(isset($path[1]) && $path[1]=='webinars'){
    include("webinar.php");
}
else if(isset($path[1]) && $path[1]=='daily-research'){
    include("dailyresearch.php");
}
else if(isset($path[1]) && $path[1]=='enquiry'){
    include("cta.php");
}
else if(isset($path[1]) && $path[1]=='contact-us'){
    include("contact-us.php");
}
else if(isset($path[1]) && $path[1]=='marmore-channel'){
    include("channel.php");
}
else if(isset($path[1]) && $path[1]=='reports' && $path[3]=='country' && $path[2]!=''){
    include("individual-report-country-list.php");
}
else
{
  render_app(true);
} 
include("include/footer.php");  
?>
 </body>
 </html>
