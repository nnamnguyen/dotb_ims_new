<?php


class ViewQuickview extends DotbView{
	function display()
	{
	    $focus = BeanFactory::getBean('Notifications', empty($_REQUEST['record']) ? "" : $_REQUEST['record']);

	    if(!empty($focus->id)) {
    	    //Mark as read.
    	    $focus->is_read = true;
    	    $focus->save(FALSE);
	    }

	    $results = array('contents' => $this->_formatNotificationForDisplay($focus) );

	    $json = getJSONobj();
		$out = $json->encode($results);
		ob_clean();
		print($out);
		dotb_cleanup(true);

	}

	function _formatNotificationForDisplay($notification)
    {
        global $app_strings;
        $this->ss->assign('APP', $app_strings);
        $this->ss->assign('focus', $notification);
        return $this->ss->fetch("modules/Notifications/tpls/detailView.tpl");
    }
}

