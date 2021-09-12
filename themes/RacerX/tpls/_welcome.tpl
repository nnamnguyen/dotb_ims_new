{*

*}

{if $AUTHENTICATED}
<div id="welcome">
    {$APP.NTC_WELCOME}, <strong><a id="welcome_link" href='index.php?module=Users&action=EditView&record={$CURRENT_USER_ID}'>{$CURRENT_USER}</a></strong> <span>|</span> <a id="logout_link" href='{$LOGOUT_LINK}' class='utilsLink'>{$LOGOUT_LABEL}</a> 
</div>
{/if}