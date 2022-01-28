<?php

/*if(isset($_POST['update_order'])) {

    echo "<script>alert('Vous avez modifier une commande');</script>";
    echo "<script> window.location.href='commandeAxis.php'</script>";
}*/
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification de la Commande</title>
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet" type="text/css">
</head>

<body>

    <h1>Modification de la Commande </h1>

    <div class="container">
        <ul class="responsive-table">
            <li class="table-header">
                <div class="col col-1">ID</div>
                <div class="col col-2">Nom de la Commande</div>
                <div class="col col-3">Prix taxe inclus</div>

            </li> <?php
                    if (!empty($id_data)) {
                        foreach ($id_data as $order) {
                    ?>

                    <li class="table-row">
                        <div class="col col-1" data-label="id_product"><?php echo $order->id_order; ?></div>
                        <div class="col col-2" data-label="name"><?php echo $order->product_name; ?></div>
                        <form action="" method="POST">
                            <div class="col col-3" data-label="price"><input type="text" name="price" id="" value="<?php echo $order->total_price_tax_incl; ?>"></div>
                        </form>
                <?php }
                    } ?>
                    </li>
                    <li class="table-row">
                        <div class="col col-4" data-label="RETOUR"><input style="height: 50px;" onclick="history.go(-1)" id=button value="Retour"> </div>
                        <div class="col col-4" data-label="RETOUR"><input type="submit" style="margin-right:20%;height: 50px;" name="update" id="button" value="Modifier"></div>
                    </li>
        </ul>
    </div>