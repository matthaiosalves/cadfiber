<?php
// Adicionar meta box na página de edição
function custom_page_description_meta_box()
{
  add_meta_box(
    'custom_page_description',               // ID da meta box
    'Descrição Personalizada',               // Título da meta box
    'custom_page_description_callback',      // Função de callback
    'page',                                  // Tipo de post (page)
    'normal',                                // Posição
    'high'                                   // Prioridade
  );
}
add_action('add_meta_boxes', 'custom_page_description_meta_box');

// Callback para exibir o campo de texto
function custom_page_description_callback($post)
{
  $value = get_post_meta($post->ID, '_custom_page_description', true);
?>
  <label for="custom_page_description">Insira a descrição (HTML permitido):</label>
  <textarea name="custom_page_description" id="custom_page_description" rows="6" style="width:100%;"><?php echo esc_textarea($value); ?></textarea>
<?php
}

// Salvar o campo de descrição (permitindo HTML)
function save_custom_page_description($post_id)
{
  // Verificar se é uma revisão automática
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

  // Verificar permissões do usuário
  if (!current_user_can('edit_post', $post_id)) return;

  // Salvar o valor (permitindo HTML seguro)
  if (isset($_POST['custom_page_description'])) {
    update_post_meta($post_id, '_custom_page_description', wp_kses_post($_POST['custom_page_description']));
  }
}
add_action('save_post', 'save_custom_page_description');
