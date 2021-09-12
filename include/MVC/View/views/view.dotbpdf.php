<?php




class ViewDotbpdf extends DotbView{
    
    var $type ='dotbpdf';
    /**
     * It is set by the "dotbpdf" request parameter and it is use by DotbpdfFactory to load the good dotbpdf class.
     * @var String
     */
    var $dotbpdf='default';
    /**
     * The dotbpdf object (Include the TCPDF object).
     * The atributs of this object are destroy in the output method.
     * @var Dotbpdf object
     */
    var $dotbpdfBean=NULL;

    
    public function __construct()
    {
        parent::__construct();

        if (isset($_REQUEST["dotbpdf"])) {
            $this->dotbpdf = $this->request->getValidInputRequest('dotbpdf', 'Assert\ComponentName');
        } else {
            $module = $this->request->getValidInputRequest('module', 'Assert\Mvc\ModuleName');
            $record = $this->request->getValidInputRequest('record', 'Assert\Guid');
            header('Location:index.php?module=' . $module . '&action=DetailView&record=' . $record);
        }
    }
     
     function preDisplay(){
         $this->dotbpdfBean = DotbpdfFactory::loadDotbpdf($this->dotbpdf, $this->module, $this->bean, $this->view_object_map);
         
         // ACL control
        if(!empty($this->bean) && !$this->bean->ACLAccess($this->dotbpdfBean->aclAction)){
            ACLController::displayNoAccess(true);
            dotb_cleanup(true);
        }
        
        if(isset($this->errors)){
          $this->dotbpdfBean->errors = $this->errors;
        }
     }
     
    function display(){
        $this->dotbpdfBean->process();
        $this->dotbpdfBean->Output($this->dotbpdfBean->fileName,'I');
     }

}

