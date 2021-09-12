{*

*}


<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="list view">
	<tr>
		<th>&nbsp;</td>
		<th align="center">{$lbl_campaign_name}</td>
		<th align="center">{$lbl_revenue}</td>
	</tr>
	{counter name="num" assign="num"}
	{foreach from=$top_campaigns item="campaign"}
	<tr>
		<td class="oddListRowS1" align="center" valign="top" width="6%">{$num}.</td>
		<td class="oddListRowS1" align="left" valign="top" width="74%"><a href="index.php?module=Campaigns&action=DetailView&record={$campaign.campaign_id}">{$campaign.campaign_name}</a></td>
		<td class="oddListRowS1" align="left" valign="top" width="20%">{$campaign.revenue}</td>
	</tr>
	{counter name="num"}
	{/foreach}
</table>
