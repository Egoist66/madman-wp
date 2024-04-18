<?php

namespace App\Functions;

use App\Config\WP_Theme_Config;
use App\Functions\WP_ShortCodes;



/**
 * WP_Setup
 * Setups theme config and addons
 */
class WP_Setup
{

	/**
	 * @addons ->
	 * 
	 * Implement the Custom Header feature.
	 */

	/**
	 * Custom template tags for this theme.
	 */

	/**
	 * Functions which enhance the theme by hooking into WordPress.
	 */

	/**
	 * Customizer additions.
	 */

	const ADDONS = [
		'/inc/custom-header.php',
		'/inc/template-tags.php',
		'/inc/template-functions.php',
		'/inc/customizer.php',
	];
	
	/**
	 * init
	 *
	 * Set up theme defaults and registers support for various WordPress features.
	 * @return void
	 */
	final public static function init(bool $isDev = false)
	{
		WP_Theme_Config::wp_setup_init([
			'maintenance_mode' => $isDev
		]);


		self::addons();
		WP_ShortCodes::init();

	}
	
	/**
	 * addons
	 *
	 * Load addons
	 * @return void
	 */
	 private static function addons()
	{

		foreach (self::ADDONS as $addon) {
			require get_template_directory() . $addon;
		}
	}
}




