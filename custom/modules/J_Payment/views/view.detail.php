<?php
if(!defined('dotbEntry') || !dotbEntry) die('Not A Valid Entry Point');
class J_PaymentViewDetail extends ViewDetail{
    function _displaySubPanels(){
        require_once ('include/SubPanel/SubPanelTiles.php');
        $subpanel = new SubPanelTiles($this->bean, $this->module);

        if($this->bean->payment_type == 'Delay'){
            unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['payment_loyaltys']);
            unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['payment_paymentdetails']);
            unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['j_payment_j_discount_1']);
            unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['j_payment_j_sponsor']);
        }
        elseif($this->bean->payment_type == 'Moving In' || $this->bean->payment_type == 'Transfer In'){
            unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['payment_paymentdetails']);
            unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['j_payment_j_discount_1']);
            unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['j_payment_j_payment_1']);
            unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['j_payment_j_sponsor']);
            unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['payment_loyaltys']);
            unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['j_payment_studentsituations']);
        }
        elseif($this->bean->payment_type == 'Moving Out' || $this->bean->payment_type == 'Transfer Out' || $this->bean->payment_type == 'Refund'){
            unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['payment_paymentdetails']);
            unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['j_payment_j_discount_1']);
            unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['j_payment_j_sponsor']);
            unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['payment_loyaltys']);
            unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['j_payment_studentsituations']);

        }elseif($this->bean->payment_type == 'Deposit' || $this->bean->payment_type == 'Cashholder'){
            //    unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['j_payment_studentsituations']);

        }elseif($this->bean->payment_type == 'Book/Gift')
        {
            unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['j_payment_j_payment_2']);
            unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['j_payment_j_discount_1']);
            unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['j_payment_j_sponsor']);
            unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['j_payment_studentsituations']);
            unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['j_payment_j_payment_1']);
        }
        if($this->bean->payment_type != 'Enrollment' && $this->bean->payment_type != 'Cashholder'){
            unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['j_payment_j_payment_2']);

        }


        //unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['payment_loyaltys']);
        echo $subpanel->display();
    }
    public function display(){
        global $locale, $current_user, $timedate;
        require_once('custom/include/_helper/junior_schedule.php');
        $this->options ['show_subpanels'] = true;

        //Custom

        if($this->bean->parent_type == 'Leads'){
            $rs2 = $GLOBALS['db']->query("SELECT DISTINCT full_lead_name, id FROM leads WHERE id = '{$this->bean->lead_id}'");
            $lead = $GLOBALS['db']->fetchByAssoc($rs2);
            $this->bean->contacts_j_payment_1_name  = $lead['full_lead_name'];
            $this->bean->contacts_j_payment_1contacts_ida  = $lead['id'];
        }
        $this->ss->assign('student_link', '<a href="/../../#bwc/index.php?module='.$this->bean->parent_type.'&amp;action=DetailView&amp;record='.$this->bean->contacts_j_payment_1contacts_ida.'"><span id="contacts_j_payment_1contacts_ida" class="dotb_field" data-id-value="'.$this->bean->contacts_j_payment_1contacts_ida.'">'.$this->bean->contacts_j_payment_1_name.'</span></a>');
        $this->ss->assign('payment_id', '<span class="textbg_blue">'.$this->bean->name.'</span>');


        //Show paid amount, unpaid amount - Lap Nguyen
        $sqlPayDtl = "SELECT DISTINCT
        IFNULL(id, '') primaryId,
        IFNULL(payment_no, '') payment_no,
        IFNULL(status, '') status,
        IFNULL(payment_amount, '0') payment_amount
        FROM j_paymentdetail
        WHERE payment_id = '{$this->bean->id}'
        AND deleted = 0
        AND status <> 'Cancelled'
        ORDER BY payment_no";
        $resultPayDtl = $GLOBALS['db']->query($sqlPayDtl);

        $paidAmount     = 0;
        $unpaidAmount   = 0;
        $countVAT       = 0;
        while($rowPayDtl = $GLOBALS['db']->fetchByAssoc($resultPayDtl)){
            if($rowPayDtl['status'] == "Unpaid")
                $unpaidAmount += $rowPayDtl['payment_amount'];
            else
                $paidAmount   += $rowPayDtl['payment_amount'];


            if($rowPayDtl['status'] == 'Paid') $countVAT++;
        }
        $this->ss->assign('PAID_AMOUNT','<span class="textbg_green" id="pmd_paid_amount">'.format_number($paidAmount).'</span>');
        $this->ss->assign('UNPAID_AMOUNT','<span class="textbg_orange" id="pmd_unpaid_amount">'.format_number($unpaidAmount).'</span>');

        //        if($unpaidAmount == 0)
        if($paidAmount !== 0 || $unpaidAmount == 0 || $this->bean->paid_amount !== 0 ) // cho add hoc vien vao class khi da dong 1 phan hoc phi
            $this->ss->assign('is_paid', '1');
        else $this->ss->assign('is_paid', '0');

        $this->ss->assign('today',$timedate->nowDate());

        $this->ss->assign('card_type', $GLOBALS['app_list_strings']['card_type_payments_list']);
        $this->ss->assign('bank_type', $GLOBALS['app_list_strings']['bank_name_list']);
        $this->ss->assign('bank_receive_list', $GLOBALS['app_list_strings']['bank_receive_list']);
        $this->ss->assign('current_user_name',$current_user->name);


        //Show replace Student by Lead info When payment have lead_id
        if(!empty($this->bean->lead_id)){
            $this->dv->defs['panels']['LBL_BOOK_PLACEMENT_TEST'][1][0]['name'] = 'lead_name';
            $this->dv->defs['panels']['LBL_BOOK_PLACEMENT_TEST'][1][0]['customCode'] = '{$LEAD_NAME}';
            $leadBean = BeanFactory::getBean("Leads", $this->bean->lead_id);
            $leadFullname = $locale->getLocaleFormattedName($leadBean->first_name, $leadBean->last_name, $leadBean->salutaion);
            $leadLink = '<a href="#bwc/index.php?module=Leads&amp;action=DetailView&amp;record='.$leadBean->id.'">'.$leadFullname.'</a>';
            $this->ss->assign('LEAD_NAME',$leadLink);
        }

        //QUick Edit
        $arr_Q = array( '_sale_type', '_sale_type_date', '_assigned_user_id');

        if($current_user->isAdminForModule('J_Payment')){
            $sale_typeQ .= '<img id="loading_sale_type" src=\'custom/include/images/fb_loading.gif\' style=\'width:15px; height:15px; display:none;\'/>';
            $sale_typeQ .= '<div id="panel_1_sale_type"><label id="label_sale_type">'.$this->bean->sale_type.'</label>&nbsp&nbsp<a id="btnedit_sale_type" title="Edit" title="Admin Edit"><i style="font-size: 20px;cursor: pointer;" class="icon icon-edit"></i></a></div>';
            $sale_typeQ .= '<div id="panel_2_sale_type" style="display: none;"><select id="value_sale_type">'.get_select_options($GLOBALS['app_list_strings']['sale_type_list'],$this->bean->sale_type).'</select>';
            $sale_typeQ .=  '&nbsp&nbsp<a title="Save" id="btnsave_sale_type"><i style="font-size: 20px;cursor: pointer;" class="icon icon-download-alt"></i></a> <a title="Cancel" id="btncancel_sale_type"><i style="font-size: 20px;cursor: pointer;" class="icon icon-remove"></i></a></div>';
            $sale_type_dateQ = '
            <img id="loading_sale_type_date" src=\'custom/include/images/fb_loading.gif\' style=\'width:15px; height:15px; display:none;\'/>
            <div id="panel_1_sale_type_date"><label id="label_sale_type_date">'.$timedate->to_display_date($this->bean->sale_type_date,false).'</label>&nbsp&nbsp<a id="btnedit_sale_type_date" title="Edit" title="Admin Edit"><i style="font-size: 20px;cursor: pointer;" class="icon icon-edit"></i></a></div>
            <div id="panel_2_sale_type_date" style="display: none;"><input disabled="" name="value_sale_type_date" size="10" id="value_sale_type_date" type="text" value="'.$timedate->to_display_date($this->bean->sale_type_date,false).'">
            <img border="0" src="custom/themes/default/images/jscalendar.png" alt="Sale Type Date" id="sale_type_date_trigger" align="absmiddle">
            &nbsp&nbsp<a title="Save" id="btnsave_sale_type_date"><i style="font-size: 20px;cursor: pointer;" class="icon icon-download-alt"></i></a>
            <a title="Cancel" id="btncancel_sale_type_date"><i style="font-size: 20px;cursor: pointer;" class="icon icon-remove"></i></a>
            </div>';

        }else{
            $sale_typeQ         = '<label id="label_sale_type">'.$GLOBALS['app_list_strings']['sale_type_list'][$this->bean->sale_type].'</label>';
            $sale_type_dateQ    = '<label id="label_sale_type_date">'.$timedate->to_display_date($this->bean->sale_type_date,false).'</label>';

        }

        if((ACLController::checkAccess('J_Payment', 'import', true)) || ($current_user->isAdmin())){
            $payment_expiredQ = '
            <img id="loading_payment_expired" src=\'custom/include/images/fb_loading.gif\' style=\'width:15px; height:15px; display:none;\'/>
            <div id="panel_1_payment_expired"><label id="label_payment_expired">'.$timedate->to_display_date($this->bean->payment_expired,false).'</label>&nbsp&nbsp<a id="btnedit_payment_expired" title="Edit" title="Admin Edit"><i style="font-size: 20px;cursor: pointer;" class="icon icon-edit"></i></a></div>
            <div id="panel_2_payment_expired" style="display: none;"><input disabled="" name="value_payment_expired" size="10" id="value_payment_expired" type="text" value="'.$timedate->to_display_date($this->bean->payment_expired,false).'">
            <img border="0" src="custom/themes/default/images/jscalendar.png" alt="Payment Expired" id="payment_expired_trigger" align="absmiddle">
            &nbsp&nbsp<a title="Save" id="btnsave_payment_expired"><i style="font-size: 20px;cursor: pointer;" class="icon icon-download-alt"></i></a>
            <a title="Cancel" id="btncancel_payment_expired"><i style="font-size: 20px;cursor: pointer;" class="icon icon-remove"></i></a>
            </div>';
        }else{
            $payment_expiredQ    = '<label id="label_payment_expired">'.$timedate->to_display_date($this->bean->payment_expired,false).'</label>';
        }

        if((ACLController::checkAccess('J_Payment', 'import', true)) || ($current_user->isAdmin())){
            $role_user_id = '1';
            if(!$current_user->isAdmin())
                $role_user_id = $current_user->id;
            $q100 = "SELECT
            IFNULL(l3.id, '') user_id,
            CONCAT(IFNULL(l3.full_user_name, ''), ' - (', IFNULL(l4.name, ''), ')') name
            FROM teams
            INNER JOIN team_memberships l2 ON teams.id = l2.team_id AND l2.deleted = 0
            INNER JOIN users l3 ON l2.user_id = l3.id AND l3.deleted = 0
            INNER JOIN  teams l4 ON l3.default_team=l4.id AND l4.deleted=0
            WHERE teams.id IN (SELECT DISTINCT IFNULL(ll2.id, '') team_id
            FROM users INNER JOIN teams ll1 ON users.default_team = ll1.id AND ll1.deleted = 0
            INNER JOIN team_memberships ll2_1 ON users.id = ll2_1.user_id AND ll2_1.deleted = 0
            INNER JOIN teams ll2 ON ll2.id = ll2_1.team_id AND ll2.deleted = 0
            WHERE (((users.id = '$role_user_id') AND (ll2.private = 0) AND  ll2.id <> '1')) AND users.deleted = 0)
            ORDER BY l4.id, l3.full_user_name";
            $user_list = $GLOBALS['db']->fetchArray($q100);
            $user_arr = array($current_user->id => $current_user->name);
            foreach($user_list as $key => $user)
                $user_arr[$user['user_id']] = $user['name'];

            $assigned_user_idQ = '<img id="loading_assigned_user_id" src=\'custom/include/images/fb_loading.gif\' style=\'width:15px; height:15px; display:none;\'/>
            <div id="panel_1_assigned_user_id"><label id="label_assigned_user_id">'.$this->bean->assigned_user_name.'</label>&nbsp&nbsp<a id="btnedit_assigned_user_id" title="Edit" title="Admin Edit"><i style="font-size: 20px;cursor: pointer;" class="icon icon-edit"></i></a></div>
            <div id="panel_2_assigned_user_id" style="display: none;"><select id="value_assigned_user_id">'.get_select_options($user_arr, $this->bean->assigned_user_id).'</select>
            &nbsp&nbsp<a title="Save" id="btnsave_assigned_user_id"><i style="font-size: 20px;cursor: pointer;" class="icon icon-download-alt"></i></a> <a title="Cancel" id="btncancel_assigned_user_id"><i style="font-size: 20px;cursor: pointer;" class="icon icon-remove"></i></a></div>';

            $user_closed_sale_idQ = '<img id="loading_user_closed_sale_id" src=\'custom/include/images/fb_loading.gif\' style=\'width:15px; height:15px; display:none;\'/>
            <div id="panel_1_user_closed_sale_id"><label id="label_user_closed_sale_id">'.$this->bean->user_closed_sale.'</label>&nbsp&nbsp<a id="btnedit_user_closed_sale_id" title="Edit" title="Admin Edit"><i style="font-size: 20px;cursor: pointer;" class="icon icon-edit"></i></a></div>
            <div id="panel_2_user_closed_sale_id" style="display: none;"><select id="value_user_closed_sale_id">'.get_select_options($user_arr, $this->bean->user_closed_sale_id).'</select>
            &nbsp&nbsp<a title="Save" id="btnsave_user_closed_sale_id"><i style="font-size: 20px;cursor: pointer;" class="icon icon-download-alt"></i></a> <a title="Cancel" id="btncancel_user_closed_sale_id"><i style="font-size: 20px;cursor: pointer;" class="icon icon-remove"></i></a></div>';

            $user_pt_demo_idQ = '<img id="loading_user_pt_demo_id" src=\'custom/include/images/fb_loading.gif\' style=\'width:15px; height:15px; display:none;\'/>
            <div id="panel_1_user_pt_demo_id"><label id="label_user_pt_demo_id">'.$this->bean->user_pt_demo.'</label>&nbsp&nbsp<a id="btnedit_user_pt_demo_id" title="Edit" title="Admin Edit"><i style="font-size: 20px;cursor: pointer;" class="icon icon-edit"></i></a></div>
            <div id="panel_2_user_pt_demo_id" style="display: none;"><select id="value_user_pt_demo_id">'.get_select_options($user_arr, $this->bean->user_pt_demo_id).'</select>
            &nbsp&nbsp<a title="Save" id="btnsave_user_pt_demo_id"><i style="font-size: 20px;cursor: pointer;" class="icon icon-download-alt"></i></a> <a title="Cancel" id="btncancel_user_pt_demo_id"><i style="font-size: 20px;cursor: pointer;" class="icon icon-remove"></i></a></div>';

        }else{
            $assigned_user_idQ    = '<label id="label_assigned_user_id">'.$this->bean->assigned_user_name.'</label>';
            $user_closed_sale_idQ = '<label id="label_user_closed_sale_id">'.$this->bean->user_closed_sale.'</label>';
            $user_pt_demo_idQ     = '<label id="label_user_pt_demo_id">'.$this->bean->user_pt_demo.'</label>';
        }

        $this->ss->assign('sale_typeQ',$sale_typeQ);
        $this->ss->assign('sale_type_dateQ',$sale_type_dateQ);
        $this->ss->assign('assigned_user_idQ',$assigned_user_idQ);
        $this->ss->assign('user_closed_sale_idQ',$user_closed_sale_idQ);
        $this->ss->assign('user_pt_demo_idQ',$user_pt_demo_idQ);
        $this->ss->assign('payment_expiredQ',$payment_expiredQ);


        if($this->bean->payment_type == 'Enrollment' || $this->bean->payment_type == 'Cashholder'){
            if($this->bean->load_relationship('j_coursefee_j_payment_2')){
                $j_coursefee = '';
                $arrCf = $this->bean->j_coursefee_j_payment_2->getBeans();
                foreach($arrCf as $keyCf => $valueCf)
                    $j_coursefee .='<li style="margin-left:10px;"><a href=index.php?module=J_Coursefee&&record='.$keyCf.'>'.$valueCf->name.'</a></li>';

                $this->ss->assign('j_coursefee',$j_coursefee);
            }
        }




        // Dirty trick to clear cache, a must for EditView:
        if(file_exists('cache/modules/' . $this->bean->module_dir . '/DetailView.tpl'))
            unlink('cache/modules/' . $this->bean->module_dir . '/DetailView.tpl');

        if($this->bean->payment_type == 'Enrollment'){
            unset($this->dv->defs['panels']['LBL_PLACE_HOLDER']);
            unset($this->dv->defs['panels']['LBL_DEPOSIT']);
            unset($this->dv->defs['panels']['LBL_BOOK_PLACEMENT_TEST']);
            unset($this->dv->defs['panels']['LBL_TRANSFER']);
            unset($this->dv->defs['panels']['LBL_MOVING']);
            unset($this->dv->defs['panels']['LBL_REFUND']);
            unset($this->dv->defs['panels']['LBL_DELAY']);
            if($this->bean->paid_hours <= 0 )
                unset($this->dv->defs['panels']['LBL_ENROLLMENT'][7]);
            if($this->bean->deposit_amount <= 0 )
                unset($this->dv->defs['panels']['LBL_ENROLLMENT'][12]);


            $sql_get_class="SELECT
            DISTINCT IFNULL(l2.id,'') l2_id ,
            IFNULL(l2.name,'') l2_name ,
            IFNULL(j_payment.id,'') primaryid,
            MIN(l1.start_study) start_study,
            MAX(l1.end_study) end_study,
            IFNULL(l2.class_type,'') class_type
            FROM j_payment INNER JOIN j_studentsituations l1 ON j_payment.id=l1.payment_id
            AND l1.deleted=0 INNER JOIN j_class l2 ON l1.ju_class_id=l2.id
            AND l2.deleted=0 WHERE j_payment.id='{$this->bean->id}'
            AND j_payment.deleted=0
            GROUP BY l2.id";
            $result_get_class = $GLOBALS['db']->query($sql_get_class);
            $html_class='';
            $first_set = true;
            $start_study = '';
            $end_study = '';
            while($row = $GLOBALS['db']->fetchByAssoc($result_get_class)){
                $html_class.='<li style="margin-left:10px;"><a href=index.php?module=J_Class&offset=1&stamp=1441785563066827100&return_module=J_Class&action=DetailView&record='.$row['l2_id'].'>'.$row['l2_name'].'</a> ('.$row['class_type'].')</li>';
                if($first_set){
                    $start_study  = $row['start_study'];
                    $end_study    = $row['end_study'];
                    $first_set    = false;
                }else{
                    if($start_study > $row['start_study'])
                        $start_study = $row['start_study'];

                    if($end_study < $row['end_study'])
                        $end_study = $row['end_study'];
                }
            }
            if(!empty($start_study))
                $this->bean->start_study = $timedate->to_display_date($start_study,false);

            if(!empty($end_study))
                $this->bean->end_study = $timedate->to_display_date($end_study,false);

            $this->ss->assign('html_class',$html_class);
        }
        elseif($this->bean->payment_type == 'Cashholder' || $this->bean->payment_type == 'Corporate'){
            unset($this->dv->defs['panels']['LBL_ENROLLMENT']);
            unset($this->dv->defs['panels']['LBL_DEPOSIT']);
            unset($this->dv->defs['panels']['LBL_BOOK_PLACEMENT_TEST']);
            unset($this->dv->defs['panels']['LBL_MOVING']);
            unset($this->dv->defs['panels']['LBL_TRANSFER']);
            unset($this->dv->defs['panels']['LBL_REFUND']);
            unset($this->dv->defs['panels']['LBL_DELAY']);
            if($this->bean->deposit_amount <= 0 )
                unset($this->dv->defs['panels']['LBL_PLACE_HOLDER'][7]);
        }
        elseif($this->bean->payment_type == 'Book/Gift'){
            unset($this->dv->defs['panels']['LBL_ENROLLMENT']);
            unset($this->dv->defs['panels']['LBL_DEPOSIT']);
            unset($this->dv->defs['panels']['LBL_PLACE_HOLDER']);
            unset($this->dv->defs['panels']['LBL_MOVING']);
            unset($this->dv->defs['panels']['LBL_TRANSFER']);
            unset($this->dv->defs['panels']['LBL_REFUND']);
            unset($this->dv->defs['panels']['LBL_DELAY']);

            $book_list = getHtmlAddRow($this->bean->id);
            $this->ss->assign("bookList", $book_list['html']);
            $this->ss->assign("total_book_amount", format_number($book_list['total_amount']));
            $this->ss->assign("total_book_quantity", format_number($book_list['total_quantity']));
        }
        elseif($this->bean->payment_type == 'Placement Test' || $this->bean->payment_type == 'Other' ||  $this->bean->payment_type == 'Delay Fee' || $this->bean->payment_type == 'Transfer Fee' || $this->bean->payment_type == 'Tutor Package' || $this->bean->payment_type == 'Travelling Fee' || $this->bean->payment_type == 'Deposit'){
            unset($this->dv->defs['panels']['LBL_ENROLLMENT']);
            unset($this->dv->defs['panels']['LBL_BOOK_PLACEMENT_TEST']);
            unset($this->dv->defs['panels']['LBL_PLACE_HOLDER']);
            unset($this->dv->defs['panels']['LBL_MOVING']);
            unset($this->dv->defs['panels']['LBL_TRANSFER']);
            unset($this->dv->defs['panels']['LBL_REFUND']);
            unset($this->dv->defs['panels']['LBL_DELAY']);
        }
        elseif($this->bean->payment_type == 'Moving In' || $this->bean->payment_type == 'Moving Out'){
            unset($this->dv->defs['panels']['LBL_ENROLLMENT']);
            unset($this->dv->defs['panels']['LBL_BOOK_PLACEMENT_TEST']);
            unset($this->dv->defs['panels']['LBL_PLACE_HOLDER']);
            unset($this->dv->defs['panels']['LBL_DEPOSIT']);
            unset($this->dv->defs['panels']['LBL_TRANSFER']);
            unset($this->dv->defs['panels']['LBL_REFUND']);
            unset($this->dv->defs['panels']['LBL_DELAY']);
            unset($this->dv->defs['templateMeta']['form']['buttons'][0]);

            if ($this->bean->payment_type == 'Moving In') {
                $this->ss->assign("PAYMENT_RELA_LABEL", "Moving Out Payment");
                $this->ss->assign("PAYMENT_RELA", '<a href="#bwc/index.php?module=J_Payment&action=DetailView&record='.$this->bean->payment_out_id.'">'.$this->bean->payment_out_name."</a>");
            }
            else{
                $this->ss->assign("PAYMENT_RELA_LABEL", "Moving In Payment");
                $this->bean->load_relationship("ju_payment_in");
                $moving_in_payment = reset($this->bean->ju_payment_in->getBeans());
                $this->ss->assign("PAYMENT_RELA", '<a href="#bwc/index.php?module=J_Payment&action=DetailView&record='.$moving_in_payment->id.'">'.$moving_in_payment->name."</a>");
            }
        }
        elseif($this->bean->payment_type == 'Transfer Out' || $this->bean->payment_type == 'Transfer In'){
            unset($this->dv->defs['panels']['LBL_ENROLLMENT']);
            unset($this->dv->defs['panels']['LBL_BOOK_PLACEMENT_TEST']);
            unset($this->dv->defs['panels']['LBL_PLACE_HOLDER']);
            unset($this->dv->defs['panels']['LBL_DEPOSIT']);
            unset($this->dv->defs['panels']['LBL_MOVING']);
            unset($this->dv->defs['panels']['LBL_REFUND']);
            unset($this->dv->defs['panels']['LBL_DELAY']);
            unset($this->dv->defs['templateMeta']['form']['buttons'][0]);

            if ($this->bean->payment_type == 'Transfer In') {
                $this->ss->assign("PAYMENT_RELA_LABEL", "Transfer Out Payment");
                $this->ss->assign("STUDENT_RELA_LABEL", "Transfer From Student");
                $this->ss->assign("PAYMENT_RELA", '<a href="#bwc/index.php?module=J_Payment&action=DetailView&record='.$this->bean->payment_out_id.'">'.$this->bean->payment_out_name."</a>");
                $transfer_out_payment = BeanFactory::getBean("J_Payment", $this->bean->payment_out_id);
                $transfer_from_student = BeanFactory::getBean("Contacts", $transfer_out_payment->contacts_j_payment_1contacts_ida);
                $this->ss->assign("STUDENT_RELA", '<a href="#bwc/index.php?module=Contacts&action=DetailView&record='.$transfer_from_student->id.'">'.$transfer_from_student->name."</a>");


            }
            else{
                $this->ss->assign("PAYMENT_RELA_LABEL", "Transfer In Payment:");
                $this->ss->assign("STUDENT_RELA_LABEL", "Transfer To Student:");
                $this->bean->load_relationship("ju_payment_in");
                $transfer_in_payment = reset($this->bean->ju_payment_in->getBeans());
                $this->ss->assign("PAYMENT_RELA", '<a href="#bwc/index.php?module=J_Payment&action=DetailView&record='.$transfer_in_payment->id.'">'.$transfer_in_payment->name."</a>");
                $transfer_to_student = BeanFactory::getBean("Contacts", $transfer_in_payment->contacts_j_payment_1contacts_ida);
                $this->ss->assign("STUDENT_RELA", '<a href="#bwc/index.php?module=Contacts&action=DetailView&record='.$transfer_to_student->id.'">'.$transfer_to_student->name."</a>");
            }
        }
        elseif($this->bean->payment_type == 'Refund'){
            unset($this->dv->defs['panels']['LBL_ENROLLMENT']);
            unset($this->dv->defs['panels']['LBL_BOOK_PLACEMENT_TEST']);
            unset($this->dv->defs['panels']['LBL_PLACE_HOLDER']);
            unset($this->dv->defs['panels']['LBL_DEPOSIT']);
            unset($this->dv->defs['panels']['LBL_MOVING']);
            unset($this->dv->defs['panels']['LBL_TRANSFER']);
            unset($this->dv->defs['panels']['LBL_MOVING']);
            unset($this->dv->defs['panels']['LBL_DELAY']);
            unset($this->dv->defs['templateMeta']['form']['buttons'][0]);

        }
        elseif($this->bean->payment_type == 'Delay' || $this->bean->payment_type == 'Schedule Change'  ){
            unset($this->dv->defs['panels']['LBL_ENROLLMENT']);
            unset($this->dv->defs['panels']['LBL_BOOK_PLACEMENT_TEST']);
            unset($this->dv->defs['panels']['LBL_PLACE_HOLDER']);
            unset($this->dv->defs['panels']['LBL_DEPOSIT']);
            unset($this->dv->defs['panels']['LBL_MOVING']);
            unset($this->dv->defs['panels']['LBL_TRANSFER']);
            unset($this->dv->defs['panels']['LBL_REFUND']);
            unset($this->dv->defs['panels']['LBL_MOVING']);
            unset($this->dv->defs['templateMeta']['form']['buttons'][0]);
        }

        //Xử lý button Delete Phân quyền xóa Unpaid
        $arr_Undel = array('Delay', 'Schedule Change', 'Transfer In', 'Transfer Out', 'Moving In', 'Moving Out', 'Refund');
        $countUsed = $GLOBALS['db']->getOne("SELECT count(id) count FROM j_payment_j_payment_1_c WHERE j_payment_j_payment_1j_payment_idb = '{$this->bean->id}' AND deleted = 0");
        if( $current_user->isAdmin() || ((!in_array($this->bean->payment_type, $arr_Undel)) && ($countUsed == 0) && (ACLController::checkAccess('J_Payment', 'delete', true))) )
            $custom_delete = '<input title="Delete" accesskey="d" class="button" onclick="var _form = document.getElementById(\'formDetailView\'); _form.return_module.value=\'J_Payment\'; _form.return_action.value=\'ListView\'; _form.action.value=\'Delete\'; if(confirm(\'Are you sure you want to delete this payment?\')) DOTB.ajaxUI.submitForm(_form);" type="submit" name="Delete" value="Delete" id="delete_button">';
        else
            $custom_delete = '';

        $this->ss->assign('CUSTOM_DELETE',$custom_delete);
        //Create button duplicate
        if($this->bean->payment_type == 'Enrollment' || $this->bean->payment_type == 'Cashholder'||$this->bean->payment_type == 'Deposit'||$this->bean->payment_type == 'Book/Gift') {
            $btn_copy = '<input title="Copy" class="button" onclick="var _form = document.getElementById(\'formDetailView\'); _form.return_module.value=\'J_Payment\'; _form.return_action.value=\'DetailView\'; _form.isDuplicate.value=true; _form.action.value=\'EditView\'; _form.return_id.value=\'' . $this->bean->id . '\';DOTB.ajaxUI.submitForm(_form);" " type="button" name="Copy" value="Copy" id="copy_button">';
            $this->ss->assign("BUTTON_COPY", $btn_copy);
        }

        //Create list Button
        $btn_customize = '';
        if($this->bean->status != 'Closed' && ($current_user->isAdmin() || (!empty($this->bean->old_student_id)))){
            switch ($this->bean->payment_type) {
                case "Enrollment":
                    $bt_admin_li .= '<li><a id="btn_delay_payment" href="#" >'.$GLOBALS['mod_strings']['LBL_DROP_PAYMENT'].'</a></li>';
                    break;
                case "Cashholder":
                case "Placement Test":
                case "Delay Fee":
                case "Tutor Package":
                case "Travelling Fee":
                case "Deposit":
                case "Moving In":
                case "Transfer In":
                case "Delay":
                case "Schedule Change":
                    if($this->bean->remain_amount > 0){//Hiện tại chỉ có Status = Closed là Dropped Revenue
                        if(empty($this->bean->old_student_id) || $current_user->isAdmin())
                            $bt_admin_li .= '<li><a id="btn_delay_payment" href="#" >'.$GLOBALS['mod_strings']['LBL_DROP_PAYMENT'].'</a></li>';

                        $bt_admin_li .= '<li><a id="convert_payment" href="#" >'.$GLOBALS['mod_strings']['LBL_CONVERT_PAYMENT'].'</a></li>';
                    }
                    $btn_customize .= '<button style="margin-left: 5px;" type="button" class="button" id="btn_create_enrollment" onClick="parent.DOTB.App.router.redirect(\'#bwc/index.php?module=J_Payment&action=EditView&return_module=J_Payment&return_action=DetailView&payment_type=Cashholder&student_id='.$this->bean->contacts_j_payment_1contacts_ida.'\',\'_blank\');">'.translate('LBL_CREATE_PAYMENT').'</button>';
                    break;
                case "Moving Out":
                case "Transfer Out":
                case "Refund":
                    $bt_admin_li .= '<li><a id="btn_undo" href="#" >'.$GLOBALS['mod_strings']['LBL_UNDO'].'</a></li>';
                    break;
                default:

            }
            if(!empty($bt_admin_li))
                $bt_admin_ul='<ul class="clickMenu fancymenu" style="margin-left: 5px !important;"><li class="dotb_action_button"><a>Admin Action</a><ul class="subnav" style="display: none;">'.$bt_admin_li.'</ul><span class="ab subhover"></span></li></ul> ';
            // Delete btn created
            $btn_customize = $btn_customize.$bt_admin_ul;
        }

        if($this->bean->parent_type == 'Leads') $btn_customize = '';
        $this->ss->assign('CUSTOM_BUTTON',$btn_customize);

        //Show button export form
        $exportPaymentTypes = array("Delay","Moving Out","Moving In","Transfer Out","Transfer In");
        $btnExportForm = "";
        if(in_array($this->bean->payment_type,$exportPaymentTypes)){
            $btnExportForm .= '<input class="button" type="button" value="'.$GLOBALS['mod_strings']['BTN_EXPORT_FORM'].'" id="btn_export_form" onclick="location.href=\'index.php?module=J_Payment&action=exportform&record='. $this->bean->id .'\'"> ';
        }elseif($this->bean->payment_type == 'Refund'){
            $btnExportForm .= '<input class="button" type="button" value="'.$GLOBALS['mod_strings']['BTN_EXPORT_FORM'].'" id="btn_export_form" onclick="location.href=\'index.php?module=J_Payment&action=centerExpenses&record='. $this->bean->id .'&module_type='.$this->bean->module_name.'\'"> ';
        }
        $this->ss->assign('EXPORT_FROM_BUTTON',$btnExportForm);

        //Show link doanh thu Drop
        $revenue_link = '';
        $de_res     = $GLOBALS['db']->query("SELECT id, date_input, amount FROM c_deliveryrevenue WHERE ju_payment_id='{$this->bean->id}' AND deleted = 0 AND passed = 0");
        $amount_rev = 0;
        while($row_des = $GLOBALS['db']->fetchByAssoc($de_res)){
            $amount_rev += $row_des['amount'];
            $delivery_id= $row_des['id'];
            $date_rev   = $row_des['date_input'];
        }
        if(!empty($delivery_id)){
            if(ACLController::checkAccess('J_Payment', 'import', true))
                $revenue_link =  ' <a  href="#bwc/index.php?action=DetailView&module=C_DeliveryRevenue&record='.$delivery_id.'"> >>Drop revenue tháng '.date('m-Y',strtotime($date_rev)).' - '.format_number($amount_rev).'<<</a>';
            else
                $revenue_link = " Drop doanh thu tháng ".date('m-Y',strtotime($date_rev)).' - '.format_number($amount_rev);
        }

        $this->ss->assign("revenue_link",$revenue_link );

        //Convert Payment Type
        if($this->bean->use_type == 'Amount')
            $convertType = 'To Hour';
        elseif($this->bean->use_type == 'Hour')
            $convertType = 'To Amount';

        $this->ss->assign('convertType', $convertType );
        $this->ss->assign('convertTypeList', $GLOBALS['app_list_strings']['convert_type_list']);

        parent::display();
    }
}
function getHtmlAddRow($payment_id){
    $q1 = "SELECT DISTINCT
    IFNULL(l3.id, '') book_id,
    IFNULL(l3.name, '') book_name,
    IFNULL(j_inventorydetail.id, '') primaryid,
    ABS(j_inventorydetail.quantity) quantity,
    l3.unit unit,
    j_inventorydetail.price price,
    j_inventorydetail.amount amount,
    IFNULL(l1.id, '') l1_id,
    l1.total_amount total_amount,
    ABS(l1.total_quantity) total_quantity
    FROM
    j_inventorydetail
    INNER JOIN
    j_inventory l1 ON j_inventorydetail.inventory_id = l1.id
    AND l1.deleted = 0
    INNER JOIN
    j_payment_j_inventory_1_c l2_1 ON l1.id = l2_1.j_payment_j_inventory_1j_inventory_idb
    AND l2_1.deleted = 0
    INNER JOIN
    j_payment l2 ON l2.id = l2_1.j_payment_j_inventory_1j_payment_ida
    AND l2.deleted = 0
    INNER JOIN
    product_templates l3 ON j_inventorydetail.book_id = l3.id
    AND l3.deleted = 0
    WHERE
    (((l2.id = '$payment_id')))
    AND j_inventorydetail.deleted = 0";
    $rs1 = $GLOBALS['db']->query($q1);
    $tpl_addrow = '';
    while($row = $GLOBALS['db']->fetchByAssoc($rs1)){
        $tpl_addrow .= "<tr class='row_tpl'>";
        $tpl_addrow .= '<td style="text-align: center;">'.$row['book_name'].'</td>';
        $tpl_addrow .= '<td style="text-align: center;">'.$GLOBALS['app_list_strings']['unit_ProductTemplates_list'][$row['unit']].'</td>';
        $tpl_addrow .= '<td style="text-align: center;">'.$row['quantity'].'</td>';
        $tpl_addrow .= '<td nowrap style="text-align: center;">'.format_number($row['price']).'</td>';
        $tpl_addrow .= '<td nowrap style="text-align: center;">'.format_number($row['amount']).'</td>';
        $tpl_addrow .= '</tr>';
        $totalAmount = $row['total_amount'];
        $total_quantity = $row['total_quantity'];
    }

    return array(
        'html' => $tpl_addrow,
        'total_amount' => $totalAmount,
        'total_quantity' => $total_quantity,
    );;
}