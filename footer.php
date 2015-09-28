<?php
/**
 * The template for displaying the footer
 *
 * @package WordPress
 * @subpackage SKEL-ETOR
 * @since SKEL-ETOR 1.0
 */
?>


</div><!-- .container -->


<footer class="page-footer orange">
    <div class="container">
      <div class="row">
        <?php dynamic_sidebar("footer-sidebar"); ?>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      Copyright &copy; 2015
      </div>
    </div>
  </footer>


   <!--  Scripts-->
  <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/libs/jquery-2.1.1.min.js"></script>
  <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/materialize.js"></script>
  <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/init.js"></script>

<?php wp_footer(); ?>
</body>
</html>