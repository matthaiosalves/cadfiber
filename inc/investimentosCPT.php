<?php
// Registrar Custom Post Type 'Investimentos'
function registrar_cpt_investimentos()
{
  $labels = array(
    'name'               => 'Investimentos',
    'singular_name'      => 'Investimento',
    'menu_name'          => 'Investimentos',
    'name_admin_bar'     => 'Investimento',
    'add_new'            => 'Adicionar Novo',
    'add_new_item'       => 'Adicionar Novo Investimento',
    'new_item'           => 'Novo Investimento',
    'edit_item'          => 'Editar Investimento',
    'view_item'          => 'Ver Investimento',
    'all_items'          => 'Todos os Investimentos',
    'search_items'       => 'Buscar Investimentos',
    'not_found'          => 'Nenhum investimento encontrado.',
    'not_found_in_trash' => 'Nenhum investimento na lixeira.',
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'has_archive'        => true,
    'rewrite'            => array('slug' => 'investimentos'),
    'supports'           => array('title', 'editor'),
    'taxonomies'         => array('categoria_investimentos'),
    'show_in_rest'       => true,
  );

  register_post_type('investimentos', $args);
}
add_action('init', 'registrar_cpt_investimentos');

// Registrar Taxonomia Personalizada 'Categoria de Investimentos'
function registrar_taxonomia_categoria_investimentos()
{
  $labels = array(
    'name'              => 'Categorias de Investimentos',
    'singular_name'     => 'Categoria de Investimento',
    'search_items'      => 'Buscar Categorias',
    'all_items'         => 'Todas as Categorias',
    'parent_item'       => 'Categoria Principal',
    'parent_item_colon' => 'Categoria Principal:',
    'edit_item'         => 'Editar Categoria',
    'update_item'       => 'Atualizar Categoria',
    'add_new_item'      => 'Adicionar Nova Categoria',
    'new_item_name'     => 'Novo Nome da Categoria',
    'menu_name'         => 'Categorias',
  );

  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array('slug' => 'categoria-investimentos'),
  );

  register_taxonomy('categoria_investimentos', array('investimentos'), $args);
}
add_action('init', 'registrar_taxonomia_categoria_investimentos');

// Adicionar Metabox para Investimentos
function adicionar_metabox_investimentos()
{
  add_meta_box(
    'investimentos_lista',          // ID da metabox
    'Detalhes do Investimento',     // Título
    'renderizar_metabox_investimentos', // Função de callback
    'investimentos',                // CPT
    'normal',                       // Contexto
    'high'                          // Prioridade
  );
}
add_action('add_meta_boxes', 'adicionar_metabox_investimentos');

// Renderizar a Metabox
function renderizar_metabox_investimentos($post)
{
  $lista = get_post_meta($post->ID, '_investimentos_lista', true);
  $preco = get_post_meta($post->ID, '_investimentos_preco', true); // Recuperar o valor do campo preço
  wp_nonce_field('salvar_investimentos', 'investimentos_nonce');
?>
  <label for="investimentos_lista">Adicione uma lista separada por vírgulas:</label><br>
  <textarea id="investimentos_lista" name="investimentos_lista" rows="5" style="width:100%;"><?php echo esc_textarea($lista); ?></textarea><br><br>

  <label for="investimentos_preco">Preço do Investimento:</label><br>
  <input type="text" id="investimentos_preco" name="investimentos_preco" value="<?php echo esc_attr($preco); ?>" style="width:100%;" /><br>
<?php
}

// Salvar os dados do Metabox
function salvar_metabox_investimentos($post_id)
{
  if (!isset($_POST['investimentos_nonce']) || !wp_verify_nonce($_POST['investimentos_nonce'], 'salvar_investimentos')) {
    return;
  }

  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }

  if (!current_user_can('edit_post', $post_id)) {
    return;
  }

  if (isset($_POST['investimentos_lista'])) {
    update_post_meta($post_id, '_investimentos_lista', sanitize_textarea_field($_POST['investimentos_lista']));
  }

  if (isset($_POST['investimentos_preco'])) {
    update_post_meta($post_id, '_investimentos_preco', sanitize_text_field($_POST['investimentos_preco'])); // Salvar o preço
  }
}
add_action('save_post', 'salvar_metabox_investimentos');
