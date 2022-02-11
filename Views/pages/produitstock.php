<!DOCTYPE html>
<html>
 <head>
    <meta charset = "utf-8">
  <title>Produit en Stock</title>
  <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet" type="text/css">
 
 </head>
 
    <h1> Liste des produits en Stock</h1>

<div class="container">
<ul class="responsive-table">
    <li class="table-header">
      <div class="col col-1">ID</div>
      <div class="col col-3">Nom du Produit</div>
      <div class="col col-5">Quantité</div>
      <div class="col col-5">LIMITE</div>
    </li>

<?php if(!empty($id_data)){
  // Affichage des quantités produits, avec si <5 rajoute LIMITE si <0 affiche en rupture
                foreach ($id_data as $quantity) {  ?>
    
    <li class="table-row">
    <div class="col col-5" data-label="id_product">  <?php echo $quantity -> id_product. '<br>';?> </div>
    <div class="col col-3" data-label="name">  <?php echo $quantity -> name ?></div> 
    
    <?php  if($quantity -> quantity >5) {?>
        
            <div class="col col-5" data-label="quantite"> <?php echo  $quantity -> quantity . '<br>'; ?></div>
            <div class="col col-5" >&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>
    <?php   }
    
    else if($quantity -> quantity <= 0){?>
        
        <div class="col col-5" data-label="quantite"> <?php echo $quantity -> quantity . '<br>';?> </div>
        <div class="col col-5" data-label="quantite"id=button> <?php echo 'Ruputure'. '<br>';?> </div> <?php
        
    }
        else{ ?>
            <div class="col col-5" data-label="quantite"> <?php echo $quantity -> quantity . '<br>';?> </div>
            <div class="col col-5" data-label="LIMITE"><a href="<?php echo base_url('Home/produitLimite') ?>"><span id=button>LIMITE</span action="<?php echo base_url('Home/produitLimite') ?>" id=button> </a></div>
       <?php }
    ?>
    </li>
<?php }
} ?>
</ul>
</div>