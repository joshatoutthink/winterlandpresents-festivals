<?php
/**
 * Plugin Name:Winterland Presents Festival Pages
 * Plugin URI: 
 * Description: Creates the slideshow, and Marque for the Festival Pages.
 * Version: 1.0
 * Author: Josh Kennedy
 * Author URI: 
 */

define('FESTIVAL_PAGES_CORE_PATH', plugin_dir_path(__FILE__));
define('FESTIVAL_PAGES_CORE_URL', plugin_dir_url(__FILE__));

 add_action('init', function(){
   require FESTIVAL_PAGES_CORE_PATH . '/classes/class-festival-pages-core.php';
 });
