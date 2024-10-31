<?php 
/**
 * Plugin Name:       OVN Category List Widget for Elementor
 * Plugin URI:        https://outsourcingvn.com/
 * Description:       Show Category List or Custom Taxonomy List
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            OutsourcingVN
 * Author URI:        https://outsourcingvn.com/contact-us/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       ovn-category-list-widget-for-elementor
 * Domain Path:       /languages
 */


namespace CategoryList;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) exit; 

add_action( 'elementor/widgets/widgets_registered', function() {
	require_once('widget.php');

	$new_widget =	new CLWE_Category();

	Plugin::instance()->widgets_manager->register_widget_type( $new_widget );
});
