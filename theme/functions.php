<?php
/**
 * Theme Functions
 *
 * @package WordPress
 * @subpackage SKEL-ETOR
 * @since SKEL-ETOR 1.0
 */

/*
TABLE OF CONTENTS

TEMPLATE FUNCTIONS
- get_slug
- the_slug
- page_id_from_slug
- category_id_from_slug
THEME FUNCTIONS
- skel_etor_excerpt
- has_post_thumbnail_caption
- the_post_thumbnail_caption
- skel_etor_format_date_time
*/

/**
 * =============== TEMPLATE FUNCTIONS ===============
 */

// Get post slug
if ( ! function_exists('get_slug') ) {
	function get_slug() {
		$post_data = get_post($post->ID, ARRAY_A);
		$slug = $post_data['post_name'];
		return $slug;
	}
}

// Echo post slug
if ( ! function_exists('the_slug') ) {
	function the_slug() {
		$post_data = get_post($post->ID, ARRAY_A);
		$slug = $post_data['post_name'];
		return _e($slug);
	}
}

// Get page_id from page_slug
if ( ! function_exists('page_id_from_slug') ) {
	function page_id_from_slug($slug) {
		$page = get_page_by_path($slug);
		if ($page) {
			return $page->ID;
		}
		return null;
	}
}

// Get category id from slug
if ( ! function_exists('category_id_from_slug') ) {
	function category_id_from_slug($slug) {
		$category = get_category_by_slug($slug);
		if ($category) {
			return $category->term_id;
		} else {
			return null;
		}
	}
}

// Test for subpage
if ( ! function_exists('is_subpage') ) {
	function is_subpage() {
		global $post;

		if ( is_page() && $post->post_parent ) {
			return $post->post_parent;
		} else {
			return false;
		}
	}
}

/**
 * =============== THEME FUNCTIONS ===============
 */

// Custom excerpts
if ( ! function_exists('skel_etor_excerpt') ) {
	function long_excerpt($length) {
		return 55;
	}
	function short_excerpt($length) {
		return 20;
	}
	function more_excerpt($more) {
		return '...';
	}
	function more_permalink() {
		return '<p class="more"><a href="'.get_permalink($post->ID).'">Read more</a></p>';
	}
	function more_inline_permalink() {
		return '<a href="'.get_permalink($post->ID).'" class="more-link">Read more</a>';
	}

	// Applying the excerpts
	function skel_etor_excerpt($length_callback='', $more_callback='') {
		global $post;
		if(function_exists($length_callback)){
			add_filter('excerpt_length', $length_callback);
		}
		if(function_exists($more_callback)){
			add_filter('excerpt_more', $more_callback);
		}
		$output = get_the_excerpt();
		$output = apply_filters('wptexturize', $output);
		$output = apply_filters('convert_chars', $output);
		$output = '<p>'.$output.'</p>';
		echo $output;
	}
}

/**
 * Check if thumbnail has a caption attached
 *
 * Must be used in the loop
 *
 * @return (bool) True/False
 */

if ( ! function_exists('has_post_thumbnail_caption')) {
	function has_post_thumbnail_caption() {
		global $post;

		$thumbnail_id = get_post_thumbnail_id($post->ID);
		$thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

		if ($thumbnail_image AND isset($thumbnail_image[0]))
			return ( ! empty($thumbnail_image[0]->post_excerpt) ) ? true : false;
	}
}

/**
 * Adds the attached caption from a feature image
 *
 * Must be used in the loop
 *
 * @param $with_markup - output caption HTML wrapper. True|False. Default: False
 * @return (string) Caption HTML + Caption text
 */

if ( ! function_exists('the_post_thumbnail_caption')) {
	function the_post_thumbnail_caption($with_markup = false) {
		global $post;

		$thumbnail_id = get_post_thumbnail_id($post->ID);
		$thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

		if ($thumbnail_image AND isset($thumbnail_image[0])) {
			if ( $with_markup == true )
				echo '<span class="caption">'.$thumbnail_image[0]->post_excerpt.'</span>';
			else
				echo $thumbnail_image[0]->post_excerpt;
		}

	}
}

/**
 * Date Formatter
 *
 * Feed the function a date format and it will outout a nicely formatted date string
 * @uses ACF fields for 'start_date' and 'end_date'
 *
 * @param (string) $format - The desired format the be displayed. Options: 'd M Y' | 'g:i'.
 * @param (int) $post_id - Defaults to current post id, can be force fed
 *
 * @return (string) formatted date string
 */

function skel_etor_format_date_time( $format = 'd M Y',  $post_id = '' ) {
	global $post;

	if ( ! $post_id )
		$post_id = $post->ID;
	else
		$post_id = $post_id;

	$start_date = get_field('start_date', $post_id);
	$end_date =  get_field('end_date', $post_id);

	$s_date = new Datetime( $start_date );
	$e_date = new Datetime( $end_date );

	// Date Format
	if ( $format == 'd M Y' ) {
		if ( $s_date->format('d M Y') == $e_date->format('d M Y') ) {    // Same day
			$str = $s_date->format('d M Y');
		} elseif ( $s_date->format('Y') == $e_date->format('Y') ) {    // Same Year
			if ( $s_date->format('M') == $e_date->format('M') ) {    // Same Month
				$str = $s_date->format('d') . ' &mdash; ' . $e_date->format('d M Y');
			} else {    // Same Month + Year
				$str = $s_date->format('d M') . ' &mdash; ' . $e_date->format('d M Y');
			}
		} else {    // Different Year
			$str = $s_date->format('d M Y') . ' &mdash; ' . $e_date->format('d M Y');
		}
	// Time Format
	} elseif ( $format == 'g:i' ) {
		$str = $s_date->format('g:ia');
	}

	echo $str;
}


add_action('admin_menu', 'my_admin_add_page');
function my_admin_add_page() {
    $my_admin_page = add_options_page(__('My Admin Page', 'map'), __('My Admin Page', 'map'), 'manage_options', 'map', 'my_admin_page');

    // Adds my_help_tab when my_admin_page loads
    add_action('load-'.$my_admin_page, 'my_admin_add_help_tab');
}

function my_admin_add_help_tab () {
    $screen = get_current_screen();

    // Add my_help_tab if current screen is My Admin Page
    $screen->add_help_tab( array(
        'id'	=> 'my_help_tab',
        'title'	=> __('My Help Tab'),
        'content'	=> '<p>' . __( 'Descriptive content that will show in My Help Tab-body goes here.' ) . '</p>',
    ) );
}
