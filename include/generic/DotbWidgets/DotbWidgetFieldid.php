<?php


    class DotbWidgetFieldId extends DotbWidgetReportField
    {
        public function queryFilterIs($layout_def)
        {
            return $this->_get_column_select($layout_def)."='".$GLOBALS['db']->quote($layout_def['input_name0'])."'\n";
        }
        //Add filter by Lap Nguyen
        function queryFilterone_of($layout_def) {
            $arr = array ();
            foreach ($layout_def['input_name0'] as $value)
            {
                $arr[] = $this->reporter->db->quoted($value);
            }
            $str = implode(",", $arr);
            return $this->_get_column_select($layout_def)." IN (".$str.")\n";
        }

        function queryFilternot_one_of($layout_def) {
            $arr = array ();
            foreach ($layout_def['input_name0'] as $value)
            {
                $arr[] = $this->reporter->db->quoted($value);
            }
            $str = implode(",", $arr);
            return $this->_get_column_select($layout_def)." NOT IN (".$str.")\n";
        }
        //END

    }
