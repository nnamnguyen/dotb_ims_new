<?php



class ViewSelectRelatedField extends DotbView
{
    var $vars = array("tmodule", "selLink");

    public function __construct()
    {

        parent::__construct();
        foreach($this->vars as $var)
        {
            if (!isset($_REQUEST[$var]))
                dotb_die("Required paramter $var not set in ViewRelFields");
            $this->$var = $_REQUEST[$var];
        }
        $mb = new ModuleBuilder();
        $this->package = empty($_REQUEST['package']) || $_REQUEST['package'] == 'studio' ? "" : $mb->getPackage($_REQUEST['package']);

    }

    function display() {
        $rmodules = array();
        $links = FormulaHelper::getLinksForModule($this->tmodule, $this->package);
        $rfields = array();
        foreach($links as $lname => $link) {
            $rmodules[$lname] = $link['label'];
        }

        //Preload the related fields from the first relationship
        if (!empty($links))
        {
            reset($links);
            $link = isset($links[$this->selLink]) ? $links[$this->selLink]: $links[key($links)];
            $rfields = FormulaHelper::getRelatableFieldsForLink($link, $this->package);
        }

        $this->ss->assign("rmodules", $rmodules);
        $this->ss->assign("rfields", $rfields);
        $this->ss->assign("tmodule", $this->tmodule);
        $this->ss->assign("selLink", $this->selLink);
        $this->ss->assign("rollup_types", array(
            "rollupSum" => "Sum",
            "rollupMin" => "Minimum",
            "rollupMax" => "Maximum",
            "rollupAverage" => "Average",
        ));
        $this->ss->display('modules/ExpressionEngine/tpls/selectRelatedField.tpl');
    }


}