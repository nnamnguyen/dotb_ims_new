<?php




/**
 * Empty bean - to perform non-static functions on bean without loading specific beans
 */
class EmptyBean extends DotbBean
{
    // this bean has no vardefs
    public $disable_vardefs = true;
    // no custom fields
    public $disable_custom_fields = true;
}
