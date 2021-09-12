<?php


class DotbQuery_Builder_Andwhere extends DotbQuery_Builder_Where
{
    /** {@inheritDoc} */
    public function operator()
    {
        return 'AND';
    }
}
