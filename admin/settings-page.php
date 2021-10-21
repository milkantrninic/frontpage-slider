<?php // FrontPage Slider - Settings Page



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	
	exit;
	
}



// display the plugin settings page
function settings_menu_function() {
	
	// check if user is allowed access
	if ( ! current_user_can( 'manage_options' ) ) return;
	
	?>
	
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<p>Add this shortcode for header slider: <?php echo htmlspecialchars('<?php echo do_shortcode("[headerSlider]"); ?>')?> </p>
        <p>Add this shortcode for banner slider: <?php echo htmlspecialchars('<?php echo do_shortcode("[bannerSliders]"); ?>')?> </p>
	</div>
	
	<?php
	
}


