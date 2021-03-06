{*

*}
<script type="text/javascript" src="{dotb_getjspath file='cache/javascript/dotbcrm12.min.js'}"></script>
<script type="text/javascript" src="{dotb_getjspath file='modules/Connectors/Connector.js'}"></script>
<link rel="stylesheet" type="text/css" href="{dotb_getjspath file='modules/Connectors/tpls/tabs.css'}"/>

{literal}

<script language="javascript">

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
			        dataSrc: {/literal}'index.php?module=Connectors&action=MappingProperties&source_id={$source.id}'{literal},
			        cacheData: true,
			        {/literal}
			        {if $source_count == 1}
			        active: true
			        {else}
			        active: false
			        {/if}
			        {literal}
			    });			    
			    _sourceArray[{/literal}{$source_count}{literal}-1] = '{/literal}{$source.id}';
			    tab.addListener('contentChange', SourceTabs.tabContentChanged);
			    tab.id = '{$source.id}';
			    _tabView.addTab(tab);
	       {/foreach}
		  {literal} 
  		_tabView.appendTo('container'); 
    },
    
    tabContentChanged: function(info) { 
    	tab = _tabView.get('activeTab');
        DOTB.util.evalScript(tab.get('content'));;
    },

    fitContainer: function() {
		_tabView = SourceTabs.getTabView();
		content_div = _tabView.getElementsByClassName('yui-content', 'div')[0];
		content_div.style.overflow='auto'; 
		content_div.style.height='405px';  
    },
     
    getTabView : function() {
        return _tabView;
    }
}
YAHOO.util.Event.onDOMReady(SourceTabs.init);
</script>
{/literal}
<form name="ModifyMapping" method="POST" onsubmit="return calculateValues();">
{dotb_csrf_form_token}
<input type="hidden" name="modify" value="true">
<input type="hidden" name="module" value="Connectors">
<input type="hidden" name="action" value="SaveModifyMapping">
<input type="hidden" name="source_id" value="">

{counter assign=source_count start=0 print=0} 
{foreach name=connectors from=$SOURCES key=name item=source}  
{counter assign=source_count}
<input type="hidden" name="source{$source_count}" value="{$source.id}">  
{/foreach}
<input type="hidden" name="mapping_values" value="">
<input type="hidden" name="mapping_sources" value="">
<input type="hidden" name="reset_to_default" value="">

<table border="0" class="actionsContainer">
<tr><td>
<input id="connectors_top_save" title="{$APP.LBL_SAVE_BUTTON_LABEL}" accessKey="{$APP.LBL_SAVE_BUTTON_KEY}" class="button" type="submit" value="{$APP.LBL_SAVE_BUTTON_LABEL}">
<input id="connectors_top_cancel" title="{$APP.LBL_CANCEL_BUTTON_LABEL}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="document.ModifyMapping.action.value='ConnectorSettings'; document.ModifyMapping.module.value='Connectors';" type="submit" value="{$APP.LBL_CANCEL_BUTTON_LABEL}">
</td></tr>
</table>
<table cellspacing="0" cellpadding="0" border="0" width="100%">
<tr><td>
<div>
<div id="container" style="height: 465px">
</div>
</div>
</td></tr>
</table>
<table border="0" class="actionsContainer">
<tr><td>
<input id="connectors_bottom_save" title="{$APP.LBL_SAVE_BUTTON_LABEL}" class="button" type="submit" value="{$APP.LBL_SAVE_BUTTON_LABEL}">
<input id="connectors_bottom_cancel" title="{$APP.LBL_CANCEL_BUTTON_LABEL}" class="button" onclick="document.ModifyMapping.action.value='ConnectorSettings'; document.ModifyMapping.module.value='Connectors';" type="submit" value="{$APP.LBL_CANCEL_BUTTON_LABEL}">
</td></tr>
</table>
</form>

{literal}
<script type="text/javascript">
function calculateValues() {
    tabview = SourceTabs.getTabView();
    mapping_vals = ''
    source_vals = '';
    sources = new Array();
    //Get the source divs
    elements = tabview.getElementsByClassName('sources_table_div', 'div');
    for(el in elements) {

        //Fix for IE6
        if(typeof elements[el] == 'function') {
           continue;
        }
        
        div_id = elements[el].getAttribute('id');
        source_id = div_id.substr(0, div_id.indexOf('_add_tables'));
        if(sources[source_id] == null) {
           sources[source_id] = source_id;
           source_vals += ',' + source_id;
        }
    }
    
    //Get the table elements
    tables = tabview.getElementsByClassName('mapping_table', 'table'); 
    for(t in tables) {

        //Fix for IE6
        if(typeof tables[t] == 'function') {
           continue;
        }

        select_elements = tables[t].getElementsByTagName("select");
        for(el in select_elements) {
            select_dom = document.getElementById(select_elements[el].id);
            if(select_dom != null && select_elements[el].value != '') {
               mapping_vals += ',' +  select_elements[el].getAttribute('id') + '=' + select_elements[el].value;
            }
        }
    }
    document.ModifyMapping.mapping_values.value = mapping_vals != '' ? mapping_vals.substr(1, mapping_vals.length) : '';
    document.ModifyMapping.mapping_sources.value = source_vals != '' ? source_vals.substr(1, source_vals.length) : '';
    return true;
}

YAHOO.util.Event.onDOMReady(SourceTabs.fitContainer);
</script>
{/literal}
