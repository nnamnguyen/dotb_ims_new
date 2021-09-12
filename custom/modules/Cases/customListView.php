<?php

class customListView{
    function listViewColor(&$bean, $event, $arguments){
        switch ($bean->status) {
            case "Openning":
                $colorClass = "textbg_green";
                break;
            case "In Progress":
                $colorClass = "textbg_bluelight";
                break;
            case "Feedback Needed":
                $colorClass = "textbg_orange";
                break;
            case "Resolved":
                $colorClass = "textbg_crimson";
                break;
        }
        $bean->status = "<span class='full-width visible'><span class='label ellipsis_inline $colorClass' title='Status'>". $bean->status ."</span></span>";
    }

    function ratingStar(&$bean, $event, $arguments){
        $html ="<center>";
        switch ($bean->rate) {
            case "":
                $rate = 0;
                break;
            default:
                $rate = $bean->rate;
        }
        for($i=1; $i<6; $i++ ){
            if($rate >= $i)
                $html .="<i class='fa fa-star' style='font-size:10px;margin: 0 1px;color: orange'></i>";
            else
                $html .="<i class='fa fa-star' style='font-size:10px;margin: 0 1px'></i>";
        }
        $bean->custom_rate = $html."</center>";
    }
    function customName(&$bean, $event, $arguments){
        $lastComment = $GLOBALS['db']->getOne("SELECT description 
                                            FROM c_comments 
                                            WHERE parent_id = '{$bean->id}'
                                            AND parent_type ='Cases'
                                            ORDER BY date_entered DESC");
        $countComment = $GLOBALS['db']->getOne("SELECT count(id) 
                                            FROM c_comments 
                                            WHERE parent_id = '{$bean->id}'
                                            AND parent_type ='Cases'");
        $img = 'styleguide/assets/img/profile.png';
        $bean->custom_name .= "<div class ='flex_row'>";
        $bean->custom_name .= "<div class ='custom_avatar'><img class='case_avatar' src='{$img}'></div>";
        $bean->custom_name .= "<div class ='custom_content'>";
        $bean->custom_name .= "<div class ='custom_title'>";
        $bean->custom_name .= "<a class='padding_right' href='#Cases/{$bean->id}'>$bean->name</a>";
        $bean->custom_name .= "<span class='badge btn-danger dropdown-toggle' rel='tooltip' title='' aria-label='Notifications' data-placement='bottom' data-original-title='Notifications'>{$countComment}</span>";
        $bean->custom_name .= "</div>";
        $bean->custom_name .= "<div class='last_comment'>{$lastComment}</div>";
        $bean->custom_name .= "</div>";
        $bean->custom_name .= "</div>";
    }
}