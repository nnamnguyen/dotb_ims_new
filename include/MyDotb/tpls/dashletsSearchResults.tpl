{*

*}
<h4>{$lblSearchResults} - <i>{$searchString|escape:'html':'UTF-8'}</i>:</h4>
<hr>
{if count($dashlets)}
<h3>{$searchCategoryString}</h3>
<table width="95%">
	{counter assign=rowCounter start=0 print=false}
	{foreach from=$dashlets item=module}
	{if $rowCounter % 2 == 0}
	<tr>
	{/if}
		<td width="50%" align="left"><a href="javascript:void(0)" onclick="{$module.onclick}">{$module.icon}</a>&nbsp;<a class="mbLBLL" href="#" onclick="{$module.onclick}">{$module.title}</a><br /></td>
	{if $rowCounter % 2 == 1}
	</tr>
	{/if}
	{counter}
	{/foreach}
</table>
{/if}
