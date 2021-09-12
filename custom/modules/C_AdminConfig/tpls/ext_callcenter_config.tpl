<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="custom/modules/C_AdminConfig/css/ext_callcenter_config.css">

<script src="custom/modules/C_AdminConfig/js/ext_callcenter_config.js"></script>


<div class="container">

    <table>
        <tr>
            <th style="width: 95%">
                <h2>{$mod.LBL_CONFIG_CALL_CENTER}</h2>
            </th>
            <th style="width: 5%">
                <button type="button" class="btn btn-primary active" onclick="button_save()">
                    <i class="far fa-save"></i> {$mod.LBL_BUTTON_SAVE}
                </button>
            </th>
        </tr>
    </table>
    <form id="config">
    <table class="table table-condensed">
        <thead>
        <tr>
            <th style="width: 20%">{$mod.LBL_USER}</th>
            <th style="width: 15%">{$mod.LBL_IP}</th>
            <th style="width: 20%">{$mod.LBL_EXTENSION}</th>
            <th style="width: 20%">{$mod.LBL_CHANEL}</th>
            <th style="width: 20%">{$mod.LBL_CONTEXT}</th>
            <th style="width: 5%" class="text-center">
                <button class="btn" type="button" id="btn_add_row">+</button>
            </th>
        </tr>
        </thead>

        <tbody id="table_config">

        {foreach from=$callcenter_config key=k item=config_row}
        <tr>
            <td>
                {html_options style="width: 250px" class="browser-default custom-select" name="user_id[]" options=$user selected=$config_row.user_id}
            </td>
            <td>
                <input type="text" class="form-control" value="{$config_row.ip}" name="ip[]">
            </td>
            <td>
                <input type="text" class="form-control" value="{$config_row.ext}" name="ext[]">
            </td>
            <td>
                <input type="text" class="form-control" value="{$config_row.chanel}" name="chanel[]">
            </td>
            <td>
                <input type="text" class="form-control" value="{$config_row.context}" name="context[]">
            </td>
            <td class="text-center">
                <button class="btn btn_remove_row">-</button>
            </td>
        </tr>
        {/foreach}

        </tbody>

        <tfoot id="row_add" style="visibility: hidden;">
        <tr>
            <td>
                {html_options style="width: 250px" class="browser-default custom-select" name="user_id[]" options=$user}
            </td>
            <td>
                <input type="text" class="form-control" name="ip[]">
            </td>
            <td>
                <input type="text" class="form-control" name="ext[]">
            </td>
            <td>
                <input type="text" class="form-control" name="chanel[]">
            </td>
            <td>
                <input type="text" class="form-control" name="context[]">
            </td>
            <td class="text-center">
                <button class="btn btn_remove_row">-</button>
            </td>
        </tr>
        </tfoot>

    </table>
    </form>

</div>


