<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package RAVE
 */

if ( ! is_active_sidebar( 'sidebar-posts' ) ) {
	return;
}
$size = 12;
if ( is_front_page() ) {
	$size = 6;
}
?>

<aside id="secondary" class="widget-area col-sm-<?php echo $size; ?> col-md-3" role="complementary">
	<?php dynamic_sidebar( 'sidebar-posts' ); ?>
</aside><!-- #secondary -->
