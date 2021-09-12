({
    events: {
        'click .callcenter-icon-clicktocall': 'clickToCall',
        'click .icon-send-sms': 'clickToSendSMS'
    },
    initialize: function (options) {
        this._super('initialize', [options]);
    },
    clickToCall: function (e) {
        if ($('.callbox').length > 0) {
            app.alert.show('error', {
                level: 'error',
                messages: 'Close current call before click to new call!',
                autoClose: true
            });
            return;
        }

        //effect icon call
        var _this = $(e.currentTarget);
        _this.hide();
        _this.parent().find('.fa-spinner').show();
        setTimeout(function () {
            _this.show();
            _this.parent().find('.fa-spinner').hide();
        }, 3000);

        //open call box
        app.view.createView({type: 'callCenter', data: {phoneNumber: _this.attr('data-phone'), beanName: _this.attr('data-bean'), beanId: _this.attr('data-id')}});

        //send event call to supplier
        if (window.has_callcenter) {
            if (window.callcenter_supplier === 'Oncall') window.callcenter_supplier_oncall.clickToCall(_this.attr('data-phone'));
            else if (window.callcenter_supplier === 'Voip24h') window.callcenter_supplier_voip24h.clickToCall(_this.attr('data-phone'));
            else if (window.callcenter_supplier === 'VoiceCloud') window.callcenter_supplier_voicecloud.clickToCall(_this.attr('data-phone'));
        }
    },
    clickToSendSMS: function (e) {
        var _this = $(e.currentTarget);
        _this.hide();
        _this.parent().find('.fa-spinner').show();
        setTimeout(function () {
            _this.show();
            _this.parent().find('.fa-spinner').hide();
        }, 3000);
        openPopupSendSMS(_this.attr('data-value'), _this.attr('data-module'), _this.attr('data-id'));
    },
})
