<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Liste des commandes de AXIS</title>
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet" type="text/css">

</head>

<body>
    <h1> Liste des commandes de AXIS </h1>

    
    <div class="container">
        <ul class="responsive-table">
            <li class="table-header">
                <div class="col col-1">ID</div>
                <div class="col col-2">Nom du Produit</div>
                <div class="col col-3">Quantité</div>
                <div class="col col-3">Prix taxe inclus</div>
                <div class="col col-3">Date ajout</div>
                <div class="col col-3">Total Prix</div>
                <div class="col col-4">MODIFIER</div>

            </li>
            <!-- div contenant les infos des commandes AXIS -->

            <?php 
            if(!empty($id_data)){
                foreach ($id_data as $row) { ?>
                <li class="table-row">
                    <div class="col col-1" data-label="id_product"> <?php echo $row -> id_order . '<br>'; ?> </div>
                    <div class="col col-2" data-label="product_name">  <?php echo $row -> product_name ?></div> 
                    <div class="col col-3" data-label="quantite"><?php echo '&emsp;' . '&emsp;' .  $row -> product_quantity . '<br>'; ?></div>
                    <div class="col col-3" data-label="prix"> <?php echo $row -> total_price_tax_incl . '<br>'; ?> </div>
                    <div class="col col-3" data-label="date">  <?php echo $row -> date_add. '<br>'; ?> </div>
                    <div class="col col-3" data-label="total_prix">  <?php echo $row -> total_prix . '<br>'; ?></div>
                    <div class="col col-4" data-label="MODIFIER"><a href="<?php echo base_url('Home/modif_order') ?>?id_order=<?php echo $row -> id_order ;?>"><span id=button>Modifier</span id=button> </a></div>

                </li>
            <?php }
            }?>
        </ul>
    </div>
