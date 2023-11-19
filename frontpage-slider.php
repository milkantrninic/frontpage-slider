<?php

/**
 * @wordpress-plugin
 * Plugin Name:      	FrontPage Slider
 * Plugin URI:        	https://github.com/milkan-trn/frontpage-slider
 * Description:         FrontPage slider has predesignated templates that you can use inside your theme
 * Version:           	0.1.5
 * Requires at least: 	5.3
 * Requires PHP:      	7.3
 * Author:            	Milkan Trninic
 * Author URI:         	https://profiles.wordpress.org/milkan2002/
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
defined('ABSPATH') or die('Nothing Here!');
define('SITE_URL', get_site_url());
define('FPSL_DIR', plugin_dir_path(__FILE__) );

if (!class_exists('Frontpage_slider')) {
    class fpsl_Frontpage_slider
    {
        public $plugin;
        public $templateList;
        function __construct()
        {
            $this->plugin = plugin_basename(__FILE__);
            //common area
            include_once FPSL_DIR .'inc/metaboxes/slider_meta_box.php';
            include_once FPSL_DIR .'admin/settings-page.php';
          
            

            add_action('init', [$this, 'fpsl_custom_post_type']);
            add_filter("plugin_action_links_$this->plugin", [
                $this,
                'fpsl_settings_link',
            ]);
            add_action('wp_enqueue_scripts', [$this, 'fpsl_frontStyles']);
            add_action('wp_head', [$this, 'fpsl_fp_hook_javascript_footer']);
            add_action('after_setup_theme', [$this, 'fpsl_add_slider_image_size'], 100);
            add_action('admin_menu', [$this, 'fpsl_fsplugin_add_toplevel_menu']);
            //Get Templates
            $this->getTemplates($this->getSubFolders());
            //var_dump($this->getSubFolders());
        }
        //include custom post types for this plugin
        function fpsl_custom_post_type()
        {
           
            $user = wp_get_current_user();
            $allowed_roles = array( 'editor', 'administrator', 'author' );
            if ( array_intersect( $allowed_roles, $user->roles ) ) {
                include_once plugin_dir_path(__FILE__) . 'inc/post-types.php';
            }
        }
        //include css styles
        function fpsl_frontStyles()
        {
            wp_enqueue_style(
                'swiper-css-library',
                plugins_url('/public/css/swiper.min.css', __FILE__)
            );
            wp_enqueue_style(
                'custom_swiper_css',
                plugins_url('/public/css/custom_swiper.css', __FILE__)
            );
        }
        //add image sizes for different devices
        function fpsl_add_slider_image_size()
        {
            add_image_size('fp_shop_banner', 1903, 569, true);
            add_image_size('fp_main_slider', 1903, 1000, true);
            add_image_size('fp_mobile_slider', 414, 655, true);
            add_image_size('fp_ipad_slider', 1024, 1000, true);
        }
        //add javascripts
        function fpsl_fp_hook_javascript_footer()
        {
            //swiper.js
            wp_enqueue_script(
                'swiper-bundle',
                plugins_url('/public/js/swiper-bundle.min.js', __FILE__)
            );
        }

        // add top-level administrative menu
        function fpsl_fsplugin_add_toplevel_menu()
        {



            add_menu_page('Slider Instructions And Settings', 'FrontPage Sliders', 'manage_options',  'my-top-level-handle', 'fpsl_settings_menu_function', 'dashicons-media-interactive', 5);
            //settings submenu
            //add_submenu_page('my-top-level-handle', 'Slider Instructions And Settings', 'Settings', 'manage_options', 'my-top-level-handle');

            //Header and banner sliders submenu
            add_submenu_page('my-top-level-handle', 'Custom Post Type Admin', 'Show All Sliders', 'manage_options', 'edit.php?post_type=fp_images');
        }
        //Settings shortcut in plugin folder
        public function fpsl_settings_link($links)
        {
            $settings_link =
                '<a href="admin.php?page=my-top-level-handle">Slider settings</a>';
            array_push($links, $settings_link);
            return $links;
        }
        function activate()
        {
            flush_rewrite_rules();
        }

        function deactivate()
        {
            flush_rewrite_rules();
        }
//create array of template subfolders
        public function getSubFolders() {
            $folder_path = FPSL_DIR .'templates';
            $templateList = [];
            $subfolders = array_diff(scandir($folder_path), array('..', '.'));
            foreach($subfolders as $subfolder) {
                if(is_dir($folder_path . '/' . $subfolder)) {
                    if(file_exists(FPSL_DIR ."templates/$subfolder/$subfolder.php")){ 
                    $templateList []=  $subfolder;}
                }
            }
            return $templateList;
        }
//this function will autoload all new folders with templates
function getTemplates($subfolders) {
    foreach($subfolders as $subfolder) {
            if(file_exists(FPSL_DIR ."templates/$subfolder/$subfolder.php")){ 
                include_once FPSL_DIR ."templates/$subfolder/$subfolder.php";}
                                                  
                                        }
                                    }
}
}
$Frontpage_slider = new fpsl_Frontpage_slider();

register_activation_hook(__FILE__, [$Frontpage_slider, 'activate']);
register_deactivation_hook(__FILE__, [$Frontpage_slider, 'deactivate']);
