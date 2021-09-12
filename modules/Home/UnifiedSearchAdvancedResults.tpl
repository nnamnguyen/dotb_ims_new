{*

*}

    	var SubpanelInit = function() {
    		SubpanelInitTabNames(["quotes","activities","opportunities","history","leads","campaigns","cases","contacts"]);
    	}
        var SubpanelInitTabNames = function(tabNames) {
    		subpanel_dd = new Array();
    		j = 0;
    		for(i in tabNames) {
    			subpanel_dd[j] = new ygDDList('whole_subpanel_' + tabNames[i]);
    			subpanel_dd[j].setHandleElId('subpanel_title_' + tabNames[i]);
    			subpanel_dd[j].onMouseDown = DOTB.subpanelUtils.onDrag;
    			subpanel_dd[j].afterEndDrag = DOTB.subpanelUtils.onDrop;
    			j++;
    		}

    		YAHOO.util.DDM.mode = 1;
    	}
    	currentModule = 'Contacts';
    	YAHOO.util.Event.addListener(window, 'load', SubpanelInit);

<script type='text/javascript'>
{literal}
var GlobalSearchOnDrag = function()
{
//console.log('dragging');
}

var GlobalSearchOnDrop = function()
{
//console.log('dropping');
}

{/literal}

var GlobalSearchInit = function()
{ldelim}
//console.log('loading...');
subpanel_dd = new Array();

{foreach from=$MODULE_RESULTS name=m key=module item=info}
subpanel_dd[{$module}] = new ygDDList('whole_subpanel_' + {$module});
subpanel_dd[{$module}].setHandleElId('div_' + {$module});
subpanel_dd[{$module}].onMouseDown = GlobalSearchOnDrag;
subpanel_dd[{$module}].afterEndDrag = GlobalSearchOnDrop;
{/foreach}	

YAHOO.util.DDM.mode = 1;
{rdelim}

YAHOO.util.Event.addListener(window, 'load', GlobalSearchInit);

</script>