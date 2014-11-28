<?php
/*
Plugin Name: Varys (Comment Moderation)
Plugin URI: http://alancole.io/varys
Description: The plugin adds some advanced comment moderation tools. Lord Varys hears everything!
Version: 0.0.1 (Alpha)
Author: Alan Cole
Author URI: http://alancole.io
*/

define('VARYS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

// Include our helpers
require_once(VARYS_PLUGIN_DIR . 'helpers/check-reasons.php');
require_once(VARYS_PLUGIN_DIR . 'helpers/get-reasons.php');

// Include our UI functions
require_once(VARYS_PLUGIN_DIR . 'ui/advanced-filter-menu.php');

// Register our filters and actions
add_filter('comment_row_actions' , 'get_reason' , '99', 2);
add_action('admin_menu', 'add_advanced_filter_menu');
