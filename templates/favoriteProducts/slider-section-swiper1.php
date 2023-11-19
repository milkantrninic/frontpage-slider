<?php
namespace Templates\FavoriteProducts;
class SliderSectionSwiper {
public function slideFavoriteProducts ($pageNumber) {

    $args = array(
        'post_type'      => 'product', // Set post type to 'product'
        'posts_per_page' => -1, // Display all products (set to -1 for all)
    );
    
    $products_query = new \WP_Query( $args );
    
    // Get the saved array of selected product IDs from post meta
    $selected_products = get_post_meta( $pageNumber, 'fp_products', true );
    //var_dump($selected_products);
    // Convert the string to an array if it's not already
    $selected_products = is_array($selected_products) ? $selected_products : array();
    //var_dump($selected_products);?>
<div class="elementor-container elementor-column-gap-default">
	<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-717ef08a"
		data-id="717ef08a" data-element_type="column">
		<div class="elementor-widget-wrap elementor-element-populated">
			<div class="elementor-element elementor-element-6ccbd101 elementor-widget elementor-widget-wd_products_tabs"
				data-id="6ccbd101" data-element_type="widget" data-widget_type="wd_products_tabs.default">
				<div class="elementor-widget-container">
					<div class="wd-tabs wd-products-tabs tabs-design-simple wd-inited">
					<div class="wd-tabs-header text-center">
				<div class="wd-tabs-loader"><span class="wd-loader"></span></div>

									<div class="tabs-name title">
						
						<span class="tabs-text" data-elementor-setting-key="title">
							<?php echo get_post_meta( $pageNumber, 'fpNaslov', true );?>				</span>
					</div>
				
				
				<div class="wd-nav-wrapper wd-nav-tabs-wrapper tabs-navigation-wrapper">
				</div>
			</div>

						<div class="wd-tab-content-wrapper">

							<div id="carousel-628"
								class="wd-carousel-container  slider-type-product wd-rs- products wd-carousel-spacing-20">
								<div class="owl-carousel wd-owl owl-items-lg-5 owl-items-md-4 owl-items-sm-3 owl-items-xs-2 owl-loaded owl-drag">
									<div class="owl-stage-outer swiper fav-products-swiper" data-fpnumber="<?php echo $pageNumber; ?>-item">
										<div class="owl-stage swiper-wrapper">
									
    <?php 
	if ( $products_query->have_posts() ) :
       
            while ( $products_query->have_posts() ) : $products_query->the_post();
    
                // Get product data
                $product_id = in_array(get_the_ID(),  $selected_products) ? get_the_ID() : null;
				//var_dump($product_id);
				if($product_id){
                $product = wc_get_product( $product_id );
				$product_description = $product->get_description();
                $product_title = get_the_title();
                $product_price = $product->get_price_html();
					//calculate discount
					$regular_price = $product->get_regular_price();
					$sale_price = $product->get_sale_price();
					if($sale_price){
						$discount = ($regular_price - $sale_price) / $regular_price * 100;
						$discount = round($discount);}
                $product_permalink = get_permalink();
                $product_thumbnail = get_the_post_thumbnail( $product_id, array( 300, 300) );
				//arrey of images from gallery 
				$product_images = get_post_meta( $product_id, '_product_image_gallery', true );
				$img_array = explode(",", $product_images);
				//img by id from gallery
				$product_image = !empty($img_array[0]) ? wp_get_attachment_image($img_array[0], 'woocommerce_thumbnail', false, ['width' => 300, 'height' => 300]) : $product_thumbnail;
				//var_dump($product_images);
				$product_categories = get_the_terms( $product_id, 'product_cat' );
				$first_category = $product_categories[0];
				$category_name = $first_category->name;	
         // Output custom HTML for each product with checkbox and thumbnail
				
                ?>
<div class="owl-item swiper-slide">
												<div class="slide-product owl-carousel-item" style="width: 242.4px;">

													<div class="product-grid-item product product-no-swatches wd-hover-base wd-hover-with-fade wd-fade-off type-product post-232 status-publish instock product_cat-furniture has-post-thumbnail shipping-taxable purchasable product-type-simple">


														<div class="product-wrapper">
															<div class="content-product-imagin"></div>
															<div class="product-element-top wd-quick-shop">
																<a href="<?php echo $product_permalink;?>"
																	class="product-image-link">
																	<?php echo $product_thumbnail;?>
																	</a>

																<div class="hover-img">
																	<a
																		href="<?php echo $product_permalink;?>">
																		<?php echo $product_image;?>
																	</a>
																</div>

																<div class="wrapp-swatches">
																	<div
																		class="wd-compare-btn product-compare-button wd-action-btn wd-style-icon wd-compare-icon">
																		<a href="http://localhost:8888/agroplus.com/compare/"
																			data-id="232"
																			data-added-text="Compare products">
																			<span>Uporedi</span>
																		</a>
																	</div>
																</div>

															</div>

															<div class="product-element-bottom product-information">
																<h3 class="wd-entities-title"><a
																		href="<?php echo $product_permalink;?>"><?php echo $product_title;?></a></h3>
																<div class="wd-product-cats">
																<a href="<?php echo get_category_link($first_category->term_id); ?>">
																		<?php echo $category_name;?></a>
																</div>
																<div class="product-rating-price">
																	<div class="wrapp-product-price">

																	<?php echo $product_price;?>
																	</div>
																</div>
																<div class="fade-in-block wd-scroll">
																	<div class="hover-content wd-more-desc">
																		<div
																			class="hover-content-inner wd-more-desc-inner">
																			<?php echo strip_tags(mb_substr($product_description, 0, 183));?>
																		</div>
																		<a href="<?php echo FPSL_DIR;?>#"
																			class="wd-more-desc-btn"
																			aria-label="Read more description"><span></span></a>
																	</div>
																	<div class=" wd-buttons wd-pos-r-t">
																		<div class="wrap-wishlist-button">
																			<div
																				class="wd-wishlist-btn wd-action-btn wd-style-icon wd-wishlist-icon">
																				<a class=""
																					href="http://localhost:8888/agroplus.com/wishlist/"
																					>
																					<span>Add to wishlist</span>
																				</a>
																			</div>
																		</div>
																		<div
																			class="wd-add-btn wd-action-btn wd-style-icon wd-add-cart-icon">
																			<a href="http://localhost:8888/agroplus.com/?add-to-cart=232"
																				data-quantity="1"
																				class="button product_type_simple add_to_cart_button ajax_add_to_cart add-to-cart-loop"
																				><span>Dodaj u
																					korpu</span></a>
																		</div>
																		<div class="wrap-quickview-button">
																			<div
																				class="quick-view wd-action-btn wd-style-icon wd-quick-view-icon">
																				<a href="<?php echo $product_permalink;?>"
																					class="open-quick-view quick-view-button"
																					data-id="232">Quick view</a>
																			</div>
																		</div>
																	</div>



																</div>
															</div>
														</div>
													</div>

												</div>
											</div>
<?php 
				}
endwhile;

wp_reset_postdata();
else :
echo __( 'No products found', 'your-text-domain' );
endif;
?>
	
											
										
	</div>
									</div>
								<div class="cat-slider-nav owl-nav">
								<div class="owl-prev-<?php echo $pageNumber; ?>-item"><</div>
								<div class="owl-next-<?php echo $pageNumber; ?>-item">></div>
									</div>
									<div class="fp-swiper-pagination"></div>
								</div> <!-- end product-items -->
							</div> <!-- end #carousel-628 -->


						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
}

}
