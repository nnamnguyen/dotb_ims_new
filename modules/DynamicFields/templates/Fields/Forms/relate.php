<?php


function get_body (&$ss , $vardef)
{

    $modules = array ( ) ;

    $relatableModules = array_keys ( DeployedRelationships::findRelatableModules () ) ;

    foreach ( $relatableModules as $module )
    {
        $modules [ $module ] = translate ( 'LBL_MODULE_NAME', $module ) ;
    }

    $modules = DotbACL::filterModuleList($modules);
    unset ( $modules [ "" ] ) ;
    unset ( $modules [ 'Activities' ] ) ; // cannot relate to Activities as only Activities' submodules have records; use a Flex Relate instead!

    // tyoung bug 18631 - reduce potential confusion when creating a relate custom field for Products - actually points to the Product Catalog, so label it that way in the drop down list
    if (isset ( $modules [ 'ProductTemplates' ] ) && $modules [ 'ProductTemplates' ] == 'Product')
    {
        $modules [ 'ProductTemplates' ] = translate ( 'LBL_MODULE_NAME', 'ProductTemplates' ) ;
    }

    // C.L. - Merge from studio_rel_user branch
    $modules['Users'] = translate('LBL_MODULE_NAME', 'Users');
    asort($modules);

    $ss->assign ( 'modules', $modules ) ;

    return $ss->fetch ( 'modules/DynamicFields/templates/Fields/Forms/relate.tpl' ) ;
}
?>
