<?php
if(!defined('dotbEntry') || !dotbEntry) die('Not A Valid Entry Point');

class J_DiscountViewEdit extends ViewEdit
{
    var $useModuleQuickCreateTemplate = true;
    var $useForSubpanel = true;

    public function display(){
        $arrayNotApplyWith = array();
        if(!isset($this->bean->id) || empty($this->bean->id)){
            // add partnership
            $pa = getHtmlAddRowPa('','',true);
            $pa .= getHtmlAddRowPa('','',false);
            //add Discount by Hour
            $dih = getHtmlAddRowHour('','',true);
            $dih .= getHtmlAddRowHour('','',false);
        }else{
            //add partnership
            $pa = getHtmlAddRowPa('','',true);
            if($this->bean->type == 'Partnership'){
                $this->bean->load_relationship('j_discount_j_partnership_1');
                $partnership= $this->bean->j_discount_j_partnership_1->getBeans();
                foreach ($partnership as $part)
                    $pa  .= getHtmlAddRowPa($part->id,$part->name,false);
            }else{
                // add partnership
                $pa = getHtmlAddRowPa('','',true);
                $pa .= getHtmlAddRowPa('','',false);
            }
            //add Discount by Hour
            if($this->bean->type == 'Hour'){
                $content = json_decode(htmlspecialchars_decode($this->bean->content), true);
                $dih = getHtmlAddRowHour('','',true);
                foreach($content['discount_by_hour'] as $key => $value)
                    $dih .= getHtmlAddRowHour($value['hours'],$value['promotion_hours'],false);

            }else{
                //add Discount by Hour
                $dih = getHtmlAddRowHour('','',true);
                $dih .= getHtmlAddRowHour('','',false);
            }

            $arrayNotApplyWith = json_decode(html_entity_decode($this->bean->disable_list),true);
        }
        // Do not apply with options - by Lap Nguyen
        $sql  = "SELECT
        l1.id, l1.name, l1.type, l2.name team_name
        FROM
        j_discount l1
        INNER JOIN
        teams l2 ON l1.team_id = l2.id AND l2.deleted = 0
        WHERE
        l1.id <> '{$this->bean->id}'
        AND l1.status = 'Active'
        AND l1.deleted = 0
        ORDER BY CASE
        WHEN l1.type = 'Reward' THEN 0
        WHEN l1.type = 'Partnership' THEN 1
        WHEN l1.type = 'Hour' THEN 3
        WHEN l1.type = 'Other' THEN 4
        WHEN l1.type = 'Gift' THEN 4
        ELSE 4
        END ASC , l1.name ASC";
        $result = $GLOBALS['db']->query($sql);
        // Show "do not apply with" options
        $html .= '<table class="table-striped" name="tb_discount_schema[]" id="tb_discount_schema">';
        $html .= '<tbody style="display: block; border: 1px solid lightgray; height: 200px; overflow-y: scroll"> <tr> <td><input type="checkbox" id="checkall" title="Select all"/></td>
        <th> Select all</th> </tr> ';

        //Other discount
        while($row2 = $GLOBALS['db']->fetchByAssoc($result)){
            $checkProp = "";
            if (in_array($row2['id'],$arrayNotApplyWith)) $checkProp = "checked";
            $html .= '<tr ><td><input type="checkbox" name="check_schema[]" value= "'.$row2['id'].'" '.$checkProp.'/></td><td>'.$row2['type'].': '.$row2['name'].' ('.$row2['team_name'].')</td></tr>';
        }
        $html .= '</tbody></table>';

        $this->ss->assign('SCHEMA_TABLE', $html);
        $this->ss->assign('PA', $pa);
        $this->ss->assign('BO', $bo);
        $this->ss->assign('DIH', $dih);
        parent::display();
    }
}

// Generate Add row template Partnership
function getHtmlAddRowPa( $pa_id, $pa_name, $showing){
    if($showing)
        $display = 'style="display:none;"';
    $tpl_addrow  = "<tr class='row' $display  >";
    $tpl_addrow .= '<td nowrap align="center">
    <div><input name="pa_name[]" value="'.$pa_name.'" class="pa_name" type="text" style="margin-right: 10px;">
    <input name="pa_id[]" value="'.$pa_id.'"  class="pa_id" type="hidden"><button type="button" class="btn_choose_pa" onclick="clickChoosePa($(this))" ><img src="themes/default/images/id-ff-select.png"></button>
    </div>
    </td>';
    $tpl_addrow .= "<td align='center'><button type='button' class='btn btn-danger btn_Remove'>Remove</button></td>";
    $tpl_addrow .= '</tr>';
    return $tpl_addrow;
}
function getHtmlAddRowHour( $hour, $promtion_hour, $showing){
    if($showing)
        $display = 'style="display:none;"';
    $tpl_addrow  = "<tr class='row' $display >";
    $tpl_addrow .= '<td nowrap align="center"><div><input tabindex="0" autocomplete="off" type="text" name="hours[]" class="hours" value="'.$hour.'" size="4" maxlength="10" style="text-align: center;"></div></td>';
    $tpl_addrow .= '<td nowrap align="center"><div><input tabindex="0" autocomplete="off" type="text" name="promotion_hours[]" class="promotion_hours" value="'.$promtion_hour.'" size="4" maxlength="10" style="text-align: center;color: rgb(165, 42, 42);"></div></td>';
    $tpl_addrow .= "<td align='center'><button type='button' class='btnRemoveHour' style='display: inline-block;'><img src='themes/default/images/id-ff-remove-nobg.png' alt='Remove'></button></td>";
    $tpl_addrow .= '</tr>';
    return $tpl_addrow;
}