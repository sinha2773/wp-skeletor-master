<?php
/**
 * Front page template
 *
 * @package WordPress
 * @subpackage SKEL-ETOR
 * @since SKEL-ETOR 1.0
 */
?>



<article id="post-<?php echo get_the_ID(); ?>" <?php post_class() ?>>
	<header>
		<h1><?php the_title(); ?></h1>
	</header>
	
	<?php 
	$address = get_field( "address" );
	$image = get_field( "image" );
	$url_lists = get_field( "url_lists" );
	?>
	
	<div class="row">
		<div class="entry-part col s12 m6 l6">
			<h5>Address:</h5>
			<?php if($address){echo $address;} else{ echo "Not yet";} ?>
		</div>
		<div class="entry-part col s12 m6 l6">
			<h5>Url Lists:</h5>
			<?php if($url_lists) {echo $url_lists;} else { echo "There are no any links";} ?>
		</div>
	</div>
	<div class="row">
		<div class="entry col s12 l12">
			<img class="responsive-img" src="<?php echo $image;?>" style="max-width:50%; float:left; margin-right:10px;" />
			<?php the_content(); ?>
		</div>
	</div>
</article>