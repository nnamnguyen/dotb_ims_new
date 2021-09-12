{*

*}
<div align="right" id="dashletSearch">
	<table>
		<tr>
			<td>{dotb_translate label='LBL_DASHLET_SEARCH' module='Home'}: <input id="search_string" type="text" length="15" onKeyPress="javascript:if(event.keyCode==13)DOTB.myDotb.searchDashlets(this.value,document.getElementById('search_category').value);"  title="{dotb_translate label='LBL_DASHLET_SEARCH' module='Home'}"/>
			<input type="button" class="button" value="{dotb_translate label='LBL_SEARCH' module='Home'}" onClick="javascript:DOTB.myDotb.searchDashlets(document.getElementById('search_string').value,document.getElementById('search_category').value);" />
			<input type="button" class="button" value="{dotb_translate label='LBL_CLEAR' module='Home'}" onClick="javascript:DOTB.myDotb.clearSearch();" />			
			{if $moduleName == 'Home'}
			<input type="hidden" id="search_category" value="module" />
			{else}
			<input type="hidden" id="search_category" value="chart" />
			{/if}
			</td>
		</tr>
	</table>
	<br>
</div>

{if $moduleName == 'Home'}
 <ul class="subpanelTablist" id="dashletCategories">
	<li id="moduleCategory" class="active"><a href="javascript:DOTB.myDotb.toggleDashletCategories('module');" class="current" id="moduleCategoryAnchor">{dotb_translate label='LBL_MODULES' module='Home'}</a></li>
	<li id="chartCategory" class=""><a href="javascript:DOTB.myDotb.toggleDashletCategories('chart');" class="" id="chartCategoryAnchor">{dotb_translate label='LBL_CHARTS' module='Home'}</a></li>
	<li id="toolsCategory" class=""><a href="javascript:DOTB.myDotb.toggleDashletCategories('tools');" class="" id="toolsCategoryAnchor">{dotb_translate label='LBL_TOOLS' module='Home'}</a></li>	
	<li id="webCategory" class=""><a href="javascript:DOTB.myDotb.toggleDashletCategories('web');" class="" id="webCategoryAnchor">{dotb_translate label='LBL_WEB' module='Home'}</a></li>	
</ul>
{/if}

{if $moduleName == 'Home'}
<div id="moduleDashlets" style="height:400px;display:;">
	<h3>{dotb_translate label='LBL_MODULES' module='Home'}</h3>
	<div id="moduleDashletsList" style="height:394px;overflow:auto;display:;">
	<table width="95%">
		{counter assign=rowCounter start=0 print=false}
		{foreach from=$modules item=module}
		{if $rowCounter % 2 == 0}
		<tr>
		{/if}
			<td width="50%" align="left"><a id="{$module.id}_icon" href="javascript:void(0)" onclick="{$module.onclick}" style="text-decoration:none">{$module.icon}&nbsp;<span id="mbLBLL" class="mbLBLL">{$module.title}</span></a><br /></td>
		{if $rowCounter % 2 == 1}
		</tr>
		{/if}
		{counter}
		{/foreach}
	</table>
	</div>
</div>
{/if}
<div id="chartDashlets" style="{if $moduleName == 'Home'}height:400px;display:none;{else}height:425px;display:;{/if}">
	{if $charts != false}
	<h3><span id="basicChartDashletsExpCol"><a href="javascript:void(0)" onClick="javascript:DOTB.myDotb.collapseList('basicChartDashlets');">{dotb_getimage alt=$app_strings.LBL_BASIC_SEARCH name="basic_search" ext=".gif" other_attributes='align="absmiddle" border="0" '}</span></a>&nbsp;{dotb_translate label='LBL_BASIC_CHARTS' module='Home'}</h3>
	<div id="basicChartDashletsList">
	<table width="100%">
		{foreach from=$charts item=chart}
		<tr>
			<td align="left"><a href="javascript:void(0)" onclick="{$chart.onclick}">{$chart.icon}</a>&nbsp;<a class="mbLBLL" href="#" onclick="{$chart.onclick}">{$chart.title}</a><br /></td>
		</tr>
		{/foreach}
	</table>
	<hr>
	</div>
	{/if}
	<h3><span id="reportChartDashletsExpCol"><a href="javascript:void(0)" onClick="javascript:DOTB.myDotb.collapseList('reportChartDashlets');">{dotb_getimage name="basic_search" ext=".gif" other_attributes='align="absmiddle" border="0" '}</span></a>&nbsp;{dotb_translate label='LBL_REPORT_CHARTS' module='Home'}</h3>
	<div id="reportChartDashletsList">
		<div id="myFavoriteReportsChartDashlets" style="display:inline;">
			<h4><span id="myFavoriteExpCol"><a href="javascript:void(0)" onClick="javascript:DOTB.myDotb.collapseReportList('myFavorite');">{dotb_getimage name="ProjectMinus" ext=".gif" other_attributes='align="absmiddle" border="0" '}</a></span>&nbsp;{dotb_translate label='LBL_MY_FAVORITE_REPORT_CHARTS' module='Home'}</h4>
			<div id="myFavoriteReportsChartDashletsList">{dotb_getimage alt=$app_strings.LBL_LOADING name="img_loading" ext=".gif" other_attributes='align="absmiddle" '}</div>
		</div>
		<div id="mySavedReportsChartDashlets" style="display:inline;">
			<h4><span id="mySavedExpCol"><a href="javascript:void(0)" onClick="javascript:DOTB.myDotb.expandReportList('mySaved');">{dotb_getimage name="ProjectPlus" ext=".gif" other_attributes='align="absmiddle" border="0" '}</a></span>&nbsp;{dotb_translate label='LBL_MY_SAVED_REPORT_CHARTS' module='Home'}</h4>
			<div id="mySavedReportsChartDashletsList" style="display:none;">{dotb_getimage alt=$app_strings.LBL_LOADING name="img_loading" ext=".gif" other_attributes='align="absmiddle" '}</div>
		</div>
		<div id="myTeamReportsChartDashlets" style="display:inline;">
			<h4><span id="myTeamExpCol"><a href="javascript:void(0)" onClick="javascript:DOTB.myDotb.expandReportList('myTeam');">{dotb_getimage name="ProjectPlus" ext=".gif" other_attributes='align="absmiddle" border="0" '}</a></span>&nbsp;{dotb_translate label='LBL_MY_TEAM_REPORT_CHARTS' module='Home'}</h4>
			<div id="myTeamReportsChartDashletsList" style="display:none;">{dotb_getimage alt=$app_strings.LBL_LOADING name="img_loading" ext=".gif" other_attributes='align="absmiddle" '}</div>
		</div>
		<div id="globalReportsChartDashlets" style="display:inline;">
			<h4><span id="globalExpCol"><a href="javascript:void(0)" onClick="javascript:DOTB.myDotb.expandReportList('global');">{dotb_getimage name="ProjectPlus" ext=".gif" other_attributes='align="absmiddle" border="0" '}</a></span>&nbsp;{dotb_translate label='LBL_GLOBAL_REPORT_CHARTS' module='Home'}</h4>
			<div id="globalReportsChartDashletsList" style="display:none;">{dotb_getimage alt=$app_strings.LBL_LOADING name="img_loading" ext=".gif" other_attributes='align="absmiddle" '}</div>
		</div>
	</div>
</div>

{if $moduleName == 'Home'}
<div id="toolsDashlets" style="height:400px;display:none;">
	<h3>{dotb_translate label='LBL_TOOLS' module='Home'}</h3>
	<div id="toolsDashletsList">
	<table width="95%">
		{counter assign=rowCounter start=0 print=false}
		{foreach from=$tools item=tool}
		{if $rowCounter % 2 == 0}
		<tr>
		{/if}
			<td align="left"><a href="javascript:void(0)" onclick="{$tool.onclick}">{$tool.icon}</a>&nbsp;<a class="mbLBLL" href="#" onclick="{$tool.onclick}">{$tool.title}</a><br /></td>
		{if $rowCounter % 2 == 1}
		</tr>
		{/if}
		{counter}
		{/foreach}
	</table>
	</div>
</div>
{/if}

{if $moduleName == 'Home'}
<div id="webDashlets" style="height:400px;display:none;">
	<h3>{dotb_translate label='LBL_WEBSITE_TITLE' module='Home'}</h3>
	<div id="webDashletsList">
	<table width="95%">
	    <tr>
	        <td scope="row"></td>
	        <td><input type="text" id="web_address" value="http://" style="width: 400px"   title="{dotb_translate label='LBL_WEBSITE_TITLE' module='Home'}"/></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="button" name="create" value="{$APP.LBL_ADD_BUTTON}" 
                    onclick="return DOTB.myDotb.addDashlet('iFrameDashlet', 'web', document.getElementById('web_address').value);" />
            </td>
        </tr>
    </table>
    <h3>{dotb_translate label='LBL_RSS_TITLE' module='Home'}</h3>
	<table width="95%">
        <tr>
	        <td scope="row"></td>
	        <td><input type="text" id="rss_address" value="http://" style="width: 400px"  title="{dotb_translate label='LBL_RSS_TITLE' module='Home'}" /></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="button" name="create" value="{$APP.LBL_ADD_BUTTON}" 
                    onclick="return DOTB.myDotb.addDashlet('RSSDashlet', 'web', document.getElementById('rss_address').value);" />
            </td>
        </tr>
	</table>
	</div>
</div>
{/if}

<div id="searchResults" style="display:none;{if $moduleName == 'Home'}height:400px;{else}height:425px;{/if}">
</div>
