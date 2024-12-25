<?php
function get_custom_banner_url()
{
  $home_url = get_home_url();
  $theme_path = '/wp-content/themes/cadfiber-bundle/img/imagem-aperto-de-maos-sem-mascara.webp';
  $clean_url = preg_replace('#(/[^/]+)(?=/\1)#', '', $home_url);
  $banner_url = has_post_thumbnail()
    ? get_the_post_thumbnail_url(null, 'full')
    : esc_url(rtrim($clean_url, '/') . $theme_path);

  return esc_url($banner_url);
}
