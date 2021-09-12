<?php


class StudioBrowser{
	var $modules = array();
	
	function loadModules(){
	    global $current_user;
		$access = $current_user->getDeveloperModules();
	    $d = dir('modules');
		while($e = $d->read()){;
			if(substr($e, 0, 1) == '.' || !is_dir('modules/' . $e))continue;
			if(DotbAutoLoader::existingCustomOne("modules/{$e}/metadata/studio.php") && isset($GLOBALS [ 'beanList' ][$e]) && (in_array($e, $access) || $current_user->isAdmin())) // installed modules must also exist in the beanList
			{
				$this->modules[$e] =  StudioModuleFactory::getStudioModule( $e ) ;
			}
		}
	}
	
    function loadRelatableModules(){
        $d = dir('modules');
        while($e = $d->read()){
        	if( ( (isset($_REQUEST['view_module'])) && ($_REQUEST['view_module'] == 'Project') )
                && ($e=='ProjectTask') && (isset($_REQUEST['id'])) && $_REQUEST['id']=='relEditor' && $_REQUEST['relationship_name'] == '') continue; //46141 - disabling creating custom relationship between Projects and ProjectTasks in studio
        	if(substr($e, 0, 1) == '.' || !is_dir('modules/' . $e))continue;
            if(DotbAutoLoader::existingCustomOne("modules/{$e}/metadata/studio.php") && isset($GLOBALS [ 'beanList' ][$e])) // installed modules must also exist in the beanList
            {
                $this->modules[$e] = StudioModuleFactory::getStudioModule( $e ) ;
            }
        }
    }
		
	function getNodes(){
		$this->loadModules();
	    $nodes = array();
		foreach($this->modules as $module){
		    $nodes[$module->module] = $module->getNodes();
		}

        // bug 15103 - order is important - this array is later looped over by foreach to generate the module list
        usort($nodes, function ($a, $b) {
            // sort them by display names
            return strcasecmp($a['name'], $b['name']);
        });

		return $nodes;
	}

	
	
	
	
}
