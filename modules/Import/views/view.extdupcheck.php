<?php

/*********************************************************************************

 * Description: view handler for step 1 of the import process
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 ********************************************************************************/


class ImportViewExtdupcheck extends ImportView
{
    protected $pageTitleKey = 'LBL_STEP_DUP_TITLE';

 	/**
     * @see DotbView::display()
     */
 	public function display()
    {
        global $mod_strings, $app_strings, $current_user;
        global $dotb_config;

        $this->ss->assign("MODULE_TITLE", $this->getModuleTitle(false));
        $this->ss->assign("DELETE_INLINE_PNG",  DotbThemeRegistry::current()->getImage('delete_inline','align="absmiddle" alt="'.$app_strings['LNK_DELETE'].'" border="0"'));
        $this->ss->assign("PUBLISH_INLINE_PNG",  DotbThemeRegistry::current()->getImage('publish_inline','align="absmiddle" alt="'.$mod_strings['LBL_PUBLISH'].'" border="0"'));
        $this->ss->assign("UNPUBLISH_INLINE_PNG",  DotbThemeRegistry::current()->getImage('unpublish_inline','align="absmiddle" alt="'.$mod_strings['LBL_UNPUBLISH'].'" border="0"'));
        $this->ss->assign("IMPORT_MODULE", $this->request->getValidInputRequest('import_module', 'Assert\Mvc\ModuleName', ''));
        $this->ss->assign("JAVASCRIPT", $this->_getJS());
        $this->ss->assign("CURRENT_STEP", $this->currentStep);

        //BEGIN DRAG DROP WIDGET
        $idc = new ImportDuplicateCheck($this->bean);
        $dupe_indexes = $idc->getDuplicateCheckIndexes();

        $dupe_disabled =  array();

        foreach($dupe_indexes as $dk=>$dv){
                $dupe_disabled[] =  array("dupeVal" => $dk, "label" => $dv);
        }


        //set dragdrop value
        $this->ss->assign('enabled_dupes', json_encode(array()));
        $this->ss->assign('disabled_dupes', json_encode($dupe_disabled));
        //END DRAG DROP WIDGET

        $this->ss->assign("RECORDTHRESHOLD", $dotb_config['import_max_records_per_file']);

        $content = $this->ss->fetch('modules/Import/tpls/extdupcheck.tpl');
        $this->ss->assign("CONTENT",$content);
        $this->ss->display('modules/Import/tpls/wizardWrapper.tpl');
    }

    /**
     * Returns JS used in this view
     */
    private function _getJS()
    {
        global $mod_strings;

        return <<<EOJAVASCRIPT
<script type="text/javascript">

document.getElementById('goback').onclick = function(){
    document.getElementById('importstepdup').action.value = 'extstep1';
    document.getElementById('importstepdup').to_pdf.value = '0';
    return true;
}




</script>

EOJAVASCRIPT;
    }
}

?>
