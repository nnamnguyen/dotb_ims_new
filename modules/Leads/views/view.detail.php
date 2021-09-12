<?php



class LeadsViewDetail extends ViewDetail
{

    function display()
    {
        global $dotb_config;

        //If the convert lead action has been disabled for already converted leads, disable the action link.
        $disableConvert = ($this->bean->status == 'Converted' && !empty($dotb_config['disable_convert_lead'])) ? TRUE : FALSE;
        $this->ss->assign("DISABLE_CONVERT_ACTION", $disableConvert);
        parent::display();
    }
}
