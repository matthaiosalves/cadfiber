<?php
function get_custom_banner_url()
{
  $banner_url = has_post_thumbnail()
    ? get_the_post_thumbnail_url(null, 'full')
    : esc_url(get_site_url() . '/wp-content/themes/cadfiber/img/imagem-aperto-de-maos-sem-mascara.png');

  return esc_url($banner_url);
}
