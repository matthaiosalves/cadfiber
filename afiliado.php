<?php
/*Template Name: Afiliado */
?>
<?php get_header(); ?>
<style>
  .barrerAzul {
    margin-top: -250px !important;
  }

  .video {
    padding-top: 80px;
  }
</style>
<section class="banner">
  <div class="tarja">
    <div class="container-fluid">
      <div class="row boxDescription">
        <?php the_title(); ?>
      </div>
    </div>
  </div>
  <div class="boxImagem">
    <img src="<?php echo get_template_directory_uri(); ?>/img/imagem-aperto-de-maos-sem-mascara.png" alt="" class="imagem">
  </div>
  <div class="line">
    <img src="<?php echo get_template_directory_uri(); ?>/img/line-internas.svg" alt="" class="">
  </div>
</section>
<div class="boxTreco">
  <img src="<?php echo get_template_directory_uri(); ?>/img/treco-verde-internas.svg" alt="">
</div>
<section class="oportunidades" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/img/Bg-2_Cadfiber.png');">
  <div class="container-fluid">
    <div class="row">
      <div class="boxTitles">
        <h3>CadFiber</h3>
        <p><span>Os melhores</span> produtos <br> para projetistas.</p>
      </div>

      <div class="boxDescription">
        <p>Confira e torne-se um afiliado.</p>
      </div>
    </div>
  </div>
</section>
<section class="video">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <?php
        $template_atual = get_page_template_slug(get_the_ID());
        $youtube_url = get_post_meta(get_the_ID(), '_youtube_iframe_' . $template_atual, true);
        $youtube_id = get_youtube_id($youtube_url);
        if ($youtube_id) :
        ?>
          <iframe
            style="border-radius:20px; max-width:100%;"
            width="1080"
            height="615"
            src="https://www.youtube.com/embed/<?php echo esc_attr($youtube_id); ?>"
            title="YouTube video player"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerpolicy="strict-origin-when-cross-origin"
            allowfullscreen>
          </iframe>
        <?php else : ?>
          <p class="text-white">Por favor, insira um link válido do YouTube.</p>
        <?php endif; ?>
      </div>
    </div>

    <div class="row mt-5 justify-content-center">
      <a class="btn btnAfiliado" href="//app.selectafiliados.com.br/product/details/308029/source" target="_blank">Quero ser um afiliado > </a>
    </div>
  </div>
</section>
<div class="boxTreco">
  <img src="<?php echo get_template_directory_uri(); ?>/img/treco-verde-internas.svg" alt="">
</div>
<?php include get_template_directory() . '/templates/cta.php'; ?>
<?php include get_template_directory() . '/templates/contato.php'; ?>
<?php get_footer(); ?>