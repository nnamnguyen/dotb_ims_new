{*

*}

<script type="text/javascript" src="{dotb_getjspath file='modules/EAPM/EAPMEdit.js'}"></script>
<script type="text/javascript" src="{dotb_getjspath file='cache/include/externalAPI.cache.js'}"></script>
<script type="text/javascript">
EAPMFormName = 'EditView';
EAPMOAuthNotice = '{$MOD.LBL_OAUTH_SAVE_NOTICE}';
EAPMBAsicAuthNotice = '{$MOD.LBL_BASIC_SAVE_NOTICE}';
YAHOO.util.Event.onDOMReady(function() {ldelim}
EAPMEditStart(
{if is_admin($current_user) } true {else} false {/if}
);
{rdelim});
</script>
