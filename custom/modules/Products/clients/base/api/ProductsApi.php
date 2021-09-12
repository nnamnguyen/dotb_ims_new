<?php

class ProductsApi extends DotbApi
{
    function registerApiRest()
    {
        return array(
            'void_receipt' => array(
                'reqType' => 'POST',
                'path' => array('products', 'getProductLineItem'),
                'pathVars' => array(),
                'method' => 'getProductLineItem'
            ),
            'delete_product_producttemplate' => array(
                'reqType' => 'PUT',
                'path' => array('remove', 'productProductTemplate'),
                'pathVars' => array(),
                'method' => 'deleteProductProductTemplate'
            ),
            'getUnitPrice' => array(
                'reqType' => 'POST',
                'path' => array('get', 'unitPrice'),
                'pathVars' => array(),
                'method' => 'getUnitPrice'
            ),
        );
    }
    /**
     * @param ServiceBase $api
     * @param array $args : dotb_ext, dotb_phone, dotb_call_status,dotb_direction
     * @return |null
     */

   public function getProductLineItem(ServiceBase $api, array $args){
       $product_item_sql = "SELECT 
                            products.product_template_id, 
                            products.name,
                            products.code,
                            products.unit_id unit_id,
                            j_unit.name unit,
                            products.discount_price,
                            products.quantity,discount_amount,discount_select,total_amount,j_unit.id unit_id
                            FROM products 
                            INNER JOIN product_templates 
                            ON product_templates.id = products.product_template_relationship_id AND product_templates.deleted = 0
                            INNER JOIN j_unit ON j_unit.id = products.unit_id and j_unit.deleted =0
                            WHERE products.deleted = 0 AND products.product_template_relationship_id = '{$args['id']}'";
       $product_item = $GLOBALS['db']->fetchArray($product_item_sql);
       return $product_item;
   }

   public function deleteProductProductTemplate(ServiceBase $api, array $args){
       $product = BeanFactory::getBean('Products',$args['id']);
       $product->deleted = 1;
       $product->save();
   }

   public function getUnitPrice(ServiceBase $api, array $args){
       $product = $GLOBALS['db']->fetchOne("
        SELECT discount_price,l1.quantity_base_unit quantity_base_unit
        FROM product_templates 
        INNER JOIN j_unit l1 ON l1.id = product_templates.unit_id AND l1.deleted =0
        WHERE product_templates.deleted=0 AND product_templates.id='{$args['product_template_id']}'");
       $quantity = $GLOBALS['db']->getOne("SELECT quantity_base_unit FROM j_unit WHERE deleted=0 and id ='{$args['unit_id']}'");

       return $product['discount_price'] * ($quantity/$product['quantity_base_unit']);
   }
}