{*

*}


{include file="modules/DynamicFields/templates/Fields/Forms/coreTop.tpl"}
<tr><td class='mbLBL'>{dotb_translate module="DynamicFields" label="COLUMN_TITLE_DEFAULT_VALUE"}:</td><td><input type='checkbox' id='default' name='default' value=1 {if !empty($vardef.default) }checked{/if} {if $hideLevel > 5}disabled{/if} />{if $hideLevel > 5}<input type='hidden' name='default' value='{$vardef.default}'>{/if}</td></tr>
{include file="modules/DynamicFields/templates/Fields/Forms/coreBottom.tpl"}