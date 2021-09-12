<?php


use Dotbcrm\Dotbcrm\ProcessManager;

/**
 * Description of PMSECriteriaEvaluator
 * 
 */
class PMSECriteriaEvaluator
{
    protected $expressionEvaluator;

    public function __construct()
    {
        $this->expressionEvaluator = ProcessManager\Factory::getPMSEObject('PMSEExpressionEvaluator');
    }
    
    public function isCriteriaToken($token)
    {
        $result = false;
        $criteriaTypes = array (
            'MODULE',
            'CONTROL',
            'BUSINESS_RULES',
            'USER_ROLE',
            'USER_ADMIN',
            'USER_IDENTITY'
        );

        if (in_array($token->expType, $criteriaTypes)) {
            $result = true;
        }
        
        return $result;
    }
    
    public function evaluateCriteriaToken($criteriaToken)
    {
        $resultToken = new stdClass();
        $resultToken->expType = 'CONSTANT';
        $operationGroup = 'relation';
        $expSubtype = $this->getSubtype($criteriaToken);
        if (!isset($expSubtype)) {
            $criteriaToken->expSubtype = '';
        }
        if (isset($criteriaToken->expRel)) {
            $resultToken->expValue = false;
            foreach ($criteriaToken->currentValue as $currentValue) {
                $resultToken->expValue = $this->expressionEvaluator->routeFunctionOperator(
                    $operationGroup,
                    $currentValue,
                    $criteriaToken->expOperator,
                    $criteriaToken->expValue,
                    $criteriaToken->expSubtype
                );
                if ($criteriaToken->expRel == 'All') {
                    if (!$resultToken->expValue) {
                        break;
                    }
                } else {
                    if ($resultToken->expValue) {
                        break;
                    }
                }
            }
        } else {
            $resultToken->expValue = $this->expressionEvaluator->routeFunctionOperator(
                $operationGroup,
                $criteriaToken->currentValue[0],
                $criteriaToken->expOperator,
                $criteriaToken->expValue,
                $criteriaToken->expSubtype
            );
        }
        $this->expressionEvaluator->processTokenAttributes($resultToken);
        return $resultToken;
    }
    
    public function evaluateCriteriaTokenList($tokenArray)
    {
        foreach ($tokenArray as $key => $token) {
            if ($this->isCriteriaToken($token)) {
                $tokenArray[$key] = $this->evaluateCriteriaToken($token);
            }
        }
        return $tokenArray;
    }

    /**
     * helper function for test mocks
     * @param stdClass object
     * @return string || null
     */
    public function getSubtype($criteriaToken)
    {
        return PMSEEngineUtils::getExpressionSubtype($criteriaToken);
    }
}
