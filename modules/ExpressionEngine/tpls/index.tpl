{*

*}
<script src="{dotb_getjspath file='include/javascript/dotbwidgets/DotbYUILoader.js'}"></script>
{literal}
<script type="text/javascript">
var loader = new YAHOO.util.YUILoader({
    require : ["dotbwidgets"],
    loadOptional: true,
    skin: { base: 'blank', defaultSkin: '' },
	onSuccess: function(){console.log("loaded")},
    allowRollup: true,
    base: "include/javascript/yui/build/"
});
loader.addModule({
    name :"dotbwidgets",
    type : "js",
{/literal}
    fullpath: "{dotb_getjspath file='include/javascript/dotbwidgets/DotbYUIWidgets.js'}",
{literal}
    varName: "YAHOO.DOTB",
    requires: ["datatable", "dragdrop", "treeview", "tabview"]
});
loader.insert();
var DDEditorWindow = false;
showEditor = function() {
    if (!DDEditorWindow)
        DDEditorWindow = new YAHOO.DOTB.AsyncPanel('DDEditorWindow', {
            width: 256,
            draggable: true,
            close: true,
            constraintoviewport: true,
            fixedcenter: false,
            script: true,
            modal: true
        });
    var win = DDEditorWindow;
    win.setHeader("Dropdown Editor");
    win.setBody("loading...");
    win.render(document.body);
    win.params = {
        module:"ExpressionEngine",
        action:"editDepDropdown",
        loadExt:false,
        embed: true,
        view_module:"Accounts",
        field: 'sub_industry_c',
        package:"",
        to_pdf:1
    };
    win.load('index.php?' + DOTB.util.paramsToUrl(win.params), null, function()
    {
        DDEditorWindow.center();
        DOTB.util.evalScript(DDEditorWindow.body.innerHTML);
    });
    win.show();
    win.center();
}
</script>
{/literal}
<input class="button" type="button" onclick="showEditor()" value="Show"/>
<div id="editorDiv"></div>