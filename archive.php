<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package madman
 */

 use App\Classes\WP_Posts;

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
			$paged = get_query_var('paged') ? : get_query_var('paged') ? : 1;
			$query = WP_Posts::getByQuery([
				'args' => [
					'posts_per_page' => 2,
					'post_type' => 'car',
					'paged' => $paged

				],
				'template' => 'templates/template-post',

			]);

			the_posts_pagination([
				'prev_text' => 'Previous Page',
				'next_text' => 'Next Page',
				'mid_size'  => 2,
			])
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
