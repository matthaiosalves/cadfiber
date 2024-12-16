<?php
// Adicionar Metabox para o Link do YouTube em Home e Afiliado
function adicionar_metabox_youtube()
{
  add_meta_box(
    'youtube_iframe_home', // ID do metabox
    'Link do YouTube (Iframe)', // Título
    'renderizar_metabox_youtube', // Função de renderização
    'page', // Tipo de post onde será exibido
    'normal', // Contexto
    'default' // Prioridade
  );
}
add_action('add_meta_boxes', 'adicionar_metabox_youtube');

// Renderizar a Metabox
function renderizar_metabox_youtube($post)
{
  // Verificar o template atual
  $template_atual = get_page_template_slug($post->ID);
  if (!in_array($template_atual, ['home.php', 'afiliado.php'])) {
    return; // Não exibir o campo em outras páginas
  }

  // Recuperar valor atual do campo
  $youtube_iframe = get_post_meta($post->ID, '_youtube_iframe_' . $template_atual, true);
  wp_nonce_field('salvar_youtube_iframe', 'youtube_iframe_nonce');
?>
  <label for="youtube_iframe">Insira o link de incorporação do YouTube para <?php echo ucfirst(str_replace('.php', '', $template_atual)); ?>:</label>
  <input type="text" id="youtube_iframe" name="youtube_iframe" value="<?php echo esc_url($youtube_iframe); ?>" style="width: 100%;" placeholder="https://www.youtube.com/embed/ID_DO_VIDEO">
<?php
}

// Salvar o valor do Metabox
function salvar_metabox_youtube($post_id)
{
  // Verificar nonce
  if (!isset($_POST['youtube_iframe_nonce']) || !wp_verify_nonce($_POST['youtube_iframe_nonce'], 'salvar_youtube_iframe')) {
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

  // Verificar o template atual
  $template_atual = get_page_template_slug($post_id);
  if (!in_array($template_atual, ['home.php', 'afiliado.php'])) {
    return;
  }

  // Salvar o valor do campo
  if (isset($_POST['youtube_iframe'])) {
    update_post_meta($post_id, '_youtube_iframe_' . $template_atual, esc_url_raw($_POST['youtube_iframe']));
  }
}
add_action('save_post', 'salvar_metabox_youtube');
