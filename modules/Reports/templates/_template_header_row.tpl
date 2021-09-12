{*

*}

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="list view">
{if ($show_pagination neq "")}
{$pagination_data}
{/if}
<tr height="20">
{if ($isSummaryCombo)}
<td scope="col" align='center'  valign=middle nowrap>&nbsp;</td>
{/if}
{if ($isSummaryComboHeader)}
<td><span id="img_{$divId}"><a href="javascript:expandCollapseComboSummaryDiv('{$divId}')"><img width="8" height="8" border="0" absmiddle="" alt=$mod_strings.LBL_SHOW src="{$image_path}advanced_search.gif"/></a></span></td>
{/if}
{php}
	$count = 0;
	$this->assign('count', $count);
{/php}
{foreach from=$header_row key=module item=cell}
	{if (($args.group_column_is_invisible != "") && ($args.group_pos eq $count))}
{php}	
	$count = $count + 1;
	$this->assign('count', $count);
{/php}
	{ else }
	<td scope="col" align='center'  valign=middle nowrap>	
	
	{$cell}
	{/if}
{/foreach}
</tr>