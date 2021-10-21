<?php

/* 
 * sd_login metaboxes.
 */
class Slider_meta_boxes {
    public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'sd_register_metaboxes' ) );
        add_action( 'save_post', array( $this, 'sd_save_meta_box' ) );
        
    }


   /**
     *  It will register metaboxes
     */
    public function sd_register_metaboxes() { 
        
      add_meta_box( 'sd_login_meta_box', __( "Unesi tekst na slajdu"), array( $this, 'SD_post_meta' ), 'fp_images', 'normal', 'high' );
    }
    
    
    
/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function SD_post_meta( $post ) { ?>
   <div class="hcf_box">
    <style scoped>
        .hcf_box{
            display: flex;
            flex-direction: column;
        }
        .hcf_field{
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
        .wp-die-message, p {
    font-size: 13px;
    line-height: 1.5;
    margin: 0;
}
    </style>
   
    <p class="meta-options hcf_field">
        <label for="slider_fp">First Paragraph</label>
        <input id="slider_fp" name="slider_fp" 
        value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'slider_fp', true ) ); ?>"> 
    
    </p>
   
    <p class="meta-options hcf_field">
        <label for="slider_fp2">Second Paragraph</label>
        <input id="slider_fp2" name="slider_fp2" 
        value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'slider_fp2', true ) ); ?>"> 
    
    </p>
    <br/>
    <div class="div_cat">
    <p class="meta-options hcf_field">
        <label for="category1">Cat 1 Name</label>
        <input id="category1" name="category1" 
        value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'category1', true ) ); ?>"> 
    
    </p>
  
    <p class="meta-options hcf_field">
        <label for="category1_link">Cat 1 Link</label>
        <input id="category1_link" name="category1_link" 
        value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'category1_link', true ) ); ?>"> 
    
    </p>
  
    </div>
    <div class="div_cat">
    <p class="meta-options hcf_field">
        <label for="category2">Cat 2 Name</label>
        <input id="category2" name="category2" 
        value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'category2', true ) ); ?>"> 
    
    </p>
  
    <p class="meta-options hcf_field">
        <label for="category2_link">Cat 2 Link</label>
        <input id="category2_link" name="category2_link" 
        value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'category2_link', true ) ); ?>"> 
    
    </p>
  
    </div>
    <div class="div_cat">
    <p class="meta-options hcf_field">
        <label for="category3">Cat 3 Name</label>
        <input id="category3" name="category3" 
        value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'category3', true ) ); ?>"> 
    
    </p>
  
    <p class="meta-options hcf_field">
        <label for="category3_link">Cat 3 Link</label>
        <input id="category3_link" name="category3_link" 
        value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'category3_link', true ) ); ?>"> 
    
    </p>
  
    </div>
    <div class="div_cat">
    <p class="meta-options hcf_field">
        <label for="category4">Cat 4 Name</label>
        <input id="category4" name="category4" 
        value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'category4', true ) ); ?>"> 
    
    </p>
  
    <p class="meta-options hcf_field">
        <label for="category4_link">Cat 4 Link</label>
        <input id="category4_link" name="category4_link" 
        value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'category4_link', true ) ); ?>"> 
    
    </p>
  
    </div>
  
</div>
<?php }

function sd_save_meta_box( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( $parent_id = wp_is_post_revision( $post_id ) ) {
        $post_id = $parent_id;
    }
    $fields = [
        'slider_fp',
        'slider_fp2',
        'category1',
        'category1_link',
        'category2',
        'category2_link',
        'category3',
        'category3_link',
        'category4',
        'category4_link',
       
    ];
    foreach ( $fields as $field ) {
        if ( array_key_exists( $field, $_POST ) ) {
            update_post_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
        }
     }
}

    
    
    /**class end*/
    }
    
    new Slider_meta_boxes();
