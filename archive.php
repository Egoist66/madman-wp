<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package madman
 */

 use App\Functions\WP_Posts;

get_header();
?>

	<main id="primary" class="site-main archive">

		<div>
			<?php
			the_archive_title('<h1 class="page-title">', '</h1>');
			the_archive_description('<div class="archive-description">', '</div>');
			?>
		</div><!-- .page-header -->

		<?php

			WP_Posts::get([
				'showIfIsHomeOrNotFront' => static fn() => (
					""
				),	
				'template' => 'templates/template-post',

			])
		?>

	</main><!-- #main -->

<?php
get_sidebar('cars');
get_footer();
