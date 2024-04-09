<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package madman
 */

get_header();
?>
	

	<main id="primary" class="site-main page">
		<?php if (is_home()): ?>
				<h2>Home page</h2>
		<?php else: ?>
			<h2>Page ID: <?= get_the_ID(); ?></h2>
		<?php endif; ?>
		<?php
		while (have_posts()):
			the_post();

			the_content();
			get_template_part('parts/part', 'two');

			// If comments are open or we have at least one comment, load up the comment template.
			if (comments_open() || get_comments_number()):
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main>

<?php
//get_sidebar();
get_footer();
