{*

*}
<form name='search_form'>
{dotb_csrf_form_token}
<input type='hidden' name='module' value='Reports'/>
<input type='hidden' name='action' value='index'/>
<input type='hidden' name='query' value='true'/>
<table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom: 4px" class="edit view">
<tr><td>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top: 4px; margin-bottom: 4px;">
        <tr valign='top'>
    		<td scope="row" noWrap><span dotb='slot1'>{$MOD.LBL_TITLE}:</td><td ><input type=text tabindex='1' size="20" name="name" class=dataField  value="{$NAME}" /></span dotb='slot'></td>
    		<td scope="row" noWrap><span valign='top' dotb='slot1b'>{$MOD.LBL_MODULE}:</td><td ><select size="3" tabindex='1' name='report_module[]' multiple="multiple">{$MODULES}</select></span dotb='slot'></td>
			<td scope="row" noWrap><span valign='top' dotb='slot1b'>{$MOD.LBL_REPORT_TYPE}:</span dotb='slot'></td><td ><select size='3' name='report_type[]' multiple='multiple'>{$REPORT_TYPES}</select></td>
		</tr>
    	<tr valign='top'>
    		<td scope="row" colspan='2'>{$APP.LBL_CURRENT_USER_FILTER}&nbsp;&nbsp;<input name='current_user_only' tabindex='1' onchange='this.form.submit();' class="checkbox" type="checkbox" {$CURRENT_USER_ONLY}></td>
    		<td scope="row" noWrap valign='top'><span dotb='slot2'>{$APP.LBL_ASSIGNED_TO}</td><td ><select size="3" tabindex='1' name='assigned_user_id[]' multiple="multiple">{$USER_FILTER}</select></span dotb='slot'></td>
			<td scope="row" noWrap valign='top'><span dotb='slot2b'>{$APP.LBL_TEAM}</td><td ><select size="3" tabindex='1' name='team_id[]' multiple="multiple">{$TEAM_FILTER}</select></span dotb='slot'></td>
	   </tr>
	</table>
</td></tr>
</table>
<input tabindex='2' title='{$APP.LBL_SEARCH_BUTTON_TITLE}' onclick='DOTB.savedViews.setChooser()' class='button' type='submit' name='button' value='{$APP.LBL_SEARCH_BUTTON_LABEL}' id='search_form_submit'/>
<input tabindex='2' title='{$APP.LBL_CLEAR_BUTTON_TITLE}' onclick='DOTB.searchForm.clear_form(this.form); return false;' class='button' type='button' name='clear' value=' {$APP.LBL_CLEAR_BUTTON_LABEL} ' id="search_form_clear"/>
</form>
