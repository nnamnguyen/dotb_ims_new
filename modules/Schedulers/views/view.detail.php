<?php



class SchedulersViewDetail extends ViewDetail {

    /**
     * {@inheritDoc}
     *
     * @param bool $browserTitle Ignored
	 */
    protected function _getModuleTitleListParam($browserTitle = false)
	{
	    global $mod_strings;

    	return "<a href='index.php?module=Schedulers&action=index'>".$mod_strings['LBL_MODULE_TITLE']."</a>";
    }

    /**
 	 * display
 	 */
 	function display()
 	{
		$this->bean->parseInterval();
		$this->bean->setIntervalHumanReadable();
		$this->ss->assign('JOB_INTERVAL', $this->bean->intervalHumanReadable);
 		parent::display();
 	}
}

