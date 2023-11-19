<?php
function fpsl_frontpageSlider($atts) { 
    define( '_AAT_VERSION', '1.0.0' );
    wp_enqueue_script( 'headerslider', plugin_dir_url( __FILE__ ) . 'js/headerslider.js', array(), _AAT_VERSION, true );
    ?>
<!-- Slider main container Start -->

<div class="section section-fluid bg-white">
    <div class="container-fluid" style="padding: 0;">
        <div class="swiper headerslider swiper-container">
            <div class="swiper-wrapper">
                <?php 
                    $default = array(
                        'pagenumber' => '',
                    );
                    $pageNumber = shortcode_atts($default, $atts);
                //var_dump($pageNumber['pagenumber']);
             $number_of_slides = esc_attr(get_post_meta($pageNumber['pagenumber'], 'fpsl_number_of_slides', true)) ? esc_attr(get_post_meta($pageNumber['pagenumber'], 'fpsl_number_of_slides', true)) : 1;
             for($x=1; $x<=$number_of_slides; $x++) {?>
                
                <div class="home3-slide-item swiper-slide"   >
                <picture>
                    <source media="(min-width: 1199px)" srcset="<?php echo esc_attr(get_post_meta($pageNumber['pagenumber'], "recipes_pic04_$x", true)); ?>">
                    <source media="(min-width: 1024px)" srcset="<?php echo esc_attr(get_post_meta($pageNumber['pagenumber'], "recipes_pic04_$x", true)); ?>">
                    <source media="(min-width: 768px)" srcset="<?php echo esc_attr(get_post_meta($pageNumber['pagenumber'], "recipes_pic04_$x", true)); ?>">
                    <img src="<?php echo esc_attr(get_post_meta($pageNumber['pagenumber'], "recipes_pic04_$x", true)); ?>" alt="<?php the_title();?>" style="width:auto;">
                </picture>
                <div class="central_content">
                    <div class="container">
                        <div class="slider_p1"><?php echo esc_attr(get_post_meta($pageNumber['pagenumber'],  "slider_fp_$x", true)); ?></div>
                        <div class="slider_p2"><?php echo esc_attr(get_post_meta($pageNumber['pagenumber'], "slider_fp2_$x", true)); ?></div>

                        <?php 
                        $cat_boxes = (array) null;
                        $cat_links = (array) null;
                        esc_attr(get_post_meta($pageNumber['pagenumber'],"category1_$x", true)) ? $cat_boxes[] = esc_attr(get_post_meta($pageNumber['pagenumber'],"category1_$x", true)) :"";
                        esc_attr(get_post_meta($pageNumber['pagenumber'], "category2_$x", true)) ? $cat_boxes[] = esc_attr(get_post_meta($pageNumber['pagenumber'], "category2_$x", true)) :"";
                        esc_attr(get_post_meta($pageNumber['pagenumber'], "category3_$x", true)) ? $cat_boxes[] = esc_attr(get_post_meta($pageNumber['pagenumber'], "category3_$x", true)) :"";
                        esc_attr(get_post_meta($pageNumber['pagenumber'],  "category4_$x", true)) ? $cat_boxes[] = esc_attr(get_post_meta($pageNumber['pagenumber'],  "category4_$x", true)) :"";
                        
                        esc_attr(get_post_meta($pageNumber['pagenumber'], "category1_link_$x", true))? $cat_links[] = esc_attr(get_post_meta($pageNumber['pagenumber'], "category1_link_$x", true)) :$cat_links[] = "#";
                        esc_attr(get_post_meta($pageNumber['pagenumber'], "category2_link_$x", true)) ? $cat_links[] = esc_attr(get_post_meta($pageNumber['pagenumber'], "category2_link_$x", true)) :$cat_links[] = "#";
                        esc_attr(get_post_meta($pageNumber['pagenumber'], "category3_link_$x", true)) ? $cat_links[] = esc_attr(get_post_meta($pageNumber['pagenumber'], "category3_link_$x", true)) :$cat_links[] = "#";
                        esc_attr(get_post_meta($pageNumber['pagenumber'], "category4_link_$x", true)) ? $cat_links[] = esc_attr(get_post_meta($pageNumber['pagenumber'], "category4_link_$x", true)) :$cat_links[] = "#";
                        $count_cat = count($cat_boxes); 
                         //var_dump($cat_boxes);
                        // echo  $count_cat; 
                        
                        ?>
                        <div class="row slide_cat"> 
                            <?php for ($y = 0; $y <= $count_cat-1; $y++) { 
                                if($cat_boxes[$y] !== 'undefined'){
                                ?>
                            <div class="d-flex justify-content-around"><a href="<?php echo esc_url($cat_links[$y]); ?>">
                            <?php echo esc_attr($cat_boxes[$y]); ?></a></div>
                        <?php } 
                        }
                        ?>
                        </div>
                    </div>
                    </div>
                </div>
                 
    <?php }
   unset($x, $y);
    ?>
             

            </div>
            <div class="home3-slider-prev swiper-button-prev"><i class="ti-angle-left"></i></div>
            <div class="home3-slider-next swiper-button-next"><i class="ti-angle-right"></i></div>
        </div>
    </div>
</div>
<!-- Slider main container End -->

<?php 
//end of frontpage slider
    }

add_shortcode( 'headerSlider', 'fpsl_frontpageSlider');
//add_shortcode( 'bannerSliders', array( 'fpsl_SliderSection', 'fpsl_bannerSlider' ) );