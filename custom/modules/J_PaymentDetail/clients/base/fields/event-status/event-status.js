/**
 * EventStatusField is a field for Meetings/Calls that show the status field of the model as a badge field.
 *
 * FIXME: This component will be moved out of clients/base folder as part of MAR-2274 and SC-3593
 *
 * @class View.Fields.Base.EventStatusField
 * @alias DOTB.App.view.fields.BaseEventStatusField
 * @extends View.Fields.Base.BadgeSelectField
 */
({
    extendsFrom: 'BadgeSelectField',

    /**
     * @inheritdoc
     */
    initialize: function (options) {
        this._super('initialize', [options]);

        /**
         * An object where its keys map to specific status and color to matching
         * CSS classes.
         */
        this.statusClasses = {
            'Paid': 'textbg_green',
            // 'Cancelled' :'textbg_orange',
            'Normal':'textbg_green',
            'Deposit':'textbg_violet',
            'Unpaid': 'textbg_orange',
            //end
        };

        this.type = 'badge-select';
    },

    /**
     * @inheritdoc
     */
    _loadTemplate: function () {
        if (this.def.name === "status") {
            this.action = "visible";
        }

        var action = this.action || this.view.action;
        if (action === 'edit') {
            this.type = 'enum';
        }

        this._super('_loadTemplate');
        this.type = 'badge-select';
    }
})
