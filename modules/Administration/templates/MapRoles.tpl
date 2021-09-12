{*

*}
<link rel="stylesheet" href="modules/Administration/css/map-roles.css">
<form id="map-roles" method="post" action="index.php?module=Administration&view=module&action=UpgradeWizard_commit">
{dotb_csrf_form_token}
    {foreach from=$smarty.post item=value key=name}
        <input type="hidden" name="{$name|escape}" value="{$value|escape}">
    {/foreach}
    <table class="detail view">
        <tr>
            <th>{$MOD.LBL_UW_PACKAGE_ROLES}</th>
            <th>{$MOD.LBL_UW_INSTANCE_ROLES}</th>
        </tr>
        {foreach from=$package_roles item=package_role_name key=package_role_id}
            <tr>
                <td>
                    <div class="package-role-name">{$package_role_name}</div>
                    <div class="package-role-id">{$APP.LBL_ID}: <span class="value">{$package_role_id}</span></div>
                </td>
                <td>
                    {html_options name="patch[roles][`$package_role_id`]" options=$instance_roles selected=$map[$package_role_id]}
                    <span class="role-matches"></span>
                </td>
            </tr>
        {/foreach}
    </table>
    <input type="submit" value="{$MOD.LBL_ML_COMMIT}" class="button" />
    <input type="button" value="{$MOD.LBL_ML_CANCEL}" class="button" onclick="location.href='index.php?module=Administration&action=UpgradeWizard&view=module';"/>
</form>
<script src="modules/Administration/javascript/MapRoles.js"></script>
