{*

*}
<table class="tabform" ><tr><th>{dotb_translate label='LBL_HISTORY_TIMESTAMP' module='ModuleBuilder'}</th><th>&nbsp;</th><th>&nbsp;</th></tr>
{if empty($snapshots)}
	<tr><td class='mbLBLL'>{dotb_translate label='ERROR_NO_HISTORY' module='ModuleBuilder'}</td></tr>
{/if}
{foreach from=$snapshots item=snapshot key='id'}
<tr>
	<td class="oddListRowS1">
        <a onclick="ModuleBuilder.history.preview('{$view_module}', '{$view}', '{$id}', '{$subpanel|escape:javascript}');"
            href="javascript:void(0);">
            {$snapshot.label}
        </a>
    </td>
	<td width="1%"><input type='button' value="{dotb_translate label='LBL_MB_PREVIEW' module='ModuleBuilder'}" onclick="ModuleBuilder.history.preview('{$view_module}', '{$view}', '{$id}', '{$subpanel}');"/></td>
    <td width="1%">
        <input type='button' value="{dotb_translate label='LBL_MB_RESTORE' module='ModuleBuilder'}"
            onclick="ModuleBuilder.history.revert('{$view_module}', '{$view}', '{$id}', '{$subpanel}', {$snapshot.isDefault|json});"/>
    </td>
</tr>
{/foreach}
</table>
