
/**
 * EditrecurrencesbuttonField is a field for Meetings/Calls for the ability editing all recurring events for a parent record
 *
 * FIXME: This component will be moved out of clients/base folder as part of MAR-2274 and SC-3593
 *
 * @class View.Fields.Base.EditrecurrencesbuttonField
 * @alias DOTB.App.view.fields.BaseEditrecurrencesbuttonField
 * @extends View.Fields.Base.RowactionField
 */
({
    extendsFrom: 'RowactionField',

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this._super('initialize', [options]);
        this.type = 'rowaction';
    },

    /**
     * @inheritdoc
     *
     * Button should be hidden if meeting displayed is not recurring
     */
    _render: function() {
        if (_.isEmpty(this.model.get('repeat_type'))) {
            this.hide();
        } else {
            this._super('_render');
        }
    },

    /**
     * Re-render the field when the status on the record changes.
     */
    bindDataChange: function() {
        if (this.model) {
            this.model.on('change:repeat_type', this.render, this);
        }
    },

    /**
     * Event handler for editing all recurring records of a series
     * @inheritdoc
     */
    rowActionSelect: function() {
        this.context.trigger('all_recurrences:edit');
    }
})
