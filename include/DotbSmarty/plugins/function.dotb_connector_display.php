<?php



/*

Modification information for LGPL compliance

r56990 - 2010-06-16 13:05:36 -0700 (Wed, 16 Jun 2010) - kjing - snapshot "Mango" svn branch to a new one for GitHub sync

r56989 - 2010-06-16 13:01:33 -0700 (Wed, 16 Jun 2010) - kjing - defunt "Mango" svn dev branch before github cutover

r55980 - 2010-04-19 13:31:28 -0700 (Mon, 19 Apr 2010) - kjing - create Mango (6.1) based on windex

r51719 - 2009-10-22 10:18:00 -0700 (Thu, 22 Oct 2009) - mitani - Converted to Build 3  tags and updated the build system

r51634 - 2009-10-19 13:32:22 -0700 (Mon, 19 Oct 2009) - mitani - Windex is the branch for Dotb Sales 1.0 development

r50375 - 2009-08-24 18:07:43 -0700 (Mon, 24 Aug 2009) - dwong - branch kobe2 from tokyo r50372

r44079 - 2009-02-12 22:27:15 -0800 (Thu, 12 Feb 2009) - clee - Merged Code from Solana to Tokyo and Trunk branches
Modified:
include/connectors/component.php
include/DotbSmarty/plugins/function.dotb_connector_display.php
modules/Connectors/Connector.js
modules/Connectors/connectors/filters/ext/rest/zoominfocompany/zoominfocompany.php
modules/Connectors/connectors/filters/ext/rest/zoominfoperson/zoominfoperson.php
modules/Connectors/connectors/filters/ext/soap/hoovers/hoovers.php
modules/Connectors/connectors/filters/ext/jigsaw/jigsaw.php
modules/Connectors/connectors/sources/ext/rest/zoominfoperson/vardefs.php
modules/Connectors/connectors/sources/ext/rest/zoominfoperson/zoominfoperson.php
modules/Connectors/connectors/sources/ext/soap/hoovers/vardefs.php
modules/Connectors/controller.php
modules/Connectors/language/en_us.lang.php
modules/Connectors/views/view.mappingproperties.php
modules/Connectors/views/view.retrievesource.php
Added:
include/Connectors/connectors/filters/ext/rest/zoominfocompany/zoominfocompany.php
include/Connectors/connectors/filters/ext/rest/zoominfoperson/zoominfoperson.php
include/Connectors/connectors/filters/ext/soap/hoovers/hoovers.php
include/Connectors/connectors/filters/ext/soap/jigsaw/jigsaw.php
modules/Connectors/connectors/filters/ext/rest/zoominfocompany/listviewdefs.php
modules/Connectors/connectors/filters/ext/rest/zoominfoperson/listviewdefs.php
modules/Connectors/connectors/filters/ext/soap/hoovers/listviewdefs.php
modules/Connectors/connectors/filters/ext/soap/jigsaw/listviewdefs.php

r42807 - 2008-12-29 11:16:59 -0800 (Mon, 29 Dec 2008) - dwong - Branch from trunk/dotbcrm r42806 to branches/tokyo/dotbcrm

r42645 - 2008-12-18 13:41:08 -0800 (Thu, 18 Dec 2008) - awu - merging maint_5_2_0 rev41336:HEAD to trunk

r42562 - 2008-12-15 17:54:57 -0800 (Mon, 15 Dec 2008) - dwong - create branches/maint_5_2_0 from branches/milan r42559

r42508 - 2008-12-11 14:59:33 -0800 (Thu, 11 Dec 2008) - Collin Lee - Updated license information  and emoved Wrapper components (we decided to not have these components awhile back).

r41724 - 2008-11-13 08:55:42 -0800 (Thu, 13 Nov 2008) - Collin Lee - Made changes to rename DataSource module and components to Connectors.


*/

function smarty_function_dotb_connector_display($params, &$smarty)
{
    $bean = $params['bean'];
    $field = $params['field'];
    $type = $bean->field_defs[$field]['type'];
    if($type == 'text') {
       echo strlen($bean->$field) > 50 ? substr($bean->$field, 0, 47) . '...' : $bean->field;
    } else if($type == 'link') {
       echo "<a href='{$bean->$field}' target='_blank'>{$bean->$field}</a>";
    } else {
       echo $bean->$field;
    }
}

