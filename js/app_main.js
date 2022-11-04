"use strict";

// ------------------------------------------------------- Global level config

/**
 * The initial state for the entire application. This is used as a constant
 * for replacing the states when required.
 */
var INITIAL_STATE = {
  add_element_config: {
    code: null,
    values: {},
    temp: {},
    others: {},
    css_config: {},
    id: null
  }
};
/**
 * This contains the common element configurations like the alignment,
 * font, size etc. This is used in the `getAllElementsConfig()` for making things dry.
 */

var COMMON_ELEMENT_CONFIG = {
  alignment: {
    left_align: "text-left",
    center_align: "text-center",
    right_align: "text-right"
  },
  column: {
      col_9: "col-9",
      col_10: "col-10",
      col_12: "col-12",
  },
};
/**
 * The static element/component configuration for the entire application.
 * This is not directly used anywhere. Used as a wrapper constant.
 */
 
 
function get_code_for_multiple(html, iterations,start_with=1){
    let return_string = ''
    for(let i = start_with ; i <= iterations; i++){
        return_string += html.replaceAll("{i}", i );
    }
    
    return return_string;
}


function get_values_for_multiple(values, iterations){
    let return_array = [];
    
    for(let i =1 ; i <= iterations; i++){
        for (let j in values){
            return_array.push( values[j].replace("{i}", i));
        }
    }
    
    return return_array;
}

var STATIC_ELEMENT_CONFIG = {
    home_first_section: {
    html:`<div class="content p-120">
    <div class="row">
      <div class="col-lg-6">
        <div class="box-align">
          <div class="logo-content">
          <strong style="color:#00538B; font-size:19px !important;  margin-top:0px !important;display:block;">Marmore
                MENA Intelligence</strong>
          </div>
          <div class="major-content">
            <h2 class="title pt-4" style="font-weight:bold;padding-right:14%">{left_title}</h2>
            <p class="sub-title pt-3">{content}</p>
            <div class="btn-box">
              <a class="btn move-section" href="{link_1}"><span>{button_text_1}</span></a>
              <a class="btn ml-30 border-btn" href="{link_2}"><span>{button_text_2}</span></a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 ">
        <div class="text-right world-img"> <img src="/marmore{image_src_2}" alt="world"> </div>
        <div class="col-md-6 text-light hero__q">
            <div class="hero__quote">
              <div id="vertical-carousel" class="carousel slide " data-bs-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item  active">
                    <div class="carousel-caption caption ">
                      <p class=""><span class="blue-n">{slider_percentage_1}</span> <br><span class="blue_n">{slider_title_1}</span>
                      </p>
                      <h3><strong class="text-light">{slider_heading_1}</strong></h3>
                      <p class="pr-03">{slider_content_1}</p>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <div class="carousel-caption caption ">
                      <p class=""><span class="blue-n">{slider_percentage_2}</span> <br><span class="blue_n">{slider_title_2}</span>
                      </p>
                      <h3><strong class="text-light">{slider_heading_2}</strong></h3>
                      <p class="pr-03">{slider_content_2}</p>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <div class="carousel-caption caption ">
                      <p class=""><span class="blue-n">{slider_percentage_3}</span> <br><span class="blue_n">{slider_title_3}</span>
                      </p>
                      <h3><strong class="text-light">{slider_heading_3}</strong></h3>
                      <p class="pr-03">{slider_content_3}</p>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
     <div class="col-md-6 text-dark hero__q2">
            <div class="hero__quote2">
              <div id="vertical-carousel" class="carousel slide " data-bs-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item  active">
                    <div class="carousel-caption caption">
                      <span class="quote"><i class="fa fa-quote-left" aria-hidden="true"></i> </span>
                      <p class="text-center mb-00">{slider_quote_content_1}</p>
                    </div>
                  </div>
                  <div class="carousel-item  ">
                    <div class="carousel-caption caption ">
                      <span class="quote"><i class="fa fa-quote-left" aria-hidden="true"></i> </span>
                      <p class="text-center mb-00">{slider_quote_content_2}</p>
                    </div>
                  </div>
                  <div class="carousel-item  ">
                    <div class="carousel-caption caption ">
                      <span class="quote"><i class="fa fa-quote-left" aria-hidden="true"></i> </span>
                      <p class="text-center mb-00">{slider_quote_content_3}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>`,
    values: ["image_src_1", "left_title","content","button_text_1","link_1","button_text_2","link_2","image_src_2","slider_percentage_1","slider_title_1","slider_heading_1","slider_content_1","slider_percentage_2","slider_title_2","slider_heading_2","slider_content_2","slider_percentage_3","slider_title_3","slider_heading_3","slider_content_3","slider_quote_content_1","slider_quote_content_2","slider_quote_content_3"],
    css_config: {}
    },
    home_second_section_left: {
    html:`<section class="guides" id="">
    <div class="row">
    <div class="col-lg-5">
      <div class="card top-card text-left">
          ${get_code_for_multiple(`<div class="card-body text-left"><h3 class="card-title font-weight-bold">{title_{i}}</h3>
          <p class="card-text">{caption_{i}}</p>
          <a href="{button_link_{i}}" class="card-link">{button_text_{i}}<i class="fa fa-long-arrow-right {i} pl-02" aria-hidden="true"></i></a></div>`,3,1)}
      </div>
      <div class="btnn"><a class="btn btn-theme" href=report/><span>Explore More</span></a></div>
    </div>
    <div class="col-lg-7 grey-bg" id="related_blog_div">
    ${
        $.ajax({
          url : "ajax_related_blog.php",
          type: "POST",
          datatype:"html",
          data:{blog:1},
          success:function(result){
              //console.log(result);
              $("#related_blog_div").html(result);
          }
        })
    }
    </div></div></section>`,
    values: get_values_for_multiple(["title_{i}", "caption_{i}", "button_text_{i}", "button_link_{i}"],10),
    css_config: {}
    },
    home_tab_section_2:{
        html:`<section class="guides" id="home_insights_div">
        ${
        $.ajax({
          url : "ajax_home_related_tab.php",
          type: "POST",
          datatype:"html",
          data:{insights:1},
          success:function(result){
              //console.log(result);
              $("#home_insights_div").html(result);
          }
        })
    }</section>`,
      
    },
   
     home_second_section_right: {
    html:`
        <div class="col-lg-7 grey-bg" style="float: right !important;margin-top: -836px !important;">
            <h2 class="font-weight-bold pt-5"><strong>Recent Blog</strong></h2>
        <p class="para1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra non arcu nam....</p>
            <div class="uk-margin"></div>
            <div class="uk-section">
        <div class="owl-carousel owl-theme blog">
          <div class="item">
            <div class="card blog-card">
              <div class="row no-gutters align-items-center">
                <div class="col-sm-5">
                  <img class="card-img" src="/marmore{image_src_1}" style="width: 250px;" alt="alt-img">
                </div>
                <div class="col-sm-7 align-items-center">
                  <div class="card-body">
                    <h2 class="card-title">{title_1}</h2>
                    <p class="card-text">{content_1}</p>
                    <a href="{button_link_1}" class=" btn-link">{button_text_1}<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                  </div>
                </div>
              </div>
            </div>
              ${get_code_for_multiple(`<div class="card blog-card">
              <div class="row no-gutters align-items-center">
                <div class="col-sm-5">
                  <img class="card-img" src="/marmore{image_src_{i}}" style="width: 250px;" alt="alt-img">
                </div>
                <div class="col-sm-7 align-items-center">
                  <div class="card-body">
                    <h2 class="card-title">{title_{i}}</h2>
                    <p class="card-text">{content_{i}}</p>
                    <a href="{button_link_{i}}" class=" btn-link">{button_text_{i}}<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                  </div>
                </div>
              </div>
            </div>`,2,2)}
          </div>
        </div>
    </div>
    </div>
</section>`,
    values: get_values_for_multiple(["image_src_{i}", "title_{i}","content_{i}", "button_text_{i}", "button_link_{i}"],10),
    css_config: {}
    },
    home_third_section:{
        html:`  <section class="guides" id="">
            <div class="container-fuild"><div class="row mena pt-5">
        ${get_code_for_multiple(`<div class="col-lg-6">
      <div class="card" >
           <div class="row no-gutters align-items-center b1">
            <div class="col-sm-5">
              <img class="card-img" src="/marmore{image_src_{i}}" alt="alt-img">
            </div>
            <div class="col-sm-7 align-items-center">
              <div class="card-body">
                <h3 class="card-title"><strong>{heading_{i}}</strong></h3>
                <h6 class="card-sub">{sub_heading_{i}}</h6>
                <p class="card-text">{content_{i}}</p>
                <a href="{button_link_{i}}" class=" btn-link">{button_text_{i}}<i class="fa fa-angle-right left-icon" aria-hidden="true"></i></a>
              </div>
             </div> 
            </div>
        </div> 
    </div>
            `,2)}
    </div></div></section>`,
    values: get_values_for_multiple(["image_src_{i}", "heading_{i}", "sub_heading_{i}", "content_{i}", "button_text_{i}","button_link_{i}"],10),
    css_config: {}
    },
    multiple_image_with_title:{
        html:`<section class="logo-section" id="" >
              <h3 class="contain text-center logo-title pb-5">Trusted by the Largest GCC Entreprises including</h3>
        <div class="row">
        ${get_code_for_multiple(`<div class="col-lg-2 logo-section-mob">
            <img src="/marmore{image_src_{i}}" alt="">
        </div>`,6)}
        </div></section>`,
         values: get_values_for_multiple(["image_src_{i}"],10),
    css_config: {}
    },
    home_section_five:{
        html:`<section class="guides md-50" id="">
    <div class="row align-items-center">
        <div class="col-lg-6">
            <img src="/marmore{image_src_1}" alt="">
        </div>
        <div class="col-lg-6">
          <div class="p-content">
            <span class="red-label"><label>150+ {heading_1}</label></span>
            <h2 class="font-weight-bold">{sub_heading_1}</h2>
            <p>{content}</p>
            <div class="row">
                <div class="col-lg-4">
                    <img src="/marmore{image_src_2}" alt="" style="height:60px">
                </div>
                <div class="col-lg-4">
                  <img src="/marmore{image_src_3}" alt="" style="height:60px">
                 </div> 
                <div class="col-lg-4">
                  <img src="/marmore{image_src_4}" alt="" style="height:60px">
                </div> 
            </div>
            </div>
        </div>
    </div>
</section>
`,
         values: ["image_src_1","heading_1","sub_heading_1","content","image_src_2","image_src_3","image_src_4"],
    css_config: {}
    },
    home_tab_1:{
        html:`<div class="tabs tabs-style-line">
    <nav>
      <ul>
      <li class="tab-current"><a href="#section-line-1"><span>{heading_1}</span></a></li>
      ${get_code_for_multiple(`<li class=""><a href="#section-line-{i}"><span>{heading_{i}}</span></a></li>`,2,2)}
      </ul>
    </nav>
    <div class="content-wrap mt-4">
    <section id="section-line-1" class="content-current">
    <div class="row">
          <div class="col-lg-6">
            <img src="/marmore{image_src_1}" alt="">
          </div>
          <div class="col-lg-6">
            <div class="tablinks">
              <h2>{heading_1}</h2>
              <p>{content_1}</p>
              <a href="{button_link_1}" class="theme-color">{button_text_1}<i class="fa fa-long-arrow-right theme-color"
                  aria-hidden="true"></i></a>
            </div>
          </div>
      
      </div>
      </section>
    ${get_code_for_multiple(`
    <section id="section-line-{i}" class="">
    <div class="row">
          <div class="col-lg-6">
            <img src="/marmore{image_src_{i}}" alt="">
          </div>
          <div class="col-lg-6">
            <div class="tablinks">
              <h2>{heading_{i}}</h2>
              <p>{content_{i}}</p>
              <a href="{button_link_{i}}" class="theme-color">{button_text_{i}}<i class="fa fa-long-arrow-right theme-color"
                  aria-hidden="true"></i></a>
            </div>
          </div>
      
      </div>
      </section>
    `,2,2)}<!-- /content -->
    </div>
  </div><!-- /tabs -->
`,
        values: get_values_for_multiple(["heading_{i}","image_src_{i}","heading_{i}","content_{i}","button_text_{i}","button_link_{i}"],5),
    css_config: {}
    },
     home_tab_2:{
        html:`  <div class="tabs tabs-style-line mt-5">
    <nav>
      <ul>
        <li class="tab-current"><a href="#section-line-1"><span>Insights</span></a></li>
      </ul>
    </nav>
    <div class="content-wrap pt-3">
      <section id="section-line-1" class="content-current">
        <div class="row">
          <div class="col-lg-4">
            <div class="card blog-b" style="width:400px">
              <img class="card-img-top" src="/marmore{image_src_1}" alt="Card image" style="width:100%">
              <div class="card-body ">
                <h4 class="card-title p-large">{heading_2}</h4>
                <p class="card-text">{content_1}</p>
                <a href="{button_link_1}" class="link">{button_text_1}</a>
              </div>
          </div>
        </div>
        <div class="col-lg-4">
            <div class="card blog-b" style="width:400px">
              <img class="card-img-top" src="/marmore{image_src_2}" alt="Card image" style="width:100%">
              <div class="card-body ">
                <h4 class="card-title p-large">{heading_3}</h4>
                <p class="card-text">{content_1}</p>
                <a href="{button_link_2}" class="link">{button_text_2}</a>
              </div>
          </div>
        </div>
        <div class="col-lg-4">
            <div class="card blog-b" style="width:400px">
              <img class="card-img-top" src="/marmore{image_src_3}" alt="Card image" style="width:100%">
              <div class="card-body ">
                <h4 class="card-title p-large">{heading_4}</h4>
                <p class="card-text">{content_3}</p>
                <a href="{button_link_3}" class="link">{button_text_3}</a>
              </div>
          </div>
        </div>
    </div>
      </section>
      ${get_code_for_multiple(`<section id="section-line-1" class="content-current">
        <div class="row">
          <div class="col-lg-4">
            <div class="card blog-b" style="width:400px">
              <img class="card-img-top" src="/marmore{image_src_{i}}" alt="Card image" style="width:100%">
              <div class="card-body ">
                <h4 class="card-title p-large">{heading_{i}}</h4>
                <p class="card-text">{content_{i}}</p>
                <a href="{button_link_{i}}" class="link">{button_text_{i}}</a>
              </div>
          </div>
        </div
        <div class="col-lg-4">
            <div class="card blog-b" style="width:400px">
              <img class="card-img-top" src="/marmore{image_src_{i}}" alt="Card image" style="width:100%">
              <div class="card-body ">
                <h4 class="card-title p-large">{heading_{i}}</h4>
                <p class="card-text">{content_{i}}</p>
                <a href="{button_link_{i}}" class="link">{button_text_{i}}</a>
              </div>
          </div>
        </div>
        <div class="col-lg-4">
            <div class="card blog-b" style="width:400px">
              <img class="card-img-top" src="/marmore{image_src_{i}}" alt="Card image" style="width:100%">
              <div class="card-body ">
                <h4 class="card-title p-large">{heading_{i}}</h4>
                <p class="card-text">{content_{i}}</p>
                <a href="{button_link_{i}}" class="link">{button_text_{i}}</a>
              </div>
          </div>
        </div>
    </div>
      </section>`,3,2)}<!-- /content -->
    </div><!-- /content -->
  </div><!-- /tabs -->
`,
        values: get_values_for_multiple(["heading_{i}","image_src_{i}","heading_{i}","content_{i}","button_text_{i}","button_link_{i}","image_src_{i}","heading_{i}","content_{i}","button_text_{i}","button_link_{i}","image_src_{i}","heading_{i}","content_{i}","button_text_{i}","button_link_{i}"],5),
    css_config: {}
    },
  home_carousel: {
    html:
    `    <!-- Carousel -->
    <section class="guides md-50" id="" style="background-color: #EAF5FE;">
   <div id="demo" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#demo" data-bs-slide-to="1" class="active"></button>
      ${get_code_for_multiple(`<button type="button" data-bs-target="#demo" data-bs-slide-to="{i}" class=""></button>
`,6,2)}
      </div>
    <!-- Indicators/dots -->
  
    <!-- The slideshow/carousel -->
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="carousel-caption caption">
                    <img src="/marmore/assets/image/“.png">
            <p class="slide">{caption_1}</p>
            <h3 class="slider">- {name_1}</h3>
        </div>
      </div>
      ${get_code_for_multiple(`<div class="carousel-item">
        <div class="carousel-caption caption">
                    <img src="/marmore/assets/image/“.png">
            <p class="slide">{caption_{i}}</p>
            <h3 class="slider">- {name_{i}}</h3>
        </div>
            </div>`,6,2)}
      </div>
    <!-- Left and right controls/icons -->
    <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
  </div></section>`,
    values: get_values_for_multiple(["caption_{i}", "name_{i}"],6),
    css_config: {}
  },
  home_daily_research_card:{
      html:` <section class="guides" id="">
        <div class="tabout">
            <div class="row pd-10">
          <div class="col-lg-3">
            <div class="icon-boxes-h1">
              <div class="icon text-left">
        <a href="#"><img src="/marmore/assets/image/pdf1.png"  onerror="this.style.display='none'" height="50" width="40" onclick='window.open("/marmore{image_src_{1}}","","width=600,height=600,scrollbars=Yes,resizable=yes")' /></a>

              </div>
              <p class="home-sub text-left">{caption_1}</p>
              <h3 class="text-left icon-home1">{heading_1}</h3>
            </div>
          </div>
          ${get_code_for_multiple(`
    <div class="col-lg-3">
            <div class="icon-boxes-h1">
              <div class="icon text-left">
    <a href="#"><img src="/marmore/assets/image/pdf1.png"  onerror="this.style.display='none'" height="50" width="40" onclick='window.open("/marmore{image_src_{i}}","","width=600,height=600,scrollbars=Yes,resizable=yes")' /></a>
              </div>
              <p class="home-sub text-left">{caption_{i}}</p>
              <h3 class="text-left icon-home1">{heading_{i}}</h3>
            </div>
          </div>
    `,3,2)}
          <div class="col-lg-3">
            <div class="icon-boxes-btn">
              <p class="home-sub text-center">16 June 2022</p>
              <h3 class="text-center icon-home1">Daily Research</h3>
              <div class="text-center pt-10"><a class="btn btn-2 Schedule" href="#"><span>View Archive</span></a></div>
            </div>

          </div>
                    <div class="row pd-10">
            <div class="col-lg-6">
              <p class="box-contend">We look forward to answering your questions and helping you find a solution.</p>
            </div>
            <div class="col-lg-6">
              <div class="row">
                <div class="col-lg-7 align">
                  <input type="email" class="form-control" id="email" placeholder="Email Address" name="email">
                </div>
                <div class="col-lg-4">
                  <a class="btn btn-2 Schedule-h" href="#"><span>Subscribe</span></a>
                </div>
              </div>
            </div>
          </div>

          </div></div></section>`,
       values: get_values_for_multiple(["image_src_{i}","caption_{i}","heading_{i}"],3),
    css_config: {}
  },
  about_first_section:{
      html:`<div class="container-fuild ">
        <div class="content content1 pb-50">
            <div class="row vertical-align">
                <div class="col-lg-6">
                    <div class=" pb-50">
                        <div class="major-content">
                            <h2 class="title pt-4">{heading_1}</h2>
                            <p class="sub-title subtitle pt-3">{content_1}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 ">
                    <div class="text-right">
                        <img src="/marmore{image_src_1}" alt="world" class="banner-img1" width="600">
                    </div>
                </div>
            </div>
        </div>
    </div>
`,
      values: ["heading_1","content_1","image_src_1"],
    css_config: {}
  },
  content_only:{
      html:`<div class="container">
        <div class="content-us">
            <p class="text-center">{content_1}</p>
        </div>
    </div>`,
      values: ["content_1"],
    css_config: {}
  },
  area_of_expertise_content:{
      html:`<section class="about-icon1 pt-50">
        <div class="container-fuild">
            <div class="title-content">
                <h2 class="icon-tittle">{heading_1}</h2>
                <p class="icon-text">{content_1}</p>
            </div>`,
             values: ["heading_1","content_1"],
    css_config: {}
  },
  area_of_expertise:{
      html:`<section class="about-icon pt-50 pb-50">
        <div class="container-fuild">
            <div class="row">
                <div class="col-lg-3">
                    <div class="icon-boxes">
                        <div class="icon text-left"><img src="/marmore{image_src_1}" alt=""></div>
                        <h3 class="text-left i-content"><a href="{link_1}">{heading_1}</a></h3>
                    </div>
                </div>
            
            ${get_code_for_multiple(`
                <div class="col-lg-3">
                    <div class="icon-boxes">
                        <div class="icon text-left"><img src="/marmore{image_src_{i}}" alt=""></div>
                        <h3 class="text-left i-content"><a href="{link_{i}}">{heading_{i}}</a></h3>
                    </div>
                </div>
            `,8,2)}
            </div>
            <div class="text-center icon-btn">
                <a class="btn btn-2 btn-icon" href="/marmore/uploads/corporateprofile/Marmore Advisors_V6.pdf" target="_blank"><span>Download Corporate Profile</span></a>
            </div>
        </div>
    </section>`,
    values: get_values_for_multiple(["heading_{i}","image_src_{i}","link_{i}"],12),
    css_config: {}
      
  },
    area_of_expertise_parent_page:{
      html:`<section class="about-icon pt-50 pb-50">
        <div class="container-fuild">
            <div class="row">
                <div class="col-lg-3">
                    <div class="icon-boxes">
                        <div class="icon text-left"><img src="/marmore{image_src_1}" alt=""></div>
                        <h3 class="text-left i-content"><a href="{link_1}">{heading_1}</a></h3>
                        <p>{content_1}</p>

                    </div>
                </div>
            
            ${get_code_for_multiple(`
                <div class="col-lg-3">
                    <div class="icon-boxes">
                        <div class="icon text-left"><img src="/marmore{image_src_{i}}" alt=""></div>
                        <h3 class="text-left i-content"><a href="{link_{i}}">{heading_{i}}</a></h3>
                                                                        <p>{content_{i}}</p>

                    </div>
                </div>
            `,4,2)}
            </div>
        </div>
    </section>`,
    values: get_values_for_multiple(["heading_{i}","image_src_{i}","link_{i}","content_{i}"],4),
    css_config: {}
      
  },
    area_of_expertise_parent_page_3:{
      html:`<section class="about-icon pt-50 pb-50">
        <div class="container-fuild">
            <div class="row">
                <div class="col-lg-3">
                    <div class="icon-boxes">
                        <div class="icon text-left"><img src="/marmore{image_src_1}" alt=""></div>
                        <h3 class="text-left i-content"><a href="{link_1}">{heading_1}</a></h3>
                        <p>{content_1}</p>
                    </div>
                </div>
            
            ${get_code_for_multiple(`
                <div class="col-lg-3">
                    <div class="icon-boxes">
                        <div class="icon text-left"><img src="/marmore{image_src_{i}}" alt=""></div>
                        <h3 class="text-left i-content"><a href="{link_{i}}">{heading_{i}}</a></h3>
                        <p>{content_{i}}</p>
                    </div>
                </div>
            `,3,2)}
            </div>
        </div>
    </section>`,
    values: get_values_for_multiple(["heading_{i}","image_src_{i}","link_{i}","content_{i}"],3),
    css_config: {}
      
  },
    area_of_expertise_parent_page_1:{
      html:`<section class="about-icon pt-50 pb-50">
        <div class="container-fuild">
            <div class="row">
                <div class="col-lg-3">
                    <div class="icon-boxes">
                        <div class="icon text-left"><img src="/marmore{image_src_1}" alt=""></div>
                        <h3 class="text-left i-content"><a href="{link_1}">{heading_1}</a></h3>
                        <p>{content_1}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>`,
    values: ["heading_1","image_src_1","link_1","content_1"],
    css_config: {}
      
  },

  about_us_card_section:{
      html:`<div class="card-section">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card card-a">
                        <img class="card-img" src="/marmore{image_src_1}" alt="">
                        <div class="card-body ">
                            <h4 class="card-title text-left">{heading_1}</h4>
                            <p class="card-text text-left">{content_1}</p>
                            <a href="{button_link_1}">{button_text_1}</a>
                        </div>
                    </div>
                </div>
            
            ${get_code_for_multiple(`
                <div class="col-lg-4">
                    <div class="card card-a">
                        <img class="card-img" src="/marmore{image_src_{i}}" alt="">
                        <div class="card-body ">
                            <h4 class="card-title text-left">{heading_{i}}</h4>
                            <p class="card-text text-left">{content_{i}}</p>
                            <a href="{button_link_{i}}">{button_text_{i}}</a>
                        </div>
                    </div>
                </div>
            `,6,2)}
            </div>
        </div>`,
    values: get_values_for_multiple(["heading_{i}","image_src_{i}","content_{i}","button_text_{i}","button_link_{i}"],6),
    css_config: {}
  },
  about_us_report_card_section:{
      html:`<div class="card-section">
            <div class="row">
                <div class="col-lg-3">
                    <div class="icon-boxes-a">
                        <div class="icon text-center"><img src="/marmore{image_src_1}" alt=""></div>
                        <h3 class="text-center icon-content">{heading_1}</h3>
                    </div>
                </div>
                ${get_code_for_multiple(`<div class="col-lg-3">
                    <div class="icon-boxes-a">
                        <div class="icon text-center"><img src="/marmore{image_src_{i}}" alt=""></div>
                        <h3 class="text-center icon-content">{heading_{i}}</h3>
                    </div>
                </div>`,4,2)}
            </div>
            <div class="text-center icon-btn b1">
                <a class="btn btn-2 btn-icon" href="https://stagingmarmore.cyces.co/marmore/en/report/"><span>Disover Our Resources</span></a>
            </div>
        </div>`,
    values: get_values_for_multiple(["heading_{i}","image_src_{i}","button_link_{i}"],4),
    css_config: {}
  },
  parent_page_report_card_section:{
      html:`<div class="card-section">
            <div class="row">
                <div class="col-lg-3">
                    <div class="icon-boxes-a">
                        <div class="icon text-center"><img src="/marmore{image_src_1}" alt=""></div>
                        <h3 class="text-center icon-content">{heading_1}</h3>
                    </div>
                </div>
                ${get_code_for_multiple(`<div class="col-lg-3">
                    <div class="icon-boxes-a">
                        <div class="icon text-center"><img src="/marmore{image_src_{i}}" alt=""></div>
                        <h3 class="text-center icon-content">{heading_{i}}</h3>

                    </div>
                </div>`,4,2)}
            </div>
            <div class="text-center icon-btn b1">
                <a class="btn btn-2 btn-icon" href="https://www.markaz.com/" target="_blank"><span>Know more about Markaz</span></a>
            </div>
        </div>`,
    values: get_values_for_multiple(["heading_{i}","image_src_{i}"],4),
    css_config: {}
  },
  career_page_third_section:{
      html:` <section class="career-blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card card-a">
                        <img class="card-img" src="/marmore{image_src_1}" alt="Card image">
                        <div class="card-body ">
                            <h4 class="card-title text-left">{heading_1}</h4>
                            <p class="card-text text-left">{caption_1}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-a">
                        <img class="card-img" src="/marmore{image_src_2}" alt="Card image">
                        <div class="card-body ">
                            <h4 class="card-title text-left">{heading_2}</h4>
                            <p class="card-text text-left">{caption_2}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
`,
values: ["image_src_1","heading_1","caption_1","image_src_2","heading_2","caption_2"],
    css_config: {}
  },
  customized_research:{
      html:`<section class="" id="">
            <div class="card-section">
                <div class="row data-booki">
                    <div class="col-lg-3">
                        <div class="icon-boxes i-data">
                            <div class="icon text-left"><img src="/marmore{image_src_1}" alt=""></div>
                            <p>{content_1}</p>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="icon-boxes i-data">
                            <div class="icon text-left"><img src="/marmore{image_src_2}" alt=""></div>
                            <p>{content_2}</p>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="icon-boxes i-data">
                            <div class="icon text-left"><img src="/marmore{image_src_3}" alt=""></div>
                            <p>{content_3}</p>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="icon-boxes i-data">
                            <div class="icon text-left"><img src="/marmore{image_src_4}" alt=""></div>
                            <p>{content_4}</p>
                        </div>
                    </div>

                </div>
                <div class="text-center icon-btn b1">
                <a class="btn btn-2 btn-icon" href="/marmore/uploads/corporateprofile/Marmore Advisors_V6.pdf" target="_blank"><span>Download Corporate Profile</span></a>
            </div>
            </div>
        </section>
`,
values: ["image_src_1","heading_1","content_1","image_src_1","heading_2","content_2","image_src_2","heading_2","content_3","image_src_3","heading_3","content_3","image_src_4","heading_4","content_4"],
    css_config: {}
  },
  our_team:{
      html:`<section class="direct-box pt-50" id="">
        <div class="card-section">
            <div class="title-content">
                <h2 class="icon-tittle">Our Leadership</h2>
                <p class="icon-text">Meet the senior management team that drives performance at Marmore.</p>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="direct-boxes">
                        <div class="direct text-center"><img src="/marmore{image_src_1}" alt=""></div>
                        <h3 class="text-center direct-content">{heading_1}</h3>
                        <p class="direct-text text-center">{caption_1}</p>
                        <a href="{button_link_1}" target="_blank" class="center-icon"><i class="fa-brands fa-linkedin"></i></a>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="direct-boxes">
                        <div class="direct text-center"><img src="/marmore{image_src_2}" alt=""></div>
                        <h3 class="text-center direct-content">{heading_2}</h3>
                        <p class="direct-text text-center">{caption_2}</p>
                        <a href="{button_link_2}" target="_blank" class="center-icon"><i class="fa-brands fa-linkedin"></i></a>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="direct-boxes">
                        <div class="direct text-center"><img src="/marmore{image_src_3}" alt=""></div>
                        <h3 class="text-center direct-content">{heading_3}</h3>
                        <p class="direct-text text-center">{caption_3}</p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="direct-boxes">
                        <div class="direct text-center"><img src="/marmore{image_src_4}" alt=""></div>
                        <h3 class="text-center direct-content">{heading_4}</h3>
                        <p class="direct-text text-center">{caption_4}</p>
                        <a href="{button_link_4}" target="_blank" class="center-icon"><i class="fa-brands fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
`,
      values: ["heading_1","image_src_1","button_link_1","caption_1","heading_2","image_src_2","button_link_2","caption_2","heading_3","image_src_3","button_link_3","caption_3","heading_4","image_src_4","button_link_4","caption_4"],
    css_config: {}
  },
  
  board_of_directors:{
      html:`<section class="direct-box pb-50 board-of-directors" id="">
        <div class="card-section">
            <div class="title-content">
                <h2 class="icon-tittle">Board of Directors of Marmore</h2>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="direct-boxes">
                        <div class="direct text-center"><img src="/marmore{image_src_1}" alt=""></div>
                        <h3 class="text-center direct-content">{heading_1}</h3>
                        <p class="direct-text text-center">{caption_1}</p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="direct-boxes">
                        <div class="direct text-center"><img src="/marmore{image_src_2}" alt=""></div>
                        <h3 class="text-center direct-content">{heading_2}</h3>
                        <p class="direct-text text-center">{caption_2}</p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="direct-boxes">
                        <div class="direct text-center"><img src="/marmore{image_src_3}" alt=""></div>
                        <h3 class="text-center direct-content">{heading_3}</h3>
                        <p class="direct-text text-center">{caption_3}</p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="direct-boxes">
                        <div class="direct text-center"><img src="/marmore{image_src_4}" alt=""></div>
                        <h3 class="text-center direct-content">{heading_4}</h3>
                        <p class="direct-text text-center">{caption_4}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
`,
      values: ["heading_1","image_src_1","caption_1","heading_2","image_src_2","caption_2","heading_3","image_src_3","caption_3","heading_4","image_src_4","caption_4"],
    css_config: {}
  },
  service_banner: {
      html:`<div class="container-fuild service-banner">
        <div class="content content1"><div class="row pb-5">
                <div class="col-lg-6">
                    <div>

                        <div class="major-content">
                            <h2 class="title pt-4">{heading_1}
                            </h2>
                            <p class="sub-title subtitle pt-3">{content_1}</p>
                            <a class="btn btn-theme" href="/marmore/en/cta"><span>Talk to us</span></a>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 ">
                    <div class="text-right world-img">
                        <img src="/marmore{image_src_1}" alt="world" width="600">
                    </div>

                </div>

            </div></div></div>
`,
      values: ["heading_1","content_1","image_src_1"],
    css_config: {}
  },
  
  service_our_process: {
      html:`<div class="card-section" id="section-line-2">
           <h1 class="pt-3 pb-2 text-center bold  title">Our Process</h1>
            <div class="row">
                <div class="col-lg-4">
                    <div class="icon-boxes-a">
                        <div class="icon text-center"><img src="/marmore{image_src_1}" alt=""></div>
                        <h3 class="text-center icon-content">{heading_1}</h3>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="icon-boxes-a">
                        <div class="icon text-center"><img src="/marmore{image_src_2}" alt=""></div>
                        <h3 class="text-center icon-content">{heading_2}</h3>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="icon-boxes-a">
                        <div class="icon text-center"><img src="/marmore{image_src_3}" alt=""></div>
                        <h3 class="text-center icon-content">{heading_3}</h3>
                    </div>
                </div>
            </div>
            </div>
            <h2 class="pt-3 pb-2 text-center title">{main_heading}</h2>
      <p class="icon-text" style="text-align:center;">{sub_heading}</p>
      <div class="container"><div class="row boxss">
    <div class="col-lg-4 col-md-4" style="align-items: center;">
        <div class="color-boxes">
    <h4 class="box-contect">{requirement_1}</h4> 
    </div>
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="color-box">
    <h4 class="box-contect">{requirement_2}</h4> 
    </div>
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="color-boxes">
    <h4 class="box-contect">{requirement_3}</h4> 
    </div>
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="color-box">
    <h4 class="box-contect">{requirement_4}</h4> 
    </div>
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="color-boxes">
    <h4 class="box-contect">{requirement_5}</h4> 
    </div>
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="color-box">
    <h4 class="box-contect">{requirement_6}</h4> 
    </div>
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="color-boxes">
    <h4 class="box-contect">{requirement_7}</h4> 
    </div>
    </div>
    </div></div>
`,
      values: ["heading_1","image_src_1","heading_2","image_src_2","heading_3","image_src_3","main_heading","sub_heading","requirement_1","requirement_2","requirement_3","requirement_4","requirement_5","requirement_6","requirement_7"],
    css_config: {}
  },
  customized_research_banner: {
      html:`<div class="container-fuild service-banner">
        <div class="content content1"><div class="row pb-5">
                <div class="col-lg-6">
                    <div>

                        <div class="major-content">
                            <h2 class="title pt-4">{heading_1}
                            </h2>
                            <p class="sub-title subtitle pt-3">{content_1}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 ">
                    <div class="text-right world-img">
                        <img src="/marmore{image_src_1}" alt="world" width="600">
                    </div>

                </div>

            </div></div></div>
`,
      values: ["heading_1","content_1","image_src_1"],
    css_config: {}
  },
  tab_with_text_only:{
      html:`<section class="guides1" id=""><div class="tabs tabs-style-line tab1">
            <nav class="tab-list tabl1">
                <ul>
                    <li class="tab-current"><a class="tab-section" href="#section-line-1"><span>{heading_1}</span></a></li>
                    <li class=""><a class="tab-section" href="#section-line-3"><span>{heading_3}</span></a></li>
                    <li class=""><a class="tab-section" href="#section-line-4"><span>{heading_4}</span></a></li>
                    <li class=""><a class="tab-section" href="#section-line-2"><span>{heading_2}</span></a></li>

                   <!--  ${get_code_for_multiple(`<li class=""><a class="" href="#section-line-{i}"><span>{heading_{i}}</span></a></li>`,3,2)} -->
                </ul>
            </nav>
            <div class="content-wrap mt-4">
                <section id="section-line-1" class="content-current">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="tablinks tablink1">
                                <p>{content_1}</p>
                            </div>
                        </div>
                    </div>
                </section>
            </div><!-- /content -->
        </section><!-- /tabs -->
`,
        values: ["heading_1","heading_2","heading_3","heading_4","content_1"],
    css_config: {}
  },
  service_related_blog:{
      html:`<div class="container">
<section class="industry-blog" id="related-blog">${
        $.ajax({
          url : "ajax_service_related_blog.php",
          type: "POST",
          datatype:"html",
          data:{service_blog:1},
          success:function(result){
              //console.log(result);
              $("#related-blog").html(result);
          }
        })
    }</section></div>`,
      values: [],
    css_config: {}
  },
  multi_image_with_multi_title:{
      html:`        <div class="directors">
            <div class="row our-team-service">
                <div class="col-lg-4">
                    <img src="/marmore{image_src_1}" alt="">
                    <h1 class="value1 text">{heading_1}</h1>
                    <p>{position_1}</p>
                </div>
                ${get_code_for_multiple(`<div class="col-lg-4">
                    <img src="/marmore{image_src_{i}}" alt="">
                    <h1 class="value1 text">{heading_{i}}</h1>
                    <p>{position_{i}}</p>
                </div> `,5,2)}
                
            </div>
        </div>
    </section>
`,
       values: get_values_for_multiple(["image_src_{i}","heading_{i}","position_{i}"],5),
    css_config: {}
  },
  banner_with_content:{
      html:`<section class="banner">
            <img src="/marmore{image_src_1}" alt="" class="banner-img b1">
            <div class="input-group mb-3 search search1">
                <h3 class="data-tittle {css_classes}">{heading_1}</h3>
                <p class="data-sub {css_classes}">{sub_heading_1}</p>
            </div>
        </section>`,
      values: ["image_src_1","heading_1", "sub_heading_1"],
    css_config: {
      left_align: "text-left",
      center_align: "text-center",
      right_align: "text-right",
      font_md: "font_md",
      font_lg: "font_lg",
      font_bold: "bold"
    }
  },
  data_book_card:{
      html:`<section class="report-detailed" id="">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 data-b">
                        <div class="card card-d ">
                            <img class="card-img" src="/marmore{image_src_1}" alt="{heading_1}">
                            <div class="card-body ">
                                <h4 class="card-title {css_classes}">{heading_1}</h4>
                                <p class="card-text {css_classes}">{sub_heading_1}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 data-b">
                        <div class="card card-d ">
                            <img class="card-img" src="/marmore{image_src_2}" alt="{heading_2}">
                            <div class="card-body ">
                                <h4 class="card-title {css_classes}">{heading_2}</h4>
                                <p class="card-text {css_classes}">{sub_heading_2}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 data-b">
                        <div class="card card-d ">
                            <img class="card-img" src="/marmore{image_src_3}" alt="{heading_3}">
                            <div class="card-body ">
                                <h4 class="card-title {css_classes}">{heading_3}</h4>
                                <p class="card-text {css_classes}">{sub_heading_3}</p>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            </section>`,
    values: ["image_src_1","heading_1","sub_heading_1","image_src_2","heading_2","sub_heading_2","image_src_3","heading_3","sub_heading_3"],
    css_config: {
      left_align: "text-left",
      center_align: "text-center",
      right_align: "text-right",
      font_md: "font_md",
      font_lg: "font_lg",
      font_bold: "bold",
    }
  },
  faq:{
      html:`<div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        {question_1}
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">
      {answer_1}
      </div>
    </div>
  ${get_code_for_multiple(`<div class="accordion-item">
    <h2 class="accordion-header" id="headingTwo{i}">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo{i}" aria-expanded="false" aria-controls="collapseTwo{i}">
        {question_{i}}
      </button>
    </h2>
    <div id="collapseTwo{i}" class="accordion-collapse collapse" aria-labelledby="headingTwo{i}" data-bs-parent="#accordionExample">
      <div class="accordion-body">
      {answer_{i}}
      </div>
    </div>
  </div>
</div>`,6,2)}
     </div> `,
            values: get_values_for_multiple(["question_{i}","answer_{i}"],20),
    css_config: {
      
    }
  },
  related_insights_3:{
      html:`<section class="industry-blog" id="section-line-4">
            <div class="container">
                <div class="row blogs service-related-blog">
                    <div class="col-lg-4 blog_1" onclick="window.location.href='{btn_link_1}'">
                        <div class="card blog-b border">
                            <img class="card-img-top" src="/marmore{image_src_1}" alt="Card image">
                            <div class="card-body ">
                                <a href="{category_link_1}" class="btn-link">{category_name_1}</a>
                                <h4 class="card-title card_2">{blog_name_1}</h4>
                                <p class="card-text card_2">{caption_1}
                                </p>
                                <a href="{btn_link_1}" class="hvr-icon-forward btn-link" target="_blank">{btn_text_1}</a>
                            </div>
                        </div>
                    </div>
                ${get_code_for_multiple(`
                    <div class="col-lg-4 blog_1" onclick="window.location.href='{btn_link_{i}}'">
                        <div class="card blog-b border">
                            <img class="card-img-top" src="/marmore{image_src_{i}}" alt="Card image">
                            <div class="card-body ">
                                <a href="{category_link_{i}}" class="btn-link">{category_name_{i}}</a>
                                <h4 class="card-title card_2">{blog_name_{i}}</h4>
                                <p class="card-text card_2">{caption_{i}}
                                </p>
                                <a href="{btn_link_{i}}" class="hvr-icon-forward btn-link" target="_blank">{btn_text_{i}}</a>
                            </div>
                        </div>
                </div>`,3,2)}
            </div>
</section>`,
 values: get_values_for_multiple(["image_src_{i}","category_link_{i}","category_name_{i}","blog_name_{i}","caption_{i}","btn_link_{i}","btn_text_{i}"],3),    
 css_config: {
      
    }

  },
    related_insights_2:{
      html:`<section class="industry-blog" id="section-line-4">
            <div class="container">
                <div class="row blogs service-related-blog">
                    <div class="col-lg-4 blog_1" onclick="window.location.href='{btn_link_1}'">
                        <div class="card blog-b border">
                            <img class="card-img-top" src="/marmore{image_src_1}" alt="Card image">
                            <div class="card-body ">
                                <a href="{category_link_1}" class="btn-link">{category_name_1}</a>
                                <h4 class="card-title card_2">{blog_name_1}</h4>
                                <p class="card-text card_2">{caption_1}
                                </p>
                                <a href="{btn_link_1}" class="hvr-icon-forward btn-link" target="_blank">{btn_text_1}</a>
                            </div>
                        </div>
                    </div>
                ${get_code_for_multiple(`
                    <div class="col-lg-4 blog_1" onclick="window.location.href='{btn_link_{i}}'">
                        <div class="card blog-b border">
                            <img class="card-img-top" src="/marmore{image_src_{i}}" alt="Card image">
                            <div class="card-body ">
                                <a href="{category_link_{i}}" class="btn-link">{category_name_{i}}</a>
                                <h4 class="card-title card_2">{blog_name_{i}}</h4>
                                <p class="card-text card_2">{caption_{i}}
                                </p>
                                <a href="{btn_link_{i}}" class="hvr-icon-forward btn-link" target="_blank">{btn_text_{i}}</a>
                            </div>
                        </div>
                </div>`,2,2)}
            </div></div>
</section>`,
 values: get_values_for_multiple(["image_src_{i}","category_link_{i}","category_name_{i}","blog_name_{i}","caption_{i}","btn_link_{i}","btn_text_{i}"],2),    
 css_config: {
      
    }

  },
    related_insights_1:{
      html:`<section class="industry-blog" id="section-line-4">
            <div class="container">
                <div class="row blogs service-related-blog">
                    <div class="col-lg-4 blog_1" onclick="window.location.href='{btn_link_1}'">
                        <div class="card blog-b border">
                            <img class="card-img-top" src="/marmore{image_src_1}" alt="Card image">
                            <div class="card-body ">
                                <a href="{category_link_1}" class="btn-link">{category_name_1}</a>
                                <h4 class="card-title card_2">{blog_name_1}</h4>
                                <p class="card-text card_2">{caption_1}
                                </p>
                                <a href="{btn_link_1}" class="hvr-icon-forward btn-link" target="_blank">{btn_text_1}</a>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
</section>`,
 values: ["image_src_1","category_link_1","category_name_1","blog_name_1","caption_1","btn_link_1","btn_text_1"],    
 css_config: {
      
    }

  },

   our_process_service:{
      html:`<div class="card-section" id="section-line-2">
            <div class="row">
                <div class="col-lg-3">
                    <div class="icon-boxes-a">
                        <div class="icon text-center"><img src="/marmore{image_src_1}" alt=""></div>
                        <h3 class="text-center icon-content">{heading_1}</h3>
                    </div>
                </div>
                ${get_code_for_multiple(`<div class="col-lg-3">
                    <div class="icon-boxes-a">
                        <div class="icon text-center"><img src="/marmore{image_src_{i}}" alt=""></div>
                        <h3 class="text-center icon-content">{heading_{i}}</h3>

                    </div>
                </div>`,3,2)}
            </div>
        </div>`,
    values: get_values_for_multiple(["heading_{i}","image_src_{i}"],3),
    css_config: {}
   },
  service_exp_section:{
      html:`<div class="container-fuild" id="section-line-2">
        <div class="counter count1">
            <div class="row">
                <div class="col-lg-6 experts2 ex2">
                    <h1 class="values2">{exp_count_1}</h1>
                    <p class="q_p">{heading_1}</p>
                </div>
                <div class="col-lg-6 experts2 ex1">
                    <h1 class="values2">{report_count_1}</h1>
                    <p class="q_p">{heading_2}</p>
                </div>
            </div>
        </div>
    </div>`,
  values: ["exp_count_1", "heading_1","report_count_1","heading_2"],
    css_config: {
    }
  },
  latest_news:{
      html:`<div id="related_news_div" class="pl-5 pr-5">${
        $.ajax({
          url : "ajax_latest_news.php",
          type: "POST",
          datatype:"html",
          data:{news:1},
          success:function(result){
              //console.log(result);
              $("#related_news_div").html(result);
          }
        })
    }</div>`,
    values: [],
    css_config: {
    }
  },
  news_blog: {
      html:`<div class="card1" style="padding-top: 40px;">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="card card_m">
                                <img class="card-img-top" src="/marmore{image_src_1}" alt="Card image"
                                    style="width:100%">
                                <div class="card-body card_client">
                                    <a href="{link_1}" class="btn-link">{category_name_1}</a>
                                    <h4 class="card-title card_client" style="margin-top: 5px; font-weight: bold;">{new_name_1}</h4>
                                    <p class="card-text" style="padding: 0px;">{caption_1}
                                    </p>
                                    <a href="{link_1}" class="hvr-icon-forward btn-link">{button_name_1}</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card card_m">
                                <img class="card-img-top" src="/marmore{image_src_2}" alt="Card image"
                                    style="width:100%">
                                <div class="card-body card_client">
                                    <a href="{link_2}" class="btn-link">{category_name_2}</a>
                                    <h4 class="card-title card_client" style="margin-top: 5px; font-weight: bold;">{new_name_2}</h4>
                                    <p class="card-text" style="padding: 0px;">{caption_2}
                                    </p>
                                    <a href="{link_2}" class="hvr-icon-forward btn-link">{button_name_2}</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card card_m">
                                <img class="card-img-top" src="/marmore{image_src_3}" alt="Card image"
                                    style="width:100%">
                                <div class="card-body card_client">
                                    <a href="{link_3}" class="btn-link">{category_name_3}</a>
                                    <h4 class="card-title card_client" style="margin-top: 5px; font-weight: bold;">{new_name_3}</h4>
                                    <p class="card-text" style="padding: 0px;">{caption_3}
                                    </p>
                                    <a href="{link_3}" class="hvr-icon-forward btn-link">{button_name_3}</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card card_m">
                                <img class="card-img-top" src="/marmore{image_src_4}" alt="Card image"
                                    style="width:100%">
                                <div class="card-body card_client">
                                    <a href="{link_4}" class="btn-link">{category_name_4}</a>
                                    <h4 class="card-title card_client" style="margin-top: 5px; font-weight: bold;">{new_name_4}</h4>
                                    <p class="card-text" style="padding: 0px;">{caption_4}
                                    </p>
                                    <a href="{link_4}" class="hvr-icon-forward btn-link">{button_name_4}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`,
      values: ["image_src_1", "link_1","category_name_1","new_name_1","caption_1","button_name_1","image_src_2", "link_2","category_name_2","new_name_2","caption_2","button_name_2","image_src_3", "link_3","category_name_3","new_name_3","caption_3","button_name_3","image_src_4", "link_4","category_name_4","new_name_4","caption_4","button_name_4"],
    css_config: {}
  },
title_header: {
    html:
      `<section class="guides {css_classes}" id="section-line-3">
        <div class="tabout"><h1 class="pt-3 pb-2 {css_classes} title">{heading}</h1>
        <p class="{css_classes} paratext">{content}</p></div>`,
    values: ["heading", "content"],
    css_config: {
      left_align: "text-left",
      center_align: "text-center",
      right_align: "text-right",
      font_md: "font_md",
      font_lg: "font_lg",
      font_bold: "bold",
      bg_color_blue:"blog-list",
      bg_color_white:"help"
    }
  },
  title_only : {
      html:
      `<section class="guides {css_classes}" id="section-line-3">
        <div class=""><h1 class="pt-3 pb-2 {css_classes} title">{heading}</h1>
        </div>`,
    values: ["heading"],
    css_config: {
      left_align: "text-left",
      center_align: "text-center",
      right_align: "text-right",
      font_md: "font_md",
      font_lg: "font_lg",
      font_bold: "bold",
      bg_color_blue:"blog-list",
      bg_color_white:"help"
    }
  },
  text_content: {
    html:
      `<div class="col-md-12 about-content">
          <div class="about-inside-content">
               {content} 
          </div>
      </div>`,
    values: ["content"],
    css_config: {
      left_align: "text-left",
      center_align: "text-center",
      right_align: "text-right",
      font_md: "font_md",
      font_lg: "font_lg",
      font_bold: "bold"
    }
  },
  blog_card:{
      html:`<section class="guides blog-list"><div class="row">
            <div class="col-lg-4">
                <div class="card blog-b">
                    <img class="card-img-top" src="/marmore{image_src_1}" alt="Card image"
                        style="width:100%">
                    <div class="card-body ">
                        <a href="#" class="btn-link">{category_name_1}</a>
                        <h4 class="card-title car1">{heading_1}</h4>
                        <p class="card-text txt">{content_1}</p>
                        <a href="{button_link_1}" class="hvr-icon-forward btn-link">{button_text_1}</a>
                    </div>
                </div>
            </div>
             ${get_code_for_multiple(`<div class="col-lg-4">
                <div class="card blog-b">
                    <img class="card-img-top" src="/marmore{image_src_{i}}" alt=""
                        style="width:100%">
                    <div class="card-body ">
                        <a href="#" class="btn-link">{category_name_{i}}</a>
                        <h4 class="card-title car1">{heading_{i}}</h4>
                        <p class="card-text txt">{content_{i}}</p>
                        <a href="{button_link_{i}}" class="hvr-icon-forward btn-link">{button_text_{i}}</a>
                    </div>
                </div>
            </div>`,2,2)}
        </div></section>`,
       values: get_values_for_multiple(["image_src_{i}","category_name_{i}","heading_{i}","content_{i}","button_text_{i}","button_link_{i}"],5),
    css_config: {}
  },
  service_card:{
      html:`<section class="guides strategic"><div class="row pb-3">
            <div class="col-lg-4">
                <div class="card blog-b">
                    <div class="card-body sheet sheet1">
                        <img src="/marmore{image_src_1}" alt="">
                        <h4 class="card-title cap1 ">{service_name_1}</h4>
                        <p class="card-text txt">{content_1}</p>
                    </div>
                </div>
            </div>
             ${get_code_for_multiple(`<div class="col-lg-4">
                <div class="card blog-b">
                    <div class="card-body sheet sheet1">
                        <img src="/marmore{image_src_{i}}" alt="">
                        <h4 class="card-title cap1 ">{service_name_{i}}</h4>
                        <p class="card-text txt">{content_{i}}</p>
                    </div>
                </div>
            </div>`,3,2)}
        </div></section>`,
       values: get_values_for_multiple(["service_name_{i}","image_src_{i}","content_{i}"],3),
    css_config: {}
  },
  service_card_2:{
      html:`<section class="guides strategic"><div class="row pb-3">
            <div class="col-lg-4">
                <div class="card blog-b">
                    <div class="card-body sheet sheet1">
                        <img src="/marmore{image_src_1}" alt="">
                        <h4 class="card-title cap1 ">{service_name_1}</h4>
                        <p class="card-text txt">{content_1}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card blog-b">
                    <div class="card-body sheet sheet1">
                        <img src="/marmore{image_src_2}" alt="">
                        <h4 class="card-title cap1">{service_name_2}</h4>
                        <p class="card-text txt">{content_2}</p>
                    </div>
                </div>
            </div>
        </div></section>`,
       values:["service_name_1","image_src_1","content_1","service_name_2","image_src_2","content_2"],
    css_config: {}
  },
  service_card_1:{
      html:`<section class="guides strategic"><div class="row pb-3">
            <div class="col-lg-4">
                <div class="card blog-b">
                    <div class="card-body sheet sheet1">
                        <img src="/marmore{image_src_1}" alt="">
                        <h4 class="card-title cap1 ">{service_name_1}</h4>
                        <p class="card-text txt">{content_1}</p>
                    </div>
                </div>
            </div>
        </div></section>`,
       values: ["service_name_1","image_src_1","content_1"],
    css_config: {}
  },

  image_with_content: {
    html:
      `<div class="container-fuild">
        <div class="counter1">
            <div class="item">
                <div class="card blog-card">
                    <div class="row no-gutters align-items-center">
                        <div class="col-sm-4" style="text-align: center;">
                            <img class="card-img" src="/marmore{image_src}" style="width: 300px;" alt="alt-img">
                        </div>
                        <div class="col-sm-8 align-items-center">
                            <div class="card-body cd1">
                                <p style="color:#00aeef !important;font-weight: 600;">{main_heading}</p>
                                <h2 class="card-title book-title" style="color: white;">{heading}</h2>
                                <p class="card-text book-text pt-3 pb-3">{caption}</p>
                                <a class="btn btn-2" href="{button_link}" style="border-radius: 0;"><span>{button_text}</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        `,
    values: ["image_src","main_heading","heading","caption","button_text","button_link"],
    css_config: {
      center_align_text: "text-center",
      reverse_image_direction: "flex-row-reverse"
    }
  },
//   image_with_content_70_30: {
//     html:
//       `<div class="about-content col-md-10 mb-5">
//             <div class="row {css_classes}">
//                 <div class="col-md-4 purpose-image">
//                     <img src="{image_src}" alt="daimler-trucksasia" loading="lazy">
//                 </div>
//                 <div class="col-md-8">
//                     {content}
//                 </div>
//             </div>
//         </div>
//         `,
//     values: ["content", "image_src"],
//     css_config: {
//       center_align_text: "text-center",
//       reverse_image_direction: "flex-row-reverse"
//     }
//   },
//   image_with_content_60_40: {
//     html:
//       `<div class="about-content col-md-10 mb-5">
//             <div class="row {css_classes}">
//                 <div class="col-md-5 purpose-image">
//                     <img src="{image_src}" alt="daimler-trucksasia" loading="lazy">
//                 </div>
//                 <div class="col-md-7">
//                     {content}
//                 </div>
//             </div>
//         </div>
//         `,
//     values: ["content", "image_src"],
//     css_config: {
//       center_align_text: "text-center",
//       reverse_image_direction: "flex-row-reverse"
//     }
//   },
  single_image: {
    html:
      `<div class="row">
                <div class="col-md-10 about-header-image">
                    <img src="{image_src}" alt="daimler-box-image" loading="lazy" />
                    <p class="text-center text-muted">{image_caption}</p>
                </div>
        </div>`,
    values: ["image_src","image_caption"],
    css_config: {}
  },
  single_file: {
    html:
      `<div class="about-content col-md-10">
      <div class="download-pdf">
            <span><img src="/assets/images/about/pdf.png" alt="pdf-image" loading="lazy">{file_src_name}</span>
            <a href="{file_src}" download=""><img src="/assets/images/about/download.png" alt="download-image" loading="lazy"></a>
        </div>
        </div>`,
    values: ["file_src"],
    css_config: JSON.parse(JSON.stringify(COMMON_ELEMENT_CONFIG["alignment"]))
  },
  single_file_with_name: {
    html:`<div class="about-content col-md-10">
    <div class="download-pdf">
            <span><img src="/assets/images/about/pdf.png" alt="pdf-image" loading="lazy">{display_name}</span>
            <a href="/uploads/files/{file_src}" download=""><img src="/assets/images/about/download.png" alt="download-image" loading="lazy"></a>
        </div>
    </div>`,
    values: ["file_src", "display_name"],
    css_config: JSON.parse(JSON.stringify(COMMON_ELEMENT_CONFIG["alignment"]))
  },
  image_carousel: {
    html:
    `<div class="about-content col-md-10">
    <div class="mftbc-carousel">
        <div id="carousel_{id}" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="{image_src_1}" class="d-block" alt="carousel-one">
              <div class="carousel-caption d-none d-md-block">
                <p>{caption_1}</p>
                </div>
            </div>
            
            ${get_code_for_multiple(`<div class="carousel-item">
              <img src="{image_src_{i}}" class="d-block" alt="carousel-two">
              <div class="carousel-caption d-none d-md-block">
                <p>{caption_{i}}</p>
              </div>
            </div>`,10,2)}
            
            
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carousel_{id}" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"><img src="/assets/images/carousel-left-arrow.png" /></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carousel_{id}" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"><img src="/assets/images/carousel-right-arrow.png" /></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
    </div>
    </div>`,
    values: get_values_for_multiple(["image_src_{i}", "caption_{i}"],10),
    css_config: {}
  },
  image_carousel_splide: {
    html:
    `<div class="splide_wrapper">
        <div class="splide">
        	<div class="splide__track mb-4">
        		<ul class="splide__list">
        		    ${
        		    get_code_for_multiple(`<li class="splide__slide">
        			    <img data-tag="image-c" src="{image_src_{i}}"  alt="carousel-one">
        			    <div class="carousel-caption d-none d-md-block">
        			        <p>{caption_{i}}</p>
        			    </div>
        			</li>`,10)
        		    }
        		</ul>
        	</div>
        </div>
    </div>`,
    values: get_values_for_multiple(["image_src_{i}", "caption_{i}"],10),
    css_config: {}
  },
 
   single_text: {
    html:
      `<div class="row">
                <div class="col-md-10 about-header-image">
                    <p class="text-center text-muted"><b>{line_1}<b></p>
                </div>
        </div>`,
    values: ["line_1"],
    css_config: {}
  },
  
};
/**
 * Main state of the application, used to handle the common functionalities
 * like edit, create etc. Used in the other functions.
 */

var state = {
  add_element_config: INITIAL_STATE["add_element_config"]
}; // ------------------------------------------------------- Functions

/**
 * The modal is used to create the elements dynamically, this is used to
 * get the data of the created components and inits the page with the elements.
 */

function initPageWithSavedComponents() {
  var main_saved_contents = $("#main_saved_contents");
  //console.log(main_saved_contents);
  renderSavedElements(main_saved_contents);
}
/**
 * This function prepares all the event listeners for the app.
 * Since most of the contents are dynamic, this is called whenever some
 * new component is created.
 */

function initEventListeners() {
  /**
   * When the menu buttons rendered are clicked, this invoked specific functions.
   */
  $(".elements_menu_button").click(function (event) {
    // prepare the state
    setAddElementState(event.target.innerHTML);
    initAddElementConfigModal(); // show modal

    $("#element_input_modal").modal("show");
  });
  /**
   * This block of code, resets the state and other modal related stuff, when
   * the modal is closed.
   */

  $("#element_input_modal").on("hide.bs.modal", function (e) {
    resetAddElementConfig();
  });
  /**
   * This is called when the save button in the modal is called. This gets the data
   * from the modal elements and sends the data to the BE.
   */

  $("#element_input_save").on("click", function (e) {
    e.preventDefault();
    var data_to_send = getUserInputFromModal();
    // console.log(JSON.stringify(data_to_send));
    // return false;
    sendAjaxRequest(data_to_send, "content.php", "POST", false, null);
  });
}
/**
 * This function returns all the generated & static elements configuration
 * in the application. This is used everywhere in the app.
 */

function getAllElementsConfig() {
  return STATIC_ELEMENT_CONFIG;
} // ------------------------------------------------------- Called after other pre processing

/**
 * This block initalizes the menu items defined by the `getAllElementsConfig()`.
 * Basically buttons rendered for the user to take actions.
 */

var elements_menu_holder = $("#elements_menu_holder");
$.each(getAllElementsConfig(), function (element_key, element_config) {
   // console.log(element_key);
    //console.log(element_config);
  var menu_button = $(
    "<button type='button' class='btn btn-primary btn-lg elements_menu_button m-2'></button>"
  ).text(element_key);
  elements_menu_holder.append(menu_button);
});


/**
 * Space to call the other functions defined in the app.
 * Defined as a function just to make things DRY & clean.
 */

initPageWithSavedComponents();
initEventListeners();
