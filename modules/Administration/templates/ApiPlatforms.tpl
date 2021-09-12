{*

*}
<script type="text/javascript"
        src="{dotb_getjspath file='cache/javascript/dotbcrm12.min.js'}"></script>
{*<link rel="stylesheet" type="text/css" href="{dotb_getjspath file='modules/Connectors/tpls/tabs.css'}"/>*}
<form id="apiplatforms" name="apiplatforms" method="POST">
    {dotb_csrf_form_token}
    <input type="hidden" name="module" value="Administration">
    <input type="hidden" name="action" value="apiplatforms">
    <input type="hidden" id="custom_api_platforms" name="custom_api_platforms" value="">

    <table border="0" cellspacing="1" cellpadding="1">
        <tr>
            <td>
                <input title="{$APP.LBL_SAVE_BUTTON_LABEL}" accessKey="{$APP.LBL_SAVE_BUTTON_TITLE}"
                       class="button primary" onclick="DOTB.saveApiPlatforms();" type="button" name="button"
                       value="{$APP.LBL_SAVE_BUTTON_LABEL}">
                <input title="{$APP.LBL_CANCEL_BUTTON_LABEL}" accessKey="{$APP.LBL_CANCEL_BUTTON_LABEL}" class="button"
                       onclick="document.apiplatforms.action.value='';" type="submit" name="button"
                       value="{$APP.LBL_CANCEL_BUTTON_LABEL}">
            </td>
        </tr>
    </table>
    <div class='add_table' style='margin-bottom:5px'>
        <table width="100%" border="0" cellspacing="1" cellpadding="0" class="edit view" style="margin-bottom: 0;">
            <tr><td>
                    <div id="api_platforms"></div>
                    <div style="margin-left: 25px;max-width: 25%;vertical-align: top;">{$MOD.LBL_CUSTOM_API_PLATFORMS_HELP}</div>
            </td></tr>
            <tr>
                <td>
                    <input type='text' id='platform_name' name='platform_name' maxlength='100' style="width: 182px;">
                    <input type="button" class="button" style="margin-top: -4px;"
                           onclick="DOTB.apiPlatformsTable.addPlatform()" value="{dotb_translate label='LBL_ADD_BUTTON'}">
                    </input>
                </td>
            </tr>
        </table>
    </div>
    <table border="0" cellspacing="1" cellpadding="1">
        <tr>
            <td>
                <input title="{$APP.LBL_SAVE_BUTTON_LABEL}" class="button primary" onclick="DOTB.saveApiPlatforms();"
                       type="button" name="button" value="{$APP.LBL_SAVE_BUTTON_LABEL}">
                <input title="{$APP.LBL_CANCEL_BUTTON_LABEL}" class="button"
                       onclick="document.apiplatforms.action.value='';" type="submit" name="button"
                       value="{$APP.LBL_CANCEL_BUTTON_LABEL}">
            </td>
        </tr>
    </table>
    <span></span>
</form>

<script type="text/javascript">
    (function() {ldelim}
        var Connect = YAHOO.util.Connect;

        Connect.url = 'index.php';
        Connect.method = 'POST';
        Connect.timeout = 300000;

        var api_platforms = {$api_platforms};
        var lbl_api_platforms = '{dotb_translate label="LBL_API_PLATFORMS"}';
        var deleteImage = '{$deleteImage}';
        {literal}
        deleteRow = function(el) {
            if(confirm(DOTB.language.get('Administration', 'LBL_REMOVE_PLATFORM'))) {
                DOTB.apiPlatformsTable.deleteRow(el);
            }
        };

        $('head').append(
            "<style type='text/css'>" +
                ".yui-dt > div { margin-right: -15px; }" +
                "tr.yui-dt-rec { border-bottom: 1px solid #BBB; }" +
                ".add_table td>div {" +
                    "display: inline-block;" +
                "}" +
            "</style>"
        );

        DOTB.apiPlatformsTable = new YAHOO.widget.ScrollingDataTable(
            "api_platforms",
            [
                {key: "name", label: lbl_api_platforms, width: 200, sortable: false, formatter: function (cell, rec, col, data) {
                    if (rec.getData('custom')) {
                        cell.innerHTML = data + '<a style="float: right;" href="javascript:void()" ' +
                            'onclick="deleteRow(this);">' + deleteImage + '</a>';
                    } else {
                        cell.innerHTML = '<i>' + data + '</i>';
                    }
                }}
            ],
            new YAHOO.util.LocalDataSource(api_platforms, {
                responseSchema: {fields: ['name', 'custom']}
            }),
            {
                height: "300px"
                // , width: "275px"
            }
        );

        DOTB.apiPlatformsTable.disableEmptyRows = true;
        DOTB.apiPlatformsTable.render();
        DOTB.apiPlatformsTable.addPlatform = function(){
            this.addRow({
                name:$('#platform_name').val(),
                custom:true
            });
            $('#platform_name').val("");
        }

        DOTB.saveApiPlatforms = function() {
            var apiTable = DOTB.apiPlatformsTable;
            var platforms = [];
            for (var i = 0; i < apiTable.getRecordSet().getLength(); i++) {
                var data = apiTable.getRecord(i).getData();
                if (data.custom && data.name != '')
                    platforms.push(data.name);
            }
            var urlParams = {
                module: "Administration",
                action: "saveApiPlatforms",
                custom_api_platforms: JSON.stringify(platforms),
                csrf_token: DOTB.csrf.form_token
            }

            ajaxStatus.showStatus(DOTB.language.get('Administration', 'LBL_SAVING'));
            Connect.asyncRequest(
                Connect.method,
                Connect.url,
                {success: function(){
                    ajaxStatus.flashStatus(DOTB.language.get('Administration', 'LBL_DONE'), 1000)
                }},
                DOTB.util.paramsToUrl(urlParams) + "to_pdf=1"
            );

            return true;
        }
    })();
    {/literal}
</script>
