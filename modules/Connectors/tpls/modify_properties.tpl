{*

*}

<script type="text/javascript" src="{dotb_getjspath file='cache/javascript/dotbcrm12.min.js'}"></script>
<script type="text/javascript" src="{dotb_getjspath file='modules/Connectors/Connector.js'}"></script>
<link rel="stylesheet" type="text/css" href="{dotb_getjspath file='modules/Connectors/tpls/tabs.css'}"/>

{literal}

<script language="javascript">
 	var _tabView;
 	var _timer;
 	var _sourceArray = new Array();
var SourceTabs = {

    init : function() {
         _tabView = new YAHOO.widget.TabView();

    	{/literal}
    		 {counter assign=source_count start=0 print=0}
	        {foreach name=connectors from=$SOURCES key=name item=source}
	            {counter assign=source_count}
		{literal}
		       	tab = new YAHOO.widget.Tab({
			        label: '{/literal}{$source.name}{literal} ',
			        dataSrc: {/literal}'index.php?module=Connectors&action=SourceProperties&source_id={$source.id}&to_pdf=true'{literal},
			        cacheData: true,
			        {/literal}
			        {if $ACTIVE_TAB}
                        {if $ACTIVE_TAB == $source.id}
                    active: true
                        {else}
                    active: false
                        {/if}
                    {else}
                        {if $source_count == 1}
                    active: true
                        {else}
                    active: false
                        {/if}
                    {/if}
			        {literal}
			    });
			    {/literal}
			    _tabView.addTab(tab);			    
			    tab.id = '{$source.id}';		    
			    //tab.addListener('beforeContentChange', SourceTabs.tabClicked);
			    tab.addListener('click', SourceTabs.afterContentChange);
			    _sourceArray[{$source_count}-1] = '{$source.id}';
	       {/foreach}
		  {literal}
  		_tabView.appendTo('container');
    },

    afterContentChange: function(info) { 

		if(typeof validate != 'undefined') {
		   validate = new Array();
		   validate["ModifyProperties"] = new Array();
		}    
    
    	tab = _tabView.get('activeTab');
    	if(typeof tab.get('content') != 'undefined') {
        	DOTB.util.evalScript(tab.get('content'));  
        	clearTimeout(_timer);
        } else {
            _timer = setTimeout(SourceTabs.afterContentChange, 1000);
        }
    },

    fitContainer: function() {
		content_div = _tabView.getElementsByClassName('yui-content', 'div')[0];
		content_div.style.overflow='auto';
		content_div.style.height='405px';
    }
}
YAHOO.util.Event.onDOMReady(SourceTabs.init);
</script>
{/literal}
<form name="ModifyProperties" method="POST" action="index.php" onsubmit="disable_submit('ModifyProperties');">
{dotb_csrf_form_token}
<input type="hidden" name="modify" value="true">
<input type="hidden" name="module" value="Connectors">
<input type="hidden" name="action" value="SaveModifyProperties">
<input type="hidden" name="source_id" value="">
<input type="hidden" name="reset_to_default" value="">

{counter assign=source_count start=0 print=0}
{foreach name=connectors from=$SOURCES key=name item=source}
{counter assign=source_count}
<input type="hidden" name="source{$source_count}" value="{$source.id}">
{/foreach}

<table border="0" class="actionsContainer">
<tr>
<td>
<input id="connectors_top_save" title="{$APP.LBL_SAVE_BUTTON_LABEL}" accessKey="{$APP.LBL_SAVE_BUTTON_KEY}" class="button" type="submit" value="{$APP.LBL_SAVE_BUTTON_LABEL}" onclick="return check_form('ModifyProperties') || confirm('{$mod.LBL_CONFIRM_CONTINUE_SAVE}');">
<input id="connectors_top_cancel" title="{$APP.LBL_CANCEL_BUTTON_LABEL}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="document.ModifyProperties.action.value='ConnectorSettings'; document.ModifyProperties.module.value='Connectors';" type="submit" value="{$APP.LBL_CANCEL_BUTTON_LABEL}">
</td>
<td align='right'>
<span class="required">{$APP.LBL_REQUIRED_SYMBOL}</span> {$APP.NTC_REQUIRED}
</td>
</tr>
</table>


<table cellspacing="0" cellpadding="0" border="0" width="100%">
<tr><td class="tabDetailViewDF">
<div >
<div id="container" style="height: 465px">

</div>
</div>
</td></tr>
</table>
<table border="0" class="actionsContainer">
<tr><td>
<input id="connectors_bottom_save" title="{$APP.LBL_SAVE_BUTTON_LABEL}"  class="button" type="submit" name="button" value="{$APP.LBL_SAVE_BUTTON_LABEL}" onclick="return check_form('ModifyProperties') || confirm('{$mod.LBL_CONFIRM_CONTINUE_SAVE}');">
<input id="connectors_bottom_cancel" title="{$APP.LBL_CANCEL_BUTTON_LABEL}"  class="button" onclick="document.ModifyProperties.action.value='ConnectorSettings'; document.ModifyProperties.module.value='Connectors';" type="submit" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}">
</td></tr>
</table>
</form>

<script type="text/javascript">
{literal}
YAHOO.util.Event.onDOMReady(SourceTabs.fitContainer);
{/literal}

{foreach name=required_fields from=$REQUIRED_FIELDS key=id item=fields}
	{foreach from=$fields key=field_key item=field_label}
		addToValidate("ModifyProperties", "{$id}_{$field_key}", "alpha", true, "{$field_label}");
	{/foreach}
{/foreach}
</script>
