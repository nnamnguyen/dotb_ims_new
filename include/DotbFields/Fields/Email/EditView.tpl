{*

*}
{php}
global $emailInstances;
if (empty($emailInstances))
    $emailInstances = array();
if (!isset($emailInstances[$this->_tpl_vars['module']]))
    $emailInstances[$this->_tpl_vars['module']] = 0;
$this->_tpl_vars['index'] = $emailInstances[$this->_tpl_vars['module']];
$emailInstances['module']++;
{/php}
<script type="text/javascript" language="javascript">
var emailAddressWidgetLoaded = false;
</script>
<script type="text/javascript" src="include/DotbEmailAddress/DotbEmailAddress.js"></script>
<script type="text/javascript">
    var module = '{$module}';
</script>
<table style="border-spacing: 0pt;">
    <tr>
	<td  valign="top" NOWRAP>
	    <table id="{$module}emailAddressesTable{$index}" class="emailaddresses">
		<tbody id="targetBody"></tbody>
		<tr>
		    <td scope="row" NOWRAP>
		        <input type=hidden id="{$module}_email_widget_id" name="{$module}_email_widget_id" value="">
			<input type=hidden id='emailAddressWidget' name='emailAddressWidget' value='1'>
                {capture assign="other_attributes"}id="{$module}{$index}_email_widget_add" onclick="javascript:DOTB.EmailAddressWidget.instances.{$module}{$index}.addEmailAddress('{$module}emailAddressesTable{$index}','','');"{/capture}
                {capture assign=alt_addButton}{dotb_translate label='LBL_ID_FF_ADD'}{/capture}
                <button type="button" {$other_attributes}>{dotb_getimage name="id-ff-add" alt="$alt_addButton" ext=".png"}</button>
		    </td>
		    <td scope="row" NOWRAP>
		        &nbsp;
		    </td>
		    <td scope="row" NOWRAP>
			{$APP.LBL_EMAIL_PRIMARY}
		    </td>
		    {if $useReplyTo == true}
		    <td scope="row" NOWRAP>
			{$APP.LBL_EMAIL_REPLY_TO}
		    </td>
		    {/if}
		    {if $useOptOut == true}
		    <td scope="row" NOWRAP>
			{$APP.LBL_EMAIL_OPT_OUT}
		    </td>
		    {/if}
		    {if $useInvalid == true}
		    <td scope="row" NOWRAP>
			{$APP.LBL_EMAIL_INVALID}
		    </td>
		    {/if}
		</tr>
	    </table>
	</td>
    </tr>
</table>
<input type="hidden" name="useEmailWidget" value="true">
<script type="text/javascript" language="javascript">
DOTB_callsInProgress++;
function init{$module}Email{$index}(){ldelim}
    if(emailAddressWidgetLoaded || DOTB.EmailAddressWidget){ldelim}
	var table = YAHOO.util.Dom.get("{$module}emailAddressesTable{$index}");
        var eaw = DOTB.EmailAddressWidget.instances.{$module}{$index} = new DOTB.EmailAddressWidget("{$module}");
	eaw.emailView = '{$emailView}';
        eaw.emailIsRequired = "{$required}";
        eaw.tabIndex = '{$tabindex}';
        var addDefaultAddress = '{$addDefaultAddress}';
        var prefillEmailAddress = '{$prefillEmailAddresses}';
        var prefillData = {$prefillData|default:"new Object()"};
        if(prefillEmailAddress == 'true') {ldelim}
            eaw.prefillEmailAddresses('{$module}emailAddressesTable{$index}', prefillData);
	{rdelim} else if(addDefaultAddress == 'true') {ldelim}
            eaw.addEmailAddress('{$module}emailAddressesTable{$index}');
	{rdelim}
	if('{$module}_email_widget_id') {ldelim}
	   document.getElementById('{$module}_email_widget_id').value = eaw.count;
	{rdelim}
	DOTB_callsInProgress--;
        //if the form has already been registered, re-register it with the new element
        var form = Dom.getAncestorByTagName(table, "form");
        if (DOTB.forms.AssignmentHandler.VARIABLE_MAP[form.name])
            DOTB.forms.AssignmentHandler.registerForm(form.name, form);
    {rdelim}else{ldelim}
	setTimeout("init{$module}Email{$index}();", 500);
    {rdelim}
{rdelim}

YAHOO.util.Event.onDOMReady(init{$module}Email{$index});
</script>
