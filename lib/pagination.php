<?php
// Pagination Numeric
add_filter( 'genesis_prev_link_text', 'mg_genesis_prev_link_text_numeric' );
add_filter( 'genesis_next_link_text', 'mg_genesis_next_link_text_numeric' );

function mg_genesis_prev_link_text_numeric( $text ) {
    if ( 'numeric' === genesis_get_option( 'posts_nav' ) ) {
        return '<i class="material-icons">chevron_left</i>';
    }
    return $text;
}

function mg_genesis_next_link_text_numeric( $text ) {
    if ( 'numeric' === genesis_get_option( 'posts_nav' ) ) {
        return '<i class="material-icons">chevron_right</i>';
    }
    return $text;
}