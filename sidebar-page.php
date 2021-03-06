<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package RAVE
 */

if ( ! is_active_sidebar( 'sidebar-page' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area col-md-3" role="complementary">
	<?php dynamic_sidebar( 'sidebar-page' ); ?>
</aside><!-- #secondary -->
