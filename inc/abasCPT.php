<?php
// Registrar o Custom Post Type (CPT) "Abas"
function register_abas_cpt()
{
  $labels = array(
    'name'               => 'Abas',
    'singular_name'      => 'Aba',
    'menu_name'          => 'Abas',
    'name_admin_bar'     => 'Aba',
    'add_new'            => 'Adicionar Nova',
    'add_new_item'       => 'Adicionar Nova Aba',
    'new_item'           => 'Nova Aba',
    'edit_item'          => 'Editar Aba',
    'view_item'          => 'Visualizar Aba',
    'all_items'          => 'Todas as Abas',
    'search_items'       => 'Buscar Abas',
    'not_found'          => 'Nenhuma aba encontrada.',
    'not_found_in_trash' => 'Nenhuma aba encontrada na lixeira.'
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'has_archive'        => true,
    'rewrite'            => array('slug' => 'abas'),
    'supports'           => array('title', 'editor', 'thumbnail'), // Suporte para título e conteúdo
    'menu_icon'          => 'dashicons-index-card', // Ícone no menu do admin
    'show_in_rest'       => true, // Habilita o suporte à API REST
    'rest_base'          => 'abas', // Define o endpoint base para a API REST
  );

  register_post_type('abas', $args);
}
add_action('init', 'register_abas_cpt');

// Adicionar Meta Box para a Label Lateral
function add_abas_meta_box()
{
  add_meta_box(
    'abas_label_meta_box',
    'Label Lateral',
    'render_abas_meta_box',
    'abas', // Associa ao CPT "Abas"
    'side',
    'default'
  );
}
add_action('add_meta_boxes', 'add_abas_meta_box');

function render_abas_meta_box($post)
{
  // Recupera o valor atual do campo personalizado
  $label = get_post_meta($post->ID, '_abas_label', true);

  echo '<label for="abas_label">Nome da Label Lateral:</label>';
  echo '<input type="text" id="abas_label" name="abas_label" value="' . esc_attr($label) . '" style="width:100%;">';
}

// Salvar o campo "Label Lateral" ao salvar o post
function save_abas_label_meta_box($post_id)
{
  if (array_key_exists('abas_label', $_POST)) {
    update_post_meta(
      $post_id,
      '_abas_label',
      sanitize_text_field($_POST['abas_label'])
    );
  }
}
add_action('save_post', 'save_abas_label_meta_box');

// Expor o campo "Label Lateral" na API REST
function register_abas_label_rest_field()
{
  register_rest_field(
    'abas', // CPT "Abas"
    'label_lateral', // Nome do campo na API
    array(
      'get_callback'    => function ($post) {
        return get_post_meta($post['id'], '_abas_label', true);
      },
      'update_callback' => null,
      'schema'          => null,
    )
  );
}
add_action('rest_api_init', 'register_abas_label_rest_field');
