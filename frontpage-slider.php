<?php
/**
 * @wordpress-plugin
 * Plugin Name:      	FrontPage Slider
 * Plugin URI:        	https://github.com/milkan-trn/frontpage-slider
 * Description:         FrontPage slider has predesignated templates that you can use inside your theme
 * Version:           	0.0.1
 * Requires at least: 	5.3
 * Requires PHP:      	7.3
 * Author:            	Milkan Trninic
 * Author URI:         	http://milkan2002.wordpress.com
 * Text Domain:       	frontpage-slider
 * License:           	GPLv2 or later
 * License URI:       	http://www.gnu.org/licenses/gpl-2.0.txt
 * GitHub Plugin URI: 	https://github.com/milkan-trn/frontpage-slider
 */
/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
*/
defined( 'ABSPATH' ) or die( 'Nothing Here!' );
 
if ( !class_exists( 'Frontpage_slider' ) ) { 

    class Frontpage_slider {
        public $plugin;
        function __construct() {
            $this->plugin = plugin_basename( __FILE__ );
         
			include_once( plugin_dir_path( __FILE__ ) . 'templates/slider-section.php' );
            include_once( plugin_dir_path( __FILE__ ) . 'inc/metaboxes/slider_meta_box.php' );
            add_action( 'init', array( $this, 'custom_post_type'));
            add_filter( "plugin_action_links_$this->plugin", array( $this, 'settings_link' ) );
            add_action( 'wp_enqueue_scripts', array( $this, 'frontStyles' ) );
            add_action('wp_footer', [$this, 'fp_hook_javascript_footer']);
            
        }
     
        function custom_post_type() {
            if( current_user_can('editor') || current_user_can('administrator') ){
			include_once( plugin_dir_path( __FILE__ ) . 'inc/post-types.php' );
		}
    }

    function frontStyles (){
        wp_enqueue_style( 'swiper-css-library', plugins_url( '/public/css/swiper.min.css', __FILE__ ) );
        wp_enqueue_style( 'custom_swiper_css', plugins_url( '/public/css/custom_swiper.css', __FILE__ ) );
       
    }

    
function fp_hook_javascript_footer() {
    //swiper.js
    wp_enqueue_script( 'swiper-bundle', plugins_url( '/public/js/swiper-bundle.min.js', __FILE__ ) );
    //initialize swiper
    wp_enqueue_script( 'initialize-swiper', plugins_url( '/public/js/initializeSwiper.js', __FILE__ ) );
}

  
		public function settings_link( $links ) {
			$settings_link = '<a href="edit.php?post_type=fp_images">Show Sliders</a>';
			array_push( $links, $settings_link );
			return $links;
		}
        function activate() {
			flush_rewrite_rules();
		}

		function deactivate() {
			flush_rewrite_rules();
		}

    }
	
}
$Frontpage_slider = new Frontpage_slider();

register_activation_hook( __FILE__, array( $Frontpage_slider, 'activate' ) );
register_deactivation_hook( __FILE__, array( $Frontpage_slider, 'deactivate' ));