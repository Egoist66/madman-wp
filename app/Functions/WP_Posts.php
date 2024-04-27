<?php

namespace App\Functions;

use RuntimeException;
use WP_Query;

class WP_Posts
{


    /**
     * getByQuery
     * 
     * Helper Class for WP posts using WP_Query
     *
     * @param  mixed $args
     * @param  mixed $render
     * @return void
     */
    public static function getByQuery(array $params): WP_Query | null
    {
        try {
            $query = new WP_Query($params['args']);
            $render = $params['render'] ?? null;

            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();

                    $data = self::options();


                    if ($render) {

                        echo $render(self::options());
                    }


                    ob_start();

                    require get_template_directory() . '/' . $params['template'] . '.php';

                    echo ob_get_clean();

                    wp_reset_postdata();
                }
            } else {
                echo '<div class="no-posts">Посты не найдены.</div>';
            }

        } catch (RuntimeException $e) {
            echo $e->getMessage();

            wp_reset_postdata();
        }

       return $query;

    }


    /**
     * get
     * 
     * Get posts with a default loop
     *
     * @param  mixed $params
     * @return void
     */
    public static function get(array $params)
    {

        $render = $params['render'] ?? null;

        if (have_posts()) {
            if (is_home() || !is_front_page()) {
                echo $params['showIfIsHomeOrNotFront']();
            }

            while (have_posts()):
                the_post();

                $data = self::options();

                if ($render) {
                    echo $render($data);
                }

                ob_start();

                    require get_template_directory() . '/' . $params['template'] . '.php';

                echo ob_get_clean();


            endwhile;
            the_posts_navigation();
        }

    }






    /**
     * options
     * 
     * Get post options
     *
     * @return array
     */
    private static function options(): array
    {
        return [
            'id' => get_the_ID(),
            'title' => get_the_title(),
            'content' => get_the_content(),
            'terms' => get_the_terms(get_the_ID(), 'brand'),
            'categories' => get_the_category(),
            'tags' => get_the_tags(),
            'format' => get_post_format(),
            'excerpt' => get_the_excerpt(),
            'comments' => get_comments_number(),
            'comment_link' => get_comments_link(),
            'permalink' => get_the_permalink(),
            'author' => get_the_author_meta('display_name'),
            'date' => get_the_date(),
            'author_link' => get_the_author_posts_link(),
            'image' => get_the_post_thumbnail_url()

        ];
    }
}