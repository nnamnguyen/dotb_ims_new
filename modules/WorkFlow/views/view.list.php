<?php



class WorkFlowViewList extends ViewList
{
    public function preDisplay()
    {
        $this->lv = new ListViewSmarty();
        $this->lv->export = false;
        $this->lv->showMassupdateFields = false;
    }

    /**
     * Gets the WorkFlow module title. This is overridden to allow the addition
     * of the WorkFlow sunsetting messaging for 7.6.1
     *
     * @param boolean $show_help Used to tell the parent whether to show additional links
     * @return string
     */
    public function getModuleTitle($show_help = true)
    {
        // Get the current module title with all the cruft
        $title = parent::getModuleTitle(false);

        // Get rid of the closing clearing div for now
        $title = str_replace("</div></div>", '</div>', $title);

        // Manipulate the moduleTitle class
        $title = str_replace("class='moduleTitle'", "class='moduleTitle workflow-sunset-title'", $title);

        // Add in our sunset message and add back the closing clearing div that
        // was removed earlier
        $title .= '<span class="error workflow-sunset">' . translate('LBL_WORKFLOW_SUNSET_NOTICE', $this->module) . '</span></div>';

        return $title;
    }
}
