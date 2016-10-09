<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package RAVE
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site container">
	<a class="skip-link screen-reader-text sr-only sr-only-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'r_a_v_e' ); ?></a>


	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<?php
			$title = get_bloginfo( 'name', 'display' );
			$title = '<span>' . substr( $title, 0, 1 ) . '</span>' . substr( $title, 1 );
			?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo $title; ?></a></h1>

			<?php
			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
		</div><!-- .site-branding -->

		<div class="toggle-wrap text-center">
			<button class="navbar-toggle collapsed" data-toggle="collapse" aria-controls="navbar" aria-expanded="false" data-target="#navbar" type="button">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
			</button>
		</div>

		<nav id="navbar" class="collapse navbar-collapse <?php echo get_theme_mod( 'rave_menu_position' ) == 'fixed' ? 'navbar-fixed-top' : ''; ?>" role="navigation">
			<?php
			wp_nav_menu( array( 
				'theme_location' => 'primary',
				'menu_id' => 'primary-menu',
				'menu_class' => 'nav navbar-nav',
				//'container_class' => 'navbar-right',
				'walker' => new Rave_Walker_Nav_Menu()
			) );
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<?php if ( is_front_page() ) { ?>
	<h2 class="subtitle">News and Commentary on the Issues of Our Time</h2>
	<?php } ?>

	<div id="content" class="site-content">
