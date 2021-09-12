/**
 * author: TKT
 * date: 2019-12-18
 */
({
    extendsFrom: 'JdatetimeField',
    colorCodeClasses: {
        overdue: 'label label-important',
        upcoming: 'label label-info',
        waiting: 'label label-pending',
        complete: 'label label-success',
    },
    _render: function () {
        this.type = 'jdatetime';
        this._super('_render');
        this.setColorCoding();
    },
    bindDataChange: function () {
        this._super('bindDataChange');
        this.model.on('change:recall_at', this.render, this);
    },
    setColorCoding: function () {
        var colorCodeClass;
        this._clearColorCode();

        if (_.isEmpty(this.model.get(this.name))) return;

        if (!this.model || this.action !== 'list') return;

        colorCodeClass = this._isCompletedStatus() ? this.colorCodeClasses.complete : this._getColorCodeClass();
        this._setColorCodeClass(colorCodeClass);
    },

    _getColorCodeClass: function () {
        var eventDate,
            today,
            nextDay;

        if (_.isEmpty(this.model.get(this.name))) {
            return null;
        }

        eventDate = app.date(this.model.get(this.name));
        today = app.date();
        nextDay = app.date().add(1, 'days');

        if (eventDate.isBefore(today)) {
            return this.colorCodeClasses.overdue;
        } else if (eventDate.isBefore(nextDay)) {
            return this.colorCodeClasses.upcoming;
        } else {
            return this.colorCodeClasses.waiting;
        }
    },

    _isCompletedStatus: function () {
        if (_.isUndefined(this.def.completed_status_value) || _.isUndefined(this.def.completed_status_field)) return false;
        if (this.model.get(this.def.completed_status_field) == this.def.completed_status_value) return true;
        return false;
    },

    _setColorCodeClass: function (colorCodeClass) {
        if (!_.isNull(colorCodeClass)) {
            this.$el.addClass(colorCodeClass);
        }
    },

    _clearColorCode: function () {
        _.each(this.colorCodeClasses, function (colorCodeClass) {
            this.$el.removeClass(colorCodeClass);
        }, this);
    }
})
