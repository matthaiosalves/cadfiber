<?php
/*
Template Name: Abas 
*/
?>
<?php get_header(); ?>
<style>
  .boxContent .content {
    display: none;
  }

  .boxContent .content.active {
    display: block;
  }
</style>
<section class="banner">
  <div class="tarja">
    <div class="container-fluid">
      <div class="row boxDescription">
        <span>Obtenha toda ajuda que você precisa aqui</span>
      </div>
    </div>
  </div>
  <div class="boxImagem">
    <img src="<?php echo get_template_directory_uri(); ?>/img/imagem-projeto-sem mascara.png" alt="" class="imagem">
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
        <h3>Titulo</h3>
        <p><span>Titulo</span> ferramentas <br> disponíveis <span>para os</span> projetistas.</p>
      </div>

      <div class="boxDescription">
        <p>Lorem ipsum</p>
      </div>
    </div>
  </div>
</section>
<section class="abas">
  <div class="container-fluid">
    <div class="row">
      <!-- Barra Lateral -->
      <div class="boxAbas card">
        <ul id="abas-list">
          <!-- Itens serão carregados dinamicamente -->
        </ul>
      </div>

      <!-- Local do Conteúdo -->
      <div class="boxContent card">
        <p>Selecione uma aba para carregar o conteúdo.</p>
      </div>
    </div>
  </div>
</section>
<?php include get_template_directory() . '/templates/cta.php'; ?>
<?php include get_template_directory() . '/templates/contato.php'; ?>
<script>
  const apiUrl = '<?php echo get_site_url(); ?>/wp-json/wp/v2/abas';

  const boxContent = document.querySelector('.boxContent');
  const abasList = document.getElementById('abas-list');

  async function loadAbas() {
    try {
      const response = await fetch(apiUrl);
      const abas = await response.json();

      if (abas.length === 0) {
        boxContent.innerHTML = '<p>Nenhuma aba disponível.</p>';
        return;
      }


      abas.forEach((aba, index) => {
        const label = aba.label_lateral || aba.title.rendered;
        const li = document.createElement('li');
        const a = document.createElement('a');
        a.href = '#';
        a.setAttribute('data-id', aba.id);
        a.textContent = label;

        if (index === 0) {
          a.classList.add('active');
          loadContent(aba.id);
        }

        li.appendChild(a);
        abasList.appendChild(li);
      });

      addClickEvents();
    } catch (error) {
      console.error('Erro ao carregar as abas:', error);
    }
  }


  function addClickEvents() {
    const tabs = document.querySelectorAll('.boxAbas ul li a');

    tabs.forEach(tab => {
      tab.addEventListener('click', async (e) => {
        e.preventDefault();
        tabs.forEach(t => t.classList.remove('active'));
        tab.classList.add('active');
        const postId = tab.getAttribute('data-id');
        loadContent(postId);
      });
    });
  }


  async function loadContent(postId) {
    try {
      const response = await fetch(`${apiUrl}/${postId}`);
      const aba = await response.json();

      boxContent.innerHTML = `
        <h2>${aba.title.rendered}</h2>
        ${aba.content.rendered}
      `;
    } catch (error) {
      boxContent.innerHTML = '<p>Erro ao carregar o conteúdo.</p>';
      console.error('Erro ao carregar o conteúdo:', error);
    }
  }

  loadAbas();
</script>

<?php get_footer(); ?>