<?php



/**
 * DotbQuery_Builder_Field_Raw
 * @api
 */

class DotbQuery_Builder_Field_Raw extends DotbQuery_Builder_Field
{
    public function __construct($field, DotbQuery $query)
    {
        $this->field = $field;
    }

    /**
     * @param DotbQuery $query
     */
    public function setupField($query)
    {
        $this->query = $query;
    }
}
