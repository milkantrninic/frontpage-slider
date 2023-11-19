<?php
function fpsl_topCategories($atts)
{ 
         define( '_TC_VERSION', '1.0.0' );
         wp_enqueue_style('top-categories', plugin_dir_url( __FILE__ ) . 'css/top-categories.css', array(), _TC_VERSION, 'all');
        wp_enqueue_script( 'top-categories', plugin_dir_url( __FILE__ ) . 'js/top-categories.js', array(), _TC_VERSION, true );

        
    ?>
    <!-- Page Title/Header Start -->
    <div class="swiper topCategoriesSwiper">
            <div class="swiper-wrapper">
            <?php
            $default = array(
                'pagenumber' => '',
            );
            $pageNumber = shortcode_atts($default, $atts);
           
            //var_dump($pageNumber['pagenumber']);
            $number_of_slides = esc_attr(get_post_meta($pageNumber['pagenumber'], 'fpsl_number_of_slides', true)) ? esc_attr(get_post_meta($pageNumber['pagenumber'], 'fpsl_number_of_slides', true)) : 1;
            for($x=1; $x<=$number_of_slides; $x++) {
                $attachment_id = esc_attr(get_post_meta($pageNumber['pagenumber'], "topSlider_pic01_$x", true));
                //var_dump($attachment_id); 
                ?>
           <div class="swiper-slide">
							<div class="category-grid-item cat-design-alt product-category product first" data-loop="1">
								<div class="wrapp-category">
									<div class="category-image-wrapp">
										<a href="<?php echo esc_attr(get_post_meta($pageNumber['pagenumber'], "title_url_$x", true)); ?>"
											class="category-image">

											<img loading="lazy" width="200" height="200"
												src="<?php echo esc_attr(wp_get_attachment_image_src( $attachment_id, 'thumbnail' )[0]); ?>"
												class="attachment-large size-large" alt="" decoding="async"
												srcset="<?php echo esc_attr(wp_get_attachment_image_src( $attachment_id, 'thumbnail' )[0]); ?>, <?php echo esc_attr(wp_get_attachment_image_src( $attachment_id, 'thumbnail' )[0]); ?> 150w"
												sizes="(max-width: 200px) 100vw, 200px"> </a>
									</div>
									<div class="hover-mask">
										<h3 class="wd-entities-title">
											<?php echo esc_attr(get_post_meta($pageNumber['pagenumber'], "title_$x", true)); ?></mark> </h3>

										<div class="more-products"><a
												href="<?php echo esc_attr(get_post_meta($pageNumber['pagenumber'], "title_url_$x", true)); ?>"><?php echo esc_attr(get_post_meta($pageNumber['pagenumber'], "text2_$x", true)); ?></a></div>

									</div>

									<a href="<?php echo esc_attr(get_post_meta($pageNumber['pagenumber'], "title_url_$x", true)); ?>"
										class="category-link wd-fill" aria-label="Product category accessories"></a>
								</div>
							</div>
                            </div>
            <?php }
            wp_reset_postdata(); ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>


    <!-- Page Title/Header End -->
    <?php
    //end of banner slider
}

add_shortcode('topCategories', 'fpsl_topCategories');