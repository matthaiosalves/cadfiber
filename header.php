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
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


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


	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<?php if (is_front_page()) : ?>
		<style>
			.navbar .nav-link,
			.navbar .boxButtonLogin a {
				color: #fff;
			}

			.navbar .navbar-brand {
				background-color: #fff;
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
					<img class="logoDesktop" src="<?php echo get_template_directory_uri(); ?>/img/<?php echo is_front_page() ? 'logo-reduzido.svg' : 'logo-completo.svg'; ?>" alt="">
					<img class="logoMobile" src="<?php echo get_template_directory_uri(); ?>/img/logo-reduzido.svg" alt="">
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
						<li class="nav-item buttonMobile">
							<a class="nav-link" href="<?php echo get_site_url(); ?>/wp-login.php/">Login</a>
						</li>
					</ul>
				</div>

				<div class="boxButtonLogin">
					<a href="<?php echo get_site_url(); ?>/wp-login.php">Login</a>
				</div>
			</div>
		</nav>
	</header>