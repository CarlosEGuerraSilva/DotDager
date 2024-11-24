<?php

use App\Core\Framework\Classes\LanguageManager;
use App\Core\Framework\Classes\Strings;
use App\Core\Server\Actions;
?>
<!DOCTYPE html>
<html lang="<?php echo LanguageManager::getInstance()->getLanguage() ?>">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Open Graph / Socials -->
	<meta property="og:title" content="<?php echo Actions::printLocalized(Strings::APP_NAME) ?>">
	<meta property="og:description" content="<?php echo Actions::printLocalized(Strings::APP_DESCRIPTION) ?>">
	<meta property="og:image" content="<?php echo Actions::printResource("Images/facebook_card.jpg") ?>">
	<meta property="og:url" content="<?php echo Actions::printRoute() ?>">
	<meta property="og:type" content="website">
	<meta property="og:site_name" content="<?php echo Actions::printLocalized(Strings::APP_NAME) ?>">
	<meta property="og:locale" content="<?php echo LanguageManager::getInstance()->getLanguage() ?>">
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="<?php echo Actions::printLocalized(Strings::APP_NAME) ?>">
	<meta name="twitter:description" content="<?php echo Actions::printLocalized(Strings::APP_DESCRIPTION) ?>">
	<meta name="twitter:image" content="<?php echo Actions::printResource("Images/twitter_card.jpg") ?>">
	<meta name="twitter:site" content="@Dager_32">
	<!-- Preload -->
	<link rel="preload" href="<?php echo Actions::printCSS("dark.css") ?>" as="style">
	<link rel="preload" href="<?php echo Actions::printCSS("light.css") ?>" as="style">
	<link rel="preload" href="<?php echo Actions::printCSS("bootstrap.css") ?>" as="style">
	<link rel="preload" href="<?php echo Actions::printCSS("core.css") ?>" as="style">
	<link rel="preload" href="<?php echo Actions::printResource("Webfonts/montserrat-regular-webfont.woff2") ?>" as="font" type="font/woff2" crossorigin="anonymous">
	<link rel="preload" href="<?php echo Actions::printResource("Webfonts/montserrat-bold-webfont.woff2") ?>" as="font" type="font/woff2" crossorigin="anonymous">
	<link rel="preload" href="<?php echo Actions::printScript("mdwc.min.js") ?>" as="script">
	<!-- Page -->
	<title><?php echo Actions::printLocalized(Strings::APP_NAME) ?></title>
	<meta name="description" content="<?php echo Actions::printLocalized(Strings::APP_DESCRIPTION) ?>">
	<script src="<?php echo Actions::printScript("mdwc.min.js") ?>"></script>
	<script src="<?php echo Actions::printScript("core.js") ?>"></script>
	<link rel="stylesheet" href="<?php echo Actions::printCSS("normalize.css") ?>">
	<link rel="stylesheet" href="<?php echo Actions::printCSS("bootstrap.css") ?>">
	<link rel="stylesheet" href="<?php echo Actions::printCSS("core.css") ?>">
	<link rel="stylesheet" href="<?php echo Actions::printCSS("landing.css") ?>">
	<link rel="stylesheet" href="<?php echo Actions::printCSS("icons.css") ?>">
</head>

<body display-lang="<?php echo LanguageManager::getInstance()->getLanguage() ?>">
	<nav id="mainNav">
		<a href="#" class="nav-logo" aria-label="<?php echo Actions::printLocalized(Strings::APP_NAME) ?>">
			<img src="<?php echo Actions::printResource("Images/logo_hotizontal.svg") ?>" alt="DotDager" height="45">
		</a>
		<div class="d-inline-flex gap-3">
			<md-outlined-icon-button toggle id="langChange" aria-label="<?php echo Actions::printLocalized(Strings::DOT_DAGER_TOGGLE_LANG) ?>" title="<?php echo Actions::printLocalized(Strings::DOT_DAGER_TOGGLE_LANG) ?>">
				<img src="<?php echo Actions::printResource("Images/lang_es.svg") ?>" alt="Español" class="img-fluid">
				<img src="<?php echo Actions::printResource("Images/lang_us.svg") ?>" alt="English" class="img-fluid" slot="selected">
			</md-outlined-icon-button>
			<md-outlined-icon-button toggle id="themeChanger" aria-label="<?php echo Actions::printLocalized(Strings::DOT_DAGER_TOGGLE_THEME) ?>" title="<?php echo Actions::printLocalized(Strings::DOT_DAGER_TOGGLE_THEME) ?>">
				<span class="siteicon icon-light" slot="selected"></span>
				<span class="siteicon icon-dark"></span>
			</md-outlined-icon-button>
		</div>
	</nav>
	<a href="#" aria-hidden="true">
		<md-fab id="goTop" href="#">
			<span class="siteicon icon-arrow_up" slot="icon"></span>
		</md-fab>
	</a>
</body>
<section class="hero pb-3 mb-4">
	<img src="<?php echo Actions::printResource("Images/figures.svg") ?>" alt="Random triangles" id="backgroundTop">
	<div class="container py-5">
		<div class="row flex-md-row-reverse">
			<div class="col-12 col-lg-5 text-center text-lg-start">
				<img class="img-fluid dager-hero max-width-px-250 max-width-lg-100 mb-4 mb-lg-0" src="<?php echo Actions::printResource("Images/Dager.svg") ?>" alt="<?php echo Actions::printLocalized(Strings::APP_NAME) ?>">
			</div>
			<div class="col-12 col-lg-7 align-content-end text-center text-lg-start">
				<h1 class="display-1"><?php echo Actions::printLocalized(Strings::DOT_DAGER_LANDING_GREETINGS) ?></h1>
				<h2 class="fs-5 pretty"><?php echo Actions::printLocalized(Strings::DOT_DAGER_LANDING_INTRODUCTION) ?></h2>
				<div class="mt-2 mb-3 d-flex flex-wrap gap-2 hero-links justify-content-center justify-content-lg-start">
					<md-outlined-button target="_blank" href="https://github.com/MarianoVilla">
						<span class="siteicon icon-github" slot="icon"></span>
						MarianoVilla
					</md-outlined-button>
					<md-outlined-button target="_blank" href="https://www.instagram.com/dager.32/">
						<span class="siteicon icon-Instagram" slot="icon"></span>
						dager.32
					</md-outlined-button>
					<md-outlined-button target="_blank" href="https://www.youtube.com/@DotDager">
						<span class="siteicon icon-youtube" slot="icon"></span>
						DotDager
					</md-outlined-button>
					<md-outlined-button target="_blank" href="https://linktr.ee/DotDager">
						<span class="siteicon icon-linktree" slot="icon"></span>
						DotDager
					</md-outlined-button>
				</div>
				<md-filled-button class="contact-me" href="#contact">
					<!--- Aqui hice un pecado capital al escalar el botón y hacer weas para reacomodarlo, responsabilizo a Google por no simplificar el cambio de tamaño de botones en su webada de librería :) -->
					<?php echo Actions::printLocalized(Strings::DOT_DAGER_LANDING_CTA_BUTTON) ?>
				</md-filled-button>
			</div>
		</div>
	</div>
</section>
<section class="background-bg pb-5">
	<div id="projects" class="pt-3">
		<img src="<?php echo Actions::printResource("Images/hello_world.svg") ?>" alt="Imagen de la sección" class="w-100 my-3">
		<div class="container pt-2 pb-3">
			<div class="text-center heading-section">
				<h2 class="display-4 text-shadow"><strong><?php echo Actions::printLocalized(Strings::DOT_DAGER_LANDING_SECTION_PROJECTS_TITLE) ?></strong></h2>
				<h3 class="fs-5 text-shadow"><?php echo Actions::printLocalized(Strings::DOT_DAGER_LANDING_SECTION_PROJECTS_SUBTLE) ?></h3>
			</div>
		</div>
		<div class="container projects-container">
			<div class="row row-cols-1 row-cols-md-2 gx-0 gx-md-4 gy-4">
				<div class="col">
					<a target="_blank" href="https://github.com/MarianoVilla/Git-In-CSharp" class="text-decoration-none d-block mb-4">
						<div class="project-card">
							<md-ripple></md-ripple>
							<img loading="lazy" src="<?php echo Actions::printResource("Images/projects/project_1.webp") ?>" alt="<?php echo Actions::printLocalized(Strings::DOT_DAGER_PROJECT_IMAGE) ?>">
							<div class="p-4">
								<h5><strong>Git-In-CSharp.</strong></h5>
								<p><?php echo Actions::printLocalized(Strings::DOT_DAGER_LANDING_SECTION_PROJECTS_PROJECT_1_DESCRIPTION) ?></p>
								<div class="d-flex flex-wrap gap-2">
									<span class="tag">C#</span>
									<span class="tag">Shell</span>
									<span class="tag">Git</span>
								</div>
							</div>
						</div>
					</a>
					<a target="_blank" href="https://github.com/MarianoVilla/cocobot" class="text-decoration-none d-block">
						<div class="project-card">
							<md-ripple></md-ripple>
							<img loading="lazy" src="<?php echo Actions::printResource("Images/projects/project_4.webp") ?>" alt="<?php echo Actions::printLocalized(Strings::DOT_DAGER_PROJECT_IMAGE) ?>">
							<div class="p-4">
								<h5><strong>cocobot.</strong></h5>
								<p><?php echo Actions::printLocalized(Strings::DOT_DAGER_LANDING_SECTION_PROJECTS_PROJECT_4_DESCRIPTION) ?></p>
								<div class="d-flex flex-wrap gap-2">
									<span class="tag">Javascript</span>
									<span class="tag">Node</span>
									<span class="tag">API</span>
								</div>
							</div>
						</div>
					</a>
				</div>
				<div class="col">
					<a target="_blank" href="https://github.com/MarianoVilla/DNS-Server" class="text-decoration-none d-block mb-4">
						<div class="project-card">
							<md-ripple></md-ripple>
							<img loading="lazy" src="<?php echo Actions::printResource("Images/projects/project_2.webp") ?>" alt="<?php echo Actions::printLocalized(Strings::DOT_DAGER_PROJECT_IMAGE) ?>">
							<div class="p-4">
								<h5><strong>DNS-Server.</strong></h5>
								<p><?php echo Actions::printLocalized(Strings::DOT_DAGER_LANDING_SECTION_PROJECTS_PROJECT_2_DESCRIPTION) ?></p>
								<div class="d-flex flex-wrap gap-2">
									<span class="tag">C#</span>
									<span class="tag">Shell</span>
								</div>
							</div>
						</div>
					</a>
					<a target="_blank" href="https://github.com/MarianoVilla/HTTP-Server" class="text-decoration-none d-block">
						<div class="project-card">
							<md-ripple></md-ripple>
							<img loading="lazy" src="<?php echo Actions::printResource("Images/projects/project_3.webp") ?>" alt="<?php echo Actions::printLocalized(Strings::DOT_DAGER_PROJECT_IMAGE) ?>">
							<div class="p-4">
								<h5><strong>HTTP-Server.</strong></h5>
								<p><?php echo Actions::printLocalized(Strings::DOT_DAGER_LANDING_SECTION_PROJECTS_PROJECT_3_DESCRIPTION) ?></p>
								<div class="d-flex flex-wrap gap-2">
									<span class="tag">C#</span>
									<span class="tag">Shell</span>
									<span class="tag">SSH</span>
								</div>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="background-bg pb-5">
	<div class="pt-3" id="about">
		<img src="<?php echo Actions::printResource("Images/notes_head.svg") ?>" alt="Imagen de la sección" class="w-100 my-3">
		<div class="container pt-2 pb-3">
			<div class="text-center heading-section">
				<h3 class="fs-5 text-shadow"><?php echo Actions::printLocalized(Strings::DOT_DAGER_LANDING_SECTION_ABOUT_SUBTLE) ?></h3>
				<h2 class="display-4 text-shadow"><strong><?php echo Actions::printLocalized(Strings::DOT_DAGER_LANDING_SECTION_ABOUT_TITLE) ?></strong></h2>
			</div>
		</div>
		<div class="container mb-3">
			<div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 gy-4 gx-4 justify-content-center">
				<div class="col">
					<a href="#projects" class="text-decoration-none position-relative">
						<md-ripple></md-ripple>
						<div class="card-photo">
							<img loading="lazy" class="img-fluid" src="<?php echo Actions::printResource("Images/dd_book.webp") ?>" alt="<?php echo Actions::printLocalized(Strings::DOT_DAGER_GENERIC_PHOTO) ?>">
							<div class="p-3">
								<h3><strong><?php echo Actions::printLocalized(Strings::DOT_DAGER_LANDING_SECTION_ABOUT_TOPIC_1) ?></strong></h3>
								<p class="mt-3"><?php echo Actions::printLocalized(Strings::DOT_DAGER_LANDING_SECTION_ABOUT_TOPIC_1_DESCRIPTION) ?></p>
								<p><strong>&gt; Ir a proyectos &lt;</strong></p>
							</div>
						</div>
					</a>
				</div>
				<div class="col">
					<a href="https://discord.gg/4NFk6TamAB" class="text-decoration-none position-relative">
						<md-ripple></md-ripple>
						<div class="card-photo">
							<img loading="lazy" class="img-fluid" src="<?php echo Actions::printResource("Images/dd_gulp2.webp") ?>" alt="<?php echo Actions::printLocalized(Strings::DOT_DAGER_GENERIC_PHOTO) ?>">
							<div class="p-3">
								<h3><strong><?php echo Actions::printLocalized(Strings::DOT_DAGER_LANDING_SECTION_ABOUT_TOPIC_2) ?></strong></h3>
								<p class="mt-3"><?php echo Actions::printLocalized(Strings::DOT_DAGER_LANDING_SECTION_ABOUT_TOPIC_2_DESCRIPTION) ?></p>
								<p><strong>&gt; Unirse a la comunidad &lt;</strong></p>
							</div>
						</div>
					</a>
				</div>
				<div class="col">
					<a href="https://open.spotify.com/intl-es/artist/6bkClBMJd4qKxJp0J5vHsz?si=mbfNHqvBT9SKSQ-ZNhXHJg" class="text-decoration-none position-relative">
						<md-ripple></md-ripple>
						<div class="card-photo">
							<img loading="lazy" class="img-fluid" src="<?php echo Actions::printResource("Images/dd_guitar.webp") ?>" alt="<?php echo Actions::printLocalized(Strings::DOT_DAGER_GENERIC_PHOTO) ?>">
							<div class="p-3">
								<h3><strong><?php echo Actions::printLocalized(Strings::DOT_DAGER_LANDING_SECTION_ABOUT_TOPIC_3) ?></strong></h3>
								<p class="mt-3"><?php echo Actions::printLocalized(Strings::DOT_DAGER_LANDING_SECTION_ABOUT_TOPIC_3_DESCRIPTION) ?></p>
								<p><strong>&gt; Escuchar playlist &lt;</strong></p>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
		<div class="container my-5">
			<div class="text-center heading-section">
				<h3 class="fs-2 text-shadow"><?php echo Actions::printLocalized(Strings::DOT_DAGER_LANDING_SECTION_ABOUT_EXTRAS) ?></h3>
			</div>
		</div>
		<div class="container mb-4">
			<div class="row row-cols-1 row-cols-lg-2 gx-1 gx-md-5 gy-4">
				<div class="col">
					<div class="about-extra mb-4">
						<img loading="lazy" src="<?php echo Actions::printResource("Images/dd_cat.webp") ?>" alt="<?php echo Actions::printLocalized(Strings::DOT_DAGER_GENERIC_PHOTO) ?>">
						<div class="p-5">
							<h3 class="fs-1"><strong><?php echo Actions::printLocalized(Strings::DOT_DAGER_LANDING_SECTION_ABOUT_EXTRA_1) ?></strong></h3>
							<p><?php echo Actions::printLocalized(Strings::DOT_DAGER_LANDING_SECTION_ABOUT_EXTRA_1_DESCRIPTION) ?></p>
						</div>
					</div>
					<div class="about-extra">
						<img loading="lazy" src="<?php echo Actions::printResource("Images/dd_beard.webp") ?>" alt="<?php echo Actions::printLocalized(Strings::DOT_DAGER_GENERIC_PHOTO) ?>">
						<div class="p-5">
							<h3 class="fs-1"><strong><?php echo Actions::printLocalized(Strings::DOT_DAGER_LANDING_SECTION_ABOUT_EXTRA_2) ?></strong></h3>
							<p><?php echo Actions::printLocalized(Strings::DOT_DAGER_LANDING_SECTION_ABOUT_EXTRA_2_DESCRIPTION) ?></p>
						</div>
					</div>
				</div>
				<div class="col">
					<a target="_blank" href="https://tbot.xyz/lumber/" class="text-decoration-none position-relative pickle-ee">
						<img src="<?php echo Actions::printResource("Images/pickle_dager.svg") ?>" alt="Pepinooo" class=" max-width-px-50 pickle">
						<md-ripple></md-ripple>
						<div class="about-extra mb-2 h-100">
							<img loading="lazy" src="<?php echo Actions::printResource("Images/dd_pickle.webp") ?>" alt="<?php echo Actions::printLocalized(Strings::DOT_DAGER_GENERIC_PHOTO) ?>">
							<div class="p-5">
								<h3 class="fs-1"><strong><?php echo Actions::printLocalized(Strings::DOT_DAGER_LANDING_SECTION_ABOUT_EXTRA_3) ?></strong></h3>
								<p><?php echo Actions::printLocalized(Strings::DOT_DAGER_LANDING_SECTION_ABOUT_EXTRA_3_DESCRIPTION) ?></p>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="background-bg pb-5">
	<div class="container pt-2 pb-3" id="dagerfans">
		<div class="text-center heading-section">
			<h2 class="display-4 text-shadow"><strong><?php echo Actions::printLocalized(Strings::DOT_DAGER_LANDING_SECTION_DAGERFANS_TITLE) ?></strong></h2>
			<h3 class="fs-5 text-shadow"><?php echo Actions::printLocalized(Strings::DOT_DAGER_LANDING_SECTION_DAGERFANS_SUBTLE) ?></h3>
		</div>
	</div>
	<div class="container">
		<a href="dagerfans" class="position-relative">
			<md-ripple></md-ripple>
			<div class="p-5 d-flex align-items-center justify-content-center dagerfans-container">
				<img loading="lazy" src="<?php echo Actions::printResource("Images/dager_fans.svg") ?>" alt="DagerFans" class="img-fluid">
			</div>
		</a>
	</div>
</section>
<section class="background-bg pb-5 pt-4">
	<img src="<?php echo Actions::printResource("Images/mails.svg") ?>" alt="Imagen de la sección" class="w-100 my-3">
	<div class="container-lg pt-2 pb-3" id="contact">
		<div class="row row-cols-1 row-cols-md-2 gy-4 gx-4">
			<div class="col">
				<h3 class="fs-5 text-shadow"><?php echo Actions::printLocalized(Strings::DOT_DAGER_LANDING_SECTION_CONTACT_SUBTLE) ?></h3>
				<h2 class="display-3 text-shadow"><strong><?php echo Actions::printLocalized(Strings::DOT_DAGER_LANDING_SECTION_CONTACT_TITLE) ?></strong></h2>
				<p><?php echo Actions::printLocalized(Strings::DOT_DAGER_LANDING_SECTION_CONTACT_DETAILS) ?></p>
			</div>
			<div class="col">
				<form onsubmit="return false;">
					<md-outlined-text-field required label="Nombre completo" placeholder="De preferencia nombre real" class="w-100 mb-3">
					</md-outlined-text-field>
					<md-outlined-text-field required label="Correo de contacto" placeholder="Ingresa un correo de contacto" type="email" class="w-100 mb-3">
					</md-outlined-text-field>
					<md-outlined-text-field required label="Motivo" placeholder="Ingresa un motivo de contacto" class="w-100 mb-3">
					</md-outlined-text-field>
					<md-outlined-text-field required label="Mensaje" placeholder="Tu mensaje" class="w-100 mb-4" type="textarea" rows="4">
					</md-outlined-text-field>
					<md-filled-button class="w-100" type="submit">
						<span class="siteicon icon-email" slot="icon"></span>
						<?php echo Actions::printLocalized(Strings::DOT_DAGER_LANDING_SECTION_CONTACT_TITLE) ?>
					</md-filled-button>
				</form>
			</div>
		</div>
	</div>
</section>
<footer class="pt-5">
	<div class="container">
		<div class="row">
			<div class="col-md-5 mb-4">
				<img src="<?php echo Actions::printResource("Images/logo_hotizontal.svg") ?>" alt="DotDager" height="90">
				<p class="pretty">
					<?php echo Actions::printLocalized(Strings::APP_DESCRIPTION) ?>
				</p>
			</div>
			<div class="col-md-4 mb-4">
				<h5 class="text-uppercase"><?php echo Actions::printLocalized(Strings::DOT_DAGER_QUICKLINKS) ?></h5>
				<ul class="list-unstyled">
					<li><a href="#" class=" text-decoration-none"><?php echo Actions::printLocalized(Strings::DOT_DAGER_LINKS_HOME) ?></a></li>
					<li><a href="#projects" class=" text-decoration-none"><?php echo Actions::printLocalized(Strings::DOT_DAGER_LINKS_PROJECTS) ?></a></li>
					<li><a href="#about" class=" text-decoration-none"><?php echo Actions::printLocalized(Strings::DOT_DAGER_LINKS_ABOUT) ?></a></li>
					<li><a href="#contact" class=" text-decoration-none"><?php echo Actions::printLocalized(Strings::DOT_DAGER_LINKS_CONTACT) ?></a></li>
				</ul>
			</div>
			<div class="col-md-3 mb-4">
				<h5 class="text-uppercase"><?php echo Actions::printLocalized(Strings::DOT_DAGER_LANDING_SECTION_CONTACT_TITLE) ?></h5>
				<p class=" mb-2">
					<a href="mailto:contact@dotdager.com">contact@dotdager.com</a>
				</p>
				<p class=" mb-2">
					<a href="tel:+11234567890">+1 123 456 7890</a>
				</p>
			</div>
		</div>
		<hr class="border-secondary">
	</div>
	<div class="background-bg text-center pb-4">
		&copy; 2024 <?php echo Actions::printLocalized(Strings::APP_NAME) ?>
	</div>
	<div class="background-bg text-center pb-2 color-gray" target="_blank">
		<a href="https://www.linkedin.com/in/carlos-eduardo-guerra-silva/">
			<?php echo Actions::printLocalized(Strings::DOT_DAGER_MADE_BY) ?>
		</a>
	</div>
</footer>

</html>