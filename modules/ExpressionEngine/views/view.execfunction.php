<?php

class ViewExecFunction extends ViewAjax
{
    var $vars = array("tmodule", "id", "params", "function");

    public function __construct()
    {
        parent::__construct();
        foreach($this->vars as $var)
        {
            if (empty($_REQUEST[$var]))
                dotb_die("Required paramter $var not set in ViewRelFields");
            $this->$var = $_REQUEST[$var];
        }

    }

 	function display() {
        //First load the primary bean
        $focus = BeanFactory::getBean($this->tmodule, $this->id);

        $params = implode(",", json_decode(html_entity_decode($this->params)));
        $result = Parser::evaluate("{$this->function}($params)", $focus)->evaluate();
        //If the target field isn't a date, convert it to a user formated string
        if ($result instanceof DateTime)
        {
            global $timedate;
            if (isset($result->isDate) && $result->isDate)
                $result = $timedate->asUserDate($result);
            else
                $result = $timedate->asUser($result);
        }
        echo json_encode($result);
    }
}