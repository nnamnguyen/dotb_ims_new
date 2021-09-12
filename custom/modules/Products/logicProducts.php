<?php
class logicProducts
{
    function createBalances(&$bean, $event, $arguments)
    {
        if(!empty($bean->quote_id)){
            require_once ('custom/modules/J_Payment/balance_function_untils.php');
            $quote_bean = BeanFactory::getBean('Quotes',$bean->quote_id);
            if($quote_bean->parent_type != "Leads"){
                if(!$arguments['isUpdate'])
                    createBalances('create','Cashholder',$bean,$bean->id,$quote_bean);
                else
                    createBalances('update','Cashholder',$bean,$bean->id,$quote_bean);
                amountAllocation($bean->quote_id);
            }

        }
    }

    function deleteBalances (&$bean, $event, $arguments){
        global  $timedate;
        if(!empty($bean->quote_id)){
            $quote_bean = BeanFactory::getBean('Quotes',$bean->quote_id);
            if($quote_bean->parent_type != "Leads"){
                require_once ('custom/modules/J_Payment/balance_function_untils.php');
                createBalances('delete','Cashholder',$bean,$bean->id,$quote_bean);
            }

            $GLOBALS['db']->query("UPDATE j_discount_products_1_c SET deleted=1,date_modified='{$timedate->nowDb()}',modified_user_id='{$GLOBALS['current_user']->id}' WHERE j_discount_products_1products_idb = '{$bean->id}'");
        }
    }

    function addDiscount(&$bean, $event, $arguments){
        global $timedate;
        if($arguments['isUpdate']){
            $GLOBALS['db']->query("UPDATE j_discount_products_1_c SET deleted=1 , date_modified ='{$timedate->nowDb()}' Where j_discount_products_1products_idb ='{$bean->id}'");
        }
        foreach($bean->discount_detail as $discount){
            $bean->load_relationship('j_discount_products_1');
            $bean->j_discount_products_1->add($discount->id==null?$discount['id']:$discount->id);
        }
        $bean->discount_detail = json_encode($bean->discount_detail);

    }

    function afterRetrieve(&$bean, $event, $arguments){
        $bean->discount_detail = json_decode($bean->discount_detail);
    }

    function getProductDiscount(&$bean, $event, $arguments){
        $bean->product_discount =array_column($GLOBALS['db']->fetchArray("SELECT discount_id id FROM product_templates_discount Where product_templates_id = '{$bean->product_template_id}' and deleted=0"),'id');
    }
}
?>
