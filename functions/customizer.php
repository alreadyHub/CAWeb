<?php

function caweb_customize_preview_init(){
  wp_register_script('caweb-customizer-script',	CAWebUri . '/js/theme-customizer.js', array('jquery','customize-preview'), wp_get_theme('CAWeb')->get('Version'), true);
  
	wp_enqueue_script( 'caweb-customizer-script' );
  
  // Remove other Customizer Scripts
  // Divi Customizer
  wp_dequeue_script( 'divi-customizer' );
  
}
add_action( 'customize_preview_init', 'caweb_customize_preview_init');

function caweb_customize_controls_enqueue_scripts(){
   wp_register_script('caweb-customize-controls-script',	CAWebUri . '/js/theme-customizer-controls.js', array(), wp_get_theme('CAWeb')->get('Version'), true);
  wp_localize_script( 'caweb-customize-controls-script', 'colorschemes', array('default' => caweb_color_schemes( true ), 'all' => caweb_color_schemes() ) );

	wp_enqueue_script( 'caweb-customize-controls-script' );
}
add_action( 'customize_controls_enqueue_scripts', 'caweb_customize_controls_enqueue_scripts' );

function caweb_customizer_v4_option( $customizer ){
  $manager = $customizer->manager; 
    
  return 4 ==  $manager->get_control('ca_site_version')->value() ? true : false;
}
function caweb_customizer_v5_option( $customizer ){
  $manager = $customizer->manager;  
  return 5 ==  $manager->get_control('ca_site_version')->value() ? true : false;
}
function caweb_sanitize_customizer_checkbox( $checked ){
   return ( ( isset( $checked ) && true == $checked ) ? "1" : "0" );
}
function caweb_customize_register( $wp_customize ) {
  
  // Remove Divi Customization Panels and Sections  
  $divi_panels = array('et_divi_general_settings', 'et_divi_header_panel', 'et_divi_footer_panel', 'et_divi_blog_settings', 
                       'et_divi_buttons_settings', 'et_divi_mobile');
  
  
  foreach($divi_panels as $p)
    $wp_customize->remove_panel($p);

  $wp_customize->remove_section('et_color_schemes');
  $wp_customize->remove_section('themes');
  $wp_customize->remove_panel('themes');
  $wp_customize->remove_section('custom_css');
 
   //All our sections, settings, and controls will be added here
  // CAWeb Options
  $wp_customize->add_panel('caweb_options', array(
    														'title' => 'CAWeb Options',
  															'priority'   => 30) );
  // General Settings
  $wp_customize->add_section('caweb_settings', array(
    														'title' => 'Settings',
  															'priority'   => 30,
  																'panel' => 'caweb_options') );
  
  $wp_customize->add_setting('ca_site_version', array(
    														'type' => 'option',
  															'default' => get_option('ca_site_version', 5) ) );
  
 $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'ca_site_version', array(
	'label'      => 'State Template Version',
  'type' => 'select',
   'choices' => array('4'=> 'Version 4', '5'=> 'Version 5'),
	'section'    => 'caweb_settings',
	'settings'   => 'ca_site_version',
		) ) );
  
  $wp_customize->add_setting('ca_default_navigation_menu', array(
    														'type' => 'option',
  															'default' => get_option('ca_default_navigation_menu', 'megadropdown')) );
 
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'ca_default_navigation_menu', array(
	'label'      => 'Header Menu Type',
  'type' => 'select',
   'choices' => array('megadropdown'=> 'Mega Drop', 'dropdown'=> 'Drop Down', 'singlelevel' => 'Single Level'),
	'section'    => 'caweb_settings',
	'settings'   => 'ca_default_navigation_menu',
		) ) );
  
  
  /* Site Color Scheme */
   $wp_customize->add_setting('ca_site_color_scheme', array(
    														'type' => 'option',
  															'default' => get_option('ca_site_color_scheme', 'oceanside') ) );
  
   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'ca_site_color_scheme', array(
	'label'      => 'Color Scheme',
  'type' => 'select',
   'choices' => caweb_color_schemes(),
	'section'    => 'caweb_settings',
	'settings'   => 'ca_site_color_scheme'
		) ) );
  
  $wp_customize->add_setting('ca_frontpage_search_enabled', array(
    														'type' => 'option',
  															'default' => get_option('ca_frontpage_search_enabled', true),
  															'transport' => 'postMessage') );
  
   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'ca_frontpage_search_enabled', array(
	'label'      => 'Show Search on Front Page',
  'type' => 'checkbox',
	'section'    => 'caweb_settings',
	'settings'   => 'ca_frontpage_search_enabled',
    'active_callback' => 'caweb_customizer_v5_option'
		) ) );
  
  $wp_customize->add_setting('ca_sticky_navigation', array(
    														'type' => 'option',
  															'default' => get_option('ca_sticky_navigation', true),
  															'transport' => 'postMessage') );
  
   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'ca_sticky_navigation', array(
	'label'      => 'Sticky Navigation',
  'type' => 'checkbox',
	'section'    => 'caweb_settings',
	'settings'   => 'ca_sticky_navigation',
    'active_callback' => 'caweb_customizer_v5_option'
		) ) );
  
    $wp_customize->add_setting('ca_home_nav_link', array(
    														'type' => 'option',
  															'default' => get_option('ca_home_nav_link', true),
  															'transport' => 'postMessage') );
  
   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'ca_home_nav_link', array(
	'label'      => 'Menu Home Link',
  'type' => 'checkbox',
	'section'    => 'caweb_settings',
	'settings'   => 'ca_home_nav_link',
		) ) );

  // Utility Header
   $wp_customize->add_section('caweb_utility_header', array(
    														'title' => 'Utility Header',
  															'priority'   => 30,
  															'panel' => 'caweb_options') );
  
  $wp_customize->add_setting('ca_contact_us_link', array(
    														'type' => 'option',
  															'default' => get_option('ca_contact_us_link', ''),
  															'transport' => 'postMessage' ) );
  
   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'ca_contact_us_link', array(
	'label'      => 'Contact Us Page',
  'type' => 'text',
	'section'    => 'caweb_utility_header',
	'settings'   => 'ca_contact_us_link',
    'active_callback' => 'caweb_customizer_v5_option'
		) ) );
  
  $wp_customize->add_setting('ca_geo_locator_enabled', array(
    														'type' => 'option',
  															'default' => get_option('ca_geo_locator_enabled'),
    														'sanitize_callback' => 'caweb_sanitize_customizer_checkbox'
  ) );
  
   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'ca_geo_locator_enabled', array(
	'label'      => 'Enable Geo Locator',
  'type' => 'checkbox',
	'section'    => 'caweb_utility_header',
	'settings'   => 'ca_geo_locator_enabled',
    'active_callback' => 'caweb_customizer_v5_option'
		) ) );
  
  $wp_customize->add_setting('ca_utility_home_icon', array(
    														'type' => 'option',
  															'default' => get_option('ca_utility_home_icon', true) ,
  															'transport' => 'postMessage') );
  
   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'ca_utility_home_icon', array(
	'label'      => 'Home Link',
  'type' => 'checkbox',
	'section'    => 'caweb_utility_header',
	'settings'   => 'ca_utility_home_icon',
    'active_callback' => 'caweb_customizer_v5_option'
		) ) );
  
	// Custom Utility Links
	$options = get_ca_site_options();
		
	for( $link = 1; $link < 4; $link++ ){
		$url = get_option( sprintf('ca_utility_link_%1$s', $link ) );
		$label = htmlentities( get_option( sprintf('ca_utility_link_%1$s_name', $link ) ) ) ;
		$target = get_option( sprintf('ca_utility_link_%1$s_new_window', $link ) );
			
		// Label
		$wp_customize->add_setting(sprintf('ca_utility_link_%1$s_name', $link ), array(
    								'type' => 'option',
  									'default' => $label  ,
  									'transport' => 'postMessage') );
  
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, sprintf('ca_utility_link_%1$s_name', $link ), array(
			'label'      => sprintf('Custom Link %1$s Label', $link),
			'type' => 'text',
			'section'    => 'caweb_utility_header',
			'settings'   => sprintf('ca_utility_link_%1$s_name', $link ) ,
			'active_callback' => 'caweb_customizer_v5_option'
			) ) );
		
		// URL
		$wp_customize->add_setting(sprintf('ca_utility_link_%1$s', $link ), array(
									'type' => 'option',
  									'default' => $url ,
  									'transport' => 'postMessage') );
  
		 $wp_customize->add_control( new WP_Customize_Control( $wp_customize, sprintf('ca_utility_link_%1$s', $link ), array(
			'label'      => sprintf('Custom Link %1$s URL', $link),
			'type' => 'text',
			'section'    => 'caweb_utility_header',
			'settings'   => sprintf('ca_utility_link_%1$s', $link ),
			'active_callback' => 'caweb_customizer_v5_option'
				) ) );
				
		// Target
		$wp_customize->add_setting( sprintf('ca_utility_link_%1$s_new_window', $link ), array(
    														'type' => 'option',
  															'default' => $target,    
															'transport' => 'postMessage',
    														'sanitize_callback' => 'caweb_sanitize_customizer_checkbox') );
    
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, sprintf('ca_utility_link_%1$s_new_window', $link ), array(
          'label'      => 'Open in New Tab',
          'type' => 'checkbox',
          'section'    => 'caweb_utility_header',
          'settings'   => sprintf('ca_utility_link_%1$s_new_window', $link ),
    			'active_callback' => 'caweb_customizer_v5_option'
            ) ) );
				
	}
  
  // Page Header
   $wp_customize->add_section('caweb_page_header', array(
    														'title' => 'Page Header',
  															'priority'   => 30,
  															'panel' => 'caweb_options') );
  
  
  
  $wp_customize->add_setting('header_ca_branding', array(
    														'type' => 'option',
  															'default' => get_option('header_ca_branding', '')
  																) );
  
  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'header_ca_branding', array(
	'label'      => 'Organization Logo-Brand',
	'section'    => 'caweb_page_header',
	'settings'   => 'header_ca_branding'
		) ) );
  
  $wp_customize->add_setting('header_ca_branding_alignment', array(
    														'type' => 'option',
  															'default' => get_option('header_ca_branding_alignment', 'left')) );
 
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'header_ca_branding_alignment', array(
	'label'      => 'Organization Logo Alignment',
  'type' => 'select',
   'choices' => array('left'=> 'Left', 'center'=> 'Center', 'right' => 'Right'),
	'section'    => 'caweb_page_header',
	'settings'   => 'header_ca_branding_alignment',
    'active_callback' => 'caweb_customizer_v4_option'
		) ) );
  
   $wp_customize->add_setting('header_ca_background', array(
    														'type' => 'option',
  															'default' => get_option('header_ca_background', ''),
  															'transport' => 'postMessage') );
  
  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'header_ca_background', array(
	'label'      => 'Header Background Image',
	'section'    => 'caweb_page_header',
	'settings'   => 'header_ca_background',
    'active_callback' => 'caweb_customizer_v4_option'
		) ) );
  
  // Google
   $wp_customize->add_section('caweb_google', array(
    														'title' => 'Google',
  															'priority'   => 30,
  															'panel' => 'caweb_options') );
  
   $wp_customize->add_setting('ca_google_search_id', array(
    														'type' => 'option',
  															'default' => get_option('ca_google_search_id', ''),
  															'transport' => 'postMessage') );
  
   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'ca_google_search_id', array(
	'label'      => 'Search Engine ID',
  'type' => 'text',
	'section'    => 'caweb_google',
	'settings'   => 'ca_google_search_id'
		) ) );
  
  $wp_customize->add_setting('ca_google_analytic_id', array(
    														'type' => 'option',
  															'default' => get_option('ca_google_analytic_id', '') ,
  															'transport' => 'postMessage') );
  
   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'ca_google_analytic_id', array(
	'label'      => 'Analytics ID',
  'type' => 'text',
	'section'    => 'caweb_google',
	'settings'   => 'ca_google_analytic_id'
		) ) );
  
  $wp_customize->add_setting('ca_google_meta_id', array(
    														'type' => 'option',
  															'default' => get_option('ca_google_meta_id', '') ,
  															'transport' => 'postMessage') );
  
   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'ca_google_meta_id', array(
	'label'      => 'Meta ID',
  'type' => 'text',
	'section'    => 'caweb_google',
	'settings'   => 'ca_google_meta_id'
		) ) );
  
   $wp_customize->add_setting('ca_google_trans_enabled', array(
    														'type' => 'option',
  															'default' => get_option('ca_google_trans_enabled'),   
    														'sanitize_callback' => 'caweb_sanitize_customizer_checkbox') );
  
   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'ca_google_trans_enabled', array(
	'label'      => 'Enable Google Translate',
  'type' => 'checkbox',
	'section'    => 'caweb_google',
	'settings'   => 'ca_google_trans_enabled'
		) ) );
  
  // Social Media Links
   $wp_customize->add_section('caweb_social_media', array(
    														'title' => 'Social Media Links',
  															'priority'   => 30,
  															'panel' => 'caweb_options') );
  
  $social_options = get_ca_social_options();
  
  foreach( $social_options as $social => $option){
    $wp_customize->add_setting($option, array(
    														'type' => 'option',
  															'default' => get_option($option, '') ) );
    
     $wp_customize->add_control( new WP_Customize_Control( $wp_customize, $option, array(
          'label'      => $social,
          'type' => 'text',
          'section'    => 'caweb_social_media',
          'settings'   => $option
            ) ) );
    
    $wp_customize->add_setting(sprintf('%1$s_header',  $option), array(
    														'type' => 'option',
  															'default' => get_option(sprintf('%1$s_header',  $option)),    
    														'sanitize_callback' => 'caweb_sanitize_customizer_checkbox') );
    
     $wp_customize->add_control( new WP_Customize_Control( $wp_customize, sprintf('%1$s_header',  $option), array(
          'label'      => 'Show in Header',
          'type' => 'checkbox',
          'section'    => 'caweb_social_media',
          'settings'   => sprintf('%1$s_header',  $option),
    			'active_callback' => 'caweb_customizer_v5_option'
            ) ) );
    
    $wp_customize->add_setting(sprintf('%1$s_footer',  $option), array(
    														'type' => 'option',
  															'default' => get_option(sprintf('%1$s_footer',  $option)),
    														'sanitize_callback' => 'caweb_sanitize_customizer_checkbox' ) );
    
       $wp_customize->add_control( new WP_Customize_Control( $wp_customize, sprintf('%1$s_footer',  $option), array(
        'label'      => 'Show in Footer',
        'type' => 'checkbox',
        'section'    => 'caweb_social_media',
        'settings'   => sprintf('%1$s_footer',  $option)
          ) ) );

    if( 'ca_social_email' !== $option){
    $wp_customize->add_setting(sprintf('%1$s_new_window',  $option), array(
    														'type' => 'option',
  															'default' => get_option(sprintf('%1$s_new_window',  $option)),
    														'sanitize_callback' => 'caweb_sanitize_customizer_checkbox' ) );
    
       $wp_customize->add_control( new WP_Customize_Control( $wp_customize, sprintf('%1$s_new_window',  $option), array(
        'label'      => 'Open in New Tab',
        'type' => 'checkbox',
        'section'    => 'caweb_social_media',
        'settings'   => sprintf('%1$s_new_window',  $option)
          ) ) );
    
  	}
}
  
  // Custom CSS
  $wp_customize->add_section('caweb_custom_css', array(
    														'title' => 'Custom CSS',
  															'priority'   => 30,
  															'panel' => 'caweb_options') );
  
   $wp_customize->add_setting('ca_custom_css', array(
    														'type' => 'option',
  															'default' => get_option('ca_custom_css') ) );
    
     $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'ca_custom_css', array(
          'label'      => 'CSS',
          'type' => 'textarea',
          'section'    => 'caweb_custom_css',
          'settings'   => 'ca_custom_css'
            ) ) );
  
  add_filter( 'sanitize_option_ca_custom_css', 'caweb_sanitize_option_ca_custom_css', 10, 2 );
    

}
add_action( 'customize_register', 'caweb_customize_register' );

function caweb_sanitize_option_ca_custom_css($value, $option){  
  return addslashes($value);
}

function caweb_customize_controls_print_styles(){
  print '<style>#customize-control-ca_site_version #_customize-input-ca_site_version option:checked:first-child + 
#customize-control-ca_site_color_scheme #_customize-input-ca_site_color_scheme option:first-child { color: blue; }</style>';

}
add_action('customize_controls_print_styles', 'caweb_customize_controls_print_styles');

?>