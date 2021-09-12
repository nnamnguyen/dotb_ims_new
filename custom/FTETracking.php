<?php

/**
 * Your installation or use of this DotBCRM file is subject to the applicable
 * terms available at
 * http://support.dotbcrm.com/06_Customer_Center/10_Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this DotBCRM file.
 *
 * Copyright (C) DotBCRM Inc. All rights reserved.
 *
 * @package FTE_Tracking
 */
class FTETracking
{

    /*
     * @param array $args set of arguments for tracking bean
     *
     */

    public static function logAction($args){
        $tracking = BeanFactory::getBean("fte_UsageTracking");

        foreach($args as $key => $value){
            $tracking->$key = $value;
        }

        if(empty($tracking->action_identifier)){
            throw new DotbApiExceptionInvalidParameter("Action Identifier is required!");
        }

        if(empty($tracking->action)){
            throw new DotbApiExceptionInvalidParameter("Action is required!");
        }

        $tracking->save();
    }
}