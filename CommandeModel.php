<?php

namespace App\Models;

use CodeIgniter\Model;

class CommandeModel extends Model
{
    

    public function getorderaxis ()
    {
        
        $query = $this->db->table("ps_order_detail")
        -> SELECT('ps_orders.id_order, product_name, product_quantity, total_price_tax_incl, date_add')
        -> SELECTsum('total_price_tax_incl' , 'total_prix')
        -> JOIN ('ps_orders' , 'ps_order_detail.id_order = ps_orders.id_order') 
        -> Like ('ps_order_detail.product_name ', 'AXIS')
        -> GROUPBY('id_order')
        -> get();
        return $query;
        
    }

    public function getorderhik ()
    {
        
        $query = $this->db->table("ps_order_detail")
        -> SELECT('ps_orders.id_order, product_name, product_quantity, total_price_tax_incl, date_add')
        -> SELECTsum('total_price_tax_incl' , 'total_prix')
        -> JOIN ('ps_orders' , 'ps_order_detail.id_order = ps_orders.id_order') 
        -> Like ('ps_order_detail.product_name ', 'HIKVISION')
        -> GROUPBY('id_order')
        -> get();
        return $query;
        
    }

    public function getMarque ()
    {
        
        $query = $this->db->table("ps_manufacturer")
        -> SELECT('id_manufacturer, name, active')
        -> WHERE ('ps_manufacturer.active', 1)
        -> GROUPBY('ps_manufacturer.name')
        -> get();
        return $query;

    }

    public function getproduitM ()
    {
        
        $query = $this->db->table("ps_product")
        -> SELECT('multiplicateur_value, ps_manufacturer.name as name_manu,ps_product_lang.name as name_pro, price, wholesale_price, ps_product.id_product')
        -> JOIN ('ps_manufacturer' , 'ps_product.id_manufacturer = ps_manufacturer.id_manufacturer') 
        -> JOIN ('ps_product_lang' , 'ps_product_lang.id_product = ps_product.id_product') 
        -> WHERE ('ps_manufacturer.active', 1)
        -> WHERE ('ps_product.active', 1)
        //-> WHERE ('ps_manufacturer.name', $_GET['name'] )
        -> orderBY('ps_manufacturer.name')
        -> get();
        return $query;

        //$req1 = "SELECT multiplicateur_value, ps_manufacturer.name as name_manu,ps_product_lang.name as name_pro, price, wholesale_price, ps_product.id_product 
        //FROM ps_product INNER JOIN ps_manufacturer ON ps_product.id_manufacturer = ps_manufacturer.id_manufacturer 
        //INNER JOIN ps_product_lang ON ps_product_lang.id_product = ps_product.id_product 
        //WHERE ps_product.active = 1 AND ps_manufacturer.active = 1 AND ps_manufacturer.name = '" . $_GET['name'] . "' 
        //ORDER BY ps_manufacturer.name LIMIT $depart, $nbr_commandes";
        
    }

    public function modifprixhik ()
    {
        
        $query = $this->db->table("ps_product")
        -> SELECT('ps_product.id_product, name, price,wholesale_price')
        -> JOIN ('ps_product_lang' , 'ps_product.id_product = ps_product_lang.id_product')
        -> WHERE ('ps_product.active', 1)
        -> Like (' name ', 'HIKVISION')
        -> GROUPBY('id_product')
        -> get();
        return $query;

    }

    public function getstock ()
    {
        
        $query = $this->db->table("ps_stock_available")
        -> SELECT('ps_product_lang.id_product, name, ps_stock_available.quantity')
        -> JOIN ('ps_product_lang' , 'ps_stock_available.id_product = ps_product_lang.id_product')
        -> JOIN ('ps_product' , 'ps_stock_available.id_product = ps_product_lang.id_product') 
        -> WHERE ('ps_product.active', 1)
        -> GROUPBY('id_product')
        -> get();
        return $query;

    }

    public function getstockLimit ()
    {
        
        $query = $this->db->table("ps_stock_available")
        -> SELECT('ps_product_lang.id_product, name, ps_stock_available.quantity')
        -> JOIN ('ps_product_lang' , 'ps_stock_available.id_product = ps_product_lang.id_product')
        -> JOIN ('ps_product' , 'ps_stock_available.id_product = ps_product_lang.id_product') 
        -> WHERE ('ps_product.active', 1)
        -> WHERE ('ps_stock_available.quantity > 0 AND ps_stock_available.quantity <= 5')
        -> GROUPBY('id_product')
        -> get();
        return $query;

    }

    public function modif_price ()
    {
        
        $query = $this->db->table("ps_product")
        -> SELECT('ps_product.id_product, name, price, wholesale_price')
        -> JOIN ('ps_product_lang' , ' ps_product_lang.id_product = ps_product.id_product')
        -> WHERE ('ps_product.active', 1)
        -> WHERE ('ps_product.id_product', $_GET['id_product'] )
        -> GROUPBY('id_product')
        -> get();
        return $query;
    }


public function modif_order ()
    {
        $query = $this->db->table("ps_order_detail")
        -> SELECT('id_order, product_name, total_price_tax_incl')
        -> WHERE ('id_order', $_GET['id_order'] )
        -> GROUPBY('id_order')
        -> get();
        return $query;

        
    }

    public function update_order ()
    {
        $query = $this->db ->table("ps_order_detail")
        -> set( 'total_price_tax_incl' , $_POST['total_price_tax_incl'])
        -> WHERE ('id_order', $_GET['id_order'] )
        -> GROUPBY('id_order')
        -> get();
        return $query;

        
    }
    
}