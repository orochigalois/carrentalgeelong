<?php 
/*-------------------------------------------------------------*******************************---------------------------------------------------------
                                SB Merin's Shortcodes portion start
---------------------------------------------------------------*******************************------------------------------------------------------- */

if(!function_exists('rentify_about_offer_wrapper')){
  function rentify_about_offer_wrapper($attrs , $content = null){

    extract(shortcode_atts( array('image_align'=>'','heading_title'=>'','image_id'=>'', 'bg_color'=>''), $attrs ));

    if($image_id){
      $feature_image = wp_get_attachment_image_src($image_id, 'full');
    }

    $result = '<div class="contact-page about-ing" style="background: '.$bg_color.';">
                <div class="container">
                  <div class="row">'; 
                     
                    if($image_align === 'left'){
                      $result .='<div class="col-md-6"><img class="img-responsive" src="'.$feature_image[0].'" alt=""> </div>
                                <div class="col-md-6">
                                  <h5>'.$heading_title.'</h5>
                                  <ul>'.$content.'</ul>
                                </div>';
                    }else{

                      $result .='<div class="col-md-6">
                                  <h5>'.$heading_title.'</h5>
                                  <ul>'.$content.'</ul>
                                </div>
                                <div class="col-md-6"><img class="img-responsive" src="'.$feature_image[0].'" alt=""> </div>';
                    } 

                  $result .= '</div>
                    </div>
                  </div>';

    return $result;          
  }
}

if(!function_exists('rentify_about_offer_list')){
  function rentify_about_offer_list($attrs, $content = null){
    extract(shortcode_atts( array('font_awesome_icon'=>'' ,'offer_name'=>''), $attrs ));
    $output = '<li><p><i class="fa '.$font_awesome_icon.'"></i>'.$offer_name.'</p></li>';              
    return $output;          
  }
}

add_shortcode( 'rentify_about_offer_list', 'rentify_about_offer_list' );
add_shortcode( 'rentify_about_offer_wrapper', 'rentify_about_offer_wrapper' );


/*-------------------------------------------------------------------------
  START RENTIFY LISTING INFO SHORTCODE
------------------------------------------------------------------------- */

if(!function_exists('rentify_listing_info_wrapper')){
  function rentify_listing_info_wrapper($attrs, $content = null){
    extract(shortcode_atts( array('heading_title'=>''), $attrs ));
    $output = '<h5>'.$heading_title.'</h5>
              <ul>'.$content.'</ul>';              
    return $output;          
  }
}


if(!function_exists('rentify_listing_items')){
  function rentify_listing_items($atts, $content = null){
    extract(shortcode_atts( array('font_awesome_icon'=>'', 'item_desc'=> ''), $atts ));
    $output = '<li><p><i class="fa '.$font_awesome_icon.'"></i>'.$item_desc.'</p></li>';
    return $output;
  }
}


add_shortcode( 'rentify_listing_items', 'rentify_listing_items');
add_shortcode( 'rentify_listing_info_wrapper', 'rentify_listing_info_wrapper' );


/*-------------------------------------------------------------------------
   END RENTIFY LISTING INFO SHORTCODE
------------------------------------------------------------------------- */


/*-------------------------------------------------------------------------
  START SB COPYWRITER WELCOME BLOCK SHORTCODE
------------------------------------------------------------------------- */

function rentify_our_partner_func($atts , $content = null){

  extract(shortcode_atts( array('heading_title'=>'','bg_color'=>'','bg_image'=>''), $atts ));
  global $rentify_option_data;

  $result = '<section class="clients" style="background: '.$bg_color.';">
              <div class="container">
                <div class="clients-slider">';
                if (is_array($rentify_option_data['autorent-our-partners'])) {
                  foreach ($rentify_option_data['autorent-our-partners'] as $key => $value) {
                    if(!empty($value['image'])){
                      $result .= '<div class="client">
                        <a href="'.$value['url'].'"><img src="'.$value['image'].'" alt=""></a>
                      </div>';
                    }
                  }
                 }
                $result .= '</div>
              </div>
            </section>';

  return $result;  
  
}

add_shortcode( 'rentify_our_partner', 'rentify_our_partner_func' );

/*-------------------------------------------------------------------------
 END SB COPYWRITER WELCOME BLOCK SHORTCODE
------------------------------------------------------------------------- */



/*-------------------------------------------------------------------------
 START PREAMBLE SHORTCODE
------------------------------------------------------------------------- */

if(!function_exists('rentify_preamble_func')){
  function rentify_preamble_func($attrs , $content = null){
    extract(shortcode_atts( array('title'=>''), $attrs ));

    $result = '<div class="about-top-info">
                <div class="container">        
                  <div class="heading light col-lg-8 col-lg-offset-2">
                    '.$content.'
                  </div>          
                </div>
              </div>';
    return $result;          
  }
}

add_shortcode('rentify_preamble' , 'rentify_preamble_func');

/*-------------------------------------------------------------------------
 END PREAMBLE SHORTCODE
------------------------------------------------------------------------- */




/*-------------------------------------------------------------------------
 START RENTIFY OFFER CONTENT BLOCK
------------------------------------------------------------------------- */

if(!function_exists('rentify_offer_lists_func')){
  function rentify_offer_lists_func($atts , $content=null){
    extract(shortcode_atts( array('name'=>'', 'icon_name' => ''), $atts ));
    $output = '<h5 class="title"><span><i class="fa '.$icon_name.'"></i></span>'.$name.'</h5>';    
    return $output;          
  }
}

add_shortcode( 'rentify_offer_lists', 'rentify_offer_lists_func' );


if(!function_exists('rentify_offer_tile_func')){
  function rentify_offer_tile_func($atts , $content=null){
    extract(shortcode_atts( array('title'=>'', 'icon_name' => ''), $atts ));
    $output = '<h3 class="title">'.$title.'</h3>';    
    return $output;          
  }
}

add_shortcode( 'rentify_offer_title', 'rentify_offer_tile_func' );

if(!function_exists('rentify_offer_image_func')){
  function rentify_offer_image_func($atts , $content=null){
    extract(shortcode_atts( array('image_id'=>''), $atts ));

    if($image_id){
      $feature_image = wp_get_attachment_image_src($image_id, 'full');
    }
    $output = '<div class="css-table-cell image" style="background : url('.$feature_image[0].') top center no-repeat; background-size: cover;">
                <img class="banner-image" src="'.$feature_image[0].'" alt="">
              </div>';
    return $output;          
  }
}

add_shortcode( 'rentify_offer_image', 'rentify_offer_image_func' );

/*-------------------------------------------------------------------------
 END RENTIFY OFFER CONTENT BLOCK
------------------------------------------------------------------------- */


/*-------------------------------------------------------------------------
 END RESTAURANT About The Company SHORTCODE
------------------------------------------------------------------------- */

// ************************** ************************** ************************** ************************** **************************

function rentify_company_stats_counter_func($atts , $content = null){

  extract(shortcode_atts( array('no_of_info_show' => '', 'image_id' => '' , 'bg_color'=> ''), $atts ));

  if($image_id){
    $feature_image = wp_get_attachment_image_src($image_id, 'full');
  }else{
    $feature_image[] = '';
  }

  $testimonial_count = 0;

  $output = '<div class="uou-demo-block has-bg-image" data-bg-image="'.$feature_image[0].'" style="background: '.$bg_color.';">
                <div class="container">
                  <div class="row">';

  $args = array(
      'post_type' => 'company',
      'post_status' => 'publish',
      'posts_per_page' => intval($no_of_info_show),
  );

  $get_all_testimonial = get_posts($args);  

  if(isset($get_all_testimonial)&& !empty($get_all_testimonial)):   
    foreach ($get_all_testimonial as $key => $value) {

      $all_post_meta = get_post_custom( $value->ID );

      $output .= '<div class="col-md-2">                              
                    <div class="uou-icon-counter">';

      $output .= $all_post_meta['_company_info_feature_icon'][0];
      $output .= '<h4>' . $all_post_meta['_company_info_feature_number'][0] . '</h4>';
      $output .= '<p>'.$all_post_meta['_company_info_feature_title'][0] . '</p>';
      $output .= '</div> 
                </div>';
      $testimonial_count++;  
      if(intval($testimonial_count) === intval($no_of_info_show)) break;
    }
  endif;
  $output .='</div>
          </div> 
        </div>';
  return $output;
}
add_shortcode( 'rentify_company_stats_counter', 'rentify_company_stats_counter_func' );




// ************************************ ************************************ ************************************ ************************************
function rentify_company_feature_services_func($atts , $content = null){

  extract(shortcode_atts( array('no_of_info_show' => '', 'title' => '', 'subtitle' => '','image_id'=>'','service_bg_color'=>''), $atts ));
  $testimonial_count = 0;

  if($image_id){
    $feature_image = wp_get_attachment_image_src($image_id, 'full');
  }else{
    $feature_image[] = '';
  }

  $output = '<div class="uou-demo-block has-bg-image" data-bg-image="'.$feature_image[0].'" style="background: '.$service_bg_color.';">
                <h1 class="block-title">'.$title.'</h1>
                <p class="block-secondary-title">'.$subtitle.'</p>
                <div class="container">
                  <div class="row">';

  $args = array(
      'post_type' => 'feature',
      'post_status' => 'publish',
      'posts_per_page' => intval($no_of_info_show),
      'excerpt' => 150,
      'readmore' => 'yes',
      'readmoretext' => 'Read more'
  );

  $get_all_testimonial = get_posts($args);  

  $output .= '<div class="col-sm-1"></div>';


  if(isset($get_all_testimonial)&& !empty($get_all_testimonial)):   
    foreach ($get_all_testimonial as $key => $value) {

      $all_post_meta = get_post_custom( $value->ID );

      $output .= '<div class="col-sm-2">
                    <div class="uou-block-8d">';

      $output .= $all_post_meta['_tons_of_feature_icon'][0];
      $output .= '<h5>' . $value->post_title . '</h5>';
      $output .=  $value->post_excerpt;
      $output .= '</div> 
                </div>';
      $testimonial_count++;  
      if(intval($testimonial_count) === intval($no_of_info_show)) break;
    }
    $output .= '<div class="col-sm-1"></div>';
  endif;
  $output .='</div>
          </div> 
        </div>';
  return $output;
}
add_shortcode( 'rentify_company_feature_services', 'rentify_company_feature_services_func' );



// ************************************ ************************************ ************************************ ************************************
function rentify_alex_func($atts , $content = null){

  extract(shortcode_atts( array('title' => ''), $atts ));

  $output='<style>
  .service-offer .inner:after {
    background: rgba(0, 0, 0, 0.6); }
  .service-offer .inner:hover:after, .service-offer .inner:focus:after {
    background: rgba(247, 125, 10, 0.8); }
  .service-offer .text-holder {
    color: #fff; }
  .service-offer .this-area {
    color: rgba(255, 255, 255, 0.6); }
  
  
  
  
    .services-offer {
      padding: 105px 0;
      background: url(./wp-content/themes/rentify/assets/services/2.png) no-repeat scroll center -150px; }
    
    .service-offer {
      padding: 15px; }
      @media (max-width: 767px) {
        .service-offer {
          max-width: 400px;
          margin: 0 auto; } }
      .service-offer .inner {
        margin: 0;
        position: relative;
        overflow: hidden;
        transition: all 300ms linear 0s; }
        .service-offer .inner:after {
          position: absolute;
          content: "";
          top: 0;
          left: 0;
          bottom: 0;
          right: 0;
          display: block;
          z-index: 1;
          transition: all 300ms linear 0s; }
        .service-offer .inner .normal {
          display: none; }
        .service-offer .inner:hover, .service-offer .inner:focus {
          box-shadow: 0px 3px 7px 0px rgba(0, 0, 0, 0.35); }
          .service-offer .inner:hover .text-holder, .service-offer .inner:focus .text-holder {
            top: 0; }
          .service-offer .inner:hover .this-heading, .service-offer .inner:focus .this-heading {
            margin-bottom: 50px; }
            @media (max-width: 1199px) {
              .service-offer .inner:hover .this-heading, .service-offer .inner:focus .this-heading {
                margin-bottom: 20px; } }
          .service-offer .inner:hover .normal, .service-offer .inner:focus .normal {
            display: block; }
          .service-offer .inner:hover .hover, .service-offer .inner:focus .hover {
            display: none; }
      .service-offer .normal, .service-offer .hover {
        width: 72px;
        display: block;
        text-align: right; }
      .service-offer .text-holder {
        font-size:12px;
        position: absolute;
        top: 45%;
        left: 0;
        bottom: 0;
        right: 0;
        padding: 30px;
        z-index: 2;
        transition: all 300ms linear 0s; }
        @media (max-width: 1199px) {
          .service-offer .text-holder {
            padding: 15px; } }
      .service-offer .this-heading {
        margin-bottom: 100px;
        transition: all 300ms linear 0s; }
      .service-offer .this-title {
        margin: 0 0 15px;
        text-transform: uppercase;
        font: 900 14px/1.1 "Lato", sans-serif;
        color:white !important;
        transition: all 300ms linear 0s; }
        @media (max-width: 1199px) {
          .service-offer .this-title {
            margin-bottom: 10px; } }
      .service-offer .this-area {
        margin: 0;
        font-family: "Open Sans", sans-serif; }
      .service-offer p {
        font-family: "Open Sans", sans-serif;
        line-height: 24px;
        margin: 0;
        transition: all 300ms linear 0s; }
        @media (max-width: 1199px) {
          .service-offer p {
            line-height: 20px; } }
    
  
    .wrapper-services {
      padding: 108px 0; }
      @media (min-width: 1340px) {
        .wrapper-services .container {
          width: 1330px; } }
      @media (max-width: 767px) {
        .wrapper-services .container .media-left img {
          margin-bottom: 30px; }
        .wrapper-services .container .btn-sv {
          display: flex;
          flex-direction: column; }
          .wrapper-services .container .btn-sv a {
            width: 260px;
            margin-left: 0 !important; } }
      .wrapper-services .media-left {
        padding-right: 50px; }
        .wrapper-services .media-left span {
          display: block;
          width: 440px; }
          .wrapper-services .media-left span img {
            max-width: 100%; }
      .wrapper-services .section-title {
        margin-left: 0;
        margin-bottom: 15px;
        max-width: 680px; }
        .wrapper-services .section-title .btn + .btn {
          margin-left: 18px; }
    
  
    .service-detail-tabs {
      padding: 115px 0 120px; }
      .service-detail-tabs:before, .service-detail-tabs:after {
        content: "";
        height: 635px;
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        right: 0; }
      .service-detail-tabs:before {
        background: url(./wp-content/themes/rentify/assets/services/bg2.jpg) no-repeat scroll center top;
        background-size: cover; }
      .service-detail-tabs:after {
        background: #2b2e4a;
        opacity: 0.95; }
      .service-detail-tabs .container {
        position: relative;
        z-index: 2; }
      .service-detail-tabs .section-title {
        margin-bottom: 55px; }
        .media-right{
          float:right;
        }
        .section-title-img{
            margin-top:100px;
            margin-bottom:100px;
        }

  </style>';
  $output .= '<section class="row services-offer">
  <div class="container">
    <div class="row section-title text-center">
      
      <h2 class="h1 this-main">Our service</h2>
      
    </div>
    <div class="row text-center section-title-img"><img src="./wp-content/themes/rentify/assets/services/1.png" alt=""></div>

    <div class="row">
  
      <div class="col-sm-6 col-md-4 service-offer">
        <div class="row inner">
          <img src="./wp-content/themes/rentify/assets/services/WechatIMG58.png" alt="" class="img-responsive">
          <div class="text-holder">
            <div class="media this-heading">
              <div class="media-body">
                <h4 class="this-title">Short term lease / Long term rental available</h4>
                
              </div>
              <div class="media-right media-middle">
                <span class="normal"><img src="./wp-content/themes/rentify/assets/service-offer/1.png" alt="" class="this-icon"></span>
                <span class="hover"><img src="./wp-content/themes/rentify/assets/service-offer/7.png" alt="" class="this-icon"></span>
              </div>
            </div>
            <p>We provide you the different range of vehicles for your journey
              Day rate starts from $30
              For oversea short time project worker , we provide long term rental
              Service , offer best rate suitable for your budget ‘</p>
          </div>
        </div>
      </div>
    
      <div class="col-sm-6 col-md-4 service-offer">
        <div class="row inner">
          <img src="./wp-content/themes/rentify/assets/services/WechatIMG57.png" alt="" class="img-responsive">
          <div class="text-holder">
            <div class="media this-heading">
              <div class="media-body">
                <h4 class="this-title">Insurance</h4>
                
              </div>
              <div class="media-right media-middle">
                <span class="normal"><img src="./wp-content/themes/rentify/assets/service-offer/3.png" alt="" class="this-icon"></span>
                <span class="hover"><img src="./wp-content/themes/rentify/assets/service-offer/9.png" alt="" class="this-icon"></span>
              </div>
            </div>
            <p style="margin-top: -5%;">We are offering arrange of extra insurance cover , you can add while booking
              online or add up when you pick up the vehicle</p>
          </div>
        </div>
      </div>
    
      <div class="col-sm-6 col-md-4 service-offer">
        <div class="row inner">
          <img src="./wp-content/themes/rentify/assets/services/WechatIMG59.png" alt="" class="img-responsive">
          <div class="text-holder">
            <div class="media this-heading">
              <div class="media-body">
                <h4 class="this-title">Melbourne Turramuri / Avalon airport pick up service available</h4>
                
              </div>
              <div class="media-right media-middle">
                <span class="normal"><img src="./wp-content/themes/rentify/assets/service-offer/5.png" alt="" class="this-icon"></span>
                <span class="hover"><img src="./wp-content/themes/rentify/assets/service-offer/11.png" alt="" class="this-icon"></span>
              </div>
            </div>
            <p style="margin-top: -5%;">We are also offering airport transport service between airports to Geelong
              surround</p>
          </div>
        </div>
      </div>
  
      <div class="col-sm-6 col-md-4 service-offer">
        <div class="row inner">
          <img src="./wp-content/themes/rentify/assets/services/WechatIMG60.png" alt="" class="img-responsive">
          <div class="text-holder">
            <div class="media this-heading">
              <div class="media-body">
                <h4 class="this-title">Driver service provide</h4>
                
              </div>
              <div class="media-right media-middle">
                <span class="normal"><img src="./wp-content/themes/rentify/assets/service-offer/6.png" alt="" class="this-icon"></span>
                <span class="hover"><img src="./wp-content/themes/rentify/assets/service-offer/12.png" alt="" class="this-icon"></span>
              </div>
            </div>
            <p>If you are lazy to drive , our friendly staff could be your personal driver
              We are offering persona; driver service to suit your need</p>
          </div>
        </div>
      </div>  
      
      <div class="col-sm-6 col-md-4 service-offer">
        <div class="row inner">
          <img src="./wp-content/themes/rentify/assets/services/WechatIMG60.png" alt="" class="img-responsive">
          <div class="text-holder">
            <div class="media this-heading">
              <div class="media-body">
                <h4 class="this-title">Special occasion ,event car rental</h4>
                
              </div>
              <div class="media-right media-middle">
                <span class="normal"><img src="./wp-content/themes/rentify/assets/service-offer/2.png" alt="" class="this-icon"></span>
                <span class="hover"><img src="./wp-content/themes/rentify/assets/service-offer/8.png" alt="" class="this-icon"></span>
              </div>
            </div>
            <p>Our luxury fleets ,convertible fleets, vintage collection fleets could be hired as
              special occasion event hiring
              Such as wedding ,bucks , funeral or daily private leisure</p>
          </div>
        </div>
      </div> 

    </div>   			
  </div>
</section>';

  return $output;
}
add_shortcode( 'rentify_alex', 'rentify_alex_func' );
