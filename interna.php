<?php
/*Template Name: Interna */
?>
<?php get_header(); ?>
<section class="banner">
  <div class="tarja">
    <div class="container-fluid">
      <div class="row boxDescription">
        <span>São mais de 32 ferramentas disponíveis para o AutoCAD</span>
      </div>
    </div>
  </div>
  <div class="boxImagem">
    <img loading="lazy" src="<?php echo get_custom_banner_url(); ?>" alt="" class="imagem">
  </div>
  <div class="line">
    <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/img/line-internas.svg" alt="" class="">
  </div>
</section>
<div class="boxTreco">
  <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/img/treco-verde-internas.svg" alt="">
</div>
<section class="oportunidades">
  <div class="container-fluid">
    <div class="row">
      <div class="boxTitles">
        <?php
        $custom_description = get_post_meta(get_the_ID(), '_custom_page_description', true);
        if ($custom_description) {
          echo wp_kses_post($custom_description);
        } else {
        ?>
          <h3>Oportunidades</h3>
          <p><span>para qualquer</span> tipo de <br>projeto de fibra <br> óptica</p>
        <?php
        }
        ?>
      </div>

      <!-- <div class="boxDescription">
        <p>Para todos os tamanhos</p>
      </div> -->
    </div>
  </div>
</section>
<?php include get_template_directory() . '/templates/cta.php'; ?>
<?php include get_template_directory() . '/templates/contato.php'; ?>
<?php get_footer(); ?>