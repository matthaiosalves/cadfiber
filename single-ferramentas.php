<?php get_header(); ?>
<section class="banner">
  <div class="tarja">
    <div class="container-fluid">
      <div class="row boxDescription">
        <span><?php the_title(); ?></span>
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
<section class="oportunidades" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/img/Bg-2_Cadfiber.png');">
  <div class="container-fluid">
    <div class="row">
      <div class="boxTitles">
        <h3><?php the_title(); ?></h3>
        <!-- <p></p> -->
      </div>

      <div class="boxDescription">
        <!-- <p>Temos uma lista de novas para lançar em breve.</p> -->
      </div>
    </div>
  </div>
</section>
<section class="contentSingle">
  <div class="container-fluid">
    <div class="row">
      <h3><?php the_title(); ?></h3>
    </div>

    <div class="row content descricao">
      <?php
      if (have_posts()) :
        while (have_posts()) : the_post();
          the_content();
        endwhile;
      else :
        echo 'Nenhum conteúdo encontrado.';
      endif;
      ?>
    </div>

    <div class="row justify-content-center mb-4">
      <a href="<?php echo get_site_url(); ?>/ferramenta/" class="btn btnVerTodos">Ver todos ></a>
    </div>
    <hr class="mt-5 mb-4" />
  </div>
</section>
<?php include get_template_directory() . '/templates/cta.php'; ?>
<?php include get_template_directory() . '/templates/contato.php'; ?>
<?php get_footer(); ?>