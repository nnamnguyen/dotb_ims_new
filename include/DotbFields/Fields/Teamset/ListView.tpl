{*

*}
{if $parentFieldArray.TEAM_COUNT > 1}
<span id='div_{$parentFieldArray.ID}_teams'>
{$parentFieldArray.$col}<a href="#" style='text-decoration:none;' onMouseOver="javascript:toggleMore('div_{$parentFieldArray.ID}_teams','img_{$parentFieldArray.ID}_teams', 'Teams', 'DisplayInlineTeams', 'team_set_id={$parentFieldArray.TEAM_SET_ID}&team_id={$parentFieldArray.TEAM_ID}');"  onFocus="javascript:toggleMore('div_{$parentFieldArray.ID}_teams','img_{$parentFieldArray.ID}_teams', 'Teams', 'DisplayInlineTeams', 'team_set_id={$parentFieldArray.TEAM_SET_ID}');" id='more_feather'>+</a>
</span>
{else}
{$parentFieldArray.$col}
{/if}