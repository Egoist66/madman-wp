<?php
use App\Functions\WP_Posts;
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package madman
 */

 
get_header();
?>

	<main id="primary" class="site-main index">


		<?php 

			WP_Posts::get([
				'template' => 'templates/template-post',
				'showIfIsHomeOrNotFront' => static fn() => (
					"
						<header>
							<h1 class='page-title screen-reader-text'>" . get_the_title() . "</h1>
						</header>
					"
				)
			]);

		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
