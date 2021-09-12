<?php



class DotbpdfFactory{
    /**
     * load the correct Tcpdf
     * @param string $type Tcpdf Type
     * @return valid Tcpdf
     */
    public static function loadDotbpdf($type, $module, $bean = null, $dotbpdf_object_map = array())
    {
        $type = strtolower(basename($type));
        //first let's check if the module handles this Tcpdf
        $dotbpdf = null;
        $path = '/dotbpdf/dotbpdf.'.$type.'.php';
        $pdf_file = DotbAutoLoader::existingCustomOne('include/Dotbpdf'.$path, 'modules/'.$module.$path);
        if($pdf_file) {
            $dotbpdf = DotbpdfFactory::buildFromFile($pdf_file, $bean, $dotbpdf_object_map, $type, $module);
        }

        // Default to Dotbpdf if still nothing found/built
        if (!isset($dotbpdf))
            $dotbpdf = new Dotbpdf($bean, $dotbpdf_object_map);
        return $dotbpdf;
    }

    /**
     * This is a private function which just helps the getDotbpdf function generate the
     * proper Tcpdf object
     *
     * @return Dotbpdf
     */
    protected static function buildFromFile($file, &$bean, $dotbpdf_object_map, $type, $module)
    {
        require_once($file);
        //try ModuleDotbpdfType first then try DotbpdfType if that fails then use Dotbpdf
        $class = ucfirst($module).'Dotbpdf'.ucfirst($type);
        if(!class_exists($class)){
            $class = 'Dotbpdf'.ucfirst($type);
            if(!class_exists($class)){
                return new Dotbpdf($bean, $dotbpdf_object_map);
            }
        }
        return DotbpdfFactory::buildClass($class, $bean, $dotbpdf_object_map);
    }

    /**
     * instantiate the correct Tcpdf and call init to pass on any obejcts we need to
     * from the controller.
     *
     * @param string class - the name of the class to instantiate
     * @param object bean = the bean to pass to the Dotbpdf
     * @param array Dotbpdf_object_map - the array which holds obejcts to pass between the
     *                                controller and the tcpdf.
     *
     * @return Dotbpdf
     */
    protected static function buildClass($class, &$bean, $dotbpdf_object_map)
    {
        $dotbpdf = new $class($bean, $dotbpdf_object_map);
        if($dotbpdf instanceof Dotbpdf) {
            return $dotbpdf;
        } else {
            return new Dotbpdf($bean, $dotbpdf_object_map);
        }
    }
}
