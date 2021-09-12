<iframe id="yui-history-iframe" src="index.php?entryPoint=getImage&imageName=dotb-yui-sprites-grey.png" title="index.php?entryPoint=getImage&imageName=dotb-yui-sprites-grey.png"></iframe>
<input id="yui-history-field" type="hidden">
<div class='ytheme-gray' id='mblayout' style="position:relative; height:0px; overflow:visible;">
</div>
<div id='mbcenter'>
    <div id='mbtabs'></div>
    {$CENTER}
</div>

<div id='mbeast' class="x-layout-inactive-content">
    {$PROPERTIES}
</div>
<div id='mbeast2' class="x-layout-inactive-content">
</div>
<div id='mbhelp' class="x-hidden"></div>
<div id='mbwest' class="x-hidden">
    <div id='package_tree' class="x-hidden"></div>
    {$TREE}
</div>
<div id='mbsouth' class="x-hidden">
</div>
{$tiny}
<script>
    ModuleBuilder.setMode({$TYPE});
    closeMenus();
    {literal}
    //document.getElementById('HideHandle').parentNode.style.display = 'none';
    var MBLoader = new YAHOO.util.YUILoader({
        require: ["layout", "element", "tabview", "treeview", "history", "cookie", "dotbwidgets"],
        loadOptional: true,
        skin: {base: 'blank', defaultSkin: ''},
        onSuccess: ModuleBuilder.init,
        allowRollup: true,
        base: "include/javascript/yui/build/"
    });
    MBLoader.addModule({
        name: "dotbwidgets",
        type: "js",
        {/literal}
        fullpath: "{dotb_getjspath file='include/javascript/dotbwidgets/DotbYUIWidgets.js'}",
        {literal}
        varName: "YAHOO.DOTB",
        requires: ["datatable", "dragdrop", "treeview", "tabview"]
    });
    MBLoader.insert();
    {/literal}
</script>
<div id="footerHTML" class="y-hidden">
    <table width="100%" cellpadding="0" cellspacing="0">
    </table>
</div>
{include file='modules/ModuleBuilder/tpls/assistantJavascript.tpl'}
