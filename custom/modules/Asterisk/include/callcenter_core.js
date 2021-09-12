var callResultMarkDeadLead = ['Busy/No Answer', 'Invalid Number', 'Out of Cover', 'Deny', 'Duplicate'];
var callCenterDurationCount;
var CALLCENTER_CORE = {
    origFavicon: null,
    origTitle: null,
    inRenderCallBoxPhoneNumber: '',

    stopCountCallDuration: function (phoneNumber) {
        clearInterval(callCenterDurationCount);
    },

    enableBtnSave: function (box_id) {
        $('#' + box_id).find('.btn-save').prop('disabled', false);
    },

    showCallBox: function (phoneNumber, direction, beanName, beanId) {
        if (!(typeof beanName === "undefined")) beanName = '';
        if (!(typeof beanId === "undefined")) beanId = '';

        if ($('#footer').find('.btn-toolbar').find('#' + phoneNumber).length === 0 && CALLCENTER_CORE.inRenderCallBoxPhoneNumber !== phoneNumber) {
            CALLCENTER_CORE.inRenderCallBoxPhoneNumber = phoneNumber;

            App.api.call("update", App.api.buildURL('callcenter/getCallBox'), {
                    phone_number: phoneNumber,
                    direction: direction,
                    bean_name: beanName,
                    bean_id: beanId
                }, {
                    success: function (data) {
                        $('#footer').find('.btn-toolbar').append(data.html);
                        var lang = App.lang.getLanguage().substr(0, 2) == 'vn' ? 'vi' : App.lang.getLanguage().substr(0, 2);
                        $.tdtpicker.setLocale(lang);
                        $('#' + phoneNumber).find('.recall_at').tdtpicker({
                            format: App.user.getPreference('datepref') + ' ' + App.user.getPreference('timepref'),
                            dayOfWeekStart: parseInt(App.user.getPreference('first_day_of_week'), 10),
                            step: 15,
                            minDate: '-1970/01/01'
                        });
                        CALL_CENTER.setCallId(phoneNumber, (new Date()).getTime());
                        $('[rel=tooltip]').tooltip();
                        CALL_CENTER.inRenderCallBoxPhoneNumber = 0;
                        if (beanName == 'Leads') {
                            $('#' + phoneNumber).find('.bean_status').show();
                        } else {
                            $('#' + phoneNumber).find('.bean_status').hide();
                        }
                        if (status == 'waiting') {
                            CALL_CENTER.changeLabelCallBoxStatus(phoneNumber, 'waiting');
                        } else {
                            CALL_CENTER.changeLabelCallBoxStatus(phoneNumber, 'ringing');
                        }
                        CALL_CENTER.initOnchangeCallResult(phoneNumber);

                        $('.deadlead').closest('label').hide();

                        CALL_CENTER.changeCallBoxPosition(phoneNumber);
                    }
                }
            );
        }
        if (status == 'waiting') {
            CALL_CENTER.changeLabelCallBoxStatus(phoneNumber, 'waiting');
        } else {
            CALL_CENTER.changeLabelCallBoxStatus(phoneNumber, 'ringing');
        }
    },

    initOnchangeCallResult: function (phoneNumber) {
        $('#' + phoneNumber).find('.slc-recall').on('change', function () {
            if ($(this).val() == 99999) {
                $('#' + phoneNumber).find('.timerecall').show();
            } else {
                $('#' + phoneNumber).find('.timerecall').hide();
            }
            CALL_CENTER.changeCallBoxPosition(phoneNumber);
        });
    },

    closeCallBox: function (box_id) {
        App.alert.show('confirmation', {
            level: 'confirmation',
            messages: 'Do you want close this call box?',
            autoClose: true,
            onConfirm: function () {
                if ($('#' + box_id).find('[data-type="save_call_log"]').attr('data-click') == '1' && $('#' + box_id).find('.call-description').attr('data-saved') && $('#' + box_id).find('.call-description').val() == '') {
                    toastr.error('Please fill description of call and save it before close');
                } else {
                    $('#' + box_id).remove();
                }
            }
        });
    },
    setDurationCall: function (box_id, duration) {
        duration = parseInt(duration, 10);
        var m = parseInt(duration / 60);
        var s = duration % 60;
        var h = 0;
        if (m > 60) {
            h = parseInt(m / 60);
            m = m % 60;
        }
        if (m < 10) m = '0' + m;
        if (s < 10) s = '0' + s;
        if (h > 0) {
            if (h < 10) h = '0' + h;
            $('#' + box_id).find('.duration-call').text(h + ':' + m + ':' + s);
        } else {
            $('#' + box_id).find('.duration-call').text(m + ':' + s);
        }
    },
    miniCallBox: function (box_id) {
        if ($('#' + box_id).find('.popover-content').is(':visible')) {
            $('#' + box_id).find('.popover-content').hide();
            $('#' + box_id).find('.mini-call-box').removeClass('fa-chevron-down').addClass('fa-chevron-up').attr('data-original-title', 'maximum');
            this.changeCallBoxPosition(box_id);
        } else {
            $('#' + box_id).find('.popover-content').show();
            $('#' + box_id).find('.mini-call-box').removeClass('fa-chevron-up').addClass('fa-chevron-down').attr('data-original-title', 'minimum');
            this.changeCallBoxPosition(box_id);
        }
    },

    setCallId: function (box_id, id) {
        $('#' + box_id).attr('data-call-id', id);
    },

    changeCallBoxPosition: function (phoneNumber) {
        $('#' + phoneNumber).css({
            'top': -$('#' + phoneNumber).height() + 35,
            'left': window.innerWidth - 466
        });
    },

    changeLabelCallBoxStatus: function (phoneNumber, status) {
        switch (status) {
            case 'waiting':
                $('#' + phoneNumber).find('.label-call-status').prop('class', false).attr('class', 'label label-inverse label-call-status').text('Waiting');
                break;
            case 'ringing':
                $('#' + phoneNumber).find('.label-call-status').prop('class', false).attr('class', 'label label-inverse label-call-status').text('Ringing');
                break;
            case 'connected':
                $('#' + phoneNumber).find('.label-call-status').prop('class', false).attr('class', 'label label-success label-call-status').text('Connected');
                break;
            case 'hangup':
                $('#' + phoneNumber).find('.label-call-status').prop('class', false).attr('class', 'label label-important label-call-status').text('Hangup');
                break;
        }
    },

    notifyCallInFavicon: function (title) {
        CALL_CENTER.origFavicon = $('head').find('link[rel$="icon"]').attr("href");
        CALL_CENTER.origTitle = document.title;

        $('head').find('link[rel$="icon"]').attr("href", 'custom/modules/Asterisk/include/calling.png');
        $(document).prop('title', title);

        var waitToRevertFavicon = setInterval(function () {
            if (!$(document).prop('hidden')) {
                $('head').find('link[rel$="icon"]').attr("href", CALL_CENTER.origFavicon);
                $(document).prop('title', CALL_CENTER.origTitle);
                clearInterval(waitToRevertFavicon);
            }
        }, 1000);
    },

    notifyMissedCallFavicon: function (title) {
        $('head').find('link[rel$="icon"]').attr("href", 'custom/modules/Asterisk/include/misscall.png');
        $(document).prop('title', title);

        var waitToRevertFaviconOnMissedCall = setInterval(function () {
            if (!$(document).prop('hidden')) {
                $('head').find('link[rel$="icon"]').attr("href", CALL_CENTER.origFavicon);
                $(document).prop('title', CALL_CENTER.origTitle);
                clearInterval(waitToRevertFaviconOnMissedCall);
            }
        }, 1000);
    },

    saveCallLog: function (phoneNumber) {
        if ($('#' + phoneNumber).find('[data-type="save_call_log"]').attr('data-click') == '1' && $('#' + phoneNumber).find('.call-description').val() == '') {
            toastr.error('Please fill description of call before save');
            return;
        }
        if (!$('#' + phoneNumber).find('.slc_call_result option:selected').val() && $('#' + phoneNumber).find('[data-type="save_call_log"]').attr('data-click') == '1') {
            toastr.error('Please select Call Result before save');
            return;
        }
        $('#' + phoneNumber).find('[data-type="save_call_log"]').html('<i style="color:white !important;" class="fa fa-spinner fa-spin"></i>');
        var dt = $('#' + phoneNumber).find('.recall_at').tdtpicker('getValue');
        dt = dt.toISOString();
        dt = dt.replace('T', ' ');
        dt = dt.replace('Z', '');
        dt = dt.substr(0, 19);
        var tz = new Date();
        tz = tz.getTimezoneOffset() * 60;
        var data = {
            UniqueId: $('#' + phoneNumber).attr('data-call-id'),
            PhoneNumber: phoneNumber,
            Extension: $('#' + phoneNumber).find('#Extension').val(),
            Direction: $('#' + phoneNumber).find('#Direction').val(),
            Duration: $('#' + phoneNumber).find('#Duration').val(),
            StartTime: $('#' + phoneNumber).find('#StartTime').val(),
            EndTime: $('#' + phoneNumber).find('#EndTime').val(),
            callResult: $('#' + phoneNumber).find('.slc_call_result option:selected').val(),
            description: $('#' + phoneNumber).find('.call-description').val(),
            recordBeanModule: $('#' + phoneNumber).find('#callbox_bean_type').val(),
            recordBeanId: $('#' + phoneNumber).find('#callbox_bean_id').val(),
            recall: $('#' + phoneNumber).find('.recall option:selected').val(),
            recall_at: dt,
            tz: tz,
            deadlead: $('#' + phoneNumber).find('.deadlead').is(':checked') ? 1 : 0,
            favorite: $('#' + phoneNumber).find('.favorite').is(':checked') ? 1 : 0,
            callPurpose: $('#' + phoneNumber).find('.slc_call_purpose option:selected').val()
        };
        App.api.call("update", App.api.buildURL('callcenter/savecalllog'), data, {
                success: function (res) {
                    if ($('#' + phoneNumber).find('[data-type="save_call_log"]').attr('data-click') == '1') {
                        $('#' + phoneNumber).remove();
                    } else {
                        $('#' + phoneNumber).find('[data-type="save_call_log"]').html('save');
                    }
                    if (res.success) {
                        toastr.success('Call log ' + phoneNumber + ' saved');
                        $('#' + phoneNumber).find('.call-description').attr('data-saved', 1);
                    } else toastr.error('Call log ' + phoneNumber + ' not be saved');
                }
            }
        );
    },

    changeBean: function (module, box_id) {
        App.drawer.open({
            layout: 'selection-list',
            context: {
                module: module
            }
        }, function (model) {
            if (module == 'Leads') {
                $('#' + box_id).find('.bean_status').closest('.row-fluid').show();
            } else {
                $('#' + box_id).find('.bean_status').closest('.row-fluid').hide();
            }

            $('#' + box_id).find('#callbox_bean_id').val(model.id);
            $('#' + box_id).find('#callbox_bean_type').val(module);
            $('#' + box_id).find('.bean_type_display').text(module);
            $('#' + box_id).find('#callbox_full_name').val(model.name);
            $('#' + box_id).find('.link_to_bean').attr('href', '#' + module + '/' + model.id).html('<b>' + model.name + '</b>');
            $('#' + box_id).find('.bean_status').text(model.status);
            if (model.email.length > 0) {
                $('#' + box_id).find('.bean_email').text(model.email[0].email_address);
            }
            App.api.call("read", App.api.buildURL('callcenter/getbean?' + 'bean=' + module + '&id=' + model.id),
                null, {
                    success: function (data) {
                        $('#' + box_id).find('.bean_address').text(data.address_state + ', ' + data.address_city);
                        var rs = $('#' + box_id).find('.slc_call_result option:selected').val();
                        if (module == 'Leads' && callResultMarkDeadLead.includes(rs))
                            $('.deadlead').closest('label').show();
                        else $('.deadlead').closest('label').hide();
                    }
                }
            );
        });
    },

    changeCallResult: function (phoneNumber) {
        var module = $('#' + phoneNumber).find('#callbox_bean_type').val();
        var rs = $('#' + phoneNumber).find('.slc_call_result option:selected').val();
        if (module == 'Leads' && callResultMarkDeadLead.includes(rs))
            $('.deadlead').closest('label').show();
        else $('.deadlead').closest('label').hide();
    },

    transferCall: function (box_id, transferTo) {
        var lMessageToken = {
            ns: CALL_CENTER.jwsc.NS,
            type: "TransferCall",
            UniqueID: $('#' + box_id).attr('data-call-id'),
            TransferTo: transferTo,
            extension: window.PhoneExtension,
            ip: window.AsteriskIP,
            CustomContext: window.DialPlan,
            transfer: "null",
            identifier: "identifier"
        };

        var lCallbacks = {
            OnFailure: function (aToken) {
                App.alert.show('message-error', {
                    level: 'error',
                    messages: 'Fail to make a call',
                    autoClose: true
                });
            }
        };

        CALL_CENTER.jwsc.sendToken(lMessageToken, lCallbacks);
    },

    showBtnTransfer: function (box_id) {
        $('#' + box_id).find('.transfer-btn-group').show();
    },

    showBtnHangup: function (box_id) {
        $('#' + box_id).find('.hangup-btn').show();
    },

    hideBtnTransfer: function (box_id) {
        $('#' + box_id).find('.transfer-btn-group').hide();
    },

    hideBtnHangup: function (box_id) {
        $('#' + box_id).find('.hangup-btn').hide();
    },

    setCallInfo: function (aEvent) {
        $('#' + aEvent.PhoneNumber).find('#Direction').val(aEvent.Direction);
        $('#' + aEvent.PhoneNumber).find('#Duration').val(aEvent.Duration);
        $('#' + aEvent.PhoneNumber).find('#StartTime').val(aEvent.StartTime);
        $('#' + aEvent.PhoneNumber).find('#EndTime').val(aEvent.EndTime);
        $('#' + aEvent.PhoneNumber).find('#Extension').val(aEvent.Extension);
    },

    selectExistBean: function (bean_id, box_id) {
        var beans = JSON.parse($('#' + box_id).find('#list_bean_json').val());
        var bean = beans[bean_id];
        if (bean.BEAN_NAME == 'Leads') {
            $('#' + box_id).find('.bean_status').closest('.row-fluid').show();
        } else {
            $('#' + box_id).find('.bean_status').closest('.row-fluid').hide();
        }
        $('#' + box_id).find('#callbox_bean_id').val(bean.BEAN_ID);
        $('#' + box_id).find('#callbox_bean_type').val(bean.BEAN_NAME);
        $('#' + box_id).find('#callbox_full_name').val(bean.FULL_NAME);
        $('#' + box_id).find('.link_to_bean').attr('href', '#' + bean.BEAN_NAME + '/' + bean.BEAN_ID).text(bean.FULL_NAME);
        $('#' + box_id).find('.bean_type_display').text(bean.BEAN_NAME);
        $('#' + box_id).find('.bean_status').text(bean.BEAN_STATUS);
        $('#' + box_id).find('.bean_email').text(bean.EMAIL);
        $('#' + box_id).find('.bean_address_street').html(bean.ADDRESS + (bean.ADDRESS.length ? '<br/>' : '') + bean.STATE + (bean.STATE.length ? '<br/>' : '') + bean.CITY + (bean.CITY.length ? '<br/>' : '') + bean.COUNTRY);

        CALL_CENTER.changeCallBoxPosition(box_id);
    },

    countCallDuration: function (phoneNumber) {
        var countDownDate = new Date().getTime();
        callCenterDurationCount = setInterval(function () {
            var now = new Date().getTime();
            var distance = now - countDownDate;
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            $('#' + phoneNumber).find('.duration-call').text((distance / 1000 > 3600 ? ((hours < 10 ? '0' : '') + hours + ":") : '') + (minutes < 10 ? '0' : '') + minutes + ":" + (seconds < 10 ? '0' : '') + seconds);
        }, 1000);
    }
};