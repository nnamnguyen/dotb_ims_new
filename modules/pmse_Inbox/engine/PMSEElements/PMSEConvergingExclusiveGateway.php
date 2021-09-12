<?php




class PMSEConvergingExclusiveGateway extends PMSEConvergingGateway
{
    public function run($flowData, $bean = null, $externalAction = '', $arguments = array())
    {
        $routeAction = 'WAIT';
        $flowAction = 'NONE';
        $filters = array();
        $previousFlows = $this->retrievePreviousFlows('PASSED', $flowData['bpmn_id'], $flowData['cas_id']);
        $reached = false;
        if (sizeof($previousFlows) === 1) {
            $routeAction = 'ROUTE';
            $flowAction = 'CREATE';
            $reached = true;
        }
        $result =  $this->prepareResponse($flowData, $routeAction, $flowAction, $filters);
        if ($reached) {
            $result['create_thread'] = true;
        }
        $result['close_thread'] = true;
        return $result;
    }
}
