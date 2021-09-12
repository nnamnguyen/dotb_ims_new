<?php
// @codingStandardsIgnoreFile


class ViewModifySearch extends DotbView
{
    /**
     * @see DotbView::_getModuleTitleParams()
     */
    protected function _getModuleTitleParams($browserTitle = false)
    {
        global $mod_strings;

        return array(
            "<a href='index.php?module=Administration&action=index'>".translate('LBL_MODULE_NAME', 'Administration')."</a>",
            "<a href='index.php?module=Connectors&action=ConnectorSettings'>".$mod_strings['LBL_ADMINISTRATION_MAIN']."</a>",
            $mod_strings['LBL_MODIFY_SEARCH_TITLE'],
        );
    }

    /**
     * @see DotbView::_getModuleTab()
     */
    protected function _getModuleTab()
    {
        return 'Administration';
    }

    /**
     * @see DotbView::display()
     */
    public function display()
    {
        global $mod_strings, $app_strings;
        $dotb_smarty = new Dotb_Smarty();
        $this->ss->assign('mod', $mod_strings);
        $this->ss->assign('APP', $app_strings);
        $connectors = ConnectorUtils::getConnectors();
        foreach ($connectors as $id => $source) {
            $s = SourceFactory::getSource($id);
            if ($s === null || !$s->isEnabledInAdminSearch() || !$s->isEnabledInWizard()) {
               unset($connectors[$id]);
            }
        }

        $this->ss->assign('SOURCES', $connectors);
        echo $this->getModuleTitle(false);
        $this->ss->display($this->getCustomFilePathIfExists('modules/Connectors/tpls/modify_search.tpl'));
    }
}
