<?php

/*

Modification information for LGPL compliance

r56990 - 2010-06-16 13:05:36 -0700 (Wed, 16 Jun 2010) - kjing - snapshot "Mango" svn branch to a new one for GitHub sync

r56989 - 2010-06-16 13:01:33 -0700 (Wed, 16 Jun 2010) - kjing - defunt "Mango" svn dev branch before github cutover

r55980 - 2010-04-19 13:31:28 -0700 (Mon, 19 Apr 2010) - kjing - create Mango (6.1) based on windex

r51719 - 2009-10-22 10:18:00 -0700 (Thu, 22 Oct 2009) - mitani - Converted to Build 3  tags and updated the build system 

r51634 - 2009-10-19 13:32:22 -0700 (Mon, 19 Oct 2009) - mitani - Windex is the branch for Dotb Sales 1.0 development

r50375 - 2009-08-24 18:07:43 -0700 (Mon, 24 Aug 2009) - dwong - branch kobe2 from tokyo r50372

r42807 - 2008-12-29 11:16:59 -0800 (Mon, 29 Dec 2008) - dwong - Branch from trunk/dotbcrm r42806 to branches/tokyo/dotbcrm

r10971 - 2006-01-12 14:58:30 -0800 (Thu, 12 Jan 2006) - chris - Bug 4128: updating Smarty templates to 2.6.11, a version supposedly that plays better with PHP 5.1

r8230 - 2005-10-03 17:47:19 -0700 (Mon, 03 Oct 2005) - majed - Added Dotb_Smarty to the code tree.


*/


/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * determines if a resource is trusted or not
 *
 * @param string $resource_type
 * @param string $resource_name
 * @return boolean
 */

 // $resource_type, $resource_name

function smarty_core_is_trusted($params, &$smarty)
{
    $_smarty_trusted = false;
    if ($params['resource_type'] == 'file') {
        if (!empty($smarty->trusted_dir)) {
            $_rp = realpath($params['resource_name']);
            foreach ((array)$smarty->trusted_dir as $curr_dir) {
                if (!empty($curr_dir) && is_readable ($curr_dir)) {
                    $_cd = realpath($curr_dir);
                    if (strncmp($_rp, $_cd, strlen($_cd)) == 0
                        && substr($_rp, strlen($_cd), 1) == DIRECTORY_SEPARATOR ) {
                        $_smarty_trusted = true;
                        break;
                    }
                }
            }
        }

    } else {
        // resource is not on local file system
        $_smarty_trusted = call_user_func_array($smarty->_plugins['resource'][$params['resource_type']][0][3],
                                                array($params['resource_name'], $smarty));
    }

    return $_smarty_trusted;
}

/* vim: set expandtab: */

?>
