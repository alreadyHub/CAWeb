<!-- Global Footer -->
<?php
wp_nav_menu(array(
						'theme_location'=> 'footer-menu',
						'version' => ca_get_version( get_the_ID() )
						)	
					);

wp_footer();

if("" !== get_option('ca_custom_css', '') ? printf('<style id="ca_custom_css">%1$s</style>',  get_option('ca_custom_css') ) : '')
  
if( !is_404() ) :
?>

<script> 
window.et_pb_smooth_scroll=function($target,$top_section,speed,easing){
                var $window_width=$(window).width();
                $("header").hasClass("fixed")&&$window_width>768?$menu_offset=$("#header").outerHeight()-1:$menu_offset=-1,
                $("#wpadminbar").length&&$window_width>600&&($menu_offset+=$("#wpadminbar").outerHeight()),
                $scroll_position=$top_section?0:$target.offset().top-$menu_offset,
                void 0===easing&&(easing="swing");
                if($scroll_position<220){ // scrollDistanceToMakeCompactHeader from cagov.core.js
                                $scroll_position-=36; // Height difference between normal and compact header
                }
                $("html, body").animate({scrollTop:$scroll_position},speed,easing);
}
</script>

<?php endif; ?>