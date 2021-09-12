<?php

/*
 * This is the array that is used to determine how to group/concatenate js files together
 * The format is to define the location of the file to be concatenated as the array element key
 * and the location of the file to be created that holds the child files as the array element value.
 * So: $original_file_location => $Concatenated_file_location
 *
 * If you wish to add a grouping that contains a file that is part of another group already,
 * add a '.' after the .js in order to make the element key unique.  Make sure you pare the extension out
 *
 */
if (!function_exists('getSubgroupForTarget')) {
    /**
     * Helper to allow for getting sub groups of combinations of includes that are likely to be required by
     * many clients (so that we don't end up with duplication from client to client).
     * @param string $subGroup The sub-group
     * @param string $target The target file to point to e.g. '<app>/<app>.min.js',
     * @return array array of key vals where the keys are source files and values are the $target passed in.
     */
    function getSubgroupForTarget($subGroup, $target)
    {
        // Add more sub-groups as needed here if client include duplication in $js_groupings
        switch ($subGroup) {
            case 'bootstrap':
                return array(
                    'include/javascript/twitterbootstrap/transition.js' => $target,
                    'include/javascript/twitterbootstrap/bootstrap-button.js' => $target,
                    'include/javascript/twitterbootstrap/bootstrap-tooltip.js' => $target,
                    'include/javascript/twitterbootstrap/bootstrap-dropdown.js' => $target,
                    'include/javascript/twitterbootstrap/bootstrap-popover.js' => $target,
                    'include/javascript/twitterbootstrap/bootstrap-modal.js' => $target,
                    'include/javascript/twitterbootstrap/bootstrap-alert.js' => $target,
                    'include/javascript/twitterbootstrap/bootstrap-datepicker.js' => $target,
                    'include/javascript/twitterbootstrap/bootstrap-tab.js' => $target,
                    'include/javascript/twitterbootstrap/bootstrap-collapse.js' => $target,
                    'include/javascript/twitterbootstrap/bootstrap-colorpicker.js' => $target,
                );
                break;
            case 'bootstrap_core':
                return array(
                    'include/javascript/jquery/bootstrap/bootstrap.min.js' => $target,
                    'include/javascript/jquery/jquery.popoverext.js' => $target,
                );
                break;
            case 'jquery_core':
                return array(
                    'include/javascript/jquery/jquery-min.js' => $target,
                    'include/javascript/jquery/jquery-ui-min.js' => $target,
                    'include/javascript/jquery/jquery.json-2.3.js' => $target,
                    'include/javascript/jquery/jquery-migrate-1.4.1.min.js' => $target,
                );
                break;
            case 'jquery_menus':
                return array(
                    'include/javascript/jquery/jquery.hoverIntent.js' => $target,
                    'include/javascript/jquery/jquery.hoverscroll.js' => $target,
                    'include/javascript/jquery/jquery.hotkeys.js' => $target,
                    'include/javascript/jquery/jquery.tipTip.js' => $target,
                    'include/javascript/jquery/jquery.dotbMenu.js' => $target,
                    'include/javascript/jquery/jquery.highLight.js' => $target,
                    'include/javascript/jquery/jquery.showLoading.js' => $target,
                    'include/javascript/jquery/jquery.jstree.js' => $target,
                    'include/javascript/jquery/jquery.dataTables.min.js' => $target,
                    'include/javascript/jquery/jquery.dataTables.customSort.js' => $target,
                    'include/javascript/jquery/jquery.jeditable.js' => $target,
                );
                break;
            default:
                break;
        }
    }
}
$calendarJSFileName = file_exists('custom/include/javascript/calendar.js') ?
    'custom/include/javascript/calendar.js' : 'include/javascript/calendar.js';
$js_groupings = array(
    $dotb_grp1 = array(
        //scripts loaded on first page
        'lumia/node_modules/underscore/underscore-min.js' => 'javascript/dotbcrm1.js',
        'include/javascript/dotb_3.js' => 'javascript/dotbcrm1.min.js',
        'include/javascript/ajaxUI.js' => 'javascript/dotbcrm1.min.js',
        'include/javascript/cookie.js' => 'javascript/dotbcrm1.min.js',
        'include/javascript/menu.js' => 'javascript/dotbcrm1.min.js',
        $calendarJSFileName => 'javascript/dotbcrm1.min.js',
        'include/javascript/quickCompose.js' => 'javascript/dotbcrm1.min.js',
        'include/javascript/yui/build/yuiloader/yuiloader-min.js' => 'javascript/dotbcrm1.min.js',
        //HTML decode
        'include/javascript/phpjs/license.js' => 'javascript/dotbcrm1.min.js',
        'include/javascript/phpjs/get_html_translation_table.js' => 'javascript/dotbcrm1.min.js',
        'include/javascript/phpjs/html_entity_decode.js' => 'javascript/dotbcrm1.min.js',
        'include/javascript/phpjs/htmlentities.js' => 'javascript/dotbcrm1.min.js',
        //Expression Engine
        'lumia/lib/dotblogic/expressions.js' => 'javascript/dotbcrm1.min.js',
        'include/Expressions/javascript/dependency.js' => 'javascript/dotbcrm1.min.js',
        'include/EditView/Panels.js' => 'javascript/dotbcrm1.min.js',
    ),

    //core app jquery libraries
    $dotb_grp_jquery = array_merge(getSubgroupForTarget('jquery_core', 'javascript/dotbcrm2.min.js'),
        getSubgroupForTarget('bootstrap_core', 'javascript/dotbcrm2.min.js'),
        getSubgroupForTarget('jquery_menus', 'javascript/dotbcrm2.min.js')
    ),

    $dotb_grp1_yui = array(
        //YUI scripts loaded on first page
        'include/javascript/yui3/build/yui/yui-min.js' => 'javascript/dotbcrm3.min.js',
        'include/javascript/yui3/build/loader/loader-min.js' => 'javascript/dotbcrm3.min.js',
        'include/javascript/yui/build/yahoo/yahoo-min.js' => 'javascript/dotbcrm3.min.js',
        'include/javascript/yui/build/dom/dom-min.js' => 'javascript/dotbcrm3.min.js',
        'include/javascript/yui/build/yahoo-dom-event/yahoo-dom-event.js'
        => 'javascript/dotbcrm3.min.js',
        'include/javascript/yui/build/event/event-min.js' => 'javascript/dotbcrm3.min.js',
        'include/javascript/yui/build/logger/logger-min.js' => 'javascript/dotbcrm3.min.js',
        'include/javascript/yui/build/animation/animation-min.js' => 'javascript/dotbcrm3.min.js',
        'include/javascript/yui/build/connection/connection-min.js' => 'javascript/dotbcrm3.min.js',
        'include/javascript/yui/build/dragdrop/dragdrop-min.js' => 'javascript/dotbcrm3.min.js',
        //Ensure we grad the SLIDETOP custom container animation
        'include/javascript/yui/build/container/container-min.js' => 'javascript/dotbcrm3.min.js',
        'include/javascript/yui/build/element/element-min.js' => 'javascript/dotbcrm3.min.js',
        'include/javascript/yui/build/tabview/tabview-min.js' => 'javascript/dotbcrm3.min.js',
        'include/javascript/yui/build/selector/selector.js' => 'javascript/dotbcrm3.min.js',
        //This should probably be removed as it is not often used with the rest of YUI
        'include/javascript/yui/ygDDList.js' => 'javascript/dotbcrm3.min.js',
        //YUI based quicksearch
        'include/javascript/yui/build/datasource/datasource-min.js' => 'javascript/dotbcrm3.min.js',
        'include/javascript/yui/build/json/json-min.js' => 'javascript/dotbcrm3.min.js',
        'include/javascript/yui/build/autocomplete/autocomplete-min.js' => 'javascript/dotbcrm3.min.js',
        'include/javascript/quicksearch.js' => 'javascript/dotbcrm3.min.js',
        'include/javascript/yui/build/menu/menu-min.js' => 'javascript/dotbcrm3.min.js',
        'include/javascript/dotb_connection_event_listener.js' => 'javascript/dotbcrm3.min.js',
        'include/javascript/yui/build/calendar/calendar.js' => 'javascript/dotbcrm3.min.js',
        'include/javascript/yui/build/history/history.js' => 'javascript/dotbcrm3.min.js',
        'include/javascript/yui/build/resize/resize-min.js' => 'javascript/dotbcrm3.min.js',
    ),

    $dotb_grp_yui_widgets = array(
        //dotb_grp1_yui must be laoded before dotb_grp_yui_widgets
        'include/javascript/yui/build/datatable/datatable-min.js' => 'javascript/dotbcrm12.min.js',
        'include/javascript/yui/build/treeview/treeview-min.js' => 'javascript/dotbcrm12.min.js',
        'include/javascript/yui/build/button/button-min.js' => 'javascript/dotbcrm12.min.js',
        'include/javascript/yui/build/calendar/calendar-min.js' => 'javascript/dotbcrm12.min.js',
        'include/javascript/dotbwidgets/DotbYUIWidgets.js' => 'javascript/dotbcrm12.min.js',
        // Include any Dotb overrides done to YUI libs for bugfixes
        'include/javascript/dotb_yui_overrides.js' => 'javascript/dotbcrm12.min.js',
    ),

    $dotb_grp_yui2 = array(
        //YUI combination 2
        'include/javascript/yui/build/dragdrop/dragdrop-min.js' => 'javascript/dotbcrm13.min.js',
        'include/javascript/yui/build/container/container-min.js' => 'javascript/dotbcrm13.min.js',
    ),

    //Grouping for emails module.
    $dotb_grp_emails = array(
        'include/javascript/yui/ygDDList.js' => 'javascript/dotbcrm14.min.js',
        'include/DotbEmailAddress/DotbEmailAddress.js' => 'javascript/dotbcrm14.min.js',
        'include/DotbFields/Fields/Collection/DotbFieldCollection.js' => 'javascript/dotbcrm14.min.js',
        'include/DotbRouting/javascript/DotbRouting.js' => 'javascript/dotbcrm14.min.js',
        'include/DotbDependentDropdown/javascript/DotbDependentDropdown.js' => 'javascript/dotbcrm14.min.js',
        'modules/InboundEmail/InboundEmail.js' => 'javascript/dotbcrm14.min.js',
        'modules/Emails/javascript/EmailUIShared.js' => 'javascript/dotbcrm14.min.js',
        'modules/Emails/javascript/EmailUI.js' => 'javascript/dotbcrm14.min.js',
        'modules/Emails/javascript/EmailUICompose.js' => 'javascript/dotbcrm14.min.js',
        'modules/Emails/javascript/ajax.js' => 'javascript/dotbcrm14.min.js',
        'modules/Emails/javascript/grid.js' => 'javascript/dotbcrm14.min.js',
        'modules/Emails/javascript/init.js' => 'javascript/dotbcrm14.min.js',
        'modules/Emails/javascript/complexLayout.js' => 'javascript/dotbcrm14.min.js',
        'modules/Emails/javascript/composeEmailTemplate.js' => 'javascript/dotbcrm14.min.js',
        'modules/Emails/javascript/displayOneEmailTemplate.js' => 'javascript/dotbcrm14.min.js',
        'modules/Emails/javascript/viewPrintable.js' => 'javascript/dotbcrm14.min.js',
        'include/javascript/quicksearch.js' => 'javascript/dotbcrm14.min.js',

    ),

    //Grouping for the quick compose functionality.
    $dotb_grp_quick_compose = array(
        'include/javascript/jsclass_base.js' => 'javascript/dotbcrm15.min.js',
        'include/javascript/jsclass_async.js' => 'javascript/dotbcrm15.min.js',
        'modules/Emails/javascript/vars.js' => 'javascript/dotbcrm15.min.js',
        'include/DotbFields/Fields/Collection/DotbFieldCollection.js' => 'javascript/dotbcrm15.min.js', //For team selection
        'modules/Emails/javascript/EmailUIShared.js' => 'javascript/dotbcrm15.min.js',
        'modules/Emails/javascript/ajax.js' => 'javascript/dotbcrm15.min.js',
        'modules/Emails/javascript/grid.js' => 'javascript/dotbcrm15.min.js', //For address book
        'modules/Emails/javascript/EmailUICompose.js' => 'javascript/dotbcrm15.min.js',
        'modules/Emails/javascript/composeEmailTemplate.js' => 'javascript/dotbcrm15.min.js',
        'modules/Emails/javascript/complexLayout.js' => 'javascript/dotbcrm15.min.js',
    ),
    $dotb_grp_lumia = array_merge(
        array(
            'include/javascript/phpjs/base64_encode.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/jquery/jquery-ui-min.js' => 'javascript/dotbcrm.min.js',
        ),
        getSubgroupForTarget('bootstrap', 'javascript/dotbcrm.min.js'),
        array(
            // D3 (version 4.x) library custom bundle
            // with only modules for main dotb chart types
            'include/javascript/d3-dotb/d3-dotb.min.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/sucrose/sucrose.min.js' => 'javascript/dotbcrm.min.js',
            'include/DotbCharts/sucrose/js/dotbCharts.js' => 'javascript/dotbcrm.min.js',
            // D3 (version 3.x) entire library
            'include/javascript/nvd3/lib/d3.min.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/nvd3/nv.d3.min.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/error.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/touch.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/select2/select2.js' => 'javascript/dotbcrm.min.js',
            //To fix some issues on select2 plugin.
            'include/javascript/dotb7/plugins/Select2.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/jquery/jquery.timepicker.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/jquery/jquery.jstree.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/jquery/jstree.state.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/jquery/jquery.popoverext.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/jquery/jquery.nouislider.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/nprogress/nprogress.js' => 'javascript/dotbcrm.min.js',

            'include/javascript/select2/language.js' => 'javascript/dotbcrm.min.js',
            'lumia/node_modules/moment/min/locales.min.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/favicon.js' => 'javascript/dotbcrm.min.js',

            //Expression Engine
            'lumia/lib/dotblogic/expressions.js' => 'javascript/dotbcrm.min.js',
            'lumia/lib/dotblogic/lumiaExpressionContext.js' => 'javascript/dotbcrm.min.js',

            // Plugins for Dotb 7.
            'include/javascript/dotb7/plugins/FieldErrorCollection.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/Dashlet.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/Connector.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/Audit.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/CommittedDeleteWarning.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/FindDuplicates.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/MergeDuplicates.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/DragdropAttachments.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/FileDragoff.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/Dropdown.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/ListColumnEllipsis.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/MassCollection.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/Pii.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/ReorderableColumns.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/jquery/jquery.rtl-scroll.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/jquery/dotb.resizableColumns.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/ResizableColumns.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/ToggleMoreLess.js' => 'javascript/dotbcrm.min.js',
            'modules/Contacts/clients/base/plugins/ContactsPortalMetadataFilter.js' => 'javascript/dotbcrm.min.js',
            'modules/pmse_Inbox/clients/base/plugins/ProcessActions.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/HistoricalSummary.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/MetadataEventDriven.js' =>
                'javascript/dotbcrm.min.js',
            //load SFA specific plugins. Remove this in favor of a custom plugin loader.
            'modules/Forecasts/clients/base/plugins/DisableDelete.js' => 'javascript/dotbcrm.min.js',
            'modules/Forecasts/clients/base/plugins/DisableMassDelete.js' => 'javascript/dotbcrm.min.js',
            'modules/Quotes/clients/base/plugins/QuotesLineNumHelper.js' => 'javascript/dotbcrm.min.js',
            'modules/Quotes/clients/base/plugins/QuotesViewSaveHelper.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/MassQuote.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/Taggable.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/RelativeTime.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/ErrorDecoration.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/ClickToEdit.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/GridBuilder.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/ListDisableSort.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/Editable.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/ListEditable.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/ListRemoveLinks.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/File.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/FieldDuplicate.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/LinkedModel.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/ToggleVisibility.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/Pagination.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/ShortcutSession.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/CanvasDataRenderer.js' => 'javascript/dotbcrm.min.js',
            'modules/Categories/clients/base/plugins/JSTree.js' => 'javascript/dotbcrm.min.js',
            // Support Portal features for Dotb7
            'modules/Contacts/clients/base/lib/bean.js' => 'javascript/dotbcrm.min.js',
            'modules/Categories/clients/base/plugins/NestedSetCollection.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/DirtyCollection.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/Prettify.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/Chart.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/EmailClientLaunch.js' => 'javascript/dotbcrm.min.js',
            'modules/KBContents/clients/base/plugins/KBContent.js' => 'javascript/dotbcrm.min.js',
            'modules/Teams/clients/base/plugins/TbACLs.js' => 'javascript/dotbcrm.min.js',
            'modules/KBContents/clients/base/plugins/KBNotify.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/Tinymce.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/VirtualCollection.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/SearchForMore.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/EditAllRecurrences.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/AddAsInvitee.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/DragdropSelect2.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/ReminderTimeDefaults.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/CollectionFieldLoadAll.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/dotb7/plugins/EmailParticipants.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/fuse/fuse.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/tinymce4/jquery.tinymce.min.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/mousetrap/mousetrap.min.js' => 'javascript/dotbcrm.min.js',
            'include/javascript/clipboardjs/clipboard.min.js' => 'javascript/dotbcrm.min.js',
        )
    ),

    $dotb_grp_dotb7 = array(
        'include/javascript/dotb7.js' => 'javascript/dotbcrm7.min.js',
        'include/javascript/dotb7/tutorial.js' => 'javascript/dotbcrm7.min.js',
        'include/javascript/dotb7/bwc.js' => 'javascript/dotbcrm7.min.js',
        'include/javascript/dotb7/utils.js' => 'javascript/dotbcrm7.min.js',
        'include/javascript/dotb7/utils-filters.js' => 'javascript/dotbcrm7.min.js',
        'include/javascript/dotb7/utils-search.js' => 'javascript/dotbcrm7.min.js',
        'include/javascript/dotb7/field.js' => 'javascript/dotbcrm7.min.js',
        'include/javascript/dotb7/hacks.js' => 'javascript/dotbcrm7.min.js',
        'include/javascript/dotb7/alert.js' => 'javascript/dotbcrm7.min.js',
        'include/javascript/dotb7/language.js' => 'javascript/dotbcrm7.min.js',
        'include/javascript/dotb7/help.js' => 'javascript/dotbcrm7.min.js',
        'include/javascript/dotb7/hbs-helpers.js' => 'javascript/dotbcrm7.min.js',
        'include/javascript/dotb7/underscore-mixins.js' => 'javascript/dotbcrm7.min.js',
        'include/javascript/dotb7/filter-analytics.js' => 'javascript/dotbcrm7.min.js',
        'include/javascript/dotb7/metadata-manager.js' => 'javascript/dotbcrm7.min.js',
        'include/javascript/dotb7/sweetspot.js' => 'javascript/dotbcrm7.min.js',
        'include/javascript/dotb7/tooltip.js' => 'javascript/dotbcrm7.min.js',
        'include/javascript/dotb7/import-export-warnings.js' => 'javascript/dotbcrm7.min.js',
        'include/javascript/dotb7/shortcuts.js' => 'javascript/dotbcrm7.min.js',
        'include/javascript/dotb7/accessibility/accessibility.js' => 'javascript/dotbcrm7.min.js',
        'include/javascript/dotb7/accessibility/click.js' => 'javascript/dotbcrm7.min.js',
        'include/javascript/dotb7/accessibility/label.js' => 'javascript/dotbcrm7.min.js',
        'include/javascript/dotb7/clipboard.js' => 'javascript/dotbcrm7.min.js',
    ),

    $dotb_grp_portal2 = array(
        'portal2/lib/dotb.searchahead.js' => 'portal2/portal.min.js',
        'portal2/error.js' => 'portal2/portal.min.js',
        'portal2/user.js' => 'portal2/portal.min.js',
        'portal2/portal.js' => 'portal2/portal.min.js',
    ),

    $dotb_grp_dotb7_portal2 = array(
        'include/javascript/dotb7/tutorial.js' => 'portal2/dotb_portal.min.js',
        'include/javascript/dotb7/utils.js' => 'portal2/dotb_portal.min.js',
        'include/javascript/dotb7/utils-filters.js' => 'portal2/dotb_portal.min.js',
        'include/javascript/dotb7/field.js' => 'portal2/dotb_portal.min.js',
        'include/javascript/dotb7/hacks.js' => 'portal2/dotb_portal.min.js',
        'include/javascript/dotb7/alert.js' => 'portal2/dotb_portal.min.js',
        'include/javascript/dotb7/hbs-helpers.js' => 'portal2/dotb_portal.min.js',
        'include/javascript/dotb7/language.js' => 'portal2/dotb_portal.min.js',
        'include/javascript/dotb7/accessibility/accessibility.js' => 'portal2/dotb_portal.min.js',
        'include/javascript/dotb7/accessibility/click.js' => 'portal2/dotb_portal.min.js',
        'include/javascript/dotb7/accessibility/label.js' => 'portal2/dotb_portal.min.js',
        'custom/include/javascript/voodoo.js' => 'portal2/dotb_portal.min.js',
        'include/javascript/dotb7/shortcuts.js' => 'portal2/dotb_portal.min.js',
        'include/javascript/dotb7/clipboard.js' => 'portal2/dotb_portal.min.js',
    ),

    $pmse_designer = array(
        'include/javascript/pmse/utils.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/lib/jcore.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/utils.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/style.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/arraylist.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/base.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/modal.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/proxy.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/element.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/element_helper.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/container.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/window.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/action.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/menu.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/item.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/checkbox_item.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/separator_item.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/menu_item.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/layout.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/tooltip.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/panel.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/form.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/field.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/validator.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/validator_types.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/field_types.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/button.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/rest_proxy.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/dotb_proxy.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/item_matrix.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/item_updater.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/html_panel.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/store.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/grid.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/history_panel.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/log_field.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/message_panel.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/updater_field.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/note_panel.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/reassign_field.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/reassign_form.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/data_item.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/single_item.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/list_item.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/item_container_control.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/field_panel_item.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/field_panel_button.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/field_panel_button_group.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/collapsible_panel.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/form_panel.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/list_panel.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/multiple_collapsible_panel.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/field_panel_item_factory.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/field_panel.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/multiple_item.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/email_picker.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/expression_builder2.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/criteria_field.js' => 'javascript/dotbcrm9.min.js',
        // Since there won't be a js for BR anymore, its files
        'include/javascript/pmse/ui/expression_container.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/decision_table.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/close_list_item.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ui/dropdown_selector.js' => 'javascript/dotbcrm9.min.js',
        // files under the modules/pmse_Inbox/js/ folder
        'modules/pmse_Inbox/js/formAction.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/lib/jquery.layout-latest.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/tree.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/drag_behavior.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/drop_behavior.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/shapes.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/flow.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/command.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/command_annotation_resize.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/command_single_property.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/container_behavior.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/resize_behavior.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/project.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/canvas.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/marker.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/event.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/gateway.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/activity.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/artifact.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/properties_grid.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/artifact_resize_behavior.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/command_default_flow.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/command_connection_condition.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/command_reconnect.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/pmtree.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/progrid.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ErrorMessageItem.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ListContainer.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ErrorListItem.js' => 'javascript/dotbcrm9.min.js',
        'include/javascript/pmse/ErrorListPanel.js' => 'javascript/dotbcrm9.min.js',
        //including next files to original file to have one request only
        'include/javascript/pmse/designer.js' => 'javascript/dotbcrm9.min.js',
    ),

    //Grouping for TBA configuration.
    $dotb_grp_tba = array(
        'modules/Teams/javascript/TBAConfiguration.js' => 'javascript/dotbcrm11.min.js',
    ),
);

/**
 * Check for custom additions to this code
 */

if (!class_exists('DotbAutoLoader')) {
    // This block is required because this file could be called from a non-entrypoint (such as jssource/minify.php).
    require_once('include/utils/autoloader.php');
    DotbAutoLoader::init();
}

foreach (DotbAutoLoader::existing("custom/jssource/JSGroupings.php", DotbAutoLoader::loadExtension("jsgroupings")) as $file) {
    require $file;
}
