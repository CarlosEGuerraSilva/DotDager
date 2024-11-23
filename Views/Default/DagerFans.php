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
	<meta property="og:title" content="DagerFans - <?php echo Actions::printLocalized(Strings::APP_NAME) ?>">
	<meta property="og:description" content="<?php echo Actions::printLocalized(Strings::APP_DESCRIPTION) ?>">
	<meta property="og:image" content="<?php echo Actions::printResource("Images/facebook_card.jpg") ?>">
	<meta property="og:url" content="<?php echo Actions::printRoute() ?>">
	<meta property="og:type" content="website">
	<meta property="og:site_name" content="DagerFans - <?php echo Actions::printLocalized(Strings::APP_NAME) ?>">
	<meta property="og:locale" content="<?php echo LanguageManager::getInstance()->getLanguage() ?>">
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="DagerFans - <?php echo Actions::printLocalized(Strings::APP_NAME) ?>">
	<meta name="twitter:description" content="<?php echo Actions::printLocalized(Strings::APP_DESCRIPTION) ?>">
	<meta name="twitter:image" content="<?php echo Actions::printResource("Images/twitter_card.jpg") ?>">
	<meta name="twitter:site" content="@Dager_32">
	<!-- Preload -->
	<link rel="preload" href="<?php echo Actions::printCSS("bootstrap.css") ?>" as="style">
	<link rel="preload" href="<?php echo Actions::printCSS("core.css") ?>" as="style">
	<link rel="preload" href="<?php echo Actions::printResource("Webfonts/montserrat-regular-webfont.woff2") ?>" as="font" type="font/woff2" crossorigin="anonymous">
	<link rel="preload" href="<?php echo Actions::printResource("Webfonts/montserrat-bold-webfont.woff2") ?>" as="font" type="font/woff2" crossorigin="anonymous">
	<link rel="preload" href="<?php echo Actions::printScript("mdwc.min.js") ?>" as="script">
	<!-- Page -->
	<title><?php echo Actions::printLocalized(Strings::APP_NAME) ?></title>
	<meta name="description" content="<?php echo Actions::printLocalized(Strings::APP_DESCRIPTION) ?>">
	<script src="<?php echo Actions::printScript("mdwc.min.js") ?>"></script>
	<link rel="stylesheet" href="<?php echo Actions::printCSS("normalize.css") ?>">
	<link rel="stylesheet" href="<?php echo Actions::printCSS("bootstrap.css") ?>">
	<link rel="stylesheet" href="<?php echo Actions::printCSS("core.css") ?>">
	<link rel="stylesheet" href="<?php echo Actions::printCSS("fans-light.css") ?>">
	<link rel="stylesheet" href="<?php echo Actions::printCSS("dagerfans.css") ?>">
	<link rel="stylesheet" href="<?php echo Actions::printCSS("fans-icons.css") ?>">
	<link rel="stylesheet" href="<?php echo Actions::printCSS("icons.css") ?>">
</head>

<body>
	<div class="container border-x" id="main-container">
		<div class="profile-section fs-5">
			<img src="<?php echo Actions::printResource("Images/dagerfans/dfans-cover.webp") ?>" alt="Cover">
			<div class="d-flex justify-content-between">
				<div class="d-flex align-items-center gap-2">
					<md-icon-button>
						<span class="ficon icon-arrow-left"></span>
					</md-icon-button>
					<strong>DotDager</strong><span class="ficon icon-check-circle"></span>
				</div>
				<md-icon-button>
					<span class="ficon icon-more-vertical"></span>
				</md-icon-button>
			</div>
		</div>
		<div class="p-3 background-bg">
			<div class="d-flex justify-content-between padding-photo">
				<a href="#">
					<div class="profile-photo">
						<img src="<?php echo Actions::printResource("Images/ahegao.webp") ?>" alt="Dager" class="img-fluid">
					</div>
				</a>
				<div class="d-flex align-items-center gap-2">
					<md-outlined-icon-button><span class="ficon icon-dollar-sign"></span></md-outlined-icon-button>
					<md-outlined-icon-button><span class="ficon icon-message-circle"></span></md-outlined-icon-button>
					<md-outlined-icon-button toggle><span class="ficon icon-star"></span></md-outlined-icon-button>
					<md-outlined-icon-button><span class="siteicon icon-arrow_up"></span></md-outlined-icon-button>
				</div>
			</div>
			<h1 class="fs-4"><strong>DotDager</strong><span class="ficon icon-check-circle"></span></h1>
			<h2 class="text-muted font-size-14">@DotDager &middot; Disponible</h2>
			<p class="mt-2">
				Hola, soy Mariano, también conocido como Lord Dot Dager👀.
			</p>
			<p class="mb-0">
				¿Alguna vez han fantaseado con un código que les haga suspirar? Pues aquí estoy yo, para crear algoritmos que te dejen sin aliento
			</p>
			<a href="#">Más información</a>
		</div>
		<div class="mt-2 p-3 pb-1 background-bg">
			<h4><strong>SUSCRIPCIÓN</strong></h4>
			<md-filled-button class="mt-2 w-100 sub-button">
				<div class="d-flex w-100 justify-content-between">
					<span>SUSCRITO</span>
					<span>$35.99 por mes</span>
				</div>
			</md-filled-button>
			<div class="text-end">
				<span class="text-muted mt-1">Renovación: 22/12/2026</span>
			</div>
			<hr>
		</div>
		<div class="p-3 pt-1 background-bg">
			<h4><strong>PAQUETES DE SUSCRIPCIÓN</strong></h4>
			<md-filled-button class="mt-2 mb-1 w-100 sub-button">
				<div class="d-flex w-100 justify-content-between">
					<span>3 meses (20% off)</span>
					<span>total $86.37</span>
				</div>
			</md-filled-button>
			<md-filled-button class="mt-2 w-100 sub-button">
				<div class="d-flex w-100 justify-content-between">
					<span>6 meses (40% off)</span>
					<span>total $129.56</span>
				</div>
			</md-filled-button>
		</div>
		<div class="mt-2 background-bg">
			<div class="p-3 mb-2">
				<h4><strong>PUBLICACIONES</strong></h4>
				<md-filled-button>Todo (9)</md-filled-button>
				<md-outlined-button>Foto (9)</md-outlined-button>
				<md-outlined-button>Videos (0)</md-outlined-button>
			</div>
			<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
				<div class="col">
					<img loading="lazy" src="<?php echo Actions::printResource("Images/profile.png") ?>" alt="Foto de DotDager" class="img-fluid mb-4">
					<img loading="lazy" src="<?php echo Actions::printResource("Images/dd_bread.webp") ?>" alt="Foto de DotDager" class="img-fluid mb-4">
					<img loading="lazy" src="<?php echo Actions::printResource("Images/dd_cell.webp") ?>" alt="Foto de DotDager" class="img-fluid mb-4">
				</div>
				<div class="col">
					<img loading="lazy" src="<?php echo Actions::printResource("Images/dager_guitarra.jpg") ?>" alt="Foto de DotDager" class="img-fluid mb-4">
					<img loading="lazy" src="<?php echo Actions::printResource("Images/dd_pickle.webp") ?>" alt="Foto de DotDager" class="img-fluid mb-4">
					<img loading="lazy" src="<?php echo Actions::printResource("Images/dd_anon.webp") ?>" alt="Foto de DotDager" class="img-fluid mb-4">
				</div>
				<div class="col">
					<img loading="lazy" src="<?php echo Actions::printResource("Images/dd_cat.webp") ?>" alt="Foto de DotDager" class="img-fluid mb-4">
					<img loading="lazy" src="<?php echo Actions::printResource("Images/ahegao.webp") ?>" alt="Foto de DotDager" class="img-fluid mb-4">
					<img loading="lazy" src="<?php echo Actions::printResource("Images/dd_advice.webp") ?>" alt="Foto de DotDager" class="img-fluid mb-4">
				</div>
			</div>
		</div>
	</div>
	<script>
		window.addEventListener('load', () => {
			document.querySelectorAll(".sub-button").forEach(btn => {
				btn.shadowRoot.querySelector("button .label").style.width = "100%";
			});
		});
	</script>
</body>