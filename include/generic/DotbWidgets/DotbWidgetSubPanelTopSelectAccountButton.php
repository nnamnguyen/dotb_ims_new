<?php


class DotbWidgetSubPanelTopSelectAccountButton extends DotbWidgetSubPanelTopSelectButton {
    public function display(array $widget_data, $additionalFormFields = array())
	{
		/*
		* i.dymovsky
		* Because when user role can't edit Accounts, it also can't edit Membership Organizations. Select button leads to change MO list
		* See bug 25633
		* Bug25633 code change start
		*/
		if (!ACLController::checkAccess($widget_data["module"], "edit", true)) {
			return ;
		}
		/*
		* Bug25633 code change end
		*/
		
        return parent::display($widget_data, $additionalFormFields);
	}
}
