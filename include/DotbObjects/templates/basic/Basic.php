<?php


class Basic extends DotbBean
{
    /**
     * @see DotbBean::get_summary_text()
     */
    public function get_summary_text()
    {
        return "$this->name";
    }
}
