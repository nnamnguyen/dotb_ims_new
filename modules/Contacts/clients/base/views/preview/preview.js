
({
    extendsFrom: 'PreviewView',


    initialize: function(options) {
        //Plugin is registered by the Contact record view
        this.plugins = _.union(this.plugins || [], ["ContactsPortalMetadataFilter"]);
        this._super("initialize", [options]);
    },

    /**
     * Gets the portal status from metadata to know if we render portal specific fields.
     * @override
     * @param options
     */
    _previewifyMetadata: function(meta) {
        meta = this._super("_previewifyMetadata", [meta]);
        this.removePortalFieldsIfPortalNotActive(meta);
        return meta;
    }
})
