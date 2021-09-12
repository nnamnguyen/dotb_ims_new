{*

*}

<span scope="row"><h5>{$mod_strings.LBL_GROUP_BY}:</h5></span>
<table width="100%" cellpadding=0 cellspacing=0>
<tr id="group_by_button">
<td align=left>
<input class=button type=button onClick='addGroupByFromButton()' name='Add Column' value='{$mod_strings.LBL_ADD_COLUMN}'>
</td>
</tr>
</table>
<input type=hidden name='group_by_def' value =""/>
<div id='group_by_div'>
<table id='group_by_table' border="0" cellpadding="0" cellspacing="0">
<tbody id='group_by_tbody'></tbody>
</table>
</div>