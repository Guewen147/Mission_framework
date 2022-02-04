<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification de la Commande</title>
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet" type="text/css">
</head>
<?php
$validation = \Config\Services::validation();
?>

<body>

    <h1>Modification de la Commande </h1>

    <div class="container">
        <ul class="responsive-table">
            <li class="table-header">
                <div class="col col-1">ID</div>
                <div class="col col-2">Nom de la Commande</div>
                <div class="col col-3">Prix taxe inclus</div>

            </li>
            <form method="post" action="<?php echo base_url('Home/edit_validation'); ?>?id_order=<?php echo $_GET['id_order']; ?>">
                <?php

                if (!empty($id_data)) {
                    foreach ($id_data as $order) {
                ?>

                        <li class="table-row">
                            <div class="col col-1" data-label="id_product"><?php echo $order->id_order; ?></div>
                            <div class="col col-2" data-label="name"><?php echo $order->product_name; ?></div>
                            <form action="" method="POST">
                                <div class="col col-3" data-label="price"><input type="text" name="total_price_tax_incl" id="" value="<?php echo $order->total_price_tax_incl; ?>">
                                    <?php
                                    if ($validation->getError('total_price_tax_incl')) {
                                        echo "
                            <div class='alert alert-danger mt-2'>
                            " . $validation->getError('total_price_tax_incl') . "
                            </div>
                            ";
                                    }
                                    ?> <?php }
                    } ?>
                        </li>
                        <li class="table-row">
                            <div class="col col-1" data-label="RETOUR"><input style="height: 50px;" onclick="history.go(-1)" id=button value="Retour"> </div>
                            <div class="col col-1" data-label="RETOUR"><input type="hidden" name="modif" value="<?php echo $order->id_order; ?>" /><input type="submit" style="margin-left:0%;height: 50px;" name="update_order" id="button" value="Modifier"></div>
                        </li>
            </form>
        </ul>
    </div>