<?php
/**
 * Comments
 *
 * @package      Bootstrap for Genesis
 * @since        1.0
 * @link         http://www.recommendwp.com
 * @author       RecommendWP <www.recommendwp.com>
 * @copyright    Copyright (c) 2015, RecommendWP
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

// Integrate Bootstrap Media List on comment lists
add_filter( 'genesis_comment_list_args', 'bfg_comment_list_args', 10, 2 );
function bfg_comment_list_args( $args ) {
	require_once( RWP_MODULES . 'class-wp-bootstrap-comment-walker.php' );

	$args['avatar_size'] = 64;
	$args['walker'] = new Bootstrap_Comment_Walker();
	$args['callback'] = '';
    // $args['style'] = 'div';
	return $args;
}

// Comment Form
// @link http://www.codecheese.com/2013/11/wordpress-comment-form-with-twitter-bootstrap-3-supports/
add_filter( 'comment_form_defaults', 'bfg_comment_form_args' );
function bfg_comment_form_args( $args ) {
	$args['comment_field'] = '<div class="input-field comment-form-comment"> 
	        <textarea class="materialize-textarea" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
            <label for="comment">' . _x( 'Comment', 'noun' ) . '</label>
	    </div>';
	$args['class_submit'] = 'btn btn-default'; // since WP 4.1
	
	return $args;
}

// @link http://www.codecheese.com/2013/11/wordpress-comment-form-with-twitter-bootstrap-3-supports/
add_filter( 'comment_form_default_fields', 'bootstrap3_comment_form_fields' );
function bootstrap3_comment_form_fields( $fields ) {
    $commenter = wp_get_current_commenter();
    
    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $html5    = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;
    
    $fields   =  array(
        'author' => '<div class="input-field comment-form-author">' .
                    '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /><label for="author">' . __( 'Name' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label></div>',
        'email'  => '<div class="input-field comment-form-email"><input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /><label for="email">' . __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label></div>',
        'url'    => '<div class="input-field comment-form-url"><input class="form-control" id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /><label for="url">' . __( 'Website' ) . '</label></div>'        
    );
    
    return $fields;
}

add_filter( 'genesis_ping_list_args', 'rwp_ping_list_args' );
function rwp_ping_list_args( $args ) {
    require_once( RWP_MODULES . 'class-wp-bootstrap-comment-walker.php' );
    
    $args['walker'] = new Bootstrap_Comment_Walker();
    $args['avatar_size'] = 0;
    return $args;
}