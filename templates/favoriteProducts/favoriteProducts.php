<?php
/**
 * @fpsl-template
 * Template Name:      	AA Top Slider
 * Template URI:        https://github.com/milkan-trn/frontpage-slider
 * Description:         AA Top Slider template for 
 * Version:           	1.0.0
 * Requires at least: 	5.3
 * Requires PHP:      	7.3
 * Author:            	Milkan Trninic
 * Author URI:         	https://profiles.wordpress.org/milkan2002/
 * Text Domain:       	frontpage-slider
 * License:           	GPLv2 or later
 * License URI:       	http://www.gnu.org/licenses/gpl-2.0.txt
 * GitHub Plugin URI: 	https://github.com/milkan-trn/frontpage-slider
 * Note: This php file name must be the same as folder name in order for file to be autoloaded
 */

        //Sections
         include_once FPSL_DIR .'templates/favoriteProducts/slider-section.php';
         //Templates
         include_once FPSL_DIR .'templates/favoriteProducts/favoriteProducts_metaB.php';

         //add_image_size( 'aaTopSliderDesktop', 1644, 600, ['top', 'center'] );
         //add_image_size( 'aaTopSliderMobile', 390, 640, ['top', 'center'] );