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

    //======================================================================================================================================================
    // SELECT ps_orders.id_order, product_name, product_quantity, total_price_tax_incl, date_add FROM ps_order_detail JOIN ps_orders 
    // ON ps_orders.id_order_detail = ps_orders.id_order WHERE ps_order_detail.name LIKE %HIKVISION% GROUP BY id_order
    //======================================================================================================================================================

    public function getorderhik()
    {
        $query = $this->db->table("ps_order_detail")
            ->SELECT('ps_orders.id_order, product_name, product_quantity, total_price_tax_incl, date_add')
            ->SELECTsum('total_price_tax_incl', 'total_prix')
            ->JOIN('ps_orders', 'ps_order_detail.id_order = ps_orders.id_order')
            ->LIKE('ps_order_detail.product_name ', 'HIKVISION')
            ->GROUPBY('id_order')
            ->get();
        return $query;
    }

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

    //======================================================================================================================================================  
    // SELECT multiplicateur_value, ps_product.id_product, ps_product_lang.name as name_pro, ps_manufacturer.name as name_manu, price, wholesale_price 
    // FROM ps_product JOIN ps_product_lang ON ps_product_lang.id_product = ps_product.id_product JOIN ps_manufacturer.id_manufacturer = ps_product.id_manufacturer
    // WHERE ps_manufacturer.active = 1 AND ps_product.active = 1 AND ps_product_lang.name LIKE '%.$recherche.%' ORDER BY ps_product.id_product;
    //======================================================================================================================================================

    public function getBarreRecherche(string $recherche)
    {
        $query = $this->db->table("ps_product")
            ->SELECT('multiplicateur_value, ps_product.id_product, ps_product_lang.name as name_pro, ps_manufacturer.name as name_manu, price, wholesale_price')
            ->JOIN('ps_product_lang', ' ps_product_lang.id_product = ps_product.id_product')
            ->JOIN('ps_manufacturer', ' ps_manufacturer.id_manufacturer = ps_product.id_manufacturer')
            ->WHERE('ps_manufacturer.active', 1)
            ->WHERE('ps_product.active', 1)
            ->LIKE('ps_product_lang.name', $recherche, 'both')
            ->orderBY('ps_product.id_product')
            ->get();
        return $query;
    }

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
            ->LIKE('ps_orders.id_order', $recherche, 'both')
            ->orLIKE('ps_orders.reference', $recherche, 'both')
            ->limit(50)
            ->groupBY('id_order_detail')
            ->get()
            ->getResult();
        return $rorder;
    }

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

    //======================================================================================================================================================
    // SELECT id_order, product_name, total_price_tax_incl FROM ps_order_detail WHERE id_order = '. $_GET['id_order'].' GROUP BY id_order
    //======================================================================================================================================================

    public function modif_order()
    {
        $query = $this->db->table("ps_order_detail")
            ->SELECT('id_order, product_name, total_price_tax_incl')
            ->WHERE('id_order', $_GET['id_order'])
            ->GROUPBY('id_order')
            ->get();
        return $query;
    }

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

    public function login($email)
    {
        $login = $this->db->table("ps_employee")
            ->where('email', $email)
            ->get()->getResultArray();
        return $login;
    }


    public function import()
    {
        $query = $this->db->table("ps_product")
            ->SELECT('ps_product.id_product, name, price,wholesale_price')
            ->JOIN('ps_product_lang', 'ps_product.id_product = ps_product_lang.id_product')
            ->WHERE('ps_product.active', 1)
            ->Like(' name ', 'HIKVISION')
            ->GROUPBY('id_product')
            ->update();
        return $query;
    }
}