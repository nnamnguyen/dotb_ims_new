<?php



class PMSEInvalidElement extends PMSEShape
{
    /**
     * This method prepares the response of the current element based on the
     * $bean object and the $flowData, an external action such as
     * ROUTE or ADHOC_REASSIGN could be also processed.
     *
     * This method probably should be override for each new element, but it's
     * not mandatory. However the response structure always must pass using
     * the 'prepareResponse' Method.
     *
     * As defined in the example:
     *
     * $response['route_action'] = 'ROUTE'; //The action that should process the Router
     * $response['flow_action'] = 'CREATE'; //The record action that should process the router
     * $response['flow_data'] = $flowData; //The current flowData
     * $response['flow_filters'] = array('first_id', 'second_id'); //This attribute is used to filter the execution of the following elements
     * $response['flow_id'] = $flowData['id']; // The flowData id if present
     *
     * @param array $flowData
     * @param DotbBean $bean
     * @param string $externalAction The external action for the router
     * @return array
     * @codeCoverageIgnore
     */
    public function run($flowData, $bean = null, $externalAction = '', $arguments = array())
    {
         switch ($externalAction) {
            case 'RESUME_EXECUTION':
                return $this->prepareResponse($flowData, 'NONE', 'NONE');
                break;
            default :
                throw new PMSEElementException('Invalid Element', $flowData, $this);
                break;
        }
        
    }
}
