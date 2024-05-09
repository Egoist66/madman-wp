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

global $madman_options;



if(is_tax()){

	echo "You are on taxonomy page";
}

?>

<h3>Phone number: <?= $madman_options['phone_number'] ?></h3>