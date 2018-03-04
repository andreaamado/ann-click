<?php
/**
 * Ann Click - Settings Metabox
 */

 // exit if file is called directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register meta box(es).
 */
function ann_click_add_metabox() {

    /* Add meta boxes on the 'add_meta_boxes' hook. */
    add_meta_box(
        'ann-click', // unique ID, domain
        esc_html__( 'Ann Click', 'ann-click' ), // title and domain
        'ann_click_class_meta_box', // callback function
        'post', // admin page (or post type)
        'side', // context
        'default' // priority
    );
}
add_action( 'add_meta_boxes', 'ann_click_add_metabox' );

/**
 *  Display the post meta boxes. 
 */
function ann_click_class_meta_box( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'ann_click_cf_nonce' ); ?>
    <p>
        <label for="ann-click-phone"><?php echo esc_html__( 'Phone', 'ann-click' ); ?></label>
        <br />
        <input class="widefat" type="text" name="ann_click_cf_phone" id="ann-click-phone" value="<?php echo esc_attr( get_post_meta( $post->ID, 'ann_click_cf_phone', true ) ); ?>" size="30" />
    </p>
    <p>
        <label for="ann-click-email"><?php echo esc_html__( 'Email', 'ann-click' ); ?></label>
        <br />
        <input class="widefat" type="text" name="ann_click_cf_email" id="ann-click-email" value="<?php echo esc_attr( get_post_meta( $post->ID, 'ann_click_cf_email', true ) ); ?>" size="30" />
    </p>
    <p>
        <label for="ann-click-website"><?php echo esc_html__( 'Website', 'ann-click' ); ?></label>
        <br />
        <input class="widefat" type="text" name="ann_click_cf_website" id="ann-click-website" value="<?php echo esc_attr( get_post_meta( $post->ID, 'ann_click_cf_website', true ) ); ?>" size="30" />
    </p>
    <p>
        <label for="ann-click-fb"><?php echo esc_html__( 'Facebook', 'ann-click' ); ?></label>
        <br />
        <input class="widefat" type="text" name="ann_click_cf_fb" id="ann-click-fb" value="<?php echo esc_attr( get_post_meta( $post->ID, 'ann_click_cf_fb', true ) ); ?>" size="30" />
    </p>
    <p>
        <label for="ann-click-twitter"><?php echo esc_html__( 'Twitter', 'ann-click' ); ?></label>
        <br />
        <input class="widefat" type="text" name="ann_click_cf_twitter" id="ann-click-twitter" value="<?php echo esc_attr( get_post_meta( $post->ID, 'ann_click_cf_twitter', true ) ); ?>" size="30" />
    </p>
    <p>
        <label for="ann-click-ig"><?php echo esc_html__( 'Instagram', 'ann-click' ); ?></label>
        <br />
        <input class="widefat" type="text" name="ann_click_cf_ig" id="ann-click-ig" value="<?php echo esc_attr( get_post_meta( $post->ID, 'ann_click_cf_ig', true ) ); ?>" size="30" />
    </p>
    <p>
        <label for="ann-click-in"><?php echo esc_html__( 'Linkedin', 'ann-click' ); ?></label>
        <br />
        <input class="widefat" type="text" name="ann_click_cf_in" id="ann-click-in" value="<?php echo esc_attr( get_post_meta( $post->ID, 'ann_click_cf_in', true ) ); ?>" size="30" />
    </p>
  <?php
}

/**
 *  Save the meta box's post metadata.
 */
function ann_click_save_post_meta( $post_id, $post ) {

    /* Verify the nonce before proceeding. */
    if ( !isset( $_POST['ann_click_cf_nonce'] ) || !wp_verify_nonce( $_POST['ann_click_cf_nonce'], basename( __FILE__ ) ) )
      return $post_id;
  
    /* Get the post type object. */
    $post_type = get_post_type_object( $post->post_type );

    /* Check if the current user has permission to edit the post. */
    if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
      return $post_id;
  
    /* Get the posted data and sanitize it for use as an HTML class. */
    $new_meta_phone = ( isset( $_POST['ann_click_cf_phone'] ) ? preg_replace('/[^0-9]/', '', $_POST['ann_click_cf_phone']) : '' ); //sanitize_html_class
    $new_meta_email = ( isset( $_POST['ann_click_cf_email'] ) ? sanitize_email( $_POST['ann_click_cf_email'] ) : '' );
    $new_meta_website = ( isset( $_POST['ann_click_cf_website'] ) ? esc_url( $_POST['ann_click_cf_website'] ) : '' );
    $new_meta_fb = ( isset( $_POST['ann_click_cf_fb'] ) ? esc_url( $_POST['ann_click_cf_fb'] ) : '' );
    $new_meta_twitter = ( isset( $_POST['ann_click_cf_twitter'] ) ? esc_url( $_POST['ann_click_cf_twitter'] ) : '' );
    $new_meta_ig = ( isset( $_POST['ann_click_cf_ig'] ) ? esc_url( $_POST['ann_click_cf_ig'] ) : '' );
    $new_meta_in = ( isset( $_POST['ann_click_cf_in'] ) ? esc_url( $_POST['ann_click_cf_in'] ) : '' );
  
    /* Get the meta value of the custom field key. */
    $meta_phone = get_post_meta( $post_id, 'ann_click_cf_phone', true );
    $meta_email = get_post_meta( $post_id, 'ann_click_cf_email', true );
    $meta_website = get_post_meta( $post_id, 'ann_click_cf_website', true );
    $meta_fb = get_post_meta( $post_id, 'ann_click_cf_fb', true );
    $meta_twitter = get_post_meta( $post_id, 'ann_click_cf_twitter', true );
    $meta_ig = get_post_meta( $post_id, 'ann_click_cf_ig', true );
    $meta_in = get_post_meta( $post_id, 'ann_click_cf_in', true );
  
    /* If a new meta value was added and there was no previous value, add it. */
    /* If the new meta value does not match the old value, update it. */
    /* If there is no new meta value but an old value exists, delete it. */
    if ( $new_meta_phone && '' == $meta_phone ) {
        add_post_meta( $post_id, 'ann_click_cf_phone', $new_meta_phone, true );
    } elseif ( $new_meta_phone && $new_meta_phone != $meta_phone ) {
        update_post_meta( $post_id, 'ann_click_cf_phone', $new_meta_phone );
    } elseif ( '' == $new_meta_phone && $meta_phone ) {
        delete_post_meta( $post_id, 'ann_click_cf_phone', $meta_phone );
    }

    if ( $new_meta_email && '' == $meta_email ) {
        add_post_meta( $post_id, 'ann_click_cf_email', $new_meta_email, true );
    } elseif ( $new_meta_email && $new_meta_email != $meta_email ) {
        update_post_meta( $post_id, 'ann_click_cf_email', $new_meta_email );
    } elseif ( '' == $new_meta_email && $meta_email ) {
        delete_post_meta( $post_id, 'ann_click_cf_email', $meta_email );
    }

    if ( $new_meta_website && '' == $meta_website ) {
        add_post_meta( $post_id, 'ann_click_cf_website', $new_meta_website, true );
    } elseif ( $new_meta_website && $new_meta_website != $meta_website ) {
        update_post_meta( $post_id, 'ann_click_cf_website', $new_meta_website );
    } elseif ( '' == $new_meta_website && $meta_website ) {
        delete_post_meta( $post_id, 'ann_click_cf_website', $meta_website );
    }

    if ( $new_meta_fb && '' == $meta_fb ) {
        add_post_meta( $post_id, 'ann_click_cf_fb', $new_meta_fb, true );
    } elseif ( $new_meta_fb && $new_meta_fb != $meta_fb ) {
        update_post_meta( $post_id, 'ann_click_cf_fb', $new_meta_fb );
    } elseif ( '' == $new_meta_fb && $meta_fb ) {
        delete_post_meta( $post_id, 'ann_click_cf_fb', $meta_fb );
    }

    if ( $new_meta_twitter && '' == $meta_twitter ) {
        add_post_meta( $post_id, 'ann_click_cf_twitter', $new_meta_twitter, true );
    } elseif ( $new_meta_twitter && $new_meta_twitter != $meta_twitter ) {
        update_post_meta( $post_id, 'ann_click_cf_twitter', $new_meta_twitter );
    } elseif ( '' == $new_meta_twitter && $meta_twitter ) {
        delete_post_meta( $post_id, 'ann_click_cf_twitter', $meta_twitter );
    }

    if ( $new_meta_ig && '' == $meta_ig ) {
        add_post_meta( $post_id, 'ann_click_cf_ig', $new_meta_ig, true );
    } elseif ( $new_meta_ig && $new_meta_ig != $meta_ig ) {
        update_post_meta( $post_id, 'ann_click_cf_ig', $new_meta_ig );
    } elseif ( '' == $new_meta_ig && $meta_ig ) {
        delete_post_meta( $post_id, 'ann_click_cf_ig', $meta_ig );
    }

    if ( $new_meta_in && '' == $meta_in ) {
        add_post_meta( $post_id, 'ann_click_cf_in', $new_meta_in, true );
    } elseif ( $new_meta_in && $new_meta_in != $meta_in ) {
        update_post_meta( $post_id, 'ann_click_cf_in', $new_meta_in );
    } elseif ( '' == $new_meta_in && $meta_in ) {
        delete_post_meta( $post_id, 'ann_click_cf_in', $meta_in );
    }
}
add_action( 'save_post', 'ann_click_save_post_meta', 10, 2 );
