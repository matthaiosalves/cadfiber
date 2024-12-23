<?php
/*Template Name: Materiais Gratuitos */
?>
<?php get_header(); ?>
<style>
  .card.cardBlue::before,
  .card.cardBlue::after {
    background-color: #fafafa;
  }
</style>
<section class="banner">
  <div class="tarja">
    <div class="container-fluid">
      <div class="row boxDescription">
        <span><?php the_title(); ?></span>
      </div>
    </div>
  </div>
  <div class="boxImagem">
    <img src="<?php echo get_custom_banner_url(); ?>" alt="" class="imagem">
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
        <h3>Ferramentas</h3>
        <p><span>Os melhores</span> produtos <br> para projetistas.</p>
      </div>

      <div class="boxDescription">
        <p>Tamanho A0 para AUTOCAD</p>
      </div>
    </div>
  </div>
</section>
<section class="materiais">
  <div class="container-fluid">
    <div class="row">

      <div class="card cardBlue col-sm-12 col-md-6 col-lg-3">
        <div class="icon">
          <?php
          // Recuperar o ícone Font Awesome
          $icone_fontawesome = get_post_meta(get_the_ID(), '_icone_fontawesome', true);
          if ($icone_fontawesome) {
            echo '<i class="' . esc_attr($icone_fontawesome) . '"></i>';
          } else {
            echo '<img src="' . get_template_directory_uri() . '/img/add-document-icon.svg" alt="Ícone">';
          }
          ?>
        </div>
        <div class="content">
          <h4><?php the_title(); ?></h4>
          <div class="row justify-content-end mt-3">
            <?php
            // Recuperar o link de download
            $link_download = get_post_meta(get_the_ID(), '_link_download', true);
            if ($link_download) {
              echo '<a href="' . esc_url($link_download) . '" class="btn btn-download" target="_blank">Download ></a>';
            } else {
              echo '<p>Link não disponível</p>';
            }
            ?>
          </div>
        </div>
      </div>


    </div>
  </div>
</section>
<div class="boxTreco">
  <img src="<?php echo get_template_directory_uri(); ?>/img/treco-verde-internas.svg" alt="">
</div>
<?php include get_template_directory() . '/templates/cta.php'; ?>
<?php include get_template_directory() . '/templates/contato.php'; ?>
<?php get_footer(); ?>