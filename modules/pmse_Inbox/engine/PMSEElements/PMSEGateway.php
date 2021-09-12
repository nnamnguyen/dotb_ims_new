<?php



use Dotbcrm\Dotbcrm\ProcessManager;

class PMSEGateway extends PMSEShape
{
    protected $evaluator;

    /**
     *
     * @return type
     * @codeCoverageIgnore
     */
    public function getEvaluator()
    {
        return $this->evaluator;
    }

    /**
     *
     * @param type $expressionEvaluator
     * @codeCoverageIgnore
     */
    public function setEvaluator($expressionEvaluator)
    {
        $this->evaluator = $expressionEvaluator;
    }

    /**
     * Class Constructor
     * @codeCoverageIgnore
     */
    public function __construct()
    {
        parent::__construct();
        $this->evaluator = ProcessManager\Factory::getPMSEObject('PMSEEvaluator');
    }

}
