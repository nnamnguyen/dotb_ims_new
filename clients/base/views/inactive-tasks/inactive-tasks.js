
/**
 * Inactive tasks dashlet takes advantage of the tabbed dashlet abstraction by
 * using its metadata driven capabilities to configure its tabs in order to
 * display information about tasks module.
 *
 * @class View.Views.Base.InactiveTasksView
 * @alias DOTB.App.view.views.BaseInactiveTasksView
 * @extends View.Views.BaseTabbedDashletView
 */
({
    extendsFrom: 'TabbedDashletView',

    /**
     * @inheritdoc
     *
     * @property {Object} _defaultSettings
     * @property {Number} _defaultSettings.limit Maximum number of records to
     *   load per request, defaults to '10'.
     * @property {String} _defaultSettings.visibility Records visibility
     *   regarding current user, supported values are 'user' and 'group',
     *   defaults to 'user'.
     */
    _defaultSettings: {
        limit: 10,
        visibility: 'user'
    },

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        options.meta = options.meta || {};
        options.meta.template = 'tabbed-dashlet';

        this.plugins = _.union(this.plugins, [
            'LinkedModel'
        ]);
        this.tbodyTag = 'ul[data-action="pagination-body"]';

        this._super('initialize', [options]);
    },

    /**
     * @inheritdoc
     */
    _initEvents: function() {
        this._super('_initEvents');
        this.on('linked-model:create', this.loadData, this);
        return this;
    },

    /**
     * Create new record.
     *
     * @param {Event} event Click event.
     * @param {Object} params
     * @param {String} params.layout Layout name.
     * @param {String} params.module Module name.
     */
    createRecord: function(event, params) {
        if (this.module !== 'Home') {
            this.createRelatedRecord(params.module, params.link);
        } else {
            var self = this;
            app.drawer.open({
                layout: 'create',
                context: {
                    create: true,
                    module: params.module
                }
            }, function(context, model) {
                if (!model) {
                    return;
                }
                self.context.resetLoadFlag();
                self.context.set('skipFetch', false);
                if (_.isFunction(self.loadData)) {
                    self.loadData();
                } else {
                    self.context.loadData();
                }
            });
        }
    },

    /**
     * New model related properties are injected into each model.
     * Update the picture url's property for model's assigned user.
     *
     * @param {Bean} model Appended new model.
     */
    bindCollectionAdd: function(model) {
        var pictureUrl = app.api.buildFileURL({
            module: 'Users',
            id: model.get('assigned_user_id'),
            field: 'picture'
        });
        model.set('picture_url', pictureUrl);
        this._super('bindCollectionAdd', [model]);
    }
})
