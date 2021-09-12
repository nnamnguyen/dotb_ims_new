
/**
 * @class View.Views.Base.Contacts.CreateView
 * @alias DOTB.App.view.views.ContactsCreateView
 * @extends View.Views.Base.CreateView
 */
({
    extendsFrom: 'CreateView',

    /**
     * Gets the portal status from metadata to know if we render portal specific fields.
     * @override
     * @param options
     */
    initialize: function(options) {
        //Plugin is registered by the Contact record view
        this.plugins = _.union(this.plugins || [], ["ContactsPortalMetadataFilter"]);
        this._super("initialize", [options]);
        this.removePortalFieldsIfPortalNotActive(this.meta);
    }
})
