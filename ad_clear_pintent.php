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

//exit if file is called directly
if (! defined( 'ABSPATH' ) ) {
    
    exit;
    
}

if ( is_admin() ) {
    
    require_once plugin_dir_path( __FILE__ ) . 'admin/admin.php';
    
}

?>