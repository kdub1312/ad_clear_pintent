<?php
   /*
   Plugin Name: AD Clear Pintent
   Plugin URI: http://foodcoach.me
   description: A Plugin to Supercharge Pinterest Integration with Wordpress
   Version: 1.0
   Author: Kevin Wagner
   Author URI: TBD
   License: MIT
   */
function ad_clear_pintent_enqueue_script() {   
        wp_register_style( 'ad_clear_pintent_styles', plugin_dir_url( __FILE__ ) . 'css/styles.css', array( 'bootstrap-css' ), '1.0' );
        wp_enqueue_style( 'ad_clear_pintent_styles' );
}
add_action('wp_enqueue_scripts', 'ad_clear_pintent_enqueue_script');

function ad_clear_pintent($atts=[], $content=null) {
    
    $content = "<div class='clear-pintent'>" . $content . "</div>";
    
    $content = do_shortcode($content);
    
    return $content;
    
}
add_shortcode('adclearpintent', 'ad_clear_pintent');
?>