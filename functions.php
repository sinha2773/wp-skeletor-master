<?php
/**
 * SKEL-ETOR functions and definitions
 *
 * @package WordPress
 * @subpackage SKEL-ETOR
 * @since SKEL-ETOR 1.0
 *
 * match case - find -> replace: 'SKEL-ETOR' -> Template Names ("SKEL-ETOR 2012") E.g. The Nest
 * match case - find -> replace: 'SKEL_ETOR' -> Theme/Front-End names ("SKEL_ETOR_URL") E.g. THE_NEST_CONSTANT
 * match case - find -> replace: 'skel_etor' -> Function/Variable names ("skel_etor"_excerpt();) E.g. the_nest
 * match case - find -> replace: 'skel-etor' -> Option Names (some_function("skel-etor"-option)); E.g. the-nest
 *
 */

require( get_template_directory() . '/theme/constants.php');
require( get_template_directory() . '/theme/debug.php');
require( get_template_directory() . '/theme/classes.php');
require( get_template_directory() . '/theme/functions.php');
require( get_template_directory() . '/theme/enqueue.php');
require( get_template_directory() . '/theme/shortcodes.php');
require( get_template_directory() . '/theme/setup.php');
require( get_template_directory() . '/theme/actions.php');
require( get_template_directory() . '/theme/filters.php');
require( get_template_directory() . '/theme/theme-actions.php');
require( get_template_directory() . '/theme/theme-hooks.php');
require( get_template_directory() . '/theme/theme-validation.php');



add_filter( 'gform_submit_button', 'form_submit_button', 10, 2 );
function form_submit_button( $button, $form ) {
    return "<button class='btn waves-effect waves-light' id='gform_submit_button_{$form['id']}'><span>Submit</span></button>";
}

function wp_custom_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'skel_etor' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'wp_custom_title', 10, 2 );