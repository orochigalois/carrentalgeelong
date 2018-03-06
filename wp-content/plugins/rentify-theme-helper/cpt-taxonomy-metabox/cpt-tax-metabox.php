<?php 

/*-------------------------------------------------------------------------
  START BLOCK POST TYPE
------------------------------------------------------------------------- */
$sb_block  = new Cuztom_Post_Type( 'block', array(
        "label" => 'Block',
        "menu_position" => 5,     
        'has_archive' => true,
        'menu_icon' => 'dashicons-grid-view',
        'taxonomies'          => array('post_tag' ),     
        'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
    ) 
);

/*-------------------------------------------------------------------------
  END BLOCK POST TYPE
------------------------------------------------------------------------- */




/*-------------------------------------------------------------------------
  START sb COMPANY LOCATION POST TYPE
------------------------------------------------------------------------- */

$sb_company_locations  = new Cuztom_Post_Type( 'company_location', array(
        "label" => 'Company Locations',
        "menu_position"   => 60,    
        'menu_icon'       => 'dashicons-location',  
        'has_archive'     => true,
        'taxonomies'      => array('post_tag' ),     
        'supports'        => array('title','thumbnail')
    ) 
);


$sb_company_locations->add_meta_box(
    'sb_company_location',
    'Company Agency Contact Information',
    array( 
        array(
          'name'          => 'icon',
          'label'         => 'Icon For Google Map',
          'description'   => 'Insert icon that show on google map',
          'type'          => 'image',
        )
    )
);


$sb_company_locations->add_meta_box(
    'sb_property_address',
    'Comany Agency Location on Google Map',
    array(
        array(
          'label' => __('Country Name ', 'rentify'),
          'name' => 'country_name',
          'type' => 'text',
          'desc' => __('Country', 'rentify')
        ),
        array(
          'label' => __('Region Name', 'rentify'),
          'name' => 'region_name',
          'type' => 'text',
          'desc' => __('Region', 'rentify')
        ),
        array(
          'label' => __('Address Name', 'rentify'),
          'name' => 'address_name',
          'type' => 'text',
          'desc' => __('Address', 'rentify')
        ),
        array(
          'label' => __('Zip Code of Region', 'rentify'),
          'name' => 'zip',
          'type' => 'text',
          'desc' => __('ZIP codes', 'rentify')
        ),
        array(
          'label' => 'map canvas',
          'name'  => 'map_canvas',
          'type' => 'hidden',

        ),
        array(
          'name'          => 'convert_zip',
          'label'         => 'Covert to zip code to latitude and longitude',
          'description'   => 'click checkbox to find result',
          'type'          => 'checkbox',
          'default_value' => 'off'
        ),
        array(
          'label' => __('Latitude', 'rentify'),
          'name' => 'lat',
          'type' => 'text',
          'std' => '0',
          'desc' => __('Latitude', 'rentify')
        ),
        array(
          'label' => __('Longitude', 'rentify'),
          'name' => 'lng',
          'type' => 'text',
          'std' => '0',
          'desc' => __('longitude', 'rentify')
        ),
    )

);


/*-------------------------------------------------------------------------
  END sb COMPANY LOCATION POST TYPE
------------------------------------------------------------------------- */



/*-------------------------------------------------------------------------
  START RESTAURANT About Feature CPT FOR sb
------------------------------------------------------------------------- */

$feature  = new Cuztom_Post_Type( 'feature', array(
        "label" => 'Features',
        "menu_position" => 14, 
        'menu_icon' => 'dashicons-visibility',    
        'has_archive' => true,
        'taxonomies'          => array('post_tag' ),     
        'supports' => array('title', 'excerpt','thumbnail')
    ) 
);

$feature->add_meta_box(
    'tons_of_feature',
    'Simple Builder Feature Icon For The Post',
    array(
        array(
            'name' => 'icon',
            'label' => '<div><button class="btn btn-primary" role="iconpicker"> Set Icon </button></div>',
            'description' => 'Provide The Icon for your Feature',
            'type' => 'text'
        ),
        array(
            'name' => 'icon',
            'label' => 'Set Your icon HTML for post',
            'description' => 'Provide The Icon for your Feature',
            'type' => 'textarea'
        ),        
    )
);


/*-------------------------------------------------------------------------
  END RESTAURANT About Feature  CPT FOR sb
------------------------------------------------------------------------- */



/*-------------------------------------------------------------------------
  START PAGE POST TYPE
------------------------------------------------------------------------- */

$sb_page = new Cuztom_Post_Type( 'page');

$company_info  = new Cuztom_Post_Type( 'company', array(
        "label" => 'Company Info',
        "menu_position"   => 6,     
        'has_archive'     => true,
        'menu_icon'       => 'dashicons-admin-multisite',
        'taxonomies'      => array('post_tag' ),     
        'supports'        => array('title')
    ) 
);

$company_info->add_meta_box(
    'company_info_feature',
    'Simple Builder Company Information For The Post',
    array(
        array(
            'name' => 'icon',
            'label' => 'Set Your icon HTML for post',
            'description' => 'Provide The Icon for your Feature',
            'type' => 'textarea'
        ),
        array(
            'name' => 'number',
            'label' => 'Input Your Number',
            'description' => 'Provide The number for your Feature',
            'type' => 'text'
        ),
        array(
            'name' => 'title',
            'label' => 'Set Your title for post',
            'description' => 'Provide The title for your Feature',
            'type' => 'text'
        ),
    )
);

$rentify_page = new Cuztom_Post_Type( 'page');

$rentify_page->add_meta_box(
    'rentify_page',
    'Rentify Choose Banner Color',
    array(
        array(
            'name' => 'banner_color',
            'label' => __('Choose Page Banner Color ','sb'),
            'type' => 'color'
        ),        
    )
);


