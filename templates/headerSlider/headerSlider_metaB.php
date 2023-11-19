<?php

/* 
 * sd_login metaboxes.
 */
class fpsl_HeaderSliderMeta
{

    public $selectSlideTheme;

    public function __construct()
    {

        add_action('add_meta_boxes', array($this, 'fpsl_sd_register_metaboxes'));
        add_action('save_post', array($this, 'fpsl_sd_save_meta_box'));
    }


    /**
     *  It will register metaboxes
     */
    public function fpsl_sd_register_metaboxes($post)
    {
        //This will turn off/on boxes for specific theme. Add theme conditions here
        $this->selectSlideTheme = esc_attr(get_post_meta(get_the_ID(), 'selectSlideTheme', true));
        if ($this->selectSlideTheme == "headerSlider") {
            add_meta_box('info_box_for_fp_popup', __('Instructions how to run popup', 'popup'), [$this, 'fpsl_instructions'], ['fp_images']);
            add_meta_box('sd_login_meta_box', __("Unesi tekst na slajdu"), array($this, 'fpsl_SD_post_meta'), 'fp_images', 'advanced', 'default');
        }
    }
    public function fpsl_instructions($post)
    {
        $get_popup_post_number = $_GET['post'] ? $_GET['post'] : false;
        if ($get_popup_post_number) {
?>
            <p>Add this code to theme file to run slider:</br> &lt;?php echo do_shortcode('[headerSlider pagenumber="<?php echo esc_attr($get_popup_post_number); ?>"]'); ?&gt;</p>
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
            </style>

<?php 

$number_of_slides = esc_attr(get_post_meta(get_the_ID(), 'fpsl_number_of_slides', true)) ? esc_attr(get_post_meta(get_the_ID(), 'fpsl_number_of_slides', true)) : 1;
for($x=1; $x<=$number_of_slides; $x++) {?>
            <p class="meta-options hcf_field">
                <label for="<?php echo "slider_fp_$x"; ?>">First Paragraph</label>
                <input id="<?php echo "slider_fp_$x"; ?>" name="<?php echo "slider_fp_$x"; ?>" value="<?php echo esc_attr(get_post_meta(get_the_ID(),  "slider_fp_$x", true)); ?>">

            </p>

            <p class="meta-options hcf_field">
                <label for="<?php echo "slider_fp2_$x"; ?>">Second Paragraph</label>
                <input id="<?php echo "slider_fp2_$x"; ?>" name="<?php echo "slider_fp2_$x"; ?>" value="<?php echo esc_attr(get_post_meta(get_the_ID(), "slider_fp2_$x", true)); ?>">

            </p>
            <br />
            <div class="div_cat">
                <p class="meta-options hcf_field">
                    <label for="<?php echo "category1_$x"; ?>">Cat 1 Name</label>
                    <input id="<?php echo "category1_$x"; ?>" name="<?php echo "category1_$x"; ?>" value="<?php echo esc_attr(get_post_meta(get_the_ID(),"category1_$x", true)); ?>">

                </p>

                <p class="meta-options hcf_field">
                    <label for="<?php echo "category1_link_$x"; ?>">Cat 1 Link</label>
                    <input id="<?php echo "category1_link_$x"; ?>" name="<?php echo "category1_link_$x"; ?>" value="<?php echo esc_attr(get_post_meta(get_the_ID(), "category1_link_$x", true)); ?>">

                </p>

            </div>
            <div class="div_cat">
                <p class="meta-options hcf_field">
                    <label for="<?php echo "category2_$x"; ?>">Cat 2 Name</label>
                    <input id="<?php echo "category2_$x"; ?>" name="<?php echo "category2_$x"; ?>" value="<?php echo esc_attr(get_post_meta(get_the_ID(), "category2_$x", true)); ?>">

                </p>

                <p class="meta-options hcf_field">
                    <label for="<?php echo "category2_link_$x"; ?>">Cat 2 Link</label>
                    <input id="<?php echo "category2_link_$x"; ?>" name="<?php echo "category2_link_$x"; ?>" value="<?php echo esc_attr(get_post_meta(get_the_ID(), "category2_link_$x", true)); ?>">

                </p>

            </div>
            <div class="div_cat">
                <p class="meta-options hcf_field">
                    <label for="<?php echo "category3_$x"; ?>">Cat 3 Name</label>
                    <input id="<?php echo "category3_$x"; ?>" name="<?php echo "category3_$x"; ?>" value="<?php echo esc_attr(get_post_meta(get_the_ID(), "category3_$x", true)); ?>">

                </p>

                <p class="meta-options hcf_field">
                    <label for="<?php echo "category3_link_$x"; ?>">Cat 3 Link</label>
                    <input id="<?php echo "category3_link_$x"; ?>" name="<?php echo "category3_link_$x"; ?>" value="<?php echo esc_attr(get_post_meta(get_the_ID(), "category3_link_$x", true)); ?>">

                </p>

            </div>
            <div class="div_cat">
                <p class="meta-options hcf_field">
                    <label for="<?php echo "category4_$x"; ?>">Cat 4 Name</label>
                    <input id="<?php echo "category4_$x"; ?>" name="<?php echo "category4_$x"; ?>" value="<?php echo esc_attr(get_post_meta(get_the_ID(),  "category4_$x", true)); ?>">

                </p>

                <p class="meta-options hcf_field">
                    <label for="<?php echo "category4_link_$x"; ?>">Cat 4 Link</label>
                    <input id="<?php echo "category4_link_$x"; ?>" name="<?php echo "category4_link_$x"; ?>" value="<?php echo esc_attr(get_post_meta(get_the_ID(), "category4_link_$x", true)); ?>">

                </p>

            </div>
            <p class="form-field"><br>
                    <?php  $url = esc_attr(get_post_meta(get_the_ID(), "recipes_pic04_$x", true)); 
                            $default_pic = SITE_URL . '/wp-content/plugins/frontpage-slider/inc/img/woocommerce-placeholder-324x324.png'; 
                    //var_dump($url);?>

                    <img src="<?php echo !empty($url) ? $url : $default_pic;?>"  width="60" height="60" id="<?php echo "recipes_picsrc04_$x"; ?>" /><br/>

                        <!---<label for="recipes_pic04">Image</label> --->
                        <input id="<?php echo "recipes_pic04_$x"; ?>" style="display: none;"
                            type="text"
                            name="<?php echo "recipes_pic04_$x"; ?>"
                            value="<?php echo !empty($url) ? $url : $default_pic; ?>" > <br/>
                        <input id="<?php echo "lokacije_my_upl_button01_$x";?>" type="button" class="button" value="Upload Image" />

                    <script>
                    jQuery(document).ready(function($){
                    var mediaUploader;
                    $('#<?php echo "lokacije_my_upl_button01_$x";?>').click(function(e) {
                    e.preventDefault();
                    if (mediaUploader) {
                    mediaUploader.open();
                    return;
                    }
                    mediaUploader = wp.media.frames.file_frame = wp.media({
                    title: 'Choose Image',
                    button: {
                    text: 'Choose Image'
                    }, multiple: false });
                    mediaUploader.on('select', function() {
                    var attachment = mediaUploader.state().get('selection').first().toJSON();
                    $('#<?php echo "recipes_pic04_$x"; ?>').val(attachment.url);
                    $( '#<?php echo "recipes_picsrc04_$x"; ?>' ).attr( 'src', attachment.url );
                    });
                    mediaUploader.open();
                    });
                    });
                    </script>
                            
                </p>
<?php }?>
        </div>
<?php

    }

    function fpsl_sd_save_meta_box($post_id)
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if ($parent_id = wp_is_post_revision($post_id)) {
            $post_id = $parent_id;
        }
        $number_of_slides = esc_attr(get_post_meta(get_the_ID(), 'fpsl_number_of_slides', true)) ? esc_attr(get_post_meta(get_the_ID(), 'fpsl_number_of_slides', true)) : 1;
        $fields = [];
        for ($i = 0; $i <= $number_of_slides; $i++) {
            array_push($fields , 
            "slider_fp_$i",
            "slider_fp2_$i",
            "category1_$i",
            "category1_link_$i",
            "category2_$i",
            "category2_link_$i",
            "category3_$i",
            "category3_link_$i",
            "category4_$i",
            "category4_link_$i",
            "recipes_pic04_$i"
        );
        }
       
        foreach ($fields as $field) {
            if (array_key_exists($field, $_POST)) {
                update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
            }
        }
        unset($fields, $field);
    }



    /**class end*/
}
new fpsl_HeaderSliderMeta();