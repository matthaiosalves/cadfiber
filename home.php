<?php

/*
Template Name: Home
*/

get_header();
?>
<style>
  .navbar-toggler {
    background-color: #fff;
  }

  @media (max-width: 992px) {
    .footer {
      padding-top: 300px;
    }
  }
</style>
<section class="bannerPrincipal" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/img/Bg-1_Cadfiber.webp');">
  <div class="container-fluid">
    <div class="row">

      <div class="col-sm-12 col-md-12 col-lg-6 mb-4">
        <div class="boxDescription">
          <span>Transforme</span> o <br> modo de elaborar <br> projetos <span>FTTx</span> no <br><span>AutoCAD</span>
        </div>

        <?php
        $url_convite = get_field('url_convite');
        ?>
        <div class="boxButtonConvite">
          <a href="<?php echo esc_url($url_convite ? $url_convite : '#'); ?>" class="btn btnConvite">Convite ></a>
        </div>
      </div>

      <div class="col-sm-12 col-md-12 col-lg-6 boxImagemBanner">
        <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/img/notebook-cadfiber.webp" alt="" class="imgNote">
      </div>

    </div>
  </div>
</section>
<section class="barrerAzulVerde">
  <div class="container-fluid">
    <div class="row">
      <hr>
    </div>
  </div>
</section>
<section class="oportunidades" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/img/Bg-2_Cadfiber.webp');">
  <div class="container-fluid">
    <div class="row">
      <div class="boxTitles">
        <h3>Oportunidades</h3>
        <p><span>para qualquer</span> tipo de <br>projeto de fibra <br> óptica</p>
      </div>

      <div class="boxDescription">
        <p>Para todos os tamanhos</p>
      </div>
    </div>

    <div class="row rowCards">
      <!-- Projetos de FTTx -->
      <div class="card cardBlue col-sm-12 col-md-6 col-lg-3">
        <div class="icon">
          <img loading="lazy" src="<?php echo get_stylesheet_directory_uri(); ?>/img/icone-fttx.svg" alt="Ícone Projetos de FTTx">
        </div>
        <div class="content">
          <h4>Projetos de FTTx</h4>
        </div>
      </div>

      <!-- Compartilhamento de Postes -->
      <div class="card cardBlue col-sm-12 col-md-6 col-lg-3">
        <div class="icon">
          <img loading="lazy" src="<?php echo get_stylesheet_directory_uri(); ?>/img/icone-postes.svg" alt="Ícone Compartilhamento de Postes">
        </div>
        <div class="content">
          <h4>Compartilha-mento de Postes</h4>
        </div>
      </div>

      <!-- Projetos de câmeras -->
      <div class="card cardBlue col-sm-12 col-md-6 col-lg-3">
        <div class="icon">
          <img loading="lazy" src="<?php echo get_stylesheet_directory_uri(); ?>/img/icone-cameras.svg" alt="Ícone Projetos de câmeras">
        </div>
        <div class="content">
          <h4>Projetos de câmeras</h4>
        </div>
      </div>

      <!-- Projetos Subterrâneos -->
      <div class="card cardBlue col-sm-12 col-md-6 col-lg-3">
        <div class="icon">
          <img loading="lazy" src="<?php echo get_stylesheet_directory_uri(); ?>/img/icone-subterraneos.svg" alt="Ícone Projetos Subterrâneos">
        </div>
        <div class="content">
          <h4>Projetos Subterrâneos</h4>
        </div>
      </div>
    </div>

  </div>
</section>
<section class="velocidade" id="velocidade">
  <div class="container-fluid">
    <div class="row text-end">
      <div class="boxTitles">
        <h3>Velocidade</h3>
        <p><span>Todas as ferramentas</span> que<br> você precisa em um <br>só lugar</p>
      </div>

      <div class="boxDescription">
        <p>São mais de 32 ferramentas no menu e <br> temos uma lista de novas para lançar em breve.</p>
      </div>
    </div>

    <div class="row mb-4">

      <?php
      $related_posts = get_field('ferramentas');
      if ($related_posts):
        foreach ($related_posts as $post):
          setup_postdata($post);

          $icone = get_field('icone');
          $descricao = get_the_content();
          $titulo = get_the_title();
          $url = get_permalink();
          $icone = $icone ? esc_url($icone) : get_template_directory_uri() . '/img/icone-5-cadfiber.svg';
      ?>
          <a href="<?php echo esc_url($url); ?>" class="boxAzul">
            <div class="boxBody">
              <img loading="lazy" src="<?php echo $icone; ?>" alt="" class="icone" width="60">
              <div class="boxContent">
                <h4><span class="dot"></span><?php echo esc_html($titulo); ?></h4>
                <p><?php echo esc_html($descricao); ?></p>
              </div>
            </div>
          </a>
      <?php
        endforeach;
        wp_reset_postdata();
      endif;
      ?>

    </div>

    <div class="row justify-content-center mb-4">
      <a href="<?php echo get_site_url(); ?>/ferramenta/" class="btn btnVerTodos">Ver todos ></a>
    </div>

    <hr class="mt-5 mb-4" />

    <div class="row otimize">
      <div class="col-lg-6">
        <div class="boxTitles">
          <h3>Otimize</h3>
          <p><span>Viva uma</span> nova <br> rotina</p>
        </div>

        <div class="boxDescription">
          <p>Na busca para ter excelência na padronização de Projetos FTTx e aumento da produtividade, o cadFiber foi desenvolvido por quem realmente está com a “mão no mouse”.</p>
          <p>Somos um plugin que te ajuda a entregar projetos como um verdadeiro profissional.</p>
        </div>


        <div class="boxTarja">
          <div class="boxContent">
            <div class="boxText">
              <p class="number">+ 2,500</p>
              <p class="title">Alunos</p>
            </div>
            <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/img/Icon-otimize-1.svg" alt="" width="50">
          </div>

          <div class="boxContent">
            <div class="boxText">
              <p class="number">+ 10,000</p>
              <p class="title">KM Projetos</p>
            </div>
            <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/img/Icon-otimize-2.svg" alt="" width="50">
          </div>
        </div>
      </div>

      <div class="col-lg-5 boxImage">
        <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/img/impressora.webp" alt="" class="img-fluid">
      </div>

    </div>

  </div>
</section>
<section class="resultadoConfianca">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6">
        <div class="boxTitles">
          <h3>Resultados</h3>
          <p>Veja por que somos <br> a melhor opção <br> para área de <br> Projetos <span>FTTx no <br> Autocad</span></p>
        </div>
      </div>
      <div class="col-lg-6">
        <?php
        $template_atual = get_page_template_slug(get_the_ID());
        $youtube_url = get_post_meta(get_the_ID(), '_youtube_iframe_' . $template_atual, true);
        $youtube_id = get_youtube_id($youtube_url);
        if ($youtube_id) :
        ?>
          <iframe
            style="border-radius:20px; max-width:100%;"
            width="560"
            height="315"
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

    <div class="row">
      <div class="col-lg-6 text-end">
        <div class="boxDescriptionConfianca">
          <p>Na busca de entregar a melhor solução, essas <br> empresas já nos encontraram e entregam melhores <br> resultados para os seus clientes.</p>
          <p>Faça como grandes empresas que utilizam o <br> cadFiber no setor de engenharia de projetos.</p>
        </div>
      </div>
      <div class="col-lg-6 text-end">
        <div class="boxTitles">
          <h3>Confiança</h3>
          <p><span>Grandes empresas</span><br>crescem mais com <br>o <span>CADFIBER</span></p>
        </div>
      </div>

    </div>
  </div>
</section>
<section class="oferecedores">
  <div class="container-fluid">
    <div class="row">
      <div class="boxImg">
        <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/img/logo-TMB-ENGENHARIA.webp" alt="" class="img-fluid">
      </div>
      <div class="boxImg">
        <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/img/logomarca-planalto-engenharia.webp" alt="" class="img-fluid">
      </div>
      <div class="boxImg">
        <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/img/NOVA-LOGO-PNG-SITE-GOOGLE-1536x803-1.webp" alt="" class="img-fluid">
      </div>
      <div class="boxImg">
        <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/img/Meire-isp-2-2048x1293.webp" alt="" class="img-fluid">
      </div>
      <div class="boxImg">
        <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/img/cadfiber111.webp" alt="" class="img-fluid">
      </div>
      <div class="boxImg">
        <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/img/logomarca-newmaster.webp" alt="" class="img-fluid">
      </div>
    </div>
  </div>
</section>
<section class="investimentos" id="investimentos">
  <div class="container-fluid">
    <div class="row">
      <div class="boxTitles">
        <h3>Investimento</h3>
        <p>Veja o <span>melhor plano</span> pra <br> você <span>começar</span></p>
      </div>
    </div>

    <div class="row boxPricesList">
      <?php
      $args = array(
        'post_type' => 'investimentos',
        'posts_per_page' => -1,
      );

      $query = new WP_Query($args);

      if ($query->have_posts()):
        while ($query->have_posts()): $query->the_post();

          $titulo = get_the_title();
          $descricao = apply_filters('the_content', get_the_content());
          $detalhes = get_post_meta(get_the_ID(), '_investimentos_lista', true);
          $preco = get_post_meta(get_the_ID(), '_investimentos_preco', true);
          $url = get_field('url');
          $detalhes_array = $detalhes ? explode(',', $detalhes) : [];
      ?>
          <div class="col-lg-4 boxCard mb-3">
            <div class="card">
              <div class="card-body">
                <div class="boxType">
                  <span class="text-uppercase"><?php echo esc_html($titulo); ?></span>
                </div>

                <div class="hover">
                  <div class="boxPrice">
                    R$ <span class="price"><?php echo esc_html($preco ? $preco : 'N/A'); ?></span><span class="mounth">Mês</span>
                  </div>

                  <div class="boxDescription">
                    <p class="description"><?php echo esc_html(strip_tags($descricao)); ?></p>
                    <p class="list">
                      <?php
                      if (!empty($detalhes_array)) {
                        foreach ($detalhes_array as $item) {
                          echo '- ' . esc_html(trim($item)) . '<br>';
                        }
                      } else {
                        echo '- Nenhum detalhe disponível <br>';
                      }
                      ?>
                    </p>
                  </div>
                </div>

                <div class="boxButton">
                  <a href="<?php echo esc_url($url); ?>" class="btn btnButtonBuy">COMPRE AGORA ></a>
                </div>
              </div>
            </div>
          </div>
      <?php
        endwhile;
        wp_reset_postdata();
      endif;
      ?>
    </div>



  </div>
</section>
<hr class="marquer" />
<section class="faq" id="faq">
  <div class="container-fluid">
    <div class="row">
      <h2 class="title">Principais Dúvidas</h2>
      <p class="description">Se não encontrar a sua dúvida aqui, entre em contato com um de nossos consultores.</p>
    </div>
    <div class="row">
      <div class="accordion" id="accordionExample">

        <?php
        $args = array(
          'post_type'      => 'faq',
          'posts_per_page' => -1,
          'order'          => 'ASC',
          'orderby'        => 'menu_order'
        );

        $faq_query = new WP_Query($args);

        if ($faq_query->have_posts()) :
          $index = 0;

          while ($faq_query->have_posts()) : $faq_query->the_post();
            $index++;
            $title = get_the_title();
            $content = apply_filters('the_content', get_the_content());
        ?>

            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $index; ?>" aria-controls="collapse<?php echo $index; ?>">
                  <span class="barrer"></span>
                  <div class="titleFaq">
                    <?php echo $index; ?> - <?php echo esc_html($title); ?>
                  </div>
                </button>
              </h2>
              <div id="collapse<?php echo $index; ?>" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <?php echo wp_kses_post($content); ?>
                </div>
              </div>
            </div>

          <?php
          endwhile;
          wp_reset_postdata();
        else :
          ?>
          <p>Nenhum FAQ encontrado.</p>
        <?php endif; ?>

      </div>
    </div>
  </div>
</section>
<hr class="marquer" />
<?php include get_template_directory() . '/templates/cta.php'; ?>
<?php include get_template_directory() . '/templates/contato.php'; ?>
<?php
get_footer();
