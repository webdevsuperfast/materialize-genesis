<?php
add_action( 'wp_enqueue_scripts', 'rwp_enqueue_scripts' );
function rwp_enqueue_scripts() {
    //* Remove superfish scripts
    wp_deregister_script( 'superfish' );
    wp_deregister_script( 'superfish-args' );

    if ( !is_admin() ) {
        //* comment out the next two lines to load the local copy of jQuery
        wp_deregister_script('jquery');
        wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js', false, '2.1.4');
        wp_enqueue_script('jquery');
        
        //* Materialize JS
        wp_register_script( 'app-materialize-js', RWP_JS . 'materialize.min.js', array( 'jquery' ), null, true );
        wp_enqueue_script( 'app-materialize-js' );

        //* App JS
        wp_register_script( 'app-js', RWP_JS . 'app.min.js', array( 'jquery' ), null, true );
        wp_enqueue_script( 'app-js' );
        
        //* App CSS
        wp_enqueue_style( 'app-css', RWP_CSS . 'app.css' );
    }
}