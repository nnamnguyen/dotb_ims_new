{*

*}


{include file="modules/DynamicFields/templates/Fields/Forms/coreTop.tpl"}
<tr>
	<td class='mbLBL'>{dotb_translate module="DynamicFields" label="COLUMN_TITLE_LABEL_ROWS"}:</td>
	<td>
	{if $hideLevel < 4}
		<input id ="rows" type="text" name="rows" value="{$vardef.rows|default:4}">
	{else}
		<input id ="rows" type="hidden" name="rows" value="{$vardef.rows}">{$vardef.rows}
	{/if}
	</td>
</tr>
<tr>
	<td class='mbLBL'>{dotb_translate module="DynamicFields" label="COLUMN_TITLE_LABEL_COLS"}:</td>
	<td>
	{if $hideLevel < 4}
		<input id ="cols" type="text" name="cols" value="{$vardef.cols|default:20}">
	{else}
		<input id ="cols" type="hidden" name="cols" value="{$vardef.displayParams.cols}">{$vardef.cols}
	{/if}
	</td>
</tr>
<tr>
	<td class='mbLBL'>{dotb_translate module="DynamicFields" label="COLUMN_TITLE_DEFAULT_VALUE"}:</td>
	<td>
	{if $hideLevel < 5}
		<textarea name='default' id='default' >{$vardef.default}</textarea>
	{else}
		<textarea name='default' id='default' disabled >{$vardef.default}</textarea>
		<input type='hidden' name='default' value='{$vardef.default}'/>
	{/if}
	</td>
</tr>
{include file="modules/DynamicFields/templates/Fields/Forms/coreBottom.tpl"}