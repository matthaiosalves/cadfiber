<?php
// Registrar o Custom Post Type "Materiais Gratuitos"
function registrar_cpt_materiais_gratuitos()
{
  $labels = array(
    'name'               => 'Materiais Gratuitos',
    'singular_name'      => 'Material Gratuito',
    'menu_name'          => 'Materiais Gratuitos',
    'name_admin_bar'     => 'Material Gratuito',
    'add_new'            => 'Adicionar Novo',
    'add_new_item'       => 'Adicionar Novo Material',
    'new_item'           => 'Novo Material',
    'edit_item'          => 'Editar Material',
    'view_item'          => 'Ver Material',
    'all_items'          => 'Todos os Materiais',
    'search_items'       => 'Buscar Materiais',
    'not_found'          => 'Nenhum material encontrado.',
    'not_found_in_trash' => 'Nenhum material na lixeira.',
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'has_archive'        => true,
    'rewrite'            => array('slug' => 'materiais-gratuitos'),
    'supports'           => array('title'), // Apenas o título
    'show_in_rest'       => true, // Suporte ao editor de blocos
  );

  register_post_type('materiais_gratuitos', $args);
}
add_action('init', 'registrar_cpt_materiais_gratuitos');

// Adicionar Metabox para os Campos Customizados
function adicionar_metabox_materiais_gratuitos()
{
  add_meta_box(
    'dados_materiais', // ID único
    'Configurações do Material', // Título do metabox
    'renderizar_metabox_materiais_gratuitos', // Função de renderização
    'materiais_gratuitos', // Aplica-se apenas ao CPT "Materiais Gratuitos"
    'normal', // Localização
    'default' // Prioridade
  );
}
add_action('add_meta_boxes', 'adicionar_metabox_materiais_gratuitos');

// Renderizar os Campos Customizados
function renderizar_metabox_materiais_gratuitos($post)
{
  // Recuperar valores salvos
  $link_download = get_post_meta($post->ID, '_link_download', true);
  $icone_fontawesome = get_post_meta($post->ID, '_icone_fontawesome', true);

  // Segurança
  wp_nonce_field('salvar_dados_materiais', 'dados_materiais_nonce');

  // Campos
?>
  <p>
    <label for="link_download">Link de Download:</label><br>
    <input
      type="url"
      id="link_download"
      name="link_download"
      value="<?php echo esc_url($link_download); ?>"
      style="width: 100%;"
      placeholder="https://example.com/download/arquivo.zip">
  </p>
  <p>
    <label for="icone_fontawesome">Ícone Font Awesome:</label><br>
    <input
      type="text"
      id="icone_fontawesome"
      name="icone_fontawesome"
      value="<?php echo esc_attr($icone_fontawesome); ?>"
      style="width: 100%;"
      placeholder="Ex: fas fa-download">
    <small>Insira o nome da classe Font Awesome (ex: <code>fas fa-download</code>).</small>
  </p>
<?php
}

// Salvar os Campos Customizados
function salvar_metabox_materiais_gratuitos($post_id)
{
  // Verificar o nonce
  if (!isset($_POST['dados_materiais_nonce']) || !wp_verify_nonce($_POST['dados_materiais_nonce'], 'salvar_dados_materiais')) {
    return;
  }

  // Prevenir autosave
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }

  // Verificar permissões
  if (!current_user_can('edit_post', $post_id)) {
    return;
  }

  // Salvar o link de download
  if (isset($_POST['link_download'])) {
    update_post_meta($post_id, '_link_download', esc_url_raw($_POST['link_download']));
  }

  // Salvar o ícone Font Awesome
  if (isset($_POST['icone_fontawesome'])) {
    update_post_meta($post_id, '_icone_fontawesome', sanitize_text_field($_POST['icone_fontawesome']));
  }
}
add_action('save_post', 'salvar_metabox_materiais_gratuitos');
