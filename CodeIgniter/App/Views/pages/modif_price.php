<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification du prix du produit</title>
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet" type="text/css">
</head>

<body>
    <?php $validation = \Config\Services::validation(); ?>

    <h1>Modification du prix du produit</h1>
    <div class="container1">
        <ul class="responsive-table">

            <?php if (!empty($id_data)) {

                if (isset($_GET['name_marque']) and !empty($_GET['name_marque'])) {
            ?> <li class="table-header">
                        <div class="col col-1">ID</div>
                        <div class="col col-2">Nom de la marque</div>
                        <div class="col col-2">Nom du Produit</div>
                        <div class="col col-3">Prix d'achat</div>
                        <div class="col col-3">Prix de vente</div>
                        <div class="col col-5">Modifier</div>
                    </li>
                    <?php foreach ($id_data as $product) { ?>
                        <form method="post" action="<?php echo base_url('Home/edit_val_marque') ?>?name_marque=<?= $_GET['name_marque']; ?>&id_product=<?= $product->id_product; ?>&multiplicateur_value=<?= $product->multiplicateur_value ?>">
                            <li class="table-row">
                                <div class="col col-1" data-label="id_product"><?php echo $product->id_product; ?></div>
                                <div class="col col-2" data-label="name_manu"><?php echo $product->name_manu; ?></div>
                                <div class="col col-2" data-label="name_pro"><?php echo $product->name_pro; ?></div>
                                <div class="col col-3" data-label="price_achat"><input type="text" name="wholesale_price" id="" value="<?php echo  $product->wholesale_price; ?>"></div>
                                <?php
                                if ($validation->getError('wholesale_price')) {
                                    echo "
                            <div class='alert alert-danger mt-2'>
                            " . $validation->getError('wholesale_price') . "
                            </div>
                            ";
                                }
                                ?>
                                <div class="col col-3" data-label="price_vente"><?php echo $product->price; ?></div>
                                <div class="col col-5" data-label="Modifier"><input type="hidden" name="id" value="<?php echo $product->id_product; ?>" /><input type="submit" name="update1" id="button2" value="Modifier"></div>
                        </form>
                    <?php
                    }
                } else { ?>
                    <form method="post" action="<?php echo base_url('Home/edit_val_marque'); ?>?id_product=<?php echo $_GET['id_product']; ?>&multiplicateur_value=<?php echo $_GET['multiplicateur_value']; ?>">
                        <?php foreach ($id_data as $product) { ?>
                            <li class="table-header">
                                <div class="col col-1">ID</div>
                                <div class="col col-2">Nom de la marque</div>
                                <div class="col col-2">Nom du Produit</div>
                                <div class="col col-3">Prix d'achat</div>
                                <div class="col col-3">Prix de vente</div>

                            </li>

                            <li class="table-row">
                                <div class="col col-1" data-label="id_product"><?php echo $product->id_product; ?></div>
                                <div class="col col-2" data-label="name_manu"><?php echo $product->name_manu; ?></div>
                                <div class="col col-2" data-label="name_pro"><?php echo $product->name_pro; ?></div>
                                <div class="col col-3" data-label="price_achat"><input type="text" name="wholesale_price" id="" value="<?php echo  $product->wholesale_price; ?>"></div>
                                <?php
                                if ($validation->getError('wholesale_price')) {
                                    echo "
                            <div class='alert alert-danger mt-2'>
                            " . $validation->getError('wholesale_price') . "
                            </div>
                            ";
                                }
                                ?>

                                <div class="col col-3" data-label="price_vente"><?php echo $product->price; ?></div>
                            </li>
                        <?php }
                        ?> <div class="col col-4" data-label="RETOUR"><input type="hidden" name="id" value="<?php echo $product->id_product; ?>" /><input type="submit" style="margin-left:0% ;height: 50px;" name="update" id="button" value="Modifier"></div>
                <?php }
            } ?>
                </li>
                <li class="table-row">
                    <div class="col col-4" data-label="RETOUR"><input style="height: 50px;" onclick="history.go(-1)" id=button value="Retour"> </div>
                    <div class="col col-4" data-label="MODIFIER"><a href="<?php echo base_url('Home/produit_marque') ?>"><input style="margin-right:20%;height: 50px;" value="Marques Produits" id="button"></input></a></div>
                </li>
                    </form>
        </ul>
    </div>