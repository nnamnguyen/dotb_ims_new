{*

*}


{if $helpFileExists}
<html {$langHeader}>
<head>
<title>{$title}</title>
{$styleSheet}
<meta http-equiv="Content-Type" content="text/html; charset={$charset}">
</head>
<body onLoad='window.focus();'>
<table width='100%'>
<tr>
    <td align='right'>
        <a href='javascript:window.print()'>{$MOD.LBL_HELP_PRINT}</a> - 
        <a href='mailto:?subject="{$MOD.LBL_DOTBCRM_HELP}&body={$currentURL|escape:url}'>{$MOD.LBL_HELP_EMAIL}</a> -
        <a href='#' onmousedown="createBookmarkLink('{$MOD.LBL_DOTBCRM_HELP} - {$moduleName}', '{$currentURL|escape:url}')">{$MOD.LBL_HELP_BOOKMARK}</a>
    </td>
</tr>
</table>
<table class='edit view'>
<tr>
    <td>{include file="$helpPath"}</td>
</tr>
</table>
{literal}
<script type="text/javascript" language="JavaScript">
<!--
function createBookmarkLink(title, url){
    if (document.all)
        window.external.AddFavorite(url, title);
    else if (window.sidebar)
        window.sidebar.addPanel(title, url, "")
}
-->
</script>
{/literal}
</body>
</html>	
{else}
<IFRAME frameborder="0" marginwidth="0" marginheight="0" bgcolor="#FFFFFF" SRC="{$iframeURL}" TITLE="{$iframeURL}" NAME="DOTBIFRAME" ID="DOTBIFRAME" WIDTH="100%" height="1000"></IFRAME>
{/if}