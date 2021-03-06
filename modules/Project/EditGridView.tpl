{*

*}
<link rel="stylesheet" type="text/css" href="{dotb_getjspath file='modules/Project/gantt.css'}" />

<script type="text/javascript" src="{dotb_getjspath file='include/javascript/yui/ext/yui-ext.js'}"></script>
<script type="text/javascript" src="{dotb_getjspath file='include/javascript/popup_parent_helper.js'}"></script>
<script type="text/javascript" src="{dotb_getjspath file='modules/Project/gantt.js'}"></script>
<script type="text/javascript" src="{dotb_getjspath file='modules/Project/grid.js'}"></script>

<script type="text/javascript">
{literal}
function initUI(){
	var view = Get_Cookie("project_management_view");
	if (view == "grid_only") {
		DOTB.gantt.gridOnly();
	}
	else if (view == "gantt_only") {
		DOTB.gantt.ganttOnly();
	}
	else {
	    var YSB = YAHOO.ext.SplitBar;
	    var resizer = new YSB('resizer', 'grid_space', null, YSB.LEFT);
	    resizer.setAdapter(new YSB.AbsoluteLayoutAdapter("project_container"));
	    resizer.minSize = 100;
	    resizer.maxSize = 900;
	    resizer.onMoved.subscribe(adjustGantt);
	    resizer.setCurrentSize(700);

    	YAHOO.util.Dom.setStyle('grid_space', 'width', '700px');
    	YAHOO.util.Dom.setStyle('gantt_area', 'margin-left', '704px');
    	YAHOO.util.Dom.setStyle('gantt_area', 'margin-right', '0px');
    }

}
function adjustGantt(splitbar, newSize){
    if(splitbar.el.id == 'resizer'){
        YAHOO.util.Dom.setStyle('gantt_area', 'margin-left', newSize+4 + "px");
    }
}



YAHOO.util.Event.on(window, 'load', initUI);
var resources = new Array();
{/literal}
</script>

<h2>{$MOD.LBL_VIEW_GANTT_TITLE}</h2>
<table width="100%" cellpadding="0" cellspacing="0" border="0" >
<tr>
<td>

<form name="EditViewGrid" id="EditViewGrid" method="post" action="index.php">
{dotb_csrf_form_token}
<input type="hidden" name="module" value="Project" />
<input type="hidden" name="record" value="{$ID}" />
<input type="hidden" name="team_id" value="{$TEAM}" />
<input type="hidden" name="is_template" value="{$IS_TEMPLATE}" />
<input type="hidden" name="to_pdf" id="to_pdf" value="1">
<input type="hidden" name="action" id="action" value="SaveGrid" />
<input type="hidden" name="numRowsToSave"  id="numRowsToSave" value="">
<input type="hidden" name="project_id" value="{$ID}">
<input type="hidden" name="project_name" value="{$PROJECT->name}">
<input type="hidden" name="pdfclass"  id="pdfclass" value="{$PDF_CLASS}">
<input type="hidden" name="dotbpdf"  id="dotbpdf" value="projectgrid">
<input type="hidden" name="project_start" value="{$PROJECT->estimated_start_date}">
<input type="hidden" name="project_owner" value="{$PROJECT->assigned_user_id}">
<input type="hidden" name="project_end" value="{$PROJECT->estimated_end_date}">
<input type="hidden" name="deletedRows"  id="deletedRows" value="">

<input type="hidden" name="layout" value="ProjectGrid">

<input name="calendar_start" id="calendar_start" onblur="parseDate(this, '{$CALENDAR_DATEFORMAT}');DOTB.gantt.createTable('biweek', this.value, '{$BG_COLOR}');" type="hidden" tabindex='2' value="{$PROJECT->estimated_start_date}" /><br />
<input name="gantt_chart_start_date" id="gantt_chart_start_date" type="hidden" onChange="DOTB.gantt.createTable(document.getElementById('gantt_chart_view').value, this.value, '{$BG_COLOR}');" value="{$PROJECT->estimated_start_date}" />
<input name="gantt_chart_view" id="gantt_chart_view" type="hidden" value="biweek" />

<div id="projectButtonsDiv">
	<span id = "grid_buttons_span">
	{if $SELECTED_VIEW <= 1 && $CANEDIT}
			<a valign="bottom" title="{$MOD.LBL_INSERT_BUTTON}" id="gantt_button_insert_row">{dotb_getimage name="ProjectInsertRows" ext=".gif" alt=$mod_strings.LBL_INSERTROWS other_attributes='onclick="javascript:DOTB.grid.insertRow()" '}</img></a>
			<a valign="bottom" title="{$MOD.LBL_INDENT_BUTTON}">{dotb_getimage name="ProjectIndent" ext=".gif" other_attributes='onclick="javascript:DOTB.grid.indentSelectedRows()" '}</img></a>
			<a valign="bottom" title="{$MOD.LBL_OUTDENT_BUTTON}">{dotb_getimage name="ProjectOutdent" ext=".gif" other_attributes='onclick="javascript:DOTB.grid.addToOutdent()" '}</img></a>
			<a valign="bottom" title="{$MOD.LBL_COPY_BUTTON}">{dotb_getimage name="ProjectCopy" ext=".gif" other_attributes='onclick="javascript:DOTB.grid.copyRow()" '}</img></a>
			<a valign="bottom" title="{$MOD.LBL_CUT_BUTTON}">{dotb_getimage name="ProjectCut" ext=".gif" other_attributes='onclick="javascript:DOTB.grid.cutRow()" '}</img></a>
			<a valign="bottom" title="{$MOD.LBL_PASTE_BUTTON}">{dotb_getimage name="ProjectPaste" ext=".gif" other_attributes='onclick="javascript:DOTB.grid.pasteRow()" '}</img></a>
			<a valign="bottom" title="{$MOD.LBL_DELETE_BUTTON}">{dotb_getimage name="ProjectDelete" ext=".gif" other_attributes='onclick="javascript:DOTB.grid.deleteRows()" '}</img></a>
			<a valign="bottom" title="{$MOD.LBL_EXPAND_ALL_BUTTON}">{dotb_getimage name="ProjectExpandAll" ext=".gif" other_attributes='onclick="javascript:DOTB.grid.expandAll()" '}</img></a>
			<a valign="bottom" title="{$MOD.LBL_COLLAPSE_ALL_BUTTON}">{dotb_getimage name="ProjectCollapseAll" ext=".gif" other_attributes='onclick="javascript:DOTB.grid.collapseAll()" '}</img></a>
	{/if}
		<a id="saveGridLink" title="{$MOD.LBL_SAVE_BUTTON}">{dotb_getimage name="ProjectSave" ext=".gif" other_attributes='onclick="javascript:DOTB.grid.save()" '}</img></a>
	</span>

	<span id = "gantt_buttons_span">
        {capture assign="attributes"}onclick="DOTB.gantt.createTable('week', document.getElementById('gantt_chart_start_date').value, '{$BG_COLOR}');"{/capture}
		<a title="{$MOD.LBL_WEEK_BUTTON}">{dotb_getimage name="ProjectWeek" ext=".gif" other_attributes="$attributes"}</img></a>
		{capture assign="attributes"}onclick="DOTB.gantt.createTable('biweek', document.getElementById('gantt_chart_start_date').value, '{$BG_COLOR}');"{/capture}
        <a title="{$MOD.LBL_BIWEEK_BUTTON}">{dotb_getimage name="Project2Weeks" ext=".gif" other_attributes="$attributes"}</img></a>
        {capture assign="attributes"}onclick="DOTB.gantt.createTable('month', document.getElementById('gantt_chart_start_date').value, '{$BG_COLOR}');"{/capture}
		<a title="{$MOD.LBL_MONTH_BUTTON}">{dotb_getimage name="ProjectMonth" ext=".gif" other_attributes="$attributes"}</img></a>
	</span>

    <input type="hidden" name="selected_view" id="selected_view" value="{$SELECTED_VIEW|escape:'html':'UTF-8'}" />
	<select id="gridViewSelect" onChange="DOTB.grid.changeView()">
		<option value=0>{$MOD.LBL_FILTER_VIEW}...</option>
		<option value=1>{$MOD.LBL_FILTER_ALL_TASKS}</option>
		<option value=2>{$MOD.LBL_FILTER_COMPLETED_TASKS}</option>
		<option value=3>{$MOD.LBL_FILTER_INCOMPLETE_TASKS}</option>
		<option value=4>{$MOD.LBL_FILTER_MILESTONES}</option>
		<option value=5>{$MOD.LBL_FILTER_RESOURCE}</option>
		<option value=6>{$MOD.LBL_FILTER_DATE_RANGE}</option>
		<option value=7>{$MOD.LBL_LIST_OVERDUE_TASKS}</option>
		<option value=8>{$MOD.LBL_LIST_UPCOMING_TASKS}</option>
		<option value=9>{$MOD.LBL_FILTER_MY_TASKS}</option>
		<option value=10>{$MOD.LBL_FILTER_MY_OVERDUE_TASKS}</option>
		<option value=11>{$MOD.LBL_FILTER_MY_UPCOMING_TASKS}</option>

	</select>
	<input {if $SELECTED_VIEW != 5 }style="display:none" {/if} type="input" {if $SELECTED_VIEW == 5} value="{$VIEW_FILTER_RESOURCE|escape:'html':'UTF-8'}"{/if} name="view_filter_resource" id="view_filter_resource" value="" />

	<span id="view_filter_6_start_span" {if $SELECTED_VIEW != 6}style="display:none"{/if}>{$MOD.LBL_FILTER_DATE_RANGE_START}:</span>
    <input name="view_filter_date_start" id="view_filter_date_start" onblur="parseDate(this, '{$CALENDAR_DATEFORMAT}');" {if $SELECTED_VIEW != 6 } style="display:none" {/if} type="input" tabindex="2" size="11" maxlength="10" value="{$VIEW_FILTER_DATE_START|escape:'html':'UTF-8'}" />
	<span id="view_filter_6_finish_span" {if $SELECTED_VIEW != 6}style="display:none"{/if}>{$MOD.LBL_FILTER_DATE_RANGE_FINISH}: </span>
    <input name="view_filter_date_finish" id="view_filter_date_finish" onblur="parseDate(this, '{$CALENDAR_DATEFORMAT}');" {if $SELECTED_VIEW !=  6 } style="display:none" {/if} type="input" tabindex="2" size="11" maxlength="10" value="{$VIEW_FILTER_DATE_FINISH|escape:'html':'UTF-8'}" />

	{if $SELECTED_VIEW == 6}
		<script type="text/javascript">
		Calendar.setup ({literal}{{/literal}
			inputField : "view_filter_date_start", ifFormat : '{$CALENDAR_DATEFORMAT}', showsTime : false, button : "view_filter_date_start", singleClick : true, step : 1, weekNumbers:false{literal}}{/literal});
		Calendar.setup ({literal}{{/literal}
			inputField : "view_filter_date_finish", ifFormat : '{$CALENDAR_DATEFORMAT}', showsTime : false, button : "view_filter_date_finish", singleClick : true, step : 1, weekNumbers:false{literal}}{/literal});
		</script>
	{/if}
	<span id="view_filter_button_span"></span>
	{if $SELECTED_VIEW == 5 || $SELECTED_VIEW == 6}
		<input class="button" type=button id="view_filter_button" value="{$MOD.LBL_FILTER_VIEW}" onclick="document.forms['EditViewGrid'].action.value='EditGridView';document.forms['EditViewGrid'].to_pdf.value	= '0';document.getElementById('EditViewGrid').submit();" />
	{/if}
	<span id="exportToPDFSpan">
		<input class="button" type="button" name="button" value="{$MOD.LBL_EXPORT_TO_PDF}" onclick="DOTB.grid.exportToPDF();"/>
	</span>
	<input class="button" type="button" name="button" value="{$MOD.LNK_PROJECT_RESOURCE_REPORT}" onclick="window.open('index.php?module=Project&show_js=1&action=ResourceReport&record={$ID}','','width=700,height=700,resizable=1,scrollbars=1')" />
	<input class="button" type="button" name="button" value="{$MOD.LBL_GRID_ONLY}" onclick="javascript:DOTB.gantt.gridOnly()" />
	<input class="button" type="button" name="button" value="{$MOD.LBL_GANTT_ONLY}" onclick="javascript:DOTB.gantt.ganttOnly()" />
	<input class="button" type="button" name="button" value="{$MOD.LBL_GRID_GANTT}" onclick="javascript:DOTB.gantt.gridGanttView()" />
</div>

<p/>

<div id="project_container">
	<div id="grid_space">
		<div>
			<table id="projectTable" border="1" cellpadding="0" cellspacing="0">
				<tr align=center height="50">
					<th width="8%">{$MOD.LBL_TASK_ID}</th>
					<th width="5%">{$MOD.LBL_PERCENT_COMPLETE}</th>
					<th width="30%" nowrap>{$MOD.LBL_TASK_NAME}</th>
					<th width="5%" colspan="2">{$MOD.LBL_DURATION}</th>
					<th width="5%">{$MOD.LBL_START}</th>
					<th width="5%">{$MOD.LBL_FINISH}</th>
					<th width="8%">{$MOD.LBL_PREDECESSORS}</th>
					<th width="8%">{$MOD.LBL_RESOURCE_NAMES}</th>
					<th id="optional_0" width="4%">{$MOD.LBL_ACTUAL_DURATION}</th>
				</tr>
				{foreach from=$TASKS item="TASK" }
                    {assign var=taskEditAccess value=$TASK->ACLAccess('edit')}
				<tr id="project_task_row_{$TASK->project_task_id}" height="23">
                    <td style="cursor:default" scope="row" align="center" {if $taskEditAccess}onClick="DOTB.grid.clickedRow({$TASK->project_task_id}, event);"{/if}>
						<div id='id_{$TASK->project_task_id}_divlink' style="display:inline;">{$TASK->project_task_id}{if $TASK->milestone_flag == 1}*{/if}</div>
						<input type="hidden" name="mapped_row_{$TASK->project_task_id}" id="mapped_row_{$TASK->project_task_id}" value="{$TASK->project_task_id}">
						<input type="hidden" name="parent_{$TASK->project_task_id}" id="parent_{$TASK->project_task_id}" value="{$TASK->parent_task_id}">
						<input type="hidden" name="obj_id_{$TASK->project_task_id}" id="obj_id_{$TASK->project_task_id}" value="{$TASK->id}">
						<input type="hidden" name="is_milestone_{$TASK->project_task_id}" id="is_milestone_{$TASK->project_task_id}" value="{$TASK->milestone_flag}">
						<input type="hidden" name="time_start_{$TASK->project_task_id}" id="time_start_{$TASK->project_task_id}" value="{$TASK->time_start}">
						<input type="hidden" name="time_finish_{$TASK->project_task_id}" id="time_finish_{$TASK->project_task_id}" value="{$TASK->time_finish}">
					</td>
					<td>
                        <input {if $CURRENT_USER != $TASK->resource_id && !$CANEDIT || !$taskEditAccess}readonly="readonly"{/if} type=text size=5 style="border:0" name=percent_complete_{$TASK->project_task_id} id=percent_complete_{$TASK->project_task_id} value="{$TASK->percent_complete}"
							onBlur="if (DOTB.grid.validatePercentComplete(this)) {literal}{{/literal}
							DOTB.grid.updateAncestorsPercentComplete({$TASK->project_task_id})
							DOTB.gantt.changeTask({$TASK->project_task_id});
							{literal}}{/literal} ">
					</td>
					<td nowrap ondblclick="DOTB.grid.toggle('description_{$TASK->project_task_id}_div', 'description_{$TASK->project_task_id}', 'description_{$TASK->project_task_id}_divlink');">
						<div id='description_{$TASK->project_task_id}_div' style="display:none;">
							<input {if !$CANEDIT || !$taskEditAccess}readonly="readonly"{/if} name=description_{$TASK->project_task_id} type=text maxlength="{ $NAME_LENGTH }" style="border:0"  size=40 id=description_{$TASK->project_task_id} value="{$TASK->name}"
								onblur="DOTB.grid.blurEvent({$TASK->project_task_id}, 'description_{$TASK->project_task_id}_div','description_{$TASK->project_task_id}', 'description_{$TASK->project_task_id}_divlink');">
							<input type="hidden" name="description_divlink_input_{$TASK->project_task_id}" id="description_divlink_input_{$TASK->project_task_id}" value="{$TASK->name}">

						</div>
						<div id='description_{$TASK->project_task_id}_divlink' style="display:inline;width:250px">{$TASK->name}</div>
					</td>
					<td>
						<input  {if !$CANEDIT || !$taskEditAccess}readonly="readonly"{/if} type=text  style="border:0;" size=3 name=duration_{$TASK->project_task_id} id=duration_{$TASK->project_task_id} value="{$TASK->duration}"
							onBlur="if (DOTB.grid.validateDuration(this)) {literal}{{/literal}
							DOTB.grid.calculateEndDate(document.getElementById('date_start_{$TASK->project_task_id}').value, this.value, {$TASK->project_task_id});
							DOTB.grid.updateAllDependentsAfterDateChanges({$TASK->project_task_id});
							//DOTB.grid.updateAncestorsTimeData({$TASK->project_task_id});
							DOTB.gantt.changeTask({$TASK->project_task_id});
							{literal}}{/literal} ">
					</td>
					<td>
						<!--Need the hidden duration unit so that even when a resource logs in and the duration_unit select is disabled, we can still export to PDF via this hidden field-->
						<input type='hidden' name="duration_unit_hidden_{$TASK->project_task_id}" id="duration_unit_hidden_{$TASK->project_task_id}" value="{$TASK->duration_unit}">
						<select  {if !$CANEDIT || !$taskEditAccess}disabled{/if} style='border:0' name=duration_unit_{$TASK->project_task_id} id=duration_unit_{$TASK->project_task_id} onChange="DOTB.grid.changeDurationUnits('{$TASK->project_task_id}')">
							{foreach from=$DURATION_UNITS item="DURATION_UNIT" key="DURATION_UNIT_KEY"}
								{if $DURATION_UNIT_KEY == $TASK->duration_unit}
									<option value="{$DURATION_UNIT_KEY}" selected>{$DURATION_UNIT}</option>
								{else}
									<option value="{$DURATION_UNIT_KEY}">{$DURATION_UNIT}</option>
								{/if}
							{/foreach}
						</select>
					</td>
					<td>
                        <input {if !$CANEDIT || !$taskEditAccess}readonly="readonly" {/if} id=date_start_{$TASK->project_task_id} name=date_start_{$TASK->project_task_id} style="border:0" type="text" tabindex='2' size='11' maxlength='10' value="{$TASK->date_start}">
					</td>
					<td>
                        <input {if !$CANEDIT || !$taskEditAccess}readonly="readonly"{/if} name=date_finish_{$TASK->project_task_id} id=date_finish_{$TASK->project_task_id} style="border:0" onchange="parseDate(this, '{$CALENDAR_DATEFORMAT}'); DOTB.grid.processFinishDate(this, '{$TASK->project_task_id}');"
							type="text" tabindex='2' size='11' maxlength='10' value="{$TASK->date_finish}">
					</td>
					<td>
                        <input  {if !$CANEDIT || !$taskEditAccess}readonly="readonly"{/if} type=text size=10  style='border:0' name=predecessors_{$TASK->project_task_id} id=predecessors_{$TASK->project_task_id} value="{$TASK->predecessors}"
						onblur="if (DOTB.grid.validatePredecessors(this)){literal}{{/literal}
							DOTB.grid.setDependencyCheckRow({$TASK->project_task_id});
							DOTB.grid.validateDependencyCycles({$TASK->project_task_id});
							DOTB.grid.validatePredecessorIsNotAncestorOrChild({$TASK->project_task_id});
							if (DOTB.grid.dependencyCheckFail != 1){literal}{{/literal}
								DOTB.grid.updatePredecessorsAndDependents({$TASK->project_task_id});
								DOTB.grid.calculateDatesAfterAddingPredecessors({$TASK->project_task_id});
								DOTB.grid.updateAllDependentsAfterDateChanges({$TASK->project_task_id});
								//DOTB.grid.updateAncestorsTimeData({$TASK->project_task_id});
								DOTB.gantt.changeTask({$TASK->project_task_id});
							{literal}}{/literal}
						{literal}}{/literal}
						DOTB.grid.dependencyCheckFail = 0;
						//DOTB.grid.calculateEndDate(document.getElementById('date_start_{$TASK->project_task_id}').value, document.getElementById('duration_{$TASK->project_task_id}').value, {$TASK->project_task_id});">
					</td>
					<td>
						<input type='hidden' name="resource_full_name_{$TASK->project_task_id}" id="resource_full_name_{$TASK->project_task_id}">
						<input type='hidden' name="resource_type_{$TASK->project_task_id}" id="resource_type_{$TASK->project_task_id}">
                        <select  {if !$CANEDIT || !$taskEditAccess}disabled{/if} style='border:0' name=resource_{$TASK->project_task_id} id=resource_{$TASK->project_task_id}
						 onChange="DOTB.grid.updateResourceFullNameAndType('{$TASK->project_task_id}');
						 	DOTB.grid.calculateEndDate(document.getElementById('date_start_{$TASK->project_task_id}').value, document.getElementById('duration_{$TASK->project_task_id}').value, {$TASK->project_task_id});
						 	DOTB.grid.calculateDatesAfterAddingPredecessors({$TASK->project_task_id});
							DOTB.grid.updateAllDependentsAfterDateChanges({$TASK->project_task_id});
							//DOTB.grid.updateAncestorsTimeData({$TASK->project_task_id});
							DOTB.gantt.changeTask({$TASK->project_task_id});">
							<option value="">----</option>
							{foreach from=$RESOURCES item="RESOURCE"}
								{if $RESOURCE->id == $TASK->resource_id}
									<option value="{$RESOURCE->id}" selected>{$RESOURCE->full_name}</option>
									{assign var=resource_full_name value=$RESOURCE->full_name}
									{assign var=resource_type value=$RESOURCE->object_name}
								{else}
									<option value="{$RESOURCE->id}">{$RESOURCE->full_name}</option>
								{/if}
							{/foreach}
						</select>
					</td>
					<td id="optional_{$TASK->project_task_id}"><input {if $CURRENT_USER != $TASK->resource_id && !$CANEDIT || !$taskEditAccess}readonly="readonly"{/if} type=text size=10 style="border:0" name=actual_duration_{$TASK->project_task_id} id=actual_duration_{$TASK->project_task_id} value="{$TASK->actual_duration}" onBlur="DOTB.grid.validateDuration(this);">
					</td>
				</tr>
				<script type="text/javascript">
					document.getElementById('resource_full_name_{$TASK->project_task_id}').value="{$resource_full_name}";
					document.getElementById('resource_type_{$TASK->project_task_id}').value="{$resource_type}";
					DOTB.grid.setUpIndentedRow("{$TASK->project_task_id}", "{$TASK->parent_task_id}");
				</script>
				{assign var=resource_full_name value=""}
				{assign var=resource_type value=""}
				{/foreach}
			</table>
			<script type="text/javascript">
				document.getElementById('gridViewSelect').selectedIndex = document.getElementById('selected_view').value;
			</script>

		<br /><br />
	</div>
	</div>


	<div id="gantt_area">
		<div id="gantt_space"></div>
	</div>
		<br /><br />

	<div id="resizer"></div>

</div>
</form>
<div id="task_detail_area_div" name="task_detail_area_div" width="100%" style="display:none;border:1px">
{dotb_getimage name="img_loading" ext=".gif" other_attributes='border="0" '}
</div>
<script type="text/javascript">
{foreach from=$RESOURCES item="RESOURCE"}
	var resourceObj = new Object();
	resourceObj.id = '{$RESOURCE->id}';
	resourceObj.full_name = '{$RESOURCE->full_name}';
	resourceObj.type = '{$RESOURCE->object_name}';
	resources.push(resourceObj);
{/foreach}
var durationOptions = new Array();
{foreach from=$DURATION_UNITS item="DURATION_UNIT" key= "DURATION_UNIT_KEY"}
	var durationOptionObj = new Object();
	durationOptionObj.key = "{$DURATION_UNIT_KEY}"
	durationOptionObj.value = "{$DURATION_UNIT}"
	durationOptions.push(durationOptionObj);
{/foreach}
var holidays = new Array();
{foreach from=$HOLIDAYS item="HOLIDAY"}
	var holidayObj = new Object();
	holidayObj.resource = '{$HOLIDAY->person_id}';
	holidayObj.date = '{$HOLIDAY->holiday_date}';
	holidays.push(holidayObj);
{/foreach}

DOTB.grid.gridNotLoaded();
DOTB.grid.setupCalendar(null,  "{$CALENDAR_DATEFORMAT}", "{$BG_COLOR}", "projectTable","{dotb_getimagepath file='ProjectMinus.gif'}","{dotb_getimagepath file='ProjectPlus.gif'}");
DOTB.grid.setUpCurrentUser('{$CURRENT_USER}', '{$OWNER}');
DOTB.grid.setupHolidays(holidays);
DOTB.grid.setupResourceOptions(resources);
DOTB.grid.setupDurationUnitsOptions(durationOptions);
DOTB.grid.adjustInitialIndentedRows();
DOTB.grid.buildPredecessorsAndDependents();
DOTB.grid.gridLoaded();
DOTB.gantt.createTable('biweek', document.getElementById('calendar_start').value, "{$BG_COLOR}");

    DOTB.grid.onAfterInsertRow = function(num) {ldelim}
        YAHOO.util.Dom.setAttribute(YAHOO.util.Selector.query('input[size="40"]'), 'maxlength', { $NAME_LENGTH });
    {rdelim}

{if $TASKCOUNT == 0}
for (i = 0; i < 2; i++)
	DOTB.grid.insertRow();
{/if}

</script>
{$JAVASCRIPT}
