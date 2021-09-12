{*

*}
	<!-- Begin Campaign Diagnostic Link -->	
	{$CAMPAIGN_DIAGNOSTIC_LINK}
	<!-- End Campaign Diagnostic Link -->
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		<td  colspan="3"><h3>{$MOD.LBL_WIZ_NEWSLETTER_TITLE_STEP1} </h3></div></td>
		<td colspan="1">&nbsp;</td>
		</tr>
		<tr><td class="datalabel" colspan="3">{$MOD.LBL_WIZARD_HEADER_MESSAGE}<br></td><td>&nbsp;</td></tr>
		<tr><td class="datalabel" colspan="4">&nbsp;</td></tr>
		<tr>
		<td width="17%" scope="col"><span dotb='slot1'>{$MOD.LBL_NAME} <span class="required">{$APP.LBL_REQUIRED_SYMBOL}</span></span dotb='slot'></td>
		<td width="33%" ><span dotb='slot1b'><input id='name' name='wiz_step1_name' aria-required="true"  title='{$MOD.LBL_NAME}' {$DISABLED}  size='50' maxlength='50' type="text" value="{$CAMP_NAME}" ></span dotb='slot'></td>
		<td width="15%" scope="col"><span dotb='slot2'>{$APP.LBL_ASSIGNED_TO}</span dotb='slot'></td>
		<td width="35%" ><span dotb='slot2b'><input class="sqsEnabled" autocomplete="off" id="assigned_user_name" name="wiz_step1_assigned_user_name"  title='{$APP.LBL_ASSIGNED_TO}' type="text" value="{$ASSIGNED_USER_NAME}"><input id='assigned_user_id' name='wiz_step1_assigned_user_id' type="hidden" value="{$ASSIGNED_USER_ID}" />
		<input title="{$APP.LBL_SELECT_BUTTON_TITLE}" type="button" class="button" value='{$APP.LBL_SELECT_BUTTON_LABEL}' name=btn1
				onclick='open_popup("Users", 600, 400, "", true, false, {$encoded_users_popup_request_data});' /></span dotb='slot'>
		</td>
		</tr>
		<tr>
		<td width="15%" scope="col"><span dotb='slot3'>{$MOD.LBL_CAMPAIGN_STATUS} <span class="required">{$APP.LBL_REQUIRED_SYMBOL}</span></span dotb='slot'></td>
		<td width="35%" ><span dotb='slot3b'><select id='status' name='wiz_step1_status'  aria-required="true" title='{$MOD.LBL_CAMPAIGN_STATUS}'>{$STATUS_OPTIONS}</select></span dotb='slot'></td>

		<td width="15%" scope="col"><span dotb='slot4'>{$APP.LBL_TEAM} <span class="required">{$APP.LBL_REQUIRED_SYMBOL}</span></span dotb='slot'></td>
		<td width="35%" ><span dotb='slot4b'>{$TEAM_SET_FIELD}</span dotb='slot'></td>
		</tr>
		<tr>
		<td scope="col"><span dotb='slot5'>{$MOD.LBL_CAMPAIGN_START_DATE} </span dotb='slot'></td>
		<td ><span dotb='slot5b'><input id='start_date' name='wiz_step1_start_date' title='{$MOD.LBL_CAMPAIGN_START_DATE}' onblur="parseDate(this, '{$CALENDAR_DATEFORMAT}');"  type="text" size='11' maxlength='10' value="{$CAMP_START_DATE}"> {dotb_getimage name="jscalendar" ext=".gif" alt=$APP.LBL_ENTER_DATE other_attributes='align="absmiddle" id="start_date_trigger" '} <span class="dateFormat">{$USER_DATEFORMAT}</span></span dotb='slot'></td>
		<td scope="col"><span dotb='slot6'>{$MOD.LBL_CAMPAIGN_TYPE} </td>
		<td><span dotb='slot6b'><{$SHOULD_TYPE_BE_DISABLED} id='campaign_type' title='{$MOD.LBL_CAMPAIGN_TYPE}' name='wiz_step1_campaign_type' >{$CAMPAIGN_TYPE_OPTIONS}</select></span dotb='slot'></td>
		</tr>
		<tr>
		<td scope="col"><span dotb='slot7'>{$MOD.LBL_CAMPAIGN_END_DATE} <span class="required">{$APP.LBL_REQUIRED_SYMBOL}</span></span dotb='slot'></td>
		<td ><span dotb='slot7b'><input id='end_date' name='wiz_step1_end_date'  aria-required="true" title='{$MOD.LBL_CAMPAIGN_END_DATE}' onblur="parseDate(this, '{$CALENDAR_DATEFORMAT}');"  type="text"s size='11' maxlength='10' value="{$CAMP_END_DATE}"> {dotb_getimage name="jscalendar" ext=".gif" alt=$APP.LBL_ENTER_DATE other_attributes='align="absmiddle" id="end_date_trigger" '} <span class="dateFormat">{$USER_DATEFORMAT}</span></span dotb='slot'></td>
		<td scope="col"><span dotb='slot8'>{$FREQUENCY_LABEL} </span dotb='slot'></td>
		<td><span dotb='slot8b'><{$HIDE_FREQUENCY_IF_NEWSLETTER}  id='frequency' name='wiz_step1_frequency' title='{$MOD.LBL_CAMPAIGN_FREQUENCY}'>{$FREQ_OPTIONS}</select></span dotb='slot'></td>
		</tr>
		<tr>
		<td width="15%"><span dotb='slot9'>&nbsp;</span></span dotb='slot'></td>
		<td width="35%" ><span sugeeear='slot9b'>&nbsp;</span dotb='slot'></td>
		<td ><span dotb='slot10'>&nbsp;</span dotb='slot'></td>
		<td><span dotb='slot10b'>&nbsp;</span dotb='slot'></td>
		</tr>
		<tr>
		<td valign="top" scope="row"><span dotb='slot10'>{$MOD.LBL_CAMPAIGN_CONTENT}</span dotb='slot'></td>
		<td colspan="3"><span dotb='slot10a'><textarea id='wiz_content' name='wiz_step1_content' title='{$MOD.LBL_CAMPAIGN_CONTENT}'  cols="110" rows="5">{$CONTENT}</textarea></span dotb='slot'></td>
		</tr>
		<tr>
		<td scope="row">&nbsp;</td>
		<td>&nbsp;</td>
		<td scope="row">&nbsp;</td>
		<td>&nbsp;</td>
		</tr>
	</table><p>

	{literal}
	<script type="text/javascript">
		Calendar.setup ({{/literal}
			inputField : "start_date", ifFormat : "{$CALENDAR_DATEFORMAT}", showsTime : false, button : "start_date_trigger", singleClick : true, step : 1, weekNumbers:false
			{literal}
		});
		
		Calendar.setup ({{/literal}
			inputField : "end_date", ifFormat : "{$CALENDAR_DATEFORMAT}", showsTime : false, button : "end_date_trigger", singleClick : true, step : 2, weekNumbers:false
		{literal}
		});
	

    /*
     * this is the custom validation script that will validate the fields on step1 of wizard
     */
    
    function validate_step1(){
        //loop through and check for empty strings ('  ')
        requiredTxt = DOTB.language.get('app_strings', 'ERR_MISSING_REQUIRED_FIELDS');
        var stepname = 'wiz_step_1_';
        var has_error = 0;
        var fields = new Array();
        fields[0] = 'name'; 
        fields[1] = 'status';
        fields[2] = 'end_date';

        fields[3] = 'team_name';
        
        var field_value = ''; 
        for (i=0; i < fields.length; i++){
            if(document.getElementById(fields[i]) !=null){
                field_value = trim(document.getElementById(fields[i]).value);
                if(field_value.length<1){
                //throw error if string is empty            
                add_error_style('wizform', fields[i], requiredTxt +' ' +document.getElementById(fields[i]).title );
                has_error = 1;
                }
            }
        }
        if(has_error == 1){
            //error has been thrown, return false
            return false;
        }
        //add fields to validation and call generic validation script 
        if(validate['wizform']!='undefined'){delete validate['wizform']};
        addToValidate('wizform', 'name', 'alphanumeric', true,  document.getElementById('name').title);

		addToValidate('wizform', 'team_name', 'alphanumeric', true,  document.getElementById('team_name').title);
        addToValidate('wizform', 'status', 'alphanumeric', true,  document.getElementById('status').title);
        addToValidate('wizform', 'end_date', 'date', true,  document.getElementById('end_date').title);
        addToValidate('wizform', 'start_date', 'date', false,  document.getElementById('start_date').title);
        addToValidate('wizform', 'currency_id', 'alphanumeric', false,  document.getElementById('currency_id').title);


		addToValidate('wizform', 'team_name', 'teamset', true, DOTB.language.get('app_strings', 'LBL_TEAMS'));

        return check_form('wizform');
    }    





	</script>
	{/literal}
