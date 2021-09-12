{*

*}


<div style='width: 400px'>
<form name='configure_{$id}' action="index.php" method="post" onSubmit='return DOTB.dashlets.postForm("configure_{$id}", DOTB.myDotb.uncoverPage);'>
{dotb_csrf_form_token}
<input type='hidden' name='id' value='{$id}'>
<input type='hidden' name='module' value='{$module}'>
<input type='hidden' name='action' value='DynamicAction'>
<input type='hidden' name='DynamicAction' value='configureDashlet'>
<input type='hidden' name='to_pdf' value='true'>
<input type='hidden' name='configure' value='true'>
<input type='hidden' id='dashletType' name='dashletType' value='{$dashletType}' />

<table width="400" cellpadding="0" cellspacing="0" border="0" class="edit view" align="center">
    <tr>
    <td valign='top' class='dataLabel' nowrap>{$LBL_CAMPAIGN_NAME}</td>
    <td valign='top' class='dataField'>
    	<select name="campaign_id" size='5'>
    		{$campaign_list}
    	</select>
    </td>
    </tr>

	<tr>
	    <td align="right" colspan="2">
	        <input type='submit' onclick="" class='button' value='{$LBL_SUBMIT_BUTTON_LABEL}'>
	   	</td>
	</tr>
</table>
</form>
</div>
