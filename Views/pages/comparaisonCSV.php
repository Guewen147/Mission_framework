<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Liste des commandes</title>
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet" type="text/css">

</head>

<body>

<div class="container1">
        <ul class="responsive-table">
            <li class="table-header">
                <div class="col col-1">ID</div>
                <div class="col col-2">Marque</div>
                <div class="col col-2">Nom du Produit</div>
                <div class="col col-3">DESACTIVER</div>
            </li>
            
            <?php

            if (!empty($lesdonnees)) {
                
            foreach ($lesdonnees as $product) { ?>
        <?php print_r($product); ?>
<li class="table-row">
            <div class="col col-1" data-label="id_product"><?php echo $product->id_product ?></div>
            <div class="col col-3" data-label="ps_manufacturer.name"><?php echo $product->name_manu ?></div>
            <div class="col col-3" data-label="ps_product_lang.name"><?php echo $product->name_pro ?></div>
            <div class="col col-5" data-label="DESACTIVER"><a><span id=button>Désactiver</span id=button> </a>
        </li>
                
<?php
    } }
?>

</ul>
</div>