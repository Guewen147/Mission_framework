<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Prix HikVision</title>
    <link href="<?=base_url('assets/css/style.css')?>" rel="stylesheet" type="text/css">
</head>

<body>

    <h1> Modification des commandes de HIKVISION </h1>
    <div id='import'>
        <form enctype="multipart/form-data" action="<?php echo base_url('Home/importcsv') ?>" method="post">
        
            <h4>Choisir un fichier CSV</h4>
</br>
            <input type="file" name="file" accept=".csv">
</br>

            <input type="submit" name="import" value='Import'>
        </form>
    </div>
    



    <div class="container">
        <ul class="responsive-table">
            <li class="table-header">
                <div class="col col-1">ID</div>
                <div class="col col-2">Nom du Produit</div>
                <div class="col col-3">Prix d'Achat</div>
                <div class="col col-3">Prix de vente</div>
                <div class="col col-4">MODIFIER</div>

            </li>

            <?php if(!empty($id_data)){
                foreach ($id_data as $product) { ?>

                <li class="table-row">
                    <div class="col col-1" data-label="id_product"><?php echo $product -> id_product ?></div>
                    <div class="col col-2" data-label="name"><?php echo $product -> name_pro ?></div>
                    <div class="col col-3" data-label="price"><?php echo  $product -> wholesale_price ?></div>
                    <div class="col col-3" data-label="price"><?php echo  $product -> price ?></div>
                    <div class="col col-4" data-label="MODIFIER"><a href="<?php echo base_url('Home/modif_price') ?>?id_product=<?php echo $product -> id_product; ?>&name_manu=<?php echo $product -> name_manu; ?>&multiplicateur_value=<?php echo $product -> multiplicateur_value; ?>"><span id=button>Modifier</span id=button> </a>
                </li>

            <?php } 
            }?>

        </ul>
    </div>