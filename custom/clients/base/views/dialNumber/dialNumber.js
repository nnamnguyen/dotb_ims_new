({
    _isOpen: false,
    _lastDial: 0,
    events: {
        'click [data-action=dialNumber]': 'dialNumber',
        'click [data-action=close]': 'close',
        'click [data-action=addNumber]': 'addNumber',
        'click [data-action=delNumber]': 'delNumber',
        'click [data-action=delAllNumber]': 'delAllNumber',
        'keyup .phone_number': 'formatPhoneNumber',
    },
    initialize: function (options) {
        this._super('initialize', [options]);
        this.context.set('skipFetch', true);
        this.button = $(options.button);
    },
    show: function (show) {
        if (show) {
            if (this._isOpen) return;
            this.render();
            this._initPopover(this.button);
            this.button.popover('show');
            this.trigger('show');
            this._isOpen = true;
        } else {
            this.button.popover('destroy');
            this.trigger('hide');
            this._isOpen = false;
        }
    },
    close: function () {
        this.show(false);
    },
    _initPopover: function (button) {
        button.popover({
            title: app.lang.get('LBL_CALLCENTER_BUTTON'),
            content: _.bind(function () {
                return this.$el;
            }, this),
            html: true,
            placement: 'top',
            trigger: 'manual',
            template: '<div class="popover custom-popover dialnumber-box"><div class="arrow hidden"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'
        });
        button.on('shown.bs.popover', _.bind(this._positionPopover, this));
    },
    _positionPopover: function () {
        var $popoverContainer = this.button.data()['bs.popover'].tip();
        var left = $(window).width() - $popoverContainer.width() - 16;
        $popoverContainer.css('left', left);
    },
    delAllNumber: function (evt) {
        $(evt.currentTarget).closest('.custom-popover').find('.phone_number').val('');
    },
    delNumber: function (evt) {
        var phoneEl = $(evt.currentTarget).closest('.custom-popover').find('.phone_number');
        if (phoneEl.val().length == 0) return;
        else if (phoneEl.val().length == 1) phoneEl.val('');
        else phoneEl.val(phoneEl.val().substr(0, phoneEl.val().length - 1));
    },
    addNumber: function (evt) {
        var phoneEl = $(evt.currentTarget).closest('.custom-popover').find('.phone_number');
        if (phoneEl.val().length == 15) return;
        phoneEl.val(phoneEl.val() + $(evt.currentTarget).text());
    },
    formatPhoneNumber: function (e) {
        var rex = /[0-9\+\-\*\#]/g;
        if ($(e.currentTarget).val().length >= 1)
            if (!rex.test($(e.currentTarget).val()[$(e.currentTarget).val().length - 1]))
                $(e.currentTarget).val($(e.currentTarget).val().substr(0, $(e.currentTarget).val().length - 1));
    },
    dialNumber: function () {
        if (Math.floor(new Date().getTime() / 1000) - this._lastDial < 40) toastr.error(app.lang.get('LBL_CALL_UNDER_40S_SYNC'));
        this._lastDial = Math.floor(new Date().getTime() / 1000);
        var self = this;
        $('.dialnumber-box').hide();
        app.api.call('update', app.api.buildURL('callcenter', 'dial'), {phone: $('.dialnumber-box').find('.phone_number').val()}, {
            success: function (res) {
                if (res.message == "success") {
                    self.show(false);
                    CALLCENTER.show({
                        from: res.from,
                        to: res.to
                    });
                } else {
                    $('.dialnumber-box').show();
                    App.alert.show('message-id', {
                        level: 'error',
                        messages: App.lang.get('LBL_CAN_NOT_DIAL_CALLCENTER'),
                        autoClose: true
                    });
                }
            }
        });
    }
})
