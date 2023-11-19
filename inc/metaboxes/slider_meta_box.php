<?php

/* 
 * sd_login metaboxes.
 */
class fpsl_Slider_meta_boxes
{
    public $runTheme;

    function __construct()
    {
        add_action('add_meta_boxes', array($this, 'fpsl_sd_register_metaboxes'));
        add_action('save_post', array($this, 'fpsl_sd_save_meta_box'));
    }


    /**
     *  It will register metaboxes
     */
    public function fpsl_sd_register_metaboxes()


    {
        add_meta_box('pick_a_theme', __('Pick a theme from dropdown', 'popup'), [$this, 'fpsl_pickAtheme'], ['fp_images']);
    }



    /**
     * Meta box display callback.
     *
     * @param WP_Post $post Current post object.
     */

    function fpsl_pickAtheme($post)
    {
        if (esc_attr(get_post_meta(get_the_ID(), 'selectSlideTheme', true))) {
            $selectSlideTheme = esc_attr(get_post_meta(get_the_ID(), 'selectSlideTheme', true));
            //var_dump($selectSlideTheme);
        } else {
            $selectSlideTheme = false;
        }
        $getFunction = new fpsl_Frontpage_slider();
        $listTemplatesInOptions = $getFunction->getSubFolders();
        //var_dump($listTemplatesInOptions);
?>
        <p>Pick a theme from dropdown below and save a post.</p>
        <select name="selectSlideTheme">
            <option value="" disabled="disabled" selected="true">Select...</option>
            <?php
            foreach($listTemplatesInOptions as $Tslide) {?>
            <option value="<?php echo $Tslide?>" <?php echo $selectSlideTheme ==  $Tslide ? "selected='true'"  : ""; ?>><?php echo $Tslide?></option>
            <?php } unset($Tslide);?>
            
        </select>
        <p class="meta-options hcf_field">
                <label for="fpsl_number_of_slides">Enter number of slides</label><br>
                <input type="number" min="0" id="fpsl_number_of_slides" name="fpsl_number_of_slides" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'fpsl_number_of_slides', true)) ? esc_attr(get_post_meta(get_the_ID(), 'fpsl_number_of_slides', true)) : 1; ?>">

            </p>

<?php

    }

    function fpsl_sd_save_meta_box($post_id)
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if ($parent_id = wp_is_post_revision($post_id)) {
            $post_id = $parent_id;
        }
        $fields = [
            'slider_fp_page_number',
            'selectSlideTheme',
            'fpsl_number_of_slides'

        ];
        foreach ($fields as $field) {
            if (array_key_exists($field, $_POST)) {
                update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
            }
        }
    }



    /**class end*/
}


//Run common theme options
new fpsl_Slider_meta_boxes();
