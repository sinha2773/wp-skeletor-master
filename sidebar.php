<?php
/**
 * The Sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage SKEL-ETOR
 * @since SKEL-ETOR 1.0
 */
?>

<div id="sidebar" class="col s12 m5 l4">
	<?php if ( is_home() OR is_front_page() ) : ?>
		<?php dynamic_sidebar('home-sidebar'); ?>
	<?php else : ?>
		<?php dynamic_sidebar('main-sidebar'); ?>
	<?php endif; ?>
</div>