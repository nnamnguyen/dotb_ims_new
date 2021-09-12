{*

*}
{include file="modules/DynamicFields/templates/Fields/Forms/coreTop.tpl"}
<tr>
	<td class='mbLBL'>{dotb_translate module="DynamicFields" label="LBL_MODULE"}:</td>
	<td>
	{if $hideLevel == 0}
		{html_options name="ext2" id="ext2" selected=$vardef.module options=$modules}
	{else}
		<input type='hidden' name='ext2' value='{$vardef.module}'>{$vardef.module}
	{/if}
	<input type='hidden' name='ext3' value='{$vardef.id_name}'>
	</td>
</tr>
{include file="modules/DynamicFields/templates/Fields/Forms/coreBottom.tpl"}