<?php


use Dotbcrm\Dotbcrm\ProcessManager;
use Dotbcrm\Dotbcrm\ProcessManager\Registry;

class pmse_InboxController extends DotbController
{
    public function action_studio_configuration()
    {
        $this->view = 'studio_configuration';
    }

    public function action_showCase()
    {
        $this->view = 'showCase';
    }

    public function action_noShowCase()
    {
        $this->view = 'noShowCase';
    }

    /**
     *
     * @global type $beanList
     * @global type $current_user
     * @global type $beanFiles
     * @deprecated since version pmse2
     * @codeCoverageIgnore
     */
    public function action_routeCase()
    {
        // Needed to tell the save process to ignore locked field enforcement
        Registry\Registry::getInstance()->set('skip_locked_field_checks', true);

        $data = $_REQUEST;
        $data['frm_action'] = $data['Type'];
        $data['taskName'] = '';
        $engineApi = ProcessManager\Factory::getPMSEObject('PMSEEngineApi');
        $result = $engineApi->doEngineRoute($data);
        header('Location: index.php');
    }

    public function action_showPNG()
    {
        header('Content-Type: image/png');
        $img = ProcessManager\Factory::getPMSEObject('PMSEImageGeneratorApi');
        $img->doGetProcessImage(array('record' => $_REQUEST['case']));
    }

    public function action_showHistoryEntries()
    {
        $this->view = 'showHistoryEntries';
    }

    public function action_showNotes()
    {
        $this->view = 'showNotes';
    }
}
