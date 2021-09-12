<?php
class logicProductTemplates
{

    function getProductDiscount(&$bean, $event, $arguments){
        $bean->product_discount =array_column($GLOBALS['db']->fetchArray("SELECT discount_id id FROM product_templates_discount Where product_templates_id = '{$bean->id}' and deleted=0"),'id');
    }
}
?>
<?php
