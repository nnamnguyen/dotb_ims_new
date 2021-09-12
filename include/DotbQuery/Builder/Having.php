<?php


class DotbQuery_Builder_Having
{
    public $column;
    public $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function addField($column, $options = array())
    {
        $this->column = new DotbQuery_Builder_Field_Having($column, $this->query);
        return $this;
    }
    
    public function addRaw($expression) {
        $this->column = new DotbQuery_Builder_Field_Raw($expression, $this->query);
    }
}
