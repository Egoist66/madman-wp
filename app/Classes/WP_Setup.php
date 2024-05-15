<?php

namespace App\Classes;

use App\Config\WP_Theme_Config;
use App\Classes\WP_ShortCodes;



/**
 * WP_Setup
 * Setups theme config and addons
 */
class WP_Setup
{
	/**
	 * Customizer additions.
	*/

	const ADDONS = [
		'/inc/class-tgm-plugin-activation',
		'/inc/madman_comment',
		'/inc/hooks/hooks',
		'/inc/hooks/filters/filters',
		'/inc/hooks/actions/actions',
		'/utils/view',
		'/utils/dump',
		'/inc/ajax-handle',
		'/inc/redux-options',
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
			require get_template_directory() . $addon . '.php';
		}
	}
}




