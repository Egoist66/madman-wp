<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package madman
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if (have_posts()): ?>

						<header class="page-header">
							<h1 class="page-title">
								<?php
								/* translators: %s: search query. */
								printf(esc_html__('Search Results for: %s', 'madman'), '<span>' . get_search_query() . '</span>');
								?>
							</h1>
						</header><!-- .page-header -->

						<?php
						/* Start the Loop */
						echo '<div style="text-align:center" class="search-results">';
						while (have_posts()):
							the_post();

							$link = get_the_permalink();
							$name = get_the_title();


							the_content();
							echo "<a target='_blank' href='$link'> . {$name} . </a>";

						endwhile;

						the_posts_navigation();
						echo '</div>';

		else:

			"No results found";

		endif;
		?>

	</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
