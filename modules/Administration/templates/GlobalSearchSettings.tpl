{*

*}
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td colspan="100">
        <h2>{$MOD.LBL_FTS_SETTINGS}</h2>
    </td>
</tr>
<tr>
    <td colspan="100">{$MOD.LBL_GLOBAL_SEARCH_SETTINGS_TITLE}</td>
</tr>
<tr>
    <td>
        <br>
    </td>
</tr>
<tr>
<td colspan="100">

<script type="text/javascript" src="{dotb_getjspath file='cache/javascript/dotbcrm12.min.js'}"></script>
<link rel="stylesheet" type="text/css" href="{dotb_getjspath file='modules/Connectors/tpls/tabs.css'}"/>
<form name="GlobalSearchSettings" method="POST">
{dotb_csrf_form_token}
	<input type="hidden" name="module" value="Administration">
	<input type="hidden" name="action" value="saveGlobalSearchSettings">
	<input type="hidden" name="enabled_modules" value="">

	<table border="0" cellspacing="1" cellpadding="1">
		<tr>
			<td>
			<input title="{$APP.LBL_SAVE_BUTTON_LABEL}" accessKey="{$APP.LBL_SAVE_BUTTON_TITLE}" class="button primary" onclick="DOTB.saveGlobalSearchSettings();" type="button" name="button" value="{$APP.LBL_SAVE_BUTTON_LABEL}">
                <input title="{$MOD.LBL_SAVE_SCHED_BUTTON}" class="button primary schedFullSystemIndex" onclick="DOTB.FTS.schedFullSystemIndex();" style="{if !$showSchedButton}display:none;{/if}text-decoration: none;" id='schedFullSystemIndexBtn' type="button" name="button" value="{$MOD.LBL_SAVE_SCHED_BUTTON}">
            <input title="{$APP.LBL_CANCEL_BUTTON_LABEL}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="document.GlobalSearchSettings.action.value='';" type="submit" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}">
			</td>
		</tr>
	</table>

	<div class='add_table' style='margin-bottom:5px'>
		<table id="GlobalSearchSettings" class="GlobalSearchSettings edit view" style='margin-bottom:0px;' border="0" cellspacing="0" cellpadding="0">
		    <tr>
				<td width='1%'>
					<div id="enabled_div"></div>
				</td>
				<td>
					<div id="disabled_div"></div>
				</td>
			</tr>
		</table>
	</div>
    <div {if $hide_fts_config}style="display:none;"{/if}>

        <br>
        {$MOD.LBL_FTS_PAGE_DESC}
        <br><br>
        <table width="50%" border="0" cellspacing="1" cellpadding="0" class="edit view">
            <tbody>
                <tr><th align="left" scope="row" colspan="4"><h4>{$MOD.LBL_FTS_SETTINGS_TITLE}</h4></th></tr>

                <tr>
                    <td width="25%" scope="row" valign="middle">{$MOD.LBL_FTS_TYPE}:&nbsp;{dotb_help text=$MOD.LBL_FTS_TYPE_HELP}</td>
                    <td width="25%" align="left" valign="middle"><select name="fts_type" id="fts_type">{$fts_type}</select></td>
                    <td width="60%">&nbsp;</td>
                </tr>
                <tr class="shouldToggle">
                    <td width="25%" scope="row" valign="middle">{$MOD.LBL_FTS_HOST}:&nbsp;{dotb_help text=$MOD.LBL_FTS_HOST_HELP}</td>
                    <td width="25%" align="left" valign="middle"><input type="text" name="fts_host" id="fts_host" value="{$fts_host}" ></td>
                    <td width="60%" valign="bottom">&nbsp;<a href="javascript:void(0);" onclick="DOTB.FTS.testSettings();" style="text-decoration: none;">{$MOD.LBL_FTS_TEST}</a></td>
                </tr>
                <tr class="shouldToggle">
                    <td width="25%" scope="row" valign="middle">{$MOD.LBL_FTS_PORT}:&nbsp;{dotb_help text=$MOD.LBL_FTS_PORT_HELP}</td>
                    <td width="25%" align="left" valign="middle"><input type="text" name="fts_port" id="fts_port" maxlength="5" size="5" value="{$fts_port}"></td>
                    <td width="60%"></td>
                </tr>
                <tr class="shouldToggle">
                    <td colspan="2">&nbsp;</td>
                </tr>
            </tbody>
        </table>
    </div>
	<table border="0" cellspacing="1" cellpadding="1">
		<tr>
			<td>
				<input title="{$APP.LBL_SAVE_BUTTON_LABEL}" class="button primary" onclick="DOTB.saveGlobalSearchSettings();" type="button" name="button" value="{$APP.LBL_SAVE_BUTTON_LABEL}">
                <input title="{$MOD.LBL_SAVE_SCHED_BUTTON}" class="button primary schedFullSystemIndex" onclick="DOTB.FTS.schedFullSystemIndex();" style="{if !$showSchedButton}display:none;{/if}text-decoration: none;" id='schedFullSystemIndex' type="button" name="button" value="{$MOD.LBL_SAVE_SCHED_BUTTON}">
                <input title="{$APP.LBL_CANCEL_BUTTON_LABEL}" class="button" onclick="document.GlobalSearchSettings.action.value='';" type="submit" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}">
			</td>
		</tr>
	</table>
</form>

</table>

<div id='selectFTSModules' class="yui-hidden">
    <div style="background-color: white; padding: 20px; overflow:scroll; height:400px;">
        <div id='selectFTSModulesTable' ></div>
        <div style="padding-top: 10px"><input type="checkbox" name="clearDataOnIndex" id="clearDataOnIndex" >&nbsp;{$MOD.LBL_DELETE_FTS_DATA}</div>
    </div>
</div>
<script type="text/javascript">
(function(){ldelim}
    var Connect = YAHOO.util.Connect;
	Connect.url = 'index.php';
    Connect.method = 'POST';
    Connect.timeout = 300000;
	var get = YAHOO.util.Dom.get;

	var enabled_modules = {$enabled_modules};
	var disabled_modules = {$disabled_modules};
	var lblEnabled = '{dotb_translate label="LBL_ACTIVE_MODULES"}';
	var lblDisabled = '{dotb_translate label="LBL_DISABLED_MODULES"}';

	{literal}
	DOTB.globalSearchEnabledTable = new YAHOO.DOTB.DragDropTable(
		"enabled_div",
		[{key:"label",  label: lblEnabled, width: 200, sortable: false},
		 {key:"module", label: lblEnabled, hidden:true}],
		new YAHOO.util.LocalDataSource(enabled_modules, {
			responseSchema: {fields : [{key : "module"}, {key : "label"}]}
		}),
		{height: "300px"}
	);
	DOTB.globalSearchDisabledTable = new YAHOO.DOTB.DragDropTable(
		"disabled_div",
		[{key:"label",  label: lblDisabled, width: 200, sortable: false},
		 {key:"module", label: lblDisabled, hidden:true}],
		new YAHOO.util.LocalDataSource(disabled_modules, {
			responseSchema: {fields : [{key : "module"}, {key : "label"}]}
		}),
		{height: "300px"}
	);

	DOTB.globalSearchEnabledTable.disableEmptyRows = true;
	DOTB.globalSearchDisabledTable.disableEmptyRows = true;
	DOTB.globalSearchEnabledTable.addRow({module: "", label: ""});
	DOTB.globalSearchDisabledTable.addRow({module: "", label: ""});
	DOTB.globalSearchEnabledTable.render();
	DOTB.globalSearchDisabledTable.render();

        DOTB.getModulesFromTable = function(table)
        {
            var modules = "";
            for(var i=0; i < table.getRecordSet().getLength(); i++)
            {
                var data = table.getRecord(i).getData();
                if (data.module && data.module != '')
                    modules += "," + data.module;
            }
            modules = modules == "" ? modules : modules.substr(1);
            return modules;
        }
        DOTB.getEnabledModulesForFTSSched = function()
        {
            var enabledTable = DOTB.FTS.selectedDataTable;
            var modules = [];
            var selectedIDs = enabledTable.getSelectedRows();
            for(var i=0; i < selectedIDs.length; i++)
            {
                var data = enabledTable.getRecord(selectedIDs[i]).getData();
                modules.push(data.module);
            }

        return modules;
    }
    DOTB.getTranslatedEnabledModules = function()
    {
        var enabledTable = DOTB.globalSearchEnabledTable;
        var modules = [{module:'', label: DOTB.language.get('Administration', 'LBL_ALL')}];
        for(var i=0; i < enabledTable.getRecordSet().getLength(); i++)
        {
            var data = enabledTable.getRecord(i).getData();
            if (data.module && data.module != '')
            {
                var tmp = {'module' : data.module, 'label' : data.label};
                modules.push(tmp);
            }
        }

        return modules;
    }
	DOTB.saveGlobalSearchSettings = function()
	{
        var host = document.getElementById('fts_host').value;
        var port = document.getElementById('fts_port').value;
        var typeEl = document.getElementById('fts_type');
        var type = typeEl.options[typeEl.selectedIndex].value;

        if( type != "")
        {
            if(!check_form('GlobalSearchSettings'))
                return;
        }
        var enabled = DOTB.getModulesFromTable(DOTB.globalSearchEnabledTable);
        var disabled = DOTB.getModulesFromTable(DOTB.globalSearchDisabledTable);

        var urlParams = {
            module: "Administration",
            action: "saveglobalsearchsettings",
            host: host,
            port: port,
            type: type,
            enabled_modules: enabled,
            disabled_modules: disabled,
            csrf_token: DOTB.csrf.form_token
        }

		ajaxStatus.showStatus(DOTB.language.get('Administration', 'LBL_SAVING'));
		Connect.asyncRequest(
            Connect.method,
            Connect.url,
            {success: DOTB.saveCallBack},
			DOTB.util.paramsToUrl(urlParams) + "to_pdf=1"
        );

		return true;
	}

	DOTB.saveCallBack = function(o)
	{
	   ajaxStatus.flashStatus(DOTB.language.get('app_strings', 'LBL_DONE'));
        var response = YAHOO.lang.trim(o.responseText);
        if (response === "true") {
            var app = parent.DOTB.App;
            app.sync();
            window.location.assign('index.php?module=Administration&action=index');
	   } else {
            YAHOO.DOTB.MessageBox.show({msg: response});
	   }
	}
})();
{/literal}
</script>
<script type="text/javascript">
    var justRequestedAScheduledIndex = '{$justRequestedAScheduledIndex}';
    {literal}
    $(document).ready(function()
    {
        if(justRequestedAScheduledIndex)
            alert(DOTB.language.get('Administration','LBL_FTS_CONN_SUCCESS_SHORT'));
    });

    DOTB.FTS = {

        saveFullSysIndexSched: function()
        {
            var host = document.getElementById('fts_host').value;
            var port = document.getElementById('fts_port').value;
            var typeEl = document.getElementById('fts_type');
            var type = typeEl.options[typeEl.selectedIndex].value;
            var clearData = $('#clearDataOnIndex').attr('checked') ? 1 : 0;

            var modules = DOTB.getEnabledModulesForFTSSched();
            if(modules.length == 0)
            {
                alert(DOTB.language.get('app_strings','LBL_FTS_NO_MODULES_FOR_SCHED'));
                return;
            }
            modules = modules.join(",");
            if(host == "" || port == "" || type == "")
            {
                DOTB.FTS.selectFTSModulesDialog.cancel();
                check_form('GlobalSearchSettings');
                return;
            }
            var sUrl = 'index.php?to_pdf=1&module=Administration&action=ScheduleFTSIndex&sched=true&type='
                            + encodeURIComponent(type) + '&host=' + encodeURIComponent(host) + '&port=' + encodeURIComponent(port)
                            + "&clearData=" + clearData + '&modules=' + encodeURIComponent(modules);

            var transaction = YAHOO.util.Connect.asyncRequest('GET', sUrl, null, null);
            alert(DOTB.language.get('Administration','LBL_FTS_CONN_SUCCESS_SHORT'));
            DOTB.FTS.selectFTSModulesDialog.cancel();

        },
        schedFullSystemIndex : function()
        {
            if(!confirm(DOTB.language.get('Administration','LBL_SAVE_SCHED_WARNING')))
                return;

            var modules = DOTB.getTranslatedEnabledModules();
            if(modules.length == 1)
            {
                alert(DOTB.language.get('app_strings','LBL_FTS_NO_MODULES_FOR_SCHED'));
                return;
            }
            var handleCancel = function() {
                this.cancel();
            };
            var handleSubmit = function() {
                DOTB.FTS.saveFullSysIndexSched();
            };

            var buttons = [
                { text: DOTB.language.get('Administration','LBL_FTS_INDEX_BUTTON'), handler: handleSubmit, isDefault: true },
                { text: DOTB.language.get('app_strings','LBL_CANCEL_BUTTON_LABEL'), handler: handleCancel }
            ];

            if(!DOTB.FTS.selectFTSModulesDialog)
            {
                DOTB.FTS.selectFTSModulesDialog = new YAHOO.widget.Dialog("selectFTSModules", {
                    modal:true,
                    visible:true,
                    fixedcenter:true,
                    constraintoviewport: true,
                    width	: '300px',
                    shadow	: false,
                    buttons : buttons
                });
            }
            DOTB.FTS.selectFTSModulesDialog.setHeader(DOTB.language.get('Administration','LBL_SAVE_SCHED_BUTTON'));
            YAHOO.util.Dom.removeClass("selectFTSModules", "yui-hidden");
            DOTB.FTS.selectFTSModulesDialog.render();
            DOTB.FTS.selectFTSModulesDialog.show();

            var enabledModules = {'modules': modules};

            var myColumnDefs = [{key:"label",label:DOTB.language.get('Administration','LBL_AVAILABLE_FTS_MODULES'), sortable:false, width:200}];

            this.myDataSource = new YAHOO.util.DataSource(enabledModules);
            this.myDataSource.responseType = YAHOO.util.DataSource.TYPE_JSON;
            this.myDataSource.responseSchema = {
                resultsList: "modules",
                fields: ["label","module"]
            };

            DOTB.FTS.selectedDataTable = new YAHOO.widget.DataTable("selectFTSModulesTable",myColumnDefs, this.myDataSource, {});

            // Subscribe to events for row selection
            DOTB.FTS.selectedDataTable.subscribe("rowMouseoverEvent", DOTB.FTS.selectedDataTable.onEventHighlightRow);
            DOTB.FTS.selectedDataTable.subscribe("rowMouseoutEvent", DOTB.FTS.selectedDataTable.onEventUnhighlightRow);
            DOTB.FTS.selectedDataTable.subscribe("rowClickEvent", DOTB.FTS.selectedDataTable.onEventSelectRow);

            // Programmatically select the first row
            DOTB.FTS.selectedDataTable.selectRow(DOTB.FTS.selectedDataTable.getTrEl(0));
            // Programmatically bring focus to the instance so arrow selection works immediately
            DOTB.FTS.selectedDataTable.focus();

        },
        testSettings : function()
        {
            var host = document.getElementById('fts_host').value;
            var port = document.getElementById('fts_port').value;
            var typeEl = document.getElementById('fts_type');
            var type = typeEl.options[typeEl.selectedIndex].value;
            if(type != "")
            {
                if(!check_form('GlobalSearchSettings'))
                    return
            }

            DOTB.FTS.rsPanel = new YAHOO.widget.SimpleDialog("FTSPanel", {
                                    modal: true,
                                    width: "260px",
                                    visible: true,
                                    constraintoviewport: true,
                                    loadingText: DOTB.language.get("app_strings", "LBL_EMAIL_LOADING"),
                                    close: true
                                });

            var panel = DOTB.FTS.rsPanel;
            panel.setHeader(DOTB.language.get('Administration','LBL_CONNECT_STATUS')) ;
            panel.setBody(DOTB.language.get("app_strings", "LBL_EMAIL_LOADING"));
            panel.render(document.body);
            panel.show();
            panel.center();

            var callback = {
                success: function(o) {
                    var r = YAHOO.lang.JSON.parse(o.responseText);
                    panel.setBody(r.status);
                    if(r.valid)
                    {
                        $('.schedFullSystemIndex').show();
                    }
                    else
                    {
                        $('.schedFullSystemIndex').hide();
                    }

                },
                failure: function(o) {}
            }

            var sUrl = 'index.php?to_pdf=1&module=Administration&action=checkFTSConnection&type='
                + encodeURIComponent(type) + '&host=' + encodeURIComponent(host) + '&port=' + encodeURIComponent(port);

            var transaction = YAHOO.util.Connect.asyncRequest('GET', sUrl, callback, null);

        }
    };
    {/literal}
    addForm('GlobalSearchSettings');
    addToValidateMoreThan('GlobalSearchSettings', 'fts_port', 'int', true, '{$MOD.LBL_FTS_PORT}', 1);
    addToValidate('GlobalSearchSettings', 'fts_host', 'varchar', 'true', '{$MOD.LBL_FTS_URL}');
</script>
