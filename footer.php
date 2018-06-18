<!-- Global Footer -->
<?php
wp_nav_menu(array(
    'theme_location'=> 'footer-menu',
    'version' => caweb_get_version(get_the_ID())
)
					);

wp_footer();

if ( ! is_404()) :
?>

<script> window.et_pb_smooth_scroll=function(b,c,d,e){var a=$(window).width();$("header").hasClass("fixed")&&a>768?$menu_offset=$("#header").outerHeight()-1:$menu_offset=-1,$("#wpadminbar").length&&a>600&&($menu_offset+=$("#wpadminbar").outerHeight()),$scroll_position=c?0:b.offset().top-$menu_offset,void 0===e&&(e="swing");if($scroll_position<220){$scroll_position-=36}$("html, body").animate({scrollTop:$scroll_position},d,e)};</script>

<?php endif; ?>

<?php if (is_tag() || is_archive() || is_category() || is_author()) : ?>
  <script>
    jQuery(document).ready(function(){var c=document.getElementsByTagName("main")[0].getElementsByTagName("article");var d=false;for(var b=0,a=c.length;b<a;b++){if(c[b].classList.contains("has-post-thumbnail")){d=true}}if(d){for(var b=0,a=c.length;b<a;b++){if(!c[b].classList.contains("has-post-thumbnail")){c[b].getElementsByTagName("a")[0].setAttribute("style","width:200px;height:150px;padding-right:20px;padding-bottom:15px;float:left;")}}}});    	
  </script>

<?php endif; ?>