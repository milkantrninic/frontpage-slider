<?php
namespace Templates\ProductSlider;
class SliderSectionSwiper {
public function slideSwiperItems ($pageNumber) {

    $args = array(
        'post_type'      => 'product', // Set post type to 'product'
        'posts_per_page' => -1, // Display all products (set to -1 for all)
    );
    
    $products_query = new \WP_Query( $args );
    
    // Get the saved array of selected product IDs from post meta
    $selected_products = get_post_meta( $pageNumber, 'selected_products', true );
    //var_dump($selected_products);
    // Convert the string to an array if it's not already
    $selected_products = is_array($selected_products) ? $selected_products : array();
    //var_dump($selected_products);?>

	<div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-f543298"
		data-id="f543298" data-element_type="column">
		<div class="elementor-widget-wrap elementor-element-populated">
			<div class="elementor-element elementor-element-604aede7 elementor-widget elementor-widget-wd_products"
				data-id="604aede7" data-element_type="widget" data-widget_type="wd_products.default">
				<div class="elementor-widget-container">
					<div id="carousel-981"
						class="wd-carousel-container  wd-highlighted-products with-title slider-type-product wd-rs- products wd-carousel-spacing-20"
					>
						<h4 class="title element-title owl-item"><?php echo esc_attr(get_post_meta($pageNumber, "preporucujemo", true)); ?></h4>
						<div
							class="owl-carousel wd-owl owl-item swiper-slides-lg-1 owl-item swiper-slides-md-1 owl-item swiper-slides-sm-1 owl-item swiper-slides-xs-1 owl-loaded owl-drag">






							<div class="owl-stage-outer swiper-container preporucujeSlide" data-psnumber="<?php echo $pageNumber; ?>-item">
								<div class="owl-stage swiper-wrapper">
									
    <?php 
	if ( $products_query->have_posts() ) :
       
            while ( $products_query->have_posts() ) : $products_query->the_post();
    
                // Get product data
                $product_id = in_array(get_the_ID(),  $selected_products) ? get_the_ID() : null;
				//var_dump($product_id);
				if($product_id){
                $product = wc_get_product( $product_id );
                $product_title = get_the_title();
                $product_price = $product->get_price_html();
                $product_permalink = get_permalink();
                $product_thumbnail = get_the_post_thumbnail( $product_id, array( 700, 800) );
				//arrey of images from gallery 
				$product_images = get_post_meta( $product_id, '_product_image_gallery', true );
				$img_array = explode(",", $product_images);
				//img by id from gallery
				$product_image = !empty($img_array[0]) ? wp_get_attachment_image($img_array[0], 'full', false, ['width' => 700, 'height' => 800]) : $product_thumbnail;
				//var_dump($product_images);
				$product_categories = get_the_terms( $product_id, 'product_cat' );
				$first_category = $product_categories[0];
				$category_name = $first_category->name;	
         // Output custom HTML for each product with checkbox and thumbnail
				
                ?>

     <div class="owl-item swiper-slide">
										<div class="slide-product owl-carousel-item">

											<div class="product-grid-item product product-no-swatches wd-hover-base wd-hover-with-fade wd-fade-off type-product post-372 status-publish instock product_cat-furniture has-post-thumbnail shipping-taxable purchasable product-type-simple">


												<div class="product-wrapper">
													<div class="content-product-imagin"></div>
													<div class="product-element-top wd-quick-shop">
														<a href="<?php echo  $product_permalink;?>"
															class="product-image-link">
															<div class="product-labels labels-rectangular"><span
																	class="new product-label">New</span>
															</div>
															<?php echo  $product_thumbnail;?> </a>

														<div class="hover-img">
															<a
																href="<?php echo  $product_permalink;?>">
																<?php echo  $product_image;?> </a>
														</div>

														<div class="wrapp-swatches">
															<div
																class="wd-compare-btn product-compare-button wd-action-btn wd-style-icon wd-compare-icon">
																<a href="http://localhost:8888/agroplus.com/compare/"
																	data-id="372" data-added-text="Compare products">
																	<span>Uporedi</span>
																</a>
															</div>
														</div>

													</div>

													<div class="product-element-bottom product-information">
														<h3 class="wd-entities-title"><a
																href="<?php echo  $product_permalink;?>"><?php echo  $product_title;?></a></h3>
														<div class="wd-product-cats">
															<a href="<?php echo get_term_link($first_category);?>"
																rel="tag"><?php echo $category_name;?></a>
														</div>
														<div class="product-rating-price">
															<div class="wrapp-product-price">

															<?php echo $product_price;?>
															</div>
														</div>
														<div class="fade-in-block wd-scroll">
															<div class="hover-content wd-more-desc">
																<div class="hover-content-inner wd-more-desc-inner">
																	Scelerisque facilisi rhoncus non faucibus parturient
																	senectus lobortis a ullamcorper vestibulum mi nibh
																	ultricies a parturient gravida a vestibulum leo sem
																	in. Est cum torquent mi in scelerisque leo aptent
																	per at vitae ante eleifend mollis adipiscing. </div>
																<a href="http://localhost:8888/agroplus.com/#"
																	class="wd-more-desc-btn"
																	aria-label="Read more description"><span></span></a>
															</div>
															<div class=" wd-buttons wd-pos-r-t">
																<div class="wrap-wishlist-button">
																	<div
																		class="wd-wishlist-btn wd-action-btn wd-style-icon wd-wishlist-icon">
																		<a class=""
																			href="http://localhost:8888/agroplus.com/wishlist/"
																			data-key="6b4973a5cc" data-product-id="372"
																			data-added-text="Browse Wishlist">
																			<span>Add to wishlist</span>
																		</a>
																	</div>
																</div>
																<div
																	class="wd-add-btn wd-action-btn wd-style-icon wd-add-cart-icon">
																	<a href='<?php echo  SITE_URL. "/?add-to-cart=".  $product_id;?>'
																		data-quantity="1"
																		class="button product_type_simple add_to_cart_button ajax_add_to_cart add-to-cart-loop"
																		data-product_id="372" data-product_sku="MNK-001"
																		aria-label="Dodaj “Augue adipiscing euismod” u Vašu korpu."
																		aria-describedby=""><span>Dodaj u
																			korpu</span></a>
																</div>
																<div class="wrap-quickview-button">
																	<div
																		class="quick-view wd-action-btn wd-style-icon wd-quick-view-icon">
																		<a href="<?php echo  $product_permalink;?>"
																			class="open-quick-view quick-view-button"
																			data-id="372">Quick view</a>
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
							<div class=" cat-slider-nav owl-nav">
								<div class="owl-prev-<?php echo $pageNumber; ?>-item"><</div>
								<div class="owl-next-<?php echo $pageNumber; ?>-item">></div>
							</div>
							<div class="owl-dots disabled"></div>
						</div> <!-- end product-items -->
					</div> <!-- end #carousel-981 -->

				</div>
			</div>
		</div>
	</div>
<?php
}

public function slideSwiperCategories($pageNumber) { 
	
	$getSavedCat = esc_attr(get_post_meta($pageNumber, 'selectCat', true));
	$args = array(
		'posts_per_page' => -1,
		'product_cat' => $getSavedCat,
		'post_type' => 'product',
		'orderby' => 'title',
	);
	$query = new \WP_Query( $args );
	//$num_posts = $query->found_posts;
	//var_dump($num_posts);
	?>

<div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-285a9abb"
		data-id="285a9abb" data-element_type="column">
		<div class="elementor-widget-wrap elementor-element-populated">
			<div class="elementor-element elementor-element-3edd2abb elementor-widget elementor-widget-wd_products_tabs"
				data-id="3edd2abb" data-element_type="widget" data-widget_type="wd_products_tabs.default">
				<div class="elementor-widget-container">
					<div class="wd-tabs wd-products-tabs tabs-design-simple wd-inited">
						<div class="wd-tabs-header text-center">
						<div class="cat-slider-nav">
									<div class="sw-prev next owl-prev-<?php echo $pageNumber; ?>-cat" ><</div>
									<div class="sw-next owl-next-<?php echo $pageNumber; ?>-cat">></div>
								</div>
							<div class="wd-tabs-loader"><span class="wd-loader"></span></div>

							<div class="tabs-name title">

								<span class="tabs-text" data-elementor-setting-key="title"><?php echo $getSavedCat;?></span>
								
							</div>


						</div>

						<div class="wd-tab-content-wrapper">
						
							<div class="wd-products-element swiper gridSlide" data-psnumber="<?php echo $pageNumber; ?>-cat">

								<div class="wd-products-loader hidden-loader"><span class="wd-loader"></span></div>



								<div class="products elements-grid row wd-products-holder pagination-arrows wd-spacing-20 grid-columns-3 align-items-start swiper-wrapper">
						

<!---Start of product grid-->
<?php 
// The Loop
if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();

				$product_id = get_the_ID();
				$product = wc_get_product( $product_id );
				//product description
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
         ?>
	
    <div class="product-grid-item wd-with-labels product has-stars product-no-swatches wd-hover-base wd-hover-with-fade col-lg-4 col-md-4 col-6 type-product post-361 status-publish instock product_cat-toys has-post-thumbnail sale shipping-taxable purchasable product-type-simple hover-ready swiper-slide" >


										<div class="product-wrapper">
											<div class="content-product-imagin" style="margin-bottom: -115.805px;">
											</div>
											<div class="product-element-top wd-quick-shop">
												<a href="<?php echo  $product_permalink;?>"
													class="product-image-link">
													<?php if($sale_price){?>
													<div class="product-labels labels-rectangular"><span
															class="onsale product-label"><?php echo "-" . $discount . "%";?></span>
													</div>
													<?php }?>
														<?php echo $product_thumbnail;?>
												</a>

												<div class="hover-img">
													<a href="<?php echo  $product_permalink;?>">
													<?php echo $product_image;?> </a>
												</div>

												<div class="wrapp-swatches">
													<div
														class="wd-compare-btn product-compare-button wd-action-btn wd-style-icon wd-compare-icon">
														<a href="http://localhost:8888/agroplus.com/compare/"
															data-id="361" data-added-text="Compare products"
															data-original-title="" title="" class="wd-tooltip-inited">
															<span>Compare</span>
														</a>
													</div>
												</div>

											</div>

											<div class="product-element-bottom product-information">
												<h3 class="wd-entities-title"><a
														href="<?php echo  $product_permalink;?>"><?php the_title();?></a></h3>
												<div class="wd-product-cats">
													<a href="<?php echo get_category_link($first_category->term_id); ?>"
														rel="tag"><?php echo $first_category->name;?></a>
												</div>
												<div class="product-rating-price">
													<div class="wrapp-product-price"><?php echo $product_price;?></br>

														<div class="star-rating" role="img"
															aria-label="Ocjenjeno 4.00 od 5">
															<span style="width:80%">
																Ocjenjeno <strong class="rating">4.00</strong> od 5
															</span>
														</div>


													</div>
												</div>
												<div class="fade-in-block wd-scroll">
													<div class="hover-content wd-more-desc wd-more-desc-calculated">
														<div class="hover-content-inner wd-more-desc-inner">
														<?php echo strip_tags(mb_substr($product_description, 0, 183));?> </div>
														<a href="http://localhost:8888/agroplus.com/#"
															class="wd-more-desc-btn wd-shown"
															aria-label="Read more description"><span></span></a>
													</div>
													<div class="wd-bottom-actions wd-add-small-btn">
														<div class="wrap-wishlist-button">
															<div
																class="wd-wishlist-btn wd-action-btn wd-style-icon wd-wishlist-icon">
																<a class=""
																	href="http://localhost:8888/agroplus.com/wishlist/"
																	data-key="6b4973a5cc" data-product-id="361"
																	data-added-text="Browse Wishlist">
																	<span>Add to wishlist</span>
																</a>
															</div>
														</div>
														<div
															class="wd-add-btn wd-action-btn wd-style-icon wd-add-cart-icon">
															<a href="http://localhost:8888/agroplus.com/?add-to-cart=361"
																data-quantity="1"
																class="button product_type_simple add_to_cart_button ajax_add_to_cart add-to-cart-loop"
																data-product_id="361" data-product_sku=""
																aria-label="Dodaj “iPhone dock” u Vašu korpu."
																aria-describedby=""><span>Dodaj u korpu</span></a>
														</div>
														<div class="wrap-quickview-button">
															<div
																class="quick-view wd-action-btn wd-style-icon wd-quick-view-icon">
																<a href="<?php echo  $product_permalink;?>"
																	class="open-quick-view quick-view-button"
																	data-id="361">Quick view</a>
															</div>
														</div>
													</div>


									</div>
											</div>
										</div>
									</div>
									

 <?php 
}
 wp_reset_postdata();
} 
?>

<!---End of product grid--->
						
								</div>
<!-- 								
								 <div class="wd-loop-footer products-footer">
									<div class="wrap-loading-arrow">
										<div class=" owl-prev-<?php echo $pageNumber; ?>-cat"></div>
										<div class="owl-next-<?php echo $pageNumber; ?>-cat">
										</div>
									</div>
								</div>  -->

							</div>


						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php }



}
