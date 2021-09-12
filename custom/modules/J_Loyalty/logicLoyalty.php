<?php
    if (!defined('dotbEntry') || !dotbEntry) die('Not A Valid Entry Point');

    class logicLoyalty
    {
        function beforeSaveLogic(&$bean, $event, $arguments)
        {
            //Set Team
            $student = BeanFactory::getBean('Contacts', $bean->student_id);
            if (empty($bean->team_id)) {
                $bean->team_id = '1';
                $bean->team_set_id = '1';
            }

            //Changing the sign of a number
            $loyalty_in_list = $GLOBALS['app_list_strings']['loyalty_in_list'];
            $loyalty_out_list = $GLOBALS['app_list_strings']['loyalty_out_list'];
            if (in_array($bean->type, $loyalty_in_list)){
                $bean->point = abs($bean->point);


                //Set Expired
                $expire_time = $GLOBALS['app_list_strings']['default_loyalty_rate']['Expire Time'];
                if(empty($expire_time)) $expire_time = '1 year';
                $max_exp = $GLOBALS['db']->getOne("SELECT MAX(exp_date) exp_date FROM j_loyalty WHERE deleted = 0 AND (student_id = '{$bean->student_id}') GROUP BY student_id");
                $exp_date= date('Y-m-d', strtotime("+ $expire_time" . $bean->input_date));

                if($max_exp < $exp_date){
                    $bean->exp_date = $exp_date;
                    $GLOBALS['db']->query("UPDATE j_loyalty SET exp_date = '{$bean->exp_date}' WHERE student_id = '{$bean->student_id}' AND type IN ('".implode("','",array_keys($loyalty_in_list))."') AND deleted = 0");

                }else $bean->exp_date = $max_exp;
            }

            if (in_array($bean->type, $loyalty_out_list)){
                $bean->point = -1 * abs($bean->point);
                $bean->exp_date = '';
            }
        }

        function addCode(&$bean, $event, $arguments){
            $code_field = 'name';
            if (empty($bean->$code_field)) {
                //Get Prefix
                $res = $GLOBALS['db']->query("SELECT contact_id FROM contacts WHERE id = '{$bean->student_id}'");
                $row = $GLOBALS['db']->fetchByAssoc($res);
                $prefix = $row['contact_id'] . '/' . date('y');
                $year = date('y', strtotime('+ 7hours' . (!empty($bean->date_entered) ? $bean->date_entered : $bean->fetched_row['date_entered'])));
                $table = $bean->table_name;
                $sep = '/';
                $first_pad = '000';
                $padding = 3;
                $query = "SELECT $code_field FROM $table WHERE ( $code_field <> '' AND $code_field IS NOT NULL) AND id != '{$bean->id}' AND (LEFT($code_field, " . (strlen($prefix) + 1) . ") = '#" . $prefix . "') ORDER BY RIGHT($code_field, $padding) DESC LIMIT 1";

                $result = $GLOBALS['db']->query($query);
                if ($row = $GLOBALS['db']->fetchByAssoc($result))
                    $last_code = $row[$code_field];
                else
                    //no codes exist, generate default - PREFIX + CURRENT YEAR +  SEPARATOR + FIRST NUM
                    $last_code = $prefix . $sep . $first_pad;


                $num = substr($last_code, -$padding, $padding);
                $num++;
                $pads = $padding - strlen($num);
                $new_code = $prefix . $sep;

                //preform the lead padding 0
                for ($i = 0; $i < $pads; $i++)
                    $new_code .= "0";
                $new_code .= $num;

                //write to database - Logic: Before Save
                $bean->$code_field = "#" . $new_code;
            }
        }

        function listViewColor(&$bean, $event, $arguments){
            if ($bean->point < 0)
                $bean->point = "<b style='color: #BB1212'>" . $bean->point . "</b>";
            if ($bean->point > 0)
                $bean->point = "<b style='color: #468931'>+" . $bean->point . "</b>";

            $loyalty_in_list = $GLOBALS['app_list_strings']['loyalty_in_list'];
            $loyalty_out_list = $GLOBALS['app_list_strings']['loyalty_out_list'];

            if (in_array($bean->type, $loyalty_in_list))
                $bean->type = '<span class="textbg_green">' . $bean->type . '</span>';
            if (in_array($bean->type, $loyalty_out_list))
                $bean->type = '<span class="textbg_blood">' . $bean->type . '</span>';
        }
    }

?>