<?php
function registrar_cpt_links_uteis()
{
  $labels = array(
    'name'               => 'Links Úteis',
    'singular_name'      => 'Link Útil',
    'menu_name'          => 'Links Úteis',
    'name_admin_bar'     => 'Link Útil',
    'add_new'            => 'Adicionar Novo',
    'add_new_item'       => 'Adicionar Novo Link Útil',
    'new_item'           => 'Novo Link Útil',
    'edit_item'          => 'Editar Link Útil',
    'view_item'          => 'Ver Link Útil',
    'all_items'          => 'Todos os Links Úteis',
    'search_items'       => 'Buscar Links Úteis',
    'not_found'          => 'Nenhum link útil encontrado.',
    'not_found_in_trash' => 'Nenhum link útil na lixeira.',
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'has_archive'        => true,
    'rewrite'            => array('slug' => 'links-uteis'),
    'supports'           => array('title'), // Remove o 'editor' daqui
    'menu_icon'          => 'dashicons-admin-links',
  );

  register_post_type('links_uteis', $args);
}
add_action('init', 'registrar_cpt_links_uteis');


function remover_editor_para_links_uteis()
{
  remove_post_type_support('links_uteis', 'editor'); // Substitua 'links_uteis' pelo seu CPT
}
add_action('init', 'remover_editor_para_links_uteis');

function ocultar_editor_no_cpt()
{
  $screen = get_current_screen();
  if ($screen->post_type === 'links_uteis') {
    echo '<style>
                #postdivrich {
                    display: none;
                }
              </style>';
  }
}
add_action('admin_head', 'ocultar_editor_no_cpt');
function remover_permalink_links_uteis()
{
  $screen = get_current_screen();
  if ($screen->post_type === 'links_uteis') { // Substitua 'links_uteis' pelo slug do seu CPT
    echo '<style>
                #edit-slug-box {
                    display: none;
                }
              </style>';
  }
}
add_action('admin_head', 'remover_permalink_links_uteis');
function remover_metaboxes_links_uteis()
{
  remove_meta_box('slugdiv', 'links_uteis', 'normal'); // Remove o campo de slug
}
add_action('add_meta_boxes', 'remover_metaboxes_links_uteis');


// Adicionar Metabox para o URL
function adicionar_metabox_links_uteis()
{
  add_meta_box(
    'links_uteis_url', // ID da metabox
    'URL do Link', // Título
    'renderizar_metabox_links_uteis', // Função de renderização
    'links_uteis', // CPT associado
    'normal', // Contexto
    'default' // Prioridade
  );
}
add_action('add_meta_boxes', 'adicionar_metabox_links_uteis');

// Renderizar a Metabox
function renderizar_metabox_links_uteis($post)
{
  $url = get_post_meta($post->ID, '_links_uteis_url', true);
  wp_nonce_field('salvar_links_uteis', 'links_uteis_nonce');
?>
  <label for="links_uteis_url">URL:</label>
  <input type="url" id="links_uteis_url" name="links_uteis_url" value="<?php echo esc_url($url); ?>" style="width:100%;">
<?php
}

// Salvar o URL
function salvar_metabox_links_uteis($post_id)
{
  if (!isset($_POST['links_uteis_nonce']) || !wp_verify_nonce($_POST['links_uteis_nonce'], 'salvar_links_uteis')) {
    return;
  }
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }
  if (!current_user_can('edit_post', $post_id)) {
    return;
  }
  if (isset($_POST['links_uteis_url'])) {
    update_post_meta($post_id, '_links_uteis_url', sanitize_text_field($_POST['links_uteis_url']));
  }
}
add_action('save_post', 'salvar_metabox_links_uteis');
