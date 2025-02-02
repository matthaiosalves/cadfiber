<?php
/* Template Name: Ferramentas */
?>
<?php get_header(); ?>

<section class="banner">
  <div class="tarja">
    <div class="container-fluid">
      <div class="row boxDescription">
        <span>São mais de <?php echo wp_count_posts('ferramentas')->publish; ?> ferramentas disponíveis para o AutoCAD</span>
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

<section class="oportunidades" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/img/Bg-2_Cadfiber.webp');">
  <div class="container-fluid">
    <div class="row">
      <div class="boxTitles">
        <?php
        $custom_description = get_post_meta(get_the_ID(), '_custom_page_description', true);
        if ($custom_description) {
          echo wp_kses_post($custom_description);
        } else {
        ?>
          <h3>Confira</h3>
          <p><span>Todas</span> ferramentas <br> disponíveis <span>para os</span> projetistas.</p>
        <?php
        }
        ?>
      </div>

      <!-- <div class="boxDescription">
        <p>Temos uma lista de novas para lançar em breve.</p>
      </div> -->
    </div>
  </div>
</section>

<?php
$categorias = get_terms(array(
  'taxonomy' => 'categorias_ferramentas',
  'hide_empty' => true,
));

if (!empty($categorias) && !is_wp_error($categorias)) :
  foreach ($categorias as $categoria) : ?>
    <section class="section-ferramentas">
      <div class="container-fluid">
        <div class="row">
          <div class="boxTitles">
            <h3><?php echo esc_html($categoria->name); ?></h3>
            <p class="descriptionFerramenta"><?php echo esc_html($categoria->description); ?></p>
          </div>
        </div>

        <div class="row listBoxesAzul">
          <?php
          $ferramentas_query = new WP_Query(array(
            'post_type' => 'ferramentas',
            'posts_per_page' => -1,
            'tax_query' => array(
              array(
                'taxonomy' => 'categorias_ferramentas',
                'field' => 'term_id',
                'terms' => $categoria->term_id,
              ),
            ),
          ));

          if ($ferramentas_query->have_posts()) :
            while ($ferramentas_query->have_posts()) : $ferramentas_query->the_post();
              $icone = get_field('icone');
              $icone = $icone ? esc_url($icone) : get_template_directory_uri() . '/img/icone-5-cadfiber.svg';
              $descricaoResumida = get_field('descricao_resumida');
          ?>
              <a href="<?php the_permalink(); ?>" class="boxAzulFerramentas">
                <div class="card-body">
                  <div class="boxContent">
                    <img loading="lazy" src="<?php echo $icone; ?>" alt="" class="icone" width="60">
                    <p><?php the_title(); ?></p>
                  </div>
                  <div class="boxDescriptionCustom">
                    <p class="descriptionCustomNew"><?php echo $descricaoResumida ?: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed.'; ?></p>
                  </div>
                </div>
              </a>
          <?php
            endwhile;
          else :
            echo '<p>Nenhuma ferramenta encontrada nesta categoria.</p>';
          endif;

          wp_reset_postdata();
          ?>
        </div>
      </div>
    </section>
<?php
  endforeach;
endif;
?>
<?php include get_template_directory() . '/templates/cta.php'; ?>
<?php include get_template_directory() . '/templates/contato.php'; ?>
<?php get_footer(); ?>