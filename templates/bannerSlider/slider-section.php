<?php
     function fpsl_bannerSlider($atts)
    { 
        define( '_BS_VERSION', '1.0.0' );
        wp_enqueue_script( 'bannerslider', plugin_dir_url( __FILE__ ) . 'js/bannerslider.js', array(), _BS_VERSION, true );
        ?>
        <!-- Page Title/Header Start -->
        <div class="bannerslider swiper-container" style="height:100%;">
            <div class="swiper-wrapper">
                <?php
                if ( class_exists( 'WooCommerce' ) ) {
                    // WooCommerce is installed 
                    $page_name = (is_shop() || is_product_category() || is_product_tag() || is_product_brand())  ? "Trgovina" : get_the_title();
                } else {
                    $page_name = get_the_title();
                }
               
                $default = array(
                    'pagenumber' => '',
                );
                $pageNumber = shortcode_atts($default, $atts);
            //var_dump($pageNumber['pagenumber']);
         $number_of_slides = esc_attr(get_post_meta($pageNumber['pagenumber'], 'fpsl_number_of_slides', true)) ? esc_attr(get_post_meta($pageNumber['pagenumber'], 'fpsl_number_of_slides', true)) : 1;
         for($x=1; $x<=$number_of_slides; $x++) {?>
                    <div class="page-title-section section swiper-slide" style="height:100%;">
                        <picture>
                            <source media="(min-width: 1199px)" srcset="<?php echo esc_attr(get_post_meta($pageNumber['pagenumber'], "bnslider_pic04_$x", true)); ?>">
                            <source media="(min-width: 1024px)" srcset="<?php echo esc_attr(get_post_meta($pageNumber['pagenumber'], "bnslider_pic04_$x", true)); ?>">
                            <source media="(min-width: 768px)" srcset="<?php echo esc_attr(get_post_meta($pageNumber['pagenumber'], "bnslider_pic04_$x", true)); ?>">
                            <img src="<?php echo esc_attr(get_post_meta($pageNumber['pagenumber'], "bnslider_pic04_$x", true)); ?>" alt="<?php the_title(); ?>" style="width:auto;">
                        </picture>
                        <div class="container">
                            <div class="row">
                                <div class="col">

                                    <div class="page-title">
                                        <h1 class="title"><?php echo esc_attr(get_post_meta($pageNumber['pagenumber'], "bnslider_fp_$x", true)); ?></h1>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                                            <li class="breadcrumb-item active"><?php echo esc_attr($page_name); ?></li>
                                        </ul>
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

add_shortcode('bannerSlider', 'fpsl_bannerSlider');
