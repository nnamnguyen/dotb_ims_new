var app = window.parent.DOTB.App;
var setting = {
    view: {
        addHoverDom: addHoverDom,
        removeHoverDom: removeHoverDom,
        selectedMulti: false,
        dblClickExpand: false,
    },
    data: {
        simpleData: {
            enable: true,
            rootPId: '1'
        }
    },
    callback: {
        beforeClick: function (treeId, treeNode) {
            var is_adding = $("#is_adding").val();
            var cur_team_id = $("#team_id").val();
            //            if(treeNode.id == '1') return false;
            if (is_adding == '1') return false;
            else if(cur_team_id == treeNode.id) return false;
                else {
                    ajaxGetTeamInfo(treeNode);
                }
        },
    },
};
var newCount = 1;

function addHoverDom(treeId, treeNode) {
    var sObj = $("#" + treeNode.tId + "_span");
    // da loai bo dieu kien  !treeNode.editNameFlag
    if ($("#addBtn_" + treeNode.tId).length > 0) return;
    var addStr = "<span id='addBtn_" + treeNode.tId + "' title='" + DOTB.language.get('Teams', 'LBL_TITLE_ADD_CHILD') + "' onfocus='this.blur();'><i style='padding-left: 3px;' class='icon icon-plus'></i></span>";
    sObj.after(addStr);

    var btn = $("#addBtn_" + treeNode.tId);
    if (btn) btn.bind("click", function () {
        var is_adding = $("#is_adding").val();
        if (is_adding == '1') return false;

        var zTree = $.fn.zTree.getZTreeObj("teamNodes");
        zTree.addNodes(treeNode, {id: '', pId: treeNode.id, 'icon':'custom/include/javascript/Ztree/img/diy/12.png', isParent: true, name: "New Team " + (newCount)});
        //        treeNode.editNameFlag = true;
        $("#is_adding").val('1');
        $('#is_editing').val('1');
        var newNode = zTree.getNodeByParam('id', '');
        zTree.selectNode(newNode, true);
        ajaxGetTeamInfo(newNode);

        newCount++;
        return false;
        });
};

function removeHoverDom(treeId, treeNode) {
    $("#addBtn_" + treeNode.tId).remove();
};

function expandNode(e) {
    var zTree = $.fn.zTree.getZTreeObj("teamNodes"),
    type = e.data.type;
    var globalNode = zTree.getNodeByParam('id', '1');
    if (type == "expandAll") {
        zTree.expandAll(true);
        $('#collapse_all').show();
        $('#expand_all').hide();
    } else if (type == "collapseAll") {
        var zTree = $.fn.zTree.getZTreeObj("teamNodes");
        var arr_child = zTree.transformToArray(globalNode);
        $.each(arr_child, function (key, team) {
            if (arr_child[key].id != '1')
                zTree.expandNode(arr_child[key], false, true, null, 0);
        });

        $('#expand_all').show();
        $('#collapse_all').hide();
    }
}

//Show/Hide fields
function toggle_team() {
    var is_editing = $('#is_editing').val();
    var count_user = parseInt($('#count_user').val());
    var zTree = $.fn.zTree.getZTreeObj("teamNodes");
    nodes = zTree.getSelectedNodes();
    selectedNode = nodes[0];
    if (is_editing == '1') {
        $('.team_edit').show();
        $('.team_detail').hide();
        $('#panel_user').hide();
        $('#delete_bt').hide();
        //Add Dotb Validation
        delete validate['TeamEdit'];
        addToValidate('TeamEdit', 'team_name', 'text', true, DOTB.language.get('Teams', 'LBL_NAME'));
        addToValidate('TeamEdit', 'prefix', 'text', true, DOTB.language.get('Teams', 'LBL_PREFIX'));
        addToValidate('TeamEdit', 'legal_name', 'text', true, DOTB.language.get('Teams', 'LBL_LEGAL_NAME'));
        if (selectedNode.id == '1') {
            $("#parent_name").prop('disabled', true);
            $('#bt_select_parent, #bt_clear_parent').hide();

        } else {
            $("#parent_name").prop('disabled', false);
            $('#bt_select_parent, #bt_clear_parent').show();

            addToValidateBinaryDependency('TeamEdit', 'parent_name', 'alpha', true, DOTB.language.get('app_strings', 'ERR_SQS_NO_MATCH_FIELD') + DOTB.language.get('Teams', 'LBL_PARENT_ID'), 'parent_id');
            addToValidateBinaryDependency('TeamEdit', 'manager_user_id', 'alpha', false, DOTB.language.get('app_strings', 'ERR_SQS_NO_MATCH_FIELD') + DOTB.language.get('Teams', 'LBL_MANAGER_USER'), 'manager_user_id');
        }
    } else {
        $('.team_edit').hide();
        $('.team_detail').show();
        $('#panel_user').show();
        if (selectedNode.check_Child_State >= 0)
            $('#delete_bt').hide();
        else
            $('#delete_bt').show();

    }
}

function removeNewTeam() {
    var zTree = $.fn.zTree.getZTreeObj("teamNodes");
    var newNode = zTree.getNodeByParam('id', '');
    app.alert.show('message-id', {
        level: 'confirmation',
        messages: "'" + $('#team_name').val() + "'" + DOTB.language.get('Teams', 'LBL_ALERT_CANCEL'),
        autoClose: false,
        onConfirm: function () {
            //Remove new Note
            var parentNode = newNode.getParentNode();
            //    parentNode.editNameFlag = false;
            zTree.removeNode(newNode, true);

            //load Parent Node
            zTree.selectNode(parentNode, true);
            ajaxGetTeamInfo(parentNode);
            $('#is_editing').val('0');
            $('#is_adding').val('0');
        },
        onCancel: function () {
            return false;
        }
    });

}

//Ajax get TeamInfo
function ajaxGetTeamInfo(teamNode, hide_panel) {
    if (typeof hide_panel === "undefined") hide_panel = true;
    $('#team_id').val(teamNode.id);
    $('#current_parent_id').val(teamNode.pId);
    $('.validation-message').remove();
    var show_type = $('#show_user_bt').attr('show_type');
    if (teamNode.id != '') {
        //remove tab
        if(hide_panel){
            $('#panel_info').hide();
            $('#panel_user').hide();
        }


        app.alert.show('message-id', {level: 'process'});
        $.ajax({
            url: "index.php?module=Teams&action=getTeamDetail&dotb_body_only=true",
            type: "POST",
            async: true,
            data:
            {
                team_id: teamNode.id,
                show_type: show_type,
            },
            dataType: "json",
            success: function (data) {
                app.alert.dismiss('message-id');
                if (data.success == "1") {
                    $('#panel_info').show();
                    $('#panel_user').show();
                    $('div#table_user').html(data.html);
                    $('#count_user').val(data.count_user);
                    //assigned team info
                    $.each(data.team, function( key, val ) {
                        $('#'+key+'_text').text(val);
                        $('#'+key).val(val);
                    });
                }
                toggle_team();

            },
        });
    } else {
        $('div#table_user').html('');
        $('input.team_edit, select.team_edit, textarea.team_edit').val('');
        $('#team_name').val(teamNode.name);
        $('#parent_id').val(teamNode.pId);
        $('#parent_name').val(teamNode.getParentNode().name);
        $('#manager_user_id').text('');
        $('#manager_user_name').text('');
        $('#description').text('');
        $('div#table_user').html('');
        $('#count_user').val(0);
        toggle_team();
    }
}

function addUserToTeam(popup_reply_data) {
    var users_list = {};
    if (typeof (popup_reply_data.name_to_value_array) === "undefined" || popup_reply_data.name_to_value_array == '' || popup_reply_data.name_to_value_array == null ){
        users_list = popup_reply_data.selection_list;
    }else{
        users_list['ID_1'] = popup_reply_data.name_to_value_array.user_id;
    }

    app.alert.show('message-id', {level: 'process'});

    //get child List
    var zTree = $.fn.zTree.getZTreeObj("teamNodes");
    var node = zTree.getSelectedNodes();
    var arr_child = zTree.transformToArray(node);
    var team_list = [];
    $.each(arr_child, function (key, team) {
        team_list[key] = team.id;
    });

    $.ajax({
        url: "index.php?module=Teams&action=handleUser&dotb_body_only=true",
        type: "POST",
        async: true,
        data:
        {
            users_list: users_list,
            team_list: team_list,
            act: 'add_user',
        },
        dataType: "json",
        success: function (res) {
            app.alert.dismiss('message-id');
            if (res.success == '1') {
                var team_id = $('#team_id').val();
                var zTree = $.fn.zTree.getZTreeObj("teamNodes");
                var teamNode = zTree.getNodeByParam('id', team_id);
                ajaxGetTeamInfo(teamNode,false);
            } else {
                app.alert.show('message-id', {
                    level: 'warning',
                    title: DOTB.language.get('Teams', 'LBL_AJAX_ERR'),
                    autoClose: true
                });
            }
        },
    });

}

function removeUserFromTeam(user_id) {
    app.alert.show('message-id', {level: 'process'});

    //get child List
    var zTree = $.fn.zTree.getZTreeObj("teamNodes");
    var node = zTree.getSelectedNodes();
    var arr_child = zTree.transformToArray(node);
    var team_list = [];
    $.each(arr_child, function (key, team) {
        team_list[key] = team.id;
    });

    $.ajax({
        url: "index.php?module=Teams&action=handleUser&dotb_body_only=true",
        type: "POST",
        async: true,
        data: {
            user_id: user_id,
            team_list: team_list,
            act: 'remove_user',
        },
        dataType: "json",
        success: function (res) {
            app.alert.dismiss('message-id');
            if (res.success == '1') {
                var table = $('#celebs').DataTable();
                var rows = table.find('tr#' + user_id);
                table.fnDeleteRow(rows[0]);
            } else {
                app.alert.show('message-id', {
                    level: 'warning',
                    title: DOTB.language.get('Teams', 'LBL_AJAX_ERR'),
                    autoClose: true
                });
            }
        },
    });
}

function ajaxUpdateTeam(action, team_id) {
    if (action == "save")
        data = $("#TeamEdit").serialize() + "&act=" + action;
    else if (action == "delete") {
        data = "act=" + action + "&team_id=" + team_id;
    }
    var copyUserFlag = false;
    //validation and moving team
    if ($('#team_id').val() != '1') {

        var zTree = $.fn.zTree.getZTreeObj("teamNodes");
        var node = zTree.getSelectedNodes();
        var team_list = zTree.transformToArray(node);
        var arr_child = [];
        $.each(team_list, function (key, team) {
            arr_child[key] = team.id;
        });
        if (arr_child.indexOf($('#parent_id').val()) != '-1') {
            app.alert.show('message-id', {
                level: 'success',
                title: DOTB.language.get('Teams', 'LBL_ALERT_UPDATE'),
                autoClose: true
            });
            return false;
        }
        if ($('#parent_id').val() != $('#current_parent_id').val()) {
            copyUserFlag = true;
        }
    }
    data += '&copyUserFlag=' + copyUserFlag;
    app.alert.show('message-id', {level: 'process'});
    $.ajax({
        url: 'index.php?module=Teams&action=updateTeam&dotb_body_only=true',
        type: "POST",
        data: data,
        dataType: "json",
        success: function (res) {
            app.alert.dismiss('message-id');
            if (res.success == "1") {
                var zTree = $.fn.zTree.getZTreeObj("teamNodes");
                if (res.act == "save") {
                    $('#is_editing').val('0');
                    $('#is_adding').val('0');

                    //assigned team info
                    $.each(res.team, function( key, val ) {
                        $('#'+key+'_text').text(val);
                        $('#'+key).val(val);
                    });

                    //rename node
                    if (res.call_back == 'update')
                        var node = zTree.getNodeByParam('id', res.team['team_id']);
                    else if (res.call_back == 'create')
                        var node = zTree.getNodeByParam('id', '');


                    node.name   = res.team['team_name'];
                    node.id     = res.team['team_id'];
                    node.pId    = res.team['parent_id'];
                    zTree.updateNode(node);
                    targetNode = zTree.getNodeByParam('id', $('#parent_id').val());
                    targetNode = zTree.moveNode(targetNode, node, "inner");
                    ajaxGetTeamInfo(node,false);
                    app.alert.show('message-id', {
                        level: 'success',
                        title: app.lang.getAppString('LBL_SAVED'),
                        autoClose: true
                    });
                } else if (res.act == "delete") {
                    var node = zTree.getNodeByParam('id', $('#team_id').val());
                    zTree.removeNode(node, true);
                    var parentNode = node.getParentNode();
                    //                    parentNode.editNameFlag = false;
                    zTree.selectNode(parentNode, true);
                    ajaxGetTeamInfo(parentNode,false);
                    app.alert.show('message-id', {
                        level: 'success',
                        title: app.lang.getAppString('LBL_DELETED'),
                        autoClose: true
                    });
                }
            } else {
                if (res.isReachedLimitTeams) {
                    app.alert.show('message-id', {
                        level: 'confirmation',
                        messages: DOTB.language.get('Teams', 'LBL_AJAX_ERR_LIMIT_TEAMS'),
                        autoClose: false,
                        onConfirm: function () {
                            window.top.App.router.redirect('#C_AdminConfig/layout/license');
                        },
                        onCancel: function () {
                            return false;
                        }
                    });
                } else {
                    app.alert.dismiss('message-id');
                    app.alert.show('message-id', {
                        level: 'warning',
                        title: DOTB.language.get('Teams', 'LBL_AJAX_ERR'),
                        autoClose: true
                    });
                }
            }
        },
        error: function (res) {
            app.alert.dismiss('message-id');
            app.alert.show('message-id', {
                level: 'warning',
                title: DOTB.language.get('Teams', 'LBL_AJAX_ERR'),
                autoClose: true
            });
        }
    });
}

function clickTeamNode(team_id) {
    if (team_id != null && team_id != '') {
        var zTree = $.fn.zTree.getZTreeObj("teamNodes");
        var targetNode = zTree.getNodeByParam('id', team_id);
        zTree.selectNode(targetNode, true);
        ajaxGetTeamInfo(targetNode);
    }
}

function addRoleTeam(user_id, primary_team_id, roles, status) {
    app.alert.show('message-id', {level: 'process'});
    $.ajax({
        url: "index.php?module=Teams&action=handleUser&dotb_body_only=true",
        type: "POST",
        async: true,
        data: {
            user_id: user_id,
            primary_team_id: primary_team_id,
            roles: roles,
            status: status,
            act: 'update_role_team',
        },
        dataType: "json",
        success: function (res) {
            app.alert.dismiss('message-id');
            if (res.success == '1') {
                console.log('Add Role Success!');
                app.alert.show('message-id', {
                    level: 'success',
                    title: app.lang.getAppString('LBL_SAVED'),
                    autoClose: true
                });
            } else {
                app.alert.show('message-id', {
                    level: 'warning',
                    title: DOTB.language.get('Teams', 'LBL_AJAX_ERR'),
                    autoClose: true
                });
            }
        },
    });
}

$(document).ready(function () {
    $.fn.zTree.init($("#teamNodes"), setting, treeNodes);
    var zTree = $.fn.zTree.getZTreeObj("teamNodes");
    var globalNode = zTree.getNodeByParam('id', '1');
    zTree.selectNode(globalNode, true);

    //toggle_team();
    $('#edit_bt').live('click', function () {
        $('#is_editing').val('1');
        toggle_team();
    });

    $('#cancel_bt').live('click', function () {
        var is_adding = $('#is_adding').val();
        $('.validation-message').remove();
        if (is_adding != '1') {
            //Show Detail
            $('#is_editing').val('0');
            toggle_team();
        } else {
            removeNewTeam();
        }
    });

    $('#save_bt').bind('click', function () {
        if (check_form('TeamEdit')) { //validate form
            ajaxUpdateTeam('save');
        }
    });

    $('#delete_bt').bind('click', function () {
        var team_id = $('#team_id').val();
        app.alert.show('message-id', {
            level: 'confirmation',
            messages: DOTB.language.get('Teams', 'LBL_CONFIRM_DELETE') + "'" + $('#team_name_text').text() + "' ?",
            autoClose: false,
            onConfirm: function () {
                ajaxUpdateTeam('delete', team_id);
            },
            onCancel: function () {
                return false;
            }
        });
    });
    $('.remove_user').live('click', function () {
        var user_id = $(this).closest('tr').attr('id');
        app.alert.show('message-id', {
            level: 'confirmation',
            messages: DOTB.language.get('Teams', 'LBL_CONFIRM_REMOVE_USER'),
            autoClose: false,
            onConfirm: function () {
                removeUserFromTeam(user_id);
            },
            onCancel: function () {
                return false;
            }
        });
    });


    $('#add_user_bt').live('click', function () {
        open_popup("Users", 600, 400, "", true, true, {
            "call_back_function": "addUserToTeam",
            "form_name": "DetailView",
            "field_to_name_array": {
                "id": "user_id",
                "user_name": "user_name_2"
            },
            "passthru_data": {}
            }, "MultiSelect", true);
    });

    $('#show_user_bt').live('click', function () {
        var show_type = $(this).attr('show_type');
        if (show_type == 'Active') {
            $(this).attr('show_type', 'All');
            $(this).attr('title', DOTB.language.get('Teams', 'LBL_SHOW_LESS_USER_HELP'));
            $(this).val(DOTB.language.get('Teams', 'LBL_SHOW_LESS_USER'));
        } else {
            $(this).attr('show_type', 'Active');
            $(this).attr('title', DOTB.language.get('Teams', 'LBL_SHOW_ALL_USER_HELP'));
            $(this).val(DOTB.language.get('Teams', 'LBL_SHOW_ALL_USER'));
        }
        var team_id = $('#team_id').val();
        var zTree = $.fn.zTree.getZTreeObj("teamNodes");
        var teamNode = zTree.getNodeByParam('id', team_id);
        ajaxGetTeamInfo(teamNode, false);
    });

    $('.save_user').live('click', function () {
        var roles = $(this).closest('tr').find('.select_role').val();
        var primary_team_id = $(this).closest('tr').find('.select_team').val();
        var status = $(this).closest('tr').find('.select_status').val();
        var user_id = $(this).closest('tr').attr('id');
        addRoleTeam(user_id, primary_team_id, roles, status);
        $(this).closest('tr').find('.save_user').css("color", "#0b578f");
    });
    //Highlight row not save
    $('.select_role, .select_team, .select_status').live('change', function () {
        $(this).closest('tr').find('.save_user').css("color", "#DA0000");
    });

    $('#expand_all').hide();
    $("#expand_all").bind("click", {type: "expandAll"}, expandNode);
    $("#collapse_all").bind("click", {type: "collapseAll"}, expandNode);

    // Select Parent
    $('#bt_select_parent').click(function () {
        open_popup("Teams", 600, 400, '&private=0', true, false, {"call_back_function": "set_return", "form_name": "TeamEdit", "field_to_name_array": {"id": "parent_id", "name": "parent_name",}});
    });
    $('#bt_select_manager_user').click(function () {
        open_popup("Users", 600, 400, '', true, false, {"call_back_function": "set_return", "form_name": "TeamEdit", "field_to_name_array": {"id": "manager_user_id", "name": "manager_user_name",}});
    });

    $('#bt_clear_parent').click(function () {
        $('#parent_name, #parent_id').val('');
    });
    $('#bt_clear_manager_user').click(function () {
        $('#manager_user_name, #manager_user_id').val('');
    });

    //Fix lỗi open zTree khi load form - Lap Nguyen
    setTimeout(function () {
        var zTree = $.fn.zTree.getZTreeObj("teamNodes");
        zTree.expandAll(true);
        //remove undefine a tag
        $("ul#teamNodes a").each(function(){
            $(this).removeAttr("href");
        });
        }, 500);

});