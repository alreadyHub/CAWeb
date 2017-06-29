<?php
/*
	Sources
	https://github.com/WordPress/WordPress/blob/master/wp-admin/update.php
	https://github.com/WordPress/WordPress/blob/master/wp-admin/includes/class-theme-upgrader.php
	https://github.com/WordPress/WordPress/blob/master/wp-admin/includes/class-wp-upgrader.php
*/
if(!class_exists('Theme_Upgrader') ){
      /** Theme_Upgrader class */
    	require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
      /** Theme_Upgrader class */
    	require_once ABSPATH . 'wp-admin/includes/class-theme-upgrader.php';
    
    
}
function ca_admin_theme_update_init(){
	global $caweb_core_updates;

  $theme = wp_get_theme();
  $theme->branch = '';
  $theme->definitionId = 10;
  
	$caweb_core_updates = new caweb_auto_update ($theme);

}

add_action('admin_init', 'ca_admin_theme_update_init');

final class caweb_auto_update{
			/**
			* The Themes current version
			* @var string
			*/
			protected $current_version;

			/**
			* The CAWeb TFS API Variables
			*
			*/
			protected $transient_name = 'caweb_update_themes';
			protected $token = '4x2v2actzu5tg74ds3io6h5mbvb2fsyl455lfqd42it7gdeh55ga';
			protected $update_path = 'https://cawebpublishing.visualstudio.com/DefaultCollection/CAWeb/_apis/git/repositories/CAWeb/items?';
			protected $branch ;
			protected $definitionId;
			protected $ver = 'api-version=2.0';
	 		protected $args ;
			/**
			* Theme Name
			*/
			protected $theme_name;

			private static $_this;

			/**
			* Initialize a new instance of the WordPress Auto-Update class
			* @param string $current_version
			* @param string $theme_name
			*/
			function __construct($theme){
			// Set the class public variables
			$this->current_version = $theme->Version;
			$this->theme_name = $theme->Name;
			$this->branch = $theme->branch;
			$this->definitionId = $theme->definitionId;
        
			$this->args = array(
										'headers' => array(
											'Authorization' => 'Basic ' . base64_encode( ':' . $this->token ),
											'Accept:' => 'application/zip'
										)
									);
			// define the alternative API for updating checking
				add_filter('pre_site_transient_update_themes', array($this, 'check_update'));

			// Define the alternative response for information checking
				add_filter('site_transient_update_themes', array($this, 'add_themes_to_update_notification'));


				//Define the alternative response for download_package which gets called during theme upgrade
				add_filter('upgrader_pre_download', array($this, 'download_package'), 10 , 3 );
				
			}

		// Alternative theme download for the WordPress Updater
		// https://github.com/WordPress/WordPress/blob/master/wp-admin/includes/class-wp-upgrader.php
		public function download_package( $reply, $package ,  $upgrader ){
			if(isset($upgrader->skin->theme_info) && $upgrader->skin->theme_info->get('Name') == $this->theme_name){

				$theme = wp_remote_retrieve_body( wp_remote_get( $package , array_merge($this->args, array('timeout' => 60 ) ) ) );
				// Now use the standard PHP file functions
				$fp = fopen(sprintf('%1$s/themes/%2$s.zip', WP_CONTENT_DIR, $this->theme_name)  , "w");
					fwrite($fp, $theme);
				fclose($fp);
				
				return sprintf('%1$s/themes/%2$s.zip', WP_CONTENT_DIR, $this->theme_name);
			}
			return $reply;
		}
	
		//alternative API for updating checking
		public function check_update($update_transient){
				$caweb_update_themes = get_site_transient( $this->transient_name );


				$last_update = new stdClass();

					// Get the remote version
					$remote_version = $this->getRemote_version();
				//
					// If a newer version is available, add the update
					if (version_compare($this->current_version, $remote_version, '<')   ) {

						$log = $this->getLatest_changelog();

						$obj = array();
						$obj['new_version'] = $remote_version;
						$obj['url'] = $log;
						$obj['package'] = $this->getLatest_version();
						$theme_response = array($this->theme_name => $obj);

						$last_update->response = (isset($caweb_update_themes->response) ? 
													$theme_response + $caweb_update_themes->response : 
													$theme_response);
													
						$last_update->last_checked = time();
						set_site_transient($this->transient_name, $last_update);
					}elseif( isset($caweb_update_themes->response[$this->theme_name]) ){
						unset($caweb_update_themes->response[$this->theme_name]);
						set_site_transient($this->transient_name, $caweb_update_themes);
					}
					

					return $update_transient;

		}

	// Add the CAWeb Update to List of Available Updated
	public function add_themes_to_update_notification( $update_transient){
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

	 /**
			* Return the current remote changelog
			* @return string $remote_version
			*/
			public function getLatest_changelog(){
        $url = sprintf('%1$sscopePath=changelog.txt&%2$s%3$s',
                       $this->update_path, (!empty($this->branch) ? sprintf('versionType=branch&version=%1$s&', $this->branch) : ''), $this->ver );
        
					$request = wp_remote_get($url , $this->args);
					if (!is_wp_error($request) || wp_remote_retrieve_response_code($request) === 200) {
							$tmp = wp_remote_retrieve_body($request) ;
								// Log location
								$f = CAWebAbsPath . '/core/changelog.txt';
								// Open the log file
								$log = fopen($f, 'c+');
								// Write message to log
								fwrite($log, $tmp);
								// Close the log file
								fclose( $log );
						return  CAWebUri . '/core/changelog.txt';
					}
				return CAWebUri . '/changelog.txt';
			}

			/**
			* Return the current remote version
			* @return string $remote_version
			*/
			public function getRemote_version(){
					$url = sprintf('%1$sscopePath=style.css&%2$s%3$s',
                       $this->update_path, (!empty($this->branch) ? sprintf('versionType=branch&version=%1$s&', $this->branch) : ''), $this->ver );
        
       		$request = wp_remote_get($url, $this->args);
					if (!is_wp_error($request) || wp_remote_retrieve_response_code($request) === 200) {
							$tmp = wp_remote_retrieve_body($request) ;
							preg_match('/Version:.*/', $tmp, $tmp);
							$tmp = explode(":", $tmp[0]);
							$tmp = trim($tmp[1]);
							return   $tmp;
					}
					return false;
			}

			/**
			* Return the remote latest build download url
			* @return string $remote_version
			*/
			public function getLatest_version(){
				global $wp_version;

				$url = sprintf('https://cawebpublishing.visualstudio.com/DefaultCollection/CAWeb/_apis/build/builds?api-version=2.0&definitions=%1$s&$top=1', $this->definitionId);

				$request = wp_remote_get($url , $this->args);

				if (!is_wp_error($request) || wp_remote_retrieve_response_code($request) === 200) {
						$tmp = json_decode(wp_remote_retrieve_body($request) ) ;
						if( empty($tmp->value) )
							return false;

						$artifact = sprintf('https://cawebpublishing.visualstudio.com/DefaultCollection/CAWeb/_apis/build/builds/%1$s/artifacts?api-version=2.0',$tmp->value[0]->id);
						$theme_request = wp_remote_request($artifact, $this->args);
						if(!is_wp_error($theme_request) || wp_remote_retrieve_response_code($theme_request) === 200 ){
							$res = json_decode(wp_remote_retrieve_body( $theme_request ) );
							if( !empty($res->value))
								return  $res->value[0]->resource->downloadUrl;

						}
					}
					return false;
			}
}

?>
