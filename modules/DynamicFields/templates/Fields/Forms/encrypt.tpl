{*

*}

{include file="modules/DynamicFields/templates/Fields/Forms/coreTop.tpl"}
<tr>
	<td class='mbLBL'>{dotb_translate module="DynamicFields" label="COLUMN_TITLE_DEFAULT_VALUE"}:</td><td>
	{if $hideLevel < 5}
		<input type='text' name='default' id='default' value='{$vardef.default}'>
	{else}
		<input type='hidden' name='default' id='default' value='{$vardef.default}'>{$vardef.default}
	{/if}
	</td>
</tr>
{include file="modules/DynamicFields/templates/Fields/Forms/coreBottom.tpl"}