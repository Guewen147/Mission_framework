<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Liste des produit par marque</title>
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet" type="text/css">
</head>

<body>
    <!-- Formulaire pour la barre de recherche -->
    <form class="search" method="GET">
        <input class="send" type="search" name="q" placeholder="Rechercher un produit">
        <button type="submit">Rechercher</button>
    </form>


   <h1> Liste des produits <?php if (isset($_GET['name'])) { echo $_GET['name']; } ?></h1>

    <?php

        $session = \Config\Services::session();

        if($session->getFlashdata('success'))
        {
            echo '
            <div class="alert alert-success">'.$session->getFlashdata("success").'</div>
            ';
        }

        ?>

        <div class="container1">
            <ul class="responsive-table">
                <li class="table-header">
                    <div class="col col-1">ID</div>
                    <div class="col col-3">Nom de la marque
                        <form class="listeD" method="GET" action="">
                            <select name="name" id="name">
                                <option value="">Toutes</option>
                                <!-- Affiche toutes les marques active dans une liste déroulante -->
                                <?php foreach ($liste as $déroulante) { ?>
                                    <option> <?php echo $déroulante->name ?></option>
                                <?php  } ?>
                            </select>
                            <input style="background-color:white; color:black;" type="submit" />
                        </form>
                    </div>
                    <div class="col col-3">Nom du produit</div>
                    <div class="col col-3">Prix d'achat</div>
                    <div class="col col-3">Prix de Vente<br><br>
                    <?php if (isset($_GET['name']) and !empty($_GET['name'])) { ?>
                    <div class="col col-4" data-label="MODIFIER"><a href="<?php echo base_url('Home/edit_price_coef') ?>?name=<?= $_GET['name'] ?>"><span  id=button1>Modifier par coeff</span id=button> </a></div>
       
                    <?php } ?>
                    </div>
                    <div class="col col-5"> MODIFIER <br><br>
                        <!-- Affichage du bouton Modifier pour les produits d'un marque si le nam dans l'URL -->
                    <?php if (isset($_GET['name']) and !empty($_GET['name'])) { ?>
        <div class="col col-4" data-label="MODIFIER"><a href="<?php echo base_url('Home/modif_marque') ?>?name_marque=<?= $_GET['name'] ?>"><span  id=button1>Modifier par marques</span id=button> </a></div>
        <?php } ?>
                    </div>

                </li>

                <?php

                if (!empty($id_data)) {
                    // Affichage de l'id le nom de la marque, le nom du produit, le prix d-achat, le prix de vente pour chaque produit  de la requête
                    foreach ($id_data as $product) { ?>

                        <li class="table-row">

                            <div class="col col-1" data-label="id_product"><?php echo $product->id_product ?></div>
                            <div class="col col-3" data-label="ps_manufacturer.name"><?php echo $product->name_manu ?></div>
                            <div class="col col-3" data-label="ps_product_lang.name"><?php echo $product->name_pro ?></div>
                            <div class="col col-3" data-label="price"><?php echo   $product->wholesale_price ?></div>
                            <div class="col col-3" data-label="price"><?php echo   $product->price ?></div>
                            <!-- Redirection Ajout dans l'URL si l'utilisateur clique sur le bouton -->
                            <div class="col col-5" data-label="MODIFIER"><a href="<?php echo base_url('Home/modif_marque') ?>?id_product=<?php echo $product->id_product; ?>&name=<?php echo $product->name_manu; ?>&multiplicateur_value=<?php echo $product->multiplicateur_value; ?>"><span id=button>Modifier</span id=button> </a>

                        </li>

                <?php
                    }
                } ?>

            </ul>
        </div>
