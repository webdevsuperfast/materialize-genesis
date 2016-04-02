<?php
//* Replace default footer
remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'rwp_do_footer' );

function rwp_do_footer() {
	genesis_markup( array(
		'html5' => '<div %s>',
		'xhtml' => '<div class="footer-copyright">',
		'context' => 'footer-copyright'
	) );

	genesis_structural_wrap( 'footer-copyright', 'open' );

	$creds_text = sprintf( '[footer_copyright before="%s "] &#x000B7; [footer_childtheme_link before="" after=" %s"] [footer_genesis_link url="http://www.studiopress.com/" before=""] &#x000B7; [footer_wordpress_link] &#x000B7; [footer_loginout]', __( 'Copyright', 'genesis' ), __( 'on', 'genesis' ) );

	$creds_text = apply_filters( 'genesis_footer_creds_text', $creds_text );

	$output = $creds_text;

	echo apply_filters( 'genesis_footer_output', $output );

	genesis_structural_wrap( 'footer-copyright', 'close' );

	echo '</div>';
}

//* Replace Footer Widgets and move to Footer
remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );
add_action( 'genesis_footer', 'rwp_footer_widget_areas', 7 );

function rwp_footer_widget_areas() {

	$footer_widgets = get_theme_support( 'genesis-footer-widgets' );

	if ( ! $footer_widgets || ! isset( $footer_widgets[0] ) || ! is_numeric( $footer_widgets[0] ) )
		return;

	$footer_widgets = (int) $footer_widgets[0];

	//* Check to see if first widget area has widgets. If not, do nothing. No need to check all footer widget areas.
	if ( ! is_active_sidebar( 'footer-1' ) )
		return;

	$inside  = '';
	$output  = '';
 	$counter = 1;

	while ( $counter <= $footer_widgets ) {

		//* Darn you, WordPress! Gotta output buffer.
		ob_start();
		dynamic_sidebar( 'footer-' . $counter );
		$widgets = ob_get_clean();

		$inside .= sprintf( '<div class="footer-widgets-%d widget-area col l4 s12">%s</div>', $counter, $widgets );

		$counter++;

	}

	if ( $inside ) {

		$output .= genesis_markup( array(
			'html5'   => '<div %s>' . genesis_sidebar_title( 'Footer' ),
			'xhtml'   => '<div id="footer-widgets" class="footer-widgets">',
			'context' => 'footer-widgets',
			'echo'    => false,
		) );

		$output .= genesis_structural_wrap( 'footer-widgets', 'open', 0 );

		$output .= $inside;

		$output .= genesis_structural_wrap( 'footer-widgets', 'close', 0 );

		$output .= '</div>';

	}

	echo apply_filters( 'genesis_footer_widget_areas', $output, $footer_widgets );

}