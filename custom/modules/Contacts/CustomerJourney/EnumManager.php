<?php

namespace Contacts\CustomerJourney;


class EnumManager
{
    /**
     * @return array
     */
    public static function listEnumValues()
    {
        return \DRI_Workflow_Template::listEnumValuesByModule('Contacts');
    }
}
