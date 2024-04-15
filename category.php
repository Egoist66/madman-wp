
<?php get_header() ?>
	<main class="category-page">
		<section class="category-section">
			<h1><?php single_cat_title(); ?></h1>
			<div class="category-articles">
				<?php
					$cat = get_queried_object();
					$args = array(
						'category__in' => $cat->term_id,
						'post_type' => ['car'],
						'post_status' => 'publish',
						'posts_per_page' => 10
					);
					$query = new WP_Query($args);
					if($query->have_posts()) {
						while($query->have_posts()) {
							$query->the_post();
							get_template_part('templates/template-archive');
						}
						wp_reset_postdata();
					} else {
						echo '<p>No posts found</p>';
					}
				?>
			</div>
		</section>
	</main>
	
<?php get_footer()?>       

