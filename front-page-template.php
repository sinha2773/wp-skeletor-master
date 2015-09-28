<?php
/**
 * Template Name: Front Page
 *
 * @package WordPress
 * @subpackage SKEL-ETOR
 * @since SKEL-ETOR 1.0
 */

get_header(); ?>

<div id="main" class="row">
	<div id="content" class="col s12 m7 l8">

		<?php $q = new WP_Query(array("post_type"=>"post","posts_per_page"=>1));
		if($q->have_posts()) : while( $q->have_posts() ) : $q->the_post(); ?>

			<?php get_template_part('content/home-page'); ?>

		<?php endwhile; endif; wp_reset_query(); ?>

	</div>
	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>