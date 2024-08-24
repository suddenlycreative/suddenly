<?php
/*
Plugin Name: Masterlayer Addons for Elementor
Plugin URI: https://ninzio.com/
Description: Premium quality widgets for use in Elementor page builder.
Version: 1.0
Author: Masterlayer
Author URI: https://ninzio.com/
Text Domain: masterlayer
Domain Path: /languages
License: GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.txt
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Definitions
define( 'MAE_FILE', __FILE__ );
define( 'MAE_URL', plugins_url( '/', __FILE__ ) );
define( 'MAE_PATH', plugin_dir_path( __FILE__ ) );
define( 'MAE_WIDGET_URL', plugin_dir_url( __FILE__ ) . 'includes/widgets/' );
define( 'MAE_WIDGET_PATH', plugin_dir_path( __FILE__ ) . 'includes/widgets/' );

// Load main class
require_once MAE_PATH . 'loader.php';

// WordPress Widgets
require_once __DIR__ . '/includes/wp-widgets/init.php';



