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
	$timestamp = filemtime(get_stylesheet_directory() . '/style.min.css');
	wp_enqueue_style('cadfiber-style', get_stylesheet_directory_uri() . '/style.min.css', array(), $timestamp);

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
	$subitens_map = []; // Mapeia IDs dos itens pais para seus subitens

	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();

			// Busca os campos personalizados
			$label_lateral = get_post_meta(get_the_ID(), 'label_lateral', true);
			$parent_item = get_post_meta(get_the_ID(), 'parent_item', true);

			// Adiciona o post à lista geral
			$posts[] = array(
				'id'            => get_the_ID(),
				'title'         => get_the_title(),
				'content'       => apply_filters('the_content', get_the_content()),
				'label_lateral' => $label_lateral,
				'parent_item'   => $parent_item, // ID do item pai, se existir
				'link'          => get_permalink(),
			);

			// Mapeia o subitem ao item pai
			if (!empty($parent_item)) {
				if (!isset($subitens_map[$parent_item])) {
					$subitens_map[$parent_item] = [];
				}
				$subitens_map[$parent_item][] = get_the_ID();
			}
		}
	}

	wp_reset_postdata();

	// Adiciona os subitens ao objeto correspondente
	foreach ($posts as &$post) {
		$post['subitens'] = isset($subitens_map[$post['id']]) ? $subitens_map[$post['id']] : [];
	}

	return new WP_REST_Response($posts, 200);
}

// Adiciona o endpoint à REST API
add_action('rest_api_init', 'custom_rest_endpoint_listar_abas');








function add_parent_item_metabox()
{
	add_meta_box(
		'parent_item_meta',
		'Subitem de', // Título da metabox
		'render_parent_item_metabox',
		'abas', // Tipo de post personalizado
		'side', // Localização da metabox
		'default' // Prioridade da metabox
	);
}
add_action('add_meta_boxes', 'add_parent_item_metabox');

function render_parent_item_metabox($post)
{
	// Obtém todos os posts do tipo 'abas' para popular o dropdown
	$abas = get_posts([
		'post_type' => 'abas',
		'posts_per_page' => -1,
		'post_status' => 'publish',
		'exclude' => [$post->ID], // Exclui o próprio post
	]);

	// Obtém o valor atual do meta field
	$current_parent = get_post_meta($post->ID, 'parent_item', true);

	echo '<label for="parent_item_field">Selecione o item pai:</label>';
	echo '<select id="parent_item_field" name="parent_item">';
	echo '<option value="">Nenhum (item principal)</option>';

	foreach ($abas as $aba) {
		$selected = $current_parent == $aba->ID ? 'selected' : '';
		echo "<option value='{$aba->ID}' {$selected}>{$aba->post_title}</option>";
	}

	echo '</select>';
}


function save_parent_item_meta($post_id)
{
	// Verifica se o campo foi enviado
	if (isset($_POST['parent_item'])) {
		$parent_item = sanitize_text_field($_POST['parent_item']);
		update_post_meta($post_id, 'parent_item', $parent_item);
	}
}
add_action('save_post', 'save_parent_item_meta');

add_filter('show_admin_bar', '__return_false');

add_theme_support('post-thumbnails', ['post', 'page']);

function load_nprogress()
{
	// CSS do NProgress
	wp_enqueue_style('nprogress-css', get_template_directory_uri() . '/css/nprogress.min.css');

	// JS do NProgress
	wp_enqueue_script('nprogress-js', get_template_directory_uri() . '/js/nprogress.min.js', [], false, true);

	// Script para iniciar NProgress
	wp_add_inline_script('nprogress-js', "
      document.addEventListener('DOMContentLoaded', function() {
        NProgress.start();
      });
      window.addEventListener('load', function() {
        NProgress.done();
      });
    ");
}
add_action('wp_enqueue_scripts', 'load_nprogress');



require_once get_template_directory() . '/inc/faqCPT.php';
require_once get_template_directory() . '/inc/ferramentasCPT.php';
require_once get_template_directory() . '/inc/investimentosCPT.php';
require_once get_template_directory() . '/inc/abasCPT.php';
require_once get_template_directory() . '/inc/footerCPT.php';
require_once get_template_directory() . '/inc/youtube.php';
require_once get_template_directory() . '/inc/materiaisCPT.php';
require_once get_template_directory() . '/inc/fnBanner.php';
require_once get_template_directory() . '/inc/fnCampoDescricao.php';
require_once get_template_directory() . '/inc/fnSociais.php';
