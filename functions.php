<?php

/**
 * Cadfiber functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Cadfiber
 */

if (! defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

function cadfiber_scripts()
{
	$timestamp = filemtime(get_stylesheet_directory() . '/style.css');
	wp_enqueue_style('cadfiber-style', get_stylesheet_uri(), array(), $timestamp);

	wp_style_add_data('cadfiber-style', 'rtl', 'replace');
}
add_action('wp_enqueue_scripts', 'cadfiber_scripts');

if (! function_exists('get_youtube_id')) :
	function get_youtube_id($url)
	{
		preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
		return isset($match[1]) ? $match[1] : '';
	}
endif;

require_once get_template_directory() . '/inc/faqCPT.php';
require_once get_template_directory() . '/inc/ferramentasCPT.php';
require_once get_template_directory() . '/inc/investimentosCPT.php';
require_once get_template_directory() . '/inc/abasCPT.php';
require_once get_template_directory() . '/inc/footerCPT.php';
require_once get_template_directory() . '/inc/youtube.php';
require_once get_template_directory() . '/inc/materiaisCPT.php';
