<?php




class ViewGetFields extends DotbView
{
    public $vars = array("baseModule", "baseLink");

    public function __construct()
    {
        global $app_strings;
        parent::__construct();

        foreach ($this->vars as $var) {
            if (!isset($_REQUEST[$var])) {
                dotb_die($app_strings['ERR_MISSING_REQUIRED_FIELDS'] . $var);
            }
            $this->$var = $_REQUEST[$var];
        }
    }

    public function display()
    {
        $fieldsForSelectedModule = PdfManagerHelper::getFields($this->baseModule, true);
        $selectedField = $fieldsForSelectedModule;
        $fieldsForSubModule = array();

        if (!empty($this->baseLink) && strpos($this->baseLink, 'pdfManagerRelateLink_') === 0) {

            $selectedField = $this->baseLink;
            $linkName = substr($this->baseLink, strlen('pdfManagerRelateLink_'));
            $focus = BeanFactory::newBean($this->baseModule);
            $focus->id = create_guid();
            $linksForSelectedModule = PdfManagerHelper::getLinksForModule($this->baseModule);
            if (isset($linksForSelectedModule[$linkName]) && $focus->load_relationship($linkName)) {
                $fieldsForSubModule = PdfManagerHelper::getFields($focus->$linkName->getRelatedModuleName());
            }
        }

        $this->ss->assign('fieldsForSelectedModule', $fieldsForSelectedModule);
        $this->ss->assign('selectedField', $selectedField);
        $this->ss->assign('fieldsForSubModule', $fieldsForSubModule);

        $this->ss->display('modules/PdfManager/tpls/getFields.tpl');
    }
}
