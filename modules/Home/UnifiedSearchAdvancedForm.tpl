{*

*}

<script type="text/javascript" src="{dotb_getjspath file='cache/javascript/dotbcrm12.min.js'}"></script>
<link rel="stylesheet" type="text/css" href="{dotb_getjspath file='modules/Connectors/tpls/tabs.css'}"/>

<form name='UnifiedSearchAdvancedMain' action='index.php' onsubmit="DOTB.saveGlobalSearchSettings();" method='POST' class="search_form">
{dotb_csrf_form_token}
<input type='hidden' name='module' value='Home'>
<input type='hidden' name='query_string' value='test'>
<input type='hidden' name='advanced' value='true'>
<input type='hidden' name='action' value='UnifiedSearch'>
<input type='hidden' name='search_form' value='false'>
<input type='hidden' name='search_modules' value=''>
<input type='hidden' name='skip_modules' value=''>
<input type='hidden' id='showGSDiv' name='showGSDiv' value='{$SHOWGSDIV}'>
	<table width='600' border='0' cellspacing='1'>
	<tr style='padding-bottom: 10px'>
		<td class="submitButtons" colspan='8' nowrap>
			<input id='searchFieldMain' class='searchField' type='text' size='80' name='query_string' value='{$query_string}'>
		    <input type="submit" class="button primary" value="{$LBL_SEARCH_BUTTON_LABEL}">&nbsp;
			<a href="#" onclick="javascript:toggleInlineSearch();" style="font-size:12px; font-weight:bold; text-decoration:none; text-shadow:0 1px #FFFFFF;">{$MOD.LBL_SELECT_MODULES}&nbsp;
            {if $SHOWGSDIV == 'yes'}
            {capture assign="alt_hide_show"}{dotb_translate label='LBL_ALT_HIDE_OPTIONS'}{/capture}
			{dotb_getimage  name="basic_search" ext=".gif" other_attributes='border="0" id="up_down_img" ' alt="$alt_hide_show"}
			{else}
            {capture assign="alt_hide_show"}{dotb_translate label='LBL_ALT_SHOW_OPTIONS'}{/capture}
			{dotb_getimage  name="advanced_search" ext=".gif" other_attributes='border="0" id="up_down_img" ' alt="$alt_hide_show"}
			{/if}
			</a>
		</td>
	</tr>
	<tr height='5'><td></td></tr>
	<tr style='padding-top: 10px;'>
		<td colspan='8' nowrap'>
		<div id='inlineGlobalSearch' class='add_table' {if $SHOWGSDIV != 'yes'}style="display:none;"{/if}>
		<table id="GlobalSearchSettings" class="GlobalSearchSettings edit view" style='margin-bottom:0px;' border="0" cellspacing="0" cellpadding="0">
		    <tr>
		    	<td colspan="2">
		    	{dotb_translate label="LBL_SELECT_MODULES_TITLE" module="Administration"}
		    	</td>
		    </tr>
		    <tr>
				<td width='1%'>
					<div id="enabled_div"></div>	
				</td>
				<td>
					<div id="disabled_div"></div>
				</td>
			</tr>
		</table>
		</div>
		</td>
	</tr>
	</table>
</form>

<script type="text/javascript">
{literal}
function toggleInlineSearch()
{
    if (document.getElementById('inlineGlobalSearch').style.display == 'none')
    {
		DOTB.globalSearchEnabledTable.render();
		DOTB.globalSearchDisabledTable.render();    
        document.getElementById('showGSDiv').value = 'yes'		
        document.getElementById('inlineGlobalSearch').style.display = '';
{/literal}
        document.getElementById('up_down_img').src='{dotb_getimagepath file="basic_search.gif"}';
        document.getElementById('up_down_img').setAttribute('alt',"{dotb_translate label='LBL_ALT_HIDE_OPTIONS'}");
{literal}
    }else{
{/literal}			
        document.getElementById('up_down_img').src='{dotb_getimagepath file="advanced_search.gif"}';
        document.getElementById('up_down_img').setAttribute('alt',"{dotb_translate label='LBL_ALT_SHOW_OPTIONS'}");
{literal}			
        document.getElementById('showGSDiv').value = 'no';		
        document.getElementById('inlineGlobalSearch').style.display = 'none';		
    }    
}
{/literal}


var get = YAHOO.util.Dom.get;
var enabled_modules = {$enabled_modules};
var disabled_modules = {$disabled_modules};
var lblEnabled = '{dotb_translate label="LBL_ACTIVE_MODULES" module="Administration"}';
var lblDisabled = '{dotb_translate label="LBL_DISABLED_MODULES" module="Administration"}';
{literal}
DOTB.saveGlobalSearchSettings = function()
{
	var enabledTable = DOTB.globalSearchEnabledTable;
	var modules = "";
	for(var i=0; i < enabledTable.getRecordSet().getLength(); i++){
		var data = enabledTable.getRecord(i).getData();
		if (data.module && data.module != '')
		    modules += "," + data.module;
	}
	modules = modules == "" ? modules : modules.substr(1);
	document.forms['UnifiedSearchAdvancedMain'].elements['search_modules'].value = modules;
}
{/literal}

document.getElementById("inlineGlobalSearch").style.display={if $SHOWGSDIV == 'yes'}"";{else}"none";{/if}

{literal}
DOTB.globalSearchEnabledTable = new YAHOO.DOTB.DragDropTable(
	"enabled_div",
	[{key:"label",  label: lblEnabled, width: 200, sortable: false},
	 {key:"module", label: lblEnabled, hidden:true}],
	new YAHOO.util.LocalDataSource(enabled_modules, {
		responseSchema: {fields : [{key : "module"}, {key : "label"}]}
	}),  
	{height: "200px"}
);

DOTB.globalSearchDisabledTable = new YAHOO.DOTB.DragDropTable(
	"disabled_div",
	[{key:"label",  label: lblDisabled, width: 200, sortable: false},
	 {key:"module", label: lblDisabled, hidden:true}],
	new YAHOO.util.LocalDataSource(disabled_modules, {
		responseSchema: {fields : [{key : "module"}, {key : "label"}]}
	}),
	{height: "200px"}
);

DOTB.globalSearchEnabledTable.disableEmptyRows = true;
DOTB.globalSearchDisabledTable.disableEmptyRows = true;
DOTB.globalSearchEnabledTable.addRow({module: "", label: ""});
DOTB.globalSearchDisabledTable.addRow({module: "", label: ""});
DOTB.globalSearchEnabledTable.render();
DOTB.globalSearchDisabledTable.render();
{/literal}
</script>