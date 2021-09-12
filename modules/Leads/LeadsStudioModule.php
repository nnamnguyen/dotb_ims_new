<?php


/*********************************************************************************
 * $Id: view.dotbpdf.php 
 * Description: This file is used to override the default Meta-data EditView behavior
 * to provide customization specific to the Quotes module.
 ********************************************************************************/

class LeadsStudioModule extends StudioModule
{
     function __construct ($module)
    {
         parent::__construct ($module);
    }

    function getLayouts()
    {
        $layouts = parent::getLayouts();

        $layouts = array_merge(array( translate("LBL_CONVERTLEAD", "Leads") => array (
                'name' => translate("LBL_CONVERTLEAD", "Leads") ,
                'action' => "module=Leads&action=Editconvert&to_pdf=1" ,
                'imageTitle' => 'icon_ConvertLead' ,
                'help' => 'layoutsBtn' ,
                'size' => '48')), $layouts);

        return $layouts ;
    }
}
