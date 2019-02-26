<?php

/**
 * Plugin Name:       		Shopkeeper Deprecated
 * Plugin URI:        		https://shopkeeper.wp-theme.design/
 * Description:       		Deprecated features of Shopkeeper
 * Version:           		1.0
 * Author:            		GetBowtied
 * Author URI:				https://getbowtied.com
 * Text Domain:				shopkeeper-deprecated
 * Domain Path:				/languages/
 * Requires at least: 		5.0
 * Tested up to: 			5.1
 *
 * @package  Shopkeeper Deprecated
 * @author   GetBowtied
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( ! function_exists( 'is_plugin_active' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

// Plugin Updater
// require 'core/updater/plugin-update-checker.php';
// $myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
// 	'https://raw.githubusercontent.com/getbowtied/shopkeeper-deprecated/master/core/updater/assets/plugin.json',
// 	__FILE__,
// 	'shopkeeper-deprecated'
// );

global $theme;
$theme = wp_get_theme();
if ( $theme->template == 'shopkeeper') {

	include_once('includes/shortcodes/icon-box.php');
	
	/******************************************************************************/
	/* Add Shortcodes to VC *******************************************************/
	/******************************************************************************/

	if ( defined(  'WPB_VC_VERSION' ) ) {
		
		add_action( 'init', 'getbowtied_visual_composer_deprecated_shortcodes' );
		function getbowtied_visual_composer_deprecated_shortcodes() {
			
			// Add new WP shortcodes to VC
			include_once('includes/shortcodes/vc/icon-box.php');
		}
	}
}
