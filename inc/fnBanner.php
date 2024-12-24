<?php
function get_custom_banner_url()
{
  $site_url = home_url($_SERVER['REQUEST_URI']); // Captura o caminho completo
  $banner_url = has_post_thumbnail()
    ? get_the_post_thumbnail_url(null, 'full')
    : esc_url($site_url . '/wp-content/themes/cadfiber/img/imagem-aperto-de-maos-sem-mascara.webp');

  return esc_url($banner_url);
}
