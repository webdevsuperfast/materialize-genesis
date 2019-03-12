<?php
add_filter( 'wp_nav_menu_args', 'mg_nav_menu_args', 10, 2 );
function mg_nav_menu_args( $args ) {
	require_once( MG_MODULES . 'wp_materialize_navwalker.php' );

	if ( 'primary' === $args['theme_location'] ) {
		$args['container'] = '';
		// $args['depth'] = ;
		$args['items_wrap'] = '<ul id="%1$s" class="right hide-on-med-and-down %2$s">%3$s</ul>';
		$args['walker'] = new wp_materialize_navwalker();
	}

	if ( 'secondary' === $args['theme_location'] ) {
		$args['container'] = '';
		$args['items_wrap'] = '<ul id="%1$s" class="%2$s">%3$s</ul>';
		// $args['walker'] = new wp_materialize_navwalker();
		$args['depth'] = 1;
	}

	return $args;
}

add_filter( 'wp_nav_menu', 'mg_nav_menu_markup_filter', 10, 2 );
function mg_nav_menu_markup_filter( $html, $args ) {
	$data_target = 'mobile-navigation';
	
	if ( 'primary' == $args->theme_location ) {
		$output = '<a href="#" data-target="'.$data_target.'" class="sidenav-trigger"><i class="material-icons">menu</i></a>';
		$output .= apply_filters( 'mg_navbar_brand', mg_navbar_brand_markup() );
	}
	
	$output .= $html;
	
	return $output;
}

function mg_navbar_brand_markup() {
	$output = '<a class="brand-logo" id="logo" title="'.esc_attr( get_bloginfo( 'description' ) ).'" href="'.esc_url( home_url( '/' ) ).'">';
	$output .= get_bloginfo( 'name' );
	$output .= '</a>';
	
	return $output;
}