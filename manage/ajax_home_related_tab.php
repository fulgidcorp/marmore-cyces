  <?php
//     ini_set('display_errors', 1);
//  ini_set('display_startup_errors', 1);
//  error_reporting(E_ALL);
//   require_once("../config/config.php");
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
$con = mysqli_connect('localhost', 'cycesskf_stagingmarmore', 'marmore@123!', 'cycesskf_marmore');

  //fetch related blogs
  $html = '';
  $fetch_recent_blogs   = "select b.*,bc.* from tbl_blogs b inner join tbl_blogs_category bc on b.`category_id`=bc.id where b.is_active = 1 and b.is_delete = 1 order by b.created_date DESC limit 3";
  $recent_blog_list=mysqli_query($con,$fetch_recent_blogs);
  //$recent_blog_list       = $objTypes->fetchAll($fetch_recent_blogs); 
  //fetch latest news
  //fetch latest resource
  $fecth_latest_resource = "select * from tbl_report_data where is_active=1 and is_delete=1 order by id DESC limit 3";
  $recent_report_list=mysqli_query($con,$fecth_latest_resource);

  //$recent_report_list       = $objTypes->fetchAll($fecth_latest_resource); 

    
    $html .= '<div class="tabout">
      <h2 class="pt-3 pb-3 text-center title">Marmore Resources</h3>
        
    </div>
    <div class="tabs tabs-style-line">
      <nav class="section_s">
        <ul>
          <li></li>
        </ul>
      </nav>
      <div class="content-wrap pt-3">';
        
        //latest news
        $html .='<section id="marmore-line-2">
          <div class="row">';
            if(isset($recent_report_list) && count(array($recent_report_list))>0)
            {
                foreach($recent_report_list as $recent_report)
                {
                     $blog_image = pathinfo($recent_report['report_images']);
                                    
                     if(isset($recent_report['report_images']) && isset($blog_image['dirname']) && $blog_image['dirname']=='.')
                      {
                          $img = base_url.'uploads/report_images/'.$recent_report['report_images'];
                      }
                      else if(isset($recent_report['report_images']) && isset($blog_image['dirname']))
                      {
                          $img = $recent_report['report_images'];
                      }
                      else
                      {
                          $img = base_url.'uploads/blog_images/Group 160532.png';
                      }

           $html .='<div class="col-lg-4">
              <div class="card blog-b" onclick="window.location.href=\''.base_url.'en/reports/'.$recent_report['wp_slug'].'\'">
                <img class="card-img-top resource-img" src="'.$img.'" alt="Card image"
                  height="800px">
                <div class="card-body">
                  <h4 class="card-title p-large text-center text-capitalize">'.$recent_report['report_name'].'</h4>
                  <p class="gray" style="padding:0px;font-size:15px">'.date("F d, Y",strtotime($recent_report['report_date'])).' </p>
                  <a href='.base_url.'en/reports/'.$recent_report['wp_slug'].' class="link link_d">Read More</a>
                </div>
              </div>
            </div>';
                } }
         $html.='</div>
         <div class="text-center icon-btn b1">
      <a class="btn btn-2 btn-icon" href="reports/"><span>View All Resources</span></a>
      </div>
        </section>';
  
  echo $html;
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
