<?php
/**
 * The header for our theme
 *
 * @package WordPress
 * @subpackage SKEL-ETOR
 * @since SKEL-ETOR 1.0
 */

?><!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js lt-ie10 lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>    <html class="no-js lt-ie10" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="utf-8">

<title><?php wp_title( '-', true, 'right' ); ?></title>

<meta name="description" content="<?php bloginfo('description'); ?>">
<meta name="viewport" content="width=device-width">


<link rel="shortcut icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.png" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<!--materializecss-->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="<?php echo get_stylesheet_directory_uri(); ?>/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
<link href="<?php echo get_stylesheet_directory_uri(); ?>/css/layout.css" type="text/css" rel="stylesheet" media="screen,projection"/>
<link href="<?php echo get_stylesheet_directory_uri(); ?>/css/responsive.css" type="text/css" rel="stylesheet" media="screen,projection"/>

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<nav class="light-blue lighten-1" role="navigation">
	<div class="nav-wrapper container"><a id="logo-container" href="<?php echo site_url('/'); ?>" class="brand-logo"><?php bloginfo('name'); ?></a>
	  <ul class="right hide-on-med-and-down">
		<?php if (has_nav_menu('primary')) : ?>
				<?php wp_nav_menu(array('theme_location' => 'primary')); ?>
		<?php endif; ?>
	  </ul>

	  <ul id="nav-mobile" class="side-nav">
		<?php if (has_nav_menu('primary')) : ?>
				<?php wp_nav_menu(array('theme_location' => 'primary')); ?>
		<?php endif; ?>
	  </ul>
	  <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
	</div>
</nav>

<div class="container">

