<?php

function fpsl_productSlider($atts)
{ 
	include_once FPSL_DIR . 'templates/productSlider/slider-section-swiper1.php';
	 $psVersion = "1.0.0";
 	  wp_enqueue_style('ps-slider', plugin_dir_url( __FILE__ ) . 'css/ps-slider.css', array(), $psVersion, 'all');
   
	// wp_enqueue_script( 'wd-owl-library', FPSL_DIR . 'public/js/owl.carousel.min.js', array(), '1.0.0', false );
	wp_enqueue_script( 'product-slider', plugin_dir_url( __FILE__ ) . 'js/product-slider.js', array(),  $psVersion, true );
  
	$default = array(
		'pagenumber' => '',
	);
	$pageNumber = shortcode_atts($default, $atts);
	$slidePageNumber = $pageNumber['pagenumber'];
	//var_dump($pageNumber);
	$sliderSection = new Templates\ProductSlider\SliderSectionSwiper();
?>
	<div class="elementor-container elementor-column-gap-extended">
		<?php 
		$getSide = esc_attr(get_post_meta($slidePageNumber, "leftRight", true));
		if ($getSide !== "lijevo") {
			//Swiper Product Slides
			echo $sliderSection->slideSwiperItems($slidePageNumber);

			//Here goes slider for categories
			echo $sliderSection->slideSwiperCategories($slidePageNumber);
		} else {
			//Here goes slider for categories
			echo $sliderSection->slideSwiperCategories($slidePageNumber);
			//Swiper Product Slides
			echo $sliderSection->slideSwiperItems($slidePageNumber);
		}
		?>
	</div>
<?php
	//end of banner slider
}

add_shortcode('productSlider', 'fpsl_productSlider');