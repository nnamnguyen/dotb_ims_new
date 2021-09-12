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
 * @package FTE Usage Tracking
 */

class LogStatsApi extends DotbApi
{

    private $dataSkeleton = [
        "totalLogons" => [
            "number"=>0,
            "css_class"=>""
        ],
        "mobileLogons" => [
            "number"=>0,
            "css_class"=>""
        ],
        "lastLogon" => [
            "label"=>"-",
            "css_class"=>""
        ],
        "totalCrudActions" => [
            "number"=> 0,
            "css_class"=>""
        ],
        "reportedActions" => [
            'create_contact' =>
                [
                    "name" => "LBL_CREATED_CONTACT",
                    "completed" => 0
                ],
            'create_account' =>
                [
                    "name" => "LBL_CREATED_ACCOUNT",
                    "completed" => 0
                ],
            'create_dashboard' =>
                [
                    "name" => "LBL_CREATED_DASHBOARD",
                    "completed" => 0
                ],
            'create_interaction' =>
                [
                    "name" => "LBL_CREATED_INTERACTION",
                    "completed" => 0
                ],
            'create_lead' =>
                [
                    "name" => "LBL_CREATED_LEAD",
                    "completed" => 0
                ],
            'create_opportunity' =>
                [
                    "name" => "LBL_CREATED_OPPORTUNITY",
                    "completed" => 0
                ],
            'create_quote' =>
                [
                    "name" => "LBL_CREATED_QUOTE",
                    "completed" => 0
                ],
            'create_rli' =>
                [
                    "name" => "LBL_CREATED_RLI",
                    "completed" => 0
                ],
            'create_case' =>
                [
                    "name" => "LBL_CREATED_CASE",
                    "completed" => 0
                ]
        ]
    ];

    public function registerApiRest()
    {
        return array(
            'logstats' => array(
                'reqType' => 'GET',
                'path' => array('logstats'),
                'pathVars' => array(''),
                'method' => 'logstats',
                'shortHelp' => 'Logs Statistics',
                'longHelp' => 'Fetches data such as number of CRUD operations or number of total logons on a particular instance.',
                'noLoginRequired' => true,
            ),
        );
    }

    public function logstats(ServiceBase $api, array $args)
    {
        $bean = BeanFactory::newBean('fte_UsageTracking');
        $actions = $this->getGroupedActions($bean);

        foreach ($actions as $action) {
            if ($action['action'] == "Login") {
                $this->dataSkeleton['totalLogons']['number'] += $action['number'];
            }

            if ($action['action'] == "Login" && $action['platform'] == "Mobile") {
                $this->dataSkeleton['mobileLogons']['number'] += $action['number'];
            }

            if (in_array($action['action'], ['Create', 'Delete', 'Update'])) {
                $this->dataSkeleton['totalCrudActions']['number'] += $action['number'];
            }

            if ($action['action'] === "Create" && $action['parent_type'] == "Contacts") {
                $this->dataSkeleton['reportedActions']['create_contact']['completed'] = 1;
            }
            if ($action['action'] === "Create" && $action['parent_type'] == "Accounts") {
                $this->dataSkeleton['reportedActions']['create_account']['completed'] = 1;
            }
            if ($action['action'] === "Create" && $action['parent_type'] == "Dashboards") {
                $this->dataSkeleton['reportedActions']['create_dashboard']['completed'] = 1;
            }
            if ($action['action'] === "Create" && in_array($action['parent_type'], ["Tasks", "Cases", "Meetings"])) {
                $this->dataSkeleton['reportedActions']['create_interaction']['completed'] = 1;
            }
            if ($action['action'] === "Create" && $action['parent_type'] == "Leads") {
                $this->dataSkeleton['reportedActions']['create_lead']['completed'] = 1;
            }
            if ($action['action'] === "Create" && $action['parent_type'] == "Opportunities") {
                $this->dataSkeleton['reportedActions']['create_opportunity']['completed'] = 1;
            }
            if ($action['action'] === "Create" && $action['parent_type'] == "Quotes") {
                $this->dataSkeleton['reportedActions']['create_quote']['completed'] = 1;
            }
            if ($action['action'] === "Create" && $action['parent_type'] == "Cases") {
                $this->dataSkeleton['reportedActions']['create_case']['completed'] = 1;
            }
            if ($action['action'] === "Create" && $action['parent_type'] == "RevenueLineItems") {
                $this->dataSkeleton['reportedActions']['create_rli']['completed'] = 1;
            }
        }

        $this->addCssClasses();

        $this->calculateLastLogon($bean);

        return $this->dataSkeleton;
    }

    protected function calculateLastLogon($bean){
        $lastLogin = $this->getLastLogin($bean);

        $tz_utc = new DateTimeZone("UTC");

        $lastLogon = new DateTime($lastLogin[0]['date_entered'], $tz_utc);
        $current = new DateTime('now', $tz_utc);

        $difference = $current->diff($lastLogon);

        $m = $difference->format("%i");
        $h = $difference->format("%h");
        $d = $difference->format("%a");

        $diff = "";

        if($d > 0) {
            $diff .= $d."d ";
        }
        if($h > 0) {
            $diff .= $h."h ";
        }

        if($m > 0) {
            $diff .= $m."m ";
        }

        $this->dataSkeleton["lastLogon"]['label'] = $diff != "" ? trim($diff) : "-";
        $this->dataSkeleton['lastLogon']['css_class'] = (($d > 3 || $this->dataSkeleton["lastLogon"]['label'] == "-") ? "text-red" : ($d >2 ? "text-amber" : "text-green"));
    }

    protected function addCssClasses(){
        $this->dataSkeleton['totalLogons']['css_class'] = ($this->dataSkeleton['totalLogons']['number'] < 2 ? "text-red" : ($this->dataSkeleton['totalLogons']['number'] < 4 ? "text-amber" : "text-green"));
        $this->dataSkeleton['mobileLogons']['css_class'] = ($this->dataSkeleton['mobileLogons']['number'] < 2 ? "text-red" : ($this->dataSkeleton['mobileLogons']['number'] < 3 ? "text-amber" : "text-green"));
    }


    private function getGroupedActions($bean)
    {
        $query = new DotbQuery();
        $query->from($bean)
            ->select(["action", "parent_type", "platform"])
            ->fieldRaw("count(".$bean->table_name.".id) as number");

        $query = $this->addUsersConstraint($query);

        $query->groupBy("action");
        $query->groupBy("platform");
        $query->groupBy("parent_type");

        $result = $query->execute();
        return $result;
    }

    private function getLastLogin($bean)
    {
        $query = new DotbQuery();
        $query->from($bean)
            ->select(["date_entered", 'parent_name']);
        $query->where()->equals("action", "Login");

        $query = $this->addUsersConstraint($query);

        $query->orderBy("date_entered", "DESC");
        $query->limit(1);

        $result = $query->execute();

        return $result;
    }

    protected function addUsersConstraint($query){

        $blacklistedUsers = $query->from->config['non_tracked_users_ids'];

        if(count($blacklistedUsers) > 1){
            $query->where()->notIn('created_by', $blacklistedUsers);
        }
        else if(count($blacklistedUsers) == 1){
            $query->where()->notEquals("created_by", $blacklistedUsers[0]);
        }

        return $query;
    }
}
