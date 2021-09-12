
/**
 * @class View.Layouts.Base.SubpanelsCreateLayout
 * @alias DOTB.App.view.layouts.BaseSubpanelsCreateLayout
 * @extends View.Layouts.Base.SubpanelsLayout
 */
({
    extendsFrom: 'SubpanelsLayout',

    initialize: function(options) {
        app.logger.warn('`BaseSubpanelsCreateLayout` controller ' +
            'has been deprecated since 7.8.0 and will be removed in 7.9.0. To use `BaseSubpanelsLayout` controller, ' +
            'specify the `type` property in your `subpanels-create` metadata file instead.');

        this._super('initialize', [options]);
    }
})
