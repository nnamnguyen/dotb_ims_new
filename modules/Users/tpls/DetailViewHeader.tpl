{*

*}
<script type='text/javascript' src='{dotb_getjspath file='modules/Users/DetailView.js'}'></script>
<script type="text/javascript" src="{dotb_getjspath file='cache/javascript/dotbcrm12.min.js'}"></script>
<script type='text/javascript'>
var LBL_NEW_USER_PASSWORD = '{$MOD.LBL_NEW_USER_PASSWORD_2}';
{if !empty($ERRORS)}
{literal}
YAHOO.DOTB.MessageBox.show({
    title: '{/literal}{$ERROR_MESSAGE|escape:javascript}{literal}',
    msg: '{/literal}{$ERRORS|escape:javascript}{literal}'
});
{/literal}
{/if}
</script>

<script type="text/javascript">
var user_detailview_tabs = new YAHOO.widget.TabView("user_detailview_tabs");

{literal}
user_detailview_tabs.on('contentReady', function(e){
{/literal}
{if $EDIT_SELF && $SHOW_DOWNLOADS_TAB}
{literal}
    user_detailview_tabs.addTab( new YAHOO.widget.Tab({
        label: '{/literal}{$MOD.LBL_DOWNLOADS}{literal}',
        dataSrc: 'index.php?to_pdf=1&module=Home&action=pluginList',
        content: '<div style="text-align:center; width: 100%">{/literal}{dotb_image name="loading"}{literal}</div>',
        cacheData: true
    }));
    user_detailview_tabs.getTab(3).getElementsByTagName('a')[0].id = 'tab4';
{/literal}
{/if}
});
{literal}
$(document).ready(function(){
        $("ul.clickMenu").each(function(index, node){
            $(node).dotbActionMenu();
        });
    });
{/literal}
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="actionsContainer">
<tr>
<td width="20%">

<form action="index.php" method="post" name="DetailView" id="form">
{dotb_csrf_form_token}
    <input type="hidden" name="module" value="Users">
    <input type="hidden" name="record" value="{$ID}">
    <input type="hidden" name="isDuplicate" value=false>
    <input type="hidden" name="action">
    <input type="hidden" name="user_name" value="{$USER_NAME}">
    <input type="hidden" id="user_type" name="user_type" value="{$UserType}">
    <input type="hidden" name="password_generate">
    <input type="hidden" name="old_password">
    <input type="hidden" name="new_password">
    <input type="hidden" name="return_module">
    <input type="hidden" name="return_action">
    <input type="hidden" name="return_id">
<table width="100%" cellpadding="0" cellspacing="0" border="0">

    <tr><td colspan='2' width="100%" nowrap>

            {dotb_action_menu id="detail_header_action_menu" class="clickMenu fancymenu" buttons=$EDITBUTTONS}

    </td></tr>
</table>
</form>

</td>
<td width="100%">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
{$PAGINATION}
</table>
</td>
</tr>
</table>
<div id="user_detailview_tabs" class="yui-navset detailview_tabs">
    <ul class="yui-nav">
        <li class="selected"><a id="tab1" href="#tab1"><em>{$MOD.LBL_USER_INFORMATION}</em></a></li>
        <li {if $IS_GROUP_OR_PORTAL}style="display: none;"{/if}><a id="tab2" href="#tab2"><em>{$MOD.LBL_ADVANCED}</em></a></li>
        {if $SHOW_ROLES}
        <li><a id="tab3" href="#tab3"><em>{$MOD.LBL_USER_ACCESS}</em></a></li>
        {/if}
    </ul>
    <div class="yui-content">
        <div>
