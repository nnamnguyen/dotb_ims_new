<!DOCTYPE HTML>
<html class="no-js">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <meta charset="UTF-8">
    <title>CRM</title>
    <link rel="shortcut icon" href="{dotb_getjspath file='themes/default/images/logo.png'}">
    <link rel="stylesheet" href="styleguide/assets/css/loading.css" type="text/css">
    {foreach from=$css_url item=url}
        <link rel="stylesheet" href="{dotb_getjspath file=$url}"/>
    {/foreach}
    {dotb_getscript file="include/javascript/modernizr.js"}
</head>
<body>
<div id="dotbcrm">
    <div id="lumia">
        <div id="alerts" class="alert-top">
            <div class="alert-wrapper">
                <div class="alert alert-process" style="margin-top: 20%;text-align: center;min-height: 0;padding: 0px 35px;border-color: #19305930;border-radius: 5px;margin-top:15%;background-color: #19305930;">
                    <strong>
                        <svg class="lds-ellipsis" display="inherit" style="width:70px" preserveAspectRatio="xMidYMid" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="84" cy="50" r="0" fill="#08A69E">
                                <animate attributeName="r" begin="0s" calcMode="spline" dur="1.5s" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" keyTimes="0;0.25;0.5;0.75;1" repeatCount="indefinite" values="10;0;0;0;0"/>
                                <animate attributeName="cx" begin="0s" calcMode="spline" dur="1.5s" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" keyTimes="0;0.25;0.5;0.75;1" repeatCount="indefinite" values="84;84;84;84;84"/>
                            </circle>
                            <circle cx="49.673" cy="50" r="10" fill="#2fc36a">
                                <animate attributeName="r" begin="-0.75s" calcMode="spline" dur="1.5s" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" keyTimes="0;0.25;0.5;0.75;1" repeatCount="indefinite" values="0;10;10;10;0"/>
                                <animate attributeName="cx" begin="-0.75s" calcMode="spline" dur="1.5s" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" keyTimes="0;0.25;0.5;0.75;1" repeatCount="indefinite" values="16;16;50;84;84"/>
                            </circle>
                            <circle cx="16" cy="50" r="9.9039" fill="#16325C">
                                <animate attributeName="r" begin="-0.375s" calcMode="spline" dur="1.5s" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" keyTimes="0;0.25;0.5;0.75;1" repeatCount="indefinite" values="0;10;10;10;0"/>
                                <animate attributeName="cx" begin="-0.375s" calcMode="spline" dur="1.5s" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" keyTimes="0;0.25;0.5;0.75;1" repeatCount="indefinite" values="16;16;50;84;84"/>
                            </circle>
                            <circle cx="84" cy="50" r=".096071" fill="#00A1E0">
                                <animate attributeName="r" begin="0s" calcMode="spline" dur="1.5s" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" keyTimes="0;0.25;0.5;0.75;1" repeatCount="indefinite" values="0;10;10;10;0"/>
                                <animate attributeName="cx" begin="0s" calcMode="spline" dur="1.5s" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" keyTimes="0;0.25;0.5;0.75;1" repeatCount="indefinite" values="16;16;50;84;84"/>
                            </circle>
                            <circle cx="83.673" cy="50" r="10" fill="#08A69E">
                                <animate attributeName="r" begin="0s" calcMode="spline" dur="1.5s" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" keyTimes="0;0.25;0.5;0.75;1" repeatCount="indefinite" values="0;0;10;10;10"/>
                                <animate attributeName="cx" begin="0s" calcMode="spline" dur="1.5s" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" keyTimes="0;0.25;0.5;0.75;1" repeatCount="indefinite" values="16;16;16;50;84"/>
                            </circle>
                        </svg>
                    </strong>
                </div>
            </div>
        </div>
        <div id="header"></div>
        <div id="content"></div>
        <div id="sweetspot"></div>
        <div id="drawers"></div>
        <div id="footer"></div>
    </div>
</div>
{dotb_getscript file="lumia/minified/lumia.min.js"}
{dotb_getscript file="cache/javascript/dotbcrm.min.js"}
<script src='{dotb_getjspath file=$SLFunctionsPath}'></script>
<script src='{dotb_getjspath file=$configFile|cat:'?hash=$configHash'}'></script>
{dotb_getscript file="cache/javascript/dotbcrm7.min.js"}
{literal}
<script language="javascript">
    var parentIsDotBCRM = false;
    try {
        parentIsDotBCRM = (parent.window != window)
            && (typeof parent.DOTB != "undefined")
            && (typeof parent.DOTB.App.router != "undefined");
    } catch (e) {
    }
    if (parentIsDotBCRM) {
        parent.DOTB.App.router.navigate("#Home", {trigger: true});
    } else {
        var App;
        {/literal}{if $authorization}
        DOTB.App.cache.set("{$appPrefix}AuthAccessToken", "{$authorization.access_token}");
        {if $authorization.refresh_token}
        DOTB.App.cache.set("{$appPrefix}AuthRefreshToken", "{$authorization.refresh_token}");
        {/if}
        if (window.DOTB.App.config.siteUrl != '') {ldelim}
            history.replaceState(null, 'DotbCRM', window.DOTB.App.config.siteUrl + "/" + window.location.hash);
            {rdelim} else {ldelim}
            history.replaceState(
                null,
                'DotbCRM',
                window.location.origin + window.location.pathname + window.location.hash
            );
            {rdelim}
        {/if}{literal}
        App = DOTB.App.init({
            el: "#lumia",
            callback: function (app) {
                app.progress.set(0.6);
                app.once("app:view:change", function () {
                    app.progress.done();
                });
                app.alert.dismissAll();
                app.start();
            }
        });
        App.api.debug = App.config.debugDotbApi;
    }
</script>
{/literal}

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBaStg9RsOpnpm4GfsV-nakqJ-qV9bqqlw&libraries=places"></script>
<script src="{dotb_getjspath file='cache/javascript/dotbcrm5.min.js'}"></script>
<link rel="stylesheet" href="{dotb_getjspath file='cache/css/dotbcrm0.min.css'}" type="text/css">
{if !empty($voodooFile)}
    <script src="{dotb_getjspath file=$voodooFile}"></script>
{/if}

{if !empty($processAuthorFiles)}
    {dotb_getscript file="cache/javascript/dotbcrm9.min.js"}
{/if}

</body>
</html>
