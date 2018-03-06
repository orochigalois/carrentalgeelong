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

