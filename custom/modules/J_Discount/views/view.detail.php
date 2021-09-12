<?php
if(!defined('dotbEntry') || !dotbEntry) die('Not A Valid Entry Point');



class J_DiscountViewDetail extends ViewDetail {


    function display() {
        // get Partnership
        $part = '';
        if($this->bean->type == 'Partnership'){
            $this->bean->load_relationship('j_discount_j_partnership_1');
            $partnership= $this->bean->j_discount_j_partnership_1->getBeans();
            $part .= '<ul style="margin-left: 0;">';
            $count_ = 1;
            foreach ($partnership as $partner){
                $part .= '<li>';
                if($partner->team_id != $partner->team_set_id)
                    $_aa = "<a href='#' style='text-decoration:none;' onmouseover=\"javascript:toggleMore('div_".$partner->id."_teams','img_".$partner->id."_teams', 'Teams', 'DisplayInlineTeams', 'team_set_id={$partner->team_set_id}&team_id={$partner->team_id}');\">+</a>";
                $part .= $count_.'. <a href=index.php?module=J_Partnership&offset=1&stamp=1442306303029459400&return_module=J_Partnership&action=DetailView&record='.$partner->id.' TARGET=_blank>'.$partner->name.'</a> <span id="div_'.$partner->id.'_teams">('.$partner->status.' - '.$partner->team_name.''.$_aa.')</span>';
                $part .= '</li>';
                $count_++;
            }
            $part .= '</ul>';
        }
        // get "do not apply with"
        $disableList = json_decode(html_entity_decode($this->bean->disable_list),true);
        $schemaHtml .= '<ul style="margin-left: 0;">';
        foreach ($disableList as $value){
            $disable_discount = BeanFactory::getBean("J_Discount", $value);
            if (!empty($disable_discount->id)){
                $schemaHtml .= '<li>';
                $schemaHtml .= $disable_discount->type.': <a href="#bwc/index.php?module=J_Discount&action=DetailView&record='.$disable_discount->id.'" target=_blank>'.$disable_discount->name.'</a> ('.$disable_discount->team_name.')';
                $schemaHtml .= '</li>';
            }
        }
        $schemaHtml .= '</ul>';
        //Get Hour Discount
        if($this->bean->type == 'Hour'){
            $html = '<table id="discount_by_hour" style="width: 40%;float:left;" border="1" class="list view">
            <thead>
            <tr>
            <th width="50%" style="text-align: center;">Tuition Hours</th>
            <th width="50%" style="text-align: center;">Promotion Hours</th>
            </tr>
            </thead>
            <tbody id="tbodydiscount_by_hour">
            ';
            $content = json_decode(htmlspecialchars_decode($this->bean->content), true);
            foreach($content['discount_by_hour'] as $key => $value)
                $html .= "<tr><td style='text-align: center;'>{$value['hours']}</td><td style='text-align: center;'>{$value['promotion_hours']}</td></tr>";
            //add Discount by Block
            $html .= '</tbody></table>';
        }

        $this->ss->assign('SCHEMA', $schemaHtml);
        $this->ss->assign('CONTENT_2', $html);
        $this->ss->assign('PARTNERSHIP', $part);
        parent::display();
    }
}
?>