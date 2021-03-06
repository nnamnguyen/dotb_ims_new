({
    extendsFrom: 'FieldsetField',
    detailViewNames: ['record', 'create', 'create-nodupecheck', 'preview', 'pmse-case'],
    initialize: function (options) {
        this._super('initialize', [options]);

        if (this.model.isNew() && (!this.model.get('date_start'))) {
            this.setDefaultStartDateTime();
            this.modifyEndDateToRetainDuration();
            this.updateDurationHoursAndMinutes();

            this.model.setDefault({
                'date_start': this.model.get('date_start'),
                'date_end': this.model.get('date_end'),
                'duration_hours': this.model.get('duration_hours'),
                'duration_minutes': this.model.get('duration_minutes')
            });
        }
        this.model.addValidationTask('duration_date_range_' + this.cid, _.bind(function (fields, errors, callback) {
            _.extend(errors, this.validate());
            callback(null, fields, errors);
        }, this));
    },

    bindDataChange: function () {
        this.model.on('change:date_start', this.modifyEndDateToRetainDuration, this);

        this.model.on('change:date_start change:date_end', function (model) {
            var dateStartField;
            var dateEndField;
            var errors;

            this.updateDurationHoursAndMinutes();

            if (this.action === 'edit') {
                dateStartField = this.view.getField('date_start');
                dateEndField = this.view.getField('date_end');

                if (dateStartField && !dateStartField.disposed && dateEndField && !dateEndField.disposed) {
                    dateStartField.clearErrorDecoration();
                    dateEndField.clearErrorDecoration();
                    errors = this.validate();

                    if (errors) {
                        dateStartField.decorateError(errors.date_start);
                        dateEndField.decorateError(errors.date_end);
                    }
                }
            } else {
                this.render();
            }
        }, this);

        this._super('bindDataChange');
    },

    validate: function () {
        var errors,
            dateStartField = this.view.getField('date_start'),
            dateEndField = this.view.getField('date_end');

        if (!this.isDateRangeValid()) {
            errors = {};
            errors.date_start = {
                isBefore: dateEndField.label
            };
            errors.date_end = {
                isAfter: dateStartField.label
            };
        }

        return errors;
    },

    format: function (value) {
        var displayString = '',
            startDateString = this.model.get('date_start'),
            endDateString = this.model.get('date_end'),
            startDate,
            endDate,
            duration,
            durationString;

        if (startDateString && endDateString) {
            startDate = app.date(startDateString);
            endDate = app.date(endDateString);
            duration = app.date.duration(endDate - startDate);
            durationString = duration.format() || ('0 ' + app.lang.get('LBL_DURATION_MINUTES'));

            if ((startDate.date() === endDate.date()) &&
                (startDate.month() === endDate.month()) &&
                (startDate.year() === endDate.year())
            ) {
                // Should not display the date twice when the start and the end dates are the same.
                displayString = app.lang.get('LBL_START_AND_END_DATE_SAME_DAY', this.module, {
                    date: startDate.formatUser(true),
                    start: startDate.format(app.date.getUserTimeFormat()),
                    end: endDate.format(app.date.getUserTimeFormat()),
                    duration: durationString
                });
            } else {
                displayString = app.lang.get('LBL_START_AND_END_DATE', this.module, {
                    start: startDate.formatUser(false),
                    end: endDate.formatUser(false),
                    duration: durationString
                });
            }
        }

        return displayString;
    },

    setDefaultStartDateTime: function (currentDateTime) {
        var defaultDateTime = currentDateTime || app.date().seconds(0);
        this.model.set('date_start', defaultDateTime.formatServer());
    },

    updateDurationHoursAndMinutes: function () {
        var diff = app.date(this.model.get('date_end')).diff(this.model.get('date_start'));
        this.model.set('duration_hours', Math.floor(app.date.duration(diff).asHours()));
        this.model.set('duration_minutes', app.date.duration(diff).minutes());
    },

    modifyEndDateToRetainDuration: function () {
        var startDateString = this.model.get('date_start'),
            originalStartDateString = this.model.previous('date_start'),
            originalStartDate,
            endDateString = this.model.get('date_end'),
            endDate,
            duration,
            changedAttributes = this.model.changedAttributes();

        if (!startDateString ||
            (changedAttributes.date_start && changedAttributes.date_end) ||
            !app.acl.hasAccessToModel('edit', this.model, 'date_end')
        ) {
            return;
        }

        if (endDateString && originalStartDateString) {
            originalStartDate = app.date(originalStartDateString);
            duration = app.date(endDateString).diff(originalStartDate);

            if (duration >= 0) {
                endDate = app.date(startDateString).add(duration).formatServer();
                this.model.set('date_end', endDate);
            }
        } else {
            endDate = app.date(startDateString).add(1, 'm').formatServer();
            this.model.set('date_end', endDate);
        }
    },

    isDateRangeValid: function () {
        var start = this.model.get('date_start'),
            end = this.model.get('date_end'),
            isValid = false;

        if (start && end) {
            if (app.date.compare(start, end) < 1) {
                isValid = true;
            }
        }

        return isValid;
    },

    _loadTemplate: function () {
        //add by TKT
        if (this.view.action == 'detail') {
            this.def.dismiss_label=false;
        }

        this._super('_loadTemplate');
        if ((_.indexOf(this.detailViewNames, this.view.name) > -1) && (this.action === 'edit')) {
            this.template = app.template.getField('fieldset', 'duration', this.model.module);
        }
    },
    _dispose: function () {
        this.model.removeValidationTask('duration_date_range_' + this.cid);
        this._super('_dispose');
    },
    _render: function () {
        var start = this.view.getField('date_start');
        var end = this.view.getField('date_end');

        if (start) {
            start.$(start.fieldTag).datepicker('hide');
            start.$(start.secondaryFieldTag).timepicker('hide');
        }

        if (end) {
            end.$(end.fieldTag).datepicker('hide');
            end.$(end.secondaryFieldTag).timepicker('hide');
        }

        return this._super('_render');
    },
    setMode: function (name) {
        if (this.view.name === 'preview' && name === 'detail') {
            name = 'preview';
        }
        this._super('setMode', [name]);
    }
})
