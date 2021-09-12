
/**
 * DatetimecomboColorcodedField is a field for Meetings/Calls/Tasks that sets a background color for the field based on the value of the status field
 *
 * FIXME: This component will be moved out of clients/base folder as part of MAR-2274 and SC-3593
 *
 * @class View.Fields.Base.DatetimecomboColorcodedField
 * @alias DOTB.App.view.fields.BaseDatetimecomboColorcodedField
 * @extends View.Fields.Base.DatetimecomboField
 */
({
    extendsFrom: 'DatetimecomboField',

    colorCodeClasses: {
        overdue: '',
        upcoming: 'label label-info'
    },

    /**
     * @inheritdoc
     *
     * Checks color code conditions to determine if field should have
     * color applied to it.
     */
    _render: function() {
        this.type = 'datetimecombo'; //use datetimecombo templates
        this._super('_render');
        this.setColorCoding();
    },

    /**
    * @inheritdoc
    *
    * Listen for status change - set color coding appropriately
    */
    bindDataChange: function() {
        this._super('bindDataChange');
        this.model.on('change:status', this.setColorCoding, this);
    },

    /**
    * Set color coding based on completion status and date compared to today
    * This is only applied when the action is list (not inline edit on list view)
    */
    setColorCoding: function() {
        var colorCodeClass;

        this._clearColorCode();

        if (!this.model || this.action !== 'list') {
            return;
        }
        colorCodeClass = this._isCompletedStatus() ? null : this._getColorCodeClass();
        this._setColorCodeClass(colorCodeClass);
    },

    /**
    * Check if status is completed based on status value defined in the view def
    *
    * @return {Boolean}
    * @private
    */
    _isCompletedStatus: function() {
        if (_.isUndefined(this.def.completed_status_value)) {
            return false;
        }
        return (this.model.get('status') === this.def.completed_status_value);
    },

    /**
    * Get color code class based on the date compared to today
    * If event is today - use 'today' color code
    * If event is yesterday or earlier - use 'overdue' color code
    *
    * @return {String|null} One of the color codes or null if no color code
    * @private
    */
    _getColorCodeClass: function() {
        var eventDate,
            today,
            nextDay;

        if (_.isEmpty(this.model.get(this.name))) {
            return null;
        }

        eventDate = app.date(this.model.get(this.name));
        today = app.date();
        nextDay = app.date().add(1000, 'days');   //Add by Lap Nguyen

        if (eventDate.isBefore(today)) {
            return this.colorCodeClasses.overdue;
        } else if (eventDate.isBefore(nextDay)) {
            return this.colorCodeClasses.upcoming;
        } else {
            return null;
        }
    },

    /**
    * Set the color code class to the field tag or clear out if no
    * color code should be applied (colorCodeClass is null)
    *
    * @param {String|null} colorCodeClass
    * @private
    */
    _setColorCodeClass: function(colorCodeClass) {
        if (!_.isNull(colorCodeClass)) {
            this.$el.addClass(colorCodeClass);
        }
    },

    /**
     * Clear color coding classes
     *
     * @private
     */
    _clearColorCode: function() {
        _.each(this.colorCodeClasses, function(colorCodeClass) {
            this.$el.removeClass(colorCodeClass);
        }, this);
    }
})
