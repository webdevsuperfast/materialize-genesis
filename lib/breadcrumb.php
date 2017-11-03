<?php
// Changing breadcrumbs to Bootstrap's format
// @link http://jhtechservices.com/2015/05/integrate-bootstraps-breadcrumbs-into-genesis-theme/
add_filter( 'genesis_breadcrumb_args', 'mg_breadcrumb_args' );
function mg_breadcrumb_args( $args ){
	$args['sep'] = '     ';
	$args['prefix'] = sprintf( '<nav><div %s><div %s>', genesis_attr( 'nav-wrapper' ), genesis_attr( 'breadcrumb-wrapper' ) );
    $args['suffix'] = '</div></div></nav>';
    $args['labels']['prefix'] = '';
	$args['labels']['author'] = '';
	$args['labels']['category'] = ''; // Genesis 1.6 and later
	$args['labels']['tag'] = '';
	$args['labels']['date'] = '';
	$args['labels']['search'] = '';
	$args['labels']['tax'] = '';
	$args['labels']['post_type'] = '';
	$args['labels']['404'] = ''; // Genesis 1.5 and later
	return $args;
}

add_filter( 'genesis_build_crumbs', 'mg_build_crumbs', 10, 2 );
function mg_build_crumbs( $crumbs ){
	foreach( $crumbs as &$crumb ){
		$crumb = str_replace( '     ','</span><span class="breadcrumb">', $crumb );
		$class = strpos( $crumb, '</a>' ) ? 'class="breadcrumb"' : 'class="breadcrumb"';
		$crumb = '<span ' . $class .'>' . $crumb . '</span>';
	}

	return $crumbs;
}