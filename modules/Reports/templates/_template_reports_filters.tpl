{*

*}

<div id="filters_tab" style="display: none">
<span scope="row"><h5>{$mod_strings.LBL_FILTERS}:</h5></span>
{$mod_strings.LBL_FILTER_CONDITIONS}
 <select name='filters_combiner' id='filters_combiner'>
   <option value='AND' {$selectedAnd}>{$mod_strings.LBL_FILTER_AND}</option>
   <option value='OR' {$selectedOR}>{$mod_strings.LBL_FILTER_OR}</option>
</select>
{$mod_strings.LBL_FILTERS_END}
<br><br>
<input class=button type=button onClick='window.addFilter()' name='{$mod_strings.LBL_ADD_NEW_FILTER}' value='{$mod_strings.LBL_ADD_NEW_FILTER}'>
&nbsp;&nbsp;{$mod_strings.LBL_DATE_BASED_FILTERS}
<input type=hidden name='filters_def' value ="">
<table id='filters_top' border=0 cellpadding="0" cellspacing="0">
<tbody id='filters'></tbody>
</table>
</div>