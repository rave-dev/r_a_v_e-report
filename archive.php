<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package RAVE
 */

get_header(); ?>

<?php
// Get post banner, header html
list( $header_html, $banner_html ) = rave_display_thumbnail();
echo $banner_html;
?>

<div class="content">

	<div class="sidebar-wrap row">

		<div id="primary" class="content-area col-md-9">
			<main id="main" class="site-main" role="main">

				<?php echo $header_html; ?>

				<div class="articles">

					<?php
					if ( have_posts() ) : ?>

						<?php
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content', get_post_format() );

						endwhile;

						echo '</div>';

						rave_posts_navigation();

					else :

						get_template_part( 'template-parts/content', 'none' );

						echo '</div>';

					endif; ?>

			</main><!-- #main -->
		</div><!-- #primary -->

		<?php get_sidebar( 'sidebar' ); ?>

	</div><!-- .sidebar-wrap -->

</div><!-- .content -->

<?php
get_footer();
