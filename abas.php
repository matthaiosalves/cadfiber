<?php
/*
Template Name: Abas 
*/
?>
<?php get_header(); ?>
<section class="banner">
  <div class="tarja">
    <div class="container-fluid">
      <div class="row boxDescription">
        <span>Obtenha toda ajuda que você precisa aqui</span>
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
          <h3>Titulo</h3>
          <p><span>Titulo</span> ferramentas <br> disponíveis <span>para os</span> projetistas.</p>
        <?php
        }
        ?>
      </div>

      <!-- <div class="boxDescription">
        <p>Lorem ipsum</p>
      </div> -->
    </div>
  </div>
</section>
<section class="abas">
  <div class="container-fluid">
    <div class="row">
      <!-- Barra Lateral -->
      <div class="boxAbas card">
        <ul id="abas-list">
          <!-- Itens e subitens serão carregados dinamicamente -->
        </ul>
      </div>

      <!-- Local do Conteúdo -->
      <div class="boxContent card" id="boxContent">
        <p>Selecione uma aba para carregar o conteúdo.</p>
      </div>
    </div>
  </div>
</section>
<?php include get_template_directory() . '/templates/cta.php'; ?>
<?php include get_template_directory() . '/templates/contato.php'; ?>

<script>
  const apiUrl = '<?php echo get_site_url(); ?>/wp-json/custom/v1/abas';

  const boxContent = document.querySelector('.boxContent');
  const abasList = document.getElementById('abas-list');

  let allAbas = [];
  const contentCache = new Map();

  async function loadAbas() {
    try {
      const response = await fetch(apiUrl);
      allAbas = await response.json();

      if (allAbas.length === 0) {
        boxContent.innerHTML = '<p>Nenhuma aba disponível.</p>';
        return;
      }

      let activeAbaId = null;

      const hash = window.location.hash.substring(1);
      if (hash) {
        const abaFromHash = allAbas.find(aba => {
          const anchor = (aba.label_lateral || aba.title)
            .normalize('NFD')
            .replace(/[̀-ͯ]/g, '')
            .replace(/[^a-z0-9]+/gi, '-')
            .toLowerCase();
          return anchor === hash.toLowerCase();
        });
        if (abaFromHash) {
          activeAbaId = abaFromHash.id;
          loadContent(abaFromHash.id);
          setTimeout(() => {
            document.querySelector('#boxContent').scrollIntoView({
              behavior: 'smooth'
            });
          }, 300);
        }
      }

      allAbas
        .filter(aba => !aba.parent_item)
        .forEach((aba, index) => {
          const isActive = aba.id === activeAbaId || (!activeAbaId && index === 0);
          const li = createTabItem(aba, isActive);
          abasList.appendChild(li);
        });

      addClickEvents();
    } catch (error) {
      console.error('Erro ao carregar as abas:', error);
    }
  }

  function createTabItem(aba, isActive) {
    const li = document.createElement('li');

    if (aba.subitens && aba.subitens.length > 0) {
      li.classList.add('has-sub');
    }

    const a = document.createElement('a');
    const anchor = (aba.label_lateral || aba.title)
      .normalize('NFD')
      .replace(/[̀-ͯ]/g, '')
      .replace(/[^a-z0-9]+/gi, '-')
      .toLowerCase();
    a.href = `#${anchor}`;
    a.setAttribute('data-id', aba.id);
    a.textContent = aba.label_lateral || aba.title;

    if (isActive) {
      a.classList.add('active');
      loadContent(aba.id);
    }

    li.appendChild(a);

    if (aba.subitens && aba.subitens.length > 0) {
      const subList = document.createElement('ul');
      aba.subitens.forEach(subitemId => {
        const subitem = allAbas.find(item => item.id === subitemId);
        if (subitem) {
          const subLi = createTabItem(subitem, false);
          subList.appendChild(subLi);
        }
      });
      li.appendChild(subList);
    }

    return li;
  }

  function addClickEvents() {
    const tabs = document.querySelectorAll('.boxAbas ul li > a');

    tabs.forEach(tab => {
      tab.addEventListener('click', (e) => {
        e.preventDefault();

        tabs.forEach(t => t.classList.remove('active'));
        tab.classList.add('active');

        const parentLi = tab.parentElement;
        if (parentLi.classList.contains('has-sub')) {
          parentLi.classList.toggle('open');
        }

        const postId = tab.getAttribute('data-id');
        loadContent(postId);
        history.pushState(null, null, tab.href);
        setTimeout(() => {
          document.querySelector('#boxContent').scrollIntoView({
            behavior: 'smooth'
          });
        }, 300);
      });
    });
  }

  function loadContent(postId) {
    if (contentCache.has(postId)) {
      const cachedContent = contentCache.get(postId);
      renderContent(cachedContent);
      console.log('Conteúdo carregado do cache:', postId);
      return;
    }

    const aba = allAbas.find(item => item.id == postId);

    if (aba) {
      contentCache.set(postId, aba);
      renderContent(aba);
    } else {
      boxContent.innerHTML = '<p>Erro ao carregar o conteúdo.</p>';
      console.error('Conteúdo não encontrado para o ID:', postId);
    }
  }

  function renderContent(aba) {
    boxContent.innerHTML = `
      <h2>${aba.title}</h2>
      <div>${aba.content}</div>
    `;
  }

  loadAbas();
</script>



<?php get_footer(); ?>