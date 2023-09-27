<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='UTF-8'>
	<title>CS3337</title>
	<meta name='viewport' content='width=device-width, initial-scale=1.0' />
	<?php
		$shortcutIcon = array(
			'href' => 'public/images/favorite.ico',
			'rel' => 'shortcut icon',
			'type' => 'image/png'
		);
		$styleSheet = array(
			'href' => 'public/css/styles.css',
			'rel' => 'stylesheet',
			'type' => 'text/css'
		);
		$bootStrap = array(
			'href' => 'public/css/bootstrap.min.css',
			'rel' => 'stylesheet',
			'type' => 'text/css'
		);
		$jqueryUICSS = array(
			'href' => 'public/javascripts/jquery-ui-1.13.2/jquery-ui.min.css',
			'rel' => 'stylesheet',
			'type' => 'text/css'
		);
		$fontawesome = array(
			'src' => 'https://kit.fontawesome.com/d25bf825c1.js',
			'charset' => 'utf-8',
			'type' => 'text/javascript',
			'crossorigin' => 'anonymous'
		);
		$jquery = array(
			'src' => 'public/javascripts/jquery-3.6.1.min.js',
			'charset' => 'utf-8',
			'type' => 'text/javascript'
		);
		$jqueryUI = array(
			'src' => 'public/javascripts/jquery-ui-1.13.2/jquery-ui.min.js',
			'charset' => 'utf-8',
			'type' => 'text/javascript'
		);
		$utils = array(
			'src' => 'public/javascripts/utils.js',
			'charset' => 'utf-8',
			'type' => 'text/javascript'
		);
		$main = array(
			'src' => 'public/javascripts/main.js',
			'charset' => 'utf-8',
			'type' => 'text/javascript'
		);

		echo link_tag($shortcutIcon);
		echo link_tag($styleSheet);
		echo link_tag($bootStrap);
		echo link_tag($jqueryUICSS);
		echo script_tag($fontawesome);
		echo script_tag($jquery);
		echo script_tag($jqueryUI);
		echo script_tag($utils);
		echo script_tag($main);
		if (isset($linkTags) && count($linkTags) > 0) {
			foreach ($linkTags as $link) {
				echo link_tag($link);
			}
		}
		if (isset($scriptTags) && count($scriptTags) > 0) {
			foreach ($scriptTags as $script) {
				echo script_tag($script);
			}
		}
	?>
	<link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/css/dashboard.css">
</head>
<body>