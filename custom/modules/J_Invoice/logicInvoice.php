<?php
    class logicInvoice{
        function deletedInvoice($bean, $event, $arguments){
            $GLOBALS['db']->query("UPDATE j_paymentdetail SET invoice_id='' WHERE invoice_id = '{$bean->id}' AND deleted = 0");
        }
        function displayButton($bean, $event, $arguments) {
            if ($_REQUEST['module']=='J_Payment'){
                $bean->custom_button = '<div style="display: inline-flex;" id="inv_'.$bean->name.'">';

                //Button get invoice no
                if(!empty($bean->name) && $bean->status == 'Paid'){
                    $bean->custom_button .= '<button style="width: 100px;height: 46px;margin-left: 5px;" type="button" invoice_id="'.$bean->id.'" onclick="ex_invoice_2(this);"><img src="index.php?entryPoint=getImage&amp;themeName=DotB-Green&amp;imageName=CreateContracts.gif" align="absmiddle" border="0"> '.translate('LBL_EXPORT','J_Payment').'</button>';
                    $bean->custom_button .= '<button style="width: 70px;height: 46px;margin-left: 5px;" id="btn_edit_invoice" invoice_id="'.$bean->id.'"><img src="index.php?entryPoint=getImage&themeName=DotB-Green&imageName=edit_inline.png" align="absmiddle" border="0">  '.translate('LBL_EDIT','J_Payment').'</button>';
                    $bean->custom_button .= '<button style="width: 100px;height: 46px;margin-left: 5px;" invoice_id="'.$bean->id.'" id="btn_cancel_invoice" onclick = \'ajaxCancelInvoice("'.$bean->id.'")\'><img src="index.php?entryPoint=getImage&themeName=DotB-Green&imageName=delete_inline.png" align="absmiddle" border="0">  '.translate('LBL_VOID','J_Payment').'</button>';
                }
            }
            $bean->custom_button .= '</div>';

        }
    }
?>
