
/**
 * @class View.Fields.Base.OutboundEmail.EmailProviderField
 * @alias DOTB.App.view.fields.BaseOutboundEmailEmailProviderField
 * @extends View.Fields.Base.RadioenumField
 */
({
    extendsFrom: 'RadioenumField',

    /**
     * Falls back to the detail template when attempting to load the disabled
     * template.
     *
     * @inheritdoc
     */
    _getFallbackTemplate: function(viewName) {
        // Don't just return "detail". In the event that "nodata" or another
        // template should be the fallback for "detail", then we want to allow
        // the parent method to determine that as it always has.
        if (viewName === 'disabled') {
            viewName = 'detail';
        }

        return this._super('_getFallbackTemplate', [viewName]);
    }
})
