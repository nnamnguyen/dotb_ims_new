{*

*}


{include file="modules/DynamicFields/templates/Fields/Forms/coreTop.tpl"}

<tr>
	<td class='mbLBL'>{dotb_translate module="DynamicFields" label="LBL_IMAGE_WIDTH"}:</td>
	<td>
		<input id ="width" type="text" name="width" 
		{if !$vardef.width && !$vardef.height}
			value="120"
		{else}
			value="{$vardef.width}"
		{/if}
		>
		{dotb_help text=$mod_strings.LBL_POPHELP_IMAGE_WIDTH FIXX=300 FIXY=200}
	</td>
</tr>
<tr>
	<td class='mbLBL'>{dotb_translate module="DynamicFields" label="LBL_IMAGE_HEIGHT"}:</td>
	<td>
		<input id ="height" type="text" name="height" 
		{if !$vardef.width && !$vardef.height}
			value=""
		{else}
			value="{$vardef.height}"
		{/if}
		>
		{dotb_help text=$mod_strings.LBL_POPHELP_IMAGE_HEIGHT FIXX=300 FIXY=220}
	</td>
</tr>
<tr>
	<td class='mbLBL'>{dotb_translate module="DynamicFields" label="LBL_IMAGE_BORDER"}:</td>
	<td>	
		<input type="checkbox" id ="border" name="border" value="1" {if !empty($vardef.border)}checked{/if}/>
	</td>
</tr>
{include file="modules/DynamicFields/templates/Fields/Forms/coreBottom.tpl"}