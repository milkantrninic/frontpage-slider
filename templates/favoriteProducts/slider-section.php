<?php

function fpsl_favoriteProducts($atts)
{ 
	include_once FPSL_DIR . 'templates/favoriteProducts/slider-section-swiper1.php';
	 $psVersion = "1.0.0";
 	  wp_enqueue_style('favorite-products', plugin_dir_url( __FILE__ ) . 'css/favorite-products.css', array(), $psVersion, 'all');
   
	// wp_enqueue_script( 'wd-owl-library', FPSL_DIR . 'public/js/owl.carousel.min.js', array(), '1.0.0', false );
	wp_enqueue_script( 'favorite-productsjs', plugin_dir_url( __FILE__ ) . 'js/favorite-products.js', array(),  $psVersion, true );
  
	$default = array(
		'pagenumber' => '',
	);
	$pageNumber = shortcode_atts($default, $atts);
	$slidePageNumber = $pageNumber['pagenumber'];
	//var_dump($pageNumber);
	$sliderSection = new Templates\FavoriteProducts\SliderSectionSwiper();
?>
	<div class="elementor-container elementor-column-gap-extended">
		<?php  echo $sliderSection->slideFavoriteProducts($slidePageNumber); ?>
	</div>
<?php
	//end of banner slider
}

add_shortcode('FavoriteProducts', 'fpsl_favoriteProducts');