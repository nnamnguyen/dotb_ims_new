{{*

*}}
{{if $rowData.TEAM_COUNT > 1}}
<span id='div_{{$rowData.ID}}_teams'>
{{$rowData.$col}}<a href="#" style='text-decoration:none;' onMouseOver="javascript:toggleMore('div_{{$rowData.ID}}_teams','img_{{$rowData.ID}}_teams', 'Teams', 'DisplayInlineTeams', 'team_set_id={{$rowData.TEAM_SET_ID}}&team_id={{$rowData.TEAM_ID}}');"  onFocus="javascript:toggleMore('div_{{$rowData.ID}}_teams','img_{{$rowData.ID}}_teams', 'Teams', 'DisplayInlineTeams', 'team_set_id={{$rowData.TEAM_SET_ID}}');" id='div_{{$rowData.ID}}_teams'>+</a>
</span>
{{else}}
{{$rowData.$col}}
{{/if}}
