{*

*}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html {$langHeader}>
<head>
    <!-- App Scripts -->
    <link rel="stylesheet" href="styleguide/assets/css/font_bwc.css"/>
    <link rel="stylesheet" href="styleguide/assets/css/loading.css"/>
    <link rel="stylesheet" href="styleguide/assets/css/fontawesome.min.css"/>
    <!-- App GOOGLE Font - By Lap Nguyen -->
    <link rel="SHORTCUT ICON" href="{$FAVICON_URL}">
    <meta http-equiv="Content-Type" content="text/html; charset={$APP.LBL_CHARSET}">
    <title>{$SYSTEM_NAME}</title>
    {$DOTB_CSS}
    {if $AUTHENTICATED}
        <link rel='stylesheet' href='{dotb_getjspath file="vendor/ytree/TreeView/css/folders/tree.css"}'/>
        <link rel='stylesheet' href='{dotb_getjspath file="styleguide/assets/css/nvd3.css"}'/>
        <link rel='stylesheet' href='{dotb_getjspath file="styleguide/assets/css/sucrose.css"}'/>
        <link rel='stylesheet' href='{dotb_getjspath file="custom/include/css/heart.css"}'/>
    {/if}
    {$DOTB_JS}

    {dotb_getscript file="include/javascript/mousetrap/mousetrap.min.js"}

    {*Added JS/CSS BWC by Lap Nguyen*}
    <link rel="stylesheet" type="text/css" href="{dotb_getjspath file='custom/include/javascript/toastr/toastr.min.css'}"/>
    <link rel="stylesheet" type="text/css" href="{dotb_getjspath file='custom/include/javascript/jquery-confirm/jquery-confirm.min.css'}"/>
    <link rel='stylesheet' href='{dotb_getjspath file="themes/RacerX/css/custom.css"}'/>
    {dotb_getscript file="custom/include/javascript/toastr/toastr.min.js"}
    {dotb_getscript file="custom/include/javascript/jquery-confirm/jquery-confirm.min.js"}
    {dotb_getscript file="custom/include/javascript/date.js"}
    {dotb_getscript file="custom/include/javascript/currency_fm.js"}
    {dotb_getscript file="custom/include/javascript/Numeric.js"}
    {literal}
    <script type="text/javascript">
        //LOCK-DATA VARIABLE - Add By Lap Nguyen
        var dotb_config_lock_info = '{/literal}{$dotb_config_lock_info}{literal}';
        var dotb_config_lock_date = '{/literal}{$dotb_config_lock_date}{literal}';
        var except_lock_for_user_name = '{/literal}{$except_lock_for_user_name}{literal}';
        var current_user_name = '{/literal}{$current_user_name}{literal}';
        var is_admin = '{/literal}{$is_admin}{literal}';
        var maximum_sms = '{/literal}{$maximum_sms_messages}{literal}';
    </script>
    {/literal}
    {dotb_getscript file="themes/RacerX/js/utils.js"}
    {*End*}

    {literal}
    <script type="text/javascript">
        <!--
        DOTB.themes.theme_name = '{/literal}{$THEME}{literal}';
        DOTB.themes.hide_image = '{/literal}{dotb_getimagepath file="hide.gif"}{literal}';
        DOTB.themes.show_image = '{/literal}{dotb_getimagepath file="show.gif"}{literal}';
        DOTB.themes.loading_image = '{/literal}{dotb_getimagepath file="img_loading.gif"}{literal}';
        if (YAHOO.env.ua)
            UA = YAHOO.env.ua;
        -->


    </script>


    <script type="text/javascript">
        if (window.parent && typeof (window.parent.DOTB) !== 'undefined' && typeof (window.parent.DOTB.App) !== 'undefined') {
            // update bwc context
            var app = window.parent.DOTB.App;
            if (app.additionalComponents.sweetspot) {
                Mousetrap.bind('esc', function (e) {
                    app.additionalComponents.sweetspot.hide()
                    return false;
                });
                Mousetrap.bind('mod+shift+space', function (e) {
                    app.additionalComponents.sweetspot.show()
                    return false;
                });
            }
        }
    </script>
    {/literal}
</head>
