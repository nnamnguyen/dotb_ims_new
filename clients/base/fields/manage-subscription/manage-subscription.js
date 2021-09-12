
/**
 * @class View.Fields.Base.ManageSubscriptionField
 * @alias DOTB.App.view.fields.BaseManageSubscriptionField
 * @extends View.Fields.Base.RowactionField
 */
({
    extendsFrom: 'RowactionField',

    initialize: function (options) {
        this._super("initialize", [options]);
        this.type = 'rowaction';
    },

    /**
     * Event to navigate to the BWC Manage Subscriptions
     */
    rowActionSelect: function() {

        var route = app.bwc.buildRoute('Campaigns', this.model.id, 'Subscriptions', {
            return_module: this.module,
            return_id: this.model.id
        });
        app.router.navigate(route, {trigger: true});
    },

    /**
     * @inheritdoc
     * Check access for Campaigns Module.
     */
    hasAccess: function() {
        var access = app.acl.hasAccess('view', 'Campaigns');
        return access && this._super('hasAccess');
    }
})
