function handleCheckBox(cell){
    var cell_tbl = cell.closest('table');

    var module_name = cell.attr('module_name');
    var count     = 0;
    var ckb     = 0;
    //Make string selected - User str.split(",") to explorer
    var str  = '';
    cell_tbl.find('input.custom_checkbox').each(function(){
        if($(this).val() != ''){
            if(cell.attr('class') == 'checkall_custom_checkbox' && $(this).closest('tr').attr('class') != 'tr_not_in_class'){
                $(this).prop('checked',cell.is(':checked'));
            }
            if($(this).is(":checked")){
                ckb++;
                if(ckb == 1)
                    str = str + $(this).val();
                else
                    str = str + ',' + $(this).val();
            }
            count++;
        }
    });
    if(ckb != count)
        cell_tbl.find('input.checkall_custom_checkbox').prop('checked',false);
    else
        cell_tbl.find('input.checkall_custom_checkbox').prop('checked',true);

    if(ckb> 0)
        cell_tbl.find(".selectedTopSupanel").html('<input type="hidden" value_ckb="'+ckb+'" id="'+module_name+'_checked_str" value="'+str+'"><p style="color:red; padding:5px;">('+ckb+')☑  </p>');
    else
        cell_tbl.find(".selectedTopSupanel").html('');
}

function checkDataLockDate(id_field_date, has_trigger, has_clear){
    var check_date_str = $('#'+id_field_date).val();
    if (has_trigger === undefined)
        has_trigger = true;

    if (has_clear === undefined)
        has_clear = true;

    if(dotb_config_lock_info == true || dotb_config_lock_info == '1'){
        if(except_lock_for_user_name != ''){
            var count_match = 0;
            var val_user_name = except_lock_for_user_name.split(',');
            $.each(val_user_name, function( index, user_name ) {
                if(user_name == current_user_name)
                    count_match++;
            });
            if(count_match > 0) return true;
        }
        if(is_admin == '1' || is_admin == true){
            return true;
        }else{
            if(check_date_str != ''){
                var input_date = DOTB.util.DateUtils.parse(check_date_str,cal_date_format);
                var now_date = new Date();
                var splitted = dotb_config_lock_date.split("-");
                var check_date = new Date(input_date.getFullYear(), input_date.getMonth()+1, parseInt(splitted[0]), parseInt(splitted[1]));
                var suggestion = DOTB.util.DateUtils.formatDate(  new Date(now_date.getFullYear(), now_date.getMonth(), 1) );
                //neu ngay hien tai dang thao tac sua Out > ngay lock cua thang do thi false
                if(now_date.getTime() > check_date.getTime()){
                    if(has_clear){
                        toastr.error('Date: '+check_date_str +' has been prevented by data-lock funtion. <br> Date should be greater than '+suggestion, 10000);
                        //$('#'+id_field_date).val(DOTB.util.DateUtils.formatDate(now_date));
                        $('#'+id_field_date).val('').effect("highlight", {color: 'red'}, 2000);
                    }

                    if(has_trigger)
                        $('#'+id_field_date).trigger('change');
                    return false;
                }
                else return true;
            }
        }
    }
    else return true;
}

/*
* Util function to fix the callOnChangeListers function - Trigger Date Fields
* By: Lap Nguyen
* Date: 09-07-2015
*/
DOTB.util.callOnChangeListers = function(field) {
    var listeners = YAHOO.util.Event.getListeners(field, 'change');
    if (listeners != null) {
        for (var i = 0; i < listeners.length; i++) {
            var l = listeners[i];
            l.fn.call(l.scope ? l.scope : this, l.obj);
        }
    }

    // Trigger jquery change event
    $(field).trigger('change');
}

/*
* Custom Quick Edit
* By: Lap Nguyen
* Date: 09-07-2015
*/
function quickAdminEdit(table, field){
    $('#btnedit_'+field).on('click',function(){
        $('#panel_1_'+field).hide();
        $('#panel_2_'+field).show();
    });
    $('#btncancel_'+field).on('click',function(){
        $('#panel_1_'+field).show();
        $('#panel_2_'+field).hide();
    });
    $('#btnsave_'+field).on('click',function(){
        $('#panel_2_'+field).hide();
        $('#loading_'+field).show();
        $.ajax({
            url: "index.php?entryPoint=quickEditAdmin",
            type: "POST",
            async: true,
            data:  {
                type : 'quickAdminEdit',
                table : table,
                field : field,
                module : module_dotb_grp1 ,
                record: $('input[name=record]').val(),
                value : $('#value_'+field).val(),
            },
            dataType: "json",
            success: function(res){
                if(res.success == 1){
                    $('#value_'+field).val(res.value);
                    $('#label_'+field).text(res.value);
                }
                else
                    toastr.error(res.error);

                $('#panel_1_'+field).show();
                $('#loading_'+field).hide();
            },
        });
    });
}

function quickAdminEdit2(table, field, field2){
    $('#btnedit_'+field).on('click',function(){
        $('#panel_1_'+field).hide();
        $('#panel_2_'+field).show();
    });
    $('#btncancel_'+field).on('click',function(){
        $('#panel_1_'+field).show();
        $('#panel_2_'+field).hide();
    });
    $('#btnsave_'+field).on('click',function(){
        $('#panel_2_'+field).hide();
        $('#loading_'+field).show();
        if($('#value_'+field2).is(':checkbox'))
            if($('#value_'+field2).is(':checked'))
                $('#value_'+field2).val('1');
            else $('#value_'+field2).val('0');
        $.ajax({
            url: "index.php?entryPoint=quickEditAdmin",
            type: "POST",
            async: true,
            data:  {
                type    : 'quickAdminEdit',
                table   : table,
                field   : field,
                field2  : field2,
                module  : module_dotb_grp1 ,
                record  : $('input[name=record]').val(),
                value   : $('#value_'+field).val(),
                value2  : $('#value_'+field2).val(),
            },
            dataType: "json",
            success: function(res){
                if(res.success == 1){
                    $('#value_'+field).val(res.value);
                    $('#label_'+field).text(res.value);
                    if(res.value2 != null && res.value2 != ''){
                        $('#value_'+field2).val(res.value2);
                        $('#label_'+field2).val(res.value2);
                        if($('#label_'+field2).is(':checkbox'))
                            if(res.value2 == '1')  $('#label_'+field2).prop('checked', true);
                            else $('#label_'+field2).prop('checked', false);
                    }
                }
                else
                    toastr.error(res.error);

                $('#panel_1_'+field).show();
                $('#loading_'+field).hide();
            },
        });
    });
}

function countSms(text){
    var length, messages, per_message, remaining;
    length = text.val().length;
    if(typeof maximum_sms == 'undefined' || maximum_sms == '')
        maximum_sms = 3;
    per_message = 160;
    if (length > per_message) {
        per_message = 153;
    }
    messages = Math.ceil(length / per_message);
    remaining = (per_message * messages) - length;
    if(remaining == 0 && messages == 0){
        remaining = per_message;
    }
    messages_str = 'Messages: '+messages+'/'+maximum_sms+' ('+remaining+' remaining).';
    if(messages > maximum_sms)
        messages_str = 'Messages: <span style="color:red">'+messages+'/'+maximum_sms+' Limited messages, SMS will be failed!</span>';

    text.closest("tr").find(".message_counter").html(messages_str);
}

/*
* Customize Subpanel as horizontal tabs
* By: Lap Nguyen
* Date: 09-07-2015
*/
$(document).ready(function(){

    // Only do when subpanel tabs is enabled
    if($('#groupTabs')[0] != null){
        var customStyle = '<style type="text/css">#groupTabs li{display: block; float: left; margin-bottom: 8px;}</style>';
        $('head').append(customStyle);
        function hideAllSubpanel(){
            $('#subpanel_list li').each(function(){
                $(this).hide();
            });
        }

        function showAllSubpanel(){
            $('#subpanel_list li').each(function(){
                $(this).show();
            });
        }

        function markActive(tab){
            $('#groupTabs li a.current').removeClass('current');
            $(tab).addClass('current');
        }

        // Hide all subpanel on load
        hideAllSubpanel();
        // Hide all default tabs
        $('#groupTabs li').hide();
        $('#groupTabs li a.current').removeClass('current');
        $('#groupTabs li:first').show();

        // Generate each subpanel as a tab
        $('#subpanel_list li').each(function(){
            var moduleName = $(this).find('h3').text();
            var subpanelID = $(this).attr('id');
            $('#groupTabs').append('<li><a data-subpanel="'+subpanelID+'" href="">'+moduleName+'</a></li>');
        });

        // Onclick on a tab
        $('#groupTabs li a').click(function(){
            markActive($(this));
            var subpanelID = $(this).attr('data-subpanel');
            hideAllSubpanel();
            $('#'+subpanelID).show();
            $('#subpanel_list li.dotb_action_button').show();
            $('#subpanel_list li.single').show();
            $('#subpanel_list li.dotb_action_button').find('.subnav').find('li').show();
            return false;
        });

        // Onclick show all
        $('#groupTabs li:first a').click(function(){
            markActive($(this));
            showAllSubpanel();
        });

        jQuery('a[data-subpanel="undefined"]').parent().hide();
    }
});
//popup_helper.js
function closePopup(){window.opener.get_close_popup()&&window.close()}function confirmDialog(arrayContents,formName){var newData="",labels="",oldData="";eval("var data = {"+arrayContents.join(",")+"}");var opener=window.opener.document;for(var key in data){var displayValue=replaceHTMLChars(data[key]);if(opener.forms[formName]&&null!=opener.getElementById(key+"_label")&&!key.match(/account/)){var dataLabel=opener.getElementById(key+"_label").innerHTML.replace(/\n/gi,"").replace(/<\/?[^>]+(>|$)/g,"");labels+=dataLabel+" \n",newData+=dataLabel+" "+displayValue+"\n",window.opener.document.forms[formName].elements[key]&&(oldData+=dataLabel+" "+opener.forms[formName].elements[key].value+"\n")}}var popupConfirm=0;return data.account_id&&newData.split("\n").length-1>2&&newData!=oldData&&oldData!=labels&&(popupConfirm=confirm(DOTB.language.get("app_strings","NTC_OVERWRITE_ADDRESS_PHONE_CONFIRM")+"\n\n"+newData)?1:-1),popupConfirm}function send_back(module,id){var associated_row_data=associated_javascript_data[id];if(eval("var temp_request_data = "+window.document.forms.popup_query_form.request_data.value),temp_request_data.jsonObject)var request_data=temp_request_data.jsonObject;else var request_data=temp_request_data;var passthru_data=Object();void 0!==request_data.passthru_data&&(passthru_data=request_data.passthru_data);var form_name=request_data.form_name,field_to_name_array=request_data.field_to_name_array,call_back_function=eval("window.opener."+request_data.call_back_function),array_contents=Array();for(var the_key in field_to_name_array)if("toJSON"!=the_key){var the_name=field_to_name_array[the_key],the_value="";""!=module&&""!=id&&(the_value=associated_row_data.DOCUMENT_NAME&&"NAME"==the_key.toUpperCase()?associated_row_data.DOCUMENT_NAME:"USER_NAME"!=the_key.toUpperCase()&&"LAST_NAME"!=the_key.toUpperCase()&&"FIRST_NAME"!=the_key.toUpperCase()||"undefined"==typeof is_show_fullname||!is_show_fullname||"search_form"==form_name?associated_row_data[the_key.toUpperCase()]:associated_row_data.FULL_NAME),"string"==typeof the_value&&(the_value=the_value.replace(/\r\n|\n|\r/g,"\\n")),array_contents.push('"'+the_name+'":"'+the_value+'"')}var popupConfirm=confirmDialog(array_contents,form_name);eval("var name_to_value_array = {"+array_contents.join(",")+"}"),closePopup();var result_data={form_name:form_name,name_to_value_array:name_to_value_array,passthru_data:passthru_data,popupConfirm:popupConfirm};call_back_function(result_data)}function send_back_teams(module,form,field,error_message,request_data,form_team_id){var array_contents=Array();if(form_team_id)array_contents.push(form_team_id);else{var j=0;for(i=0;i<form.elements.length;i++)form.elements[i].name==field&&1==form.elements[i].checked&&array_contents.push(form.elements[i].value)}if(0!=array_contents.length){var field_to_name_array=request_data.field_to_name_array,array_teams=new Array;for(team_id in array_contents)if("string"==typeof array_contents[team_id]){var team={team_id:associated_javascript_data[array_contents[team_id]].ID,team_name:associated_javascript_data[array_contents[team_id]].NAME};array_teams.push(team)}var passthru_data=Object();void 0===request_data.call_back_function&&"object"==typeof request_data&&(request_data=YAHOO.lang.JSON.parse(html_entity_decode(request_data.value))),void 0!==request_data.passthru_data&&(passthru_data=request_data.passthru_data);var form_name=request_data.form_name,field_name=request_data.field_name;closePopup();var call_back_function=eval("window.opener."+request_data.call_back_function),result_data={form_name:form_name,field_name:field_name,teams:array_teams,passthru_data:passthru_data};call_back_function(result_data)}else window.alert(error_message)}function send_back_selected(module,form,field,error_message,request_data){var array_contents=Array(),j=0;for(i=0;i<form.elements.length;i++)form.elements[i].name==field&&1==form.elements[i].checked&&(++j,array_contents.push('"ID_'+j+'":"'+form.elements[i].value+'"'));if(0!=array_contents.length){if(eval("var selection_list_array = {"+array_contents.join(",")+"}"),eval("var temp_request_data = "+window.document.forms.popup_query_form.request_data.value),temp_request_data.jsonObject)var request_data=temp_request_data.jsonObject;else var request_data=temp_request_data;var passthru_data=Object();void 0!==request_data.passthru_data&&(passthru_data=request_data.passthru_data);var form_name=request_data.form_name,field_to_name_array=request_data.field_to_name_array;closePopup();var call_back_function=eval("window.opener."+request_data.call_back_function),result_data={form_name:form_name,selection_list:selection_list_array,passthru_data:passthru_data,select_entire_list:form.select_entire_list.value,current_query_by_page:form.current_query_by_page.value};call_back_function(result_data)}else window.alert(error_message)}function toggleMore(a,e,t,r,o){toggle_more_go=function(){return oReturn=function(e,t,o,n){$(".ui-dialog").find(".open").dialog("close");var _="#"+a+" img";"DisplayInlineTeams"==r&&(_="#"+a);var s=$('<div class="open"></div>').html(e).dialog({autoOpen:!1,title:t,width:300,position:{my:"right top",at:"left top",of:$(_)}}),i=(o=s.dialog("option","width"),$(_).offset()),l=$(_).width();i.left+l-40<o&&s.dialog("option","position",{my:"left top",at:"right top",of:$(_)}),s.dialog("open")},success=function(e){var t=JSON.parse(e.responseText);return DOTB.util.additionalDetailsCache[a]=new Array,DOTB.util.additionalDetailsCache[a].body=t.body,DOTB.util.additionalDetailsCache[a].caption=t.caption,DOTB.util.additionalDetailsCache[a].width=t.width,DOTB.util.additionalDetailsCache[a].theme=t.theme,ajaxStatus.hideStatus(),oReturn(DOTB.util.additionalDetailsCache[a].body,DOTB.util.additionalDetailsCache[a].caption,DOTB.util.additionalDetailsCache[a].width,DOTB.util.additionalDetailsCache[a].theme)},void 0!==DOTB.util.additionalDetailsCache[a]?oReturn(DOTB.util.additionalDetailsCache[a].body,DOTB.util.additionalDetailsCache[a].caption,DOTB.util.additionalDetailsCache[a].width,DOTB.util.additionalDetailsCache[a].theme):void 0===DOTB.util.additionalDetailsCalls[a]?(ajaxStatus.showStatus(DOTB.language.get("app_strings","LBL_LOADING")),url="index.php?module="+t+"&action="+r+"&"+o,DOTB.util.additionalDetailsCalls[a]=YAHOO.util.Connect.asyncRequest("GET",url,{success:success,failure:success}),!1):void 0},DOTB.util.additionalDetailsRpcCall=window.setTimeout("toggle_more_go()",250)}DOTB.util.doWhen("window.document.forms['popup_query_form'] != null && typeof(window.document.forms['popup_query_form'].request_data) != 'undefined'",function(){""==window.document.forms.popup_query_form.request_data.value&&(window.document.forms.popup_query_form.request_data.value=window.opener.get_popup_request_data())}),$(document).ready(function(){$("ul.clickMenu").each(function(a,e){$(e).dotbActionMenu()})});
//END: popup_helper.js