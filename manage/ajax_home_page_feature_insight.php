<?php
//ini_set('display_errors', 1);
//  ini_set('display_startup_errors', 1);
//  error_reporting(E_ALL);
include_once("/config/config.php");
#===== PROTOCOL.
if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')
{
  $protocol = 'https://';
}
else
{
   $protocol = 'http://';
}
define('base_url' , $protocol.$_SERVER['SERVER_NAME'].preg_replace('@/+$@','',dirname($_SERVER['SCRIPT_NAME'])).'/');
//$con = mysqli_connect('localhost', 'cycesskf_stagingmarmore', 'marmore@123!', 'cycesskf_marmore_staging');
$html = '';
  //fetch related blogs
$query="SELECT blog1,report1,report2 from tbl_home_page_left_feature_insight order by id desc limit 1";
$select=mysqli_query($con,$query);

while($row=mysqli_fetch_assoc($select))
{
$blog1=$row['blog1'];
$report1=$row['report1'];
$report2=$row['report2'];
$left_feature_query="SELECT * from tbl_blogs where id in ('$blog1')  ORDER BY ( CASE id WHEN '$blog1' THEN 1 ELSE 0 END)";
$fetch_recent_blog=mysqli_query($con,$left_feature_query);

$left_feature_report_query="SELECT * from tbl_report_data where id in ('$report1','$report2')  ORDER BY ( CASE id WHEN '$report1' THEN 1 WHEN '$report2' THEN 2 ELSE 0 END)";
$fetch_recent_report=mysqli_query($con,$left_feature_report_query);

}
  // $recent_report_list=mysqli_query($con,$fecth_latest_resource);

  //$recent_report_list       = $objTypes->fetchAll($fecth_latest_resource); 

           if(isset($fetch_recent_blog) && !empty($fetch_recent_blog) && count($fetch_recent_blog)) 
                { 
                 
                foreach($fetch_recent_blog as $bloglist)
                {
                  //$i=1;
                 // echo $bloglist['blog_title'];
                
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


     
           $html.='<div class="card top-card text-left">
           <div class="card-body text-left"><h3 class="card-title font-weight-bold">'.$bloglist['blog_title'].'</h3>
           <p">'.date("F d, Y",strtotime($bloglist['created_date'])).' </p>
           <p class="card-text">'.$bloglist['short_desc'].'</p>
           <a href="insights/'.$bloglist['slug'].'" class="card-link">Read More<i class="fa fa-long-arrow-right {i} pl-02" aria-hidden="true"></i></a></div>
       </div>';
      
                } 
                
              }
              if(isset($fetch_recent_report) && !empty($fetch_recent_report) && count($fetch_recent_report)) 
              { 
               
              foreach($fetch_recent_report as $report_list)
              {
                $report_image = pathinfo($report_list['report_images']);
               
   
         $html.='<div class="card top-card text-left">
         <div class="card-body text-left"><h3 class="card-title font-weight-bold">'.$report_list['report_name'].'</h3>
         <p">'.date("F d, Y",strtotime($report_list['created_date'])).' </p>
         <p class="card-text">'.$report_list['report_seo_description'].'</p>
         <a href="reports/'.$report_list['wp_slug'].'" class="card-link">Read More<i class="fa fa-long-arrow-right {i} pl-02" aria-hidden="true"></i></a></div>
     </div>';
    
              } 
              
            }
            
         $html.=' <div class="btnn"><a class="btn btn-theme" href=reports/><span>Explore More</span></a></div>
         </div>';
        // $i++;
  
  echo $html;
 // $i++;
  ?>
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
