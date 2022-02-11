<?php

namespace App\Models;

use CodeIgniter\Model;

class CommandeModel extends Model
{
    public function __construct()
    {
        // Loading db instance
        $this->db = db_connect();
    }
    

    // affiche les commandes 
    //======================================================================================================================================================
    // SELECT ps_orders.id_order, product_name, product_quantity, total_price_tax_incl, date_add FROM ps_order_detail JOIN ps_orders 
    // ON ps_orders.id_order_detail = ps_orders.id_order WHERE ps_order_detail.name LIKE %AXIS% GROUP BY id_order
    //======================================================================================================================================================

    public function getorderCommande()
    {
        $query = $this->db->table("ps_order_detail")
            ->SELECT('ps_orders.id_order, product_name, product_quantity, total_price_tax_incl, date_add, reference')
            ->SELECTsum('total_price_tax_incl', 'total_prix')
            ->JOIN('ps_orders', 'ps_order_detail.id_order = ps_orders.id_order')
            //->LIKE('ps_order_detail.product_name ', 'AXIS')
            ->limit(50)
            ->GROUPBY('id_order_detail')
            ->get();
        return $query;
    }

    // permet d'afficher le nom des marques active dans la liste déroulante de produit_marque
    //======================================================================================================================================================
    // SELECT name FROM ps_manufacturer WHERE active = 1 GROUP BY name;
    //======================================================================================================================================================

    public function getMarque()
    {
        $liste = $this->db->table("ps_manufacturer")
            ->SELECT('name')
            ->WHERE('active', 1)
            ->GROUPBY('name')
            ->get()
            ->getResult();
        return $liste;
    }

    // Affiche tous les produits pour une marque choisie grâce à la liste déroulante
    //======================================================================================================================================================
    // SELECT multiplicateur_value, ps_product.id_product, ps_product_lang.name as name_pro, ps_manufacturer.name as name_manu, price, wholesale_price 
    // FROM ps_product JOIN ps_product_lang ON ps_product_lang.id_product = ps_product.id_product JOIN ps_manufacturer.id_manufacturer = ps_product.id_manufacturer
    // WHERE ps_manufacturer.active = 1 AND ps_product.active = 1 AND ps_manufacturer.name = $name (méthode GET dans l'URL) ORDER BY ps_product.id_product;
    //======================================================================================================================================================

    public function getListeMarque($name)
    {
        $marque = $this->db->table("ps_product")
            ->SELECT('multiplicateur_value, ps_product.id_product, ps_product_lang.name as name_pro, ps_manufacturer.name as name_manu, price, wholesale_price')
            ->JOIN('ps_product_lang', ' ps_product_lang.id_product = ps_product.id_product')
            ->JOIN('ps_manufacturer', ' ps_manufacturer.id_manufacturer = ps_product.id_manufacturer')
            ->WHERE('ps_manufacturer.active', 1)
            ->WHERE('ps_product.active', 1)
            ->WHERE('ps_manufacturer.name', $name)
            ->orderBY('ps_product.id_product')
            ->get()
            ->getResult();
        return $marque;
    }

    // Barre de recherche de produit_marque prennant le nom de produit
    //======================================================================================================================================================  
    // SELECT multiplicateur_value, ps_product.id_product, ps_product_lang.name as name_pro, ps_manufacturer.name as name_manu, price, wholesale_price 
    // FROM ps_product JOIN ps_product_lang ON ps_product_lang.id_product = ps_product.id_product JOIN ps_manufacturer.id_manufacturer = ps_product.id_manufacturer
    // WHERE ps_manufacturer.active = 1 AND ps_product.active = 1 AND ps_product_lang.name LIKE '%.$recherche.%' ORDER BY ps_product.id_product;
    //======================================================================================================================================================

    public function getBarreRecherche($recherche)
    {
        $search = $this->db->table("ps_product")
            ->SELECT('multiplicateur_value, ps_product.id_product, ps_product_lang.name as name_pro, ps_manufacturer.name as name_manu, price, wholesale_price')
            ->JOIN('ps_product_lang', ' ps_product_lang.id_product = ps_product.id_product')
            ->JOIN('ps_manufacturer', ' ps_manufacturer.id_manufacturer = ps_product.id_manufacturer')
            ->WHERE('ps_manufacturer.active', 1)
            ->WHERE('ps_product.active', 1)
            ->LIKE('ps_product_lang.name', $recherche, 'both')
            ->orLIKE('ps_product.id_product', $recherche, 'after')
            ->orderBY('ps_product.id_product')
            ->get()
            ->getResult();
        return $search;
    }

    //Barre de recherche des commandes prennat la réference ou l'ID
    //======================================================================================================================================================  
    // SELECT multiplicateur_value, ps_product.id_product, ps_product_lang.name as name_pro, ps_manufacturer.name as name_manu, price, wholesale_price 
    // FROM ps_product JOIN ps_product_lang ON ps_product_lang.id_product = ps_product.id_product JOIN ps_manufacturer.id_manufacturer = ps_product.id_manufacturer
    // WHERE ps_manufacturer.active = 1 AND ps_product.active = 1 AND ps_product_lang.name LIKE '%.$recherche.%' ORDER BY ps_product.id_product;
    //======================================================================================================================================================

    public function getBarreRechercheOrder(string $recherche)
    {
        $rorder = $this->db->table("ps_order_detail")
            ->SELECT('ps_orders.id_order, product_name, product_quantity, total_price_tax_incl, date_add, reference')
            ->SELECTsum('total_price_tax_incl', 'total_prix')
            ->JOIN('ps_orders', 'ps_order_detail.id_order = ps_orders.id_order')
            ->LIKE('ps_orders.id_order', $recherche, 'after')
            ->orLIKE('ps_orders.reference', $recherche, 'both')
            ->limit(50)
            ->groupBY('id_order_detail')
            ->get()
            ->getResult();
        return $rorder;
    }

    // Affiche tous les produits dans produit_marque
    //======================================================================================================================================================
    // SELECT multiplicateur_value, ps_product.id_product, ps_product_lang.name as name_pro, ps_manufacturer.name as name_manu, price, wholesale_price 
    // FROM ps_product JOIN ps_product_lang ON ps_product_lang.id_product = ps_product.id_product JOIN ps_manufacturer.id_manufacturer = ps_product.id_manufacturer
    // WHERE ps_manufacturer.active = 1 AND ps_product.active = 1 ORDER BY ps_product.id_product;
    //======================================================================================================================================================

    public function getproduitM()
    {
        $go = $this->db->table("ps_product")
            ->SELECT('multiplicateur_value, ps_manufacturer.name as name_manu,ps_product_lang.name as name_pro, price, wholesale_price, ps_product.id_product')
            ->JOIN('ps_product_lang', 'ps_product_lang.id_product = ps_product.id_product')
            ->JOIN('ps_manufacturer', 'ps_product.id_manufacturer = ps_manufacturer.id_manufacturer')
            ->WHERE('ps_manufacturer.active', 1)
            ->WHERE('ps_product.active', 1)
            ->orderBY('ps_product.id_product')
            ->get()
            ->getResult();
        return $go;
    }

    // affiche Modif prix pour hikvision
    //======================================================================================================================================================
    // SELECT ps_product.id_product, name, price, wholesale_price FROM ps_product JOIN ps_product_lang ON ps_product_lang.id_product = ps_product.id_product 
    // WHERE ps_product.active = 1 AND name LIKE %HIKVISION% GROUP BY id_product
    //======================================================================================================================================================

    public function modifprixhik()
    {
        $query = $this->db->table("ps_product")
            ->SELECT('ps_product.id_product, price, wholesale_price, multiplicateur_value, ps_product_lang.name as name_pro, ps_manufacturer.name as name_manu')
            ->JOIN('ps_product_lang', 'ps_product.id_product = ps_product_lang.id_product')
            ->JOIN('ps_manufacturer', ' ps_manufacturer.id_manufacturer = ps_product.id_manufacturer')
            ->WHERE('ps_product.active', 1)
            ->Like(' ps_product_lang.name ', 'HIKVISION')
            ->GROUPBY('id_product')
            ->get();
        return $query;
    }

    // affiche les produits en stock et 'en rupture' et 'limite(<5)'
    //======================================================================================================================================================
    // SELECT multiplicateur_value, ps_product.id_product, ps_product_lang.name as name_pro, ps_manufacturer.name as name_manu, price, wholesale_price 
    // FROM ps_product JOIN ps_product_lang ON ps_product_lang.id_product = ps_product.id_product WHERE ps_product.active = 1 GROUP BY id_product
    //======================================================================================================================================================

    public function getstock()
    {
        $query = $this->db->table("ps_stock_available")
            ->SELECT('ps_product_lang.id_product, name, ps_stock_available.quantity')
            ->JOIN('ps_product_lang', 'ps_stock_available.id_product = ps_product_lang.id_product')
            ->JOIN('ps_product', 'ps_stock_available.id_product = ps_product_lang.id_product')
            ->WHERE('ps_product.active', 1)
            ->GROUPBY('id_product')
            ->get();
        return $query;
    }

    //affiche le stock limite(<5)
    //======================================================================================================================================================
    // SELECT ps_product_lang.id_product, name, ps_stock_available.quantity FROM ps_stock_available JOIN ps_product_lang ON ps_product_lang.id_product = ps_stock_available.id_product 
    // JOIN ps_product ON ps_stock_available.id_product = ps_product.id_product ps_ WHERE ps_product.active = 1 AND ps_stock_available.quantity > 0 AND ps_stock_available.quantity <= 5 GROUP BY ps_product_lang.id_product
    //======================================================================================================================================================

    public function getstockLimit()
    {
        $query = $this->db->table("ps_stock_available")
            ->SELECT('ps_product_lang.id_product, name, ps_stock_available.quantity')
            ->JOIN('ps_product_lang', 'ps_stock_available.id_product = ps_product_lang.id_product')
            ->JOIN('ps_product', 'ps_stock_available.id_product = ps_product_lang.id_product')
            ->WHERE('ps_product.active', 1)
            ->WHERE('ps_stock_available.quantity > 0 AND ps_stock_available.quantity <= 5')
            ->GROUPBY('id_product')
            ->get();
        return $query;
    }

    //Affiche la page de modification de prix pour un ID d'un produit
    //======================================================================================================================================================
    // SELECT ps_product.id_product, name, price, wholesale_price FROM ps_product JOIN ps_product_lang ON ps_product_lang.id_product = ps_product.id_product
    // WHERE ps_product.active = 1 AND ps_proudct.id_product = $_GET['id_product'] GROUP BY id_product
    //======================================================================================================================================================

    public function modif_price()
    {
        $query = $this->db->table("ps_product")
            ->SELECT('ps_product.id_product, ps_product_lang.name as name_pro, ps_manufacturer.name as name_manu, price, wholesale_price')
            ->JOIN('ps_product_lang', ' ps_product_lang.id_product = ps_product.id_product')
            ->JOIN('ps_manufacturer', ' ps_manufacturer.id_manufacturer = ps_product.id_manufacturer')
            ->WHERE('ps_product.active', 1)
            ->WHERE('ps_product.id_product', $_GET['id_product'])
            ->GROUPBY('id_product')
            ->get();
        return $query;
    }

    //Affiche la page de modification de prix pour un ID d'un produit
    //======================================================================================================================================================
    // SELECT ps_product.id_product, ps_product_lang.name as name_pro, ps_manufacturer.name as name_manu, price, wholesale_price 
    // FROM ps_product JOIN ps_product_lang ON ps_product_lang.id_product = ps_product.id_product JOIN ps_manufacturer.id_manufacturer = ps_product.id_manufacturer
    // WHERE ps_manufacturer.active = 1 AND ps_product.active = 1 AND ps_product.id_product = ' .$_GET['id_product'];
    //======================================================================================================================================================

    public function modif_marques()
    {
        $query = $this->db->table("ps_product")
            ->SELECT('ps_product.id_product, ps_product_lang.name as name_pro, ps_manufacturer.name as name_manu, price, wholesale_price')
            ->JOIN('ps_product_lang', ' ps_product_lang.id_product = ps_product.id_product')
            ->JOIN('ps_manufacturer', ' ps_manufacturer.id_manufacturer = ps_product.id_manufacturer')
            ->WHERE('ps_product.active', 1)
            ->WHERE('ps_manufacturer.active', 1)
            ->WHERE('ps_product.id_product', $_GET['id_product'])
            ->get();
        return $query;
    }

    //Affiche la page de modification de prix pour tous les ID d'une marque de produit
    //======================================================================================================================================================
    // SELECT ps_product.id_product, ps_product_lang.name as name_pro, ps_manufacturer.name as name_manu, price, wholesale_price, multiplicateur_value
    // FROM ps_product JOIN ps_product_lang ON ps_product_lang.id_product = ps_product.id_product JOIN ps_manufacturer.id_manufacturer = ps_product.id_manufacturer
    // WHERE ps_manufacturer.active = 1 AND ps_product.active = 1 AND ps_product.id_product = ' .$_GET['name_marque'];
    //======================================================================================================================================================

    public function modif_marques_full()
    {
        $query = $this->db->table("ps_product")
            ->SELECT('multiplicateur_value, ps_product.id_product, ps_product_lang.name as name_pro, ps_manufacturer.name as name_manu, price, wholesale_price')
            ->JOIN('ps_product_lang', ' ps_product_lang.id_product = ps_product.id_product')
            ->JOIN('ps_manufacturer', ' ps_manufacturer.id_manufacturer = ps_product.id_manufacturer')
            ->WHERE('ps_product.active', 1)
            ->WHERE('ps_manufacturer.active', 1)
            ->WHERE('ps_manufacturer.name', $_GET['name_marque'])
            ->get();
        return $query;
    }

    //Affiche la page de modification de prix pour un ID d'une commande
    //======================================================================================================================================================
    // SELECT id_order, product_name, total_price_tax_incl FROM ps_order_detail WHERE id_order = '. $_GET['id_order'].' GROUP BY id_order
    //======================================================================================================================================================

    public function modif_order()
    {
        $query = $this->db->table("ps_order_detail")
            ->SELECT('ps_orders.id_order, reference, total_price_tax_incl')
            ->JOIN('ps_orders', 'ps_order_detail.id_order = ps_orders.id_order')
            ->WHERE('ps_order_detail.id_order', $_GET['id_order'])
            ->GROUPBY('ps_order_detail.id_order')
            ->get();
        return $query;
    }

    // Modifie le total prix taxe incluse d'une commande
    //======================================================================================================================================================
    // UPDATE ps_order_detail SET total_price_tax_incl = '. $total_price_tax_incl .' WHERE id_order = '. $id_order;
    //======================================================================================================================================================

    public function updatePrice(int $id_order, int $total_price_tax_incl)
    {
        $this->db->table("ps_order_detail")
            ->set('total_price_tax_incl', $total_price_tax_incl)
            ->where('id_order', $id_order)
            ->update();
    }


    // Modifie le prix d'une marque (saisie du wholesale_price et modification automatique du price selon le multiplicateur_value)
    //======================================================================================================================================================
    // UPDATE ps_product JOIN ps_manufacturer ON ps_manufacturer.id_manufacturer = ps_product.id_manufacturer SET whoelsale_price = '.$wholesale_price.',
    // price = ROUND($wholesale_price*multiplicateur_value) WHERE id_product ='.$id_product;
    //======================================================================================================================================================

    public function updatePriceMarque(int $id_product, float $wholesale_price, float $multiplicateur_value)
    {
        $this->db->table("ps_product")
            ->join('ps_manufacturer', 'ps_manufacturer.id_manufacturer = ps_product.id_manufacturer')
            ->set('wholesale_price', $wholesale_price)
            ->set('price', ROUND($wholesale_price * $multiplicateur_value))
            ->where('id_product', $id_product)
            ->update();
    }

    //Permet le login d'un utilisateur 
    //======================================================================================================================================================
    //SELECT * FROM ps_employee WHERE email = $email ;
    //======================================================================================================================================================
    public function login($email)
    {
        $login = $this->db->table("ps_employee")
            ->where('email', $email)
            ->get()->getResultArray();
        return $login;
    }


    // Permet l'import en CSV des pris Hikvision
    public function importCsv(float $price, $name)
    {
        $import = $this->db->query("UPDATE ps_product INNER JOIN ps_product_lang ON ps_product.id_product = ps_product_lang.id_product  INNER JOIN ps_manufacturer ON ps_product.id_manufacturer = ps_manufacturer.id_manufacturer SET ps_product.wholesale_price = '$price' , ps_product.price = Round('$price'* multiplicateur_value) WHERE ps_product_lang.name LIKE'%$name'");
        return $import;
    }

    // Permet l'import en CSV des pris Hikvision
    public function comparaisonCsv($name)
    {
        $compa = $this->db->table("ps_product")
            ->SELECT('ps_product.id_product, ps_product_lang.name as name_pro, ps_manufacturer.name as name_manu')
            ->JOIN('ps_product_lang', ' ps_product_lang.id_product = ps_product.id_product')
            ->JOIN('ps_manufacturer', ' ps_manufacturer.id_manufacturer = ps_product.id_manufacturer')
            ->WHERE('ps_product.active', 1)
            ->WHERE('ps_manufacturer.active', 1)
            ->LIKE('ps_product_lang.name',$name, 'before')
            ->get()
            ->getResult();
        return $compa;


      /*  $comparaison = $this->db->query("SELECT ps_product.id_product, ps_product_lang.name as name_pro, ps_manufacturer.name as name_manu
        FROM ps_product INNER JOIN ps_product_lang ON ps_product.id_product = ps_product_lang.id_product
        INNER JOIN ps_manufacturer ON ps_product.id_manufacturer = ps_manufacturer.id_manufacturer
        WHERE ps_product_lang.name LIKE '%$name' ORDER BY ps_product.id_product");
        return $comparaison;*/
    }
}