<?php // FrontPage Slider - Settings Page



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	
	exit;
	
}



// display the plugin settings page
function fpsl_settings_menu_function() {
	
	// check if user is allowed access
	if ( ! current_user_can( 'manage_options' ) ) return;
	
	?>
	
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
	<a class="button" href="<?php echo get_site_url();?>/wp-admin/post-new.php?post_type=fp_images">Create new sliders</a>
	<a class="button" href="<?php echo get_site_url();?>/wp-admin/edit.php?post_type=fp_images">View Sliders</a>
</div>
	
	<?php
	
}


