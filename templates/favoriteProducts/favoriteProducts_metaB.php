<?php

/* 
 * sd_login metaboxes.
 */
class Fpsl_favoriteProductsMeta
{

    public function __construct()
    {
        add_action('add_meta_boxes', array($this, 'fpsl_sd_register_metaboxes'));
        add_action('save_post', array($this, 'fpsl_sd_save_meta_box'));
    }


    /**
     *  It will register metaboxes
     */
    public function fpsl_sd_register_metaboxes()
    {
        //This will turn off/on boxes for specific theme. Add theme conditions here
        $selectSlideTheme = esc_attr(get_post_meta(get_the_ID(), 'selectSlideTheme', true));
        if ($selectSlideTheme == "favoriteProducts") {
            add_meta_box('info_box_for_fp_popup', __('Instructions how to run popup', 'popup'), [$this, 'fpsl_instructions'], ['fp_images']);

            add_meta_box('sd_login_meta_box', __("Unesi tekst na slajdu"), array($this, 'fpsl_SD_post_meta'), 'fp_images', 'advanced', 'default');
        }
    }

    public function fpsl_instructions($post)
    {
        $get_popup_post_number = $_GET['post'] ? $_GET['post'] : false;
        if ($get_popup_post_number) {
?>
            <p>Add this code to theme file to run slider:</br> &lt;?php echo do_shortcode('[FavoriteProducts pagenumber="<?php echo esc_attr($get_popup_post_number); ?>"]'); ?&gt;</p>
            <input id="slider_fp_page_number" type="hidden" name="slider_fp_page_number" value="<?php echo esc_attr($get_popup_post_number); ?>">

        <?php
        } else {
            echo "Instructionse will show up once you save the post.";
        }
    }


    /**
     * Meta box display callback.
     *
     * @param WP_Post $post Current post object.
     */
    function fpsl_SD_post_meta($post)
    {

        ?>
        <div class="hcf_box">
            <style scoped>
                .hcf_box {
                    display: flex;
                    flex-direction: column;
                }

                .hcf_field {
                    display: flex;
                    flex-direction: column;
                }

                label {
                    margin: 10px 0 5px 0;
                }

                .div_cat {
                    background: #cfe9ff;
                    padding: 0 10px 10px 10px;
                    margin: 10px 0 0 0;
                }

                .div_cat2 {
                    background: #FFE5CF;
                    padding: 0 10px 10px 10px;
                    margin: 10px 0 0 0;
                }

                .wp-die-message,
                p {
                    font-size: 13px;
                    line-height: 1.5;
                    margin: 0;
                }
                /* Style for the product wrapper */
                .custom-product-wrapper {
                    border: 1px solid #ddd;
                    padding: 10px;
                    margin-bottom: 10px;
                    width: 171px;
                }

                /* Style for the checkbox */
                .product-checkbox {
                    margin-right: 10px;
                }

                /* Style for the product title */
                .custom-product-title {
                    font-size: 18px;
                    margin: 0;
                }

                /* Style for the product price */
                .custom-product-price {
                    color: #0073e6;
                }

                /* Style for the product link */
                .custom-product-link {
                    display: block;
                    color: #333;
                    text-decoration: none;
                    margin-top: 5px;
                }

                /* Hover effect on the product wrapper */
                .custom-product-wrapper:hover {
                    background-color: #f9f9f9;
                }
                .wrapboxes {
                    display: flex;
                    flex-wrap: wrap;
                }   
            </style>
<?php 
?>

<p class="meta-options hcf_field">
                <label for="<?php echo "fpNaslov"; ?>">Naslov iznad slajdera</label>
                <input type="text" id="<?php echo "fpNaslov"; ?>" name="<?php echo "fpNaslov"; ?>" value="<?php echo esc_attr(get_post_meta(get_the_ID(), "fpNaslov", true)); ?>">

            </p>
            <br />
<label >Izaberite proizvode koje hocete da dodate u slajder</label>
<div class="wrapboxes">

<?php
$args = array(
    'post_type'      => 'product', // Set post type to 'product'
    'posts_per_page' => -1, // Display all products (set to -1 for all)
);

$products_query = new WP_Query( $args );

// Get the saved array of selected product IDs from post meta
$selected_products = get_post_meta( get_the_ID(), 'fp_products', true );
//var_dump($selected_products);
// Convert the string to an array if it's not already
$selected_products = is_array($selected_products) ? $selected_products : array();

if ( $products_query->have_posts() ) :
    ?>
     <form id="productSelectionForm" method="post" enctype="multipart/form-data">
            
        <?php
        while ( $products_query->have_posts() ) : $products_query->the_post();

            // Get product data
            $product_id = get_the_ID();
            $product = wc_get_product( $product_id );
            $product_title = get_the_title();
            $product_price = $product->get_price_html();
            $product_permalink = get_permalink();
            $product_thumbnail = get_the_post_thumbnail( $product_id, 'thumbnail' ); // Change 'thumbnail' to the desired image size

            // Output custom HTML for each product with checkbox and thumbnail
            ?>
            <div class="custom-product-wrapper">
                <input type="checkbox" class="product-checkbox" name="fp_products[]" value="<?php echo esc_attr( $product_id ); ?>" <?php checked( in_array( $product_id, $selected_products ), true ); ?> />
                <div class="product-thumbnail">
                    <?php echo $product_thumbnail; ?>
                </div>
                <div class="product-info">
                    <h2 class="custom-product-title"><?php echo esc_html( $product_title ); ?></h2>
                    <div class="custom-product-price"><?php echo $product_price; ?></div>
                    <a class="custom-product-link" href="<?php echo esc_url( $product_permalink ); ?>">Pogledaj</a>
                </div>
            </div>
            <?php

        endwhile;
        ?>
    </form>
    <?php
    wp_reset_postdata();
else :
    echo __( 'No products found', 'your-text-domain' );
endif;
?>


            </div>
            <br />
        </div>
<?php
    }

    function fpsl_sd_save_meta_box($post_id)
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if ($parent_id = wp_is_post_revision($post_id)) {
            $post_id = $parent_id;
        }
    
        $fields = [
            'fpNaslov',
            'fp_products',
        ];
    
        foreach ($fields as $field) {
            if (array_key_exists($field, $_POST)) {
                update_post_meta($post_id, $field, $_POST[$field]);
            } else {
                delete_post_meta($post_id, $field);
            }
        }
    }
    


    /**class end*/
}
new Fpsl_favoriteProductsMeta();

