{$chartResources}
<div id='progress_div'></div>
<script>
    document.getElementById('progress_div').innerHTML = '{dotb_getimage name="bar_loader" alt=$mod_strings.LBL_LOADING ext=".gif" other_attributes=''}';
</script>


<script type="text/javascript" src="cache/modules/modules_def_{$LANG}_{$USER_ID_MD5}.js?v=_{$ENTROPY}"></script>
{if !empty($fiscalStartDate)}
    <script type="text/javascript" src="cache/modules/modules_def_fiscal_{$LANG}_{$USER_ID_MD5}.js?v=_{$ENTROPY}"></script>
{/if}
<link rel="stylesheet" type="text/css" href="{dotb_getjspath file='vendor/ytree/TreeView/css/folders/tree.css'}"/>
<link rel="stylesheet" type="text/css" href="{dotb_getjspath file='modules/Reports/tpls/reports.css'}"/>
{dotb_getscript file="modules/Reports/javascript/reports.js"}
<script type="text/javascript" src="{dotb_getjspath file='cache/javascript/dotbcrm12.min.js'}"></script>
<script type="text/javascript" src="{dotb_getjspath file='include/javascript/FiltersWidget.js'}"></script>
<script type="text/javascript" src="{dotb_getjspath file='include/DotbFields/Fields/Teamset/Teamset.js'}"></script>
<!--Add scripts to custom Report result - By Lap Nguyen-->
{dotb_getscript file="custom/include/javascript/Select2/select2.min.js"}
<link rel="stylesheet" href="{dotb_getjspath file='custom/include/javascript/Select2/select2.css'}"/>
<script type="text/javascript" src="{dotb_getjspath file='include/javascript/reports.js'}"></script>
{dotb_getscript file="custom/include/javascript/Multifield/jquery.multifield.min.js"}
<form name="ReportsWizardForm" id="ReportsWizardForm" method="post" action="index.php">
    {dotb_csrf_form_token}
    <input type="hidden" name="module" value="Reports">
    <input type="hidden" name="current_module" value="">
    <input type="hidden" name="page" value="report">
    <input type="hidden" name="action" value="ReportsWizard">
    <input type="hidden" id="return_module" name="return_module" value="Reports">
    <input type="hidden" id="return_action" name="return_action" value="ReportsWizardType">
    <input type="hidden" name="run_query" value="0">
    <input type="hidden" name="save_and_run_query" value="0">
    <input type="hidden" name="current_step" value="{$current_step}">
    <input type="hidden" name="record" value="{$record}">
    <input type="hidden" name="save_report" value="0">
    <input type="hidden" name="is_delete" value="0">
    <input type="hidden" name="report_def">
    <input type="hidden" name="panels_def">
    <input type="hidden" name="filters_defs">
    <input type="hidden" name='expanded_combo_summary_divs' id='expanded_combo_summary_divs' value=''>
    <input type="hidden" name='report_offset' value="{$report_offset}">
    <input type="hidden" name='sort_by' value="{$sort_by}">
    <input type="hidden" name='sort_dir' value="{$sort_dir}">
    <input type="hidden" name='summary_sort_by' value="{$summary_sort_by}">
    <input type="hidden" name='summary_sort_dir' value="{$summary_sort_dir}">

    {literal}
        <style>
            ul.rp-ul {
                list-style-type: none;
                padding: 0;
                margin: 10px;
                display: inline-block;
                font-weight: bold;
                color: #616161;
            }

            li.rp-li {
                text-align: center;
                vertical-align: middle;
                display: inline-block;
                width: 150px;
                height: 140px;
                padding: 5px;
                margin: 5px;
                border: solid 1px #ccc;
                line-height: 1.4;
                border-radius: 2px;
                cursor: pointer;
            }

            li.rp-li:hover {
                border: solid 1px #000;
            }

            .yui-module .hd, .yui-panel .hd {
                background-image: none;
                background-color: #1f3b6d;
            }

            .hd > .spantitle {
                color: #fff;
            }

            .iconmodule-hover:hover{
                border:solid 1px #000 !important;
            }
        </style>
    {/literal}

    <div id='wizard_outline_div' width='20%'>
    </div>
    <div id='report_type_div' style='display:none;border:none' class="edit view reportwizard">
        <h2 style="color:#535353;margin-left:15px;">{$MOD.LBL_SELECT_REPORT_TYPE}</h2>
        <ul class="rp-ul">
            <li class="rp-li" onclick="DOTB.reports.selectReportType('tabular');"><img style="width: 100px;" src="modules/Reports/tpls/r1.png" name="rowsColsImg"/><br/>
                {$MOD.LBL_ROWS_AND_COLUMNS_REPORT}
            </li>
            <li class="rp-li"  onclick="DOTB.reports.selectReportType('summation');"><img style="width: 100px;" src="modules/Reports/tpls/r2.png" name="summationImg"/><br/>
                {$MOD.LBL_SUMMATION_REPORT}
            </li>
            <li class="rp-li" onclick="DOTB.reports.selectReportType('summation_with_details');"><img style="width: 100px;" src="modules/Reports/tpls/r3.png" name="summationWithDetailsImg"/><br/>
                {$MOD.LBL_SUMMATION_REPORT_WITH_DETAILS}
            </li>
            <li class="rp-li" onclick="DOTB.reports.selectReportType('summation', true);"><img style="width: 100px;" src="modules/Reports/tpls/r4.png" name="matrixImg"/><br/>
                {$MOD.LBL_MATRIX_REPORT}
            </li>
        </ul>
    </div>


    <div id='module_select_div' style="display:none;border: none" class="edit view reportwizard">
        <table width="100%" border="0" cellspacing="1" cellpadding="0">
            <tr>
                <td colspan="6">{$MOD.LBL_SELECT_MODULE_BUTTON}<br><br>
                </td>
            </tr>
            <tr>
                <td>
                    <table width="90%" id='buttons_table'>
                        {counter start=0 name="buttonCounter" print=false assign="buttonCounter"}
                        {foreach from=$BUTTONS item="button"}
                        {if $buttonCounter > 5}
                        </tr>
                        <tr>
                            {counter start=0 name="buttonCounter" print=false assign="buttonCounter"}
                            {/if}
                            <td width="16%" style="padding: 5px;" height="100" width="100" valign="top" id='buttons_td'>
                                <table height="100%" style="border: solid 1px #bbbbbb;" class='wizardButton iconmodule-hover' onclick='DOTB.reports.moduleButtonClick("{$button.key}", this);' width="60%" border='1' id='{$button.name}'>
                                    <tr>
                                        <td align="middle" width='100%'>
                                            {assign var="icon"  value=$button.key}
                                            <i style="font-size: 35px;color:#4b4b4b" class="{$ICONS.$icon}"></i><br/>
                                            {capture assign="alt"}{$button.name}{/capture}
                                            <div><a class='studiolink' href="javascript:void(0)" style="color:#000 !important;">{dotb_getimage name="$button.name" attr='border="0"'}</a></div>
                                            <a class='studiolink' href="javascript:void(0)" onclick="" style="color:#000 !important;">{$button.name}</a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            {counter name="buttonCounter"}
                            {/foreach}
                    </table>
                </td>
            </tr>
        </table>

        <br/>
    </div>
    <div id='filters_div' style="display:none">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom: 20px;">
            <tr>
                <td align='left'>
                    <input type='button' title="{$MOD.LBL_PREVIOUS}" class="button" name="{$MOD.LBL_PREVIOUS}" value="{$MOD.LBL_PREVIOUS}"
                           onClick='DOTB.reports.showWizardStep(1);' id="previousBtn">&nbsp;&nbsp;<input type='button' title="{$MOD.LBL_NEXT}" class="button" name="{$MOD.LBL_NEXT}" value="{$MOD.LBL_NEXT}"
                                                                                                         onClick='DOTB.reports.showWizardStep(0);' id="nextBtn">{if $RUN_QUERY == 1 || $id || $record}&nbsp;&nbsp;<input type='button' title="{$APP.LBL_SAVE_BUTTON_LABEL}" class="button"
                                                                                                                                                                                                                         name="{$APP.LBL_SAVE_BUTTON_LABEL}" value="{$APP.LBL_SAVE_BUTTON_LABEL}"
                                                                                                                                                                                                                         onClick='DOTB.reports.saveReport();' id="saveBtn">&nbsp;&nbsp;<input type='button'
                                                                                                                                                                                                                                                                                              title="{$MOD.LBL_PREVIEW_REPORT}"
                                                                                                                                                                                                                                                                                              class="button"
                                                                                                                                                                                                                                                                                              name="{$MOD.LBL_PREVIEW_REPORT}"
                                                                                                                                                                                                                                                                                              value="{$MOD.LBL_PREVIEW_REPORT}"
                                                                                                                                                                                                                                                                                              onClick='DOTB.reports.previewReport();'
                                                                                                                                                                                                                                                                                              id="previewBtn">{/if}{if $record}&nbsp;&nbsp;
                        <input type='button' title="{$MOD.LBL_SAVE_RUN}" class="button" name="{$MOD.LBL_SAVE_RUN}" value="{$MOD.LBL_SAVE_RUN}"
                               onClick='DOTB.reports.runReport();' id="saveAndRunBtn">{/if}{if $record && ($IS_ADMIN == 1|| $IS_OWNER == 1)}&nbsp;&nbsp;<input type='button' title="{$APP.LBL_DELETE_BUTTON_LABEL}" class="button" name="{$APP.LBL_DELETE_BUTTON_LABEL}"
                                                                                                                                                               value="{$APP.LBL_DELETE_BUTTON_LABEL}"
                                                                                                                                                               onClick='DOTB.reports.deleteReport();' id="deleteBtn">{/if}&nbsp;&nbsp;<input type='button' title="{$MOD.LBL_CANCEL}" class="button"
                                                                                                                                                                                                                                             name="{$MOD.LBL_CANCEL}" value="{$MOD.LBL_CANCEL}"
                                                                                                                                                                                                                                             onClick='DOTB.reports.cancelReport();' id="cancelBtn"></td>
            </tr>
        </table>
        </br>
        <table width="100%" border="0" cellspacing="1" cellpadding="0">
            <tr>
                <td width="15%" valign='top'>
                    <div id="leftlayout" style="z-index:100;height:610px; width:202px;">
                        <div id="module_tree_panel" style="height:261px; width:200px;">
                        </div>
                        <div id="autocomplete" style="width:200px;margin-top:15px">
                            <div class="autocompletewrapper">
                                <input id="dt_input" size="23" style="width: 135px !important;" type="text"/>
                                <input type="button" style="width: 45px;" id="clearButton" class="button" value="{$MOD.LBL_CLEAR}" name="{$MOD.LBL_CLEAR}" title="{$MOD.LBL_CLEAR}"/>
                                <div id="dt_ac_container"></div>
                            </div>
                        </div>
                        <div id="module_fields_panel" style="width:200px; float: left;">
                        </div>
                    </div>
                </td>
                <!--<td  width="10px" valign='top'>&nbsp;</td>-->
                <td id='filters_td' style="padding-bottom: 2px;" valign="top">
                    <div id='filter_designer_div'></div>
                    <div id='group_by_div' style="display:none">
                        <div id='group_by_panel'>
                        </div>
                    </div>
                    <div id='display_summaries_div' style="display:none">
                        <div id='display_summaries_panel'>
                        </div>
                    </div>
                    <div id='display_cols_div' style="display:none">
                        <div id='display_cols_panel'>
                        </div>
                    </div>
                </td>


            </tr>
        </table>
        <br/>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td align='left'><input type='button' title="{$MOD.LBL_PREVIOUS}" class="button" name="{$MOD.LBL_PREVIOUS}" value="{$MOD.LBL_PREVIOUS}"
                                        onClick='DOTB.reports.showWizardStep(1);' id="previousButton">&nbsp;&nbsp;<input type='button' title="{$MOD.LBL_NEXT}" class="button" name="{$MOD.LBL_NEXT}" value="{$MOD.LBL_NEXT}"
                                                                                                                         onClick='DOTB.reports.showWizardStep(0);' id="nextButton">{if $RUN_QUERY == 1 || $id || $record}&nbsp;&nbsp;<input type='button' title="{$APP.LBL_SAVE_BUTTON_LABEL}"
                                                                                                                                                                                                                                            class="button" name="{$APP.LBL_SAVE_BUTTON_LABEL}"
                                                                                                                                                                                                                                            value="{$APP.LBL_SAVE_BUTTON_LABEL}"
                                                                                                                                                                                                                                            onClick='DOTB.reports.saveReport();' id="saveButton">&nbsp;&nbsp;<input
                    type='button' title="{$MOD.LBL_PREVIEW_REPORT}" class="button" name="{$MOD.LBL_PREVIEW_REPORT}" value="{$MOD.LBL_PREVIEW_REPORT}"
                    onClick='DOTB.reports.previewReport();' id="previewButton">{/if}{if $record}&nbsp;&nbsp;<input type='button' title="{$MOD.LBL_SAVE_RUN}" class="button" name="{$MOD.LBL_SAVE_RUN}" value="{$MOD.LBL_SAVE_RUN}"
                                                                                                                   onClick='DOTB.reports.runReport();' id="saveAndRunButton">{/if}{if $record && ($IS_ADMIN == 1|| $IS_OWNER == 1)}&nbsp;&nbsp;<input type='button' title="{$APP.LBL_DELETE_BUTTON_LABEL}"
                                                                                                                                                                                                                                                      class="button" name="{$APP.LBL_DELETE_BUTTON_LABEL}"
                                                                                                                                                                                                                                                      value="{$APP.LBL_DELETE_BUTTON_LABEL}"
                                                                                                                                                                                                                                                      onClick='DOTB.reports.deleteReport();'
                                                                                                                                                                                                                                                      id="deleteButton">{/if}&nbsp;&nbsp;<input
                            type='button' title="{$MOD.LBL_CANCEL}" class="button" name="{$MOD.LBL_CANCEL}" value="{$MOD.LBL_CANCEL}"
                            onClick='DOTB.reports.cancelReport();' id="cancelButton"></td>
            </tr>
        </table>
    </div>
    <div id='chart_options_div' style="display:none">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td align='left'><input type='button' title="{$MOD.LBL_PREVIOUS}" class="button" name="{$MOD.LBL_PREVIOUS}" value="{$MOD.LBL_PREVIOUS}"
                                        onClick='DOTB.reports.showWizardStep(1);' id="previousButton">&nbsp;&nbsp;<input type='button' title="{$MOD.LBL_NEXT}" class="button" name="{$MOD.LBL_NEXT}" value="{$MOD.LBL_NEXT}"
                                                                                                                         onClick='DOTB.reports.showWizardStep(0);' id="nextButton">{if $RUN_QUERY == 1 || $id || $record}&nbsp;&nbsp;<input type='button' title="{$APP.LBL_SAVE_BUTTON_LABEL}"
                                                                                                                                                                                                                                            class="button" name="{$APP.LBL_SAVE_BUTTON_LABEL}"
                                                                                                                                                                                                                                            value="{$APP.LBL_SAVE_BUTTON_LABEL}"
                                                                                                                                                                                                                                            onClick='DOTB.reports.saveReport();' id="saveButton">&nbsp;&nbsp;<input
                    type='button' title="{$MOD.LBL_PREVIEW_REPORT}" class="button" name="{$MOD.LBL_PREVIEW_REPORT}" value="{$MOD.LBL_PREVIEW_REPORT}"
                    onClick='DOTB.reports.previewReport();' id="previewButton">{/if}{if $record}&nbsp;&nbsp;<input type='button' title="{$MOD.LBL_SAVE_RUN}" class="button" name="{$MOD.LBL_SAVE_RUN}" value="{$MOD.LBL_SAVE_RUN}"
                                                                                                                   onClick='DOTB.reports.runReport();' id="saveAndRunButton">{/if}{if $record && ($IS_ADMIN == 1|| $IS_OWNER == 1)}&nbsp;&nbsp;<input type='button' title="{$APP.LBL_DELETE_BUTTON_LABEL}"
                                                                                                                                                                                                                                                      class="button" name="{$APP.LBL_DELETE_BUTTON_LABEL}"
                                                                                                                                                                                                                                                      value="{$APP.LBL_DELETE_BUTTON_LABEL}"
                                                                                                                                                                                                                                                      onClick='DOTB.reports.deleteReport();'
                                                                                                                                                                                                                                                      id="deleteButton">{/if}&nbsp;&nbsp;<input
                            type='button' title="{$MOD.LBL_CANCEL}" class="button" name="{$MOD.LBL_CANCEL}" value="{$MOD.LBL_CANCEL}"
                            onClick='DOTB.reports.cancelReport();' id="cancelButton"></td>
            </tr>
        </table>
        </br>
        <div class="edit view">
            <table width="100%" border="0" cellspacing="1" cellpadding="0">
                <tr>
                    <td id="no_chart_text" colspan=2>{$MOD.LBL_GROUP_BY_REQUIRED}<br/></td>
                </tr>
                <tr>
                    <td scope="row" width='20%'>{$MOD.LBL_CHART_TYPE}:</td>
                    <td align=left>
                        <select name='chart_type' id='chart_type'>
                            {foreach from=$chart_types key=thekey item=theval}
                                <option value="{$thekey}">{$theval}</option>
                            {/foreach}
                        </select>
                    </td>
                </tr>
                <tr>
                    <td scope="row">{$MOD.LBL_USE_COLUMN_FOR}:{$chart_data_help}</td>
                    <td align=left>
                        <select name='numerical_chart_column'>
                        </select>
                        <input type='hidden' name='numerical_chart_column_type'>
                    </td>
                </tr>
                <tr>
                    <td scope="row">{$MOD.LBL_CHART_DESCRIPTION}:</td>
                    <td align=left>
                        <input name='chart_description' id="chart_description" size='50' value="{$chart_description}" maxsize="255"/>
                    </td>
                </tr>
                <tr>
                    <td scope="row">{$MOD.LBL_DO_ROUND}:{$do_round_help}</td>
                    <td align=left>
                        <input type="checkbox" class="checkbox" name="do_round" id="do_round" {if ($do_round)}CHECKED{/if}>
                    </td>
                </tr>
            </table>
        </div>
        <br/>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td align='left'><input type='button' title="{$MOD.LBL_PREVIOUS}" class="button" name="{$MOD.LBL_PREVIOUS}" value="{$MOD.LBL_PREVIOUS}"
                                        onClick='DOTB.reports.showWizardStep(1);' id="previousButton">&nbsp;&nbsp;<input type='button' title="{$MOD.LBL_NEXT}" class="button" name="{$MOD.LBL_NEXT}" value="{$MOD.LBL_NEXT}"
                                                                                                                         onClick='DOTB.reports.showWizardStep(0);' id="nextButton">{if $RUN_QUERY == 1 || $id || $record}&nbsp;&nbsp;<input type='button' title="{$APP.LBL_SAVE_BUTTON_LABEL}"
                                                                                                                                                                                                                                            class="button" name="{$APP.LBL_SAVE_BUTTON_LABEL}"
                                                                                                                                                                                                                                            value="{$APP.LBL_SAVE_BUTTON_LABEL}"
                                                                                                                                                                                                                                            onClick='DOTB.reports.saveReport();' id="saveButton">&nbsp;&nbsp;<input
                    type='button' title="{$MOD.LBL_PREVIEW_REPORT}" class="button" name="{$MOD.LBL_PREVIEW_REPORT}" value="{$MOD.LBL_PREVIEW_REPORT}"
                    onClick='DOTB.reports.previewReport();' id="previewButton">{/if}{if $record}&nbsp;&nbsp;<input type='button' title="{$MOD.LBL_SAVE_RUN}" class="button" name="{$MOD.LBL_SAVE_RUN}" value="{$MOD.LBL_SAVE_RUN}"
                                                                                                                   onClick='DOTB.reports.runReport();' id="saveAndRunButton">{/if}{if $record && ($IS_ADMIN == 1|| $IS_OWNER == 1)}&nbsp;&nbsp;<input type='button' title="{$APP.LBL_DELETE_BUTTON_LABEL}"
                                                                                                                                                                                                                                                      class="button" name="{$APP.LBL_DELETE_BUTTON_LABEL}"
                                                                                                                                                                                                                                                      value="{$APP.LBL_DELETE_BUTTON_LABEL}"
                                                                                                                                                                                                                                                      onClick='DOTB.reports.deleteReport();'
                                                                                                                                                                                                                                                      id="deleteButton">{/if}&nbsp;&nbsp;<input
                            type='button' title="{$MOD.LBL_CANCEL}" class="button" name="{$MOD.LBL_CANCEL}" value="{$MOD.LBL_CANCEL}"
                            onClick='DOTB.reports.cancelReport();' id="cancelButton"></td>
            </tr>
        </table>
    </div>
    <div id='report_details_div' style="display:none">
        <table width='100%' border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td align='left'><input type='button' title="{$MOD.LBL_PREVIOUS}" class="button" name="{$MOD.LBL_PREVIOUS}" value="{$MOD.LBL_PREVIOUS}"
                                        onClick='DOTB.reports.showWizardStep(1);' id="previousButton">&nbsp;&nbsp;<input type='button' title="{$APP.LBL_SAVE_BUTTON_LABEL}" class="button" name="{$APP.LBL_SAVE_BUTTON_LABEL}" value="{$APP.LBL_SAVE_BUTTON_LABEL}"
                                                                                                                         onClick='DOTB.reports.saveReport();' id="saveButton">&nbsp;&nbsp;<input type='button' title="{$MOD.LBL_PREVIEW_REPORT}" class="button" name="{$MOD.LBL_PREVIEW_REPORT}"
                                                                                                                                                                                                 value="{$MOD.LBL_PREVIEW_REPORT}"
                                                                                                                                                                                                 onClick='DOTB.reports.previewReport();' id="previewButton">&nbsp;&nbsp;<input type='button'
                                                                                                                                                                                                                                                                               title="{$MOD.LBL_SAVE_RUN}"
                                                                                                                                                                                                                                                                               class="button"
                                                                                                                                                                                                                                                                               name="{$MOD.LBL_SAVE_RUN}"
                                                                                                                                                                                                                                                                               value="{$MOD.LBL_SAVE_RUN}"
                                                                                                                                                                                                                                                                               onClick='DOTB.reports.runReport();'
                                                                                                                                                                                                                                                                               id="saveAndRunButton">{if $record && ($IS_ADMIN == 1|| $IS_OWNER == 1)}&nbsp;&nbsp;<input
                    type='button' title="{$APP.LBL_DELETE_BUTTON_LABEL}" class="button" name="{$APP.LBL_DELETE_BUTTON_LABEL}" value="{$APP.LBL_DELETE_BUTTON_LABEL}"
                    onClick='DOTB.reports.deleteReport();' id="deleteButton">{/if}&nbsp;&nbsp;<input type='button' title="{$MOD.LBL_CANCEL}" class="button" name="{$MOD.LBL_CANCEL}" value="{$MOD.LBL_CANCEL}"
                                                                                                     onClick='DOTB.reports.cancelReport();' id="cancelButton"></td>

            </tr>
        </table>
        <br/>
        <div class="edit view">
            <table id="report_details_table" border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="20%" scope='row'><label for='save_report_as'>{$MOD.LBL_REPORT_NAME}:</label> <span class='required'>*</span></td>
                    <td><input type='text' size='45' name='save_report_as' id='save_report_as' value='{$save_report_as|escape}'></td>
                </tr>
                <tr>
                    <td scope="row">{$MOD.LBL_DESCRIPTION}:</td>
                    <td align=left>
                        <textarea value="{$description}" tabindex="0" class="description" name="description" rows="3" cols="45" title="{$MOD.LBL_DESCRIPTION}">{$description}</textarea>
                    </td>
                </tr>
                {if $IS_ADMIN}
                    <tr>
                        <td scope='row'><label for='show_query'>{$MOD.LBL_SHOW_QUERY}:</label></td>
                        <td><input type="checkbox" class="checkbox" name="show_query" id='show_query' {if ($show_query)}CHECKED{/if}></td>
                    </tr>
                {/if}
                {if $user_id == '1'}
                    <tr>
                        <td scope="row">{$MOD.LBL_CUSTOM_URL}:{$custom_url_help}</td>
                        <td align=left>
                            <input type="text" name='custom_url' id="custom_url" size='45' value="{$custom_url}" maxsize="100"/>
                        </td>
                    </tr>
                    <tr>
                        <td scope="row">{$MOD.LBL_IS_ADMIN_DATA}: {$is_admin_data_help}</td>
                        <td align=left>
                            <input type="hidden" name='is_admin_data' id="is_admin_data" value="0"/>
                            <input type="checkbox" {if $is_admin_data} checked {/if} id="is_admin_data" name="is_admin_data" value="1" title="{$MOD.LBL_IS_ADMIN_DATA}"/>
                        </td>
                    </tr>
                    <tr>
                        <td scope="row">{$MOD.LBL_IS_ROW_NUMBER}:</td>
                        <td align=left>
                            <input type="hidden" name='row_number' id="row_number" value="0"/>
                            <input type="checkbox" {if $row_number} checked {/if} id="row_number" name="row_number" value="1" title="{$MOD.LBL_IS_ROW_NUMBER}"/>
                        </td>
                    </tr>
                    <td scope="row">{$MOD.LBL_STRING_REPLACE}:</td>
                    <td align=left>
                        <table id="tblquery" width="50%" border="1">
                            <thead>
                            <tr>
                                <th width="10%" style="text-align: center;">Query <span class="required">*</span></th>
                                <th width="40%" style="text-align: center;">Search Val <span class="required">*</span></th>
                                <th width="40%" style="text-align: center;">Replace Val <span class="required">*</span></th>
                                <td width="10%" style="text-align: left;">
                                    <button class="button primary" type="button" id="btnAddrow"><b> + </b></button>
                                </td>
                            </tr>
                            </thead>
                            <tbody id="tbodyquery">{$html_tpl}</tbody>
                        </table>
                    </td>
                {/if}
                <tr>
                    <td scope="row">{$MOD.LBL_REPORT_LIST}:</td>
                    <td align=left>
                        <select name='list_of[]' id='list_of' multiple='multiple' size="5">
                            {$list_of_arr}
                        </select>
                    </td>
                </tr>
                <tr>
                    <td scope='row'><label for='assigned_user_name'>{$MOD.LBL_OWNER}:</label> <span class='required'>*</span></td>
                    <td>{$USER_HTML}</td>
                </tr>
                <tr>
                    <td scope='row'>{$MOD.LBL_TEAM}: <span class='required'>*</span></td>
                    <td>{$TEAM_HTML}</td>
                </tr>
                <tr id='outerjoin_row' style="display:none">
                    <td scope='row'>{$MOD.LBL_OUTER_JOIN_CHECKBOX}: {$help_image}
                    </td>
                    <td>
                        <div id='outerjoin_div'></div>
                    </td>
                </tr>
                <tr id='matrixLayoutRow' style="display:none">
                    <td scope='row'><label for='layout_options'>{$MOD.LBL_MATRIX_LAYOUT}</label></td>
                    <td><select name='layout_options' id='layout_options'>
                           <option value='1x2'>{$MOD.LBL_1X2}</option>
                           <option value='2x1'>{$MOD.LBL_2X1}</option>
                        </select></td>
                </tr>

            </table>
        </div>
        <br/>
        <table width='100%' border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td align='left'><input type='button' title="{$MOD.LBL_PREVIOUS}" class="button" name="{$MOD.LBL_PREVIOUS}" value="{$MOD.LBL_PREVIOUS}"
                                        onClick='DOTB.reports.showWizardStep(1);' id="previousButton">&nbsp;&nbsp;<input type='button' title="{$APP.LBL_SAVE_BUTTON_LABEL}" class="button" name="{$APP.LBL_SAVE_BUTTON_LABEL}" value="{$APP.LBL_SAVE_BUTTON_LABEL}"
                                                                                                                         onClick='DOTB.reports.saveReport();' id="saveButton">&nbsp;&nbsp;<input type='button' title="{$MOD.LBL_PREVIEW_REPORT}" class="button" name="{$MOD.LBL_PREVIEW_REPORT}"
                                                                                                                                                                                                 value="{$MOD.LBL_PREVIEW_REPORT}"
                                                                                                                                                                                                 onClick='DOTB.reports.previewReport();' id="previewButton">&nbsp;&nbsp;<input type='button'
                                                                                                                                                                                                                                                                               title="{$MOD.LBL_SAVE_RUN}"
                                                                                                                                                                                                                                                                               class="button"
                                                                                                                                                                                                                                                                               name="{$MOD.LBL_SAVE_RUN}"
                                                                                                                                                                                                                                                                               value="{$MOD.LBL_SAVE_RUN}"
                                                                                                                                                                                                                                                                               onClick='DOTB.reports.runReport();'
                                                                                                                                                                                                                                                                               id="saveAndRunButton">{if $record && ($IS_ADMIN == 1|| $IS_OWNER == 1)}&nbsp;&nbsp;<input
                    type='button' title="{$APP.LBL_DELETE_BUTTON_LABEL}" class="button" name="{$APP.LBL_DELETE_BUTTON_LABEL}" value="{$APP.LBL_DELETE_BUTTON_LABEL}"
                    onClick='DOTB.reports.deleteReport();' id="deleteButton">{/if}&nbsp;&nbsp;<input type='button' title="{$MOD.LBL_CANCEL}" class="button" name="{$MOD.LBL_CANCEL}" value="{$MOD.LBL_CANCEL}"
                                                                                                     onClick='DOTB.reports.cancelReport();' id="cancelButton"></td>

            </tr>
        </table>
    </div>

</form>
{$quicksearch_js}
<script type="text/javascript">

    //Disable the Enter Key
    {literal}
    function stopEnterKey(evt) {
        var evt = (evt) ? evt : ((event) ? event : null);
        var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
        if ((evt.keyCode == 13) && (node.type == "text")) {
            DOTB.reports.checkEnterKey();
        }
    }
    {/literal}

    var users_array = new Array();
    users_array[0] = {literal}{text{/literal}: '{$MOD.LBL_CURRENT_USER}', value: 'Current User'{literal}}{/literal};
    {foreach from=$users_array key=user_id item=user_name}
    users_array[users_array.length] = {literal}{text{/literal}: '{$user_name|escape}', value: '{$user_id}'{literal}}{/literal};
    {/foreach}

    {literal}
    function loadChartForReports() {

        var idObject = document.getElementById('record');
        var id = '';
        if (idObject != null) {
            id = idObject.value;
        } // if
        var chartId = document.getElementById(id + '_div');
        var showHideChartButton = document.getElementById('showHideChartButton');
        if (chartId == null) {
            if (showHideChartButton != null) {
                showHideChartButton.style.display = 'none';
            }
        } // if
    }

    function displayGroupCount() {

    }
    {/literal}

    function onLoadDoInit() {ldelim}
        {if $report_def_str}
        DOTB.reports.init("{$IMG}", {$report_def_str}, users_array, "{$ORIG_IMG}");
        {else}
        DOTB.reports.init("{$IMG}", '', users_array, "{$ORIG_IMG}");
        {/if}
        loadChartForReports();
        displayGroupCount();
        {rdelim}

    {literal}
    var reportLoader = new YAHOO.util.YUILoader({
        require: ["layout", "element"],
        loadOptional: true,
        skin: {base: 'blank', defaultSkin: ''},
        onSuccess: onLoadDoInit,
        base: "include/javascript/yui/build/"
    });
    reportLoader.addModule({
        name: "dotbwidgets",
        type: "js",
        {/literal}
        fullpath: "{dotb_getjspath file='include/javascript/dotbwidgets/DotbYUIWidgets.js'}",
        {literal}
        varName: "YAHOO.DOTB",
        requires: ["datatable", "dragdrop", "treeview", "tabview", "button", "autocomplete", "container"]
    });
    reportLoader.insert();
    {/literal}

    enableQS(true);
    document.getElementById('progress_div').style.display = "none";

    function saveReportOptionsState(name, value) {ldelim}

        {rdelim}
</script>
