window.callcenter = {
    exist: function (phone) {
        let result = false;
        $('.callbox').each(function () {
            if ($(this).find('#phoneNumber').val() === phone) result = true;
        });
        return result;
    },
    createCallbox: function (phone, call_status, call_direction) {
        App.view.createView({type: 'callCenter', call_direction: call_direction, call_status: call_status, data: {phoneNumber: phone, beanName: '', beanId: ''}});
    },
    changeCallStatus: function (phone, call_status) {
        $('.callbox').each(function () {
            var $this = $(this);
            if ($this.find('#phoneNumber').val() === phone) {
                $this.find('.call_status_callbox').text(call_status);
                $this.find('.callStatus_callbox').val(call_status);

                if (call_status === 'Connected') {
                    $this.find('.call_status_callbox').removeClass('label-inverse').addClass('label-success');
                    window.callcenter.countCallDuration($this);
                } else if (call_status === 'Hangup') {
                    $this.find('.call_status_callbox').removeClass('label-success').addClass('label-important');
                    window.callcenter.stopCountCallDuration();
                }
            }
        });
    },
    setDataStart: function (phone, data) {
        $('.callbox').each(function () {
            var $this = $(this);
            if ($this.find('#phoneNumber').val() === phone) {
                $this.find('#callId').val(data.callId);
                $this.find('#ext').val(data.ext);
                $this.find('#start').val(data.start);
                $this.find('#start_timestamp').val(data.start_timestamp);
                $this.find('#source').val(data.source);
            }
        });
    },
    setDataEnd: function (phone, data) {
        var _this = this;
        $('.callbox').each(function () {
            var $this = $(this);
            if ($this.find('#phoneNumber').val() === phone) {
                $this.find('#end').val(data.end);
                $this.find('#end_timestamp').val(data.end_timestamp);
                $this.find('#recording').val(data.recording);
                $this.find('#duration').val(parseInt((parseInt(data.end_timestamp, 10) - parseInt($this.find('#start_timestamp').val(), 10)) / 1000, 10));
            }
        });
    },
    save: function (phone) {
        $('.callbox').each(function () {
            var $this = $(this);
            if ($this.find('#phoneNumber').val() === phone) {
                $this.find('.save_callbox').prop('disabled', false);
                $this.find('.save_callbox').attr('data-is-auto-save', '1').click();
            }
        });
    },
    countCallDuration: function ($box) {
        var starttime = new Date().getTime();
        window.callcenter_count_duration = setInterval(function () {
            var now = new Date().getTime();
            var distance = now - starttime;
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            $box.find('.duration_callbox').text((distance / 1000 > 3600 ? ((hours < 10 ? '0' : '') + hours + ":") : '') + (minutes < 10 ? '0' : '') + minutes + ":" + (seconds < 10 ? '0' : '') + seconds);
        }, 1000);
    },
    stopCountCallDuration: function () {
        if (window.callcenter_count_duration) clearInterval(window.callcenter_count_duration);
    }
};
