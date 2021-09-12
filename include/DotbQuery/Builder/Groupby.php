<?php


class DotbQuery_Builder_Groupby
{
    /**
     * @var null|DotbQuery_Builder_Field_Groupby
     */
    public $column;

    /**
     * @var DotbQuery
     */
    public $query;

    public function __construct(DotbQuery $query)
    {
        $this->query = $query;
    }

    public function addField($column)
    {
        $this->column = new DotbQuery_Builder_Field_Groupby($column, $this->query);
        return $this;
    }
    
    public function addRaw($expression) {
        $this->column = new DotbQuery_Builder_Field_Raw($expression, $this->query);
        return $this;
    }
}
