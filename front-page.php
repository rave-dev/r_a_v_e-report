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

		<div id="primary" class="content-area col-md-6">
			<main id="main" class="site-main" role="main">

			<?php
			// Display blog header image on homepage
			$image_id = get_custom_header()->attachment_id;
			?>
			<div class="home-image">
				<img src="<?php header_image(); ?>" alt="<?php echo get_post_meta( $image_id, '_wp_attachment_image_alt', true ); ?>" />
				<p><?php echo get_post( $image_id )->post_excerpt; ?></p>
			</div>

			<?php
			// Pull most recent blog post to display
			$args = array(
				'post_type'				=> 'post',
				'post_status'			=> 'publish',
				'posts_per_page'			=> 1,
				'order'					=> 'DESC',
				'orderby'				=> 'date',
				'post__not_in'			=> get_option( 'sticky_posts' )
			);
			$the_query = new WP_Query( $args );
			if ( $the_query->have_posts() ) :
				while ( $the_query->have_posts() ) : $the_query->the_post();
					
					get_template_part( 'template-parts/content', get_post_format() );

				endwhile;

				wp_reset_postdata();
			else :
				get_template_part( 'template-parts/content', 'none' );
			endif;
			?>

			<?php
			// if ( have_posts() ) : ?>

			 	<?php
				/* Start the Loop */
				// while ( have_posts() ) : the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					 
					// get_template_part( 'template-parts/content', get_post_format() );

				// endwhile;

				//the_posts_navigation();

			// else :

			// 	get_template_part( 'template-parts/content', 'none' );

			// endif; ?>

			</main><!-- #main -->
		</div><!-- #primary -->

		<aside id="tertiary" class="widget-area col-sm-6 col-md-3" role="complementary">
			<?php echo do_shortcode( '[rave_featured]' ); ?>
			<?php dynamic_sidebar( 'sidebar-index' ); ?>
		</aside><!-- #secondary -->

		<?php get_sidebar( 'sidebar' ); ?>

	</div><!-- .sidebar-wrap -->

</div><!-- .content -->

<?php
get_footer();
