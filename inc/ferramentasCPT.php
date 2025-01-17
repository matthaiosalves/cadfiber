<?php
function criar_post_type_ferramentas()
{
  register_post_type('ferramentas', array(
    'labels' => array(
      'name' => __('Ferramentas'),
      'singular_name' => __('Ferramenta'),
      'menu_name' => __('Ferramentas'),
      'add_new' => __('Adicionar Nova'),
      'add_new_item' => __('Adicionar Nova Ferramenta'),
      'edit_item' => __('Editar Ferramenta'),
      'new_item' => __('Nova Ferramenta'),
      'view_item' => __('Ver Ferramenta'),
      'all_items' => __('Todas as Ferramentas'),
      'search_items' => __('Buscar Ferramentas'),
      'not_found' => __('Nenhuma Ferramenta Encontrada'),
    ),
    'public' => true,
    'has_archive' => true,
    'menu_icon' => 'dashicons-hammer',
    'rewrite' => array('slug' => 'ferramenta'),
    'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
  ));
}
add_action('init', 'criar_post_type_ferramentas');

function criar_taxonomia_especifica_ferramentas()
{
  register_taxonomy('categorias_ferramentas', 'ferramentas', array(
    'labels' => array(
      'name' => __('Categorias de Ferramentas'),
      'singular_name' => __('Categoria de Ferramenta'),
      'search_items' => __('Buscar Categorias'),
      'all_items' => __('Todas as Categorias'),
      'edit_item' => __('Editar Categoria'),
      'update_item' => __('Atualizar Categoria'),
      'add_new_item' => __('Adicionar Nova Categoria'),
      'new_item_name' => __('Nome da Nova Categoria'),
      'menu_name' => __('Categorias de Ferramentas'),
    ),
    'hierarchical' => true,
    'show_ui' => true,
    'show_admin_column' => true,
    'rewrite' => array('slug' => 'categorias-ferramentas'),
  ));
}
add_action('init', 'criar_taxonomia_especifica_ferramentas');
