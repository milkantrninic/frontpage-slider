<?php
function fpsl_AAtopSlider($atts)
{ 
        define( '_AAT_VERSION', '1.0.0' );
        wp_enqueue_style('aatopslider', plugin_dir_url( __FILE__ ) . 'css/aa-top-slider.css', array(), _AAT_VERSION, 'all');
        wp_enqueue_script( 'aatopslider', plugin_dir_url( __FILE__ ) . 'js/aatopslider.js', array(), _AAT_VERSION, true );

        
    ?>
    <!-- Page Title/Header Start -->
    <div class="aatopslider swiper-container" style="height:100%;">
        <div class="swiper-wrapper">
            <?php
            $default = array(
                'pagenumber' => '',
            );
            $pageNumber = shortcode_atts($default, $atts);
           
            //var_dump($pageNumber['pagenumber']);
            $number_of_slides = esc_attr(get_post_meta($pageNumber['pagenumber'], 'fpsl_number_of_slides', true)) ? esc_attr(get_post_meta($pageNumber['pagenumber'], 'fpsl_number_of_slides', true)) : 1;
            for($x=1; $x<=$number_of_slides; $x++) {
                $attachment_id = esc_attr(get_post_meta($pageNumber['pagenumber'], "bnslider_pic04_$x", true));
                //var_dump($attachment_id); 
                ?>
            <div class="page-title-section section swiper-slide image-overlay" style="height:100%;">
                <picture>
                    <source media="(min-width: 1199px)"
                        srcset="<?php echo esc_attr(wp_get_attachment_image_src( $attachment_id, 'aaTopSliderDesktop' )[0]); ?>">
                    <source media="(min-width: 992px)"
                        srcset="<?php echo esc_attr(wp_get_attachment_image_src( $attachment_id, 'aaTopSliderDesktop' )[0]); ?>">
                    <source media="(min-width: 768px)"
                        srcset="<?php echo esc_attr(wp_get_attachment_image_src( $attachment_id, 'aaTopSliderDesktop' )[0]); ?>">
                    <img src="<?php echo esc_attr(wp_get_attachment_image_src( $attachment_id, 'aaTopSliderMobile' )[0]); ?>"
                        alt="<?php the_title(); ?>" >
                </picture>
                <div class="container AATopSLiderText">
                    <div class="row">
                        <div class="col">

                            <div class="page-title">
                                <p class="header-title wd-text-block reset-last-child text-center color-primary">
                                    <?php echo esc_attr(get_post_meta($pageNumber['pagenumber'], "header_$x", true)); ?></p>
                                <p class="para-title">
                                    <?php echo esc_attr(get_post_meta($pageNumber['pagenumber'], "paragraph_$x", true)); ?>
                                </p>
                                <div class="row">
                                    <div class="wd-button-wrapper text-center">
                                        <a class="btn btn-style-round btn-style-rectangle btn-size-default btn-color-primary btn-icon-pos-right"
                                            href="<?php echo esc_attr(get_post_meta($pageNumber['pagenumber'], "button01_url_$x", true)); ?>">
                                            <span class="wd-btn-text" data-elementor-setting-key="text">
                                                <?php echo esc_attr(get_post_meta($pageNumber['pagenumber'], "button01_$x", true)); ?>
                                            </span>

                                        </a>
                                    </div>
                                 
                                            <div class="wd-button-wrapper text-center">
                                                <a class="btn btn-style-bordered btn-style-round btn-size-default btn-color-white btn-icon-pos-right"
                                                    href="<?php echo esc_attr(get_post_meta($pageNumber['pagenumber'], "button02_url_$x", true)); ?>">
                                                    <span class="wd-btn-text" data-elementor-setting-key="text">
                                                        <?php echo esc_attr(get_post_meta($pageNumber['pagenumber'], "button02_$x", true)); ?>
                                                    </span>

                                                </a>
                                          
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


            </div>

            <?php }
            wp_reset_postdata(); ?>
        </div>
    </div>
    <!-- Page Title/Header End -->
    <?php
    //end of banner slider
}

add_shortcode('AAtopSlider', 'fpsl_AAtopSlider');