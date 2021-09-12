
/**
 * @class View.Views.Base.TaxRates.SelectionListView
 * @alias DOTB.App.view.views.BaseTaxRatesSelectionListView
 * @extends View.Views.Base.SelectionListView
 */
({
    extendsFrom: 'SelectionListView',

    /**
     * Extending to add the value into the attributes passed back
     *
     * @inheritdoc
     */
    _getModelAttributes: function(model) {
        var attributes = {
            id: model.id,
            name: model.get('name'),
            value: model.get('value')
        };

        //only pass attributes if the user has view access
        _.each(model.attributes, function(value, field) {
            if (app.acl.hasAccessToModel('view', model, field)) {
                attributes[field] = attributes[field] || model.get(field);
            }
        }, this);

        return attributes;
    }
})
