<?php
/**
 * Search Form
 *
 * @package      Materialize Genesis
 * @since        1.0
 * @link         http://www.recommendwp.com
 * @author       RecommendWP <www.recommendwp.com>
 * @copyright    Copyright (c) 2016, RecommendWP
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

add_filter( 'genesis_search_form', 'mg_search_form', 10, 4);

function mg_search_form( $form, $search_text, $button_text, $label ) {
    $value_or_placeholder = ( get_search_query() == '' ) ? 'placeholder' : 'value';
$format = <<<EOT
<form method="get" class="search-form form-inline" action="%s" role="search">
    <div class="input-field">
        <input id="search" type="search" required name="s" %s="%s">
        <label for="search">Search</label>
        <i class="material-icons">close</i>
    </div>
</form>
EOT;

    return sprintf( $format, home_url( '/' ), esc_html( $label ), $value_or_placeholder, esc_attr( $search_text ), esc_attr( $button_text ) );
}