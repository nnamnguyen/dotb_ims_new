/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
({

    serverTimeFormat: "HH:mm",

    /**
     * @inheritDoc
     */
    initialize: function (options) {
        this._super("initialize", [options]);
    },

    /**
     * @inheritDoc
     */
    _render: function() {
        this._super('_render');

        if (this.action !== 'edit' && this.action !== 'massupdate') {
            return;
        }

        this._setupTimePicker();
    },

    /**
     * Return user time format.
     *
     * @return {String} User time format.
     */
    getUserTimeFormat: function() {
        return app.user.getPreference('timepref');
    },

    /**
     * @inheritDoc
     */
    _dispose: function() {
        if (this.$(this.fieldTag).timepicker) {
            this.$(this.fieldTag).timepicker('remove');
        }

        this._super('_dispose');
    },

    /**
     * Unformats datetime value for storing in model.
     *
     * @return {String} Unformatted value or `undefined` if value is
     *   an invalid date.
     *
     * @override
     */
    unformat: function(value) {
        if (!value) {
            return value;
        }

        value = app.date(value, app.date.convertFormat(this.getUserTimeFormat()), true);

        if (!value.isValid()) {
            return;
        }

        return value.format(this.serverTimeFormat);
    },

    /**
     * Formats date value according to user preferences.
     *
     * @param {String} value Datetime value to format.
     * @return {Object/String/undefined} On edit mode the returned value is an
     *   object with two keys, `date` and `time`. On detail mode the returned
     *   value is a date, formatted according to user preferences if supplied
     *   value is a valid date, otherwise returned value is `undefined`.
     *
     * @override
     */
    format: function(value) {
        if (!value) {
            return value;
        }

        value = app.date(value, this.serverTimeFormat);

        if (!value.isValid()) {
            return;
        }

        value = value.format(app.date.convertFormat(this.getUserTimeFormat()));

        return value;
    },

    /**
     * Set up the time picker.
     *
     * @protected
     */
    _setupTimePicker: function() {
        var options = {
            timeFormat: this.getUserTimeFormat(),
            step: 15,
            disableTextInput: true,
            className: 'prevent-mousedown',
            appendTo: this.view.$el
        };

        this.$(this.fieldTag).timepicker(options);
    }
})
