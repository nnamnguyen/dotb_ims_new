
/**
 * @class View.Views.Base.AuditFooterView
 * @alias DOTB.App.view.views.BaseAuditFooterView
 * @extends View.View
 */
({
    /**
     * @inheritdoc
     * Initialize the audited fields on the parent model.
     */
    initialize: function(options) {
        this._super('initialize', [options]);
        if (this.context.parent) {
            var baseModule = this.context.parent.get('module');
            this.auditedFields = this._getAuditedFields(baseModule);
            this.hasCurrencyFields = this._hasCurrencyFields(baseModule);
        }
    },

    /**
     * Parse the parent module metadata and determine audited fields.
     *
     * @param {String} baseModule Name of parent module.
     * @return {Array} List of audited field's name.
     * @protected
     */
    _getAuditedFields: function(baseModule) {
        return _.chain(app.metadata.getModule(baseModule, 'fields'))
            .filter(function(o) {return o.audited;})
            .map(function(o) {return app.lang.get(o.vname, baseModule);})
            .value();
    },

    /**
     *  Look to see if the baseModule has any currency fields
     *
     *  @return {boolean}
     *  @protected
     */
    _hasCurrencyFields: function(baseModule) {
        return _.some(app.metadata.getModule(baseModule, 'fields'), function(field) {
           return field.audited && field.type && field.type == 'currency';
        });
    }
})
