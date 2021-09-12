{*

*}
<!-- Lumia Config -->
<script type="text/javascript" src="cache/config.js"></script>
<!-- CSS -->
{foreach from=$css_url item=url}
    <link rel="stylesheet" href="{$url}"/>
{/foreach}
<style>
    h2{literal}{line-height: 100%;}{/literal}
    body{literal}{padding-top: 0px;}{/literal}
</style>
<div id="portal_themeroller" style="">
    <div id="alerts" class="alert-top">
        <div class="alert alert-process">
            <strong>
                <div class="loading">
                    {$LBL_LOADING}<i class="l1">&#46;</i><i class="l2">&#46;</i><i class="l3">&#46;</i>
                </div>
            </strong>
        </div>
    </div>
    <div class="content">
    </div>
</div>




{literal}

<script language="javascript">
DOTB.App.config.platform = 'portal';

// set our auth Token
DOTB.App.dotbAuthStore.set('AuthAccessToken', {/literal}'{$token}'{literal});

// bootstrap token
(function (app) {
    app.augment("theme", {
        initTheme:function (authAccessToken) {
            app.AUTH_ACCESS_TOKEN = authAccessToken;
            app.AUTH_REFRESH_TOKEN = authAccessToken;
            app.init({
                el:"#portal_themeroller",
                contentEl:".content"
            });
            return app;
        }
    });
})(DOTB.App);
// Reset app if it already exists
if (App){
    App.destroy();
}
// Call initTheme with the session id as token
var App = DOTB.App.theme.initTheme({/literal}'{$token}'{literal});

// should already be logged in to dotb, don't need to log in to lumia.
App.api.isAuthenticated = function () {
    return true;
};

// Disabling the app sync complete event which starts lumias competing router
App.events.off("app:sync:complete");
//force app sync and load the appropriate view on success
App.sync(
        {
            callback:function (data) {
                $('#alerts').empty();
                App.controller.loadView({
                    layout:'themeroller',
                    create:true
                });
            },
            err:function (data) {
                console.log("app sync error");
            }
        }
);

</script>
{/literal}
