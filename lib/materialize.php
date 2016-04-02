<?php
add_filter( 'genesis_attr_structural-wrap', 'rwp_add_markup_class', 10, 2 );
add_filter( 'genesis_attr_content-sidebar-wrap', 'rwp_add_markup_class', 10, 2 );
add_filter( 'genesis_attr_content', 'rwp_add_markup_class', 10, 2 );
add_filter( 'genesis_attr_sidebar-primary', 'rwp_add_markup_class', 10, 2 );
add_filter( 'genesis_attr_site-footer', 'rwp_add_markup_class', 10, 2 );
add_filter( 'genesis_attr_footer-widgets', 'rwp_add_markup_class', 10, 2 );
function rwp_add_markup_class( $attr, $context ) {
	$classes_to_add = apply_filters( 'rwp_classes_to_add', array(
		'structural-wrap' => 'container',
		'content-sidebar-wrap' => 'row',
		'content' => 'col s12 m8',
		'sidebar-primary' => 'col s12 m4',
		'site-footer' => 'page-footer',
		'footer-widgets' => 'container'
	), $context, $attr );
	
	$value = isset( $classes_to_add[ $context ] ) ? $classes_to_add[ $context ] : array();
	
	if ( is_array( $value ) ) {
		$classes_array = $value;
	} else {
		$classes_array = explode( ' ', (string) $value );
	}
	
	$classes_array = apply_filters( 'rwp_add_class', $classes_array, $context, $attr );
	
	$classes_array = array_map( 'sanitize_html_class', $classes_array );
	
	$attr['class'] .= ' ' . implode( ' ', $classes_array );
	
	return $attr;
}

add_filter( 'genesis_structural_wrap-footer-widgets', 'rwp_filter_footer_widgets_wrap', 10, 2 );
function rwp_filter_footer_widgets_wrap( $output, $original_output ) {
	switch( $original_output ) {
		case 'open':
			$output = str_replace( 'class="wrap container', 'class="wrap row', $output );
			break;
		case 'close':
			break;
		default:
			break;
	}

	return $output;
}

add_filter( 'genesis_structural_wrap-menu-primary', 'rwp_filter_menu_wrap', 10, 2 );
function rwp_filter_menu_wrap( $output, $original_output ) {
	switch( $original_output ) {
		case 'open':
			$output = str_replace( 'class="wrap', 'class="nav-wrapper wrap', $output );
			break;
		case 'close':
			$output = wp_nav_menu( array( 'theme_location' => 'secondary', 'echo' => 0, 'menu_id' => 'mobile-navigation', 'menu_class' => 'side-nav', 'container' => '' ) ) . $output;
			break;
		default:
			break;
	}
	return $output;
}