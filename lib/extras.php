<?php
// Add class to images
// @link http://stackoverflow.com/a/22078964
add_filter( 'the_content', 'add_image_responsive_class' );
function add_image_responsive_class( $content ) {
   global $post;
   
   $pattern ="/<img(.*?)class=\"(.*?)\"(.*?)>/i";
   $replacement = '<img$1class="$2 responsive-img"$3>';
   $content = preg_replace( $pattern, $replacement, $content );
   
   return $content;
}

// Replace h3 with h4 for all widget titles
// @link https://sridharkatakam.com/how-to-change-widget-titles-markup-in-genesis/
add_filter( 'genesis_register_sidebar_defaults', 'custom_register_sidebar_defaults' );
function custom_register_sidebar_defaults( $defaults ) {
	$defaults['before_title'] = '<h5 class="widget-title widgettitle">';
	$defaults['after_title'] = '</h5>';
	return $defaults;
}

// Remove Parentheses on Archive/Categories
// @link http://wordpress.stackexchange.com/questions/88545/how-to-remove-the-parentheses-from-the-category-widget
add_filter( 'wp_list_categories', 'mg_categories_postcount_filter', 10, 2 );
add_filter( 'get_archives_link', 'mg_categories_postcount_filter', 10, 2 );
function mg_categories_postcount_filter( $variable ) {
   $variable = str_replace( '(', '<span class="badge post-count">', $variable );
   $variable = str_replace( ')', '</span>', $variable );
   return $variable;
}