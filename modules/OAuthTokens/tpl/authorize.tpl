{*

*}
<form name="OAuthAuthorize" method="POST" action="index.php" >
{dotb_csrf_form_token}
<input type='hidden' name='action' value='authorize'/>
<input type='hidden' name='module' value='OAuthTokens'/>
<input type='hidden' name='sid' value='{$sid}'/>
<input type='hidden' name='hash' value='{$hash}'/>
<input type='hidden' name='confirm' value='1'/>

{$consumer}<br/>
<table>
<tr>
<td>{$MOD.LBL_OAUTH_REQUEST}: </td><td><input name="token" value="{$token}"/></td>
</tr>
</table>

<input type="submit" name="authorize" value="{$MOD.LBL_OAUTH_AUTHORIZE}"/><br/>
</form>
