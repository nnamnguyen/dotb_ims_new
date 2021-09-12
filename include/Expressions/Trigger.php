<?php


/**
 * Expression trigger
 * @api
 */
class Trigger
{
	public $triggerFields = array();
	public $conditionFunction = "";
	static $ValueNotSetError = -1;

    public function __construct($condition, $fields = array())
    {
		$this->conditionFunction = $condition;
		if (!is_array($fields))
			$fields = array($fields);
		$this->triggerFields = $fields;
	}

	function evaluate($target) {
		$result = Parser::evaluate($this->conditionFunction, $target)->evaluate();
		if ($result == AbstractExpression::$TRUE){
			return true;
		} else {
			return false;
		}
	}

	function getJavascript() {
		$js = "new DOTB.forms.Trigger([";
		for ($i=0; $i < sizeOf($this->triggerFields); $i++) {
			$js .= "'{$this->triggerFields[$i]}'";
			if ($i < sizeOf($this->triggerFields) - 1){
				$js .= ",";
			}
		}
		$js .= "], '" . str_replace("\n","",$this->conditionFunction) . "')";
		return $js;
	}

	function getCondition() {
		return $this->conditionFunction;
	}

    function getFields(){
        return $this->triggerFields;
    }
}

