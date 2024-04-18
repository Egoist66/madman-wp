<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package madman
 */

if ( ! is_active_sidebar( 'cars-sidebar' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
    Sidebar
	<?php dynamic_sidebar( 'cars-sidebar' ); ?>
</aside><!-- #secondary -->
