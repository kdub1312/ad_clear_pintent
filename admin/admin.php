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
                'input' => 'textarea',
                'textarea' => '<textarea id="attachments-20-pin-description" name="attachments[20][pin-description]" style="width: 100%;"></textarea>'
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

        add_filter( 'image_send_to_editor', 'ad_add_pin_description_to_image', 10, 2 );

        function ad_add_pin_description_to_image( $html, $attachment_id ) 
        {
            if ($attachment_id)
            {
                //check if there is pin-description for the image
                $pin_description = esc_attr(get_post_meta($attachment_id, 'pin-description', true));

                //if there is a pin description set for the image, add data-pin-description attr
                if ($pin_description)
                {
                    $document = new DOMDocument();
                    $document->loadHTML($html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

                    $imgs = $document->getElementsByTagName('img');

                    foreach ($imgs as $img)
                    {
                        //add the data attribute
                        $img->setAttribute('data-pin-description', $pin_description);
                    }

                    $html = $document->saveHTML();
                }
            }

            return $html;
        }

?>
