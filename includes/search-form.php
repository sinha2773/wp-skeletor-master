<?php
/**
 * The template for displaying search forms
 *
 * @package WordPress
 * @subpackage SKEL-ETOR
 * @since SKEL-ETOR 1.0
 */
?>

<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="s" class="vh"><?php _e( 'Search', 'skel_etor' ); ?></label>
	<input type="text" class="field" name="s" id="s" title="Search" placeholder="Search"/>
	
  <button class="btn waves-effect waves-light" type="submit" name="action"><?php esc_attr_e( 'Search', 'skel_etor' ); ?></button>
        
</form>
