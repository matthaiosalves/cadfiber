<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Cadfiber
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="template-directory-uri" content="<?php echo get_template_directory_uri(); ?>">
	<title>Cadfiber - <?php echo get_the_title() ?: 'Inicial'; ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Cadfiber">
	<meta name="keywords" content="Cadfiber">
	<meta name="author" content="Cadfiber">
	<meta name="robots" content="index, follow">
	<meta property="og:title" content="Cadfiber">
	<meta property="og:description" content="">
	<meta property="og:url" content="<?php echo get_site_url(); ?>">
	<meta property="og:image:type" content="image/png">
	<meta property="og:image:width" content="800">
	<meta property="og:image:height" content="800">
	<meta property="og:image" content="<?php echo get_site_url(); ?>/wp-content/themes/">

	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php if (!is_front_page() || !is_home()): ?>
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/nprogress.min.css">
	<?php endif; ?>


	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<?php if (is_front_page() || is_home()) : ?>
		<style>
			.navbar .nav-link,
			.navbar .boxButtonLogin a {
				color: #fff;
			}

			.navbar .navbar-brand {
				background-color: transparent;
				display: flex;
				align-items: center;
				justify-content: center;
				width: 122px;
				height: 100px;
			}

			.navbar .navbar-brand img {
				position: relative;
				left: 10px;
			}
		</style>
	<?php endif; ?>
	<?php if (!is_front_page()) : ?>
		<style>
			.oportunidades {
				padding-bottom: 40px;
				padding-top: 40px;
			}

			.barrerAzul {
				margin-top: 0px;
			}
		</style>
	<?php endif; ?>
	<header>
		<nav class="navbar navbar-expand-lg fixed-top <?php echo is_front_page() ? 'bg-blue' : 'bg-light'; ?>">
			<div class="container-fluid">
				<a class="navbar-brand" href="<?php echo get_site_url(); ?>">
					<img loading="lazy" class="logoDesktop" src="<?php echo get_template_directory_uri(); ?>/img/<?php echo is_front_page() ? 'logo-novo.svg' : 'logo-completo.svg'; ?>" alt="">
					<img loading="lazy" class="logoMobile" src="<?php echo get_template_directory_uri(); ?>/img/logo-completo.svg" alt="">
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav">
						<li class="nav-item">
							<a class="nav-link" aria-current="page" href="<?php echo get_site_url(); ?>#investimentos">Preços</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo get_site_url(); ?>#velocidade">Recursos</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo get_site_url(); ?>/afiliados/">Afiliados</a>
						</li>
						<li class="nav-item dropdown dropdown-hover">
							<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								Aprenda
							</a>
							<ul class="dropdown-menu">
								<span class="tarja"></span>
								<li>
									<a class="dropdown-item" href="<?php echo get_site_url(); ?>/materiais-gratuitos/"><span class="dot"></span>Materiais Gratuitos
										<hr>
									</a>
								</li>
								<li>
									<a class="dropdown-item" href="<?php echo get_site_url(); ?>/expert/"><span class="dot"></span>Expert em Projetos FTTH
										<hr>
									</a>
								</li>
								<li>
									<a class="dropdown-item" href="<?php echo get_site_url(); ?>/epcp/"><span class="dot"></span>EPCP
										<hr>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo get_site_url(); ?>/ajuda/">Ajuda</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#contato">Contato</a>
						</li>
						<!-- <li class="nav-item buttonMobile">
							<a class="nav-link" href="<?php echo get_site_url(); ?>/wp-login.php/">Login</a>
						</li> -->
					</ul>
				</div>

				<!-- <div class="boxButtonLogin">
					<a href="<?php echo get_site_url(); ?>/wp-login.php">Login</a>
				</div> -->
			</div>
		</nav>
	</header>