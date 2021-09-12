<?php


/*********************************************************************************
 * $Id: view.dotbpdf.php 
 * Description: This file is used to override the default Meta-data EditView behavior
 * to provide customization specific to the Quotes module.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

class DocumentsStudioModule extends StudioModule
{
     function __construct ($module)
    {
         parent::__construct ($module);
    }

    function getLayouts()
    {
        $layouts = parent::getLayouts();
        
        //The Documents popup view is not customizable
        unset($layouts [ translate('LBL_POPUP') ]);
        
        return $layouts ;

    }
}
