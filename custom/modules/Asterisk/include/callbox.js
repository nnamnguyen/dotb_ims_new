var callResultMarkDeadLead = ['Busy/No Answer', 'Invalid Number', 'Out of Cover', 'Deny', 'Duplicate'];
var callCenterDurationCount;
var CALLBOX = {
    origFavicon: null,
    origTitle: null,
    jwsc: null,
    inRenderCallBoxPhoneNumber: '',
    stopCountCallDuration: function (phoneNumber) {
        clearInterval(callCenterDurationCount);
    },
    enableBtnSave: function (box_id) {
        $('#' + box_id).find('.btn-save').prop('disabled', false);
    },
    showCallBox: function (phoneNumber, type, beanName, beanId, status) {
        if (!(typeof beanName === "undefined")) beanName = '';
        if (!(typeof beanId === "undefined")) beanId = '';
        if (!(typeof status === "undefined")) status = 'ringing';

        if ($('#footer').find('.btn-toolbar').find('#' + phoneNumber).length === 0 && CALLBOX.inRenderCallBoxPhoneNumber !== phoneNumber) {
            CALLBOX.inRenderCallBoxPhoneNumber = phoneNumber;
            App.api.call("read", App.api.buildURL('callcenter/getcallbox?'
                + 'phone_number=' + phoneNumber
                + '&type=' + type
                + '&bean_name=' + beanName
                + '&bean_id=' + beanId), null, {
                    success: function (data) {
                        $('#footer').find('.btn-toolbar').append(data.html);
                        var lang = App.lang.getLanguage().substr(0, 2) === 'vn' ? 'vi' : App.lang.getLanguage().substr(0, 2);
                        $.tdtpicker.setLocale(lang);
                        var thisBoxPhoneNumber = $('#' + phoneNumber);
                        thisBoxPhoneNumber.find('.recall_at').tdtpicker({
                            format: App.user.getPreference('datepref') + ' ' + App.user.getPreference('timepref'),
                            dayOfWeekStart: parseInt(App.user.getPreference('first_day_of_week'), 10),
                            step: 15,
                            minDate: '-1970/01/01'
                        });
                        CALLBOX.setCallId(phoneNumber, (new Date()).getTime());
                        $('[rel=tooltip]').tooltip();
                        CALLBOX.inRenderCallBoxPhoneNumber = 0;
                        if (beanName === 'Leads') {
                            thisBoxPhoneNumber.find('.bean_status').show();
                        } else {
                            thisBoxPhoneNumber.find('.bean_status').hide();
                        }
                        if (status === 'waiting') {
                            CALLBOX.changeLabelCallBoxStatus(phoneNumber, 'waiting');
                        } else {
                            CALLBOX.changeLabelCallBoxStatus(phoneNumber, 'ringing');
                        }
                        CALLBOX.initOnchangeCallResult(phoneNumber);

                        $('.deadlead').closest('label').hide();

                        CALLBOX.changeCallBoxPosition(phoneNumber);
                    }
                }
            );
        }
        if (status === 'waiting') {
            CALLBOX.changeLabelCallBoxStatus(phoneNumber, 'waiting');
        } else {
            CALLBOX.changeLabelCallBoxStatus(phoneNumber, 'ringing');
        }
    },
    initOnchangeCallResult: function (phoneNumber) {
        $('#' + phoneNumber).find('.slc-recall').on('change', function () {
            if ($(this).val() == 99999) {
                $('#' + phoneNumber).find('.timerecall').show();
            } else {
                $('#' + phoneNumber).find('.timerecall').hide();
            }
            CALLBOX.changeCallBoxPosition(phoneNumber);
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
        var thisBox = $('#' + box_id);
        if (thisBox.find('.popover-content').is(':visible')) {
            thisBox.find('.popover-content').hide();
            thisBox.find('.mini-call-box').removeClass('fa-chevron-down').addClass('fa-chevron-up').attr('data-original-title', 'maximum');
            this.changeCallBoxPosition(box_id);
        } else {
            thisBox.find('.popover-content').show();
            thisBox.find('.mini-call-box').removeClass('fa-chevron-up').addClass('fa-chevron-down').attr('data-original-title', 'minimum');
            this.changeCallBoxPosition(box_id);
        }
    },

    setCallId: function (box_id, id) {
        $('#' + box_id).attr('data-call-id', id);
    },

    changeCallBoxPosition: function (phoneNumber) {
        var thisPhone = $('#' + phoneNumber);
        thisPhone.css({
            'top': -thisPhone.height() + 35,
            'left': window.innerWidth - 466
        });
    },

    changeLabelCallBoxStatus: function (phoneNumber, status) {
        var thisPHone = $('#' + phoneNumber);
        switch (status) {
            case 'waiting':
                thisPHone.find('.label-call-status').prop('class', false).attr('class', 'label label-inverse label-call-status').text('Waiting');
                break;
            case 'ringing':
                thisPHone.find('.label-call-status').prop('class', false).attr('class', 'label label-inverse label-call-status').text('Ringing');
                break;
            case 'connected':
                thisPHone.find('.label-call-status').prop('class', false).attr('class', 'label label-success label-call-status').text('Connected');
                break;
            case 'hangup':
                thisPHone.find('.label-call-status').prop('class', false).attr('class', 'label label-important label-call-status').text('Hangup');
                break;
        }
    },

    notifyCallInFavicon: function (title) {
        var thisHead = $('head');
        CALLBOX.origFavicon = thisHead.find('link[rel$="icon"]').attr("href");
        CALLBOX.origTitle = document.title;

        thisHead.find('link[rel$="icon"]').attr("href", 'custom/modules/Asterisk/include/calling.png');
        $(document).prop('title', title);

        var waitToRevertFavicon = setInterval(function () {
            if (!$(document).prop('hidden')) {
                $('head').find('link[rel$="icon"]').attr("href", CALLBOX.origFavicon);
                $(document).prop('title', CALLBOX.origTitle);
                clearInterval(waitToRevertFavicon);
            }
        }, 1000);
    },

    notifyMissedCallFavicon: function (title) {
        $('head').find('link[rel$="icon"]').attr("href", 'custom/modules/Asterisk/include/misscall.png');
        $(document).prop('title', title);

        var waitToRevertFaviconOnMissedCall = setInterval(function () {
            if (!$(document).prop('hidden')) {
                $('head').find('link[rel$="icon"]').attr("href", CALLBOX.origFavicon);
                $(document).prop('title', CALLBOX.origTitle);
                clearInterval(waitToRevertFaviconOnMissedCall);
            }
        }, 1000);
    },

    saveCallLog: function (phoneNumber) {
        var thisPhone = $('#' + phoneNumber);
        if (thisPhone.find('[data-type="save_call_log"]').attr('data-click') == '1' && thisPhone.find('.call-description').val() == '') {
            toastr.error('Please fill description of call before save');
            return;
        }
        if (!thisPhone.find('.slc_call_result option:selected').val() && thisPhone.find('[data-type="save_call_log"]').attr('data-click') == '1') {
            toastr.error('Please select Call Result before save');
            return;
        }
        thisPhone.find('[data-type="save_call_log"]').html('<i style="color:white !important;" class="fa fa-spinner fa-spin"></i>');
        var dt = thisPhone.find('.recall_at').tdtpicker('getValue');
        dt = dt.toISOString();
        dt = dt.replace('T', ' ');
        dt = dt.replace('Z', '');
        dt = dt.substr(0, 19);
        var tz = new Date();
        tz = tz.getTimezoneOffset() * 60;
        var data = {
            UniqueId: thisPhone.attr('data-call-id'),
            PhoneNumber: phoneNumber,
            Extension: thisPhone.find('#Extension').val(),
            Direction: thisPhone.find('#Direction').val(),
            Duration: thisPhone.find('#Duration').val(),
            StartTime: thisPhone.find('#StartTime').val(),
            EndTime: thisPhone.find('#EndTime').val(),
            callResult: thisPhone.find('.slc_call_result option:selected').val(),
            description: thisPhone.find('.call-description').val(),
            recordBeanModule: thisPhone.find('#callbox_bean_type').val(),
            recordBeanId: thisPhone.find('#callbox_bean_id').val(),
            recall: thisPhone.find('.recall option:selected').val(),
            recall_at: dt,
            tz: tz,
            deadlead: thisPhone.find('.deadlead').is(':checked') ? 1 : 0,
            favorite: thisPhone.find('.favorite').is(':checked') ? 1 : 0,
            callPurpose: thisPhone.find('.slc_call_purpose option:selected').val()
        };
        App.api.call("update", App.api.buildURL('callcenter/savecalllog'), data, {
                success: function (res) {
                    if (thisPhone.find('[data-type="save_call_log"]').attr('data-click') == '1') {
                        thisPhone.remove();
                    } else {
                        thisPhone.find('[data-type="save_call_log"]').html('save');
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
            var thisBoxId = $('#' + box_id);
            if (module === 'Leads') {
                thisBoxId.find('.bean_status').closest('.row-fluid').show();
            } else {
                thisBoxId.find('.bean_status').closest('.row-fluid').hide();
            }
            thisBoxId.find('#callbox_bean_id').val(model.id);
            thisBoxId.find('#callbox_bean_type').val(module);
            thisBoxId.find('.bean_type_display').text(module);
            thisBoxId.find('#callbox_full_name').val(model.name);
            thisBoxId.find('.link_to_bean').attr('href', '#' + module + '/' + model.id).html('<b>' + model.name + '</b>');
            thisBoxId.find('.bean_status').text(model.status);
            if (model.email.length > 0) {
                $('#' + box_id).find('.bean_email').text(model.email[0].email_address);
            }
            App.api.call("read", App.api.buildURL('callcenter/getbean?' + 'bean=' + module + '&id=' + model.id),
                null, {
                    success: function (data) {
                        thisBoxId.find('.bean_address').text(data.address_state + ', ' + data.address_city);
                        var rs = thisBoxId.find('.slc_call_result option:selected').val();
                        if (module === 'Leads' && callResultMarkDeadLead.includes(rs))
                            $('.deadlead').closest('label').show();
                        else $('.deadlead').closest('label').hide();
                    }
                }
            );
        });
    },

    changeCallResult: function (phoneNumber) {
        var thisPhone = $('#' + phoneNumber);
        var module = thisPhone.find('#callbox_bean_type').val();
        var rs = thisPhone.find('.slc_call_result option:selected').val();
        if (module == 'Leads' && callResultMarkDeadLead.includes(rs))
            $('.deadlead').closest('label').show();
        else $('.deadlead').closest('label').hide();
    },

    setCallInfo: function (aEvent) {
        var thisPhone = $('#' + aEvent.PhoneNumber);
        thisPhone.find('#Direction').val(aEvent.Direction);
        thisPhone.find('#Duration').val(aEvent.Duration);
        thisPhone.find('#StartTime').val(aEvent.StartTime);
        thisPhone.find('#EndTime').val(aEvent.EndTime);
        thisPhone.find('#Extension').val(aEvent.Extension);
    },

    selectExistBean: function (bean_id, box_id) {
        var thisBoxID = $('#' + box_id);
        var beans = JSON.parse(thisBoxID.find('#list_bean_json').val());
        var bean = beans[bean_id];
        if (bean.BEAN_NAME === 'Leads') {
            $('#' + box_id).find('.bean_status').closest('.row-fluid').show();
        } else {
            $('#' + box_id).find('.bean_status').closest('.row-fluid').hide();
        }

        thisBoxID.find('#callbox_bean_id').val(bean.BEAN_ID);
        thisBoxID.find('#callbox_bean_type').val(bean.BEAN_NAME);
        thisBoxID.find('#callbox_full_name').val(bean.FULL_NAME);
        thisBoxID.find('.link_to_bean').attr('href', '#' + bean.BEAN_NAME + '/' + bean.BEAN_ID).text(bean.FULL_NAME);
        thisBoxID.find('.bean_type_display').text(bean.BEAN_NAME);
        thisBoxID.find('.bean_status').text(bean.BEAN_STATUS);
        thisBoxID.find('.bean_email').text(bean.EMAIL);
        thisBoxID.find('.bean_address_street').html(bean.ADDRESS + (bean.ADDRESS.length ? '<br/>' : '') + bean.STATE + (bean.STATE.length ? '<br/>' : '') + bean.CITY + (bean.CITY.length ? '<br/>' : '') + bean.COUNTRY);

        CALLBOX.changeCallBoxPosition(box_id);
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