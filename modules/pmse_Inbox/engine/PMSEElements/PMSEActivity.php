<?php



use Dotbcrm\Dotbcrm\ProcessManager;

/**
 * Description of PMSEActivity
 *
 * @codeCoverageIgnore
 */
class PMSEActivity extends PMSEShape
{
    /**
     *
     * @var type
     */
    protected $definitionBean;

    /**
     * @codeCoverageIgnore
     */
    public function __construct()
    {
        $this->definitionBean = BeanFactory::newBean('pmse_BpmActivityDefinition');
        parent::__construct();
    }

    /**
     *
     * @param type $module
     * @return \PMSEHistoryData
     * @codeCoverageIgnore
     */
    protected function retrieveHistoryData($module)
    {
        $data = ProcessManager\Factory::getPMSEObject('PMSEHistoryData');
        $data->setModule($module);
        return $data;
    }

    /**
     * @param null $id
     * @return Lead|Opportunity|pmse_Inbox|Team|User
     * @codeCoverageIgnore
     */
    protected function retrieveUserData($id = null)
    {
        return BeanFactory::getBean('Users', $id);
    }

    /**
     * @param $id
     * @return Lead|Opportunity|pmse_Inbox|Team|User
     * @codeCoverageIgnoreØ
     */
    protected function retrieveTeamData($id)
    {
        return BeanFactory::getBean('Teams', $id);
    }

    /**
     *
     * @param type $id
     * @return type
     * @codeCoverageIgnore
     */
    protected function retrieveDefinitionData($id)
    {
        $this->definitionBean->retrieve($id);
        return $this->definitionBean->fetched_row;
    }
}
