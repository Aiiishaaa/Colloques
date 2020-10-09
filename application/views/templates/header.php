<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les colloques CERISY &bull; <?= $titre ?></title>
	<meta name="description" content="<?= $description_SEO ?>" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.0/css/all.css" integrity="sha384-OLYO0LymqQ+uHXELyx93kblK5YIS3B2ZfLGBmsJaUyor7CpMTBsahDHByqSuWW+q" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Roboto&family=Roboto+Slab&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?= base_url("/resources/css/main.css") ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url("/resources/css/style.css") ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url("/resources/css/contact.css") ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url("/resources/css/legal.css") ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url("/resources/css/aside.css") ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url("/resources/css/themebar.css") ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url("/resources/css/timeline.css") ?>">
	<script src="<?= base_url("/resources/js/script.js") ?>"></script>
	<script src="https://use.typekit.net/bkt6ydm.js"></script>
	<link rel="icon" href="<?= base_url("/resources/img/favicon.gif") ?>" />
	<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">-->

	<?php if(isset($meta_infos)) { ?>
	<!---- CODE OPEN GRAPH (FACEBOOK) -->
	<meta property="og:type" content="article">
	<meta property="og:title" content="<?= $meta_infos["titre"] ?>">
	<meta property="og:site_name" content="Les colloques CERISY • TERRITOIRES SOLIDAIRES EN COMMUN">
	<meta property="og:url" content="<?= $_SERVER['REQUEST_URI'] ?>">
	<meta property="og:image" content="<?= $meta_infos["image"] ?>">
	<meta property="article:published_time" content="2020-10-15">

	<!---- CODE TWITTER CARD ---->
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:site" content="@"> <!-- saisir le nom du compte twitter -->
	<meta name="twitter:title" content="Les colloques CERISY • <?= $meta_infos["titre"] ?>">
	<meta name="twitter:description" content="Retrouvez <?= $meta_infos["titre"] ?>">
	<meta name="twitter:image" content="<?= $meta_infos["image"] ?>">
	<?php } ?>

</head>

<body>

    <?php $this->load->view('templates/navbar'); ?>
