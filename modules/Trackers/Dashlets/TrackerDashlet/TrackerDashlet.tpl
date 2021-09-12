{*

*}
<div class='ytheme-gray' id="datepicker" style="z-index: 9999; position:absolute; width:50px;"></div>
<div id='trackercontent_div_{$id}'></div>
{literal}
<script type="text/javascript">
var tracker_dashlet;

function onLoadDoInit() {
{/literal}
tracker_dashlet = new TrackerDashlet();
tracker_dashlet.init('{$id}', {$height});
tracker_dashlet.comboChanged();
{literal}
}

YAHOO.util.Event.onDOMReady(function(){            
var reportLoader = new YAHOO.util.YUILoader({
	require : ["layout","element"],
	loadOptional: true,
    // Bug #48940 Skin always must be blank
    skin: {
        base: 'blank',
        defaultSkin: ''
    },
	onSuccess : onLoadDoInit,
	base : "include/javascript/yui/build/"
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
});
</script>
{/literal}
