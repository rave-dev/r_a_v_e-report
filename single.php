<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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

				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', get_post_format() );

					//the_post_navigation( $args );

					rave_post_navigation();

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>

			</main><!-- #main -->
		</div><!-- #primary -->

		<?php get_sidebar( 'sidebar' ); ?>

	</div><!-- .sidebar-wrap -->

</div><!-- .content -->

<?php
get_footer();
