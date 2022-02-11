<!DOCTYPE html>
<html>

<head>
    <title>W3CAM</title>
    <link href="<?=base_url('assets/css/style.css')?>" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/png" href="<?=base_url('assets/img/w3cam-logo.jpg')?>"/>
    <img src="<?=base_url('assets/img/w3cam-logo.jpg')?>" alt="logo W3CAM" class="logo" />
</head>

<body>
    </div>
    <div class="bar-navigation">
        <nav class="main-navigation">
            <div class="nav-menu">
                <ul>
                    <li>
                        <a href="#">Infos Commandes</a>
                        <ul class='children'>
                            <li>
                                <form name="commande" action="<?php echo base_url('Home/commande') ?>" method="GET">
                                    <input id="tete" type="submit" value="Commande">
                                </form>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Produit par Marque</a>
                        <ul class='children'>
                            <li>
                                <form name="selection par marque" action="<?php echo base_url('Home/produit_marque') ?>" method="GET">
                                    <input id="tete" type="submit" value="Modification des prix pour une marque">
                                </form>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Modification avec CSV</a>
                        <ul class='children'>
                            <li>
                                <form name="prixHikvision" action="<?php echo base_url('Home/prixhikvision') ?>" method="GET">
                                    <input id="tete" type="submit" value="Modification CSV HikVision">
                                </form>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Stock</a>
                        <ul class='children'>
                            <li>
                                <form name="produitStock" action="<?php echo base_url('Home/produitStock') ?>" method="GET">
                                    <input id="tete" type="submit" value="Produit en Stock">
                                </form>
                            </li>
                            <li>
                                <form name="produitQuantiteLimite" action="<?php echo base_url('Home/produitLimite') ?>" method="GET">
                                    <input id="tete" type="submit" value="Produit en Stock Limite">
                                </form>
                            </li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="<?= base_url('Home/deconnexion')?>">Déconnexion</a>
                    </li>
                    <li>
                    <a ><?php echo session('firstname');?> <?php echo session('lastname');?></a> 
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    