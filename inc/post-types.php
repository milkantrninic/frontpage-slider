<?php
//This is FrontPage Slider
$prefix = 'frontpage-slider';
$labels = array(
	'name'                  => _x('FrontPage Sliders', 'Post Type General Name', $prefix),
	'singular_name'         => _x('FrontPage Slider', 'Post Type Singular Name', $prefix),
	'menu_name'             => __('FrontPage Sliders', $prefix),
	'name_admin_bar'        => __('FrontPage Slider', $prefix),
	'archives'              => __('Item Archives', $prefix),
	'attributes'            => __('Item Attributes', $prefix),
	'parent_item_colon'     => __('Parent Item:', $prefix),
	'all_items'             => __('All Items', $prefix),
	'add_new_item'          => __('Add New Item', $prefix),
	'add_new'               => __('Add New', $prefix),
	'new_item'              => __('New Item', $prefix),
	'edit_item'             => __('Create New Slider', $prefix),
	'update_item'           => __('Update Item', $prefix),
	'view_item'             => __('View Item', $prefix),
	'view_items'            => __('View Items', $prefix),
	'search_items'          => __('Search Item', $prefix),
	'not_found'             => __('Not found', $prefix),
	'not_found_in_trash'    => __('Not found in Trash', $prefix),
	'featured_image'        => __('Featured Image', $prefix),
	'set_featured_image'    => __('Set featured image', $prefix),
	'remove_featured_image' => __('Remove featured image', $prefix),
	'use_featured_image'    => __('Use as featured image', $prefix),
	'insert_into_item'      => __('Insert into item', $prefix),
	'uploaded_to_this_item' => __('Uploaded to this item', $prefix),
	'items_list'            => __('Items list', $prefix),
	'items_list_navigation' => __('Items list navigation', $prefix),
	'filter_items_list'     => __('Filter items list', $prefix),
);

$args = array(
	'label'               => __('FrontPage Slider', $prefix),
	'labels'                => $labels,
	'description'         => __('Slider below header'),
	'supports'            => array('title', 'thumbnail'),
	'hierarchical'        => false,
	'public'              => true,
	'show_ui'             => true,
	'show_in_menu'        => 'edit.php?post_type=fp_images',
	'show_in_nav_menus'   => true,
	'show_in_admin_bar'   => true,
	'menu_position'       => 5,
	'can_export'          => true,
	'has_archive'         => true,
	'exclude_from_search' => false,
	'publicly_queryable'  => true,
	'capability_type'     => 'post',
);


register_post_type('fp_images', $args);