<?php



class DotbWidgetSubPanelTopMessage extends DotbWidgetSubPanelTopButton
{
    public function display(array $defines, $additionalFormFields = array())
	{
        return $defines['message'];
	}
}
