<!DOCTYPE html>
<html>
	<head>
		<meta charset=utf-8>
		<meta name=viewport content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="/favicon.ico" />

		<title><?=$APPLICATION->ShowTitle()?></title>

		<?php
			$APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH . "/css/normalize.css");
			$APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH . "/modules/bootstrap/css/bootstrap.min.css");
			$APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH . "/modules/fancybox/jquery.fancybox.min.css");
			$APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH . "/modules/jquery-ui/jquery-ui.min.css");
			$APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH . "/modules/slick/slick.css");
			$APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH . "/fonts/montserrat.css");
			$APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH . "/css/prestyle.css");
			$APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH . "/css/style.css");
			$APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH . "/css/custom.css");
			$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/modules/jquery.min.js");
			$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/modules/jquery-ui/jquery-ui.min.js");
			$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/modules/bootstrap/js/bootstrap.min.js");
			$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/modules/fancybox/jquery.fancybox.js");
			$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/modules/slick/slick.min.js");
			$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/modules/jquery.inputmask.bundle.min.js");
			$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/modules/masonry.pkgd.min.js");
			$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/app-helper.js");
			$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/app.js");
		?>

		<?php $APPLICATION->ShowHead();?>
	</head>

	<body>
		<?php $APPLICATION->ShowPanel();?>
		<div class="header">
			<div class="container">
				<ul class="menu">
					<li><a href="/">Главная</a></li>
					<li><a href="/products/">Каталог</a></li>
					<li><a href="/complex-products/">Каталог комплексный</a></li>
				</ul>
			</div>
		</div>

		<br>
		<br>
