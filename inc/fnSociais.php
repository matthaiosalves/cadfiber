<?php
function social_links_options_page()
{
  add_menu_page(
    'Redes Sociais',    // Título da página
    'Redes Sociais',    // Nome no menu
    'manage_options',   // Permissão
    'social-links',     // Slug
    'render_social_links_page', // Função para renderizar
    'dashicons-share',  // Ícone do menu
    20                  // Posição no admin
  );
}
add_action('admin_menu', 'social_links_options_page');

function social_links_settings()
{
  register_setting('social_links_options', 'linkedin_url');
  register_setting('social_links_options', 'facebook_url');
  register_setting('social_links_options', 'youtube_url');
  register_setting('social_links_options', 'instagram_url');

  add_settings_section('social_links_section', '', null, 'social-links');

  add_settings_field('linkedin_url', 'LinkedIn', 'linkedin_callback', 'social-links', 'social_links_section');
  add_settings_field('facebook_url', 'Facebook', 'facebook_callback', 'social-links', 'social_links_section');
  add_settings_field('youtube_url', 'YouTube', 'youtube_callback', 'social-links', 'social_links_section');
  add_settings_field('instagram_url', 'Instagram', 'instagram_callback', 'social-links', 'social_links_section');
}
add_action('admin_init', 'social_links_settings');

function render_social_links_page()
{
?>
  <div class="wrap">
    <h1>Links das Redes Sociais</h1>
    <form method="post" action="options.php">
      <?php
      settings_fields('social_links_options');
      do_settings_sections('social-links');
      submit_button();
      ?>
    </form>
  </div>
<?php
}

function linkedin_callback()
{
  $linkedin = esc_attr(get_option('linkedin_url'));
  echo '<input type="url" name="linkedin_url" value="' . $linkedin . '" placeholder="https://linkedin.com/">';
}

function facebook_callback()
{
  $facebook = esc_attr(get_option('facebook_url'));
  echo '<input type="url" name="facebook_url" value="' . $facebook . '" placeholder="https://facebook.com/">';
}

function youtube_callback()
{
  $youtube = esc_attr(get_option('youtube_url'));
  echo '<input type="url" name="youtube_url" value="' . $youtube . '" placeholder="https://youtube.com/">';
}

function instagram_callback()
{
  $instagram = esc_attr(get_option('instagram_url'));
  echo '<input type="url" name="instagram_url" value="' . $instagram . '" placeholder="https://instagram.com/">';
}
