{*

*}
<table width="100%" id="formulaBuilder">
	<tr style=""><td colspan=3 style="border-bottom:1px solid #AAA; padding-bottom:2px;">
		<textarea type="text" name="formulaInput" id="formulaInput" style="width:490px;height:120px;position: relative;z-index:50">{$formula|escape:'html':'UTF-8'}</textarea>
	</td></tr>
	<tr id="fb_browse_row">
		<td id="functionsList" width="200">
            <input id="formulaFuncSearch" style="width:200px" class="empty"
			    value="{dotb_translate module="ModuleBuilder" label="LBL_SEARCH_FUNCS"}"/>
            <span class="id-ff multiple"><button id="formulaFuncClear" class="button"
                onclick="var i = Dom.get('formulaFuncSearch'); i.value='';i.onkeyup();i.focus()">
            	{dotb_image image="id-ff-clear.png" name="id-ff-clear" height="14" width="14"}
			</button><div id="funcSearchResults"></div></span>
            <div id="functionsGrid"></div>
        </td>
		<td id="fieldsList" width="200">
			<input id="formulaFieldsSearch" style="width:200px" class="empty"
			     value="{dotb_translate module="ModuleBuilder" label="LBL_SEARCH_FIELDS"}"/>
			<span class="id-ff multiple"><button id="formulaFieldClear" class="button"
			    onclick="var i=Dom.get('formulaFieldsSearch'); i.value='';i.onkeyup();i.focus()">
		      {dotb_image image="id-ff-clear.png" name="id-ff-clear" height="14" width="14"}
			</button><div id="fieldSearchResults"></div></span>
			<div id="fieldsGrid"></div>
		</td>
	</tr>
</table>
<div style="width:100%;text-align:right">
<input type='button' class='button' name='formulacancelbtn' value='{dotb_translate module="ModuleBuilder" label="LBL_BTN_CANCEL"}'
	onclick="DOTB.expressions.closeFormulaBuilder()" >
<input type='button' class='button' name='fomulaSaveButton' id="fomulaSaveButton" value='{dotb_translate module="ModuleBuilder" label="LBL_BTN_SAVE"}'
	onclick="if(DOTB.expressions.saveCurrentExpression('{$target|escape:javascript|escape:'html':'UTF-8'}', '{$returnType|escape:javascript|escape:'html':'UTF-8'}'))DOTB.expressions.closeFormulaBuilder()">
</div>
<script src="{dotb_getjspath file='modules/ExpressionEngine/javascript/formulaBuilder.js'}"></script>
<script type="text/javascript">
ModuleBuilder.addToHead("{dotb_getjspath file='modules/ExpressionEngine/tpls/formulaBuilder.css'}", "css");
ModuleBuilder.addToHead("{dotb_getjspath file='include/javascript/jquery/markitup/skins/simple/style.css'}", "css");
{literal}
var FBLoader = new YAHOO.util.YUILoader({
    require : ["formulabuilder"],
    loadOptional: true,
    skin: { base: 'blank', defaultSkin: '' },
    onSuccess: function(){DOTB.expressions.initFormulaBuilder()},
    allowRollup: true,
    base: "include/javascript/yui/build/"
});
FBLoader.addModule({
    name :"formulabuilder",
    type : "js",
    fullpath: "{/literal}{dotb_getjspath file='modules/ExpressionEngine/javascript/formulaBuilder.js'}{literal}",
    varName: "DOTB.expressions.initFormulaBuilder",
    requires: ["layout", "element"]
});
{/literal}
var fieldsArray = {$Field_Array};
var returnType = '{$returnType|escape:javascript}';
FBLoader.insert();
</script>
