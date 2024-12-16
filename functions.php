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

function custom_rest_endpoint_listar_abas()
{
	register_rest_route('custom/v1', '/abas', array(
		'methods'  => 'GET',
		'callback' => 'listar_todos_abas',
	));
}

function listar_todos_abas($request)
{
	// Busca todos os registros do post type "abas"
	$args = array(
		'post_type'      => 'abas',
		'posts_per_page' => -1, // Retorna todos os posts
		'post_status'    => 'publish',
	);

	$query = new WP_Query($args);
	$posts = array();

	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();

			// Busca o valor do campo personalizado "Label Lateral"
			$label_lateral = get_post_meta(get_the_ID(), 'label_lateral', true);

			$posts[] = array(
				'id'            => get_the_ID(),
				'title'         => get_the_title(),
				'content'       => get_the_content(),
				'label_lateral' => $label_lateral, // Adiciona o Label Lateral
				'link'          => get_permalink(),
			);
		}
	}

	wp_reset_postdata();

	return new WP_REST_Response($posts, 200);
}

// Adiciona o endpoint à REST API
add_action('rest_api_init', 'custom_rest_endpoint_listar_abas');




require_once get_template_directory() . '/inc/faqCPT.php';
require_once get_template_directory() . '/inc/ferramentasCPT.php';
require_once get_template_directory() . '/inc/investimentosCPT.php';
require_once get_template_directory() . '/inc/abasCPT.php';
require_once get_template_directory() . '/inc/footerCPT.php';
require_once get_template_directory() . '/inc/youtube.php';
require_once get_template_directory() . '/inc/materiaisCPT.php';
