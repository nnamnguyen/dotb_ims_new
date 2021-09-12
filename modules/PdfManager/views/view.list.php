<?php




class PdfManagerViewList extends ViewList
{
    public function preDisplay()
    {
        parent::preDisplay();
        $this->lv->quickViewLinks = false;
        $this->lv->export = false;
        $this->lv->mergeduplicates = 0;
        $this->lv->showMassupdateFields = false;
    }
}
