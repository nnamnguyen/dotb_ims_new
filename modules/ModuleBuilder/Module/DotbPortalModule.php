<?php



class DotbPortalModule{
	var $name;
	
    public function __construct($module)
	{
	    global $app_list_strings;
        $moduleNames = array_change_key_case($app_list_strings['moduleList']);
		$this->name = $moduleNames[strtolower($module)];
		$this->module = $module;
		
		$path = 'modules/'.$this->module.'/clients/portal/views/';
        $views = self::getViewFiles();
		foreach($views as $file => $def) {
            $dirname = $path . basename($file, '.php') . '/';
            if (is_dir($dirname) && file_exists($dirname . $file)) {
                $this->views[$file] = $def;
            }
		}
	}
	

	function getNodes()
	{
		$layouts = array();
		if (isset($this->views)) {
            foreach($this->views as $file=>$def){
          			   $file = str_replace($file, '.php', '');
          			   $viewType = ($def['type'] == 'list')?"ListView":ucfirst($def['type']);
          			   $layouts[] = array('name'=>$def['name'], 'module'=>$this->module, 'action'=>"module=ModuleBuilder&action=editPortal&view=${viewType}&view_module=".$this->module);
          		}
        }

		$nodes =  array(
		            'name'=>$this->name, 'module'=>$this->module, 'type'=>'DotbPortalModule', 'action'=>"module=ModuleBuilder&action=wizard&portal=1&view_module=".$this->module, 
		            'children'=>$layouts,
			        );
		return $nodes;
	}
	
    /**
     * Gets an array of expected view files for portal layouts
     * 
     * Added as a helper to bug 55003
     * 
     * @static
     * @return array
     */
	public static function getViewFiles()
    {
        // If mod strings are empty, rebuild them - some rest calls are failing 
        // here
        global $mod_strings;
        if (empty($mod_strings['LBL_RECORDVIEW'])) {
            $mstrings = return_module_language($GLOBALS['current_language'], 'ModuleBuilder');
        } else {
            $mstrings = $mod_strings;
        }
        
        // These mod_strings are ModuleBuilder module strings
        return array(
            'record.php' => array('name' => $mstrings['LBL_RECORDVIEW'] , 'type' => 'recordView'),
            'list.php'   => array('name' => $mstrings['LBL_LISTVIEW'],    'type' => 'list'),
        );
    }
	
	
	
	
}

