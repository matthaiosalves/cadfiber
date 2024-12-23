<?php
function custom_banner_settings()
{
  add_menu_page(
    'Configurações do Banner',  // Título da página
    'Banner',                   // Nome no menu
    'manage_options',           // Permissão
    'custom-banner',            // Slug
    'custom_banner_page',       // Callback (exibe o conteúdo)
    'dashicons-format-image',   // Ícone do menu
    20                          // Posição
  );
}
add_action('admin_menu', 'custom_banner_settings');

// Formulário do campo de upload
function custom_banner_page()
{
?>
  <div class="wrap">
    <h1>Configuração do Banner</h1>
    <form method="post" action="options.php">
      <?php
      settings_fields('banner_settings_group');
      do_settings_sections('custom-banner');
      submit_button();
      ?>
    </form>
  </div>
<?php
}

// Registra o campo de upload de imagem
function custom_banner_register_settings()
{
  register_setting('banner_settings_group', 'banner_image');

  add_settings_section('banner_section', 'Banner Principal', null, 'custom-banner');

  add_settings_field(
    'banner_image',
    'URL da Imagem do Banner',
    'banner_image_callback',
    'custom-banner',
    'banner_section'
  );
}
add_action('admin_init', 'custom_banner_register_settings');

// Função para exibir o campo de upload
function banner_image_callback()
{
  $banner = get_option('banner_image');
?>
  <input type="text" name="banner_image" id="banner_image" value="<?php echo esc_url($banner); ?>" style="width: 70%;" />
  <button type="button" class="button button-primary" id="upload_banner_button">Enviar Imagem</button>
  <br><br>
  <?php if ($banner) : ?>
    <img src="<?php echo esc_url($banner); ?>" style="max-width: 300px; height: auto;" />
  <?php endif; ?>
  <script>
    jQuery(document).ready(function($) {
      $('#upload_banner_button').click(function(e) {
        e.preventDefault();
        var image_frame;
        if (image_frame) {
          image_frame.open();
          return;
        }
        image_frame = wp.media({
          title: 'Selecionar ou Enviar Imagem do Banner',
          button: {
            text: 'Usar esta imagem'
          },
          multiple: false
        });
        image_frame.on('select', function() {
          var attachment = image_frame.state().get('selection').first().toJSON();
          $('#banner_image').val(attachment.url);
        });
        image_frame.open();
      });
    });
  </script>
<?php
}
