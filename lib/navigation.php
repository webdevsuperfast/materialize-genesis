<?php
add_filter( 'wp_nav_menu_args', 'rwp_nav_menu_args', 10, 2 );
function rwp_nav_menu_args( $args ) {
	require_once( RWP_MODULES . 'wp_materialize_navwalker.php' );

	if ( 'primary' === $args['theme_location'] ) {
		$args['container'] = '';
		$args['items_wrap'] = '<ul id="%1$s" class="right hide-on-med-and-down %2$s">%3$s</ul>';
		// $args['fallback_cb'] = 'Materialize_CSS_Menu_Walker::fallback';
        // $args['walker'] = new Materialize_CSS_Menu_Walker();
		// $args['menu_class'] = 'right hide-on-med-and-down';
		$args['walker'] = new wp_materialize_navwalker();
	}

	if ( 'secondary' === $args['theme_location'] ) {
		$args['container'] = '';
		$args['items_wrap'] = '<ul id="%1$s" class="%2$s">%3$s</ul>';
		$args['walker'] = new wp_materialize_navwalker();
	}

	return $args;
}

add_filter( 'wp_nav_menu', 'rwp_nav_menu_markup_filter', 10, 2 );
function rwp_nav_menu_markup_filter( $html, $args ) {
	$data_target = 'mobile-navigation';
	
	if ( 'primary' == $args->theme_location ) {
		$output = '<a href="#" data-activates="'.$data_target.'" class="button-collapse"><i class="material-icons">menu</i></a>';
		$output .= apply_filters( 'rwp_navbar_brand', rwp_navbar_brand_markup() );
	}
	
	$output .= $html;
	
	return $output;
}

function rwp_navbar_brand_markup() {
	$output = '<a class="brand-logo" id="logo" title="'.esc_attr( get_bloginfo( 'description' ) ).'" href="'.esc_url( home_url( '/' ) ).'">';
	$output .= get_bloginfo( 'name' );
	$output .= '</a>';
	
	return $output;
}