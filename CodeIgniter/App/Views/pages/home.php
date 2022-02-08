<!DOCTYPE html>
<html>
<head>
<title>W3CAM</title>
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/png" href="<?= base_url('assets/img/w3cam-logo.jpg') ?>" />
    <!--<img src="<?//=  base_url('assets/img/w3cam-logo.jpg') ?>" alt="logo W3CAM" class="logo" />    -->
</head>
<body>
<div class='Acceuil1'>
<form class="Access">
<strong><?= "Accedez à la page des commandes" ?></strong>
<div class='im-lien'>
<a href="<?= base_url('Home/commande') ?>"> <img style="width:96%; margin-top:2%" src="<?= base_url('assets/img/commande.png')?>" ></a>
</div>
</form>
</div>

<div class='Acceuil2'>
<form class="Access">
<strong><?= "Accedez à la page des produits des marques" ?></strong>
<div class='im-lien'>
<a href="<?= base_url('Home/produit_marque') ?>"> <img style="width:91%; margin-top:2%" src="<?= base_url('assets/img/MarqueProduit.png') ?>" ></a>
</div>
</form>
</div>

<div class='Acceuil3'>
<form class="Access">
<strong><?= "Accedez à la page des modification avec CSV" ?></strong>
<div class='im-lien'>
<a href="<?= base_url('Home/prixhikvision') ?>"> <img style="width:70%; margin-top:7%" src="<?= base_url('assets/img/prixhik.png') ?>" ></a>
</div>
</form>
</div>

<div class='Acceuil4'>
<form class="Access">
<strong><?= "Accedez à la page des Stocks" ?></strong>
<div class='im-lien'>
<a href="<?= base_url('Home/produitStock') ?>"> <img style="width:87%; margin-top:2%" src="<?= base_url('assets/img/ProduitStock.png') ?>" ></a>
</div>
</form>
</div>

<div class='Acceuil5'>
<form class="Access">
<strong><?= "Accedez à la page des stocks Limtité" ?></strong>
<div class='im-lien'>
<a href="<?= base_url('Home/produitLimite') ?>"> <img style="width:87%; margin-top:2%" src="<?= base_url('assets/img/ProduitStockLimite.png') ?>" ></a>
</div>
</form>
</div>

<div class='Acceuil6'>
<form class="Access">
<strong><?= "Retourner a la page de connexion" ?></strong>
<div class='im-lien'>
<a href="<?= base_url('Home/login') ?>"> <img style="width:87%; margin-top:1%" src="<?= base_url('assets/img/Deco.png') ?>" ></a>
</div>
</form>
</div>