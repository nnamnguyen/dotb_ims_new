<?php



require_once 'modules/ModuleBuilder/MB/ModuleBuilder.php';

class PdfManagerController extends DotbController
{

    public function action_getFields()
    {
        $this->view = 'getFields';
    }

}
