<?php
/**
* Fired when the plugin is uninstalled.
*
* @package FrontPage Slider
* @author Milkan Trninic <milkan2002@gmail.com>
* @license GPL-2.0+
* @link https://profiles.wordpress.org/milkan2002/
* @copyright 2021, milkan2002@gmail.com
*/

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {	exit;}
global $wpdb;

$swiper_slide = get_posts( array( 'post_type' => 'fp_images', 'numberposts' => -1 ) );
foreach( $swiper_slide as $slides ) {
	wp_delete_post( $slides->ID, true );
}
