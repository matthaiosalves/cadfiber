<section class="barrerAzul">
  <?php if (is_front_page()): ?>
    <section class="formulario" style="display: none;">
      <div class="container-fluid">
        <div class="row">

          <form action="/">
            <div class="boxTitle">
              <h4>Cadastre-se para receber o modelo prancha</h4>
              <p>Preencha o formulário e receba o modelo de prancha no seu email.</p>
            </div>
            <div class="row mt-4">
              <div class="col-sm-12 col-md-12 col-lg-4 boxName">
                <label for="exampleInputEmail1" class="form-label">Nome completo:*</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Digite o nome completo">
              </div>
              <div class="col-sm-12 col-md-12 col-lg-4 boxEmail">
                <label for="exampleInputEmail1" class="form-label">Email:*</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Digite seu e-mail">
              </div>
              <div class="col-sm-12 col-md-12 col-lg-4 boxProject">
                <label for="exampleInputEmail1" class="form-label">Você já sabe fazer projetos no Autocad?*</label>
                <select class="form-select" aria-label="Default select example">
                  <option selected>Já sou projetista profissional</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>
              </div>

              <div class="boxButtonConvite">
                <a href="#" class="btn btnConvite">Convite > </a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>
  <?php endif; ?>
</section>