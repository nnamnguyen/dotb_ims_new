({
    fieldTag: 'input[data-type=jdate]',
    initialize: function (options) {
        this._super('initialize', [options]);

        //placeholder
        this.fieldPlaceholder = app.date.convertFormat(app.user.getPreference('datepref'));

        //default value
        if (typeof this.def.default != "undefined" && _.isEmptyValue(this.model.get(this.name))) {
            switch (this.def.default) {
                case 'now':
                    this.model.setDefault(this.name, app.date(new Date()).formatServer(true));
                    break;
                case 'days-from-now':
                    var d=new Date();
                    d.setDate(d.getDate()+this.def.num_days);
                    this.model.setDefault(this.name, app.date(d).formatServer());
                    break;
            }
        }
    },

    format: function (value) {
        if (!_.isEmptyValue(value)) {
            value = app.date(value);
            if (value.isValid()) {
                return value.formatUser(true);
            }
        }
    },

    unformat: function (value) {
        if (!_.isEmptyValue(value)) {
            value = app.date(value, app.date.convertFormat(app.user.getPreference('datepref')), true);
            if (value.isValid()) {
                return value.formatServer(true);
            }
        }
    },

    _render: function () {
        this._super('_render');
        var lang = app.lang.getLanguage().substr(0, 2) == 'vn' ? 'vi' : App.lang.getLanguage().substr(0, 2);
        $.tdtpicker.setLocale(lang);
        this.$(this.fieldTag).tdtpicker({
            format: app.user.getPreference('datepref'),
            timepicker: false,
            dayOfWeekStart: parseInt(app.user.getPreference('first_day_of_week'), 10)
        });
    }
})