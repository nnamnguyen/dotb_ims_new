
/**
 * EventStatusField is a field for Meetings/Calls that show the status field of the model as a badge field.
 *
 * @class View.Fields.Base.EventStatusField
 * @alias DOTB.App.view.fields.BaseEventStatusField
 * @extends View.Fields.Base.BadgeSelectField
 */
({
    extendsFrom: 'BaseField',

    /**
     * @inheritdoc
     */
    initialize: function (options) {
        this._super('initialize', [options]);
    },

    /**
     * @inheritdoc
     *
     * Styles the badge.
     *
     * @private
     */
    _render: function () {
        this._super('_render');
        this.styleLabel();
    },

    /**
     * Sets the appropriate CSS class on the label based on the value of the
     * status.
     *
     * It is a noop when the field is in edit mode.
     *
     * @param {String} status
     */
    styleLabel: function () {
        var $label;
        $label = this.$el.children(0);
        $label.removeClass('ellipsis_inline');
        switch (this.value) {
            case 'IN PROGRESS':
                $label.addClass('label label-process-in-progress');
                break;
            case 'COMPLETED':
                $label.addClass('label label-process-completed');
                break;
            case 'TERMINATED':
                $label.addClass('label label-process-terminate');
                break;
            case 'CANCELLED':
                $label.addClass('label label-process-cancelled');
                break;
            default:
                $label.addClass('label label-process-error');
                break;
        }

    }
})
