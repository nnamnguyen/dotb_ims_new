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

    $admin_option_defs = array();
    $admin_option_defs['Administration']['fte_custom_config'] = array(
        //Icon name. Available icons are located in ./themes/default/images
        'Administration',

        //Link name label
        'LBL_FTE_UT_ACTION_NAME',

        //Link description label
        'LBL_FTE_UT_ACTION_DESCRIPTION',

        //Link URL - For Lumia modules
        'javascript:parent.DOTB.App.router.navigate("fte-config", {trigger: true});',

        //Alternatively, if you are linking to BWC modules
//        './custom/move_dates.php'
    );

    $admin_group_header[] = array(
        //Section header label
        'LBL_FTE_UT_SECTION_HEADER',

        //$other_text parameter for get_form_header()
        '',

        //$show_help parameter for get_form_header()
        false,

        //Section links
        $admin_option_defs,

        //Section description label
        'LBL_FTE_UT_SECTION_DESCRIPTION'
    );
