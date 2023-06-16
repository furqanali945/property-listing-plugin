<?php
/**
* @package w_a_p_l
* @version 1.0
*/
/*
Plugin Name: Ultimate Property lisitng
Plugin URI: #
Description: Ultimate property listing
Version: 1.0
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: ul_pro
Author URI: #
*/


define('ULPROURL', dirname(__FILE__));
define('ULPROASSETS', plugins_url('/ultimate-property-listing/assets/'));

$plugin = plugin_basename(__FILE__);
define('ULMAINPATH', $dir = plugin_dir_path( __FILE__ ));
define('ULMAINURL', plugin_dir_url($plugin));


// Admin Code
require_once ULPROURL.'/inc/admin/admin.php';
require ULPROURL.'/inc/admin/ul_custom_taxonomy.php';
require ULPROURL.'/inc/admin/ul_custom_fiels.php';
require ULPROURL.'/inc/admin/ul_shortcodes.php';
require ULPROURL.'/inc/admin/ul_ajax.php';



// Public Code
require_once ULPROURL.'/inc/public/public.php';



// get options custom
if (!function_exists('ul_pro_get_option')) {
	function ul_pro_get_option($key='') {
		if ($key == '') {
			return;
		}
		$woo_settings = array(
			// 'text-count' => 75,
			// 'productcolm' => 'col-md-6',
			// 'popupbtn' => '[...]',
			// 'woo-popup' => 'red',
			'ul_currency' => 'AED',
			'googleapi' => 'AIzaSyDDJS7wVeKbFe74xYOd4dd0MrfyMEFjo6A',
			'columncontent' => '
					<div class="col-md-3 style1">
						<div class="propertythumb"><a href="{$link}"><img src="{$img}" alt=""></a></div>
						<div class="properties_info">
							<h2>{$title}</h2>
							<p>{$address}</p>
							<h3>${$price}</h3>
							<a href="{$link}">Read More</a>
						</div>
					</div>	
			'
			);
		if ( get_option($key) != '' ) {
			return get_option($key);
		} else {
			return $woo_settings[$key];
		}
	}
}

add_post_type_support( 'page', 'excerpt' );



function custom_posts_per_page( $query ) {

if ( $query->is_archive('developer') ) {
    set_query_var('posts_per_page', -1);
}
if ( $query->is_archive('development') ) {
    set_query_var('posts_per_page', -1);
}
}
add_action( 'pre_get_posts', 'custom_posts_per_page' );


