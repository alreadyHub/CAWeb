<?php

// Administration Menu Setup
function caweb_admin_menu() {
    global $submenu;

    // Add CAWeb Options
    add_menu_page('CAWeb Options', 'CAWeb Options', 'manage_options', 'ca_options',
								'caweb_option_page', sprintf('%1$s/images/system/caweb_logo.png', CAWebUri), 6);
    add_submenu_page('ca_options', 'CAWeb Options', 'Settings', 'manage_options', 'ca_options', 'caweb_option_page');

    // Remove Menus and re-add it under the newly created CAWeb Options as Navigation
    remove_submenu_page('themes.php', 'nav-menus.php');
    add_submenu_page('ca_options', 'Navigation', 'Navigation', 'manage_options', 'nav-menus.php', '');

    // If user is not a Network Admin
    if (is_multisite() &&  ! current_user_can('manage_network_options')) {
        // Remove Themes and Background option under Appearance menu
		unset($submenu['themes.php'][5], $submenu['themes.php'][20], $submenu['themes.php'][21]); // Themes link
		 // Background link
		 // Background link

		// Remove WP-Forms Addons Menus
        remove_submenu_page('wpforms-overview', 'wpforms-addons');

        // Removal of Tools Submenu Pages
        remove_submenu_page('tools.php', 'tools.php');
        remove_submenu_page('tools.php', 'import.php');
        remove_submenu_page('tools.php', 'ms-delete-site.php');
        remove_submenu_page('tools.php', 'domainmapping');

        // Removal of Divi Submenu Pages
        remove_submenu_page('et_divi_options', 'et_divi_options');
        remove_submenu_page('et_divi_options', 'customize.php?et_customizer_option_set=theme');
        remove_submenu_page('et_divi_options', 'customize.php?et_customizer_option_set=module');
        remove_submenu_page('et_divi_options', 'et_divi_role_editor');
    }

    if (( ! is_multisite() || current_user_can('manage_network_options')) && 1 == get_current_blog_id()) {
        add_submenu_page('ca_options', 'CAWeb Options', 'GitHub API Key', 'manage_options', 'caweb_api', 'caweb_api_menu_option_setup');
        add_submenu_page('ca_options', 'CAWeb Options', 'Multisite GA', 'manage_options', 'caweb_multi_ga', 'caweb_multi_ga_menu_option_setup');
    }
}
add_action('admin_menu', 'caweb_admin_menu', 15);

// If direct access to certain menus is accessed
// redirect to admin page
function caweb_load_themes_tools() {
    $plugin_menus = array('404pagesettings');

    $allowed = isset($_GET['page']) && in_array($_GET['page'], $plugin_menus);

    if ($allowed || (is_multisite() && ! current_user_can('manage_network_options'))) {
        wp_redirect(get_admin_url());
        exit;
    }
}
add_action('load-themes.php', 'caweb_load_themes_tools');
add_action('load-tools.php', 'caweb_load_themes_tools');

// Setup CAWeb Options Menu
function caweb_option_page() {

	// The actual menu file
    get_template_part('partials/content', 'options');
}

function caweb_rrmdir($path) {
    if (file_exists($path)) {
        // Remove a dir (all files and folders in it)
        $i = new DirectoryIterator($path);
        foreach ($i as $f) {
            if ($f->isFile()) {
                unlink($f->getRealPath());
            } elseif ( ! $f->isDot() && $f->isDir()) {
                rrmdir($f->getRealPath());
                rmdir($f->getRealPath());
            }
        }
    }
}

function caweb_save_options($values = array(), $files = array()) {
    $site_options =  caweb_get_site_options();
    $site_id = get_current_blog_id();
    $ext_css_dir = sprintf('%1$s/css/external', CAWebAbsPath);
    $ext_site_css_dir = sprintf('%1$s/css/external/%2$d/', CAWebAbsPath, $site_id);

    // Remove unneeded values
    unset($values['tab_selected'], $values['caweb_options_submit']);

    // if site option isn't set, set it to empty string
    foreach ($site_options as $opt) {
        if ( ! array_key_exists($opt, $values)) {
            $values[$opt] = '';
        }

        if (empty($values[$opt]) && 'caweb_external_css' == $opt) {
            $values[$opt] = array();
        }
    }

    // External CSS Upload
    $file_upload =  array();
    // If no files and all previously upload styles are removed
    // delete the entire site external directory path
    if (empty($files) && empty($values['caweb_external_css'])) {
        caweb_rrmdir($ext_site_css_dir);
        if (file_exists($ext_site_css_dir)) {
            rmdir($ext_site_css_dir);
        }

        // files are being uploaded
    } elseif ( ! empty($files)) {
        // create the external directory if its never been created
        if ( ! file_exists($ext_css_dir)) {
            mkdir($ext_css_dir);
        }
        // create the external site directory if its never been created
        if ( ! file_exists($ext_site_css_dir)) {
            mkdir($ext_site_css_dir);
        }

        foreach ($files as $key => $data) {
            if ( ! empty($data["name"]) && ! empty($data["tmp_name"])) {
                $target_file = $ext_site_css_dir.basename($data["name"]);

                move_uploaded_file($data["tmp_name"], $target_file);
                $file_upload[] = $data["name"];
            }
        }
    }

    // Previous Uploaded Style Check
    $current_uploaded_styles = get_option('caweb_external_css', array());
    foreach ($current_uploaded_styles as $filename) {
        // if the file exists, and the file is no longer in the upload list and
        // a file with the same hasn't overwritten it then remove it
        if (file_exists($ext_site_css_dir.$filename) &&
			! in_array($filename, $values['caweb_external_css']) &&
			! in_array($filename, $file_upload)) {
            unlink($ext_site_css_dir.$filename);
        }
    }

    // Save CAWeb Options
    foreach ($values as $opt => $val) {
        if ("on" == $val) {
            $val = true;
        }

        if ('caweb_external_css' == $opt) {
            $val = array_merge($val, array_diff($file_upload, $val));
        }

        update_option($opt, $val);
    }

    print '<div class="updated notice is-dismissible"><p><strong>CAWeb Options</strong> have been updated.</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';
}
// Setup CAWeb API Menu
function caweb_api_menu_option_setup() {
    ?>
<style>table tr td:first-of-type {width: 15px;}</style>

<form id="ca-options-form" action="<?= admin_url('admin.php?page=caweb_api'); ?>" method="POST">
  <?php
  if (isset($_POST['caweb_api_options_submit'])) {
      caweb_save_api_options($_POST);
  } ?>
<div class="wrap">
  <h1>GitHub API Key</h1>
  <table class="form-table">
    <tr><td>
        <div class="tooltip">Username<span class="tooltiptext">Setting this feature enables us to update the theme through GitHub</span></div></td>
      		<td><input type="text" name="caweb_username" size="50" value="<?php print get_site_option('caweb_username', ''); ?>" /></td></tr>
      <tr><td>
        <div class="tooltip">Token<span class="tooltiptext">Setting this feature enables us to update the theme through GitHub</span></div></td>
  				<td><input type="password" name="caweb_password" size="50" value="<?php print base64_encode(get_site_option('caweb_password', '')); ?>" /></td></tr>
  </table>
  </div>
  <input type="submit" name="caweb_api_options_submit" id="submit" class="button button-primary" value="<?php _e('Save Changes') ?>" />
 </form>

<?php
}
// Save API Values
function caweb_save_api_options($values = array()) {
    update_site_option('caweb_username', $values['caweb_username']);
    update_site_option('caweb_password', $values['caweb_password']);

    print '<div class="updated notice is-dismissible"><p><strong>API Key</strong> has been updated.</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';
}

function caweb_pre_update_site_option_caweb_password($value, $old_value, $option) {
    $pwd = $value;

    if (base64_decode($value) == $old_value) {
        $pwd = $old_value;
    }

    return $pwd;
}
add_action('pre_update_site_option_caweb_password', 'caweb_pre_update_site_option_caweb_password', 10, 3);

// Setup Multisite Google Analytics Menu
function caweb_multi_ga_menu_option_setup() {
    ?>
<style>table tr td:first-of-type {width: 100px;}</style>

<form id="ca-options-form" action="<?= admin_url('admin.php?page=caweb_multi_ga'); ?>" method="POST">
  <?php
  if (isset($_POST['caweb_multi_ga_options_submit'])) {
      caweb_save_multi_ga_options($_POST);
  } ?>
<div class="wrap">
  <h1>Multisite Google Analytics</h1>
  <table class="form-table">
    <tr><td>
        <div class="tooltip">Analytics ID<span class="tooltiptext"></span></div></td>
      		<td><input type="text" name="caweb_multi_ga" size="50" value="<?php print get_site_option('caweb_multi_ga', ''); ?>" /></td></tr>
  </table>
  </div>
  <input type="submit" name="caweb_multi_ga_options_submit" id="submit" class="button button-primary" value="<?php _e('Save Changes') ?>" />
 </form>

<?php
}
// Save Multisite GA Values
function caweb_save_multi_ga_options($values = array()) {
    update_site_option('caweb_multi_ga', $values['caweb_multi_ga']);

    print '<div class="updated notice is-dismissible"><p><strong>Multisite Google Analytics ID</strong> has been updated.</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';
}

function caweb_pre_update_option_ca_custom_css($value, $old_value, $option) {
    return stripcslashes($value);
}
add_action('pre_update_option_ca_custom_css', 'caweb_pre_update_option_ca_custom_css', 10, 3);

$social =  caweb_get_site_options('social');
$sanitized = caweb_get_site_options('sanitized');

$options = array_merge($social, $sanitized);

foreach ($options as $name) {
    add_action('pre_update_option_'.$name, 'caweb_sanitize_various_options', 10, 3);

    if (in_array($name, $sanitized)) {
        add_action('option_'.$name, 'caweb_retrieve_various_sanitized_options', 10, 3);
    }
}

// Sanitize certain CAWeb Options
function caweb_sanitize_various_options($value, $old_value, $option) {
    $p = "/<script>[\S\s]*<\/script>|<style>[\S\s]*<\/style>/";

    $social =  caweb_get_site_options('social');
    $sanitized = caweb_get_site_options('sanitized');

    $options = array_merge($social, $sanitized);

    // if fields contain a script or style remove it
    if (in_array($option, $options)) {
        $value = strip_tags(preg_replace($p, "", $value));
    }

    // if field is a url escape the url
    // $pattern = regex of fields to exclude
    $pattern = '/ca_utility_link_\d_name/';
    if (in_array($option, $options) &&
		empty(preg_match($pattern, $option))) {
        $value = esc_url($value);
    }

    /*
    	if field is a label replace all escape characters with something else to prevent WordPress escaping
    	single quote = caweb_apostrophe
    	backslash = caweb_backslash
     */
    if (in_array($option, $sanitized)) {
        $value = preg_replace('/\\\\\'/', 'caweb_apostrophe', $value);
        $value = preg_replace('/\\"/', 'caweb_double_quote', $value);
        $value = preg_replace('/\\\/', 'caweb_backslash', $value);
    }

    return $value;
}

// Retrieves certain CAWeb Options
function caweb_retrieve_various_sanitized_options($value) {
    $value = preg_replace("/caweb_apostrophe/", "&#39;", $value);
    $value = preg_replace("/caweb_backslashcaweb_double_quote/", '&#34;', $value);
    $value = preg_replace("/caweb_backslashcaweb_backslash/", "&#92;", $value);

    return $value;
}

// Returns and array of just the CA Site Options
function caweb_get_site_options($group = '', $special = false, $with_values = false) {
    $caweb_sanitized_options = array('ca_utility_link_1_name', 'ca_utility_link_2_name', 'ca_utility_link_3_name',
        'ca_contact_us_link', 'ca_utility_link_1', 'ca_utility_link_2', 'ca_utility_link_3'
    );

    $caweb_general_options = array('ca_fav_ico', 'ca_site_version', 'ca_default_navigation_menu', 'ca_menu_selector_enabled',
        'ca_site_color_scheme',	'ca_frontpage_search_enabled', 'ca_sticky_navigation',
        'ca_home_nav_link',	'ca_default_post_title_display', 'ca_default_post_date_display');

    $caweb_utility_header_options = array('ca_contact_us_link', 'ca_geo_locator_enabled', 'ca_utility_home_icon',
        'ca_utility_link_1', 'ca_utility_link_1_name', 'ca_utility_link_1_new_window',
        'ca_utility_link_2', 'ca_utility_link_2_name', 'ca_utility_link_2_new_window',
        'ca_utility_link_3',   'ca_utility_link_3_name', 'ca_utility_link_3_new_window',
    );

    $caweb_page_header_options = array('header_ca_branding', 'header_ca_branding_alignment', 'header_ca_background');

    $caweb_google_options = array('ca_google_search_id', 'ca_google_analytic_id',
        'ca_google_meta_id', 'ca_google_trans_enabled');

    $caweb_social_options = array('Facebook' => 'ca_social_facebook', 'Twitter' => 'ca_social_twitter',
        'Google Plus' =>  'ca_social_google_plus', 'Email' => 'ca_social_email',
        'Flickr' => 'ca_social_flickr', 'Pinterest' => 'ca_social_pinterest',
        'YouTube' => 'ca_social_youtube', 'Instagram' => 'ca_social_instagram',
        'LinkedIn' => 'ca_social_linkedin', 'RSS' => 'ca_social_rss');

    $caweb_social_extra_options = array();

    foreach ($caweb_social_options as $social) {
        $caweb_social_extra_options[] = $social.'_header';
        $caweb_social_extra_options[] = $social.'_footer';
        if ('ca_social_email' !== $social) {
            $caweb_social_extra_options[] = $social.'_new_window';
        }
    }

    $caweb_misc_options = array('caweb_external_css', 'ca_custom_css');

    $caweb_special_options = array('caweb_username', 'caweb_password', 'caweb_multi_ga');

    switch ($group) {
		case 'general':
			$output = $caweb_general_options;

			break;
		case 'utility_header':
			$output = $caweb_utility_header_options;

			break;
		case 'page_header':
			$output = $caweb_page_header_options;

			break;
		case 'google':
			$output = $caweb_google_options;

			break;
		case 'social':
			$output = $caweb_social_options;

			break;
		case 'social-extra':
			$output = $caweb_social_extra_options;

			break;
		case 'social-all':
			$output = array_merge($caweb_social_options, $caweb_social_extra_options);

			break;
		case 'misc':
			$output = $caweb_misc_options;

			break;
		case 'special':
			$output = $caweb_special_options;

			break;
		case 'sanitized':
			$output = $caweb_sanitized_options;

			break;
		default:
			$output = array_merge($caweb_general_options, $caweb_utility_header_options, $caweb_page_header_options,
							$caweb_google_options, $caweb_social_options, $caweb_social_extra_options, $caweb_misc_options);

			break;
	}

    if ($special) {
        array_merge($output, $caweb_special_options);
    }

    return $output;
}

/*
	Check the Binary Signature of a file
	currently only checking for icon

	Living Standard on Mime Sniffing
	https://mimesniff.spec.whatwg.org/#image-type-pattern-matching-algorithm

	File checker
	http://asecuritysite.com/forensics/ico
 */
function caweb_fav_icon_checker() {
    $url = $_POST['icon_url'];

    $handle = rawurlencode(file_get_contents($url));
    $handle = array_splice(array_filter(explode('%', $handle)), 0, 4);
    $handle = implode("", $handle);

    if ("00000100" == $handle) {
        print true;
    }

    print false;
    wp_die(); // this is required to terminate immediately and return a proper response
}
add_action('wp_ajax_caweb_fav_icon_check', 'caweb_fav_icon_checker');

function caweb_default_favicon_url() {
    return  esc_url("https://raw.githubusercontent.com/CAWebPublishing/CAWeb/master/images/system/favicon.ico?token=AXMXyfCXumpiUhi-6nEG4zAj65rhy_aGks5aVQ2TwA==");
}

function caweb_favicon_name() {
    $option = get_option('ca_fav_ico', caweb_default_favicon_url());

    return preg_replace('/(.*\.ico)(.*)/', '$1', substr($option, strrpos($option, '/') + 1));
}
?>
