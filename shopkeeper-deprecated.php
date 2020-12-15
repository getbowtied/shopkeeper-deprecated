<?php

/**
 * Plugin Name:       		Shopkeeper Deprecated Features
 * Plugin URI:        		https://shopkeeper.wp-theme.design/
 * Description:       		Old features of Shopkeeper theme that are no longer used.
 * Version:           		1.1.6
 * Author:            		GetBowtied
 * Author URI:				https://getbowtied.com
 * Text Domain:				shopkeeper-deprecated
 * Domain Path:				/languages/
 * Requires at least: 		5.0
 * Tested up to: 			5.6
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
require 'core/updater/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://raw.githubusercontent.com/getbowtied/shopkeeper-deprecated/master/core/updater/assets/plugin.json',
	__FILE__,
	'shopkeeper-deprecated'
);

add_action( 'after_setup_theme', function() {

    // Shopkeeper Dependent Components
    if( function_exists('shopkeeper_theme_slug') ) {
        include_once( dirname(__FILE__) . '/includes/shortcodes/icon-box.php');

        if ( defined(  'WPB_VC_VERSION' ) ) {

            // Icon Box VC Element
            include_once( dirname(__FILE__) . '/includes/shortcodes/vc/icon-box.php');

            // Modify and remove existing shortcodes from VC
            include_once( dirname(__FILE__) . '/includes/wpbakery/custom_vc.php');

            // VC Templates
            $vc_templates_dir = dirname(__FILE__) . '/includes/wpbakery/vc_templates/';
            vc_set_shortcodes_templates_dir($vc_templates_dir);
        }
    }

} );
