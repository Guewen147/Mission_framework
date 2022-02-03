<!DOCTYPE html>
<html>

<head>
    <title>W3CAM</title>
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/png" href="<?= base_url('assets/img/w3cam-logo.jpg') ?>" />
    <img src="<?= base_url('assets/img/w3cam-logo.jpg') ?>" alt="logo W3CAM" class="logo" />
</head>

<body>
    </div>
    <div class="bar-navigation">
        <nav class="main-navigation">
            <div class="nav-menu">
                <ul>
                    <li>
                        <a href="#">Info commande</a>
                        <ul class='children'>
                            <li>
                                <form name="commandeAxis" action="<?= base_url('Home/commandeaxis') ?>" method="GET">
                                    <input id="tete" type="submit" value="Commande AXIS">
                                </form>
                            </li>
                            <li>
                                <form name="commandeHikvision" action="<?= base_url('Home/commandehikvision') ?>" method="GET">
                                    <input id="tete" type="submit" value="Commande HikVision">
                                </form>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Marque Produit</a>
                        <ul class='children'>
                            <li>
                                <form name="selection par marque" action="<?= base_url('Home/produit_marque') ?>" method="GET">
                                    <input id="tete" type="submit" value="Modification des prix pour une marque">
                                </form>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Modification Prix HikVision</a>
                        <ul class='children'>
                            <li>
                                <form name="prixHikvision" action="<?= base_url('Home/prixhikvision') ?>" method="GET">
                                    <input id="tete" type="submit" value="Modification Prix HIKVISION">
                                </form>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Produit en Stock</a>
                        <ul class='children'>
                            <li>
                                <form name="produitStock" action="<?= base_url('Home/produitStock') ?>" method="GET">
                                    <input id="tete" type="submit" value="Produit en Stock">
                                </form>
                            </li>
                            <li>
                                <form name="produitQuantiteLimite" action="<?= base_url('Home/produitLimite') ?>" method="GET">
                                    <input id="tete" type="submit" value="Produit en Stock Limite">
                                </form>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="<?= base_url('Home/login') ?>">Déconnexion</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>