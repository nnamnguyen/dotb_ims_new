<?php

namespace Cases\CustomerJourney;

/**
 * @author Emil Kilhage
 */
class EnumManager
{
    /**
     * @return array
     */
    public static function listEnumValues()
    {
        return \DRI_Workflow_Template::listEnumValuesByModule('Cases');
    }
}
