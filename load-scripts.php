<?php

    //load scripts
    add_action('wp_enqueue_scripts','baw_load_scripts');
 
function baw_load_scripts(){ 
     wp_enqueue_style('baw-css', plugins_url( '/baw-accordion.css', __FILE__));
     wp_register_script('baw-script',plugins_url( '/baw-script.js', __FILE__), array('jquery'), '1.0', true);   
     wp_enqueue_script('baw-script');
     
}