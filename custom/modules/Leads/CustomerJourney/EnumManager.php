<?php

namespace Leads\CustomerJourney;


class EnumManager
{
    /**
     * @return array
     */
    public static function listEnumValues()
    {
        return \DRI_Workflow_Template::listEnumValuesByModule('Leads');
    }
}
