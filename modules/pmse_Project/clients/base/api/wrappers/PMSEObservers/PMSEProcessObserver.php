<?php



use Dotbcrm\Dotbcrm\ProcessManager;

/**
 * Description of PMSEProcessObserver
 *
 */
class PMSEProcessObserver implements PMSEObserver
{

    /**
     *
     * @var type
     */
    protected $dotbQuery;

    /**
     *
     * @var PMSELogger
     */
    protected $logger;

    /**
     *
     * @codeCoverageIgnore
     */
    public function __construct()
    {
        $this->dotbQuery = new DotbQuery();
        $this->logger = PMSELogger::getInstance();
    }

    /**
     *
     * @return type
     * @codeCoverageIgnore
     */
    public function getDotbQuery()
    {
        return $this->dotbQuery;
    }

    /**
     *
     * @return type
     * @codeCoverageIgnore
     */
    public function getLogger()
    {
        return $this->logger;
    }

    /**
     *
     * @param type $dotbQuery
     * @codeCoverageIgnore
     */
    public function setDotbQuery($dotbQuery)
    {
        $this->dotbQuery = $dotbQuery;
    }

    /**
     *
     * @param PMSELogger $logger
     * @codeCoverageIgnore
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
    }

    /**
     *
     * @param type $id
     * @return type
     * @codeCoverageIgnore
     */
    public function getRelatedDependencyBean($id = null)
    {
        return BeanFactory::getBean('pmse_BpmRelatedDependency', $id);
    }

    /**
     *
     * @param PMSEObservable $subject
     */
    public function update($subject)
    {
        if (method_exists($subject, 'getProcessDefinition')) {
            $this->logger->debug("Trigger update of a Related Relationship for a Process Definitions update");

            $processDefinition = $subject->getProcessDefinition();
            $processDefinitionData = $processDefinition->fetched_row;

            $fields = array(
                'id',
                'rel_element_type',
            );

            $relatedDependency = $this->getRelatedDependencyBean();

            $this->dotbQuery->select($fields);
            $this->dotbQuery->from($relatedDependency);
            $this->dotbQuery->where()->queryAnd()
                ->addRaw("pro_id='{$processDefinitionData['id']}' AND prj_id='{$processDefinitionData['prj_id']}' AND deleted=0");

            $rows = $this->dotbQuery->execute();
            foreach ($rows as $row) {
                $bean = $this->getRelatedDependencyBean($row['id']);
                $bean->pro_status = $processDefinitionData['pro_status'];
                $bean->pro_locked_variables = $processDefinitionData['pro_locked_variables'];
                $bean->pro_terminate_variables = $processDefinitionData['pro_terminate_variables'];
                if ($bean->pro_module !== $processDefinitionData['pro_module'] && $row['rel_element_type'] == 'TERMINATE') {
                    $bean->deleted = true;
                }
                $bean->save();
            }

            $this->processRelatedDependencies($processDefinitionData);
            $depNumber = count($rows);
            $this->logger->debug("Updating {$depNumber} dependencies");
        }
    }
    
    /**
     * 
     * @param type $processDefinitionData
     */
    public function processRelatedDependencies($processDefinitionData)
    {
        $fakeEventData = array(
            'id' => 'TERMINATE',
            'evn_type' => 'GLOBAL_TERMINATE',
            'evn_criteria' => $processDefinitionData['pro_terminate_variables'],
            'evn_behavior' => 'CATCH',
            'pro_id' => $processDefinitionData['id']
        );
        $depWrapper = ProcessManager\Factory::getPMSEObject('PMSERelatedDependencyWrapper');
        $depWrapper->processRelatedDependencies($fakeEventData);
    }
}
