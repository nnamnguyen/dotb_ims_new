<?php

/*
 * Your installation or use of this DotBCRM file is subject to the applicable
 * terms available at
 * http://support.dotbcrm.com/06_Customer_Center/10_Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this DotBCRM file.
 *
 * Copyright (C) DotBCRM Inc. All rights reserved.
 *
 * @package FTE Examples Dashlet
 */


class FTEExamplesApi extends FilterApi
{

    protected $modules = ["Accounts", "Cases", "Contacts", "Leads", "Opportunities", "Quotes", "Meetings", "Tasks"];
    protected $tags = ["FTExample"];

    public function registerApiRest()
    {
        return array(
            'getRecords' => array(
                'reqType' => 'GET',
                'path' => array('examples'),
                'pathVars' => array(''),
                'method' => 'getRecords',
                'shortHelp' => 'This method will return example records for corresponding dashlet',
                'longHelp' => '',
            ),
        );
    }


    public function getRecords(ServiceBase $api, array $args)
    {
        $results = [];
        foreach ($this->modules as $module) {
            $args["max_num"] = 1;

            if (is_array($this->tags)) {
                $args["filter"][0]["tag"]['$in'] = $this->tags;
            } else {
                $args["filter"][0]["tag"] = $this->tags;
            }

            $args["module"] = $module;
            $args["fields"] = "id,name";

            $result = $this->filterList($api, $args);

            if (!empty($result["records"][0])) {
                $results[] = $result["records"][0];
            }
        }

        return $results;
    }
}