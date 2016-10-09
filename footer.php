<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package RAVE
 */

?>

	</div><!-- #content -->

	<div id="page-footer"></div>

</div><!-- #page -->

<footer id="footer" class="site-footer container" role="contentinfo">
	<div class="footer-wrap">
		<div class="site-info">
			<p>
				© <?php echo date( 'Y' ); ?>
				<span class="copyright"><?php echo get_theme_mod( 'rave_footer_text' ) !== false ? get_theme_mod( 'rave_footer_text' ) : get_bloginfo( 'name' ); ?></span>
			</p>
		</div><!-- .site-info -->
	</div><!-- .footer-wrap -->
</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>
