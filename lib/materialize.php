<?php
// Adds Filters Automatically from Array Keys
// @link https://gist.github.com/bryanwillis/0f22c3ddb0d0b9453ad0
add_action( 'genesis_meta', 'mg_add_array_filters_genesis_attr' );
function mg_add_array_filters_genesis_attr() {
    $filters = mg_merge_genesis_attr_classes();
    
    foreach( array_keys( $filters ) as $context ) {
        $context = "genesis_attr_$context";
        add_filter( $context, 'mg_add_markup_sanitize_classes', 10, 2 );
    }
}

// Clean classes output
function mg_add_markup_sanitize_classes( $attr, $context ) {
    $classes = array();
    
    if ( has_filter( 'mg_clean_classes_output' ) ) {
        $classes = apply_filters( 'mg_clean_classes_output', $classes, $context, $attr );
    }
    
    $value = isset( $classes[$context] ) ? $classes[$context] : array();
    
    if ( is_array( $value ) ) {
        $classes_array = $value;
    } else {
        $classes_array = explode( ' ', ( string )$value );
    }

    $classes_array = array_map( 'sanitize_html_class', $classes_array );
    $attr['class'].= ' ' . implode( ' ', $classes_array );
    return $attr;
}

// Default array of classes to add
function mg_merge_genesis_attr_classes() {
    // $navclass = get_theme_mod( 'navtype', 'navbar-static-top' );
    $classes = array(
            'structural-wrap' => 'container',
			'content-sidebar-wrap' => 'row',
			'content' => 'col s12 m8',
			'sidebar-primary' => 'col s12 m4',
			'site-footer' => 'page-footer',
			'footer-widgets' => 'container',
			'entry-image' => 'responsive-img',
			'breadcrumb-wrapper' => 'col s12'
    );
    
    if ( has_filter( 'mg_add_classes' ) ) {
        $classes = apply_filters( 'mg_add_classes', $classes );
    }

    return $classes;
}

// Adds classes array to mg_add_markup_class() for cleaning
add_filter( 'mg_clean_classes_output', 'mg_modify_classes_based_on_extras', 10, 3) ;
function mg_modify_classes_based_on_extras( $classes, $context, $attr ) {
    $classes = mg_merge_genesis_attr_classes( $classes );
    return $classes;
}

// Layout
// Modify materializecss classes based on genesis_site_layout
add_filter('mg_add_classes', 'mg_modify_classes_based_on_template', 10, 3);

// Remove unused layouts
function mg_layout_options_modify_classes_to_add( $classes_to_add ) {

    $layout = genesis_site_layout();
    
    if ( 'full-width-content' === $layout ) {
        $classes_to_add['content'] = 'col s12';
    }

    // sidebar-content          // supported
    if ( 'sidebar-content' === $layout ) {
        $classes_to_add['content'] = 'col m8 push-m4';
        $classes_to_add['sidebar-primary'] = 'col m4 pull-m8';
    }

    // content-sidebar-sidebar  // supported
    if ( 'content-sidebar-sidebar' === $layout ) {
        $classes_to_add['content'] = 'col m7';
        $classes_to_add['sidebar-primary'] = 'col m3';
        $classes_to_add['sidebar-secondary'] = 'col m2';
    }


    // sidebar-sidebar-content  // supported
    if ( 'sidebar-sidebar-content' === $layout ) {
        $classes_to_add['content'] = 'col m7 push-m5';
        $classes_to_add['sidebar-primary'] = 'col m3 pull-m5';
        $classes_to_add['sidebar-secondary'] = 'col m2 pull-m10';
    }


    // sidebar-content-sidebar  // supported
    if ( 'sidebar-content-sidebar' === $layout ) {
        $classes_to_add['content'] = 'col m7 push-m2';
        $classes_to_add['sidebar-primary'] = 'col m3 push-m2';
        $classes_to_add['sidebar-secondary'] = 'col m2 pull-m10';
    }

    return $classes_to_add;
};

function mg_modify_classes_based_on_template( $classes_to_add ) {
    $classes_to_add = mg_layout_options_modify_classes_to_add( $classes_to_add );

    return $classes_to_add;
}

add_filter( 'genesis_structural_wrap-footer-widgets', 'mg_filter_footer_widgets_wrap', 10, 2 );
function mg_filter_footer_widgets_wrap( $output, $original_output ) {
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

add_filter( 'genesis_structural_wrap-menu-primary', 'mg_filter_menu_wrap', 10, 2 );
function mg_filter_menu_wrap( $output, $original_output ) {
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