<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Cadfiber
 */

get_header();
?>
<section class="banner">
  <div class="tarja">
    <div class="container-fluid">
      <div class="row boxDescription text-center">
        <span>Página não encontrada</span>
      </div>
    </div>
  </div>
  <div class="boxImagem">
    <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/img/imagem-aperto-de-maos-sem-mascara.webp" alt="" class="imagem">
  </div>
</section>
<div class="boxTreco">
  <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/img/treco-verde-internas.svg" alt="">
</div>
<section class="oportunidades" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/img/Bg-2_Cadfiber.webp');">
  <div class="container-fluid">
    <div class="row">
      <div class="boxTitles">
        <p>Desculpe, não conseguimos encontrar o que você está procurando.</p>
        <p>Você será redirecionado para a página inicial em 5 segundos.</p>
      </div>
    </div>
  </div>
</section>
<script>
  setTimeout(function() {
    window.location.href = "<?php echo home_url(); ?>";
  }, 5000);
</script>
<?php
get_footer();
