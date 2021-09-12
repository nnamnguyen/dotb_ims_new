<?php



/*

Modification information for LGPL compliance

r56990 - 2010-06-16 13:05:36 -0700 (Wed, 16 Jun 2010) - kjing - snapshot "Mango" svn branch to a new one for GitHub sync

r56989 - 2010-06-16 13:01:33 -0700 (Wed, 16 Jun 2010) - kjing - defunt "Mango" svn dev branch before github cutover

r55980 - 2010-04-19 13:31:28 -0700 (Mon, 19 Apr 2010) - kjing - create Mango (6.1) based on windex

r51719 - 2009-10-22 10:18:00 -0700 (Thu, 22 Oct 2009) - mitani - Converted to Build 3  tags and updated the build system

r51634 - 2009-10-19 13:32:22 -0700 (Mon, 19 Oct 2009) - mitani - Windex is the branch for Dotb Sales 1.0 development

r50752 - 2009-09-10 15:18:28 -0700 (Thu, 10 Sep 2009) - dwong - Merged branches/tokyo from revision 50372 to 50729 to branches/kobe2
Discard lzhang r50568 changes in Email.php and corresponding en_us.lang.php

r50375 - 2009-08-24 18:07:43 -0700 (Mon, 24 Aug 2009) - dwong - branch kobe2 from tokyo r50372

r46741 - 2009-05-01 06:25:44 -0700 (Fri, 01 May 2009) - roger - PRO tagging.

r45148 - 2009-03-16 07:43:29 -0700 (Mon, 16 Mar 2009) - clee - Bug:28522
There were several issues with the code to select teams as well as the quicksearch code.  The main issues for the teams selection was that the fields all share the same name and the elements were not being properly selected within the javascript code.
include/EditView/EditView2.php
include/generic/DotbWidgets/DotbWidgetSubpanelTopButtonQuickCreate.php
include/generic/DotbWidgets/DotbWidgetSubpanelTopCreateNoteButton.php
include/generic/DotbWidgets/DotbWidgetSubpanelTopCreateTaskButton.php
include/generic/DotbWidgets/DotbWidgetSubpanelTopScheduleCallButton.php
include/generic/DotbWidgets/DotbWidgetSubpanelTopScheduleMeetingButton.php
include/javascript/dotb_3.js
include/SearchForm/tpls/header.tpl
include/DotbSmarty/plugins/function.dotb_button.php
include/DotbSmarty/plugins/function.dotbvar_teamset.php
include/DotbFields/Fields/Collection/ViewDotbFieldCollection.php
include/DotbFields/Fields/Collection/CollectionEditView.tpl
include/DotbFields/Fields/Collection/DotbFieldCollection.js
include/DotbFields/Fields/Teamset/DotbFieldTeamset.php
include/DotbFields/Fields/Teamset/ViewDotbFieldTeamsetCollection.php
include/DotbFields/Fields/Teamset/Teamset.js
include/DotbFields/Fields/Teamset/TeamsetCollectionEditView.tpl
include/DotbFields/Fields/TeamsetCollectionMassupdateView.tpl
include/DotbFields/Fields/Teamset/TeamsetCollectionSearchView.tpl
include/TemplateHandler/TemplateHandler.php
modules/Teams/TeamSetManager.php
themes/default/IE7.js
Removed:
include/DotbFields/Fields/Teamset/TeamsetCollectionQuickCreateView.tpl

r44915 - 2009-03-09 11:58:23 -0700 (Mon, 09 Mar 2009) - roger - changes to remove the ajax call from the team widget.

r44310 - 2009-02-20 10:04:55 -0800 (Fri, 20 Feb 2009) - roger - fix bug with comma delimited team names.

r44105 - 2009-02-13 11:19:44 -0800 (Fri, 13 Feb 2009) - roger - hanlde showing the user name if we encounter a private team.

r43362 - 2009-01-19 13:12:00 -0800 (Mon, 19 Jan 2009) - roger -
r42807 - 2008-12-29 11:16:59 -0800 (Mon, 29 Dec 2008) - dwong - Branch from trunk/dotbcrm r42806 to branches/tokyo/dotbcrm

r42627 - 2008-12-17 21:21:09 -0800 (Wed, 17 Dec 2008) - Collin Lee - Changed the teams in detail view to show a comma separated list of teams.


*/

function smarty_function_dotbvar_teamset($params, &$smarty) {
    $sfh = new DotbFieldHandler();
    $dotbField = $sfh->getDotbField('Teamset');
    return $dotbField->render($params, $smarty);
}
