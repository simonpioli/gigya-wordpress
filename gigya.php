<?php
/*
Plugin Name: Make Your Site Social
Plugin URI: http://wiki.gigya.com/050_Socialize_Plugins/030_Wordpress_Plugin
DDescription: Increase Registration and Engagement by integrating the Gigya service into your WordPress self hosted blog.
Author: Gil Noy for Gigya
Version: 2.0.2
Author URI: http://www.gigya.com
*/
define("GIGYA_VERSION","2.0.1");
define("GIGYA_SETTINGS_PREFIX","gigya_settings_fields");
define("GIGYA_PERMISSION_LEVEL","manage_options");
define("GIGYA_PLUGIN_URL",WP_PLUGIN_URL.'/'.basename(dirname(__FILE__)));
define("GIGYA_PLUGIN_PATH",WP_PLUGIN_DIR.'/'.basename(dirname(__FILE__)));

require_once(dirname(__FILE__).'/resources/core.php');
require_once(dirname(__FILE__).'/resources/user.php');
require_once(dirname(__FILE__).'/resources/util.php');
require_once(dirname(__FILE__).'/resources/msg.php');
require_once(dirname(__FILE__).'/widget.php');
require_once(dirname(__FILE__).'/resources/handlers.php');

if(!function_exists('gigya_admin_menu') ) :
	function gigya_admin_menu() {
		/* Register plugin plugin page */
		//add_options_page('My Plugin Options', 'Gigya', 'manage_options', 'gigya', 'my_plugin_options');
		/* Attach gigya settings page to setting admin menu */
		$page = add_submenu_page('options-general.php',
			__( 'Gigya','gigya'),
			__( 'Gigya', 'gigya' ),
			"manage_options",
			__FILE__,
			'gigya_manage_menu');
			//add_action('admin_print_scripts-'. $page, 'gigya_admin_script');
			//add_action('admin_print_styles-'.page, 'gigya_admin_style');
	}
endif;

if(!function_exists('gigya_admin_init')) :
	function gigya_admin_init(){
		register_setting('gigya_settings_fields',GIGYA_SETTINGS_PREFIX);	
	}
endif;

if(!function_exists('gigya_manage_menu')) :
	function gigya_manage_menu() {
		include("admin/settings.php");
	}
endif;

if(!function_exists('gigya_admin_styles') ) :
	function gigya_admin_styles() {
		/*
		 * It will be called only on your plugin admin page, enqueue our script here
		 */
		//wp_enqueue_script( 'myPluginScript' );
	}
endif;

if(!function_exists('gigya_login_page') ) :
	function gigya_login_page() {
		include("login.php");    
	}
endif;


add_action('init','gigya_init_options');
add_action('admin_init','gigya_admin_init');
add_action('admin_menu','gigya_admin_menu' );
add_action('login_head','gigya_login_page');
add_action('wp_ajax_gigya_user_login', 'gigya_user_login');
add_action('wp_ajax_nopriv_gigya_user_login', 'gigya_user_login');
add_action('wp_ajax_gigya_user_login','gigya_user_login');
add_action('wp_login','gigya_notify_user_login');
add_action('wp_logout','gigya_notify_user_logout');
add_action('delete_user','gigya_delete_account');
add_action('edit_user_profile','gigya_user_profile_extra' );
add_action('show_user_profile','gigya_user_profile_extra' );
add_filter('get_avatar','gigya_update_avatar_image',10,5);
add_action('widgets_init', create_function('', 'return register_widget("WP_Widget_Gigya");'));
add_filter('the_content','gigya_share_plugin');