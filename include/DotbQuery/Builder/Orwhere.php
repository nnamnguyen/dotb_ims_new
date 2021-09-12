<?php


class DotbQuery_Builder_Orwhere extends DotbQuery_Builder_Where
{
    /** {@inheritDoc} */
    public function operator()
    {
        return 'OR';
    }
}
