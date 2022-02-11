<!DOCTYPE html>
<html>
 <head>
    <meta charset = "utf-8">
  <title>Produit en Stock</title>
  <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet" type="text/css">
  
 </head>
 <body>
	  
    <h1> Liste des produits en Stock Limite</h1>
 
<div class="container">
<ul class="responsive-table">
    <li class="table-header">
      <div class="col col-1">ID</div>
      <div class="col col-2">Nom du Produit</div>
      <div class="col col-3">Quantité</div>
    </li>

<?php if(!empty($id_data)){ 
    // Affichage des produits en quantité limité
    foreach( $id_data as $quantity){?>
    <li class="table-row">
    <div class="col col-1" data-label="id_product">  <?php echo $quantity -> id_product . '<br>';?> </div>
    <div class="col col-2" data-label="name">  <?php echo $quantity -> name ?></div> 
    <div class="col col-3" data-label="quantite"><?php echo '&emsp;'.'&emsp;'. $quantity -> quantity. '<br>'; ?></div>
    </li>
<?php } 
}?>
</ul>