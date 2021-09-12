{*

*}
{dotb_getscript file="lumia/minified/lumia.min.js"}
{dotb_getscript file="cache/config.js"}
{dotb_getscript file="cache/include/javascript/dotb_grp7.min.js"}
<script language="javascript">
    var App;
    App = DOTB.App.init({ldelim}
    {rdelim});
    App.logout();
    document.location = "{$REDIRECT_URL}";
</script>
