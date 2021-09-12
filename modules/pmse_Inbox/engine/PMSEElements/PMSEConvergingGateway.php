<?php





class PMSEConvergingGateway extends PMSEGateway
{
    public function retrievePreviousFlows($type, $elementId, $casId = '')
    {
        $dotbQuery = $this->retrieveDotbQueryObject();
        $flowBean = $this->caseFlowHandler->retrieveBean('pmse_BpmnFlow');
        
        $dotbQuery->select(array('a.id'));
        $dotbQuery->select()->fieldRaw('b.cas_id');
        $dotbQuery->select()->fieldRaw('b.cas_index');
        $dotbQuery->select()->fieldRaw('b.cas_thread');

        $dotbQuery->from($flowBean, array('alias' => 'a'));
        
        switch ($type){
            case 'PASSED':
                $joinType = 'INNER';
                $whereClause = 'b.bpmn_type=\'bpmnFlow\' AND b.cas_id=\''.$casId.'\' AND';
                break;
            case 'ALL':
            default:
                $joinType = 'LEFT';
                $whereClause = '';
                break;
        };

        $dotbQuery->joinTable('pmse_bpm_flow', array('joinType' => $joinType, 'alias' => 'b'))
            ->on()->equalsField('a.id', 'b.bpmn_id');
        $dotbQuery->where()->queryAnd()
            ->addRaw("{$whereClause} a.flo_element_dest='{$elementId}' AND a.flo_element_dest_type='bpmnGateway'");
        $flows = $dotbQuery->execute();

        $filteredFlows = array();
        foreach ($flows as $element) {
            if (!array_key_exists($element['id'], $filteredFlows)) {
                $filteredFlows[$element['id']] = $element;
            }
        }
        return $filteredFlows;
    }
}
