<?php

get_header();
$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
$args = array(
    'post_type' => 'car',
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'brand',
            'fieldname' => 'term_id',
            'terms' => $term->term_id,
        ),
    ),
);

use App\Functions\WP_Posts;






?>

<main class="taxonomy-page">
 
    <?php 
    
    
        WP_Posts::getByQuery([
            'args' => $args,
            'template' => 'templates/template-taxonomy',

        ])
    
        
    
    ?>

<?php get_footer(); ?>

