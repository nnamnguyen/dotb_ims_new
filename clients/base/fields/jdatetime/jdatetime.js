({
    fieldTag: 'input[data-type=jdatetime]',
    events: {
        'change input[data-type=jdatetime]': 'dataChange'
    },
    initialize: function (options) {
        this._super('initialize', [options]);

        //placeholder
        this.fieldPlaceholder = app.date.convertFormat(app.user.getPreference('datepref') + ' ' + app.user.getPreference('timepref'));

        //default value
        if (typeof this.def.default != "undefined" && _.isEmpty(this.model.get(this.name))) {
            switch (this.def.default) {
                case 'now':
                    this.model.setDefault(this.name, app.date(new Date()).formatServer());
                    break;
                case 'days-from-now':
                    var d=new Date();
                    d.setDate(d.getDate()+this.def.num_days);
                    this.model.setDefault(this.name, app.date(d).formatServer());
                    break;
            }
        }
    },

    dataChange: function () {
        var value = this.$(this.fieldTag).val();
        if (_.isEmpty(value)) value = '';
        value = app.date(value, app.date.convertFormat(app.user.getPreference('datepref') + ' ' + app.user.getPreference('timepref')));
        if (value.isValid()) value = value.formatServer();
        else value = '';
        this.model.set(this.name, value);
    },

    format: function (value) {
        if (!_.isEmpty(value)) {
            value = app.date(value);
            if (value.isValid()) {
                return value.formatUser();
            }
        }
    },

    unformat: function (value) {
        if (!_.isEmptyValue(value)) {
            value = app.date(value, app.date.convertFormat(app.user.getPreference('datepref') + ' ' + app.user.getPreference('timepref')));
            if (value.isValid()) {
                return value.formatServer();
            }
        }
    },

    _render: function () {
        this._super('_render');
        var step = typeof this.def.step != "undefined" ? parseInt(this.def.step, 10) : 15;
        var lang = app.lang.getLanguage().substr(0, 2) == 'vn' ? 'vi' : App.lang.getLanguage().substr(0, 2);
        $.tdtpicker.setLocale(lang);
        this.$(this.fieldTag).tdtpicker({
            format: app.user.getPreference('datepref') + ' ' + app.user.getPreference('timepref'),
            dayOfWeekStart: parseInt(app.user.getPreference('first_day_of_week'), 10),
            step: step
        });
    }
})