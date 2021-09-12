<?php


class DotbQuery_Builder_Orderby
{
    /**
     * @var null|DotbQuery_Builder_Field_Orderby
     */
    public $column;

    /**
     * @var string
     */
    public $direction = 'DESC';

    /**
     * @var DotbQuery
     */
    public $query;

    public function __construct(DotbQuery $query, $direction = 'DESC')
    {
        $this->query = $query;
        $this->direction = $direction;
    }

    public function addField($column)
    {
        $this->column = new DotbQuery_Builder_Field_Orderby($column, $this->query, $this->direction);
        return $this;
    }

    public function addRaw($expression) {
        $this->column = new DotbQuery_Builder_Field_Raw($expression, $this->query);
    }
}
