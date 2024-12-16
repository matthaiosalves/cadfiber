<?php
function registrar_custom_post_type_faq()
{

  $labels = array(
    'name'                  => _x('FAQs', 'Post type general name', 'textdomain'),
    'singular_name'         => _x('FAQ', 'Post type singular name', 'textdomain'),
    'menu_name'             => _x('FAQs', 'Admin Menu text', 'textdomain'),
    'name_admin_bar'        => _x('FAQ', 'Add New on Toolbar', 'textdomain'),
    'add_new'               => __('Adicionar Novo', 'textdomain'),
    'add_new_item'          => __('Adicionar Novo FAQ', 'textdomain'),
    'new_item'              => __('Novo FAQ', 'textdomain'),
    'edit_item'             => __('Editar FAQ', 'textdomain'),
    'view_item'             => __('Ver FAQ', 'textdomain'),
    'all_items'             => __('Todos os FAQs', 'textdomain'),
    'search_items'          => __('Procurar FAQs', 'textdomain'),
    'parent_item_colon'     => __('FAQ Pai:', 'textdomain'),
    'not_found'             => __('Nenhum FAQ encontrado.', 'textdomain'),
    'not_found_in_trash'    => __('Nenhum FAQ encontrado na lixeira.', 'textdomain'),
    'featured_image'        => _x('Imagem em Destaque', 'Overrides the “Featured Image” phrase for this post type', 'textdomain'),
    'set_featured_image'    => _x('Definir imagem em destaque', 'Overrides the “Set featured image” phrase for this post type', 'textdomain'),
    'remove_featured_image' => _x('Remover imagem em destaque', 'Overrides the “Remove featured image” phrase for this post type', 'textdomain'),
    'use_featured_image'    => _x('Usar como imagem em destaque', 'Overrides the “Use as featured image” phrase for this post type', 'textdomain'),
    'archives'              => _x('Arquivos de FAQs', 'The post type archive label', 'textdomain'),
    'insert_into_item'      => _x('Inserir no FAQ', 'Overrides the “Insert into post” phrase for this post type', 'textdomain'),
    'uploaded_to_this_item' => _x('Enviado para este FAQ', 'Overrides the “Uploaded to this post” phrase for this post type', 'textdomain'),
    'filter_items_list'     => _x('Filtrar lista de FAQs', 'Screen reader text for the filter links heading', 'textdomain'),
    'items_list_navigation' => _x('Navegação da lista de FAQs', 'Screen reader text for the pagination heading', 'textdomain'),
    'items_list'            => _x('Lista de FAQs', 'Screen reader text for the items list heading', 'textdomain'),
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array('slug' => 'faq'),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => 20,
    'menu_icon'          => 'dashicons-editor-help',
    'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
    'show_in_rest'       => true, // Habilita o editor Gutenberg
  );

  register_post_type('faq', $args);
}
add_action('init', 'registrar_custom_post_type_faq');
