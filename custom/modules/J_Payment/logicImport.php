<?php
class logicImport{
    //Import Payment
    function importPayment(&$bean, $event, $arguments){
        /*global $timedate;
        if($_POST['module'] == 'Import'){
            //Get Student ID
            $parent_type = 'Contacts';
            $phone_number = substr(trim($bean->phone_mobile), -6);
            //get user ID
            $userId = $GLOBALS['db']->getOne("SELECT id FROM users WHERE user_name = '{$bean->assigned_user_name}' AND deleted = 0");
            if(!empty($userId))
                $bean->assigned_user_id = $userId;
            $q1 = "SELECT id, first_name, last_name, assigned_user_id FROM contacts WHERE deleted = 0 AND ((contact_id LIKE '%{$bean->old_student_id}%') OR (contact_id = '{$bean->old_student_id}'))";
            $rs = $GLOBALS['db']->query($q1);
            $student = $GLOBALS['db']->fetchByAssoc($rs);

            $parent_type = 'Contacts';
            //Create Payment
            $bean->team_set_id          = $bean->team_id;
            $bean->status               = 'Success';
            $bean->use_type             = 'Amount';
            $bean->payment_type         = 'Cashholder';
            $bean->assigned_user_id     = $student['assigned_user_id'];
            $bean->payment_expired = date('Y-m-d', strtotime("+12 months " . $bean->payment_date));
            $bean->amount_bef_discount  = $bean->payment_amount;
            $bean->tuition_fee  = $bean->payment_amount;
            $bean->total_after_discount  = $bean->payment_amount;
            //$bean->payment_amount       = $bean->unpaid_amount_import + $bean->paid_amount_import;
            $bean->number_of_payment    = '1';
            $bean->tuition_hours        = 0;
            $bean->date_entered        = $bean->payment_date;
            $bean->date_modified        = $bean->payment_date;
            $bean->remain_amount    = $bean->old_remain_amount;

            $bean->sale_type            = 'New Sale';
            $bean->sale_type_date       = $bean->payment_date;
            //add relationship
            if($bean->load_relationship('contacts_j_payment_1'))
                $bean->contacts_j_payment_1->add($student['id']);
            //Create Receipt
            $pmd = BeanFactory::newBean('J_PaymentDetail');
            $pmd->payment_no        = 1;
            $pmd->name              = $bean->name."-1";
            $pmd->is_discount       = 1;
            $pmd->student_id       = $student['id'];
            $pmd->before_discount   = $bean->payment_amount;

            $pmd->discount_amount   = 0;
            $pmd->sponsor_amount    = 0;
            $pmd->status            = "Paid";
            $pmd->payment_date      = $bean->payment_date;
            $pmd->expired_date      = $bean->payment_date;
            $pmd->serial_no         = '';
            $pmd->payment_method    = 'Other';
            $pmd->payment_amount    = $bean->payment_amount;

            $pmd->payment_id            = $bean->id;
            $pmd->description            = $bean->description;
            $pmd->assigned_user_id      = $bean->assigned_user_id;
            $pmd->modified_user_id      = $bean->assigned_user_id;
            $pmd->created_by            = $bean->assigned_user_id;
            $pmd->date_entered          = $bean->payment_date;
            $pmd->date_modified         = $bean->payment_date;
            $pmd->team_id               = $bean->team_id;
            $pmd->team_set_id           = $bean->team_id;
            $pmd->save();
        }*/
    }
}

?>
