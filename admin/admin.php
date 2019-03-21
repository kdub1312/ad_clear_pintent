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

    

        function add_pinterest_fields( $form_fields, $post ) {
       
            $field_value = get_post_meta( $post->ID, 'pin-description', true );

            $form_fields['pin-description'] = array(
                'value' => $field_value ? $field_value : '',
                'label' => __( 'Pin Description' ),
                'helps' => __( 'Add a short description for Pinterest SEO' ),
                'input' => 'textarea'
            );

            return $form_fields;
          }
        
        
            add_filter( 'attachment_fields_to_edit', 'add_pinterest_fields', null, 2 );

?>
