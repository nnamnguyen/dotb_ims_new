<?php




class CasesViewDetail extends ViewDetail {

    public function preDisplay()
    {
        parent::preDisplay();
        $this->dv->th->deleteTemplate($this->dv->module, $this->dv->view);
    }
}

?>
