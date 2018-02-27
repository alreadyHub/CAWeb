<?php
/*
	Sources
	https://github.com/WordPress/WordPress/blob/master/wp-admin/update.php
	https://github.com/WordPress/WordPress/blob/master/wp-admin/includes/class-theme-upgrader.php
	https://github.com/WordPress/WordPress/blob/master/wp-admin/includes/class-wp-upgrader.php
*/

final class caweb_auto_update{
			protected $transient_name = 'caweb_update_themes';
			protected $divi_transient_name = 'et_update_themes';
			protected $user;

			/**
			* Theme Name
			*/

			protected $theme_name;
			protected $current_version;

			private static $_this;

			/**
			* Initialize a new instance of the WordPress Auto-Update class
			* @param string $current_version
			* @param string $theme_name
			*/
			function __construct($theme) {
			// Set the class public variables
      $this->user = get_site_option('caweb_username', '');
			$this->theme_name = $theme->Name;
			$this->current_version = $theme->Version;

			$this->args = array(
										'headers' => array(
											'Authorization' => 'Basic ' . base64_encode( ':' . get_site_option('caweb_password', '') ),
											'Accept:' =>  'application/vnd.github.v3+json','application/vnd.github.VERSION.raw', 'application/octet-stream'
										)
									);

				add_action('admin_post_nopriv_caweb_update_available', array($this, 'caweb_update_available') );
				add_action('admin_post_caweb_update_available', array($this, 'caweb_update_available') );

			// define the alternative API for updating checking
        add_filter('pre_site_transient_update_themes', array($this, 'check_update'));

			// Define the alternative response for information checking
				add_filter('site_transient_update_themes', array($this, 'add_themes_to_update_notification'));

				//Define the alternative response for download_package which gets called during theme upgrade
				add_filter('upgrader_pre_download', array($this, 'caweb_upgrader_pre_download'), 10, 3 );

				//Define the alternative response for upgrader_pre_install
				add_filter('upgrader_source_selection', array($this, 'caweb_upgrader_source_selection'), 10, 4 );

				//Define the alternative response for upgrader_pre_install
				add_filter('upgrader_post_install', array($this, 'caweb_upgrader_post_install'), 10, 3 );

			}

		//alternative API for updating checking
		public function check_update($update_transient) {

				$caweb_update_themes = get_site_transient( $this->transient_name );
				$divi_update_themes = get_site_transient( $this->divi_transient_name );

				$payload = json_decode( wp_remote_retrieve_body(
											wp_remote_get(sprintf('https://api.github.com/repos/%1$s/CAWeb/releases/latest', $this->user), $this->args) ) );

				if( ! isset($payload->tag_name) ){
					delete_site_transient( $this->transient_name );
					delete_site_transient( $this->divi_transient_name );
					return $update_transient;
				}
				if( ( ! isset($caweb_update_themes->response) ||  ! isset($caweb_update_themes->response[$this->theme_name]) ) &&
								$this->current_version < $payload->tag_name){

							$last_update = new stdClass();

							$obj = array();
							$obj['new_version'] = $payload->tag_name;

							$changelog = base64_decode( json_decode( wp_remote_retrieve_body(
													wp_remote_get( sprintf('%1$scontents/changelog.txt?ref=%2$s', substr($payload->url, 0, strpos($payload->url, 'releases') ), $payload->target_commitish), $this->args)) )->content );

							// Write message to log
							file_put_contents(sprintf('%1$s/changelog.txt', __DIR__), $changelog);

							$obj['url'] = get_stylesheet_directory_uri() . '/core/changelog.txt';
							$obj['package'] = $payload->zipball_url;

							$theme_response = array($this->theme_name => $obj);

							$last_update->response = (isset($caweb_update_themes->response) ?
																$theme_response + $caweb_update_themes->response :
																$theme_response);

							$last_update->last_checked = time();
							set_site_transient($this->transient_name, $last_update);

          		$payload = json_decode( wp_remote_retrieve_body(
                        wp_remote_get(sprintf('https://api.github.com/repos/%1$s/Divi/releases/latest', $this->user), $this->args) ) );

              if($payload->tag_name > wp_get_theme( 'Divi' )->version ){

                $changelog = base64_decode( json_decode( wp_remote_retrieve_body(
                            wp_remote_get( sprintf('%1$scontents/changelog.txt?ref=%2$s', substr($payload->url, 0, strpos($payload->url, 'releases') ), $payload->target_commitish), $this->args)) )->content );
                file_put_contents(sprintf('%1$s/divi_changelog.txt', __DIR__), $changelog);

                $divi_update_themes->checked['Divi'] = $payload->tag_name;

                $divi_update_themes->response['Divi']['new_version'] = $payload->tag_name;
                $divi_update_themes->response['Divi']['url'] = get_stylesheet_directory_uri() . '/core/divi_changelog.txt';
                $divi_update_themes->response['Divi']['package'] = $payload->zipball_url;
                $divi_update_themes->last_checked = $last_update->last_checked;
                set_site_transient($this->divi_transient_name, $divi_update_themes );
              }

				}elseif(  isset($caweb_update_themes->response, $caweb_update_themes->response[$this->theme_name])    &&
								$this->current_version >=  $payload->tag_name ) {

						delete_site_transient($this->transient_name);
						delete_site_transient($this->divi_transient_name);

        }elseif( empty($caweb_update_themes) ||  ! isset($caweb_update_themes->response[$this->theme_name])){

          	delete_site_transient( $this->divi_transient_name );
        }

				return $update_transient;

		}

	// Add the CAWeb Update to List of Available Updated
	public function add_themes_to_update_notification($update_transient) {
		$caweb_update_themes = get_site_transient( $this->transient_name );

		if ( ! is_object( $caweb_update_themes ) || ! isset( $caweb_update_themes->response ) ) {
			return $update_transient;
		}

		// Fix for warning messages on Dashboard / Updates page
		if ( ! is_object( $update_transient ) ) {
			$update_transient = new stdClass();
		}

		$update_transient->response = array_merge( ! empty( $update_transient->response ) ? $update_transient->response : array(), $caweb_update_themes->response );

		return $update_transient;
	}

		// Alternative upgrader_pre_download for the WordPress Updater
		// https://github.com/WordPress/WordPress/blob/master/wp-admin/includes/class-wp-upgrader.php
		public function caweb_upgrader_pre_download($reply, $package, $upgrader) {
      if( ! class_exists('Theme_Upgrader') ){
        /** Theme_Upgrader class */
        require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
        /** Theme_Upgrader class */
        require_once ABSPATH . 'wp-admin/includes/class-theme-upgrader.php';
			}

			if(isset($upgrader->skin->theme_info) && $upgrader->skin->theme_info->get('Name') == $this->theme_name){

				$theme = wp_remote_retrieve_body( wp_remote_get( $package, array_merge($this->args, array('timeout' => 60) ) ) );

				file_put_contents(sprintf('%1$s/themes/%2$s.zip', WP_CONTENT_DIR, $this->theme_name), $theme);

				// move any external site css if external css directory exists
				if( file_exists( sprintf('%1$s/css/external/', CAWebAbsPath) ) ){
					rename(sprintf('%1$s/css/external/', CAWebAbsPath),
						sprintf('%1$s/caweb_external_css/', wp_upload_dir()['basedir']));
				}
				return sprintf('%1$s/themes/%2$s.zip', WP_CONTENT_DIR, $this->theme_name);
			}
			return $reply;
		}

	// Alternative upgrader_source_selection for the WordPress Updater
	// https://github.com/WordPress/WordPress/blob/master/wp-admin/includes/class-wp-upgrader.php
	function caweb_upgrader_source_selection($src, $rm_src, $upgr, $options) {

		if( ! isset($options['theme']) || $options['theme'] !== $this->theme_name )
			return $src;

			$tmp = explode('/', $src);
			array_shift($tmp);
			array_pop($tmp);
			$tmp[count($tmp) -1] = $tmp[count($tmp) -2];
			$tmp = sprintf('/%1$s/', implode('/', $tmp) );

			rename($src, $tmp);

			return $tmp;
	}

	function caweb_upgrader_post_install($response, $hook_extra, $result) {
		// move any external site css existed move it back
		if( file_exists( sprintf('%1$s/caweb_external_css/', wp_upload_dir()['basedir']) ) ){
			rename(	sprintf('%1$s/caweb_external_css/', wp_upload_dir()['basedir']),
		 				sprintf('%1$s/css/external/', CAWebAbsPath) );
		}

	}
	function caweb_update_available() {
		if( isset( $_POST['payload'] ) ){
			$this->check_update(null);
		}
		exit();
	}

}

new caweb_auto_update(wp_get_theme());

?>
