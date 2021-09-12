
/**
 * @class View.Fields.Base.Leads.StatusField
 * @alias DOTB.App.view.fields.BaseLeadsStatusField
 * @extends View.Fields.Base.EnumField
 */
({
    extendsFrom: 'EnumField',

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this._super('initialize', [options]);
        this.type = 'enum';
    },

    /**
     * @inheritdoc
     *
     * Filter out the Converted option if the Lead is not already converted.
     */
    _filterOptions: function(options) {
        var status = this.model.get('status');
        var filteredOptions = this._super('_filterOptions', [options]);

        return (!_.isUndefined(status) && status !== 'Converted') ?
            _.omit(filteredOptions, 'Converted') :
            filteredOptions;
    }

})
