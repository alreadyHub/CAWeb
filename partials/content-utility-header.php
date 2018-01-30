<div class="utility-header ">
    <div class="container ca_wp_container">
            <div class="half">
              <a href="http://www.ca.gov/"  title="CA.gov"style="float: left;"><img style="height: 32px;" src="<?php echo get_stylesheet_directory_uri();?>/images/system/logo.svg" alt="Image of the CA.gov Logo"/></a>
                <ul class="utility-links social-media-links">
					<?php 

							if( get_option('ca_utility_home_icon', true) )
                  print '<li class="utility-home-icon"><a href="/" title="Home" ><span class="ca-gov-icon-home"></span><span class="sr-only">Home</span></a></li>';

                  $social_share = get_ca_social_options();
                
                  foreach($social_share as $opt){
                    	$share_email = 'ca_social_email' === $opt ? true : false;
                    	$mailto = $share_email ? esc_attr( sprintf('mailto:?subject=%1$s | %2$s&body=%3$s',  get_the_title(), get_bloginfo('name') , get_permalink() ) ) : '';
                    
                      if( get_option($opt .'_header') && ( $share_email || "" !== get_option($opt) ) ){
                            $share = substr($opt, 10);
                            $share =  str_replace("_", "-", $share);
                          
                      			
                      		printf('<li class="utility-social-%1$s"><a href="%2$s" title="Share via %3$s" %4$s ><span class="ca-gov-icon-%1$s hidden-print"></span><span class="sr-only">%3$s</span></a></li>', 
                             $share, ( $share_email ? $mailto : get_option($opt) ),  ucwords($share), ( get_option($opt . '_new_window') ? 'target="_blank"' : '') );
          						}
            	}
            ?>
                </ul>
            </div>
            <div class="half settings-links hidden-print">
                <ul class="utility-links ">
                  
					<?php 
					  for($i = 1; $i < 4; $i++){
							$url = get_option(sprintf('ca_utility_link_%1$s', $i));
							$p = "/<script>[\S\s]*<\/script>|<style>[\S\s]*<\/style>/";
							$text =  get_option( sprintf('ca_utility_link_%1$s_name', $i));
							$target = get_option( sprintf('ca_utility_link_%1$s_new_window', $i)) ? ' target="_blank"' : '';

						if ( !empty($url)  &&  !empty($text)  ){
									printf('<li class="utility-custom-%1$s"><a href="%2$s"%3$s>%4$s</a></li>', $i, $url, $target, $text);
						}
					  }
					?>
                  <?php if( "" !== get_option('ca_contact_us_link') ): ?>
                    <li class="utility-contact-us"><a href="<?php echo get_option('ca_contact_us_link') ; ?>">Contact Us</a></li>
                  <?php endif; ?> 
                  
                  <li class="utility-settings"><a role="button" data-toggle="collapse" data-target="#siteSettings"  aria-expanded="false" aria-controls="siteSettings" >Settings</a></li>

                  <?php if( get_option('ca_geo_locator_enabled') ): ?>
                  <li class="utility-geo-locator"><a role="button" aria-expanded="false" aria-controls="locationSettings" class="geo-lookup"><span class="ca-gov-icon-compass" aria-hidden="true"></span > <span class="located-city-name"></span></a></li>
                    <?php endif; ?>
                  <?php if( get_option('ca_google_trans_enabled') ): ?>
                        <li class="utility-g-translate"><div id="google_translate_element"><div class="skiptranslate goog-te-gadget" dir="ltr"><div id=":0.targetLanguage" class="goog-te-gadget-simple" style="white-space: nowrap;"></div></div></div></li>
                  <?php endif; ?>
              </ul>
            </div>

    </div>
</div>