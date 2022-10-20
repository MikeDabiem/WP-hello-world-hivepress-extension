<?php
/**
 * Plugin Name: Hello World for HivePress
 * Version: 1.0.0
 * Author: Viktor Hvozdakov
 * Author URI: https://github.com/MikeDabiem
 */

defined( 'ABSPATH' ) || exit;

add_filter(
	'hivepress/v1/extensions',
	function( $extensions ) {
		$extensions[] = __DIR__;

		return $extensions;
	}
);