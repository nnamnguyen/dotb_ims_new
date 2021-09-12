<?php


class DotbWidgetFieldTimeperiod extends DotbWidgetFieldEnum
{
	public function queryFilteris($layout_def) {
        $input_name0 = $this->getInputValue($layout_def);

        if($input_name0 == 'current') {
            $name = array_keys(TimePeriod::getCurrentName());
            $name = !empty($name) ? $name[0] : '';
            return DotbWidgetFieldId::_get_column_select($layout_def)." = '". $name ."'\n";
        }

		return parent::queryFilteris($layout_def);
	}

	public function queryFilteris_not($layout_def) {
        $input_name0 = $this->getInputValue($layout_def);

        if($input_name0 == 'current') {
            $name = array_keys(TimePeriod::getCurrentName());
            $name = !empty($name) ? $name[0] : '';
            return DotbWidgetFieldId::_get_column_select($layout_def)." NOT IN ('" . $name . "')\n";
        }

		return parent::queryFilteris_not($layout_def);
	}

	public function queryFilterone_of($layout_def) {
		$arr = array ();
		foreach ($layout_def['input_name0'] as $value)
        {
            if($value == 'current') {
                $name = array_keys(TimePeriod::getCurrentName());
                $name = !empty($name) ? $name[0] : '';
                $arr[] = $this->reporter->db-quoted($name);
            } else {
                $arr[] = $this->reporter->db->quoted($value);
            }
		}
		$str = implode(",", $arr);
		return $this->_get_column_select($layout_def)." IN (".$str.")\n";
	}

	public function queryFilternot_one_of($layout_def) {
		$arr = array ();
		foreach ($layout_def['input_name0'] as $value)
        {
            if($value == 'current') {
                $name = array_keys(TimePeriod::getCurrentName());
                $name = !empty($name) ? $name[0] : '';
                $arr[] = $this->reporter->db->quoted($name);
            } else {
                $arr[] = $this->reporter->db->quoted($value);
            }
		}
		$str = implode(",", $arr);
		return $this->_get_column_select($layout_def)." NOT IN (".$str.")\n";
	}
}
