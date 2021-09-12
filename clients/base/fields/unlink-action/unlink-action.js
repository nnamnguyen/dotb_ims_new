
/**
 * Unlink row action used in subpanels and dashlets.
 *
 * @class View.Fields.Base.UnlinkActionField
 * @alias DOTB.App.view.fields.BaseUnlinkActionField
 * @extends View.Fields.Base.RowactionField
 */
({
    extendsFrom: 'RowactionField',

    /**
     * @inheritdoc
     *
     * By default `list:unlinkrow:fire` event is triggered if none supplied
     * through metadata.
     */
    initialize: function(options) {
        options.def.event = options.def.event || 'list:unlinkrow:fire';
        this._super('initialize', [options]);
        this.type = 'rowaction';
    },

    /**
     * @inheritdoc
     *
     * If parent module matches `Homepage` then `false` is returned.
     *
     * Plus, we cannot unlink one-to-many relationships when the relationship
     * is a required field - if that's the case `false` is returned as well.
     *
     * @return {Boolean} `true` if access is allowed, `false` otherwise.
     */
    hasAccess: function() {
        var parentModule = this.context.get('parentModule');
        if (parentModule === 'Home') {
            return false;
        }

        var link = this.context.get('link');
        if (link && app.utils.isRequiredLink(parentModule, link)) {
            return false;
        }

        return this._super('hasAccess');
    }
})
