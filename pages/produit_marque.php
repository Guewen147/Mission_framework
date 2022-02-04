<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Liste des produit par marque</title>
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet" type="text/css">
</head>

<body>
    <form class="search" method="GET">
        <input class="send" type="search" name="q" placeholder="Rechercher une commande">
        <button type="submit" action="<?php echo base_url('Home/recherche') ?>">Rechercher</button>
    </form>


    <h1> Liste des produit par marque </h1>

    <?php if (isset($_GET['name']) and !empty($_GET['name'])) { ?>
        <div class="col col-4" data-label="MODIFIER"><a href="<?php echo base_url('Home/modif_marque') ?>?name_marque=<?= $_GET['name'] ?>"><span id=button>Modifier</span id=button> </a>
        <?php } ?>

        <div class="container">
            <ul class="responsive-table">
                <li class="table-header">
                    <div class="col col-1">ID</div>
                    <div class="col col-2">Nom de la marque
                        <form method="GET" action="">
                            <select name="name" id="name">
                                <option value="">Toutes</option>
                                <?php foreach ($liste as $déroulante) { ?>
                                    <option> <?php echo $déroulante->name ?></option>
                                <?php  } ?>
                            </select>
                            <input type="submit" />
                        </form>
                    </div>
                    <div class="col col-2">Nom du produit</div>
                    <div class="col col-3">Prix d'achat</div>
                    <div class="col col-3">Prix de Vente</div>
                    <div class="col col-4">MODIFIER</div>

                </li>

                <?php

                if (!empty($id_data)) {

                    foreach ($id_data as $product) { ?>

                        <li class="table-row">

                            <div class="col col-1" data-label="id_product"><?php echo $product->id_product ?></div>
                            <div class="col col-2" data-label="ps_manufacturer.name"><?php echo $product->name_manu ?></div>
                            <div class="col col-2" data-label="ps_product_lang.name"><?php echo $product->name_pro ?></div>
                            <div class="col col-3" data-label="price"><?php echo '&emsp;' . '&emsp;' .  $product->wholesale_price ?></div>
                            <div class="col col-3" data-label="price"><?php echo '&emsp;' . '&emsp;' .  $product->price ?></div>
                            <div class="col col-4" data-label="MODIFIER"><a href="<?php echo base_url('Home/modif_marque') ?>?id_product=<?php echo $product->id_product; ?>&name=<?php echo $product->name_manu; ?>&multiplicateur_value=<?php echo $product->multiplicateur_value; ?>"><span id=button>Modifier</span id=button> </a>

                        </li>

                <?php
                    }
                } ?>

            </ul>
        </div>