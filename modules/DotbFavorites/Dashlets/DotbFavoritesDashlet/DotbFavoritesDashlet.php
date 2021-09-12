<?php
class DotbFavoritesDashlet extends DashletGeneric 
{ 
    public function __construct(
        $id, 
        $def = null
        ) 
    {
		global $current_user, $app_strings;
		require('modules/DotbFavorites/metadata/dashletviewdefs.php');
		$this->loadLanguage('DotbFavoritesDashlet', 'modules/DotbFavorites/Dashlets/');
        parent::__construct($id, $def);

        if(empty($def['title'])) $this->title = translate('LBL_HOMEPAGE_TITLE', 'DotbFavorites');

        $this->searchFields = $dashletData['DotbFavoritesDashlet']['searchFields'];
        $this->columns = $dashletData['DotbFavoritesDashlet']['columns'];
        $this->isConfigurable = true;
        $this->seedBean = BeanFactory::newBean('DotbFavorites');   
        $this->filters = array();
    }

    public function process($lvsParams = array())
    {
        $this->lvs->quickViewLinks = false;
        parent::process($lvsParams);
    }
    
    /**
     * Displays the configuration form for the dashlet
     * 
     * @return string html to display form
     */
    public function displayOptions() 
    {
        global $app_strings;
        
        $ss = new Dotb_Smarty();
        $this->dashletStrings['LBL_SAVE'] = $app_strings['LBL_SAVE_BUTTON_LABEL'];
        $ss->assign('lang', $this->dashletStrings);
        $ss->assign('id', $this->id);
        $ss->assign('title', $this->title);
        $ss->assign('titleLbl', $this->dashletStrings['LBL_CONFIGURE_TITLE']);
        if($this->isAutoRefreshable()) {
       		$ss->assign('isRefreshable', true);
			$ss->assign('autoRefresh', $GLOBALS['app_strings']['LBL_DASHLET_CONFIGURE_AUTOREFRESH']);
			$ss->assign('autoRefreshOptions', $this->getAutoRefreshOptions());
			$ss->assign('autoRefreshSelect', $this->autoRefresh);
		}
       
        $str = $ss->fetch('modules/DotbFavorites/Dashlets/DotbFavoritesDashlet/DotbFavoritesDashletOptions.tpl');  
        return Dashlet::displayOptions() . $str;
    }  

    /**
     * called to filter out $_REQUEST object when the user submits the configure dropdown
     * 
     * @param array $req $_REQUEST
     * @return array filtered options to save
     */  
    public function saveOptions($req) 
    {
        $options = array();
        $options['title'] = $req['title'];
        $options['autoRefresh'] = empty($req['autoRefresh']) ? '0' : $req['autoRefresh'];
        
        return $options;
    }
}