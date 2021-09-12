<head>
    {dotb_getscript file="custom/include/javascript/Ztree/jquery.ztree.all.js"}
    {dotb_getscript file="custom/include/javascript/Bootstrap/bootstrap.min.js"}
    {dotb_getscript file="custom/include/javascript/BootstrapSelect/bootstrap-select.min.js"}
    {dotb_getscript file="custom/modules/Teams/js/list_view.js"}
    <script type="text/javascript"> var treeNodes = {$NODES}; </script>
    <link rel="stylesheet" type="text/css" href="{dotb_getjspath file='custom/modules/Teams/css/team_management.css'}">
    <link rel="stylesheet" type="text/css" href="{dotb_getjspath file='custom/include/javascript/Ztree/zTreeStyle.css'}">
    <link rel="stylesheet" type="text/css" href="{dotb_getjspath file='custom/include/javascript/DataTables/css/jquery.dataTables.min.css'}">
    <link rel="stylesheet" type="text/css" href="{dotb_getjspath file='custom/include/javascript/Bootstrap/bootstrap.min.css'}">
    <link rel="stylesheet" type="text/css" href="{dotb_getjspath file='custom/include/javascript/BootstrapSelect/bootstrap-select.min.css'}">

</head>
<body>
    <h4>{$MOD.LBL_TEAM_MANAGEMENT}</h4>
    <div id="Content">
        <div class="panel" id="panel_info">
            <div class="action_buttons">
                <button class="button primary team_detail" id="edit_bt">{$APPS.LBL_EDIT_BUTTON}</button>
                {if $CURRENT_USER_ID == '1'}<button style="margin-left:20px; display:none;" class="button" style="display:none;" type="button" name="{$APPS.LBL_DELETE_BUTTON}" id="delete_bt">{$APPS.LBL_DELETE_BUTTON}</button>{/if}
                <button class="button primary team_edit" style="display:none;" id="save_bt">{$APPS.LBL_SAVE_BUTTON_LABEL}</button>
                <button style="margin-left:20px; display:none;" class="button team_edit" id="cancel_bt">{$APPS.LBL_CANCEL_BUTTON_LABEL}</button>
                {$APPS.LBL_REMOVE_USER}
            </div>
            <form method="POST" name="TeamEdit" id="TeamEdit">
                <input type="hidden" id="team_id" name="team_id" value="{$team_id}">
                <input type="hidden" id="current_parent_id" value="">
                <input type="hidden" id="is_editing" value="0">
                <input type="hidden" id="is_adding" value="0">
                <input type="hidden" id="count_user" value={$count_user}>
                <table width="100%" border="0" class='detail view' cellspacing="1" class="panelContainer" cellpadding="0">
                    <tbody>
                        <tr>
                            <td valign="top" id="name_label" align="left" width="20%" scope="col">
                                {$MOD.LBL_NAME}: <span class="required team_edit" style="display:none;">*</span>
                            </td>
                            <td valign="top" width="70%">
                                <label class="team_detail" id="team_name_text">{$team_name}</label>
                                <input type="text" style="display:none;" class="team_edit" id="team_name" name="team_name" size="30" value="{$team_name}" tabindex="0">
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" id="legal_name_label" align="left" width="20%" scope="col">
                                {$MOD.LBL_LEGAL_NAME}: <span class="required team_edit" style="display:none;">*</span>
                            </td>
                            <td valign="top" width="70%">
                                <label class="team_detail" id="legal_name_text">{$legal_name}</label>
                                <input type="text" style="display:none;" class="team_edit" id="legal_name" name="legal_name" size="30" value="{$legal_name}" tabindex="0">
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" id="prefix_label" align="left" width="20%" scope="col" >
                                {$MOD.LBL_PREFIX}: <span class="required team_edit" style="display:none;">*</span>
                            </td>
                            <td valign="top" width="70%" >
                                <label class="team_detail" id="prefix_text">{$prefix}</label>
                                <input type="text" style="display:none; text-transform: uppercase;" class="team_edit" id="prefix" name="prefix" size="30" value="{$prefix}" tabindex="0">
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" id="short_name_label" align="left" width="20%" scope="col" >
                                {$MOD.LBL_SHORT_NAME}:
                            </td>
                            <td valign="top" width="70%" >
                                <label class="team_detail" id="short_name_text">{$short_name}</label>
                                <input type="text" style="display:none; text-transform: uppercase;" class="team_edit" id="short_name" name="short_name" size="30" value="{$short_name}" tabindex="0">
                            </td>
                        </tr>

                        <tr>
                            <td valign="top" id="phone_number_label" align="left" width="20%" scope="col" >
                                {$MOD.LBL_PHONE_NUMBER}:
                            </td>
                            <td valign="top" width="70%" >
                                <label class="team_detail" id="phone_number_text">{$phone_number}</label>
                                <input type="text" style="display:none;" class="team_edit" id="phone_number" name="phone_number" size="30" value="{$phone_number}" tabindex="0">
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" id="amount_label" width="20%" align="left" scope="col" >
                                {$MOD.LBL_MEMBER_OF}: <span class="required team_edit" style="display:none;">*</span>
                            </td>
                            <td valign="top" width="70%">
                                <a class="team_detail" id="parent_name_text" style="text-decoration: none; font-weight: bold;" href="javascript:void(0)" onclick="clickTeamNode($(this).closest('td').find('#parent_id').val());"><-none-></a>
                                <input class="team_edit" style="display:none;" type="text" id="parent_name" name="parent_name" value="{$parent_name}">
                                <input class="team_edit" type="hidden" id="parent_id" name="parent_id" value="{$parent_id}">
                                <button style="display:none;" class="team_edit" type="button" id="bt_select_parent" tabindex="0" title="Select" class="button firstChild" value="Select"><img src="themes/default/images/id-ff-select.png"></button>
                                <button style="display:none;" class="team_edit" type="button" id="bt_clear_parent" tabindex="0" title="Clear" class="button firstChild" value="Clear"><img src="themes/default/images/id-ff-clear.png"></button>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" id="amount_label" align="left" width="20%" scope="col" >
                                {$MOD.LBL_DESCRIPTION}:
                            </td>
                            <td valign="top" width="70%" >
                                <label class="team_detail" id="description_text">{$description}</label>
                                <textarea id="description" name="description" style="display:none;" class="team_edit" rows="4" cols="50">{$description}</textarea>
                            </td>
                        </tr>


                        <tr>
                            <td valign="top" id="amount_label" width="20%" align="left" scope="col" >
                                {$MOD.LBL_MANAGER_USER}:
                            </td>
                            <td valign="top" width="70%">
                                <a class="team_detail" id="manager_user_name_text" style="text-decoration: none; font-weight: bold;" href="javascript:void(0)">{$manager_user_name}</a>
                                <input class="team_edit" style="display:none;" type="text" id="manager_user_name" name="manager_user_name" value="{$manager_user_name}">
                                <input class="team_edit" type="hidden" id="manager_user_id" name="manager_user_id" value="{$manager_user_id}">
                                <button style="display:none;" class="team_edit" type="button" id="bt_select_manager_user" tabindex="0" title="Select" class="button firstChild" value="Select"><img src="themes/default/images/id-ff-select.png"></button>
                                <button style="display:none;" class="team_edit" type="button" id="bt_clear_manager_user" tabindex="0" title="Clear" class="button firstChild" value="Clear"><img src="themes/default/images/id-ff-clear.png"></button>
                            </td>
                        </tr>

<!--                        <tr>
                            <td valign="top" id="region_label" align="left" width="20%" scope="col" >
                                {$MOD.LBL_REGION}:
                            </td>
                            <td valign="top" width="70%" >
                                <label class="team_detail" id="region_text">{$region}</label>
                                <select class="team_edit" id = "region" name="region" style="display:none;" >
                                    {foreach from=$select_region key=k item=v}
                                    <option {if $k == $region}selected="selected"{/if} value="{$k}">{$v}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>-->
                    </tbody>
                </table>
            </form>
        </div>
        <div class="panel" id="panel_user" style="display:none;">
            <h4>{$MOD.LBL_USER_LIST}</h4>
            <input class="button primary" type="button" value="{$MOD.LBL_ADD_USER}" title="{$MOD.LBL_ADD_USER}" id="add_user_bt">
            <input class="button" type="button" value="{$MOD.LBL_SHOW_ALL_USER}" title="{$MOD.LBL_SHOW_ALL_USER_HELP}" show_type="Active" id="show_user_bt">
            <br><br>
            <div id="table_user">
                {$html_user_list}
            </div>
        </div>
    </div>
    <!-- Left Treeview Here. -->
    <div id="Menu">
        <ul id="teamNodes" class="ztree"></ul><br>
        <button id="collapse_all" class="button">{$MOD.LBL_COLLAPSE_ALL}</button>
        <button id="expand_all" class="button primary" style="display:none;">{$MOD.LBL_EXPAND_ALL}</button><br><br>
        <!--      <button id="user_management" onclick="parent.DOTB.App.router.redirect('#bwc/index.php?module=Users&action=index')">{$MOD.LBL_USER_MANAGEMENT}</button><br><br>
        <button id="role_management" onclick="parent.DOTB.App.router.redirect('#bwc/index.php?module=ACLRoles&action=index')">{$MOD.LBL_ROLE_MANAGEMENT}</button>  -->

    </div>



</body>