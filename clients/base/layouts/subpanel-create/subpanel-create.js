
/**
 * @class View.Layouts.Base.SubpanelCreateLayout
 * @alias DOTB.App.view.layouts.BaseSubpanelCreateLayout
 * @extends View.Layouts.Base.SubpanelLayout
 */
({
    extendsFrom: 'SubpanelLayout',

    initialize: function(options) {
        app.logger.warn('`BaseSubpanelCreateLayout` controller ' +
            'has been deprecated since 7.8.0 and will be removed in 7.9.0. To use `BaseSubpanelLayout` controller, ' +
            'specify the `type` property in your `subpanel-create` metadata file instead.');

        this._super('initialize', [options]);
    }
})
