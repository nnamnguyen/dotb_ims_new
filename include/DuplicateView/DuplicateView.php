<?php


/**
 * DuplicateView
 * @api
 */
class DuplicateView extends EditView
{
    /**
     * @see EditView::setup()
     */
    public function setup(
        $module,
        $focus = null,
        $metadataFile = null,
        $tpl = 'include/EditView/EditView.tpl',
        $createFocus = true
    ) {
        parent::setup($module, $focus, $metadataFile, $tpl, $createFocus);
        $this->isDuplicate = isset($_REQUEST['isDuplicate']) && $_REQUEST['isDuplicate'] == 'true';
    }
}
