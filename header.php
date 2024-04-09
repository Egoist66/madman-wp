<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package madman
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<header>
	<?php wp_nav_menu(
		array(
			'theme_location' => 'header_nav',
			'container' => 'nav',
			'container_class' => 'header-nav',
			'menu_id' => 'header_nav'
		)
	); ?>

	<div class="search-wrapper">
		<?= get_search_form(); ?>
	</div>
</header>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>


<?php

// $name = 'Farid aka<br> "Developer"';

// echo "<br>";

// echo esc_attr($name);
// echo "<br>";

// echo esc_html("<script>alert(1)</script>");

// echo "<br>";

// wp_kses(
// 	"<script>alert(1)</script><b>hello<b>", 
// 	[

// 	 'b' => []

// 	]
// );

//echo wp_kses_post("<script>alert(2)</script><b>hello<b>");

?>
<br>
<br>
<a href="<?= esc_url("https://google.com") ?>">Google</a>
<input type="text" name="author" value="<?= esc_attr($name); ?>">
