<?php


/**
 * Filter factory
 * @api
 */
class FilterFactory
{
	static $filter_map = array();

	public static function getInstance($source_name, $filter_name='')
	{
		$key = $source_name . $filter_name;
		if(empty(self::$filter_map[$key])) {

			if(empty($filter_name)){
			   $filter_name = $source_name;
			}

			if(ConnectorFactory::load($filter_name, 'filters')) {
		        $filter_name .= '_filter';
			} else {
				//if there is no override wrapper, use the default.
				$filter_name = 'default_filter';
			}

			$component = ConnectorFactory::getInstance($source_name);
			$filter = new $filter_name();
			$filter->setComponent($component);
			self::$filter_map[$key] = $filter;
		} //if
		return self::$filter_map[$key];
	}
}
