<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Cadfiber
 */

?>
<footer class="mt-auto">
	<div class="footer">
		<div class="container-fluid">
			<div class="row">
				<div class="boxLogo">
					<img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/img/logo-branca.svg" alt="">
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="listUteis">
						<p class="title">Links Úteis</p>
						<div class="list">
							<?php
							$query = new WP_Query(array(
								'post_type'      => 'links_uteis',
								'posts_per_page' => -1,
								'orderby'        => 'date',
								'order'          => 'ASC',
							));
							if ($query->have_posts()) :
								while ($query->have_posts()) : $query->the_post();
									$url = get_post_meta(get_the_ID(), '_links_uteis_url', true);
							?>
									<a href="<?php echo esc_url($url); ?>" target="_blank">
										<img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/img/seta.svg" alt="">
										<?php the_title(); ?>
									</a>
							<?php
								endwhile;
								wp_reset_postdata();
							else :
								echo '<p class="text-white">Nenhum link útil encontrado.</p>';
							endif;
							?>
						</div>


					</div>
				</div>

				<div class="col-lg-6">
					<div class="listUteis">
						<p class="title">Central de Ajuda</p>
						<div class="list">
							<div class="boxTel">
								<p><i class="fa-solid fa-phone"></i> Tel. Principal:</p>
								<a href="#">+55 (62) 3142-9962</a>
							</div>
							<div class="boxMail">
								<p> <i class="fa-solid fa-envelope"></i> suporte@cadfiber.com</p>
							</div>
							<div class="boxRedes">
								<a href="https://www.linkedin.com/company/cadfiber-plugin/"><i class="fa-brands fa-linkedin-in"></i></a>
								<a href="https://www.facebook.com/cadfiber/?locale=pt_BR"><i class="fa-brands fa-facebook"></i></a>
								<a href="https://www.youtube.com/channel/UCkp77ENGI8DoloZsWMOZ6bQ"><i class="fa-brands fa-youtube"></i></a>
								<a href="https://www.instagram.com/cadfiber"><i class="fa-brands fa-instagram"></i></a>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	<div class="footerGreen">
		<p>CNPJ: 40.875.623/0001-22 © 20<?php echo date('y'); ?> cadfiber.com – Todos os Direitos Reservados</p>
	</div>
</footer>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<?php if (is_front_page()) : ?>
	<script>
		"use strict";

		document.addEventListener("DOMContentLoaded", function() {
			const scrollHeightToChangeColor = 100;
			const desktopBreakpoint = 992;
			const navbar = document.querySelector(".navbar");
			const navbarBrand = document.querySelector(".navbar .navbar-brand");
			const navLinks = document.querySelectorAll(".navbar .nav-link");
			const boxButtonLogin = document.querySelector(".navbar .boxButtonLogin a");
			const logo = document.querySelector(".navbar-brand img");

			function isDesktop() {
				return window.innerWidth > desktopBreakpoint;
			}

			function updateNavbarAppearance() {
				if (isDesktop()) {
					if (window.scrollY > scrollHeightToChangeColor) {
						navbar.classList.remove("bg-blue");
						navbar.classList.add("bg-light");
						navbarBrand.style.backgroundColor = "transparent";
						navLinks.forEach(link => {
							link.style.color = "#3c5aa3";
						});
						if (boxButtonLogin) {
							boxButtonLogin.style.color = "#3c5aa3";
						}
						logo.src = `${getTemplateDirectoryUri()}/img/logo-completo.svg`;
					} else {
						navbar.classList.remove("bg-light");
						navbar.classList.add("bg-blue");
						navbarBrand.style.backgroundColor = "#ffffff";
						navLinks.forEach(link => {
							link.style.color = "";
						});
						if (boxButtonLogin) {
							boxButtonLogin.style.color = "";
						}
						logo.src = `${getTemplateDirectoryUri()}/img/logo-reduzido.svg`;
					}
				} else {
					navbar.classList.remove("bg-blue");
					navbar.classList.add("bg-light");
					navbarBrand.style.backgroundColor = "#ffffff";
					logo.src = `${getTemplateDirectoryUri()}/img/logo-completo.svg`;
					navLinks.forEach(link => {
						link.style.color = "#3c5aa3";
					});
					if (boxButtonLogin) {
						boxButtonLogin.style.color = "#3c5aa3";
					}
				}
			}

			updateNavbarAppearance();

			window.addEventListener("scroll", updateNavbarAppearance);
			window.addEventListener("resize", updateNavbarAppearance);

			function getTemplateDirectoryUri() {
				return document.querySelector("meta[name='template-directory-uri']").content;
			}
		});
	</script>
<?php endif; ?>
<?php wp_footer(); ?>


</body>

</html>