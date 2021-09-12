<?php



/**
 * MVC Controller Factory
 * @api
 */
class ControllerFactory
{
	/**
	 * Obtain an instance of the correct controller.
	 *
     * @param string $module Module name
     * @return DotbController
	 */
    public static function getController($module)
	{
		if(DotbAutoLoader::requireWithCustom("modules/{$module}/controller.php")) {
		    $class = DotbAutoLoader::customClass(ucfirst($module).'Controller');
		} else {
		    DotbAutoLoader::requireWithCustom('include/MVC/Controller/DotbController.php');
		    $class = DotbAutoLoader::customClass('DotbController');
		}
		if(class_exists($class, false)) {
			$controller = new $class();
		}

		if(empty($controller)) {
		    $controller = new DotbController();
		}
		//setup the controller
		$controller->setup($module);
		return $controller;
	}
}
