$(document).ready(function () {
    var options = {
        success: showResponse
    };
    $('#submitFileForm').ajaxForm(options);
    $('#submit_file').on('click', function () {
        app.alert.show('uploading', {
            level: 'process',
            title: 'Uploading'
        });
        $('#txt_receiver').clearAllTags();
    });

    $("#template").on("change", function () {
        var content = $("#template option:selected").attr("content");
        $("#txt_content").val(content);
        countSms($("#txt_content"));
    });

    $("#send_sms").on("click", function () {
        sendSMS();
    });
    countSms($("#txt_content"));
    $('#txt_receiver').tagThis({
        defaultText: 'type to add',
        width: '550px',
        height: '100px',
        noDuplicates: true
    });
    $('.simple-clear-all-button').on('click', function () {
        $('#txt_receiver').clearAllTags();
    });
});

function showResponse(responseText, statusText, xhr, form) {
    var json = jQuery.parseJSON(responseText);
    app.alert.dismiss('uploading');
    if (json.success == "1") {
        //        $("#txt_receiver").val(json.receiversText);
        $("#receiver_json").val(json.receiversJson);
        if (json.receiversJson != '' && json.receiversJson != null) {
            objs = JSON.parse(json.receiversJson);
            $.each(objs, function (phone, name) {
                var tagData = {
                    text: name + ' ' + phone,
                    id: phone
                }
                $('#txt_receiver').addTag(tagData);
            });
        }
        if (json.countRecipients > 0)
            app.alert.show('error-mess', {
                level: 'success',
                messages: json.errorLabel,
                autoClose: true
            });
    } else {
        app.alert.show('error-mess', {
            level: 'error',
            messages: app.lang.get(json.errorLabel, 'Contacts'),
            autoClose: true
        });
    }
}

function checkContent() {
    if ($("#txt_content").val() == "") {
        app.alert.show('error-mess', {
            level: 'error',
            messages: app.lang.get('LBL_EMPTY_CONTENT', 'Contacts'),
            autoClose: true
        });

        return false;
    } else {
        var phones = $('#txt_receiver').data('tags');
        if (phones == undefined) {
            app.alert.show('error-mess', {
                level: 'error',
                messages: app.lang.get('LBL_NO_PHONE_NUMBER', 'Contacts'),
                autoClose: true
            });
            return false;
        } else return true;
    }
}

function sendSMS() {
    if (checkContent()) {
        var phones = $('#txt_receiver').data('tags');
        var msg = $("#txt_content").val();

        app.alert.show('confirm-send', {
            level: 'confirmation',
            messages: 'Are you sure you want to send <b>' + msg + '</b> to ' + phones.length + ' recipients ?',
            autoClose: false,
            onConfirm: function () {
                app.alert.show('sending', {
                    level: 'process',
                    title: 'Sending'
                });
                var count_success = 0;
                var count_fail = 0;
                var count = 0;
                var pid = $("#current_user_id").val();
                var template_id = $("#template").val();
                $("#count_failed").text(count_fail);
                $("#count_received").text(count_success);
                $("#sending_result tbody").html("");
                $("#count_total").text(phones.length);
                $.each(phones, function (num, value) {
                    var split = value.text.split(">");
                    var result = "RECEIVED";
                    var name = get_text_between('<', '>', value.text).trim();
                    var preferences = {};
                    preferences['num'] = split[split.length - 1];
                    preferences['sms_msg'] = msg;
                    preferences['send_to_multi'] = 0;
                    preferences['pid'] = pid;
                    preferences['ptype'] = 'Users';
                    preferences['pname'] = "";
                    preferences['template_id'] = template_id;
                    preferences['team_id'] = app.user.get('team_id');

                    if (name == 'none' || name == '-none-') name = '';
                    if (name != null && name != '')
                        preferences['sms_msg'] = preferences['sms_msg'].replace("$student_name", name).replace("$name", name).replace("$full_name", name);
                    else
                        preferences['sms_msg'] = preferences['sms_msg'].replace("$student_name", '').replace("$name", '').replace("$full_name", '');

                    if (typeof preferences['num'] !== "undefined" && preferences['num'] != '') {
                        app.api.call('update', app.api.buildURL('send-sms'), preferences, {
                            success: function (data) {
                                if (data.indexOf("Failed") < 0) {
                                    count++;
                                    count_success++;
                                    $("#count_received").text(count_success);
                                } else {
                                    count++;
                                    count_fail++;
                                    $("#count_failed").text(count_fail);
                                    result = "FAILED";
                                }
                                $('#sending_result > tbody:last-child').append("<tr><td>" + name + '</td><td>' + preferences['num'] + "</td><td>" + result + "</td></tr>");
                                if (count >= phones.length) app.alert.dismiss('sending');
                            }
                        });
                    }


                });

            },
            onCancel: function () {

            }
        });

    }
}

function showRecentSMS() {
    var current_user = $("#current_user_id").val();
    open_popup('C_SMS', 600, 400, "&assigned_user_id_advanced=" + current_user + "&lvso=DESC&C_SMS2_C_SMS_ORDER_BY=date_entered", true, false, {
        "call_back_function": "set_sms_return",
        "form_name": "EditView",
        "field_to_name_array": {"id": "id", "name": "name"}
    }, "single", true);
}

function get_text_between(start, end, test_str) {
    var start_pos = test_str.indexOf(start) + 1;
    var end_pos = test_str.indexOf(end, start_pos);
    return test_str.substring(start_pos, end_pos)
}

function countSms(text) {
    var length, messages, per_message, remaining;
    length = text.val().length;
    if (typeof maximum_sms == 'undefined' || maximum_sms == '')
        maximum_sms = 3;
    per_message = 160;
    if (length > per_message) {
        per_message = 153;
    }
    messages = Math.ceil(length / per_message);
    remaining = (per_message * messages) - length;
    if (remaining == 0 && messages == 0) {
        remaining = per_message;
    }
    messages_str = 'Messages: ' + messages + '/' + maximum_sms + ' (' + remaining + ' remaining).';
    if (messages > maximum_sms)
        messages_str = 'Messages: <span style="color:red">' + messages + '/' + maximum_sms + ' Limited messages, SMS will be failed!</span>';

    text.closest("tr").find(".message_counter").html(messages_str);
}