
/**
 * @class View.Views.Base.PrefilteredHeaderpaneView
 * @alias DOTB.App.view.views.BasePrefilteredHeaderpaneView
 * @extends View.Views.Base.SelectionHeaderpaneView
 */

({
    extendsFrom: 'SelectionHeaderpaneView',

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this._super('initialize', [options]);
        this.meta.fields = _.map(this.meta.fields, function(field) {
            if (field.name === 'title') {
                field['formatted_value'] = this.context.get('headerPaneTitle')
                    || this._formatTitle(field['default_value'])
                    || app.lang.get(field['value'], this.module);
                this.title = field['formatted_value'];
            }
            return field;
        }, this);
    }
})
