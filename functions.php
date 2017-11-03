<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Materialize Genesis' );
define( 'CHILD_THEME_URL', 'http://www.recommendwp.com/' );
define( 'CHILD_THEME_VERSION', '1.0.0' );

//* Child theme specific folder paths 
define( 'MG_CSS', CHILD_URL . '/assets/css/' );
define( 'MG_JS', CHILD_URL . '/assets/js/' );
define( 'MG_IMG', CHILD_URL . '/images/' );
define( 'MG_LIB', CHILD_DIR . '/lib/' );
define( 'MG_MODULES', CHILD_DIR . '/lib/modules/' );

//* Enqueue Google Fonts
add_action( 'wp_enqueue_scripts', 'mg_google_fonts' );
function mg_google_fonts() {

	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Material+Icons', array(), CHILD_THEME_VERSION );

}

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

//* Add Accessibility support
// add_theme_support( 'genesis-accessibility', array( 'headings', 'drop-down-menu',  'search-form', 'skip-links', 'rems' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom background
// add_theme_support( 'custom-background' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Unregister unneeded sidebars
unregister_sidebar( 'header-right' );

//* Remove the secondary navigation
remove_action( 'genesis_after_header', 'genesis_do_subnav' );

//* Remove header
remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );
remove_action( 'genesis_header', 'genesis_do_header' );

add_theme_support( 'genesis-structural-wraps', array( 'header', 'menu-primary', 'footer-copyright', 'site-inner', 'footer-widgets' ) );

//* Move Sidebar Secondary After Content
remove_action( 'genesis_after_content_sidebar_wrap', 'genesis_get_sidebar_alt' );
add_action( 'genesis_after_content', 'genesis_get_sidebar_alt' );

//* Include php files from lib folder
//* @link https://gist.github.com/theandystratton/5924570
foreach ( glob( dirname( __FILE__ ) . '/lib/*.php' ) as $file ) {
	require_once $file;
}