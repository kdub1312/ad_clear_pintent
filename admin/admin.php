<?php

//exit if file is called directly
if (! defined( 'ABSPATH' ) ) {
    
    exit;
    
}

/**
 * Adding a custom field to Attachment Edit Fields
 * @param  array $form_fields 
 * @param  WP_POST $post        
 * @return array              
 */

    
        //add attachment fields
        function ad_add_pinterest_fields( $form_fields, $post ) {
       
            $field_value = get_post_meta( $post->ID, 'pin-description', true );

            $form_fields['pin-description'] = array(
                'value' => $field_value ? esc_textarea($field_value) : '',
                'label' => __( 'Pin Description' ),
                'helps' => __( 'Add a short description for Pinterest SEO' ),
                'input' => 'textarea'
            );

            return $form_fields;
          }
        
        
            add_filter( 'attachment_fields_to_edit', 'ad_add_pinterest_fields', null, 2 );

        //save attachment fields
        function ad_save_pinterest_fields( $attachment_id ) {
            
            if ( isset( $_REQUEST['attachments'][$attachment_id]['pin-description'] ) ) {
                $pinDescription = sanitize_text_field( $_REQUEST['attachments'][$attachment_id]['pin-description'] );
                update_post_meta( $attachment_id, 'pin-description', $pinDescription );
            }
            
        }

            add_action( 'edit_attachment', 'ad_save_pinterest_fields' );

?>
